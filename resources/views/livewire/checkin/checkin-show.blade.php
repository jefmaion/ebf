<div wire:ignore.self class="modal modal-blur fade" id="modal-show-checkin" tabindex="-1" role="dialog"
    aria-hidden="true">
    @if($register)
    <div class="modal-dialog modasl-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            @if(!$takePhoto)
            <div class="modal-body text-center">

                
                <div class="row">
                    <div class="col-12">
                        <span class="avatar avatar-xl" style="background-image: url({{ asset('storage/' . $register->photo) }})"> </span>
                    </div>
                    <div class="col-12">
                        <h1>{{ $register->childname }}</h1>
                        <p class="text-muted">{{ $register->childage }} anos ({{ $register->childbirthdate->format('d/m/Y') }})</p>
                    </div>
                </div>
                
            </div>

            <div class="modal-body text-center">
                @if(!empty($register->food_restriction))
                <p><strong>Restrição alimentar: </strong>{{ $register->food_restriction }}</p>
                @endif
            </div>
            @endif
            
            <!-- Área da Câmera / Foto Capturada -->
            <div class="{{ ($takePhoto) ? '' : 'd-none' }}">
            <div class="col-md-6 text-center " wire:ignore>
                <div  style="position: relative; width: 100%; max-width: 320px; margin: 0 auto;">
                    <!-- Elemento de Vídeo da Webcam -->
                    <video id="webcam" autoplay playsinline width="100%" style="border-radius: 8px; border: 2px solid #ddd; background: #000; transform: scaleX(-1);"></video>
                    
                    <!-- Canvas oculto para capturar a foto -->
                    <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
                </div>
                <!-- Botão para Capturar a Imagem -->
                <button type="button" id="btn-capturar-foto" class="btn btn-outline-secondary btn-sm mt-2">
                    📸 Tirar Foto
                </button>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn" wire:click="getPhoto()">Tirar Foto</button>
                <button type="button" class="btn  btn-primary" wire:click="doCheckin()">Realizar Check{{ $type == 'checkin' ? 'In' : 'Out' }}</button>
            </div>
        </div>
    </div>
    @endif
    <script>
        document.addEventListener('livewire:init', () => {
            const modalElement = document.getElementById('modal-show-checkin');
            let stream = null;

            // Evento disparado quando o Bootstrap abre o modal
            modalElement.addEventListener('shown.bs.modal', async () => {
                const video = document.getElementById('webcam');
                const btnCapturar = document.getElementById('btn-capturar-foto');
                const canvas = document.getElementById('canvas');

                if (!video) return;

                try {
                    // Liga a câmera frontal/webcam padrão
                    stream = await navigator.mediaDevices.getUserMedia({ 
                        video: { width: 640, height: 480, facingMode: "user" }, 
                        audio: false 
                    });
                    video.srcObject = stream;
                } catch (err) {
                    console.error("Erro ao acessar a câmera: ", err);
                    alert("Não foi possível acessar a câmera do dispositivo.");
                }

                // Configura o evento do botão de tirar foto
                btnCapturar.onclick = () => {
                    const context = canvas.getContext('2d');
                    
                    // Aplica o efeito espelho no canvas igual ao vídeo para a foto não sair invertida
                    context.translate(canvas.width, 0);
                    context.scale(-1, 1);
                    
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    
                    // Resgata o Base64 da imagem
                    const fotoBase64 = canvas.toDataURL('image/jpeg', 0.8);

                    // Altera a borda do vídeo para dar um feedback visual de "flash"
                    video.style.borderColor = '#2fb344';
                    setTimeout(() => video.style.borderColor = '#ddd', 300);

                    // Passa a foto diretamente para a propriedade pública do Livewire
                    @this.set('fotoCapturada', fotoBase64);

                    @this.setPhoto(fotoBase64);
                    @this.getPhoto();
                };
            });

            // Evento disparado quando o modal é fechado (desliga a câmera)
            modalElement.addEventListener('hidden.bs.modal', () => {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            });
        });
    </script>
</div>
