<div>

    <div id="reader" style="width:100%"></div>

    <div class="alert alert-success mt-3">

        QR Code:

        <strong>{{ $code }}</strong>

    </div>

</div>

@script

<script>

let scanner = null;

function beep(duration = 150, frequency = 900, volume = 0.5){

    const ctx = new AudioContext();

    const osc = ctx.createOscillator();
    const gain = ctx.createGain();

    osc.connect(gain);
    gain.connect(ctx.destination);

    osc.frequency.value = frequency;
    gain.gain.value = volume;

    osc.start();

    setTimeout(() => {
        osc.stop();
        ctx.close();
    }, duration);
}

function startScanner(){

    scanner = new Html5Qrcode("reader");

    scanner = new Html5Qrcode("reader");

scanner.start(
    { facingMode: "environment" },
    {
        fps: 10,
        qrbox: { width: 250, height: 250 },
        formatsToSupport: [
            Html5QrcodeSupportedFormats.QR_CODE
        ]
    },
    (decodedText, decodedResult) => {
        console.log("QR detectado:", decodedText);

        scanner.stop();
        beep();

        $wire.qrCodeRead(decodedText);
    },
    (error) => {
        // ignorar erros de frame
    }
);

}

startScanner();

</script>

@endscript
