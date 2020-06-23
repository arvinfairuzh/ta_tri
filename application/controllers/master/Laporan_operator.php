

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



	class Laporan_operator extends MY_Controller {



		public function __construct()

		{

			parent::__construct();

		}



		public function index()

		{

			$data['page_name'] = "laporan_operator";

			$this->template->load('template/template','master/laporan_operator/all-laporan_operator',$data);

		}

		public function create()

		{

			$data['page_name'] = "laporan_operator";

			$this->template->load('template/template','master/laporan_operator/add-laporan_operator',$data);

		}

		public function validate()

		{

			$this->form_validation->set_error_delimiters('<li>', '</li>');

	$this->form_validation->set_rules('dt[tanggal]', '<strong>Tanggal</strong>', 'required');
$this->form_validation->set_rules('dt[value_json]', '<strong>Value Json</strong>', 'required');
$this->form_validation->set_rules('dt[keterangan_tolak]', '<strong>Keterangan Tolak</strong>', 'required');
$this->form_validation->set_rules('dt[validasi]', '<strong>Validasi</strong>', 'required');
$this->form_validation->set_rules('dt[id_se]', '<strong>Id Se</strong>', 'required');
$this->form_validation->set_rules('dt[id_spv]', '<strong>Id Spv</strong>', 'required');
$this->form_validation->set_rules('dt[id_inspektor]', '<strong>Id Inspektor</strong>', 'required');
$this->form_validation->set_rules('dt[id_gudang]', '<strong>Id Gudang</strong>', 'required');
	}



		public function store()

		{

			$this->validate();

	    	if ($this->form_validation->run() == FALSE){

				$this->alert->alertdanger(validation_errors());     

	        }else{

				$dt = $_POST['dt'];
				
				

				$dt['created_by'] = $_SESSION['id'];

				$dt['created_at'] = date('Y-m-d H:i:s');

				$dt['status'] = "ENABLE";

				$str = $this->mymodel->insertData('laporan_operator', $dt);

				$last_id = $this->db->insert_id();	    if (!empty($_FILES['file']['name'])){

		        	$dir  = "webfile/";

					$config['upload_path']          = $dir;

					$config['allowed_types']        = '*';

					$config['file_name']           = md5('smartsoftstudio').rand(1000,100000);



					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file')){

						$error = $this->upload->display_errors();

						$this->alert->alertdanger($error);		

					}else{

					   	$file = $this->upload->data();

						$data = array(

					   				'id' => '',

					   				'name'=> $file['file_name'],

					   				'mime'=> $file['file_type'],

					   				'dir'=> $dir.$file['file_name'],

					   				'table'=> 'laporan_operator',

					   				'table_id'=> $last_id,

					   				'status'=>'ENABLE',

					   				'created_at'=>date('Y-m-d H:i:s')

					   	 		);

					   	$str = $this->mymodel->insertData('file', $data);

						$this->alert->alertsuccess('Success Send Data');    

					} 

				}else{

					$data = array(

				   				'id' => '',

				   				'name'=> '',

				   				'mime'=> '',

				   				'dir'=> '',

				   				'table'=> 'laporan_operator',

				   				'table_id'=> $last_id,

				   				'status'=>'ENABLE',

				   				'created_at'=>date('Y-m-d H:i:s')

				   	 		);



				   	$str = $this->mymodel->insertData('file', $data);

					$this->alert->alertsuccess('Success Send Data');



					}

					    

					

			}

		}



		public function json()

		{

			$status = $_GET['status'];

			if($status==''){

				$status = 'ENABLE';

			}

			header('Content-Type: application/json');

	        $this->datatables->select('id,tanggal,value_json,keterangan_tolak,validasi,id_se,id_spv,id_inspektor,id_gudang,status');

	        $this->datatables->where('status',$status);

	        $this->datatables->from('laporan_operator');

	        if($status=="ENABLE"){

	        $this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button></div>', 'id');



	    	}else{

	        $this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button><button type="button" onclick="hapus($1)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Hapus</button></div>', 'id');



	    	}

	        echo $this->datatables->generate();

		}

		public function edit($id)

		{

			$data['laporan_operator'] = $this->mymodel->selectDataone('laporan_operator',array('id'=>$id));$data['file'] = $this->mymodel->selectDataone('file',array('table_id'=>$id,'table'=>'laporan_operator'));$data['page_name'] = "laporan_operator";

			$this->template->load('template/template','master/laporan_operator/edit-laporan_operator',$data);

		}





		public function update()

		{	

			$this->validate();

			



	    	if ($this->form_validation->run() == FALSE){

				$this->alert->alertdanger(validation_errors());     

	        }else{

				$id = $this->input->post('id', TRUE);

	        	if (!empty($_FILES['file']['name'])){

	        		$dir  = "webfile/";

					$config['upload_path']          = $dir;

					$config['allowed_types']        = '*';

					$config['file_name']           = md5('smartsoftstudio').rand(1000,100000);

	        		$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('file')){

						$error = $this->upload->display_errors();

						$this->alert->alertdanger($error);		

					}else{

						$file = $this->upload->data();

						$data = array(

					   				'name'=> $file['file_name'],

					   				'mime'=> $file['file_type'],

					   				// 'size'=> $file['file_size'],

					   				'dir'=> $dir.$file['file_name'],

					   				'table'=> 'laporan_operator',

					   				'table_id'=> $id,

					   				'updated_at'=>date('Y-m-d H:i:s')

					   	 		);

						$file = $this->mymodel->selectDataone('file',array('table_id'=>$id,'table'=>'laporan_operator'));

						@unlink($file['dir']);

						if($file==""){

							$this->mymodel->insertData('file', $data);

						}else{

							$this->mymodel->updateData('file', $data , array('id'=>$file['id']));

						}

						



						$dt = $_POST['dt'];

						

						$dt['updated_at'] = date("Y-m-d H:i:s");

						$str =  $this->mymodel->updateData('laporan_operator', $dt , array('id'=>$id));

						return $str;  
	

					}

				}else{

					$dt = $_POST['dt'];

					

					$dt['updated_at'] = date("Y-m-d H:i:s");

					$str = $this->mymodel->updateData('laporan_operator', $dt , array('id'=>$id));

					return $str;  

				}}

		}



		public function delete()

		{

				$id = $this->input->post('id', TRUE);$file = $this->mymodel->selectDataone('file',array('table_id'=>$id,'table'=>'laporan_operator'));

				@unlink($file['dir']);

				$this->mymodel->deleteData('file',  array('table_id'=>$id,'table'=>'laporan_operator'));



				$str = $this->mymodel->deleteData('laporan_operator',  array('id'=>$id));
				return $str;
				


		}



		public function status($id,$status)

		{

			$this->mymodel->updateData('laporan_operator',array('status'=>$status),array('id'=>$id));


			redirect('master/Laporan_operator');

		}





	}

?>