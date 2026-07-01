<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.modal').forEach(function(modal) {
                modal.addEventListener('shown.bs.modal', function () {
                    modal.querySelectorAll('.ts').forEach(function(el) {
                        if (el.tomselect) {
                el.tomselect.destroy(); // remove instância antiga
            }
       console.log(el)
                            new TomSelect(el, {
                                copyClassesToDropdown: true,
                                // dropdownParent: el.closest('.tom-select'),
                                sortField: {
                                    field: "text",
                                    direction: "asc"
                                }
                            });
                    });
                });
            });
        });

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

            window.addEventListener('flash-message', (params) => {
                const flash = document.getElementById('alert-message');
                if (flash) {
                    flash.style.display = 'block';
                    setTimeout(() => {
                        flash.style.display = 'none';
                    }, 3000); // Oculta após 3 segundos
                }
            });



    </script>
@yield('scripts')
