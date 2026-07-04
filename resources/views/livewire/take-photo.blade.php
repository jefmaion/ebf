<div>
    <x-modal.modal id="modal-take-photo">
        <div class="modal-content" style="overflow: hidden;">
            <div class="modal-header">
                <h5 class="modal-title">Fazer Checkin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Área da Câmera / Ocupa todo o body -->
            <div class="modal-body p-0" style="position: relative; background: #000; min-height: 400px; display: flex; align-items: center; justify-content: center;">

                <!-- Adicionado o wire:ignore diretamente no player de vídeo -->
                <div style="width: 100%; height: 100%;" wire:ignore>
                    <video id="webcam" autoplay muted playsinline
                    style="width: 100%; height: 100%; max-height: 550px; object-fit: cover;  min-height: 400px; display: block;">
                </video>
            </div>

            <!-- QUADRADO GUIA CENTRALIZADO -->
            <!-- Esse elemento flutua exatamente no centro do modal-body por cima do vídeo -->
            <div class="camera-focus-guide"></div>

            <!-- Canvas oculto para capturar a foto -->
            <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn w-50 btn-primary" id="btn-capturar-foto">Tirar Foto</button>
        </div>
    </x-modal.modal>

    <style>
        .camera-focus-guide {
            position: absolute;
            /* Define o tamanho do quadrado guia */
            width: 260px;
            height: 260px;

            /* Cria uma borda pontilhada/tracejada verde estilo alvo */
            border: 3px dashed #2fb344;
            border-radius: 16px;

            /* Garante o alinhamento perfeito no centro do container */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            /* Adiciona uma sombra interna leve para destacar o rosto */
            box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.4);

            /* Impede que o clique do mouse no quadrado atrapalhe o HTML */
            pointer-events: none;
            z-index: 10;
        }

        /* Efeito opcional: Deixa os cantos ligeiramente iluminados */
        .camera-focus-guide::before {
            content: '';
            position: absolute;
            top: -10px; left: -10px; right: -10px; bottom: -10px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 22px;
        }
    </style>

    <script>
        document.addEventListener('livewire:init', () => {
            const modalElement = document.getElementById('modal-take-photo');
            let stream = null;

            modalElement.addEventListener('shown.bs.modal', () => {
                // Aguarda 250ms (tempo exato do fade do Bootstrap) para dar o start na câmera
                setTimeout(async () => {
                    const video = document.getElementById('webcam');
                    const btnCapturar = document.getElementById('btn-capturar-foto');
                    const canvas = document.getElementById('canvas');

                    if (!video) return;

                    try {
                        // Solicita permissão ao hardware da webcam
                        stream = await navigator.mediaDevices.getUserMedia({
                            video: {
                                width: { ideal: 1280 },
                                height: { ideal: 720 },
                                facingMode: { ideal: "environment" }
                            },
                            audio: false
                        });

                        video.srcObject = stream;

                        // Garante que o player rode depois que o stream foi injetado
                        await video.play();
                    } catch (err) {
                        console.error("Erro ao acessar a câmera: ", err);
                        alert("Não foi possível ativar a câmera. Verifique se o site roda em 'localhost' ou possui 'https://'.");
                    }

                    // Configura o evento do botão de capturar a foto
                    btnCapturar.onclick = () => {
                       if (!stream) return;

                       const context = canvas.getContext('2d');

                // 1. Descobre o tamanho real do vídeo sendo exibido na tela
                       const videoWidth = video.videoWidth;
                       const videoHeight = video.videoHeight;

                // 2. Define o tamanho do quadrado de corte proporcional ao tamanho real do vídeo
                // Como o vídeo geralmente é 640x480, vamos cortar um quadrado baseado na menor dimensão (altura)
                const tamanhoCorte = Math.min(videoWidth, videoHeight) * 0.6; // 60% da menor dimensão

                // 3. Calcula as coordenadas X e Y do topo esquerdo do quadrado no vídeo real
                const sx = (videoWidth - tamanhoCorte) / 2;
                const sy = (videoHeight - tamanhoCorte) / 2;

                // 4. Ajusta o tamanho do Canvas para ser um quadrado perfeito (ex: 400x400 pixels limpos)
                canvas.width = 400;
                canvas.height = 400;

                // 5. Aplica o efeito espelho para a foto não sair invertida
                //context.translate(canvas.width, 0);
                //context.scale(-1, 1);

                // 6. O segredo do Crop: drawImage com 9 parâmetros
                // drawImage(imagem, sx, sy, sWidth, sHeight, dx, dy, dWidth, dHeight)
                context.drawImage(
                    video,
                    sx, sy, tamanhoCorte, tamanhoCorte, // Área de origem (o miolo do vídeo)
                    0, 0, canvas.width, canvas.height   // Área de destino (o canvas quadrado)
                    );

                // 7. Resgata o Base64 da imagem já recortada e quadrada
                const fotoBase64 = canvas.toDataURL('image/jpeg', 0.85);

                // Feedback rápido de flash
                video.style.opacity = '0.3';
                setTimeout(() => video.style.opacity = '1', 150);

                // Envia a foto quadrada para o backend do Livewire
                @this.setPhoto(fotoBase64);
            };
        }, 50);
            });

            // Desliga a câmera e o led físico assim que iniciar o fechamento do modal
            modalElement.addEventListener('hide.bs.modal', () => {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
                const video = document.getElementById('webcam');
                if (video) video.srcObject = null;
            });
        });
    </script>
</div>
