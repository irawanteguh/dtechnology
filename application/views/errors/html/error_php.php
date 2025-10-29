<style>
    .error-containerphp {
        font-family: "Inter", "Segoe UI", Roboto, sans-serif;
        color: #eaeaea;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .error-box {
		position: relative;
        z-index: 10;
        background: rgba(30,41,59,0.85);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 35px;
        width: 90%;
        max-width: 1400px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.5);
        border-left: 10px solid #ffb648;
        animation: fadeIn 0.7s ease-out;
        margin-bottom: 40px;
    }

    .error-box:hover {
        transform: translateY(-4px);
    }

    .error-title {
        font-size: 1.6rem;
        font-weight: 600;
        color: #ffb648;
        margin-bottom: 12px;
    }

    .error-meta p {
        margin: 4px 0;
        line-height: 1.5;
        color: #ccc;
        font-size: 14px;
    }

    .backtrace {
        background: rgba(10, 15, 30, 0.8);
        padding: 15px 20px;
        border-radius: 10px;
        margin-top: 12px;
        font-family: monospace;
        font-size: 13px;
        color: #ccc;
        overflow-x: auto;
		border-left: 3px solid #ffb648;
    }
</style>

<div class="error-containerphp">

    <div class="error-box">
        <div class="error-title">⚠️ A PHP Error was encountered</div>
        <div class="error-meta">
            <p><strong>Severity:</strong> <?php echo $severity; ?></p>
            <p><strong>Message:</strong> <?php echo $message; ?></p>
            <p><strong>Filename:</strong> <?php echo $filepath; ?></p>
            <p><strong>Line Number:</strong> <?php echo $line; ?></p>
        </div>

        <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
            <div class="backtrace">
                <strong>Backtrace:</strong><br>
                <?php foreach (debug_backtrace() as $error): ?>
                    <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
                        <div style="margin-top:10px;">
                            File: <?php echo $error['file'] ?><br>
                            Line: <?php echo $error['line'] ?><br>
                            Function: <?php echo $error['function'] ?>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
    </div>
</div>