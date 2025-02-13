<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class soal_ujian extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if ($this->session->userdata('status') !='admin_login') {
			if ($this->session->userdata('status') !='guru_login'){
				redirect('auth');
			}
		}
		$this->load->model('m_soal');
	}

	public function index()
	{	
		if (isset($_GET['id'])) {
			$id = $this->input->get('id');
			$data['soal_ujian'] = $this->db->query('SELECT * from tb_soal_ujian join tb_materi where tb_soal_ujian.id_materi=tb_materi.id_materi and tb_materi.id_materi="'.$id.'" order by id_soal_ujian desc')->result();
			$data['kelas']=$this->m_data->get_data('tb_materi')->result();
		} else {
			$data['soal_ujian'] = $this->db->query('SELECT * FROM tb_soal_ujian join tb_materi ON tb_soal_ujian.id_materi=tb_materi.id_materi order by id_soal_ujian desc')->result();
			$data['kelas']=$this->m_data->get_data('tb_materi')->result();
		}					
		
		$this->load->view('admin/v_soal_ujian', $data);
	}

	public function edit($id)
	{
		$data['soal']=$this->m_soal->get_joinsoal($id)->result();
		$data['kelas']=$this->m_data->get_data('tb_materi')->result();		
		$this->load->view('admin/v_soal_ujian_edit', $data);		
	}

	public function update()
	{
		$id 				= $this->input->post('id');
		$nama_materi 		= $this->input->post('nama_materi');
		$pertanyaan			= $this->input->post('pertanyaan');
		$pertanyaan_2			= $this->input->post('pertanyaan_2');
		$IPK				= $this->input->post('IPK');
		$a 					= $this->input->post('a');
		$b					= $this->input->post('b');
		$c					= $this->input->post('c');
		$d					= $this->input->post('d');
		$e					= $this->input->post('e');
		$kunci_jawaban		= $this->input->post('kunci_jawaban');
		$alasan_1			= $this->input->post('alasan_1');
		$alasan_2			= $this->input->post('alasan_2');
		$alasan_3			= $this->input->post('alasan_3');
		$alasan_4			= $this->input->post('alasan_4');
		$alasan_5			= $this->input->post('alasan_5');
		$kunci_alasan		= $this->input->post('kunci_alasan');
		$pembahasan			= $this->input->post('pembahasan');
		$pembahasan_2			= $this->input->post('pembahasan_2');

		// Handle file upload
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2048; // 2MB
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		$image = NULL;
		$image_pembahasan = NULL;

		if ($this->upload->do_upload('image')) {
			$image_data = $this->upload->data();
			$image = $image_data['file_name'];
		}

		if ($this->upload->do_upload('image_pembahasan')) {
			$image_pembahasan_data = $this->upload->data();
			$image_pembahasan = $image_pembahasan_data['file_name'];
		}
		if ($this->upload->do_upload('image_a')) {
			$image_a_data = $this->upload->data();
			$image_a = $image_a_data['file_name'];
		}
		if ($this->upload->do_upload('image_b')) {
			$image_b_data = $this->upload->data();
			$image_b = $image_b_data['file_name'];
		}
		if ($this->upload->do_upload('image_c')) {
			$image_c_data = $this->upload->data();
			$image_c = $image_c_data['file_name'];
		}
		if ($this->upload->do_upload('image_d')) {
			$image_d_data = $this->upload->data();
			$image_d = $image_d_data['file_name'];
		}
		if ($this->upload->do_upload('image_e')) {
			$image_e_data = $this->upload->data();
			$image_e = $image_e_data['file_name'];
		}

		$where = array('id_soal_ujian' => $id);
		$data = array(
			'id_materi' => $nama_materi,
			'pertanyaan' => $pertanyaan,
			'pertanyaan_2' => $pertanyaan_2,
			'IPK' => $IPK,
			'a' => $a,
			'b' => $b,
			'c' => $c,
			'd' => $d,
			'e' => $e,
			'kunci_jawaban' => $kunci_jawaban,
			'alasan_1' => $alasan_1,
			'alasan_2' => $alasan_2,
			'alasan_3' => $alasan_3,
			'alasan_4' => $alasan_4,
			'alasan_5' => $alasan_5,
			'kunci_alasan' => $kunci_alasan,
			'pembahasan' => $pembahasan,
			'pembahasan_2' => $pembahasan_2,
		);

		if ($image) {
			$data['image'] = $image;
		}

		if ($image_pembahasan) {
			$data['image_pembahasan'] = $image_pembahasan;
		}
		if ($image_a) {
			$data['image_a'] = $image_a;
		}
		if ($image_b) {
			$data['image_b'] = $image_b;
		}
		if ($image_c) {
			$data['image_c'] = $image_c;
		}
		if ($image_d) {
			$data['image_d'] = $image_d;
		}
		if ($image_e) {
			$data['image_e'] = $image_e;
		}


		$this->m_data->update_data($where, $data, 'tb_soal_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal telah berhasil diupdate!</h4></div>');
		redirect(base_url('soal_ujian'));
	}

	public function hapus($id) 
	{
		$where = array('id_soal_ujian' => $id);
		
		// Get the image name from the database
		$soal = $this->m_data->get_data_where('tb_soal_ujian', $where)->row();
		$image = $soal->image;

		// Delete the image file if it exists
		if ($image && file_exists('./uploads/' . $image)) {
			unlink('./uploads/' . $image);
		}
		// Delete the image file if it exists
		if ($image_pembahasan && file_exists('./uploads/' . $image_pembahasan)) {
			unlink('./uploads/' . $image_pembahasan);
		}
		// Delete the image file if it exists
		if ($image_a && file_exists('./uploads/' . $image_a)) {
			unlink('./uploads/' . $image_a);
		}
		// Delete the image file if it exists
		if ($image_b && file_exists('./uploads/' . $image_b)) {
			unlink('./uploads/' . $image_b);
		}
		// Delete the image file if it exists
		if ($image_c && file_exists('./uploads/' . $image_c)) {
			unlink('./uploads/' . $image_c);
		}
		// Delete the image file if it exists
		if ($image_d && file_exists('./uploads/' . $image_d)) {
			unlink('./uploads/' . $image_d);
		}
		// Delete the image file if it exists
		if ($image_e && file_exists('./uploads/' . $image_e)) {
			unlink('./uploads/' . $image_e);
		}


		// Delete the record from the database
		$this->m_data->delete_data($where, 'tb_soal_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Perhatian, Data telah berhasil dihapus!</h4></div>');
		redirect(base_url('soal_ujian'));
	}
}