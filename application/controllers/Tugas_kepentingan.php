<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tugas_kepentingan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->model(array('Tugas_kepentingan_model','Identitas_web_model'));
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url', 'html'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tugas_kepentingan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tugas_kepentingan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tugas_kepentingan/index.html';
            $config['first_url'] = base_url() . 'tugas_kepentingan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tugas_kepentingan_model->total_rows($q);
        $tugas_kepentingan = $this->Tugas_kepentingan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
            
        $this->data['tugas_kepentingan_data'] = $tugas_kepentingan;
        $this->data['q'] = $q;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['start'] = $start;
		
		$this->data['user'] = $this->ion_auth->user()->row();
		
		$this->data['title'] = 'tugas_kepentingan';
		$this->get_Meta();
			
        $this->data['_view'] = 'tugas_kepentingan/tb_tugas_kepentingan_list';
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
			
			$row = $this->Tugas_kepentingan_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['kepentingan'] = $this->form_validation->set_value('kepentingan',$row->kepentingan);
				$this->data['nama_kepentingan'] = $this->form_validation->set_value('nama_kepentingan',$row->nama_kepentingan);
	    
				$this->data['title'] = 'tugas_kepentingan';
				$this->get_Meta();
				$this->data['_view'] = 'tugas_kepentingan/tb_tugas_kepentingan_read';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('tugas_kepentingan'));
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
			$this->data['action'] = site_url('tugas_kepentingan/create_action');
		    $this->data['id'] = array(
				'name'			=> 'id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('id'),
				'class'			=> 'form-control',
			);
		    $this->data['kepentingan'] = array(
				'name'			=> 'kepentingan',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('kepentingan'),
				'class'			=> 'form-control',
			);
		    $this->data['nama_kepentingan'] = array(
				'name'			=> 'nama_kepentingan',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('nama_kepentingan'),
				'class'			=> 'form-control',
			);
	
			$this->data['title'] = 'tugas_kepentingan';
			$this->get_Meta();
			$this->data['_view'] = 'tugas_kepentingan/tb_tugas_kepentingan_form';
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
		'kepentingan' 			=> $this->input->post('kepentingan',TRUE),
		'nama_kepentingan' 			=> $this->input->post('nama_kepentingan',TRUE),
	    );

            $this->Tugas_kepentingan_model->insert($data);
            $this->data['message'] = 'Data berhasil ditambahkan';
            redirect(site_url('tugas_kepentingan'));
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
			
			$row = $this->Tugas_kepentingan_model->get_by_id($id);

			if ($row) {
				$this->data['button']		= 'Ubah';
				$this->data['action']		= site_url('tugas_kepentingan/update_action');
			    $this->data['id'] = array(
					'name'			=> 'id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('id', $row->id),
					'class'			=> 'form-control',
				);
			    $this->data['kepentingan'] = array(
					'name'			=> 'kepentingan',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('kepentingan', $row->kepentingan),
					'class'			=> 'form-control',
				);
			    $this->data['nama_kepentingan'] = array(
					'name'			=> 'nama_kepentingan',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('nama_kepentingan', $row->nama_kepentingan),
					'class'			=> 'form-control',
				);
	   
				$this->data['title'] = 'tugas_kepentingan';
				$this->get_Meta();
				$this->data['_view'] = 'tugas_kepentingan/tb_tugas_kepentingan_form';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data Tidak Ditemukan';
				redirect(site_url('tugas_kepentingan'));
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
			'kepentingan' 					=> $this->input->post('kepentingan',TRUE),
			'nama_kepentingan' 					=> $this->input->post('nama_kepentingan',TRUE),
	    );

            $this->Tugas_kepentingan_model->update($this->input->post('id', TRUE), $data);
            $this->data['message'] = 'Data berhasil di ubah';
            redirect(site_url('tugas_kepentingan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tugas_kepentingan_model->get_by_id($id);

        if ($row) {
            $this->Tugas_kepentingan_model->delete($id);
            $this->data['message'] = 'Hapus data berhasil';
            redirect(site_url('tugas_kepentingan'));
        } else {
            $this->data['message'] = 'Data tidak ditemukan';
            redirect(site_url('tugas_kepentingan'));
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
	$this->form_validation->set_rules('kepentingan', 'kepentingan', 'trim|required');
	$this->form_validation->set_rules('nama_kepentingan', 'nama kepentingan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_tugas_kepentingan.xls";
        $judul = "tb_tugas_kepentingan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kepentingan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kepentingan");

	foreach ($this->Tugas_kepentingan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kepentingan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kepentingan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tugas_kepentingan.php */
/* Location: ./application/controllers/Tugas_kepentingan.php */
