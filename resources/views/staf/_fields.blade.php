@php($i = $item ?? null)

<fieldset class="section">
    <legend><span class="step">1</span> Data Staf</legend>
    <div class="grid">
                <x-field name="nama" label="Nama" type="text" placeholder="Nama lengkap staf" :value="$i?->nama" />
                <div class="field field-full">
                    <label for="alamat">Alamat <span class="req">*</span></label>
                    <textarea id="alamat" name="alamat" rows="3" placeholder="Nama jalan, desa/kelurahan, kecamatan, kota"
                              class="@error('alamat') is-invalid @enderror">{{ old('alamat', $i?->alamat) }}</textarea>
                    @error('alamat')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>
                <x-field name="tanggal_lahir" label="Tanggal Lahir" type="date" placeholder="" :value="$i?->tanggal_lahir?->format('Y-m-d')" max="{{ now()->toDateString() }}" />
                <x-field name="tempat_lahir" label="Tempat Lahir" type="text" placeholder="Contoh: Lhokseumawe" :value="$i?->tempat_lahir" />
                <x-field name="no_hp" label="No HP" type="tel" placeholder="08xxxxxxxxxx" :value="$i?->no_hp" hint="Nomor aktif, 10 sampai 15 digit." maxlength="15" inputmode="numeric" data-digits />
    </div>
    <p class="note">Id Staff dibuat otomatis oleh sistem (auto increment) setelah data disimpan.</p>
</fieldset>
