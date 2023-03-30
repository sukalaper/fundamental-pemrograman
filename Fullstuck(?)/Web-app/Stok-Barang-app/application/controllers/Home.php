                                       <?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library(['template', 'form_validation']);
        //load Model
        $this->load->model('app');

        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index()
    {
        //cek apakah user sudah melakukan login atau belum
        //jika sudah, maka redirect ke halaman dashboard
        if ($this->session->userdata('level')) {
            redirect('dashboard');
        }

        //ketika button di klik, jalankan proses login
        if ($this->input->post('submit', TRUE) == 'submit') {
            //validasi data
            $this->form_validation->set_rules(
                'username',
                'Username',
                'required|min_length[3]',
                array(
                    'required' => 'Field {field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter'
                )
            );

            $this->form_validation->set_rules(
                'password',
                'Password',
                'required|min_length[3]',
                array(
                    'required' => 'Field {field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter'
                )
            );

            //jika validasi berhasil maka lanjutkan ke proses pengecekan data
            if ($this->form_validation->run() == TRUE) {

                $username = $this->security->xss_clean($this->input->post('username', TRUE));
                $password = $this->security->xss_clean($this->input->post('password', TRUE));

                //ambil data user sesuai username
                $get = $this->app->getData('tbl_user', ['username' => $username]);
                //validasi jumlah data
                if ($get->num_rows() != 1) {
                    $this->session->set_flashdata('alert', 'User tidak dikenali...');
                } else {
                    //fetch data
                    $u = $get->row();
                    //validasi password
                    if (password_verify($password, $u->password)) {
                        //jika benar, maka simpan data ke dalam session
                        //kemudian redirect ke halaman dashboard
                        $this->session->set_userdata(
                            array(
                                'UserID' => $u->id_user,
                                'User' => $u->fullname,
                                'level' => $u->level,
                                'foto' => $u->foto
                            )
                        );
                        redirect('dashboard');
                    } else {
                        //jika salah maka tampilkan pesan error
                        $this->session->set_flashdata('alert', 'Maaf, Password yang anda masukkan salah..');
                    }
                }
            }
        }

        $this->load->view('login');
    }

    public function dashboard()
    {
        //cek login
        $this->is_login();

        $data = [
            'title' => 'Aplikasi Stok Barang'
        ];

        $this->template->kasir('home', $data);
    }

    public function profil_admin()
    {
        if ($this->session->userdata('level') != 'admin' || !$this->session->userdata('level')) {
            redirect('dashboard');
        }

        //ambil data admin
        $getData = $this->app->getData('tbl_user', ['id_user' => $this->session->userdata('UserID'), 'level' => 'admin']);

        if ($getData->num_rows() != 1) {
            redirect('dashboard');
        }

        //ketika button di klik
        if ($this->input->post('submit', TRUE) == 'submit') {

            $f = $getData->row();

            if ($this->security->xss_clean($this->input->post('username', TRUE)) == $f->username) {

                $rules_username = 'required|min_length[5]|max_length[20]|regex_match[/^[A-Za-z0-9]+$/]';
            } else {

                $rules_username = 'required|min_length[5]|max_length[20]|is_unique[tbl_user.username]|regex_match[/^[A-Za-z0-9]+$/]';
            }

            $this->form_validation->set_rules(
                'username',
                'Username',
                $rules_username,
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 5 karakter',
                    'max_length' => '{field} maksimal 20 karakter',
                    'is_unique' => 'Username sudah digunakan, silahkan pilih yang lain',
                    'regex_match' => '{field} hanya boleh huruf dan angka'
                )
            );

            $this->form_validation->set_rules(
                'fullname',
                'Fullname',
                "required|min_length[3]|max_length[30]|regex_match[/^[A-Z a-z.']+$/]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 30 karakter',
                    'regex_match' => '{field} hanya boleh huruf, titik dan kutip satu (\')'
                )
            );

            $this->form_validation->set_rules(
                'password',
                'Password',
                "required|min_length[3]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter'
                )
            );

            //jika proses validasi berhasil, maka lanjutkan ke proses update data
            if ($this->form_validation->run() == TRUE) {
                //validasi password apakah benar atau salah
                if (!password_verify($this->input->post('password', TRUE), $f->password)) {
                    $this->session->set_flashdata('error', 'Password yang anda masukkan salah..');
                    redirect('admin');
                }
                //simpan data foto lama
                $foto = $f->foto;
                //configurasi upload
                $config['upload_path']      = './assets/foto/';
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['file_name']        = 'foto' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {

                    $b = $this->upload->data();
                    $foto = $b['file_name'];

                    //buat foto thumbnail untuk icon user
                    $this->load->library('image_lib');

                    $config2['image_library']   = 'gd2';
                    $config2['source_image']    = './assets/foto/' . $foto;
                    $config2['new_image']       = './assets/foto/thumb/' . $foto;
                    $config2['maintain_ratio']  = FALSE;
                    $imgSize2 = $this->image_lib->get_image_properties($config2['source_image'], TRUE);

                    if ($imgSize2['width'] > $imgSize2['height']) {
                        $config2['width']   = $imgSize2['height'];
                        $config2['height']  = $imgSize2['height'];
                        $config2['x_axis']  = (($imgSize2['width'] / 2) - ($imgSize2['width'] / 2));
                    } else {
                        $config2['width']   = $imgSize2['width'];
                        $config2['height']  = $imgSize2['width'];
                        $config2['y_axis']  = (($imgSize2['height'] / 2) - ($imgSize2['height'] / 2));
                    }

                    $this->image_lib->initialize($config2);

                    if (!$this->image_lib->crop()) {
                        echo $this->image_lib->display_errors();

                        exit;
                    }
                    //hapus foto lama, jika foto bukan foto default
                    if ($f->foto != 'default.jpg' && $f->foto != '') {
                        //hapus foto utama
                        unlink('./assets/foto/' . $f->foto);
                        //hapus foto profil
                        unlink('./assets/foto/thumb/' . $f->foto);
                    }
                }

                //masukkan data ke variable array
                $update = [
                    'username' => $this->security->xss_clean($this->input->post('username', TRUE)),
                    'fullname' => $this->security->xss_clean($this->input->post('fullname', TRUE)),
                    'foto' => $foto
                ];

                $where = [
                    'id_user' => $this->session->userdata('UserID')
                ];
                //proses update
                $up = $this->app->update('tbl_user', $update, $where);
                //jika proses update berhasil, maka alihkan ke halaman data pegawai dan tampilkan pesan
                if ($up) {
                    $this->session->set_flashdata('success', 'Profil berhasil diperbarui..');
                    //update session profil
                    $this->session->set_userdata(
                        array(
                            'User' => $this->security->xss_clean($this->input->post('fullname', TRUE)),
                            'foto' => $foto
                        )
                    );

                    redirect('admin');
                }
            }
        }

        $data = [
            'title' => 'Profil ' . $this->session->userdata('User'),
            'data' => $getData->row()
        ];

        $this->template->kasir('profil_admin', $data);
    }

    public function profil_pegawai()
    {
        if ($this->session->userdata('level') != 'pegawai' || !$this->session->userdata('level')) {
            redirect('dashboard');
        }

        //ambil data pegawai
        $getData = $this->app->getData('tbl_user', ['id_user' => $this->session->userdata('UserID'), 'level' => 'pegawai', 'active' => 'Y']);

        if ($getData->num_rows() != 1) {
            redirect('dashboard');
        }

        //ketika button di klik
        if ($this->security->xss_clean($this->input->post('submit', TRUE)) == 'submit') {
            //fetch data lama pegawai
            $p = $getData->row();
            //cek apakah admin merubah username nya atau tidak
            if ($this->security->xss_clean($this->input->post('username', TRUE)) == $p->username) {
                $rules_username = 'required|min_length[5]|max_length[20]|regex_match[/^[A-Za-z0-9]+$/]';
            } else {
                $rules_username = 'required|min_length[5]|max_length[20]|is_unique[tbl_user.username]|regex_match[/^[A-Za-z0-9]+$/]';
            }

            $this->form_validation->set_rules(
                'username',
                'Username',
                $rules_username,
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 5 karakter',
                    'max_length' => '{field} maksimal 20 karakter',
                    'is_unique' => 'Username sudah digunakan, silahkan pilih yang lain',
                    'regex_match' => '{field} hanya boleh huruf dan angka'
                )
            );

            $this->form_validation->set_rules(
                'fullname',
                'Fullname',
                "required|min_length[3]|max_length[30]|regex_match[/^[A-Z a-z.']+$/]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 30 karakter',
                    'regex_match' => '{field} hanya boleh huruf, titik dan kutip satu (\')'
                )
            );

            //cek apakah form nomor hp diisi atau tidak, jika diisi maka lakukan validasi
            if ($this->input->post('hp', TRUE) != '') {
                $this->form_validation->set_rules(
                    'hp',
                    'Nomor HP',
                    "required|min_length[8]|max_length[15]|regex_match[/^[0-9]+$/]",
                    array(
                        'required' => '{field} wajib diisi',
                        'min_length' => '{field} minimal 8 karakter',
                        'max_length' => '{field} maksimal 15 karakter',
                        'regex_match' => '{field} hanya boleh angka'
                    )
                );
            }

            $this->form_validation->set_rules(
                'alamat',
                'Alamat',
                "required|min_length[10]|max_length[255]|regex_match[/^[A-Z a-z.0-9-,']+$/]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 5 karakter',
                    'max_length' => '{field} maksimal 30 karakter',
                    'regex_match' => 'Data {field} yang anda masukkan tidak valid'
                )
            );

            $this->form_validation->set_rules(
                'password',
                'Password',
                "required|min_length[3]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter'
                )
            );

            //jika proses validasi berhasil, maka lanjutkan ke proses update data
            if ($this->form_validation->run() == TRUE) {
                //validasi password apakah benar atau salah
                if (!password_verify($this->input->post('password', TRUE), $p->password)) {
                    $this->session->set_flashdata('error', 'Password yang anda masukkan salah..');
                    redirect('profil');
                }
                //simpan data foto lama
                $foto = $p->foto;
                //configurasi upload
                $config['upload_path']      = './assets/foto/';
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['file_name']        = 'foto' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {

                    $b = $this->upload->data();
                    $foto = $b['file_name'];

                    //buat foto thumbnail untuk icon user
                    $this->load->library('image_lib');

                    $config2['image_library']   = 'gd2';
                    $config2['source_image']    = './assets/foto/' . $foto;
                    $config2['new_image']       = './assets/foto/thumb/' . $foto;
                    $config2['maintain_ratio']  = FALSE;
                    $imgSize2 = $this->image_lib->get_image_properties($config2['source_image'], TRUE);

                    if ($imgSize2['width'] > $imgSize2['height']) {
                        $config2['width']   = $imgSize2['height'];
                        $config2['height']  = $imgSize2['height'];
                        $config2['x_axis']  = (($imgSize2['width'] / 2) - ($imgSize2['width'] / 2));
                    } else {
                        $config2['width']   = $imgSize2['width'];
                        $config2['height']  = $imgSize2['width'];
                        $config2['y_axis']  = (($imgSize2['height'] / 2) - ($imgSize2['height'] / 2));
                    }

                    $this->image_lib->initialize($config2);

                    if (!$this->image_lib->crop()) {
                        echo $this->image_lib->display_errors();

                        exit;
                    }
                    //hapus foto lama, jika foto bukan foto default
                    if ($p->foto != 'default.jpg' && $p->foto != '') {
                        //hapus foto utama
                        unlink('./assets/foto/' . $p->foto);
                        //hapus foto profil
                        unlink('./assets/foto/thumb/' . $p->foto);
                    }
                }

                //masukkan data ke variable array
                $update = [
                    'username' => $this->security->xss_clean($this->input->post('username', TRUE)),
                    'fullname' => $this->security->xss_clean($this->input->post('fullname', TRUE)),
                    'hp' => $this->security->xss_clean($this->input->post('hp', TRUE)),
                    'alamat' => $this->security->xss_clean($this->input->post('alamat', TRUE)),
                    'foto' => $foto
                ];

                $where = [
                    'id_user' => $this->security->xss_clean($p->id_user)
                ];
                //proses update
                $up = $this->app->update('tbl_user', $update, $where);
                //jika proses update berhasil, maka alihkan ke halaman data pegawai dan tampilkan pesan
                if ($up) {
                    $this->session->set_flashdata('success', 'Data pegawai berhasil diperbarui..');
                    //update session profil
                    $this->session->set_userdata(
                        array(
                            'User' => $this->security->xss_clean($this->input->post('fullname', TRUE)),
                            'foto' => $foto
                        )
                    );

                    redirect('profil');
                }
            }
        }

        $data = [
            'title' => 'Profil ' . $this->session->userdata('User'),
            'data' => $getData->row()
        ];

        $this->template->kasir('profil_pegawai', $data);
    }

    public function ganti_password()
    {
        $this->is_login();

        //ketika user mengklik tombol ubah password
        if ($this->input->post('submit', TRUE) == 'submit') {
            //lakukan validasi
            $this->form_validation->set_rules(
                'pwBaru',
                'Password Baru',
                "required|min_length[3]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter'
                )
            );

            $this->form_validation->set_rules(
                'pwLama',
                'Password Lama',
                "required|min_length[3]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                //ambil data user
                $getData = $this->app->getData('tbl_user', ['id_user' => $this->session->userdata('UserID')]);
                //fetch data
                $f = $getData->row();
                //tampung data dari form
                $pwBaru = $this->security->xss_clean($this->input->post('pwBaru', TRUE));
                $pwLama = $this->security->xss_clean($this->input->post('pwLama', TRUE));
                //validasi password lama dengan password yang ada didalam database
                if (!password_verify($pwLama, $f->password)) {
                    $this->session->set_flashdata('error', 'Password Lama yang anda masukkan salah..');
                    redirect('password');
                }
                //cek apakah password lama dan baru sama, jika sama maka munculkan pesan
                if ($pwBaru == $pwLama) {
                    $this->session->set_flashdata('error', 'Password Baru dan Password Lama sama, Data tidak diubah...');
                    redirect('password');
                }
                //encrypt & update password
                $hash_password = password_hash($pwBaru, PASSWORD_DEFAULT, ['cost' => 8]);

                $update = $this->app->update('tbl_user', ['password' => $hash_password], ['id_user' => $f->id_user]);

                if ($update) {
                    $this->session->set_flashdata('success', 'Password berhasil diubah..');
                } else {
                    $this->session->set_flashdata('error', 'Password gagal diubah..');
                }

                redirect('password');
            }
        }

        $data = [
            'title' => 'Ganti Password'
        ];

        $this->template->kasir('ganti_password', $data);
    }

    public function sign_out()
    {
        //cek login
        $this->is_login();
        //update last sign in
        $user = $this->session->userdata('UserID');
        $last_login = date('Y-m-d H:i:s');

        $this->app->update('tbl_user', ['last_login' => $last_login], ['id_user' => $user]);
        //hapus session
        $this->session->sess_destroy();
        //redirect halaman login
        redirect(site_url());
    }

    private function is_login()
    {
        if (!$this->session->userdata('level')) {
            redirect(site_url());
        }
    }
}
