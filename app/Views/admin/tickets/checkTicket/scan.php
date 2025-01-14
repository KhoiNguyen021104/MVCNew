<style>
    #reader {
        width: 80%;
        margin: auto;
    }

    #html5-qrcode-button-camera-start,
    #html5-qrcode-button-camera-stop,
    #html5-qrcode-button-file-selection {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 8px;
    }
    #html5-qrcode-button-camera-stop {
        background-color: red;
    }

    #html5-qrcode-anchor-scan-type-change {
        text-decoration: none !important;
        color:cadetblue;
    }
</style>
<?php 
getSmg();
?>
<h1 class="text-center h-100 mt-3 text-primary">Quét mã vé</h1>
<div id="reader"></div>
<p id="result" class="text-center h-100 mt-3 text-primary"></p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        document.getElementById('result').innerText = `Kết quả giải mã QR Code: ${decodedText}`;
        window.location.href = "<?php echo _HOST_PATH_ ?>" + "/admin/CheckTicket/handleQrCode?" + `${decodedText}`;
    }

    function onScanError(errorMessage) {
        console.error(`Error scanning: ${errorMessage}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 350
        });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>