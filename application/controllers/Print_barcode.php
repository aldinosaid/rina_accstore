<?php


/**
*
*/
class Print_barcode extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(['barang_model']);
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function index()
    {
        $data['barang'] = $this->barang_model->getItemOrderByBarcode();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/print_barcode/view', $data);
        $this->load->view('dashboard/footer');
    }

    public function do_print()
    {
        $args = [
            'barcode' => $this->input->post('barcode')
        ];
        $barang = $this->barang_model->getByBarcode($args);
        $nama_barang = $barang[0]->nama_brg;
        if (strlen($nama_barang) > 20) {
            $nama_barang = substr($barang[0]->nama_brg, 0, 15) . '.....';
        }
        $data = [
            'barcode' => $this->input->post('barcode'),
            'harga' => idr_format($barang[0]->harga_jual),
            'nama_barang' => $nama_barang,
            'qty' => $this->input->post('qty') 
        ];

        echo do_barcode_print($data);

    }
}
