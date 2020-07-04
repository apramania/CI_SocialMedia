<?php
	class Posts extends CI_Controller{
		public function index($offset = 0){

			//config for pagination
			$config['base_url'] = base_url() . 'posts/index/';
			$config['total_rows'] = $this->db->count_all('posts');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'pagination-link');

			//initialize the pagination
			$this->pagination->initialize($config);


			$data['title'] = 'Latest Posts';

			$data['posts'] = $this->Post_model->get_posts(FALSE, $config['per_page'], $offset);
			// print_r($data['posts']);

			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

		public function view($slug = NULL){
			$data['post'] = $this->Post_model->get_posts($slug);
			// print_r($data['post']);

			$post_id = $data['post']['id'];
			$data['comments'] = $this->Comment_model->get_comments($post_id);

			if(empty($data['post'])){
				show_404();
			}

			$data['title'] = $data['post']['title'];

			$this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');

		}

		public function add(){

			//check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['title'] = 'Add Posts';

			$data['category'] = $this->Post_model->get_categories();

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() == FALSE){
				$this->load->view('templates/header');
				$this->load->view('posts/add', $data);
				$this->load->view('templates/footer');
			}else{
				//upload image
				$config['upload_path'] = './uploads';
				$config['allowed_types'] = 'gif|png|jpg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(! $this->upload->do_upload()){
					$errors = array('error' => $this->upload->display_errors());
					// print_r($errors);
					// $this->load->view('posts/view', $error);
					$post_img = 'noimage.jpg';
				}else{
					$data = array('upload_data' => $this->upload->data());
					$post_img = $_FILES['userfile']['name'];
				}

				$this->Post_model->create_posts($post_img);

				//set message
				$this->session->set_flashdata('post_created', 'Post Created Succesfully');

				redirect('posts');
			}

			
		}

		public function delete($id){

			//check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}
			$this->Post_model->delete($id);
			//set message
			$this->session->set_flashdata('post_deleted', 'Post Deleted Succesfully');

			redirect('posts');
		}

		public function edit($slug){
			//check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}
			$data['post'] = $this->Post_model->get_posts($slug);

			//check user
			if($this->session->userdata('user_id') != $this->Post_model->get_posts($slug)['user_id']){
				redirect('posts');
			}

			$data['category'] = $this->Post_model->get_categories();
			// print_r($data);

			if(empty($data['post'])){
				show_404();
			}

			// print_r($data);

			$data['title'] = 'Edit Posts';

			$this->load->view('templates/header');
			$this->load->view('posts/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update(){
			//check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}
			$this->Post_model->update_post();

			//set message
			$this->session->set_flashdata('post_updated', 'Post Updated Succesfully');

			redirect('posts');
		}
	}
?>