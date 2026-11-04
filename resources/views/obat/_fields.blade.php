@php($i = $item ?? null)

<fieldset class="section">
    <legend><span class="step">1</span> Data Obat</legend>
    <div class="grid">
                <x-field name="kode_obat" label="Kode Obat" type="text" placeholder="Contoh: OBT-001" :value="$i?->kode_obat" hint="Kode unik tiap obat, tidak boleh sama." />
                <x-field name="nama_obat" label="Nama Obat" type="text" placeholder="Contoh: Paracetamol 500 mg" :value="$i?->nama_obat" />
                <x-field name="stok" label="Stok Obat" type="number" placeholder="Jumlah stok" :value="$i?->stok" min="0" max="100000" inputmode="numeric" />
                <x-field name="tanggal_kadaluarsa" label="Tanggal Kadaluarsa / Expired" type="date" placeholder="" :value="$i?->tanggal_kadaluarsa?->format('Y-m-d')" />
    </div>
    <p class="note">Kode obat diisi manual dan harus unik.</p>
</fieldset>
