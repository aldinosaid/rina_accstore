<?php


/**
*
*/
class Dashboard extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['laporan_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function index()
    {
        $start_date = date('Y-01-01');
        $end_date = date('Y-m-t');
        $omset = [0,0,0,0,0,0,0,0,0,0,0,0];

        $report_data = $this->laporan_model->get_ringkasan_penjualan($start_date, $end_date);
        // $item_best_seller = $this->laporan_model->get_data_item_best_seller($start_date, $end_date);
        // $category_best_seller = $this->laporan_model->get_data_category_best_seller($start_date, $end_date);
        $get_chart_data = $this->laporan_model->get_grafik_data_penjualan($start_date, $end_date);

        $i = 0;
        foreach ($get_chart_data as $chart_data) {
            $omset[$i] = $chart_data->omset;
            $i++;
        }

        $data['ringkasan_laporan'] = $report_data;
        $data['items'] = [];
        $data['categories'] = [];
        $data['omset'] = $omset;

        $data['required_style'] = [
            'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            'plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
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
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/header', $data);
        $this->load->view('v2/dashboard/dashboard/view', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function ajax_item_best_seller()
    {
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');
        $data['items'] = $this->laporan_model->get_data_item_best_seller($start_date, $end_date);

        $html = $this->load->view('v2/dashboard/dashboard/ajax_item_best_seller', $data);

        echo json_encode($html);
    }

    public function ajax_category_best_seller()
    {
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');
        $data['categories'] = $this->laporan_model->get_data_category_best_seller($start_date, $end_date);

        $html['html'] = $this->load->view('v2/dashboard/dashboard/ajax_category_best_seller', $data);

        echo json_encode($html);
    }
}
