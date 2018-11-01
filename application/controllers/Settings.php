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


	public function test_print() {
		do_print();
	}
}
?>