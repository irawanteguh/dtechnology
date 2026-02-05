import os from "os";
import fetch from "node-fetch";
import chalk from "chalk";

let lebar             = 120;
let host              = "localhost";
let isRunningServices = false;


const interfaces = os.networkInterfaces();
for (const iface of Object.values(interfaces)) {
    for (const info of iface) {
        if (info.family === "IPv4" && !info.internal) {
            host = info.address;
            break;
        }
    }
}

const possibleFolders = ["haspro-tte", "dtechnology"];
let BASE_FOLDER = possibleFolders.find(f => fs.existsSync(`/var/www/html/${f}`));
if (!BASE_FOLDER) {
    console.error(chalk.red("Folder aplikasi tidak ditemukan!"));
    process.exit(1);
}
const BASE_URL = process.env.BASE_URL || `http://${host}/${BASE_FOLDER}/index.php/`;

function getTimeStamp() {
  const now = new Date();
  const pad = (n) => n.toString().padStart(2, "0");
  return `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())} ${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
}

function printHeader() {
    console.log(chalk.cyan("=".repeat(lebar)));
    console.log(chalk.cyan("TIMESTAMP".padEnd(40)+"METHOD".padEnd(10)+"ENDPOINT".padEnd(30)+"STATUS".padEnd(12)+"MESSAGE"));
    console.log(chalk.cyan("=".repeat(lebar)));
}

function formatLog(
    timestamp,
    method,
    endpoint,
    status,
    message,
    widths = { ts: 40, method: 10, endpoint: 30, status: 12 },
    colors = { ts: "white", method: "yellow", endpoint: "cyan", status: "auto", message: "white" }
) {
    // Fungsi bantu untuk dapatkan warna dari chalk secara dinamis
    const colorize = (text, color) => {
        if (color === "auto") {
            // Otomatis hijau untuk 2xx, merah untuk lainnya
            const statusNum = Number(status);
            const statusColor = (statusNum >= 200 && statusNum < 300) ? "green" : "red";
            return chalk[statusColor](text);
        }
        return chalk[color] ? chalk[color](text) : text;
    };

    return (
        colorize(String(timestamp).padEnd(widths.ts), colors.ts) +
        colorize(String(method).padEnd(widths.method), colors.method) +
        colorize(String(endpoint).padEnd(widths.endpoint), colors.endpoint) +
        colorize(String(status).padEnd(widths.status), colors.status) +
        colorize(String(message || ""), colors.message)
    );
}

function Waiting(endpoint) {
    printHeader();

    console.log(
        formatLog(
            getTimeStamp(),
            "WAIT",
            endpoint,
            "WAITING",
            "Proses sebelumnya masih berjalan",
            { ts: 40, method: 10, endpoint: 30, status: 12 },
            { ts: "white", method: "yellow", endpoint: "yellow", status: "yellow", message: "yellow" }
        )
    );
}

async function callAPI(endpoint, method = "GET", body = null) {
    printHeader();
    const url     = `${BASE_URL}${endpoint}`;
    const options = {method,headers: { "Content-Type": "application/json" }};

    if (body) options.body = JSON.stringify(body);

    try{
        const response = await fetch(url, options);
        const text = await response.text();


        if (!response.ok) {
            const match = text.match(/<strong>Message:<\/strong>\s*([^<]+)/i);
            const errorMsg = match ? match[1].trim() : response.statusText;

            console.log(
                formatLog(
                    getTimeStamp(),
                    method,
                    endpoint,
                    response.status,
                    response.statusText,
                    { ts: 40, method: 10, endpoint: 30, status: 12 }, // custom width
                    { ts: "white", method: "yellow", endpoint: "yellow", status: "auto", message: "auto" } // custom warna
                )
            );

            console.log(chalk.red("*".repeat(lebar)));
            console.log(chalk.red(errorMsg));
            console.log(chalk.red("*".repeat(lebar)));
            
            return;
        }

        try{
            const data = JSON.parse(text);

            console.log(
                formatLog(
                    getTimeStamp(),
                    method,
                    endpoint,
                    response.status,
                    response.statusText,
                    { ts: 40, method: 10, endpoint: 30, status: 12 }, // custom width
                    { ts: "white", method: "yellow", endpoint: "yellow", status: "auto", message: "auto" } // custom warna
                )
            );

            console.log(data);
        }catch{
            const match   = text.match(/<strong>Message:<\/strong>\s*([^<]+)/i);
            const message = match ? match[1].trim() : text;

            console.log(
                formatLog(
                    getTimeStamp(),
                    method,
                    endpoint,
                    response.status,
                    response.statusText,
                    { ts: 40, method: 10, endpoint: 30, status: 12 }, // custom width
                    { ts: "white", method: "yellow", endpoint: "yellow", status: "auto", message: "auto" } // custom warna
                )
            );

            console.log(chalk.red(message));
        }

    }catch(error){
        console.log(
            formatLog(
                getTimeStamp(),
                method,
                endpoint,
                "Network Error",
                error.message,
                { ts: 40, method: 10, endpoint: 30, status: 12 }, // custom width
                { ts: "white", method: "yellow", endpoint: "yellow", status: "auto", message: "auto" } // custom warna
            )
        );
    }
}

async function callAPI_debug(endpoint, method = "GET", body = null) {
    printHeader();

    const url = `${BASE_URL}${endpoint}`;

    const options = {
        method,
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        }
    };

    if (body) {
        options.body = JSON.stringify(body);
    }

    // ===== LOG REQUEST =====
    console.log("REQUEST >>>");
    console.log({
        url,
        method,
        body
    });

    try {
        const response = await fetch(url, options);
        const text = await response.text();

        // ===== LOG RAW RESPONSE =====
        console.log("RAW RESPONSE <<<");
        console.log(text);

        // ===== JIKA HTTP STATUS ERROR =====
        if (!response.ok) {

            let errorMessage = response.statusText;

            // Coba parse JSON error
            try {
                const errJson = JSON.parse(text);
                errorMessage = errJson.message || JSON.stringify(errJson);
            } catch {
                // fallback: ambil pesan dari HTML
                const match = text.match(/<strong>Message:<\/strong>\s*([^<]+)/i);
                if (match) errorMessage = match[1].trim();
            }

            console.log(
                formatLog(
                    getTimeStamp(),
                    method,
                    endpoint,
                    response.status,
                    "ERROR",
                    { ts: 40, method: 10, endpoint: 30, status: 12 },
                    { ts: "white", method: "yellow", endpoint: "red", status: "red", message: "red" }
                )
            );

            console.log(chalk.red("*".repeat(lebar)));
            console.log(chalk.red(errorMessage));
            console.log(chalk.red("*".repeat(lebar)));

            return null; // ❗ penting supaya chain berhenti
        }

        // ===== RESPONSE OK =====
        let data;
        try {
            data = JSON.parse(text);
        } catch {
            data = text;
        }

        console.log(
            formatLog(
                getTimeStamp(),
                method,
                endpoint,
                response.status,
                "OK",
                { ts: 40, method: 10, endpoint: 30, status: 12 },
                { ts: "white", method: "yellow", endpoint: "green", status: "green", message: "green" }
            )
        );

        console.log(data);
        return data;

    } catch (error) {
        console.log(
            formatLog(
                getTimeStamp(),
                method,
                endpoint,
                "NETWORK",
                error.message,
                { ts: 40, method: 10, endpoint: 30, status: 12 },
                { ts: "white", method: "yellow", endpoint: "red", status: "red", message: "red" }
            )
        );
        return null;
    }
}

async function runLoop() {

    if (isRunningServices) {
        Waiting("batch-services");
        return;
    }

    isRunningServices = true;

    try {
        await callAPI("uploadfile", "POST");
        await callAPI("requestsign", "POST");
        await callAPI("statussign", "POST");
    } catch (e) {
        console.log(chalk.red("❌ Error batch:"), e.message);
    } finally {
        isRunningServices = false;

        // ⏱ delay setelah selesai
        setTimeout(runLoop, 5000);
    }
}

async function runservices() {
    // await callAPI("statusregister", "GET");
    await callAPI("uploadfile", "POST");
    await callAPI("requestsign", "POST");
    await callAPI("statussign", "POST");
}

async function runservices_debug() {

    console.log(chalk.cyan("\n=== UPLOAD FILE ==="));
    const upload = await callAPI_debug("uploadfile", "POST", {
        // isi body sesuai kebutuhan
    });
    if (!upload) return;

    console.log(chalk.cyan("\n=== REQUEST SIGN ==="));
    const sign = await callAPI_debug("requestsign", "POST", {
        request_id: upload.request_id // contoh
    });
    if (!sign) return;

    console.log(chalk.cyan("\n=== STATUS SIGN ==="));
    await callAPI_debug("statussign", "POST", {
        request_id: sign.request_id
    });
}

console.clear();
// runLoop();
runservices();
setInterval(runservices, 20000);