<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->model(array('Member_model','Identitas_web_model'));
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url', 'html'));
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'member/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'member/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'member/index.html';
            $config['first_url'] = base_url() . 'member/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Member_model->total_rows($q);
        $member = $this->Member_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
            
        $this->data['member_data'] = $member;
        $this->data['q'] = $q;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['start'] = $start;
		
		$this->data['user'] = $this->ion_auth->user()->row();
		
		$this->data['title'] = 'member';
		$this->get_Meta();
			
        $this->data['_view'] = 'member/tb_member_list';
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
			
			$row = $this->Member_model->get_by_id($id);
			if ($row) {
				$this->data['id'] = $this->form_validation->set_value('id',$row->id);
				$this->data['nama'] = $this->form_validation->set_value('nama',$row->nama);
				$this->data['jabatan'] = $this->form_validation->set_value('jabatan',$row->jabatan);
				$this->data['nick_name'] = $this->form_validation->set_value('nick_name',$row->nick_name);
				$this->data['alamat_rumah'] = $this->form_validation->set_value('alamat_rumah',$row->alamat_rumah);
				$this->data['telp_aktif'] = $this->form_validation->set_value('telp_aktif',$row->telp_aktif);
				$this->data['telp_saudara'] = $this->form_validation->set_value('telp_saudara',$row->telp_saudara);
				$this->data['tgl_masuk'] = $this->form_validation->set_value('tgl_masuk',$row->tgl_masuk);
				$this->data['foto_diri'] = $this->form_validation->set_value('foto_diri',$row->foto_diri);
				$this->data['foto_ktp'] = $this->form_validation->set_value('foto_ktp',$row->foto_ktp);
				$this->data['nama_subkontraktor'] = $this->form_validation->set_value('nama_subkontraktor',$row->nama_subkontraktor);
				$this->data['status'] = $this->form_validation->set_value('status',$row->status);
	    
				$this->data['title'] = 'member';
				$this->get_Meta();
				$this->data['_view'] = 'member/tb_member_read';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data tidak ditemukan';
				redirect(site_url('member'));
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
			$this->data['action'] = site_url('member/create_action');
		    $this->data['id'] = array(
				'name'			=> 'id',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('id'),
				'class'			=> 'form-control',
			);
		    $this->data['nama'] = array(
				'name'			=> 'nama',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('nama'),
				'class'			=> 'form-control',
			);
		    $this->data['jabatan'] = array(
				'name'			=> 'jabatan',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('jabatan'),
				'class'			=> 'form-control',
			);
		    $this->data['nick_name'] = array(
				'name'			=> 'nick_name',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('nick_name'),
				'class'			=> 'form-control',
			);
		    $this->data['alamat_rumah'] = array(
				'name'			=> 'alamat_rumah',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('alamat_rumah'),
				'class'			=> 'form-control',
			);
		    $this->data['telp_aktif'] = array(
				'name'			=> 'telp_aktif',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('telp_aktif'),
				'class'			=> 'form-control',
			);
		    $this->data['telp_saudara'] = array(
				'name'			=> 'telp_saudara',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('telp_saudara'),
				'class'			=> 'form-control',
			);
		    $this->data['tgl_masuk'] = array(
				'name'			=> 'tgl_masuk',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('tgl_masuk'),
				'class'			=> 'form-control',
			);
		    $this->data['foto_diri'] = array(
				'name'			=> 'foto_diri',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('foto_diri'),
				'class'			=> 'form-control',
			);
		    $this->data['foto_ktp'] = array(
				'name'			=> 'foto_ktp',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('foto_ktp'),
				'class'			=> 'form-control',
			);
		    $this->data['nama_subkontraktor'] = array(
				'name'			=> 'nama_subkontraktor',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('nama_subkontraktor'),
				'class'			=> 'form-control',
			);
		    $this->data['status'] = array(
				'name'			=> 'status',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('status'),
				'class'			=> 'form-control',
			);
	
			$this->data['title'] = 'member';
			$this->get_Meta();
			$this->data['_view'] = 'member/tb_member_form';
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
		'nama' 			=> $this->input->post('nama',TRUE),
		'jabatan' 			=> $this->input->post('jabatan',TRUE),
		'nick_name' 			=> $this->input->post('nick_name',TRUE),
		'alamat_rumah' 			=> $this->input->post('alamat_rumah',TRUE),
		'telp_aktif' 			=> $this->input->post('telp_aktif',TRUE),
		'telp_saudara' 			=> $this->input->post('telp_saudara',TRUE),
		'tgl_masuk' 			=> $this->input->post('tgl_masuk',TRUE),
		'foto_diri' 			=> $this->input->post('foto_diri',TRUE),
		'foto_ktp' 			=> $this->input->post('foto_ktp',TRUE),
		'nama_subkontraktor' 			=> $this->input->post('nama_subkontraktor',TRUE),
		'status' 			=> $this->input->post('status',TRUE),
	    );

            $this->Member_model->insert($data);
            $this->data['message'] = 'Data berhasil ditambahkan';
            redirect(site_url('member'));
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
			
			$row = $this->Member_model->get_by_id($id);

			if ($row) {
				$this->data['button']		= 'Ubah';
				$this->data['action']		= site_url('member/update_action');
			    $this->data['id'] = array(
					'name'			=> 'id',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('id', $row->id),
					'class'			=> 'form-control',
				);
			    $this->data['nama'] = array(
					'name'			=> 'nama',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('nama', $row->nama),
					'class'			=> 'form-control',
				);
			    $this->data['jabatan'] = array(
					'name'			=> 'jabatan',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('jabatan', $row->jabatan),
					'class'			=> 'form-control',
				);
			    $this->data['nick_name'] = array(
					'name'			=> 'nick_name',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('nick_name', $row->nick_name),
					'class'			=> 'form-control',
				);
			    $this->data['alamat_rumah'] = array(
					'name'			=> 'alamat_rumah',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('alamat_rumah', $row->alamat_rumah),
					'class'			=> 'form-control',
				);
			    $this->data['telp_aktif'] = array(
					'name'			=> 'telp_aktif',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('telp_aktif', $row->telp_aktif),
					'class'			=> 'form-control',
				);
			    $this->data['telp_saudara'] = array(
					'name'			=> 'telp_saudara',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('telp_saudara', $row->telp_saudara),
					'class'			=> 'form-control',
				);
			    $this->data['tgl_masuk'] = array(
					'name'			=> 'tgl_masuk',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('tgl_masuk', $row->tgl_masuk),
					'class'			=> 'form-control',
				);
			    $this->data['foto_diri'] = array(
					'name'			=> 'foto_diri',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('foto_diri', $row->foto_diri),
					'class'			=> 'form-control',
				);
			    $this->data['foto_ktp'] = array(
					'name'			=> 'foto_ktp',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('foto_ktp', $row->foto_ktp),
					'class'			=> 'form-control',
				);
			    $this->data['nama_subkontraktor'] = array(
					'name'			=> 'nama_subkontraktor',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('nama_subkontraktor', $row->nama_subkontraktor),
					'class'			=> 'form-control',
				);
			    $this->data['status'] = array(
					'name'			=> 'status',
					'type'			=> 'text',
					'value'			=> $this->form_validation->set_value('status', $row->status),
					'class'			=> 'form-control',
				);
	   
				$this->data['title'] = 'member';
				$this->get_Meta();
				$this->data['_view'] = 'member/tb_member_form';
				$this->_render_page('layouts/main',$this->data);
			} else {
				$this->data['message'] = 'Data Tidak Ditemukan';
				redirect(site_url('member'));
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
			'nama' 					=> $this->input->post('nama',TRUE),
			'jabatan' 					=> $this->input->post('jabatan',TRUE),
			'nick_name' 					=> $this->input->post('nick_name',TRUE),
			'alamat_rumah' 					=> $this->input->post('alamat_rumah',TRUE),
			'telp_aktif' 					=> $this->input->post('telp_aktif',TRUE),
			'telp_saudara' 					=> $this->input->post('telp_saudara',TRUE),
			'tgl_masuk' 					=> $this->input->post('tgl_masuk',TRUE),
			'foto_diri' 					=> $this->input->post('foto_diri',TRUE),
			'foto_ktp' 					=> $this->input->post('foto_ktp',TRUE),
			'nama_subkontraktor' 					=> $this->input->post('nama_subkontraktor',TRUE),
			'status' 					=> $this->input->post('status',TRUE),
	    );

            $this->Member_model->update($this->input->post('id', TRUE), $data);
            $this->data['message'] = 'Data berhasil di ubah';
            redirect(site_url('member'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Member_model->get_by_id($id);

        if ($row) {
            $this->Member_model->delete($id);
            $this->data['message'] = 'Hapus data berhasil';
            redirect(site_url('member'));
        } else {
            $this->data['message'] = 'Data tidak ditemukan';
            redirect(site_url('member'));
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
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	$this->form_validation->set_rules('nick_name', 'nick name', 'trim|required');
	$this->form_validation->set_rules('alamat_rumah', 'alamat rumah', 'trim|required');
	$this->form_validation->set_rules('telp_aktif', 'telp aktif', 'trim|required');
	$this->form_validation->set_rules('telp_saudara', 'telp saudara', 'trim|required');
	$this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
	$this->form_validation->set_rules('foto_diri', 'foto diri', 'trim|required');
	$this->form_validation->set_rules('foto_ktp', 'foto ktp', 'trim|required');
	$this->form_validation->set_rules('nama_subkontraktor', 'nama subkontraktor', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_member.xls";
        $judul = "tb_member";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nick Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Rumah");
	xlsWriteLabel($tablehead, $kolomhead++, "Telp Aktif");
	xlsWriteLabel($tablehead, $kolomhead++, "Telp Saudara");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto Diri");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto Ktp");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Subkontraktor");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Member_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nick_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_rumah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telp_aktif);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telp_saudara);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto_diri);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto_ktp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_subkontraktor);
	    xlsWriteNumber($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Member.php */
/* Location: ./application/controllers/Member.php */
