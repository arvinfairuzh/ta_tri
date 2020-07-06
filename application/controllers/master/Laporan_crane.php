

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Laporan_crane extends MY_Controller
{



	public function __construct()

	{

		parent::__construct();
	}



	public function index()

	{

		$data['page_name'] = "laporan_crane";

		$this->template->load('template/template', 'master/laporan_crane/all-laporan_crane', $data);
	}

	public function create()

	{

		$data['page_name'] = "laporan_crane";

		$this->template->load('template/template', 'master/laporan_crane/add-laporan_crane', $data);
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
			$dt['created_by'] = $_SESSION['id'];
			$dt['created_at'] = date('Y-m-d H:i:s');
			$dt['status'] = "ENABLE";

			$this->mymodel->insertData('laporan_crane', $dt);

			$last_id = $this->db->insert_id();

			for ($i = 0; $i < count($rekomendasi); $i++) {
				$dta['id_laporan'] = $last_id;
				$dta['rekomendasi'] = $rekomendasi[$i];
				$dta['tindak_lanjut'] = $tindak_lanjut[$i];
				$dta['created_at'] = date('Y-m-d H:i:s');
				$dta['status'] = "ENABLE";
				$dta['created_by'] = $_SESSION['id'];

				$upload = '';
				if (!empty($_FILES['file']['name'][$i])) {
					$path = $_SERVER['DOCUMENT_ROOT'] . "/ta_tri/webfile/laporan_crane/";
					$dir  = "webfile/laporan_crane/";
					// $path = base_url()."webfile/document/my_document-$last_agenda/";
					// print_r($path);
					// die();

					$file_ext = $_FILES['file']['name'][$i];
					$ext = pathinfo($file_ext, PATHINFO_EXTENSION);
					$file_name = 'ftl-' . $last_id . '.' . $ext;
					$file_size = $_FILES['file']['size'][$i];
					$file_tmp = $_FILES['file']['tmp_name'][$i];
					$file_type = $_FILES['file']['type'][$i];

					move_uploaded_file($file_tmp, $path . $file_name);
					$upload = $dir . $file_name;
				}
				$dta['gambar'] = $upload;
				$this->mymodel->insertData('rekomendasi_crane', $dta);
			}

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

		$this->datatables->from('laporan_crane');

		if ($status == "ENABLE") {

			$this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button></div>', 'id');
		} else {

			$this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button><button type="button" onclick="hapus($1)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Hapus</button></div>', 'id');
		}

		echo $this->datatables->generate();
	}

	public function edit($id)
	{
		$data['laporan_crane'] = $this->mymodel->selectDataone('laporan_crane', array('id' => $id));
		$data['rekomendasi_crane'] = $this->mymodel->selectWhere('rekomendasi_crane', array('id_laporan' => $id));
		$data['file'] = $this->mymodel->selectDataone('file', array('table_id' => $id, 'table' => 'laporan_crane'));
		$data['page_name'] = "laporan_crane";

		$this->template->load('template/template', 'master/laporan_crane/edit-laporan_crane', $data);
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
			$id_rc = $_POST['id_rc'];
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
			$this->db->update('laporan_crane', $dt, array('id' => $id));

			for ($i = 0; $i < count($rekomendasi); $i++) {
				$rekomendasi_crane = $this->mymodel->selectDataone('rekomendasi_crane', array('id' => $id_rc[$i]));
				$dta['rekomendasi'] = $rekomendasi[$i];
				$dta['tindak_lanjut'] = $tindak_lanjut[$i];
				$dta['updated_at'] = date('Y-m-d H:i:s');

				$upload = '';
				if (!empty($_FILES['file']['name'][$i])) {
					$path = $_SERVER['DOCUMENT_ROOT'] . "/ta_tri/webfile/laporan_crane/";
					$dir  = "webfile/laporan_crane/";
					// $path = base_url()."webfile/document/my_document-$last_agenda/";
					// print_r($path);
					// die();

					$file_ext = $_FILES['file']['name'][$i];
					$ext = pathinfo($file_ext, PATHINFO_EXTENSION);
					$file_name = 'ftl-' . $id_rc[$i] . '.' . $ext;
					$file_size = $_FILES['file']['size'][$i];
					$file_tmp = $_FILES['file']['tmp_name'][$i];
					$file_type = $_FILES['file']['type'][$i];

					move_uploaded_file($file_tmp, $path . $file_name);
					$upload = $dir . $file_name;
					$dta['gambar'] = $upload;
				} else {
					$dta['gambar'] = $rekomendasi_crane['gambar'];
				}
				$this->db->update('rekomendasi_crane', $dta, array('id' => $id_rc[$i]));
			}

			$this->alert->alertsuccess('Success Send Data');
		}
	}

	public function detail($id)
	{
		$data['laporan_crane'] = $this->mymodel->selectDataone('laporan_crane', array('id' => $id));
		$data['rekomendasi_crane'] = $this->mymodel->selectWhere('rekomendasi_crane', array('id_laporan' => $id));
		$data['page_name'] = "laporan_crane";

		$this->template->load('template/template', 'master/laporan_crane/detail-laporan_crane', $data);
	}

	public function cetak($id)
	{
		$data['laporan_crane'] = $this->mymodel->selectDataone('laporan_crane', array('id' => $id));
		$data['page_name'] = "laporan_crane";

		$this->load->view('master/laporan_crane/cetak-laporan_crane', $data);
	}


	public function delete()

	{

		$id = $this->input->post('id', TRUE);
		$file = $this->mymodel->selectDataone('file', array('table_id' => $id, 'table' => 'laporan_crane'));

		@unlink($file['dir']);

		$this->mymodel->deleteData('file',  array('table_id' => $id, 'table' => 'laporan_crane'));



		$str = $this->mymodel->deleteData('laporan_crane',  array('id' => $id));
		return $str;
	}



	public function status($id, $status)

	{

		$this->mymodel->updateData('laporan_crane', array('status' => $status), array('id' => $id));


		redirect('master/Laporan_crane');
	}
}

?>