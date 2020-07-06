

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_crane extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Report_laporan_crane', 'rLaporan_crane');
  }

  public function index()
  {
    $data['page_name'] = "Report Laporan_crane";
    $this->template->load('template/template', 'report/laporan_crane/all', $data);
  }


  function ajaxAll()
  {
    $list = $this->rLaporan_crane->get_datatables();
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
        $badge_color = 'bg-blue';
      } else if ($u->validasi == 2) {
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
      "recordsTotal" => $this->rLaporan_crane->count_all(),
      "recordsFiltered" => $this->rLaporan_crane->count_filtered(),
      "data" => $data
    );

    echo json_encode($output);
  }


  function getExcel()
  {
    $list = $this->rLaporan_crane->get_data();
    $data = array();
    $i = 1;
    foreach ($list as $u) {



      $data[] = array($i, $u->tanggal, $u->validasi, $u->id_se, $u->id_spv, $u->id_inspektor, $u->id_gudang);

      $i++;
    }

    $judul = "Report Laporan_crane";

    $head = array('No', 'tanggal', 'validasi', 'id_se', 'id_spv', 'id_inspektor', 'id_gudang');

    $json = [
      'judul' => $judul,
      'head' => $head,
      'data' => $data
    ];

    $this->session->set_flashdata('report', $json);
    redirect('fitur/exportreport');
  }
}

/* End of file  */
/* Location: ./application/controllers/ */
?> 