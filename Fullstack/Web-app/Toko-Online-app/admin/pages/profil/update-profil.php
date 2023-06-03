<?php
session_start();
    if (isset($_POST['simpan_profil'])) {
        //Koneksi database
        include '../../../config/database.php';

        //Memulai transaksi
        mysqli_query($kon,"START TRANSACTION");
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Mengambil nilai dari kiriam form
        $id_admin=$_POST["id_admin"];
        $nama=input($_POST["nama"]);
        $username=input($_POST["username_baru"]);
        $no_telp=input($_POST["no_telp"]);
        $email=input($_POST["email"]);
        $foto_saat_ini=$_POST['foto_saat_ini'];
        $foto_baru = $_FILES['foto_baru']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
        $x = explode('.', $foto_baru);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['foto_baru']['size'];
        $file_tmp = $_FILES['foto_baru']['tmp_name'];

        //Mengambil password
        $ambil_password=mysqli_query($kon,"select username,password from admin where id_admin=$id_admin limit 1");
        $data = mysqli_fetch_array($ambil_password);

        $username_lama=$data['username'];

        //Cek apakah user mengganti password atau tidak
        if ($data['password']==$_POST["password"]){
            $password=input($_POST["password"]);
        }else {
            $password=md5(input($_POST["password"]));
        }

        //Kondisi jika logo tidak kosong
        if (!empty($foto_baru)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                //Mengupload foto baru
                move_uploaded_file($file_tmp,'../admin/foto/'.$foto_baru);

                //Langsung mengganti nama dan foto yang telah disimpan di dalam session
                unset($_SESSION['nama_admin']);
                unset($_SESSION['foto']);
                $_SESSION["nama_admin"]=$nama;
                $_SESSION["foto"]=$foto_baru;

                //Menghapus foto lama, foto yang dihapus selain foto default
                if ($foto_saat_ini!='admin_default.png'){
                    unlink("../admin/foto/".$foto_saat_ini);
                }
                
                $sql="update admin set
                nama_admin='$nama',
                email='$email',
                username='$username',
                password='$password',
                foto='$foto_baru'
                where id_admin=$id_admin";
            }
        //Menjalankan query jika logo tidak diinputkan
        }else {
            $sql="update admin set
            nama_admin='$nama',
            email='$email',
            username='$username',
            password='$password'
            where id_admin=$id_admin";
        }

        //Menjalankan query 
        $update_admin=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($update_admin) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=profil&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=profil&edit=gagal");
        }
    }
?>

