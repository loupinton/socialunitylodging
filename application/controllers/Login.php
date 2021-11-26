<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
    }

	public function index()
	{
		$this->load->view('login');
	}

    public function register()
	{
		$this->load->view('register');
	}
    public function register_user()
	{
        $email_entered = $this->input->post('email_address');
        $data = new stdClass();
        if($this->login_model->email_exist($email_entered)){
            $data->status = "existed";
        }else{
            $info= array(

                    'given_name' => $this->input->post('given_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email_address' => $this->input->post('email_address'),
                    'password' => $this->input->post('password')
            );
            $this->login_model->insert_user($info);
            $data->status = "success";
        }
        echo json_encode($data);
	}
    public function verify_login()
	{
        $email_entered = $this->input->post('email_address');
        $password_entered = $this->input->post('password');
        
        $this->load->model('Login_model');
        if($this->Login_model->verified_login($email_entered,$password_entered))
        {
            $session_data= array(
                'email_address' => $email_entered
            );
            $this->session->set_userdata($session_data);
            redirect(base_url(). 'index');
        }
        else{
            $this->session->set_falshdata('error');
        }

    }
}