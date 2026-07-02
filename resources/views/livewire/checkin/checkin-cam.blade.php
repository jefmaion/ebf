<div>
    <div id="reader" style="width:100%"></div>
        QR Code:

        <button type="button" name="" id="" class="btn btn-primary btn-lg w-100 mb-3" wire:click="$dispatch('start-scanner')">Ler QRCode</button>
        @if($register)
        <div class="card">
            <div class="modsal-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <span class="avatar avatar-xl"> {{ $register->id }} </span>
                        </div>
                        <div class="col-12 text-center">
                            <h1>{{ $register->childname }}</h1>
                            <p class="text-muted">{{ $register->childage }} anos - Gênero: {{ $register->childgender }}
                            </p>
                            <p class="text-muted"><strong>Responsável: </strong>{{ $register->name }}</p>
                        </div>
                    </div>
                    @if(!empty($register->food_restriction))
                    <p><strong>Restrição alimentar: </strong>{{ $register->food_restriction }}</p>
                    @endif
                </div>

                <div class="card-sfooter">


                </div>

            </div>
        </div>

        @if(empty($register->checkin_date))
                    <button type="button" name="" id="" class="btn btn-primary btn-lg w-100 mt-3" wire:click="doCheckin()">Realizar Checkin</button>
                    @else
                        <div class="alert alert-warning">Checkin Já Realizado</div>

                    @endif
        @endif

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

Livewire.on('start-scanner', () => {
    startScanner();
});

 startScanner();

</script>

@endscript
