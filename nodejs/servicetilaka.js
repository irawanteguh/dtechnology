import fetch from "node-fetch";

const BASE_URL = "http://localhost/dtechnology/index.php/";

async function callAPI(endpoint, method = null) {
    const url = `${BASE_URL}${endpoint}`;
    const options = {
        method: method,
        headers: {
            "Content-Type": "application/json"
        }
    };

    try {
        const response = await fetch(url, options);
        const data     = await response.json();
        console.log(`[${new Date().toLocaleTimeString()}] [${method}] [${endpoint}]`);
        console.log(`Response: ${JSON.stringify(data)}`);
    } catch (error) {
        console.error(`[${new Date().toLocaleTimeString()}] [${method}] [${endpoint}] Error:`, error.message);
    }
}

async function runservices() {
    await callAPI("uploadallfile", "POST");
}

setInterval(runservices, 10000);
runservices();
