{{-- Dialog konfirmasi hapus. Dibuka oleh tombol dengan atribut data-delete (lihat public/js/app.js) --}}
<dialog class="dialog" id="deleteDialog" aria-labelledby="deleteTitle">
    <form method="POST" id="deleteForm" action="">
        @csrf
        @method('DELETE')
        <div class="dialog-icon">&#128465;</div>
        <h2 id="deleteTitle">Hapus data?</h2>
        <p>Data <strong id="deleteName"></strong> akan dihapus permanen dan tidak bisa dikembalikan.</p>
        <div class="dialog-actions">
            <button type="button" class="btn btn-ghost" data-close>Batal</button>
            <button type="submit" class="btn btn-danger"><span class="btn-label">Ya, Hapus</span></button>
        </div>
    </form>
</dialog>
