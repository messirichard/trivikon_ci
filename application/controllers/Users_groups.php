<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_groups extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->model(array('Users_groups_model','Identitas_web_model'));
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url', 'html'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'users_groups/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users_groups/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users_groups/index.html';
            $config['first_url'] = base_url() . 'users_groups/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_groups_model->total_rows($q);
        $users_groups = $this->Users_groups_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
            
        $this->data['users_groups_data'] = $users_groups;
        $this->data['q'] = $q;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['start'] = $start;
		
		$this->data['user'] = $this->ion_auth->user()->row();
		
		$this->data['title'] = 'users_groups';
		$this->get_Meta();
			
        $this->data['_view'] = 'users_groups/users_groups_list';
        $this->_render_page('layouts/main', $this->data);
    }

    public function read($id) 
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Anda tidak punya akses di halaman ini');
		}
		else
		{
			$this->data['user'] = $this->ion_auth->user()->row();
			
			$row = $this->Users_groups_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['user_id'] = $this->form_validation->set_value('user_id',$row->user_id);
				$this->data['group_id'] = $this->form_validation->set_value('group_id',$row->group_id);
	    
				$this->data['title'] = 'users_groups';
				$this->get_Meta();
				$this->data['_view'] = 'users_groups/users_groups_read';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('users_groups'));
			}
		}
    }

    public function create() 
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Anda tidak punya akses di halaman ini');
		}
		else
		{
			$this->data['user'] = $this->ion_auth->user()->row();
			
			$this->data['button'] = 'Tambah';
			$this->data['action'] = site_url('users_groups/create_action');
		    $this->data['id'] = array(
				'name'			=> 'id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('id'),
				'class'			=> 'form-control',
			);
		    $this->data['user_id'] = array(
				'name'			=> 'user_id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('user_id'),
				'class'			=> 'form-control',
			);
		    $this->data['group_id'] = array(
				'name'			=> 'group_id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('group_id'),
				'class'			=> 'form-control',
			);
	
			$this->data['title'] = 'users_groups';
			$this->get_Meta();
			$this->data['_view'] = 'users_groups/users_groups_form';
			$this->_render_page('layouts/main',$this->data);
		}
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'user_id' 			=> $this->input->post('user_id',TRUE),
		'group_id' 			=> $this->input->post('group_id',TRUE),
	    );

            $this->Users_groups_model->insert($data);
            $this->data['message'] = 'Data berhasil ditambahkan';
            redirect(site_url('users_groups'));
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('Anda tidak punya akses di halaman ini');
		}
		else
		{
			$this->data['user'] = $this->ion_auth->user()->row();
			
			$row = $this->Users_groups_model->get_by_id($id);

			if ($row) {
				$this->data['button']		= 'Ubah';
				$this->data['action']		= site_url('users_groups/update_action');
			    $this->data['id'] = array(
					'name'			=> 'id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('id', $row->id),
					'class'			=> 'form-control',
				);
			    $this->data['user_id'] = array(
					'name'			=> 'user_id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('user_id', $row->user_id),
					'class'			=> 'form-control',
				);
			    $this->data['group_id'] = array(
					'name'			=> 'group_id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('group_id', $row->group_id),
					'class'			=> 'form-control',
				);
	   
				$this->data['title'] = 'users_groups';
				$this->get_Meta();
				$this->data['_view'] = 'users_groups/users_groups_form';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data Tidak Ditemukan';
				redirect(site_url('users_groups'));
			}
		}
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
			'user_id' 					=> $this->input->post('user_id',TRUE),
			'group_id' 					=> $this->input->post('group_id',TRUE),
	    );

            $this->Users_groups_model->update($this->input->post('id', TRUE), $data);
            $this->data['message'] = 'Data berhasil di ubah';
            redirect(site_url('users_groups'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_groups_model->get_by_id($id);

        if ($row) {
            $this->Users_groups_model->delete($id);
            $this->data['message'] = 'Hapus data berhasil';
            redirect(site_url('users_groups'));
        } else {
            $this->data['message'] = 'Data tidak ditemukan';
            redirect(site_url('users_groups'));
        }
    }
	
	public function get_Meta(){
		
		$rows = $this->Identitas_web_model->get_all();
		foreach ($rows as $row) {			
			$this->data['name_web'] 		= $this->form_validation->set_value('nama_web',$row->nama_web);
			$this->data['meta_description']= $this->form_validation->set_value('meta_deskripsi',$row->meta_deskripsi);
			$this->data['meta_keywords'] 	= $this->form_validation->set_value('meta_keyword',$row->meta_keyword);
			$this->data['copyrights'] 		= $this->form_validation->set_value('copyright',$row->copyright);
			$this->data['logos'] 		= $this->form_validation->set_value('logo',$row->logo);
	    }
	}
	
	public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}
	
    public function _rules() 
    {
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
	$this->form_validation->set_rules('group_id', 'group id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Users_groups.php */
/* Location: ./application/controllers/Users_groups.php */
