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


    public function ringkasan_penjualan()
    {
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');

        $report_data = $this->laporan_model->getRinigkasanPenjualan($start_date, $end_date);

        $data['ringkasan_laporan'] = $report_data;
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
        $this->load->view('v2/dashboard/laporan/ringkasan_penjualan', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function ajax_filter()
    {
        $input = $this->input->post();
        $start_date = $input['start_date'];
        $end_date = $input['end_date'];

        $report_data = $this->laporan_model->getRinigkasanPenjualan($start_date, $end_date);
        $data['ringkasan_laporan'] = $report_data;

        $response = [
            'html' => $this->load->view('v2/dashboard/laporan/ajax_ringkasan_penjualan', $data, true)
        ];

        echo json_encode($response);
    }
}
