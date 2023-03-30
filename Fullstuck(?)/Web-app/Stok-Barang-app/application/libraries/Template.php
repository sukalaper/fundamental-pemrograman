<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template
{

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function kasir($template, $data_content = array())
    {
        $data['content']    = $this->ci->load->view($template, $data_content, TRUE);
        $data['navbar']     = $this->ci->load->view('template/nav', $data_content, TRUE);

        $this->ci->load->view('template/index', $data);
    }

    function cetak($template, $data_content = array())
    {
        $data['content'] = $this->ci->load->view($template, $data_content, TRUE);

        $this->ci->load->view('template/index_cetak', $data);
    }
}
