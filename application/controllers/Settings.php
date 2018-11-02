<?php


/**
*
*/
class Settings extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        if (!is_logged_in()) {
            redirect('login/admin');
        }
    }


    public function test_print()
    {
        $barcode['barcode'] = 'B00001';
        do_barcode_print($barcode);
    }
}
