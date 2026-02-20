<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Error</title>
<style>
    html, body {
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        overflow: auto;
        padding: 40px 0;
    }

    .background {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 0;
        overflow: hidden;
    }

    .circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        animation: float 10s infinite ease-in-out;
    }

    .circle:nth-child(1) { width: 250px; height: 250px; top: 10%; left: 15%; }
    .circle:nth-child(2) { width: 350px; height: 350px; bottom: 15%; right: 25%; animation-delay: 2s; }
    .circle:nth-child(3) { width: 150px; height: 150px; top: 65%; left: 40%; animation-delay: 4s; }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .error-container {
        position: relative;
        z-index: 10;
        background: rgba(30,41,59,0.85);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 35px;
        width: 90%;
        max-width: 1400px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.5);
        border-left: 10px solid #ef4444;
        animation: fadeIn 0.7s ease-out;
        margin-bottom: 40px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h1 {
        font-size: 1.6rem;
        font-weight: 600;
        color: #f87171;
        margin-bottom: 10px;
    }

    p {
        color: #cbd5e1;
        font-size: 14px;
        line-height: 1.6;
        margin: 5px 0;
    }

    code {
        display: block;
        background: rgba(15,23,42,0.8);
        border-radius: 8px;
        padding: 8px 14px; /* dikurangi dari 12px 16px */
        margin-top: 15px;
        font-family: Consolas, monospace;
        border-left: 3px solid #ef4444;
        color: #f1f5f9;
        white-space: pre-wrap;
        font-size: 13px;
        line-height: 1.5;
    }

    .footer-note {
        margin-top: 20px;
        text-align: center;
        font-size: 13px;
        color: #64748b;
    }
</style>
</head>
<body>

<div class="background">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
</div>

<div class="error-container">
    <h1>🚫 <?= $heading; ?></h1>
    <p><?= $message; ?></p>

    <code>
<?= date('Y-m-d H:i:s'); ?> — Database connection failed.
Please verify your database settings in application/config/database.php.
    </code>

    <div class="footer-note">CodeIgniter Error Handler • <?= date('Y') ?></div>
</div>

</body>
</html>
