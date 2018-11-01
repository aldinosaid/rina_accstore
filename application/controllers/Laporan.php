<?php


/**
*
*/
class Laporan extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['laporan_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function penjualan()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        if ($start_date && $end_date) {
            $args = [
                'start_date' => $start_date,
                'end_date' => $end_date
            ];
        } else {
            $args = [
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d')
            ];
        }

        $report_data = $this->laporan_model->getLaporanPenjualan($args);
        $data['total'] = getTotalReport($report_data);
        $data['semua_penjualan'] = $report_data;
        $data = array_merge($args, $data);
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/laporan/view', $data);
        $this->load->view('dashboard/footer');
    }

    public function add()
    {
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/laporan/add');
        $this->load->view('dashboard/footer');
    }

    public function edit($id)
    {
        $data['kategories'] = $this->kategori_model->getKategoriById($id);
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/laporan/edit', $data);
        $this->load->view('dashboard/footer');
    }
}
