@extends('layout')
@section('content')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <div class="cards-about">
        <div class="cards-header">
            <h1>Verifikacija črtnih kod</h1>
        </div>
        <div class="cards-table">
            <table class="table">
                <tr>
                    <th>
                        <div class="qr-reader">
                            <div id="qr-reader" style="width:500px"></div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td><div id="qr-reader-results"></div></td>
            </table>
        </div>
        <script>
            function docReady(fn) {
                // see if DOM is already available
                if (document.readyState === "complete" || document.readyState === "interactive") {
                    // call on next available tick
                    setTimeout(fn, 1);
                } else {
                    document.addEventListener("DOMContentLoaded", fn);
                }
            }

            docReady(function() {
                var resultContainer = document.getElementById('qr-reader-results');
                var currentDomain = window.location.origin;

                function onScanSuccess(decodedText, decodedResult) {
                    if (decodedText.startsWith(currentDomain)) {
                        var url = new URL(decodedText);
                        var cid = url.searchParams.get("cid");
                        var uid = url.searchParams.get("uid");
                        var verifyId = url.searchParams.get("verifyId");

                        if (cid && uid && verifyId) {
                            resultContainer.innerHTML =
                                `CID: ${cid}, UID: ${uid}, VerifyID: ${verifyId} <a class="btn-add-card" href="/card-verify/${cid}/${uid}/${verifyId}">Preveri kartico</a>`;
                        } else {
                            resultContainer.innerHTML = `Nepopolni ali neveljavni parametri.`;
                        }
                    } else {
                        resultContainer.innerHTML = `URL se ne ujema z domeno ${currentDomain}.`;
                    }
                }

                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", {
                        fps: 10,
                        qrbox: 250
                    });
                html5QrcodeScanner.render(onScanSuccess);
            });
        </script>
    </div>
@endsection
