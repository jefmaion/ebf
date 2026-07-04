<x-modal.modal id="qrModal">

    <div class="modal-body">
        <div id="qr-message" class="alert alert-danger d-none">
            QR Code inválido
        </div>
        <div
            id="reader"
            wire:ignore
            style="width:100%"
        ></div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn me-auto" wire:click="close">
            Fechar
        </button>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {

            let scanner = null;
            let isScanning = false;

            function beep(duration = 150, frequency = 900, volume = 0.5) {
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

            function startScanner() {

                if (isScanning) return;

                scanner = new Html5Qrcode("reader");
                isScanning = true;

                scanner.start(
                    { facingMode: "environment" },
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 },
                        formatsToSupport: [
                            Html5QrcodeSupportedFormats.QR_CODE
                        ]
                    },
                    (decodedText) => {


                            beep();

                            Livewire.dispatch('qr-code-read', {
                                code: decodedText
                            });

                    },
                    (error) => {
                        // ignorar erros de frame
                    }
                );
            }

            function stopScanner() {
                if (!scanner) return;

                scanner.stop().then(() => {
                    scanner.clear();
                    scanner = null;
                    isScanning = false;
                    console.log("Scanner parado");
                }).catch(err => {
                    console.error("Erro ao parar scanner:", err);
                });
            }

            window.addEventListener('show-modal', (event) => {
                if (event.detail.modal !== 'qrModal') return;

                setTimeout(() => {
                    startScanner();
                }, 300);
            });

            window.addEventListener('hide-modal', (event) => {
                if (event.detail.modal !== 'qrModal') return;

                stopScanner();
            });

            window.addEventListener('qr-invalid', () => {

                beep(200, 500);

                const el = document.getElementById('qr-message');

                el.innerText = 'QR Code inválido';
                el.classList.remove('d-none');

                setTimeout(() => {
                    el.classList.add('d-none');
                }, 5000);
            });
        });
    </script>

</x-modal.modal>
