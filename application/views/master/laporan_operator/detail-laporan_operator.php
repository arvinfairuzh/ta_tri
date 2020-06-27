<!-- Content Wrapper. Contains page content -->

<style type="text/css" media="all">
    table {
        page-break-inside: auto
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    th {
        text-align: center;
    }

    thead {
        display: table-header-group
    }

    tfoot {
        display: table-footer-group
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        CHECKLIST OPERATOR CRANE
            <small>Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Master</a></li>
            <li class="#">Checklist Operator Crane</li>
            <li class="active">Detail</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header">
                        <div class="col-md-12" align="center">
                            <h4><b>CHECKLIST OPERATOR CRANE</b></h4>
                        </div>
                        <div class="col-md-5">
                            <!-- <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-info pull-right" onclick="cetak(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button>
                                <?php
                                if ($_SESSION['role_id'] == 1) {
                                    if ($laporan_crane['status_bulanan'] == 1) {
                                ?>
                                        <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <?php
                                    }
                                    ?>
                                    <button type="button" class="btn btn-sm btn-danger pull-right" onclick="hapus(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-trash"></i> Hapus</button>
                                    <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button>
                                    <?php
                                } else if ($_SESSION['role_id'] == 3) {
                                    if ($laporan_crane['status_bulanan'] == 0 || $laporan_crane['status_bulanan'] == 2) {
                                    ?>
                                        <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <?php
                                    }
                                    ?>
                                    <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button>
                                <?php
                                }
                                if ($laporan_crane['status_bulanan'] == 0) {
                                    $badge_color = 'bg-yellow';
                                } else if ($laporan_crane['status_bulanan'] == 1) {
                                    $badge_color = 'bg-blue';
                                } else if ($laporan_crane['status_bulanan'] == 2) {
                                    $badge_color = 'bg-red';
                                } else {
                                    $badge_color = 'bg-green';
                                }
                                ?>
                            </div> -->
                        </div>
                    </div>
                    <div class="box-body">
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Uraian</th>
                                        <th colspan="3" width="120">Kesesuaian </th>
                                        <th rowspan="2">Keterangan</th>
                                        <th colspan="3">Dasar Hukum</th>
                                    </tr>
                                    <tr>
                                        <th>Ya</th>
                                        <th>Tidak</th>
                                        <th width="90">Tidak ada</th>
                                        <th>Pasal</th>
                                        <th>Ayat</th>
                                        <th>Butir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $master_list_operator = $this->mymodel->selectWithQuery("SELECT * FROM master_list_operator");
                                    ?>
                                    <?php
                                    $no = 0;
                                    
                                    foreach ($master_list_operator as $dp) {
                                        $no++;
                                        
                                    ?>
                                    <?php 
                                        if($dp['id'] == '1'){
                                            $sub = '<tr>
                                            Kualifikasi dan Persyaratan
                                            </tr>;'
                                            ?>
                                            <?php }?>
                                        <?= $sub ?>

                                        <tr>
                                        <td>
                                        <?= $no ?></td>
                                        <td>
                                            <input type="hidden" name="id_dp[]" value="<?= $dp['id'] ?>">
                                            <?= $dp['nama'] ?>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td><textarea name="keterangan[]" id="" rows="1" class="form-control"></textarea></td>
                                        <td>
                                            <?= $dp['pasal'] ?>
                                        </td>
                                        <td>
                                            <?= $dp['ayat'] ?>
                                        </td>
                                        <td>
                                            <?= $dp['butir'] ?>
                                        </td>
                                        </tr>
                                        
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade bd-example-modal-sm" tabindex="-1" form_laporan_bulanan="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post" action="<?= base_url('master/Form_laporan_bulanan/delete') ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete-input">
                    <p>Are you sure to delete this data?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-send">Yes, Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" master_bagian="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-form">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="load-form"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validasi(id) {
        $("#load-form").html('loading...');

        $("#modal-form").modal();
        $("#title-form").html('Validasi');
        $("#load-form").load("<?= base_url('master/Form_laporan_bulanan/validasi/') ?>" + id);

    }

    function edit(id) {
        location.href = "<?= base_url('master/Form_laporan_bulanan/edit/') ?>" + id;
    }

    function cetak(id) {
        window.open("<?= base_url('master/Form_laporan_bulanan/cetak/') ?>" + id);
    }

    function hapus(id) {
        $("#modal-delete").modal('show');
        $("#delete-input").val(id);
    }
</script>