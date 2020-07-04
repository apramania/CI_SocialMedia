<?php
	class Users extends CI_Controller{
		public function register(){
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');


			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			}else{
				//encrypt password
				$enc_password = md5($this->input->post('password'));

				$this->User_model->register($enc_password);

				//set message
				$this->session->set_flashdata('user_registered', 'You are registered and can log in');

				redirect('posts');
			}
		}

		//check username exits
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken. Please try a different one.');
			if($this->User_model->check_username_exists($username)){
				return true;
			}else{
				return false;
			}
		}

		//check email exits
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken. Please try a different one.');
			if($this->User_model->check_email_exists($email)){
				return true;
			}else{
				return false;
			}
		}

		public function login(){
			$data['title'] = 'Log In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');



			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			}else{
				//load the users model to login 
				//get the username
				$username = $this->input->post('username');

				//get and encrypt the password
				$password = md5($this->input->post('password'));

				//login user
				$user_id = $this->User_model->login($username, $password);

				if($user_id){
					//create session
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					//set message
					//set message
					$this->session->set_flashdata('user_loggedin', 'You are now Logged In');
					// print_r($user_id);
					redirect('posts');
				}else{
					//set message
					//set message
					$this->session->set_flashdata('login_failed', 'Login Failed');
					// print_r($user_id);
					redirect('users/login');
				}

				
			}
		}

		//log out
		public function logout(){
			//unset the session
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');


			$this->session->set_flashdata('user_loggedout', 'You are now Logged Out');

			redirect('users/login');
		}
	}

?>