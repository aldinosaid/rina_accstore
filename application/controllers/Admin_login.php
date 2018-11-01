<?php  

/**
* 
*/
class Admin_login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['admin_login_model']);
		if (!is_logged_in()) {
			redirect('login/admin');
		}
	}

	public function index() {
		$users = $this->admin_login_model->getAllAdminLogin();
		$data['users'] = $users;
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/settings/admin_login/view', $data);
		$this->load->view('dashboard/footer');
	}

	public function add() {
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/settings/admin_login/add');
		$this->load->view('dashboard/footer');
	}

	public function edit($id) {
		$user = $this->admin_login_model->getAdminLoginById($id);
		$data['users'] = $user;
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/settings/admin_login/edit', $data);
		$this->load->view('dashboard/footer');
	}

	public function save() {
		$input = $this->input->post();
		$data = [
			'name' => $input['name'],
			'email' => $input['email'],
			'level' => $input['level'],
			'pass' => sha1(trim($input["password"]))
		];

		$save = $this->admin_login_model->add($data);

		if ($save) {
			$this->session->set_flashdata('notification', 'Save Successfuly');
			redirect(base_url('admin_login'));
		}

	}

	public function update($id) {
		$input = $this->input->post();
		$data = [
			'name' => $input['name'],
			'email' => $input['email'],
			'level' => $input['level']
		];

		if ($input["password"] != '') {
			$data['pass'] = sha1(trim($input["password"]));
		}

		$save = $this->admin_login_model->update($data, $id);

		if ($save) {
			redirect(base_url('admin_login'));
		}

	}
}
?>