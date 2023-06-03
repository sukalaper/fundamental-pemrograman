<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library(['template', 'form_validation', 'upload']);
        //load model
        $this->load->model('m_pegawai');

        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index()
    {
        //cek apakah user seorang admin atau bukan
        //jika bukan admin maka alihkan ke halaman dashboard
        $this->is_admin();

        $data = [
            'title' => 'Data Pegawai'
        ];

        $this->template->kasir('pegawai/index', $data);
    }

    public function tambah_pegawai()
    {
        //cek apakah user seorang admin atau bukan
        //jika bukan admin maka alihkan ke halaman dashboard
        $this->is_admin();

        //ketika button tambah data di klik, lakukan proses validasi data
        if ($this->input->post('submit', TRUE) == 'submit') {
            //validasi input data
            $this->form_validation->set_rules(
                'username',
                'Username',
                "required|min_length[5]|max_length[20]|is_unique[tbl_user.username]|regex_match[/^[A-Za-z0-9]+$/]",
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
                "required|min_length[3]|max_length[30]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 30 karakter'
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

            //jika data sudah valid, maka jalankan proses penyimpanan data
            if ($this->form_validation->run() == TRUE) {

                //configurasi upload
                $config['upload_path']      = './assets/foto/';
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['file_name']        = 'foto' . time();

                $this->upload->initialize($config);

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
                } else {
                    $foto = 'default.jpg';
                }

                $password = $this->security->xss_clean($this->input->post('password', TRUE));

                $simpan = [
                    'username' => $this->security->xss_clean($this->input->post('username', TRUE)),
                    'fullname' => $this->security->xss_clean($this->input->post('fullname', TRUE)),
                    'password' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]),
                    'hp' => $this->security->xss_clean($this->input->post('hp', TRUE)),
                    'alamat' => $this->security->xss_clean($this->input->post('alamat', TRUE)),
                    'foto' => $foto,
                    'level' => 'pegawai'
                ];

                //simpan data
                $save = $this->m_pegawai->save('tbl_user', $simpan);
                //jika data berhasil disimpan, maka alihkan kehalaman data pegawai
                if ($save) {
                    $this->session->set_flashdata('success', 'Data pegawai berhasil ditambahkan..');

                    redirect('pegawai');
                }
            }
        }

        $data = [
            'title' => 'Tambah Pegawai'
        ];

        $this->template->kasir('pegawai/form_input', $data);
    }

    public function detail_pegawai($user = '')
    {
        if ($user == '') {
            redirect('pegawai');
        }

        //validasi admin
        $this->is_admin();
        //ambil data pegawai
        $pegawai = $this->m_pegawai->getData('tbl_user', ['username' => $user, 'level' => 'pegawai']);
        //validasi jumlah data
        if ($pegawai->num_rows() != 1) {
            redirect('pegawai');
        }

        $data = [
            'title' => 'Detail Pegawai',
            'data'  => $pegawai->row()
        ];

        $this->template->kasir('pegawai/detail', $data);
    }

    public function edit_data($user = '')
    {
        //validasi admin
        $this->is_admin();

        if ($user == '') {
            redirect('pegawai');
        }
        //ambil data pegawai
        $pegawai = $this->m_pegawai->getData('tbl_user', ['username' => $user, 'level' => 'pegawai']);
        //validasi jumlah data
        if ($pegawai->num_rows() != 1) {
            redirect('pegawai');
        }

        //ketika button di klik
        if ($this->security->xss_clean($this->input->post('submit', TRUE)) == 'submit') {
            //fetch data lama pegawai
            $p = $pegawai->row();
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
                'status',
                'Status',
                "required|min_length[1]|max_length[1]|regex_match[/^[YN]+$/]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} hanya boleh 1 karakter',
                    'max_length' => '{field} hanya boleh 1 karakter',
                    'regex_match' => 'Input {field} tidak valid'
                )
            );

            //jika proses validasi berhasil, maka lanjutkan ke proses update data
            if ($this->form_validation->run() == TRUE) {
                //simpan data foto lama
                $foto = $p->foto;
                //configurasi upload
                $config['upload_path']      = './assets/foto/';
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['file_name']        = 'foto' . time();

                $this->upload->initialize($config);

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
                    'foto' => $foto,
                    'active' => $this->security->xss_clean($this->input->post('status', TRUE))
                ];

                $where = [
                    'id_user' => $this->security->xss_clean($this->input->post('Id', TRUE))
                ];
                //proses update
                $up = $this->m_pegawai->update('tbl_user', $update, $where);
                //jika proses update berhasil, maka alihkan ke halaman data pegawai dan tampilkan pesan
                if ($up) {
                    $this->session->set_flashdata('success', 'Data pegawai berhasil diperbarui..');

                    redirect('pegawai');
                }
            }
        }

        $data = [
            'title' => 'Edit Pegawai',
            'pegawai' => $pegawai->row()
        ];

        $this->template->kasir('pegawai/form_edit', $data);
    }

    public function ganti_password()
    {
        $this->is_admin();

        if ($this->input->post('submit', TRUE) == 'Submit') {
            //validasi
            $this->form_validation->set_rules(
                'pwUser',
                'Password Baru Pegawai',
                "required|min_length[3]|max_length[30]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 30 karakter'
                )
            );

            $this->form_validation->set_rules(
                'pwAdmin',
                'Password Admin',
                "required|min_length[3]|max_length[30]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 30 karakter'
                )
            );

            $this->form_validation->set_rules(
                'IdU',
                'ID User',
                "required|regex_match[/^[0-9]+$/]",
                array(
                    'required' => 'Data tidak valid',
                    'regex_match' => 'Data tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                //validasi password admin
                $whereAdmin = [
                    'id_user' => $this->session->userdata('UserID'),
                    'level' => 'admin'
                ];

                $getDataAdmin = $this->m_pegawai->getData('tbl_user', $whereAdmin);
                //cek jumlah data
                if ($getDataAdmin->num_rows() != 1) {
                    redirect('dashboard');
                }
                //fetch data admin
                $a = $getDataAdmin->row();

                $passwordUser = $this->security->xss_clean($this->input->post('pwUser', TRUE));
                $passwordAdmin = $this->security->xss_clean($this->input->post('pwAdmin', TRUE));
                //validasi password
                if (password_verify($passwordAdmin, $a->password)) {
                    //lakukan update data user
                    $hashPW = password_hash($passwordUser, PASSWORD_DEFAULT, ['cost' => 10]);
                    $idUser = $this->security->xss_clean($this->input->post('IdU', TRUE));

                    $updated = $this->m_pegawai->update('tbl_user', ['password' => $hashPW], ['id_user' => $idUser, 'level' => 'pegawai']);

                    if ($updated) {
                        $this->session->set_flashdata('success', 'Password pegawai berhasil diganti...');

                        redirect('pegawai');
                    } else {
                        $this->session->set_flashdata('error', 'Password pegawai gagal diganti...');

                        redirect('pegawai');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password Admin anda salah, Password Pegawai gagal diperbarui..');

                    redirect('pegawai');
                }
            } else {
                $this->session->set_flashdata('error', validation_errors('<p class="mb-0 mt-0"><i class="fa fa-caret-right"></i> ', '</p>'));

                redirect('pegawai');
            }
        } else {
            redirect('dashboard');
        }
    }

    public function ajax_pegawai()
    {
        $this->is_admin();
        //cek apakah request berupa ajax atau bukan, jika bukan maka redirect ke home
        if ($this->input->is_ajax_request()) {
            //ambil list data
            $list = $this->m_pegawai->get_datatables();
            //siapkan variabel array
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $i) {

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $i->username;
                $row[] = $i->fullname;
                $row[] = ($i->active == 'Y') ? 'Aktif' : 'Tidak Aktif';
                $row[] = ($i->last_login != '') ? date('d/m/Y - H:i:s', strtotime($i->last_login)) : '';
                $row[] = '<a href="' . site_url('pegawai/' . $i->username) . '" class="btn btn-success btn-sm">Detail</a>
                <a href="' . site_url('edit_pegawai/' . $i->username) . '" class="btn btn-warning btn-sm text-white">Edit</a>
                <button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#modal-password" onclick="GantiPW(' . $i->id_user . ')">Ubah Password</button>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->m_pegawai->count_all(),
                "recordsFiltered" => $this->m_pegawai->count_filtered(),
                "data" => $data
            );
            //output to json format
            echo json_encode($output);
        } else {
            redirect('dashboard');
        }
    }

    private function is_admin()
    {
        if (!$this->session->userdata('level') || $this->session->userdata('level') != 'admin') {
            redirect('dashboard');
        }
    }
}
