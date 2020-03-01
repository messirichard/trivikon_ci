<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Identitas_web extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->model(array('Identitas_web_model','Identitas_web_model'));
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url', 'html'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'identitas_web/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'identitas_web/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'identitas_web/index.html';
            $config['first_url'] = base_url() . 'identitas_web/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Identitas_web_model->total_rows($q);
        $identitas_web = $this->Identitas_web_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
            
        $this->data['identitas_web_data'] = $identitas_web;
        $this->data['q'] = $q;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['start'] = $start;
		
		$this->data['user'] = $this->ion_auth->user()->row();
		
		$this->data['title'] = 'identitas_web';
		$this->get_Meta();
			
        $this->data['_view'] = 'identitas_web/identitas_web_list';
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
			
			$row = $this->Identitas_web_model->get_by_id($id);
			if ($row) {
				$this->data['id_identitas'] = $this->form_validation->set_value('id_identitas',$row->id_identitas);
				$this->data['nama_web'] = $this->form_validation->set_value('nama_web',$row->nama_web);
				$this->data['meta_deskripsi'] = $this->form_validation->set_value('meta_deskripsi',$row->meta_deskripsi);
				$this->data['meta_keyword'] = $this->form_validation->set_value('meta_keyword',$row->meta_keyword);
				$this->data['copyright'] = $this->form_validation->set_value('copyright',$row->copyright);
				$this->data['logo'] = $this->form_validation->set_value('logo',$row->logo);
	    
				$this->data['title'] = 'identitas_web';
				$this->get_Meta();
				$this->data['_view'] = 'identitas_web/identitas_web_read';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('identitas_web'));
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
			$this->data['action'] = site_url('identitas_web/create_action');
		    $this->data['id_identitas'] = array(
				'name'			=> 'id_identitas',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('id_identitas'),
				'class'			=> 'form-control',
			);
		    $this->data['nama_web'] = array(
				'name'			=> 'nama_web',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('nama_web'),
				'class'			=> 'form-control',
			);
		    $this->data['meta_deskripsi'] = array(
				'name'			=> 'meta_deskripsi',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('meta_deskripsi'),
				'class'			=> 'form-control',
			);
		    $this->data['meta_keyword'] = array(
				'name'			=> 'meta_keyword',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('meta_keyword'),
				'class'			=> 'form-control',
			);
		    $this->data['copyright'] = array(
				'name'			=> 'copyright',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('copyright'),
				'class'			=> 'form-control',
			);
		    $this->data['logo'] = array(
				'name'			=> 'logo',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('logo'),
				'class'			=> 'form-control',
			);
	
			$this->data['title'] = 'identitas_web';
			$this->get_Meta();
			$this->data['_view'] = 'identitas_web/identitas_web_form';
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
		'nama_web' 			=> $this->input->post('nama_web',TRUE),
		'meta_deskripsi' 			=> $this->input->post('meta_deskripsi',TRUE),
		'meta_keyword' 			=> $this->input->post('meta_keyword',TRUE),
		'copyright' 			=> $this->input->post('copyright',TRUE),
		'logo' 			=> $this->input->post('logo',TRUE),
	    );

            $this->Identitas_web_model->insert($data);
            $this->data['message'] = 'Data berhasil ditambahkan';
            redirect(site_url('identitas_web'));
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
			
			$row = $this->Identitas_web_model->get_by_id($id);

			if ($row) {
				$this->data['button']		= 'Ubah';
				$this->data['action']		= site_url('identitas_web/update_action');
			    $this->data['id_identitas'] = array(
					'name'			=> 'id_identitas',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('id_identitas', $row->id_identitas),
					'class'			=> 'form-control',
				);
			    $this->data['nama_web'] = array(
					'name'			=> 'nama_web',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('nama_web', $row->nama_web),
					'class'			=> 'form-control',
				);
			    $this->data['meta_deskripsi'] = array(
					'name'			=> 'meta_deskripsi',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('meta_deskripsi', $row->meta_deskripsi),
					'class'			=> 'form-control',
				);
			    $this->data['meta_keyword'] = array(
					'name'			=> 'meta_keyword',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('meta_keyword', $row->meta_keyword),
					'class'			=> 'form-control',
				);
			    $this->data['copyright'] = array(
					'name'			=> 'copyright',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('copyright', $row->copyright),
					'class'			=> 'form-control',
				);
			    $this->data['logo'] = array(
					'name'			=> 'logo',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('logo', $row->logo),
					'class'			=> 'form-control',
				);
	   
				$this->data['title'] = 'identitas_web';
				$this->get_Meta();
				$this->data['_view'] = 'identitas_web/identitas_web_form';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data Tidak Ditemukan';
				redirect(site_url('identitas_web'));
			}
		}
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_identitas', TRUE));
        } else {
            $data = array(
			'nama_web' 					=> $this->input->post('nama_web',TRUE),
			'meta_deskripsi' 					=> $this->input->post('meta_deskripsi',TRUE),
			'meta_keyword' 					=> $this->input->post('meta_keyword',TRUE),
			'copyright' 					=> $this->input->post('copyright',TRUE),
			'logo' 					=> $this->input->post('logo',TRUE),
	    );

            $this->Identitas_web_model->update($this->input->post('id_identitas', TRUE), $data);
            $this->data['message'] = 'Data berhasil di ubah';
            redirect(site_url('identitas_web'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Identitas_web_model->get_by_id($id);

        if ($row) {
            $this->Identitas_web_model->delete($id);
            $this->data['message'] = 'Hapus data berhasil';
            redirect(site_url('identitas_web'));
        } else {
            $this->data['message'] = 'Data tidak ditemukan';
            redirect(site_url('identitas_web'));
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
	$this->form_validation->set_rules('nama_web', 'nama web', 'trim|required');
	$this->form_validation->set_rules('meta_deskripsi', 'meta deskripsi', 'trim|required');
	$this->form_validation->set_rules('meta_keyword', 'meta keyword', 'trim|required');
	$this->form_validation->set_rules('copyright', 'copyright', 'trim|required');
	$this->form_validation->set_rules('logo', 'logo', 'trim|required');

	$this->form_validation->set_rules('id_identitas', 'id_identitas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Identitas_web.php */
/* Location: ./application/controllers/Identitas_web.php */
