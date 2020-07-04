<?php

/**
 * User Model to handle all the database of the users
 */
	class User_model extends CI_Model
	{
		
		public function register($enc_password){
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password,
				'zipcode' => $this->input->post('zipcode')
			);

			//insert user
			return $this->db->insert('users',$data);
		}

		public function login($username, $password){

			$result = $this->db->get_where('users', array('username' => $username, 'password' => $password));

			if($result->num_rows() == 1){
				return $result->row(0)->id;
			}else{
				return false;
			}
		}



		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));

			//check if the user exists
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));

			//check if the user exists
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

	}

?>