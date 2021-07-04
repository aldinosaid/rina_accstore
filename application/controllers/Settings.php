<?php


/**
*
*/
class Settings extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model(
            [
                'laporan_model',
                'barang_model',
                'kategori_model',
                'penjualan_model'
            ]
        );
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }

    public function factory_reset()
    {
        $this->barang_model->factory_reset();
        $this->kategori_model->factory_reset();
        $this->penjualan_model->factory_reset();
    }

    public function test_print()
    {
        $barcode['barcode'] = 'SPT000001';
        do_barcode_print($barcode);
    }
}
