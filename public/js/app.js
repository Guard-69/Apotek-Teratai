(function () {
  'use strict';

  // Menu navigasi (mobile)
  var toggle = document.getElementById('navToggle');
  var menu = document.getElementById('navMenu');
  if (toggle && menu) {
    toggle.addEventListener('click', function () {
      var open = menu.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  // Tombol tutup notifikasi
  document.querySelectorAll('[data-dismiss]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var alert = btn.closest('.alert');
      if (alert) { alert.remove(); }
    });
  });

  // Notifikasi sukses hilang otomatis
  var flash = document.querySelector('.alert[data-autohide]');
  if (flash) {
    setTimeout(function () {
      flash.classList.add('fade-out');
      setTimeout(function () { flash.remove(); }, 400);
    }, 8000);
  }

  // Input angka saja (NIK, No HP)
  document.querySelectorAll('input[data-digits]').forEach(function (input) {
    input.addEventListener('input', function () {
      var clean = input.value.replace(/\D/g, '');
      if (clean !== input.value) { input.value = clean; }
    });
  });

  // Pratinjau foto + validasi di sisi browser
  var foto = document.getElementById('foto');
  if (foto) {
    var box = document.getElementById('fotoPreview');
    var err = document.getElementById('fotoError');
    var semula = box.innerHTML; // isi awal (foto saat ini pada halaman edit)

    var resetPreview = function () {
      box.innerHTML = semula;
    };

    foto.addEventListener('change', function () {
      err.textContent = '';
      var file = foto.files[0];
      if (!file) { resetPreview(); return; }

      if (['image/jpeg', 'image/png'].indexOf(file.type) === -1) {
        err.textContent = 'Format foto harus JPG atau PNG.';
        foto.value = '';
        resetPreview();
        return;
      }
      if (file.size > 2 * 1024 * 1024) {
        err.textContent = 'Ukuran foto maksimal 2 MB.';
        foto.value = '';
        resetPreview();
        return;
      }

      var img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.alt = 'Pratinjau foto';
      box.innerHTML = '';
      box.appendChild(img);
    });
  }

  // Status loading pada tombol kirim (mencegah klik ganda)
  var setLoading = function (form, text) {
    var btn = form.querySelector('button[type=submit]');
    if (!btn) { return; }
    var label = btn.querySelector('.btn-label');
    if (label) {
      btn.dataset.label = label.textContent;
      label.textContent = text;
    }
    btn.disabled = true;
    btn.classList.add('is-loading');
  };

  document.querySelectorAll('form[data-loading]').forEach(function (form) {
    form.addEventListener('submit', function () { setLoading(form, 'Menyimpan...'); });
  });

  // Dialog konfirmasi hapus
  var dialog = document.getElementById('deleteDialog');
  if (dialog && typeof dialog.showModal === 'function') {
    var delForm = document.getElementById('deleteForm');
    var delName = document.getElementById('deleteName');

    document.querySelectorAll('[data-delete]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        delForm.setAttribute('action', btn.getAttribute('data-delete'));
        delName.textContent = btn.getAttribute('data-name') || '';
        dialog.showModal();
      });
    });

    dialog.querySelectorAll('[data-close]').forEach(function (btn) {
      btn.addEventListener('click', function () { dialog.close(); });
    });

    // Klik di area gelap (backdrop) menutup dialog
    dialog.addEventListener('click', function (e) {
      if (e.target === dialog) { dialog.close(); }
    });

    delForm.addEventListener('submit', function () { setLoading(delForm, 'Menghapus...'); });
  }

  // Pulihkan tombol bila halaman dibuka lewat tombol "Kembali" browser
  window.addEventListener('pageshow', function (e) {
    if (!e.persisted) { return; }
    document.querySelectorAll('button.is-loading').forEach(function (btn) {
      btn.disabled = false;
      btn.classList.remove('is-loading');
      var label = btn.querySelector('.btn-label');
      if (label && btn.dataset.label) { label.textContent = btn.dataset.label; }
    });
  });
})();
