<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tugas_lists extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->model(array('Tugas_lists_model','Identitas_web_model'));
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url', 'html'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tugas_lists/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tugas_lists/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tugas_lists/index.html';
            $config['first_url'] = base_url() . 'tugas_lists/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tugas_lists_model->total_rows($q);
        $tugas_lists = $this->Tugas_lists_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
            
        $this->data['tugas_lists_data'] = $tugas_lists;
        $this->data['q'] = $q;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['start'] = $start;
		
		$this->data['user'] = $this->ion_auth->user()->row();
		
		$this->data['title'] = 'tugas_lists';
		$this->get_Meta();
			
        $this->data['_view'] = 'tugas_lists/tb_tugas_lists_list';
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
			
			$row = $this->Tugas_lists_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['dari'] = $this->form_validation->set_value('dari',$row->dari);
				$this->data['kepada'] = $this->form_validation->set_value('kepada',$row->kepada);
				$this->data['prioritas'] = $this->form_validation->set_value('prioritas',$row->prioritas);
				$this->data['subject_kepentingan'] = $this->form_validation->set_value('subject_kepentingan',$row->subject_kepentingan);
				$this->data['deskripsi'] = $this->form_validation->set_value('deskripsi',$row->deskripsi);
				$this->data['status'] = $this->form_validation->set_value('status',$row->status);
				$this->data['status_selesai'] = $this->form_validation->set_value('status_selesai',$row->status_selesai);
				$this->data['member_id'] = $this->form_validation->set_value('member_id',$row->member_id);
				$this->data['admin_id'] = $this->form_validation->set_value('admin_id',$row->admin_id);
				$this->data['date_input'] = $this->form_validation->set_value('date_input',$row->date_input);
				$this->data['date_finish'] = $this->form_validation->set_value('date_finish',$row->date_finish);
				$this->data['data'] = $this->form_validation->set_value('data',$row->data);
	    
				$this->data['title'] = 'tugas_lists';
				$this->get_Meta();
				$this->data['_view'] = 'tugas_lists/tb_tugas_lists_read';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('tugas_lists'));
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
			$this->data['action'] = site_url('tugas_lists/create_action');
		    $this->data['id'] = array(
				'name'			=> 'id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('id'),
				'class'			=> 'form-control',
			);
		    $this->data['dari'] = array(
				'name'			=> 'dari',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('dari'),
				'class'			=> 'form-control',
			);
		    $this->data['kepada'] = array(
				'name'			=> 'kepada',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('kepada'),
				'class'			=> 'form-control',
			);
		    $this->data['prioritas'] = array(
				'name'			=> 'prioritas',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('prioritas'),
				'class'			=> 'form-control',
			);
		    $this->data['subject_kepentingan'] = array(
				'name'			=> 'subject_kepentingan',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('subject_kepentingan'),
				'class'			=> 'form-control',
			);
		    $this->data['deskripsi'] = array(
				'name'			=> 'deskripsi',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('deskripsi'),
				'class'			=> 'form-control',
			);
		    $this->data['status'] = array(
				'name'			=> 'status',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('status'),
				'class'			=> 'form-control',
			);
		    $this->data['status_selesai'] = array(
				'name'			=> 'status_selesai',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('status_selesai'),
				'class'			=> 'form-control',
			);
		    $this->data['member_id'] = array(
				'name'			=> 'member_id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('member_id'),
				'class'			=> 'form-control',
			);
		    $this->data['admin_id'] = array(
				'name'			=> 'admin_id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('admin_id'),
				'class'			=> 'form-control',
			);
		    $this->data['date_input'] = array(
				'name'			=> 'date_input',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('date_input'),
				'class'			=> 'form-control',
			);
		    $this->data['date_finish'] = array(
				'name'			=> 'date_finish',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('date_finish'),
				'class'			=> 'form-control',
			);
		    $this->data['data'] = array(
				'name'			=> 'data',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('data'),
				'class'			=> 'form-control',
			);
	
			$this->data['title'] = 'tugas_lists';
			$this->get_Meta();
			$this->data['_view'] = 'tugas_lists/tb_tugas_lists_form';

			$this->data['list_kepentingan'] = $this->db->get('tb_tugas_kepentingan')->result();

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
		'dari' 			=> $this->input->post('dari',TRUE),
		'kepada' 			=> $this->input->post('kepada',TRUE),
		'prioritas' 			=> $this->input->post('prioritas',TRUE),
		'subject_kepentingan' 			=> $this->input->post('subject_kepentingan',TRUE),
		'deskripsi' 			=> $this->input->post('deskripsi',TRUE),
		'status' 			=> $this->input->post('status',TRUE),
		'status_selesai' 			=> $this->input->post('status_selesai',TRUE),
		'member_id' 			=> $this->input->post('member_id',TRUE),
		'admin_id' 			=> $this->input->post('admin_id',TRUE),
		'date_input' 			=> $this->input->post('date_input',TRUE),
		'date_finish' 			=> $this->input->post('date_finish',TRUE),
		'data' 			=> $this->input->post('data',TRUE),
	    );

            $this->Tugas_lists_model->insert($data);
            $this->data['message'] = 'Data berhasil ditambahkan';
            redirect(site_url('tugas_lists'));
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
			
			$row = $this->Tugas_lists_model->get_by_id($id);

			if ($row) {
				$this->data['button']		= 'Ubah';
				$this->data['action']		= site_url('tugas_lists/update_action');
			    $this->data['id'] = array(
					'name'			=> 'id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('id', $row->id),
					'class'			=> 'form-control',
				);
			    $this->data['dari'] = array(
					'name'			=> 'dari',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('dari', $row->dari),
					'class'			=> 'form-control',
				);
			    $this->data['kepada'] = array(
					'name'			=> 'kepada',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('kepada', $row->kepada),
					'class'			=> 'form-control',
				);
			    $this->data['prioritas'] = array(
					'name'			=> 'prioritas',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('prioritas', $row->prioritas),
					'class'			=> 'form-control',
				);
			    $this->data['subject_kepentingan'] = array(
					'name'			=> 'subject_kepentingan',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('subject_kepentingan', $row->subject_kepentingan),
					'class'			=> 'form-control',
				);
			    $this->data['deskripsi'] = array(
					'name'			=> 'deskripsi',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('deskripsi', $row->deskripsi),
					'class'			=> 'form-control',
				);
			    $this->data['status'] = array(
					'name'			=> 'status',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('status', $row->status),
					'class'			=> 'form-control',
				);
			    $this->data['status_selesai'] = array(
					'name'			=> 'status_selesai',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('status_selesai', $row->status_selesai),
					'class'			=> 'form-control',
				);
			    $this->data['member_id'] = array(
					'name'			=> 'member_id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('member_id', $row->member_id),
					'class'			=> 'form-control',
				);
			    $this->data['admin_id'] = array(
					'name'			=> 'admin_id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('admin_id', $row->admin_id),
					'class'			=> 'form-control',
				);
			    $this->data['date_input'] = array(
					'name'			=> 'date_input',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('date_input', $row->date_input),
					'class'			=> 'form-control',
				);
			    $this->data['date_finish'] = array(
					'name'			=> 'date_finish',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('date_finish', $row->date_finish),
					'class'			=> 'form-control',
				);
			    $this->data['data'] = array(
					'name'			=> 'data',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('data', $row->data),
					'class'			=> 'form-control',
				);
	   
				$this->data['title'] = 'tugas_lists';
				$this->get_Meta();
				$this->data['_view'] = 'tugas_lists/tb_tugas_lists_form';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data Tidak Ditemukan';
				redirect(site_url('tugas_lists'));
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
			'dari' 					=> $this->input->post('dari',TRUE),
			'kepada' 					=> $this->input->post('kepada',TRUE),
			'prioritas' 					=> $this->input->post('prioritas',TRUE),
			'subject_kepentingan' 					=> $this->input->post('subject_kepentingan',TRUE),
			'deskripsi' 					=> $this->input->post('deskripsi',TRUE),
			'status' 					=> $this->input->post('status',TRUE),
			'status_selesai' 					=> $this->input->post('status_selesai',TRUE),
			'member_id' 					=> $this->input->post('member_id',TRUE),
			'admin_id' 					=> $this->input->post('admin_id',TRUE),
			'date_input' 					=> $this->input->post('date_input',TRUE),
			'date_finish' 					=> $this->input->post('date_finish',TRUE),
			'data' 					=> $this->input->post('data',TRUE),
	    );

            $this->Tugas_lists_model->update($this->input->post('id', TRUE), $data);
            $this->data['message'] = 'Data berhasil di ubah';
            redirect(site_url('tugas_lists'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tugas_lists_model->get_by_id($id);

        if ($row) {
            $this->Tugas_lists_model->delete($id);
            $this->data['message'] = 'Hapus data berhasil';
            redirect(site_url('tugas_lists'));
        } else {
            $this->data['message'] = 'Data tidak ditemukan';
            redirect(site_url('tugas_lists'));
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
	$this->form_validation->set_rules('dari', 'dari', 'trim|required');
	$this->form_validation->set_rules('kepada', 'kepada', 'trim|required');
	$this->form_validation->set_rules('prioritas', 'prioritas', 'trim|required');
	$this->form_validation->set_rules('subject_kepentingan', 'subject kepentingan', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('status_selesai', 'status selesai', 'trim|required');
	$this->form_validation->set_rules('member_id', 'member id', 'trim|required');
	$this->form_validation->set_rules('admin_id', 'admin id', 'trim|required');
	$this->form_validation->set_rules('date_input', 'date input', 'trim|required');
	$this->form_validation->set_rules('date_finish', 'date finish', 'trim|required');
	$this->form_validation->set_rules('data', 'data', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_tugas_lists.xls";
        $judul = "tb_tugas_lists";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Dari");
	xlsWriteLabel($tablehead, $kolomhead++, "Kepada");
	xlsWriteLabel($tablehead, $kolomhead++, "Prioritas");
	xlsWriteLabel($tablehead, $kolomhead++, "Subject Kepentingan");
	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Selesai");
	xlsWriteLabel($tablehead, $kolomhead++, "Member Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Admin Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Input");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Finish");
	xlsWriteLabel($tablehead, $kolomhead++, "Data");

	foreach ($this->Tugas_lists_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dari);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kepada);
	    xlsWriteLabel($tablebody, $kolombody++, $data->prioritas);
	    xlsWriteNumber($tablebody, $kolombody++, $data->subject_kepentingan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_selesai);
	    xlsWriteNumber($tablebody, $kolombody++, $data->member_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->admin_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_input);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_finish);
	    xlsWriteLabel($tablebody, $kolombody++, $data->data);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tugas_lists.php */
/* Location: ./application/controllers/Tugas_lists.php */
