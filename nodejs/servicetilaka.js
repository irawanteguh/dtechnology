import fetch from "node-fetch";
const BASE_URL = "http://localhost/dtechnology/index.php/";

async function callAPI(endpoint) {
    const url = `${BASE_URL}${endpoint}`;
    try {
        const response = await fetch(url);
        const data     = await response.json();
        console.log(`[${new Date().toLocaleTimeString()}] [${endpoint}] Response:`, data);
    } catch (error) {
        console.error(`[${new Date().toLocaleTimeString()}] [${endpoint}] Error:`, error.message);
    }
}

async function runservices() {
  await callAPI("authtilaka");
}

setInterval(runservices, 1000);
runservices();
