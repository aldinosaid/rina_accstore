<?php

/**
*
*/
class Daftar_transaksi extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['transaksi_model', 'penjualan_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }

    public function index()
    {
        $data['transactions']  = $this->transaksi_model->get_all_transaction();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/penjualan/daftar_transaksi/view_transaction', $data);
        $this->load->view('dashboard/footer');
    }

    public function detail($no_nota)
    {
    	$data['transaction'] = $this->transaksi_model->get_transaction_by_no_nota($no_nota);
        $data['detail_transaction'] = $this->transaksi_model->get_details_transaction($no_nota);
        $this->load->view('dashboard/penjualan/header');
        $this->load->view('dashboard/penjualan/daftar_transaksi/view_detail_transaction', $data);
        $this->load->view('dashboard/penjualan/footer');
    }

    public function cetak($no_nota)
    {
    	$total = $this->input->post('total');
        $bayar = $this->input->post('bayar');
        $kembali = $this->input->post('kembali');
        $date   = $this->input->post('tanggal');

        $dataNota = [
            'no_nota'   => $no_nota,
            'tanggal'   => $date,
            'total'     => idrToString($total),
            'bayar'     => idrToString($bayar),
            'kembali'   => idrToString($kembali)
        ];

        $dataNota['orders'] = $this->penjualan_model->getDetOrders($no_nota);
        $dataNota['kasir']  = $this->session->userdata('username');

        if (do_print($dataNota)) {
            echo "success";
        } else {
            echo "error";
        }
    }

}

?>