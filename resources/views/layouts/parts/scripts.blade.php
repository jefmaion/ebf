<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>


        window.addEventListener('theme-updated', (params) => {
            document.documentElement.setAttribute('data-bs-theme', params.detail.theme)
        });

        window.addEventListener('show-modal', (params) => {
            return getModal(params.detail.modal).show()
        });
        window.addEventListener('hide-modal', (params) => {
            return getModal(params.detail.modal).hide()
        });

        function getModal(modal) {
            return tabler.bootstrap.Modal.getOrCreateInstance('#' + modal)
        }

        window.addEventListener('show-modal-delete', (params) => {
            return getModal('modal-delete').show()
        });

        window.addEventListener('hide-modal-delete', (params) => {
            return getModal('modal-delete').hide()
        });

            // const qrModal = document.getElementById('qrModal');

            // qrModal.addEventListener('shown.bs.modal', () => {
            //     startScanner();
            // });

            // qrModal.addEventListener('hidden.bs.modal', () => {
            //     stopScanner();
            // });


            window.addEventListener('flash-message', (params) => {
                const flash = document.getElementById('alert-message');
                if (flash) {
                    flash.style.display = 'block';
                    setTimeout(() => {
                        flash.style.display = 'none';
                    }, 3000); // Oculta após 3 segundos
                }
            });

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


     function stopScanner() {
        if (scanner) {
            scanner.stop().then(() => {
                // Limpa o canvas/conteúdo gerado pela biblioteca no HTML
                scanner.clear(); 
                // Reseta a variável global para nulo
                scanner = null;
                console.log("Câmera desligada com sucesso.");
            }).catch((err) => {
                console.error("Erro ao desligar a câmera:", err);
            });
        }
    }

        
   window.addEventListener('show-modal', (event) => {

        if (event.detail.modal !== 'qrModal') {
            return;
        }

        // stopScanner();
        startScanner();
        // // Aguarda o modal abrir
        // setTimeout(() => {
        //     startScanner();
        // }, 100);

    });

window.addEventListener('hide-modal', (event) => {
    

    if (event.detail.modal !== 'qrModal') {
        return;
    }
    stopScanner();

});



    </script>
@yield('scripts')
