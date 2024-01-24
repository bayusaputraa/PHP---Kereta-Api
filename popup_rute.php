<!-- popup_rute.php -->
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalRuteLabel">Daftar Rute</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Isi dengan tabel rute -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Kode Rute</th>
                        <th scope="col">Stasiun Asal</th>
                        <th scope="col">Stasiun Tujuan</th>
                        <th scope="col">Jarak (KM)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rute akan dimuat melalui AJAX di load_rute.php -->
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
