import os from "os";
import fetch from "node-fetch";
import chalk from "chalk";

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

const BASE_URL = process.env.BASE_URL || `http://${host}/dtech/dtechnology/index.php/`;

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
//   console.log(chalk.bold.cyan("🚀 DTechnology Service Tilaka Monitor"));
//   console.log(chalk.gray("============================================================================================================================================================="));
//   console.log(`${chalk.yellow("BASE_URL")}\t${chalk.white(BASE_URL)}`);
//   console.log(`${chalk.yellow("Last Refresh")}\t${chalk.white(getTimeStamp())}`);
//   console.log(chalk.gray("============================================================================================================================================================="));
//   console.log(chalk.gray("Logs\t\t(auto-refresh every 10s)"));
//   console.log(chalk.gray("============================================================================================================================================================="));
}

// =======================================================
// 📡 callAPI + log output (below header)
// =======================================================

import chalk from "chalk";

function getTimeStamp() {
  const now = new Date();
  const pad = (n) => n.toString().padStart(2, "0");
  return `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())} ${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
}

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

    // Jika tidak OK ? tampilkan error dengan format log
    if (!response.ok) {
      const cleanMsg = text
        .replace(/<[^>]*>?/gm, "") // hapus tag HTML
        .replace(/\s+/g, " ")       // rapikan spasi
        .trim();

      console.log(
        `${chalk.gray(`[${getTimeStamp()}]`)} ${chalk.cyan(`[${method}]`)} ${chalk.yellow(`[${endpoint}]`)} ? ${chalk.red(`? Error ${response.status} (${response.statusText})`)}: ${chalk.white(cleanMsg)}`
      );
      return;
    }

    // Jika sukses ? tampilkan hasil
    try {
      const data = JSON.parse(text);
      console.log(
        `${chalk.gray(`[${getTimeStamp()}]`)} ${chalk.cyan(`[${method}]`)} ${chalk.yellow(`[${endpoint}]`)} ? ${chalk.green("? Success")}`,
        data
      );
    } catch {
      console.log(
        `${chalk.gray(`[${getTimeStamp()}]`)} ${chalk.cyan(`[${method}]`)} ${chalk.yellow(`[${endpoint}]`)} ? ${chalk.green("? Success (text)")}: ${chalk.white(text)}`
      );
    }

  } catch (error) {
    console.log(
      `${chalk.gray(`[${getTimeStamp()}]`)} ${chalk.cyan(`[${method}]`)} ${chalk.yellow(`[${endpoint}]`)} ? ${chalk.red("?? Network Error:")} ${chalk.white(error.message)}`
    );
  }
}



// =======================================================
// 🔁 Looping service
// =======================================================
async function runservices() {
  await callAPI("uploadallfile", "POST");
//   await callAPI("excutesign", "POST");
}

printHeader();
runservices();
setInterval(runservices, 10000);
