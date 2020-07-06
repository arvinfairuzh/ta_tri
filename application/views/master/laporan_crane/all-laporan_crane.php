<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Laporan Crane</h1>
    <h5 style="padding-left:1px;"></h5>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-success">
          <div class="panel-heading">
            <!-- FILTER  -->
            <div class="row">
              <div class="col-md-12">
                <?php if ($_SESSION['id_role'] == 3) {
                ?>
                  <a href="<?= base_url('master/laporan_crane/create') ?>">
                    <button type="button" class="btn btn-sm pull-right btn-primary"><i class="fa fa-plus"></i> Tambah Data</button>
                  </a>
                <?php
                }
                ?>
                <a class="btn btn-warning pull-right btn-sm " style="margin-right: 5px;" href="<?= base_url('master/laporan_crane/getExcel/') ?>" target="_blank"><i class="fa fa-file-excel-o"></i> Export Excel</a>
              </div>
            </div>
            <!-- FILTER  -->
          </div>
          <div class="panel-body">
            <table class="table table-hover table-bordered" id="idTable" style="width: 100%">
              <thead>
                <tr class="bg-success">
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>SE</th>
                  <th>SPV</th>
                  <th>Inspektor</th>
                  <th>Gudang</th>
                  <th>Validasi</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>

<script type="text/javascript">
  function detail(id) {
    location.href = "<?= base_url('master/laporan_crane/detail/') ?>" + id;
  }

  var table;
  $(document).ready(function() {
    //datatables
    table = $('#idTable').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "scrollX": true,
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo base_url('master/laporan_crane/ajaxall/') ?>",
        "type": "POST"
      },
      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [0], //first column / numbering colum
        "orderable": true, //set not orderable
      }, ],
    });
  });
</script>