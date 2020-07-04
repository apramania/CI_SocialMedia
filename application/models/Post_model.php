<?php
	/**
	 * Post Model Class
	 */
	class Post_model extends CI_Model
	{
		
		public function __construct()
		{
			// load the database
			$this->load->database();
		}

		// function to get posts
		public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){
			if($limit){
				$this->db->limit($limit, $offset);
			}
			if($slug === FALSE){
				$this->db->order_by('posts.id', 'DESC');
				$this->db->join('category', 'category.id = posts.category_id');
				$query = $this->db->get('posts');
				return $query->result_array();
			}
			// $this->db->join('category', 'category.id = posts.category_id');
			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}

		public function create_posts($post_img){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'post_image' => $post_img,
				'category_id' => $this->input->post('category_id'),
				'user_id' => $this->session->userdata('user_id')
			);
			

			return $this->db->insert('posts',$data);
		}

		public function delete($id){
			$this->db->where('id', $id);
			$this->db->delete('posts');

			return true;
		}

		public function update_post(){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'category_id' => $this->input->post('category_id')
			);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts',$data);
		}

		public function get_categories(){
			$this->db->order_by('name');
			$query = $this->db->get('category');
			return $query->result_array();
		}

		public function get_posts_by_category($category_id){
			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('category', 'category.id = posts.category_id');
			$query = $this->db->get_where('posts', array('category_id' => $category_id));
			return $query->result_array();
		}
	}


?>