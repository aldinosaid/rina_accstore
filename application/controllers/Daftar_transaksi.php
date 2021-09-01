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
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');

        $data['transactions']  = $this->transaksi_model->get_transaction_by_date($start_date, $end_date);
        $data['required_style'] = [
            'plugins/daterangepicker/daterangepicker.css',
            'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
            'plugins/select2/css/select2.min.css',
            'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
            'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'plugins/toastr/toastr.min.css'
        ];
        $data['required_js'] = [
                'plugins/datatables/jquery.dataTables.min.js',
                'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables-responsive/js/dataTables.responsive.min.js',
                'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                'plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
                'plugins/jszip/jszip.min.js',
                'plugins/pdfmake/pdfmake.min.js',
                'plugins/pdfmake/vfs_fonts.js',
                'plugins/datatables-buttons/js/buttons.html5.min.js',
                'plugins/datatables-buttons/js/buttons.print.min.js',
                'plugins/datatables-buttons/js/buttons.colVis.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/moment/moment.min.js',
                'plugins/inputmask/jquery.inputmask.min.js',
                'plugins/daterangepicker/daterangepicker.js',
                'plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/header', $data);
        $this->load->view('v2/dashboard/transaksi/daftar_transaksi', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function detail($no_nota)
    {
    	$data['transaction'] = $this->transaksi_model->get_transaction_by_no_nota($no_nota);
        $data['orders'] = $this->transaksi_model->get_details_transaction($no_nota);
        $data['required_style'] = [
            'plugins/daterangepicker/daterangepicker.css',
            'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
            'plugins/fontawesome-free/css/all.min.css',
            'dist/css/adminlte.min.css',
            'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'plugins/toastr/toastr.min.css'
        ];
        $data['required_js'] = [
                'plugins/jquery/jquery.min.js',
                'plugins/bootstrap/js/bootstrap.bundle.min.js',
                'plugins/datatables/jquery.dataTables.min.js',
                'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'plugins/datatables-responsive/js/dataTables.responsive.min.js',
                'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                'plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
                'plugins/jszip/jszip.min.js',
                'plugins/pdfmake/pdfmake.min.js',
                'plugins/pdfmake/vfs_fonts.js',
                'plugins/datatables-buttons/js/buttons.html5.min.js',
                'plugins/datatables-buttons/js/buttons.print.min.js',
                'plugins/datatables-buttons/js/buttons.colVis.min.js',
                'dist/js/adminlte.min.js',
                'dist/js/demo.js',
                'plugins/inputmask/jquery.inputmask.min.js',
                'plugins/moment/moment.min.js',
                'plugins/daterangepicker/daterangepicker.js',
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/transaksi/penjualan/header', $data);
        $this->load->view('v2/dashboard/transaksi/detail_daftar_transaksi', $data);
        $this->load->view('v2/dashboard/transaksi/penjualan/footer', $data);
    }

    public function ajax_daftar_nota()
    {
        $input = $this->input->post();
        $start_date = $input['start_date'];
        $end_date = $input['end_date'];

        $data_transaksi = $this->transaksi_model->get_transaction_by_date($start_date, $end_date);
        $data['transactions'] = $data_transaksi;

        $response = [
            'html' => $this->load->view('v2/dashboard/transaksi/ajax_table_daftar_transaksi', $data, true)
        ];

        echo json_encode($response);
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

    public function generate_receipt_html()
    {
        $total = $this->input->post('total');
        $bayar = $this->input->post('bayar');
        $kembali = $this->input->post('kembali');
        $date   = $this->input->post('tanggal');
        $no_nota = $this->input->post('no_nota');
        $sub_total = $this->input->post('sub_total');
        $discount = $this->input->post('discount');
        $kasir = $this->input->post('kasir');

        $dataNota = [
            'no_nota'   => $no_nota,
            'tanggal'   => $date,
            'total'     => $total,
            'bayar'     => $bayar,
            'kembali'   => $kembali,
            'sub_total' => $sub_total,
            'discount'  => $discount,
            'kasir'     => $kasir
        ];

        $dataNota['orders'] = $this->penjualan_model->getDetOrders($no_nota);

        $data = [
            'receipt_html' => $this->load->view('v2/dashboard/transaksi/penjualan/receipt_html', $dataNota, true)
        ];

        echo json_encode($data);
    }

}

?>