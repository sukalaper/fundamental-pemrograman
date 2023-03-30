<?php

if (isset($_POST['ubah_aplikasi'])) {

    //Include file koneksi, untuk koneksikan ke database
    include '../../../config/database.php';
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");

        //Mengambil kiriman nilai
        $id=$_POST["id"];
        $nama_aplikasi=input($_POST["nama_aplikasi"]);
        $alamat=input($_POST["alamat"]);
        $provinsi=input($_POST["provinsi"]);
        $kabupaten=input($_POST["kabupaten"]);
        $email=input($_POST["email"]);
        $no_telp=input($_POST["no_telp"]);
        $website=input($_POST["website"]);
        $logo_sebelumnya=input($_POST["logo_sebelumnya"]);
        $logo = $_FILES['logo']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
        $x = explode('.', $logo);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];

        //Kondisi jika logo tidak kosong
        if (!empty($logo)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                //Mengupload logo yang baru
                move_uploaded_file($file_tmp, 'logo/'.$logo);

                //Menghapus logo sebelumya
                unlink("logo/".$logo_sebelumnya);
                
                $sql="update profil_aplikasi set
                nama_aplikasi='$nama_aplikasi',
                alamat='$alamat',
                provinsi='$provinsi',
                kabupaten='$kabupaten',
                email='$email',
                no_telp='$no_telp',
                website='$website',
                logo='$logo'
                where id=$id";

            }
        //Menjalankan query jika logo tidak diinputkan
        }else {
            $sql="update profil_aplikasi set
            nama_aplikasi='$nama_aplikasi',
            alamat='$alamat',
            provinsi='$provinsi',
            kabupaten='$kabupaten',
            email='$email',
            no_telp='$no_telp',
            website='$website'
            where id=$id";

        }

        //Menjalankan query 
        $update_profil_aplikasi=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($update_profil_aplikasi) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=pengaturan-aplikasi&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=pengaturan-aplikasi&edit=gagal");
        }

    }

}
?>