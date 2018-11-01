<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

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

	public function admin() {
		$this->load->view('login_admin');
	}

	public function validation_admin() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$result = $this->admin_login_model->checkUser($email, $password);
		if ($this->session->userdata('username')) {
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('notif', 'Invalid email or Password');
			redirect('login/admin');
		}
	}

	public function forgot() {
		$this->load->view('lost_password');
	}

	public function logout_admin() {
		session_destroy();
		redirect('login/admin');
	}

}

?>