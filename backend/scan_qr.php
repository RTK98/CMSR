<video id="scan_job" height="200" width="285"></video>

<button type="button" onclick="scanjob()">Scan</button>

<script src="assets/qr_scanner/instascan.min.js"></script>
<script>
    function scanjob() {
        let scanner = new Instascan.Scanner({video: document.getElementById('scan_job')});
        scanner.addListener('scan', function (content) {
            alert(content);
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
        }
</script>














<!--<video id="appointment" height="200" width="285"></video>

<button type=""button onclick="appointment()">Scan</button>

<script src="assets/qr_scanner/instascan.min.js"></script>

<script>

    function appointment() {
    let scanner = new Instascan.Scanner({video: document.getElementById('appointment')});
            scanner.addListner('scan', function (content) {
            alert(content);
            });
            Instascan.Camera.getCameras().then(function(cameras){
    if (cameras.length > 0){
    scanner.start(cameras[0]);
    } else{
    console.error('NO Camera Found.');
    }
    )}.catch (function (e) {
    console.error(e);
            )};
    }

</script>-->