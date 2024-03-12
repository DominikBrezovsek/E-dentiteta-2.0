@extends('layout')
@section('content')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <td>
                        <div id="qr-reader-results"></div>
                    </td>
            </table>
        </div>
        @if(session('user')->role = 'VEN')
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

            function verifyCard() {
                var decodedText = document.getElementById('verify-button').value;
                var url = new URL(decodedText);
                var cid = url.searchParams.get("cid");
                var uid = url.searchParams.get("uid");
                var verifyId = url.searchParams.get("verifyId");

                fetch('/vendor/verify/verify-card', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            cid: cid,
                            uid: uid,
                            verifyId: verifyId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            // Zapis obstaja
                            Swal.fire({
                                title: 'Uporabnik obstaja',
                                text: 'Uporabnik z imenom ' + data.data.name + ', priimkom ' + data.data.surname +
                                    ' in EMŠOM ' + data.data.emso + ' je bil uspešno preverjen.',
                                icon: 'success',
                            })
                        } else {
                            // Zapis ne obstaja
                            Swal.fire({
                                title: 'Uporabnik s takšno verifikacijo ne obstaja',
                                text: `V podatkovni bazi ne obstaja takšen zapis verifikacijske QR kode.`,
                                icon: 'error',
                            })
                        }
                    })
                    .catch(error => {
                        console.error('Napaka:', error);
                        // Display error message to the user
                        Swal.fire({
                            title: 'Napaka',
                            text: 'Prišlo je do napake pri poizvedbi.' + error,
                            icon: 'error',
                        });
                    });
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
                                `CID: ${cid}, UID: ${uid}, VerifyID: ${verifyId} <button class="btn-add-card" onclick="verifyCard()" id="verify-button" value="${decodedText}">Preveri veljavnost kartice</button>`;
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
        @elseif(session('user')->role  == 'OAD')
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

            function verifyCard() {
                var decodedText = document.getElementById('verify-button').value;
                var url = new URL(decodedText);
                var cid = url.searchParams.get("cid");
                var uid = url.searchParams.get("uid");
                var verifyId = url.searchParams.get("verifyId");

                fetch('/organisation_admin/verify/verify-card', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            cid: cid,
                            uid: uid,
                            verifyId: verifyId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            // Zapis obstaja
                            Swal.fire({
                                title: 'Uporabnik obstaja',
                                text: 'Uporabnik z imenom ' + data.data.name + ', priimkom ' + data.data.surname +
                                    ' in EMŠOM ' + data.data.emso + ' je bil uspešno preverjen.',
                                icon: 'success',
                            })
                        } else if (data.error) {
                            // Zapis ne obstaja
                            Swal.fire({
                                title: 'Uporabnik s takšno verifikacijo ne obstaja',
                                text: `V podatkovni bazi ne obstaja takšen zapis verifikacijske QR kode, ki bi pripadal vaši organizaciji.`,
                                icon: 'error',
                            })
                        }
                        
                        else {
                            // Zapis ne obstaja
                            Swal.fire({
                                title: 'Uporabnik s takšno verifikacijo ne obstaja',
                                text: `V podatkovni bazi ne obstaja takšen zapis verifikacijske QR kode.`,
                                icon: 'error',
                            })
                        }
                    })
                    .catch(error => {
                        console.error('Napaka:', error);
                        // Display error message to the user
                        Swal.fire({
                            title: 'Napaka',
                            text: 'Prišlo je do napake pri poizvedbi.' + error,
                            icon: 'error',
                        });
                    });
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
                                `CID: ${cid}, UID: ${uid}, VerifyID: ${verifyId} <button class="btn-add-card" onclick="verifyCard()" id="verify-button" value="${decodedText}">Preveri veljavnost kartice</button>`;
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
        @elseif(session('user')->role  == 'ADM')
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

            function verifyCard() {
                var decodedText = document.getElementById('verify-button').value;
                var url = new URL(decodedText);
                var cid = url.searchParams.get("cid");
                var uid = url.searchParams.get("uid");
                var verifyId = url.searchParams.get("verifyId");

                fetch('/verify/verify-card', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            cid: cid,
                            uid: uid,
                            verifyId: verifyId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            // Zapis obstaja
                            Swal.fire({
                                title: 'Uporabnik obstaja',
                                text: 'Uporabnik z imenom ' + data.data.name + ', priimkom ' + data.data.surname +
                                    ' in EMŠOM ' + data.data.emso + ' je bil uspešno preverjen.',
                                icon: 'success',
                            })
                        } else {
                            // Zapis ne obstaja
                            Swal.fire({
                                title: 'Uporabnik s takšno verifikacijo ne obstaja',
                                text: `V podatkovni bazi ne obstaja takšen zapis verifikacijske QR kode.`,
                                icon: 'error',
                            })
                        }
                    })
                    .catch(error => {
                        console.error('Napaka:', error);
                        // Display error message to the user
                        Swal.fire({
                            title: 'Napaka',
                            text: 'Prišlo je do napake pri poizvedbi.' + error,
                            icon: 'error',
                        });
                    });
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
                                `CID: ${cid}, UID: ${uid}, VerifyID: ${verifyId} <button class="btn-add-card" onclick="verifyCard()" id="verify-button" value="${decodedText}">Preveri veljavnost kartice</button>`;
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
        @elseif(session('user')->role  == 'PRF')
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

            function verifyCard() {
                var decodedText = document.getElementById('verify-button').value;
                var url = new URL(decodedText);
                var cid = url.searchParams.get("cid");
                var uid = url.searchParams.get("uid");
                var verifyId = url.searchParams.get("verifyId");

                fetch('/professor/verify/verify-card', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            cid: cid,
                            uid: uid,
                            verifyId: verifyId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            // Zapis obstaja
                            Swal.fire({
                                title: 'Uporabnik obstaja',
                                text: 'Uporabnik z imenom ' + data.data.name + ', priimkom ' + data.data.surname +
                                    ' in EMŠOM ' + data.data.emso + ' je bil uspešno preverjen.',
                                icon: 'success',
                            })
                        } else if (data.error) {
                            // Zapis ne obstaja
                            Swal.fire({
                                title: 'Uporabnik s takšno verifikacijo ne obstaja',
                                text: `V podatkovni bazi ne obstaja takšen zapis verifikacijske QR kode, ki bi pripadal vašemu oddelku.`,
                                icon: 'error',
                            })
                        }
                        
                        else {
                            // Zapis ne obstaja
                            Swal.fire({
                                title: 'Uporabnik s takšno verifikacijo ne obstaja',
                                text: `V podatkovni bazi ne obstaja takšen zapis verifikacijske QR kode.`,
                                icon: 'error',
                            })
                        }
                    })
                    .catch(error => {
                        console.error('Napaka:', error);
                        // Display error message to the user
                        Swal.fire({
                            title: 'Napaka',
                            text: 'Prišlo je do napake pri poizvedbi.' + error,
                            icon: 'error',
                        });
                    });
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
                                `CID: ${cid}, UID: ${uid}, VerifyID: ${verifyId} <button class="btn-add-card" onclick="verifyCard()" id="verify-button" value="${decodedText}">Preveri veljavnost kartice</button>`;
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
        @endif
    </div>
@endsection
