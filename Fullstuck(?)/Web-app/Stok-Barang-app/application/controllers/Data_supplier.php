<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library(['template', 'form_validation']);
        //load Model
        $this->load->model('m_supplier');

        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index()
    {
        $this->is_admin();

        $data = [
            'title' => 'Data Supplier'
        ];

        $this->template->kasir('supplier/index', $data);
    }

    public function tambah_supplier()
    {
        $this->is_admin();
        //ketika user mengklik submit
        if ($this->input->post('submit', TRUE) == 'submit') {
            //validasi form
            $this->form_validation->set_rules(
                'nama_supplier',
                'Nama Supplier',
                "required|min_length[2]|max_length[100]|regex_match[/^[A-Z a-z.0-9']+$/]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 2 karakter',
                    'max_length' => '{field} maksimal 100 karakter',
                    'regex_match' => '{field} tidak valid'
                )
            );

            if ($this->input->post('hp', TRUE) != '') {
                $this->form_validation->set_rules(
                    'hp',
                    'Nomor Telp.',
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

            //jika validasi berhasil maka lakukan proses penyimpanan
            if ($this->form_validation->run() == TRUE) {
                //tampung data ke variabel
                $id = 'ID' . time();
                $nama = $this->security->xss_clean($this->input->post('nama_supplier', TRUE));
                $telp = $this->security->xss_clean($this->input->post('hp', TRUE));
                $alamat = $this->security->xss_clean($this->input->post('alamat', TRUE));

                $data_simpan = [
                    'id_supplier' => $id,
                    'nama_supplier' => $nama,
                    'alamat' => $alamat,
                    'telp' => $telp
                ];

                $simpan = $this->m_supplier->save('tbl_supplier', $data_simpan);

                if ($simpan) {
                    $this->session->set_flashdata('success', 'Data Supplier berhasil ditambahkan..');

                    redirect('supplier');
                }
            }
        }

        $data = [
            'title' => 'Tambah Supplier'
        ];

        $this->template->kasir('supplier/form_input', $data);
    }

    public function edit_supplier($id)
    {
        $this->is_admin();

        //ketika user mengklik submit
        if ($this->input->post('submit', TRUE) == 'submit') {
            //validasi form
            $this->form_validation->set_rules(
                'idSupplier',
                'ID Supplier',
                'required|min_length[10]',
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} tidak valid'
                )
            );

            $this->form_validation->set_rules(
                'nama_supplier',
                'Nama Supplier',
                "required|min_length[2]|max_length[100]|regex_match[/^[A-Z a-z.0-9']+$/]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 2 karakter',
                    'max_length' => '{field} maksimal 100 karakter',
                    'regex_match' => '{field} tidak valid'
                )
            );

            if ($this->input->post('hp', TRUE) != '') {
                $this->form_validation->set_rules(
                    'hp',
                    'Nomor Telp.',
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

            //jika validasi berhasil maka lakukan proses penyimpanan
            if ($this->form_validation->run() == TRUE) {
                //tampung data ke variabel
                $idSupplier = $this->security->xss_clean($this->input->post('idSupplier', TRUE));
                $nama = $this->security->xss_clean($this->input->post('nama_supplier', TRUE));
                $telp = $this->security->xss_clean($this->input->post('hp', TRUE));
                $alamat = $this->security->xss_clean($this->input->post('alamat', TRUE));

                $data_update = [
                    'nama_supplier' => $nama,
                    'alamat' => $alamat,
                    'telp' => $telp
                ];

                $up = $this->m_supplier->update('tbl_supplier', $data_update, ['id_supplier' => $idSupplier]);

                if ($up) {
                    $this->session->set_flashdata('success', 'Data Supplier berhasil diperbarui..');

                    redirect('supplier');
                }
            }
        }

        //ambil data
        $where = [
            'id_supplier' => $this->security->xss_clean($id)
        ];
        $getData = $this->m_supplier->getData('tbl_supplier', $where);
        //cek jumlah data
        if ($getData->num_rows() != 1) {
            redirect('supplier');
        }

        $data = [
            'title' => 'Edit Supplier',
            'data' => $getData->row()
        ];

        $this->template->kasir('supplier/form_edit', $data);
    }

    public function hapus_data()
    {
        //cek login
        $this->is_admin();
        //validasi request ajax
        if ($this->input->is_ajax_request()) {
            //validasi
            $this->form_validation->set_rules(
                'id',
                'ID Supplier',
                "required|min_length[10]",
                array(
                    'required' => '{field} tidak valid',
                    'min_length' => 'Isi {field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                //tangkap rowid
                $id = $this->security->xss_clean($this->input->post('id', TRUE));

                $hapus = $this->m_supplier->delete('tbl_supplier', ['id_supplier' => $id]);

                if ($hapus) {
                    echo json_encode(['message' => 'success']);
                } else {
                    echo json_encode(['message' => 'failed']);
                }
            } else {
                echo json_encode(['message' => 'failed']);
            }
        } else {
            redirect('dashboard');
        }
    }

    public function ajax_supplier()
    {
        $this->is_admin();
        //cek apakah request berupa ajax atau bukan, jika bukan maka redirect ke home
        if ($this->input->is_ajax_request()) {
            //ambil list data
            $list = $this->m_supplier->get_datatables();
            //siapkan variabel array
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $i) {

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $i->id_supplier;
                $row[] = $i->nama_supplier;
                $row[] = $i->alamat;
                $row[] = ($i->telp != '') ? $i->telp : '-';
                $row[] = '<a href="' . site_url('supplier/' . $i->id_supplier) . '" class="btn btn-warning btn-sm text-white">Edit</a>
                <button type="button" class="btn btn-danger btn-sm"onclick="hapus_supplier(\'' . $i->id_supplier . '\')">Hapus</button>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->m_supplier->count_all(),
                "recordsFiltered" => $this->m_supplier->count_filtered(),
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
