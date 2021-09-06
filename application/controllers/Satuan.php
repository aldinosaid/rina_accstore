<?php


/**
*
*/
class Satuan extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['satuan_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function index()
    {
        $data['satuan'] = $this->satuan_model->getAll();
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
        $this->load->view('v2/dashboard/satuan/view', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function add()
    {
        $data['required_style'] = [
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
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/header', $data);
        $this->load->view('v2/dashboard/satuan/add', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function edit($id)
    {
        $data['satuan'] = $this->satuan_model->getSatuanById($id);
        $data['required_style'] = [
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
                'plugins/sweetalert2/sweetalert2.min.js',
                'plugins/toastr/toastr.min.js'
           ];
        $this->load->view('v2/dashboard/header', $data);
        $this->load->view('v2/dashboard/satuan/edit', $data);
        $this->load->view('v2/dashboard/footer');
    }

    public function update($kode_kat)
    {
        $input = $this->input->post();

        $args = [
            'satuan' => strtoupper($input['satuan'])
        ];

        $update = $this->satuan_model->update($args, $kode_kat);
        if ($update) {
            $result = [
                'status' => 'true',
                'messageType' => 'success',
                'message' => 'Data satuan berhasil diubah.'
            ];
        } else {
            $result = [
                'status' => 'false',
                'messageType' => 'danger',
                'message' => 'Data satuan gagal diubah.'
            ];
        }
        echo json_encode($result);
    }

    public function delete($kode_kat)
    {
        $deleted = $this->satuan_model->delete($kode_kat);
        if ($deleted) {
            $result = [
                'status' => 'true',
                'messageType' => 'success',
                'messageInfo' => 'Berhasil!',
                'message' => 'Data satuan berhasil dihapus.'
            ];
        } else {
            $result = [
                'status' => 'false',
                'messageType' => 'danger',
                'messageInfo' => 'Gagal!',
                'message' => 'Data satuan gagal dihapus.'
            ];
        }
        echo json_encode($result);
    }

    public function save()
    {
        $input = $this->input->post();

        $args = [
            'satuan' => strtoupper($input['satuan'])
        ];

        $save = $this->satuan_model->insert($args);
        if ($save) {
            $result = [
                'status' => 'true',
                'messageType' => 'success',
                'message' => 'Data satuan berhasil disimpan.'
            ];
        } else {
            $result = [
                'status' => 'false',
                'messageType' => 'danger',
                'message' => 'Data satuan gagal disimpan.'
            ];
        }
        echo json_encode($result);
    }
}
