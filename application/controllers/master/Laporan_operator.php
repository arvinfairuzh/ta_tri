<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// error_reporting(0);

class Laporan_operator extends MY_Controller
{



	public function __construct()

	{

		parent::__construct();
		$this->load->model('Report_laporan_operator', 'rlaporan_operator');
	}



	public function index()

	{

		$data['page_name'] = "laporan_operator";

		$this->template->load('template/template', 'master/laporan_operator/all-laporan_operator', $data);
	}

	function ajaxAll()
	{
		$list = $this->rlaporan_operator->get_datatables();
		$data = array();
		$i = 1;
		foreach ($list as $u) {
			$row = array();

			$row[] = $i;
			$row[] = $u->tanggal;
			$row[] = $u->id_se;
			$row[] = $u->id_spv;
			$row[] = $u->id_inspektor;
			$row[] = $u->id_gudang;
			if ($u->validasi == 0) {
				$badge_color = 'bg-yellow';
			} else if ($u->validasi == 1) {
				$badge_color = 'bg-red';
			} else if ($u->validasi == 2) {
				$badge_color = 'bg-yellow';
			} else if ($u->validasi == 3) {
				$badge_color = 'bg-yellow';
			} else if ($u->validasi == 4) {
				$badge_color = 'bg-red';
			} else if ($u->validasi == 5) {
				$badge_color = 'bg-yellow';
			} else if ($u->validasi == 6) {
				$badge_color = 'bg-yellow';
			} else if ($u->validasi == 7) {
				$badge_color = 'bg-red';
			} else if ($u->validasi == 8) {
				$badge_color = 'bg-yellow';
			} else if ($u->validasi == 9) {
				$badge_color = 'bg-red';
			} else {
				$badge_color = 'bg-green';
			}
			$row[] = "<h6><span class='badge badge-pill $badge_color'>$u->nama_status</span></h6>";
			$row[] = "<button type='button' class='btn btn-sm btn-info pull-right' onclick='detail($u->id)'>Detail</button>";
			$data[] = $row;
			$i++;
		}



		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->rlaporan_operator->count_all(),
			"recordsFiltered" => $this->rlaporan_operator->count_filtered(),
			"data" => $data
		);

		echo json_encode($output);
	}


	function getExcel()
	{
		$list = $this->rlaporan_operator->get_data();
		$data = array();
		$i = 1;
		foreach ($list as $u) {



			$data[] = array($i, $u->tanggal, $u->validasi, $u->id_se, $u->id_spv, $u->id_inspektor, $u->id_gudang);

			$i++;
		}

		$judul = "Report laporan_operator";

		$head = array('No', 'tanggal', 'validasi', 'id_se', 'id_spv', 'id_inspektor', 'id_gudang');

		$json = [
			'judul' => $judul,
			'head' => $head,
			'data' => $data
		];

		$this->session->set_flashdata('report', $json);
		redirect('fitur/exportreport');
	}

	public function create()

	{

		$data['page_name'] = "laporan_operator";

		$this->template->load('template/template', 'master/laporan_operator/add-laporan_operator', $data);
	}

	public function validate()

	{

		$this->form_validation->set_error_delimiters('<li>', '</li>');

		$this->form_validation->set_rules('dt[tanggal]', '<strong>Tanggal</strong>', 'required');
	}



	public function store()

	{

		$this->validate();

		if ($this->form_validation->run() == FALSE) {

			$this->alert->alertdanger(validation_errors());
		} else {

			$dt = $_POST['dt'];
			$id_dp = $_POST['id_dp'];
			$hasil = $_POST['hasil'];
			$keterangan = $_POST['keterangan'];
			$rekomendasi = $_POST['rekomendasi'];
			$tindak_lanjut = $_POST['tindak_lanjut'];
			$count_id_dp = count($id_dp);
			for ($i = 0; $i < $count_id_dp; $i++) {
				$hasil_text = '';
				// print_r($hasil[$i]);
				if ($hasil[$i] == 'Ya') {
					$hasil_text = 'Ya';
				} else {
					$hasil_text = 'Tidak';
				}
				// print_r($hasil_text);
				$json[$i] = array(
					'id' => $id_dp[$i],
					'kesesuaian' => $hasil_text,
					'keterangan' => $keterangan[$i]
				);
			}
			$datajson = json_encode($json);
			$dt['value_json'] = $datajson;
			$dt['id_inspektor'] = $_SESSION['id'];
			$dt['created_by'] = $_SESSION['id'];
			$dt['created_at'] = date('Y-m-d H:i:s');
			$dt['status'] = "ENABLE";

			$this->mymodel->insertData('laporan_operator', $dt);

			$this->alert->alertsuccess('Success Send Data');
		}
	}



	public function json()

	{

		$status = $_GET['status'];

		if ($status == '') {

			$status = 'ENABLE';
		}

		header('Content-Type: application/json');

		$this->datatables->select('id,tanggal,value_json,keterangan_tolak,validasi,id_se,id_spv,id_inspektor,id_gudang,status');

		$this->datatables->where('status', $status);

		$this->datatables->from('laporan_operator');

		if ($status == "ENABLE") {

			$this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button></div>', 'id');
		} else {

			$this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button><button type="button" onclick="hapus($1)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Hapus</button></div>', 'id');
		}

		echo $this->datatables->generate();
	}

	public function edit($id)
	{
		$data['laporan_operator'] = $this->mymodel->selectDataone('laporan_operator', array('id' => $id));
		$data['rekomendasi_operator'] = json_decode($data['laporan_operator']['rekomendasi']);
		$data['file'] = $this->mymodel->selectDataone('file', array('table_id' => $id, 'table' => 'laporan_operator'));
		$data['page_name'] = "laporan_operator";

		$this->template->load('template/template', 'master/laporan_operator/edit-laporan_operator', $data);
	}

	public function update()
	{
		$this->validate();
		if ($this->form_validation->run() == FALSE) {
			$this->alert->alertdanger(validation_errors());
		} else {
			$id = $this->input->post('id', TRUE);
			$dt = $_POST['dt'];
			$id_dp = $_POST['id_dp'];
			$hasil = $_POST['hasil'];
			$keterangan = $_POST['keterangan'];
			$rekomendasi = $_POST['rekomendasi'];
			$tindak_lanjut = $_POST['tindak_lanjut'];
			$hasil_file_old = $_POST['hasil_file_old'];
			$count_id_dp = count($id_dp);
			for ($i = 0; $i < $count_id_dp; $i++) {
				$hasil_text = '';
				// print_r($hasil[$i]);
				if ($hasil[$i] == 'Ya') {
					$hasil_text = 'Ya';
				} else {
					$hasil_text = 'Tidak';
				}
				// print_r($hasil_text);
				$json[$i] = array(
					'id' => $id_dp[$i],
					'kesesuaian' => $hasil_text,
					'keterangan' => $keterangan[$i]
				);
			}
			$datajson = json_encode($json);
			$dt['value_json'] = $datajson;
			$dt['updated_at'] = date("Y-m-d H:i:s");
			for ($i = 0; $i < count($rekomendasi); $i++) {

				$upload = '';
				if (!empty($_FILES['file']['name'][$i])) {
					$path = $_SERVER['DOCUMENT_ROOT'] . "/ta_tri/webfile/laporan_operator/";
					$dir  = "webfile/laporan_operator/";

					$file_ext = $_FILES['file']['name'][$i];
					$ext = pathinfo($file_ext, PATHINFO_EXTENSION);
					$file_name = 'ftl-'. $id . $i . '.' . $ext;
					$file_size = $_FILES['file']['size'][$i];
					$file_tmp = $_FILES['file']['tmp_name'][$i];
					$file_type = $_FILES['file']['type'][$i];

					move_uploaded_file($file_tmp, $path . $file_name);
					$upload = $dir . $file_name;
					$gambar = $upload;
				} else {
					$gambar = $hasil_file_old[$i];
				}
				$json_rekomendasi[$i] = array(
					'rekomendasi' => $rekomendasi[$i],
					'tindak_lanjut' => $tindak_lanjut[$i],
					'gambar' => $gambar
				);
			}
			// print_r($json_rekomendasi);
			$dt['rekomendasi'] = json_encode($json_rekomendasi);
			// die();
			$this->db->update('laporan_operator', $dt, array('id' => $id));

			$this->alert->alertsuccess('Success Send Data');
		}
	}

	public function detail($id)
	{
		$data['laporan_operator'] = $this->mymodel->selectDataone('laporan_operator', array('id' => $id));
		$data['rekomendasi_operator'] = json_decode($data['laporan_operator']['rekomendasi']);
		$data['master_status'] = $this->mymodel->selectDataone('master_status', array('id' => $data['laporan_operator']['validasi']));
		$data['page_name'] = "laporan_operator";

		$this->template->load('template/template', 'master/laporan_operator/detail-laporan_operator', $data);
	}

	public function cetak($id)
	{
		$data['laporan_operator'] = $this->mymodel->selectDataone('laporan_operator', array('id' => $id));
		$data['rekomendasi_operator'] = json_decode($data['laporan_operator']['rekomendasi']);
		$data['page_name'] = "laporan_operator";

		$this->load->view('master/laporan_operator/cetak-laporan_operator', $data);
	}


	public function validasi($id)
	{
		$data['laporan_operator'] = $this->mymodel->selectDataone('laporan_operator', array('id' => $id));
		$data['id'] = $data['laporan_operator']['id'];
		$data['page_name'] = "laporan_operator";

		$this->load->view('master/laporan_operator/modal', $data);
	}

	public function validasi_tolak($id)
	{
		$laporan_operator = $this->mymodel->selectDataone('laporan_operator', array('id' => $id));
		$data['id'] = $laporan_operator['id'];
		$data['page_name'] = "laporan_operator";

		$this->load->view('master/laporan_operator/modal-tolak', $data);
	}

	public function validasi_act($id, $status)
	{
		$laporan_operator = $this->mymodel->selectDataone('laporan_operator', array('id' => $id));
		$status_sekarang = $laporan_operator['validasi'];
		if ($status == 'terima') {
			if ($_SESSION['id_role'] == 1) {
				$dt['id_se'] = $_SESSION['id'];
				if ($status_sekarang == 0) {
					$validasi = 2;
				} else if ($status_sekarang == 2) {
					$validasi = 3;
				} else if ($status_sekarang == 6) {
					$validasi = 8;
				}
			} else if ($_SESSION['id_role'] == 2) {
				$dt['id_spv'] = $_SESSION['id'];
				if ($status_sekarang == 3) {
					$validasi = 5;
				} else if ($status_sekarang == 8) {
					$validasi = 10;
				}
			} else if ($_SESSION['id_role'] == 3) {
				$validasi = 0;
			} else if ($_SESSION['id_role'] == 4) {
				$dt['id_gudang'] = $_SESSION['id'];
				$validasi = 6;
			}
		} else {
			$dt['keterangan_tolak'] = $_POST['keterangan'];
			if ($_SESSION['id_role'] == 1) {
				$dt['id_se'] = $_SESSION['id'];
				if ($status_sekarang == 0) {
					$validasi = 1;
				} else if ($status_sekarang == 2) {
					$validasi = 8;
				} else if ($status_sekarang == 6) {
					$validasi = 7;
				}
			} else if ($_SESSION['id_role'] == 2) {
				$dt['id_spv'] = $_SESSION['id'];
				if ($status_sekarang == 3) {
					$validasi = 4;
				} else if ($status_sekarang == 8) {
					$validasi = 9;
				}
			}
		}
		$dt['validasi'] = $validasi;
		$dt['updated_at'] = date('Y-m-d H:i:s');
		$this->db->update('laporan_operator', $dt, array('id' => $id));
		// die();
		header('Location: ' . base_url('master/laporan_operator/'));
	}

	public function delete()
	{
		$id = $this->input->post('id', TRUE);
		$dt['status'] = 'DISABLE';
		$str = $this->db->update('laporan_operator', $dt, array('id' => $id));
		header('Location: ' . base_url('master/laporan_operator/'));
	}

	public function status($id, $status)

	{

		$this->mymodel->updateData('laporan_operator', array('status' => $status), array('id' => $id));


		redirect('master/laporan_operator');
	}
}

?>