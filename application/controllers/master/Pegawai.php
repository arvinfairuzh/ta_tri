<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends MY_Controller
{



	public function __construct()

	{

		parent::__construct();
	}



	public function index()

	{

		$data['page_name'] = "pegawai";

		$this->template->load('template/template', 'master/pegawai/all-pegawai', $data);
	}

	public function password_check($str)
	{
		$this->form_validation->set_message('password_check', "password must combine alphabet and numeric");
		$message = FALSE;
		if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
			$message = TRUE;
		}
		return $message;
	}

	public function create()

	{

		$this->load->view('master/pegawai/add-pegawai');
	}

	public function validate()

	{

		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules('dt[nik]', '<strong>Nik</strong>', 'required');
		$this->form_validation->set_rules('dt[email]', '<strong>Email</strong>', 'required');
		$this->form_validation->set_rules('dt[nama]', '<strong>Nama</strong>', 'required');
		$this->form_validation->set_rules('dt[id_role]', '<strong>Id Role</strong>', 'required');
	}



	public function store()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules(
			'dt[nik]',
			'<strong>NIK</strong>',
			'required|is_unique[pegawai.nik]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules(
			'dt[email]',
			'<strong>Email</strong>',
			'required|is_unique[pegawai.email]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);
		$this->form_validation->set_rules('dt[password]', '<strong>Pasword</strong>', 'required|min_length[6]|callback_password_check');
		$this->form_validation->set_rules('password_confirmation_field', 'Password Confirmation Field', 'required|matches[dt[password]]');
		$this->form_validation->set_rules('dt[nama]', '<strong>Nama</strong>', 'required');
		$this->form_validation->set_rules('dt[id_role]', '<strong>Id Role</strong>', 'required');

		if ($this->form_validation->run() == FALSE) {

			$this->alert->alertdanger(validation_errors());
		} else {

			$dt = $_POST['dt'];
			$dt['password'] = md5($dt['password']);
			$dt['created_by'] = $_SESSION['id'];
			$dt['created_at'] = date('Y-m-d H:i:s');
			$dt['status'] = "ENABLE";
			$str = $this->mymodel->insertData('pegawai', $dt);
			$last_id = $this->db->insert_id();
			if (!empty($_FILES['file']['name'])) {
				$dir  = "webfile/";
				$config['upload_path']          = $dir;
				$config['allowed_types']        = '*';
				$config['file_name']           = md5('smartsoftstudio') . rand(1000, 100000);
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file')) {
					$error = $this->upload->display_errors();
					$this->alert->alertdanger($error);
				} else {
					$file = $this->upload->data();
					$data = array(
						'id' => '',
						'name' => $file['file_name'],
						'mime' => $file['file_type'],
						'dir' => $dir . $file['file_name'],
						'table' => 'pegawai',
						'table_id' => $last_id,
						'status' => 'ENABLE',
						'created_at' => date('Y-m-d H:i:s')
					);
					$str = $this->mymodel->insertData('file', $data);
					$this->alert->alertsuccess('Success Send Data');
				}
			} else {
				$data = array(
					'id' => '',
					'name' => '',
					'mime' => '',
					'dir' => '',
					'table' => 'pegawai',
					'table_id' => $last_id,
					'status' => 'ENABLE',
					'created_at' => date('Y-m-d H:i:s')
				);

				$str = $this->mymodel->insertData('file', $data);
				$this->alert->alertsuccess('Success Send Data');
			}
		}
	}

	public function json()
	{
		$status = $_GET['status'];
		if ($status == '') {
			$status = 'ENABLE';
		}
		header('Content-Type: application/json');
		$this->datatables->select('pegawai.id,nik,email,password,nama,role.role as id_role,pegawai.status');
		$this->datatables->where('pegawai.status', $status);
		$this->datatables->from('pegawai');
		$this->datatables->join('role', 'pegawai.id_role=role.id', 'left');
		if ($status == "ENABLE") {
			$this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button></div>', 'id');
		} else {
			$this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button><button type="button" onclick="hapus($1)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Hapus</button></div>', 'id');
		}
		echo $this->datatables->generate();
	}

	public function edit($id)
	{
		$data['pegawai'] = $this->mymodel->selectDataone('pegawai', array('id' => $id));
		$data['file'] = $this->mymodel->selectDataone('file', array('table_id' => $id, 'table' => 'pegawai'));
		$data['page_name'] = "pegawai";
		$this->load->view('master/pegawai/edit-pegawai', $data);
	}

	public function update()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$nik = $_POST['dt']['nik'];
		$email = $_POST['dt']['email'];
		$password = $this->input->post('password');

		$nik1 = $this->input->post('nik');
		if ($nik != $nik1) {
			$this->form_validation->set_rules(
				'dt[nik]',
				'<strong>nik</strong>',
				'required|is_unique[user.nik]',
				array(
					'required'      => 'You have not provided %s.',
					'is_unique'     => 'This %s already exists.'
				)
			);
		}

		$email1 = $this->input->post('email');
		if ($email != $email1) {
			$this->form_validation->set_rules(
				'dt[email]',
				'<strong>email</strong>',
				'required|is_unique[user.email]',
				array(
					'required'      => 'You have not provided %s.',
					'is_unique'     => 'This %s already exists.'
				)
			);
		}

		if ($password != "") {
			$this->form_validation->set_rules('password', '<strong>Pasword</strong>', 'required|min_length[6]|callback_password_check');
			$this->form_validation->set_rules('password_confirmation_field', 'Password Confirmation Field', 'required|matches[password]');
			$this->form_validation->set_rules('dt[nama]', '<strong>Nama</strong>', 'required');
			$this->form_validation->set_rules('dt[id_role]', '<strong>Id Role</strong>', 'required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->alert->alertdanger(validation_errors());
		} else {
			$id = $this->input->post('id', TRUE);
			if (!empty($_FILES['file']['name'])) {
				$dir  = "webfile/";
				$config['upload_path']          = $dir;
				$config['allowed_types']        = '*';
				$config['file_name']           = md5('smartsoftstudio') . rand(1000, 100000);
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file')) {
					$error = $this->upload->display_errors();
					$this->alert->alertdanger($error);
				} else {
					$file = $this->upload->data();
					$data = array(
						'name' => $file['file_name'],
						'mime' => $file['file_type'],
						// 'size'=> $file['file_size'],
						'dir' => $dir . $file['file_name'],
						'table' => 'pegawai',
						'table_id' => $id,
						'updated_at' => date('Y-m-d H:i:s')
					);
					$file = $this->mymodel->selectDataone('file', array('table_id' => $id, 'table' => 'pegawai'));
					@unlink($file['dir']);
					if ($file == "") {
						$this->mymodel->insertData('file', $data);
					} else {
						$this->mymodel->updateData('file', $data, array('id' => $file['id']));
					}

					$dt = $_POST['dt'];
					$dt['updated_at'] = date("Y-m-d H:i:s");
					$str =  $this->mymodel->updateData('pegawai', $dt, array('id' => $id));
					return $str;
				}
			} else {
				$dt = $_POST['dt'];
				$dt['updated_at'] = date("Y-m-d H:i:s");
				$str = $this->mymodel->updateData('pegawai', $dt, array('id' => $id));
				return $str;
			}
		}
	}

	public function delete()
	{
		$id = $this->input->post('id', TRUE);
		$file = $this->mymodel->selectDataone('file', array('table_id' => $id, 'table' => 'pegawai'));

		@unlink($file['dir']);
		$this->mymodel->deleteData('file',  array('table_id' => $id, 'table' => 'pegawai'));

		$str = $this->mymodel->deleteData('pegawai',  array('id' => $id));
		return $str;
	}

	public function status($id, $status)
	{
		$this->mymodel->updateData('pegawai', array('status' => $status), array('id' => $id));
		redirect('master/Pegawai');
	}
}
