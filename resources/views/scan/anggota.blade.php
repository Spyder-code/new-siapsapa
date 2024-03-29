<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan QR-Code</title>
</head>
<body>
    <a href="{{ url('/') }}">Kembali ke halaman utama</a>
    <div id="qr-reader" style="width:100%; height:100%"></div>
    <div id="qr-reader-results"></div>
</body>
{{-- <script src="/html5-qrcode.min.js"></script> --}}
{{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
<script src="{{asset('js/scan.js')}}"></script>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                window.location.href = decodedText;
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
</head>
</html>
