<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
*
*/
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['admin_login_model']);
    }

    public function admin()
    {
        if (is_logged_in()) {
            if (is_admin()) {
                redirect('barang');
            } else {
                redirect('penjualan');
            }
        }
        $this->load->view('login_admin');
    }

    public function validation_admin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $result = $this->admin_login_model->checkUser($email, $password);
        if ($this->session->userdata('username')) {
            switch ($this->session->userdata('level')) {
                case 1:
                    redirect('penjualan');
                    break;
                
                default:
                    redirect('barang');
                    break;
            }
        } else {
            $this->session->set_flashdata('notif', 'Invalid email or Password');
            redirect('login/admin');
        }
    }

    public function forgot()
    {
        $this->load->view('lost_password');
    }

    public function logout_admin()
    {
        session_destroy();
        redirect('login/admin');
    }
}
