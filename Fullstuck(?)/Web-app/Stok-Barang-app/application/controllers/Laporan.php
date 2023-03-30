<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library(['template', 'form_validation']);
        //load model
        $this->load->model('m_laporan');

        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index()
    {
        redirect('dashboard');
    }

    public function data_stok_harian()
    {
        //cek login
        $this->is_login();

        if ($this->input->post('cari', TRUE) == 'Search') {
            //validasi input data tanggal
            $this->form_validation->set_rules(
                'tanggal',
                'Tanggal',
                'required|callback_checkDateFormat',
                array(
                    'required' => '{field} wajib diisi',
                    'checkDateFormat' => '{field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                $tanggal = $this->security->xss_clean($this->input->post('tanggal', TRUE));
            } else {
                $this->session->set_flashdata('alert', validation_errors('<p class="my-0">', '</p>'));

                redirect('stok_harian');
            }
        } else {
            $tanggal = date('d/m/Y');
        }

        $getData = $this->m_laporan->getDataStokHarian(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal))));

        $data = [
            'title' => 'Laporan Harian Stok Barang',
            'tanggal' => $tanggal,
            'data' => $getData
        ];

        $this->template->kasir('laporan/stok_harian', $data);
    }

    public function cetak_stok_harian($date)
    {
        $this->is_login();

        if ($this->cekTanggal($date) == false) {
            redirect('stok_harian');
        }

        $getData = $this->m_laporan->getDataStokHarian($date);

        $data = [
            'title' => 'Laporan Harian Stok Barang',
            'tanggal' => $date,
            'data' => $getData
        ];

        $this->template->cetak('cetak/stok_harian', $data);
    }

    public function data_stok_bulanan()
    {
        //cek login
        $this->is_login();

        if ($this->input->post('cari', TRUE) == 'Search') {
            //validasi input data tanggal
            $this->form_validation->set_rules(
                'bulan',
                'Bulan',
                'required|callback_checkBulan',
                array(
                    'required' => '{field} wajib diisi',
                    'checkBulan' => '{field} tidak valid'
                )
            );

            $this->form_validation->set_rules(
                'tahun',
                'Tahun',
                'required|numeric|min_length[4]|max_length[4]|greater_than[2019]',
                array(
                    'required' => '{field} wajib diisi',
                    'numeric' => '{field} tidak valid',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maximal 4 karakter',
                    'greater_than' => '{field} harus lebih dari 2019'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                $bulan = $this->security->xss_clean($this->input->post('bulan', TRUE));
                $tahun = $this->security->xss_clean($this->input->post('tahun', TRUE));
            } else {
                $this->session->set_flashdata('alert', validation_errors('<p class="my-0">', '</p>'));

                redirect('stok_bulanan');
            }
        } else {
            $bulan = $this->convert_bulan_indo(date('m'));
            $tahun = date('Y');
        }

        $getData = $this->m_laporan->getDataStokBulanan($this->convert_bulan($bulan), $tahun);

        $data = [
            'title' => 'Laporan Bulanan Stok Barang',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'data' => $getData
        ];

        $this->template->kasir('laporan/stok_bulanan', $data);
    }

    public function cetak_stok_bulanan($date)
    {
        $this->is_login();
        //explode url
        $exp = explode('-', $date);
        //cek jumlah array
        if (count($exp) != 2) {
            redirect('stok_bulanan');
        }
        //cek nama bulan, apakah valid atau tidak
        if ($this->checkBulan($exp[0]) == false) {
            redirect('stok_bulanan');
        }

        $getData = $this->m_laporan->getDataStokBulanan($this->convert_bulan($exp[0]), $exp[1]);

        $data = [
            'title' => 'Laporan Bulanan Stok Barang',
            'bulan' => $exp[0],
            'tahun' => $exp[1],
            'data' => $getData
        ];

        $this->template->cetak('cetak/stok_bulanan', $data);
    }

    public function data_stok_tahunan()
    {
        //cek login
        $this->is_login();

        if ($this->input->post('cari', TRUE) == 'Search') {

            $this->form_validation->set_rules(
                'tahun',
                'Tahun',
                'required|numeric|min_length[4]|max_length[4]|greater_than[2019]',
                array(
                    'required' => '{field} wajib diisi',
                    'numeric' => '{field} tidak valid',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maximal 4 karakter',
                    'greater_than' => '{field} harus lebih dari 2019'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                $tahun = $this->security->xss_clean($this->input->post('tahun', TRUE));
            } else {
                $this->session->set_flashdata('alert', validation_errors('<p class="my-0">', '</p>'));

                redirect('stok_tahunan');
            }
        } else {
            $tahun = date('Y');
        }

        $getData = $this->m_laporan->getDataStokTahunan($tahun);

        $data = [
            'title' => 'Laporan Tahunan Stok Barang',
            'tahun' => $tahun,
            'data' => $getData
        ];

        $this->template->kasir('laporan/stok_tahunan', $data);
    }

    public function cetak_stok_tahunan($tahun)
    {
        $this->is_login();

        if ($tahun < 2020) {
            redirect('stok_tahunan');
        }

        $getData = $this->m_laporan->getDataStokTahunan($tahun);

        $data = [
            'title' => 'Laporan Tahunan Stok Barang',
            'tahun' => $tahun,
            'data' => $getData
        ];

        $this->template->cetak('cetak/stok_tahunan', $data);
    }

    public function data_pembelian_harian()
    {
        //cek login
        $this->is_login();

        if ($this->input->post('cari', TRUE) == 'Search') {
            //validasi input data tanggal
            $this->form_validation->set_rules(
                'tanggal',
                'Tanggal',
                'required|callback_checkDateFormat',
                array(
                    'required' => '{field} wajib diisi',
                    'checkDateFormat' => '{field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                $tanggal = $this->security->xss_clean($this->input->post('tanggal', TRUE));
            } else {
                $this->session->set_flashdata('alert', validation_errors('<p class="my-0">', '</p>'));

                redirect('pembelian_harian');
            }
        } else {
            $tanggal = date('d/m/Y');
        }

        $getData = $this->m_laporan->getDataPembelianHarian(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal))));

        $data = [
            'title' => 'Laporan Harian Pembelian Barang',
            'tanggal' => $tanggal,
            'data' => $getData
        ];

        $this->template->kasir('laporan/pembelian_harian', $data);
    }

    public function cetak_pembelian_harian($date)
    {
        $this->is_login();

        if ($this->cekTanggal($date) == false) {
            redirect('pembelian_harian');
        }

        $getData = $this->m_laporan->getDataPembelianHarian($date);

        $data = [
            'title' => 'Laporan Harian Pembelian Barang',
            'tanggal' => $date,
            'data' => $getData
        ];

        $this->template->cetak('cetak/pembelian_harian', $data);
    }

    public function data_pembelian_bulanan()
    {
        //cek login
        $this->is_login();

        if ($this->input->post('cari', TRUE) == 'Search') {
            //validasi input data tanggal
            $this->form_validation->set_rules(
                'bulan',
                'Bulan',
                'required|callback_checkBulan',
                array(
                    'required' => '{field} wajib diisi',
                    'checkBulan' => '{field} tidak valid'
                )
            );

            $this->form_validation->set_rules(
                'tahun',
                'Tahun',
                'required|numeric|min_length[4]|max_length[4]|greater_than[2019]',
                array(
                    'required' => '{field} wajib diisi',
                    'numeric' => '{field} tidak valid',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maximal 4 karakter',
                    'greater_than' => '{field} harus lebih dari 2019'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                $bulan = $this->security->xss_clean($this->input->post('bulan', TRUE));
                $tahun = $this->security->xss_clean($this->input->post('tahun', TRUE));
            } else {
                $this->session->set_flashdata('alert', validation_errors('<p class="my-0">', '</p>'));

                redirect('pembelian_bulanan');
            }
        } else {
            $bulan = $this->convert_bulan_indo(date('m'));
            $tahun = date('Y');
        }

        $getData = $this->m_laporan->getDataPembelianBulanan($this->convert_bulan($bulan), $tahun);

        $data = [
            'title' => 'Laporan Bulanan Pembelian Barang',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'data' => $getData
        ];

        $this->template->kasir('laporan/pembelian_bulanan', $data);
    }

    public function cetak_pembelian_bulanan($date)
    {
        $this->is_login();
        //explode url
        $exp = explode('-', $date);
        //cek jumlah array
        if (count($exp) != 2) {
            redirect('stok_bulanan');
        }
        //cek nama bulan, apakah valid atau tidak
        if ($this->checkBulan($exp[0]) == false) {
            redirect('stok_bulanan');
        }

        $getData = $this->m_laporan->getDataPembelianBulanan($this->convert_bulan($exp[0]), $exp[1]);

        $data = [
            'title' => 'Laporan Bulanan Pembelian Barang',
            'bulan' => $exp[0],
            'tahun' => $exp[1],
            'data' => $getData
        ];

        $this->template->cetak('cetak/pembelian_bulanan', $data);
    }

    public function data_penjualan_harian()
    {
        //cek login
        $this->is_login();

        if ($this->input->post('cari', TRUE) == 'Search') {
            //validasi input data tanggal
            $this->form_validation->set_rules(
                'tanggal',
                'Tanggal',
                'required|callback_checkDateFormat',
                array(
                    'required' => '{field} wajib diisi',
                    'checkDateFormat' => '{field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                $tanggal = $this->security->xss_clean($this->input->post('tanggal', TRUE));
            } else {
                $this->session->set_flashdata('alert', validation_errors('<p class="my-0">', '</p>'));

                redirect('penjualan_harian');
            }
        } else {
            $tanggal = date('d/m/Y');
        }

        $getData = $this->m_laporan->getDataPenjualanHarian(date('Y-m-d', strtotime(str_replace('/', '-', $tanggal))));

        $data = [
            'title' => 'Laporan Harian Penjualan Barang',
            'tanggal' => $tanggal,
            'data' => $getData
        ];

        $this->template->kasir('laporan/penjualan_harian', $data);
    }

    public function cetak_penjualan_harian($date)
    {
        $this->is_login();

        if ($this->cekTanggal($date) == false) {
            redirect('pembelian_harian');
        }

        $getData = $this->m_laporan->getDataPenjualanHarian($date);

        $data = [
            'title' => 'Laporan Harian Penjualan Barang',
            'tanggal' => $date,
            'data' => $getData
        ];

        $this->template->cetak('cetak/penjualan_harian', $data);
    }

    public function data_penjualan_bulanan()
    {
        //cek login
        $this->is_login();

        if ($this->input->post('cari', TRUE) == 'Search') {
            //validasi input data tanggal
            $this->form_validation->set_rules(
                'bulan',
                'Bulan',
                'required|callback_checkBulan',
                array(
                    'required' => '{field} wajib diisi',
                    'checkBulan' => '{field} tidak valid'
                )
            );

            $this->form_validation->set_rules(
                'tahun',
                'Tahun',
                'required|numeric|min_length[4]|max_length[4]|greater_than[2019]',
                array(
                    'required' => '{field} wajib diisi',
                    'numeric' => '{field} tidak valid',
                    'min_length' => '{field} minimal 4 karakter',
                    'max_length' => '{field} maximal 4 karakter',
                    'greater_than' => '{field} harus lebih dari 2019'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                $bulan = $this->security->xss_clean($this->input->post('bulan', TRUE));
                $tahun = $this->security->xss_clean($this->input->post('tahun', TRUE));
            } else {
                $this->session->set_flashdata('alert', validation_errors('<p class="my-0">', '</p>'));

                redirect('penjualan_bulanan');
            }
        } else {
            $bulan = $this->convert_bulan_indo(date('m'));
            $tahun = date('Y');
        }

        $getData = $this->m_laporan->getDataPenjualanBulanan($this->convert_bulan($bulan), $tahun);

        $data = [
            'title' => 'Laporan Bulanan Penjualan Barang',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'data' => $getData
        ];

        $this->template->kasir('laporan/penjualan_bulanan', $data);
    }

    public function cetak_penjualan_bulanan($date)
    {
        $this->is_login();
        //explode url
        $exp = explode('-', $date);
        //cek jumlah array
        if (count($exp) != 2) {
            redirect('stok_bulanan');
        }
        //cek nama bulan, apakah valid atau tidak
        if ($this->checkBulan($exp[0]) == false) {
            redirect('stok_bulanan');
        }

        $getData = $this->m_laporan->getDataPenjualanBulanan($this->convert_bulan($exp[0]), $exp[1]);

        $data = [
            'title' => 'Laporan Bulanan Penjualan Barang',
            'bulan' => $exp[0],
            'tahun' => $exp[1],
            'data' => $getData
        ];

        $this->template->cetak('cetak/penjualan_bulanan', $data);
    }

    function checkDateFormat($date)
    {
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $date)) {
            if (checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function checkBulan($bulan)
    {
        $array_bulan = array('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember');

        if (in_array(strtolower($bulan), $array_bulan)) {
            return true;
        } else {
            return false;
        }
    }

    private function convert_bulan($bulan)
    {
        $bulan_array = [
            'januari' => '01',
            'februari' => '02',
            'maret' => '03',
            'april' => '04',
            'mei' => '05',
            'juni' => '06',
            'juli' => '07',
            'agustus' => '08',
            'september' => '09',
            'oktober' => '10',
            'november' => '11',
            'desember' => '12'
        ];

        return $bulan_array[strtolower($bulan)];
    }

    private function convert_bulan_indo($bulan)
    {
        $arr = [1 => 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

        return $arr[(int)$bulan];
    }

    private function cekTanggal($date)
    {
        if (preg_match("/^[0-9]{4}\-(0[1-9]|1[0-2])\-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            if (checkdate(substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function is_login()
    {
        if (!$this->session->userdata('UserID')) {
            redirect('dashboard');
        }
    }
}
