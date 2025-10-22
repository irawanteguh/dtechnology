import os from "os";
import fetch from "node-fetch";
import chalk from "chalk";
import readline from "readline";

// =======================================================
// 🌐 Get Local IP & BASE_URL
// =======================================================
let host = "localhost";
const interfaces = os.networkInterfaces();
for (const iface of Object.values(interfaces)) {
  for (const info of iface) {
    if (info.family === "IPv4" && !info.internal) {
      host = info.address;
      break;
    }
  }
}

const BASE_URL = process.env.BASE_URL || `http://${host}/dtechnology/index.php/`;

// =======================================================
// 🕒 Timestamp helper
// =======================================================
function getTimeStamp() {
  const now = new Date();
  const date = now.toISOString().slice(0, 10);
  const time = now.toTimeString().split(" ")[0];
  return `${date} ${time}`;
}

// =======================================================
// 🧩 Header (frozen section)
// =======================================================
function printHeader() {
  console.clear();
  console.log(chalk.bold.cyan("🚀 DTechnology Service Tilaka Monitor"));
  console.log(chalk.gray("==============================================================================================================================================="));
  console.log(`${chalk.yellow("BASE_URL")}\t${chalk.white(BASE_URL)}`);
  console.log(`${chalk.yellow("Last Refresh")}\t${chalk.white(getTimeStamp())}`);
  console.log(chalk.gray("==============================================================================================================================================="));
  console.log(chalk.gray("Logs\t\t(auto-refresh every 10s)"));
  console.log(chalk.gray("==============================================================================================================================================="));
  console.log(chalk.gray("TIMESTAMP\t\tMETHOD\tENDPOINT\tRESPONSE"));
  console.log(chalk.gray("==============================================================================================================================================="));
}

// =======================================================
// 📡 callAPI + log output (below header)
// =======================================================
let logBuffer = []; // menampung log terbaru
const MAX_LOGS = 20; // tampilkan 20 terakhir agar tidak penuh

async function callAPI(endpoint, method = "GET", body = null) {
  const url = `${BASE_URL}${endpoint}`;
  const options = {
    method,
    headers: { "Content-Type": "application/json" },
  };

  if (body) options.body = JSON.stringify(body);

  try {
    const response = await fetch(url, options);
    const text = await response.text();

    const line = `${chalk.gray(`[${getTimeStamp()}]`)}\t${chalk.cyan(`[${method}]`)}\t${chalk.yellow(`[${endpoint}]`)}\t${chalk.white(text)}`;
    logBuffer.push(line);

    // Batasi log agar tidak terus menumpuk
    if (logBuffer.length > MAX_LOGS) logBuffer.shift();

    refreshDisplay();
  } catch (error) {
    const line = `${chalk.gray(`[${getTimeStamp()}]`)} ${chalk.red(`[${method}]`)} ${chalk.yellow(`[${endpoint}]`)} ${chalk.redBright("Error:")} ${error.message}`;
    logBuffer.push(line);
    if (logBuffer.length > MAX_LOGS) logBuffer.shift();
    refreshDisplay();
  }
}

// =======================================================
// 🧠 Fungsi refreshDisplay → header tetap, log di bawah
// =======================================================
function refreshDisplay() {
  readline.cursorTo(process.stdout, 0, 0);
  printHeader();
  for (const line of logBuffer) console.log(line);
}

// =======================================================
// 🔁 Looping service
// =======================================================
async function runservices() {
  await callAPI("uploadallfile", "POST");
  await callAPI("excutesign", "POST");
}

// Jalankan pertama kali & interval
printHeader();
runservices();
setInterval(runservices, 10000);
