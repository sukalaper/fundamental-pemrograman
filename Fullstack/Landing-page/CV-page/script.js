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
    pengalaman: pengalamanData
  };
  var cvHTML = generateCV(cvData);
  document.getElementById('hasilCV').innerHTML = cvHTML;
});
function generateCV(data) {
  var cvHTML = `
    <div style="line-height: 10px;">
      <h2 style="color: #213555; text-transform: uppercase;">${data.nama}</h2>
      <h3 style="color: #213555;">${data.posisi}</h3>
      <i class="fas fa-home"></i> ${data.alamat} <i class="fab fa-whatsapp" style="padding-left: 3px;"></i> ${data.telp} <i class="fa fa-envelope" style="padding-left: 3px;"></i> ${data.email} ${data.social ? `<i class="fas fa-link" style="padding-left: 3px;"></i> ${data.social}` : ''} 
    </div>
    <h3 style="margin-top: 35px; padding: 6px; letter-spacing: 3px; color: #FBFBFB; background-color: #213555;">RINGKASAN</h3>
    <p>${data.ringkasan}</p>
    <h3 style="margin-top: 35px; padding: 6px; letter-spacing: 3px; color: #FBFBFB; background-color: #213555;">PENDIDIKAN</h3>
    <div style="text-transform: uppercase; font-weight: bold;">
      ${data.pendidikan} | ${data.tahun}
    </div>
    <div>${data.keterangan_pendidikan}</div>
    <div style="text-transform: uppercase; font-weight: bold; margin-top: 10px;">
      ${data.pendidikan_2} | ${data.tahun_2}
    </div>
    <div>${data.keterangan_pendidikan_2}</div>
    <h3 style="margin-top: 35px; padding: 6px; letter-spacing: 3px; color: #FBFBFB; background-color: #213555;">PENGALAMAN</h3>
  `;
  return cvHTML;
}
