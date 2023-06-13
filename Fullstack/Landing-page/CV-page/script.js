document.getElementById('cvForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Mencegah formulir dikirimkan secara default

  var nama = document.getElementById('nama').value;
  var posisi = document.getElementById('posisi').value;
  var email = document.getElementById('email').value;
  var social = document.getElementById('social').value;
  var telp = document.getElementById('telp').value;
  var alamat = document.getElementById('alamat').value;
  var ringkasan = document.getElementById('ringkasan').value;
  var pendidikan = document.getElementById('pendidikan').value;
  var tahun = document.getElementById('tahun').value;
  var keteranganPendidikan = document.getElementById('keterangan_pendidikan').value;
  var pendidikanKedua = document.getElementById('pendidikan_2').value;
  var tahunPendidikanKedua = document.getElementById('tahun_2').value;
  var keteranganPendidikanKedua = document.getElementById('keterangan_pendidikan_2').value;
  var tempatKerja = document.getElementById('tempat_kerja').value;
  var posisiKerja = document.getElementById('posisi_kerja').value;
  var tahunKerja = document.getElementById('tahun_kerja').value;
  var keteranganKerja = document.getElementById('keterangan_kerja').value;
  var cvData = {
    nama: nama,
    posisi: posisi,
    email: email,
    social: social,
    telp: telp,
    alamat: alamat,
    ringkasan: ringkasan,
    pendidikan: pendidikan,
    tahun: tahun,
    keterangan_pendidikan: keteranganPendidikan,
    pendidikan_2: pendidikanKedua,
    tahun_2: tahunPendidikanKedua,
    keterangan_pendidikan_2: keteranganPendidikanKedua,
    tempat_kerja: tempatKerja,
    posisi_kerja: posisiKerja,
    tahun_kerja: tahunKerja,
    keterangan_kerja: keteranganKerja,
  };
  var cvHTML = generateCV(cvData);
  document.getElementById('hasilCV').innerHTML = cvHTML;
});

function generateCV(data) {
  var cvHTML = `
  <div class="cv-container">
      <h2>${data.nama}</h2>
      <h3>${data.posisi}</h3>
      <div class="contact-details">
      <i class="fas fa-home"></i> ${data.alamat}
      <i class="fab fa-whatsapp"></i> ${data.telp}
      <i class="fa fa-envelope"></i> ${data.email}
      ${data.social ? `<i class="fas fa-link"></i> ${data.social}` : ''}
    </div>
  </div>
  <h3 class="section-title">RINGKASAN</h3>
  <div>${data.ringkasan}</div>
  <h3 class="section-title">PENDIDIKAN</h3>
  <div class="education-info">
    <div>${data.pendidikan} | ${data.tahun}</div>
    <div>${data.keterangan_pendidikan}</div>
  </div>
  <div class="education-info">
    <div>${data.pendidikan_2} | ${data.tahun_2}</div>
    <div>${data.keterangan_pendidikan_2}</div>
  </div>
  <h3 class="section-title">PENGALAMAN</h3>
  <div class="work-experience">
    <div>${data.tempat_kerja}</div>
    <div>${data.posisi_kerja} | ${data.tahun_kerja}</div>
    <div>${data.keterangan_kerja}</div>
  </div>
  `;
  return cvHTML;
}
