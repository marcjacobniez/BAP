<?php 
include 'header.php'; 
include 'check_permission.php';

if (!isset($_SESSION['account_id']) || !checkAccess($conn, $_SESSION['account_id'], 'qr_verify')) {
    header("Location: login.php");
    echo "<script>alert('You do not have permission to access the QR scanner.');</script>";
    exit();
}
?>
<html>
<head>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="qr-verification">
        <h2>QR Code Scanner</h2>
        <div class="scanner-container">
            <div id="reader"></div>
            <div class="scan-result" id="scanResult" style="display: none;">
                <h3>Verification Result</h3>
                <div class="result-content" id="resultContent"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
    function onScanSuccess(decodedText, decodedResult) {
        html5QrcodeScanner.clear();
        
        fetch('verify_qr.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'qr_data=' + encodeURIComponent(decodedText)
        })
        .then(response => response.json())
        .then(data => {
            const resultElement = document.getElementById('resultContent');
            const resultContainer = document.getElementById('scanResult');
            resultContainer.style.display = 'block';
            resultElement.innerHTML = data.message.replace(/\n/g, '<br>');
            resultElement.className = 'result-content ' + data.status;
            
            const restartButton = document.createElement('button');
            restartButton.textContent = 'Scan Another';
            restartButton.className = 'restart-button';
            restartButton.onclick = function() {
                location.reload();
            };
            resultElement.appendChild(document.createElement('br'));
            resultElement.appendChild(document.createElement('br'));
            resultElement.appendChild(restartButton);
        })
        .catch(error => {
            console.error('Error:', error);
            const resultElement = document.getElementById('resultContent');
            resultElement.textContent = 'Error processing QR code';
            resultElement.className = 'result-content error';
        });
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { 
            fps: 10, 
            qrbox: { width: 250, height: 250 },
            rememberLastUsedCamera: true
        }
    );
    html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>