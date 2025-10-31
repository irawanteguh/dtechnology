import os from "os";
import fetch from "node-fetch";
import chalk from "chalk";

let lebar = 155;
let host  = "localhost";

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

function getTimeStamp() {
  const now = new Date();
  const pad = (n) => n.toString().padStart(2, "0");
  return `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())} ${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
}

function printHeader() {
    console.clear();
    // console.log(chalk.gray("=".repeat(150)));
    // console.log(chalk.bold.cyan("🚀 DTechnology Service Tilaka Monitor\n"));
    // console.log(`${chalk.yellow("BASE_URL")}\t${chalk.white(BASE_URL)}`);
    // console.log(`${chalk.yellow("Last Refresh")}\t${chalk.white(getTimeStamp())}`);
    // console.log(chalk.gray("Logs\t\t(auto-refresh every 10s)"));
    // console.log(chalk.gray("=".repeat(150)));
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
        const text     = await response.text();

        // console.log(response);

        if(!response.ok){
            console.log(chalk.cyan("=".repeat(lebar)));
            console.log(chalk.cyan("TIMESTAMP\t\tMETHOD\tENDPOINT\tSTATUS\t\tMESSAGE"));
            console.log(chalk.cyan("=".repeat(lebar)));
            console.log(chalk.white(getTimeStamp())+"\t"+chalk.white(method)+"\t"+chalk.white(endpoint)+"\t"+chalk.red(`Error ${response.status}`)+"\t"+chalk.white(response.statusText)+"\n");
            return;
        }

        try {

            const data = JSON.parse(text);
            console.log(`${chalk.gray(`[${getTimeStamp()}]`)} ${chalk.cyan(`[${method}]`)} ${chalk.yellow(`[${endpoint}]`)} ? ${chalk.green("? Success")}`,data);

        } catch {
            console.log(chalk.cyan("=".repeat(lebar)));
            console.log(chalk.cyan("TIMESTAMP\t\tMETHOD\tENDPOINT\tSTATUS\t\tMESSAGE"));
            console.log(chalk.cyan("=".repeat(lebar)));
            
            console.log(`${chalk.white(`[${getTimeStamp()}]`)}\t${chalk.yellow(`[${method}]`)}\t${chalk.yellow(`[${endpoint}]`)}\t${chalk.green(`${response.status}`)}\t\t${chalk.green(`${response.statusText}`)}\n${chalk.white(text)}`);
            // console.log(chalk.cyan("*".repeat(lebar))+"\n\n");
        }

    } catch (error) {
        console.log(chalk.cyan("=".repeat(lebar)));
        console.log(chalk.cyan("TIMESTAMP\t\tMETHOD\tENDPOINT\tSTATUS\t\tMESSAGE"));
        console.log(chalk.cyan("=".repeat(lebar)));
        console.log(chalk.white(getTimeStamp())+"\t"+chalk.white(method)+"\t"+chalk.white(endpoint)+"\t"+chalk.red(`Network Error`)+"\t"+chalk.white(error.message)+"\n");
    }
}

async function runservices() {
    await callAPI("transferfile", "POST");
    await callAPI("getstatusdocument", "POST");
}

printHeader();
runservices();
setInterval(runservices, 5000);