import os from "os";
import fetch from "node-fetch";
import chalk from "chalk";

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
console.log(chalk.cyanBright(`[INIT] BASE_URL: ${BASE_URL}`));

function getTimeStamp() {
	const now = new Date();
	const date = now.toISOString().slice(0, 10); // yyyy-mm-dd
	const time = now.toTimeString().split(" ")[0]; // HH:MM:SS
	return `${date} ${time}`;
}

// =======================================================
// 📡 Fungsi callAPI
// =======================================================
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

		let color = chalk.blueBright;

		console.log(
			`${chalk.gray(`[${getTimeStamp()}]`)} ${chalk.cyan(`[${method}]`)} ${chalk.yellow(`[${endpoint}]`)} → ${color(text)}`
		);
	} catch (error) {
		console.error(
			`${chalk.gray(`[${getTimeStamp()}]`)} ${chalk.red(`[${method}]`)} ${chalk.yellow(`[${endpoint}]`)} ${chalk.redBright("Error:")} ${error.message}`
		);
	}
}

// =======================================================
// 🔁 Jalankan Service Periodik
// =======================================================
async function runservices() {
  await callAPI("uploadallfile", "POST");
}

// Jalankan pertama kali & ulang tiap 10 detik
runservices();
setInterval(runservices, 10000);
