<div wire:ignore.self class="modal" id="qrModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modasl-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="reader" style="width:100%"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>

            </div>
        </div>
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
                console.log("QR detectado:", decodedResult);

                scanner.stop();
                beep();

                $wire.qrCodeRead(decodedText);
            },
            (error) => {
                // ignorar erros de frame
            }
        );

    }
   window.addEventListener('show-modal', (event) => {

    if (event.detail.modal !== 'qrModal') {
        return;
    }

    // Aguarda o modal abrir
    setTimeout(() => {
        startScanner();
    }, 100);

});

window.addEventListener('hide-modal', (event) => {

    if (event.detail.modal !== 'qrModal') {
        return;
    }

    stopScanner();

});
</script>

@endscript
