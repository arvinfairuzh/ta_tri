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
            Laporan Crane
            <small>Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Master</a></li>
            <li class="#">Laporan Crane</li>
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
                        <div class="col-md-7">
                            <?php
                            $keterangan_tolak = 'hide';
                            if ($laporan_crane['validasi'] == 0) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_crane['validasi'] == 1) {
                                $badge_color = 'bg-red';
                                $keterangan_tolak = '';
                            } else if ($laporan_crane['validasi'] == 2) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_crane['validasi'] == 3) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_crane['validasi'] == 4) {
                                $badge_color = 'bg-red';
                                $keterangan_tolak = '';
                            } else if ($laporan_crane['validasi'] == 5) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_crane['validasi'] == 6) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_crane['validasi'] == 7) {
                                $badge_color = 'bg-red';
                                $keterangan_tolak = '';
                            } else if ($laporan_crane['validasi'] == 8) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_crane['validasi'] == 9) {
                                $badge_color = 'bg-red';
                                $keterangan_tolak = '';
                            } else {
                                $badge_color = 'bg-green';
                            }
                            ?>
                            <label class="">Status Sekarang <span class='badge badge-pill <?= $badge_color ?>'><?= $master_status['nama'] ?></span></label>
                            <br>
                            <div class="<?= $keterangan_tolak ?>"><b class="">Keterangan Ditolak : </b> <?= $laporan_crane['keterangan_tolak'] ?></div>
                        </div>
                        <div class="col-md-5 pull-right">
                            <button type="button" class="btn btn-sm btn-info pull-right" onclick="cetak(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button>
                            <?php
                            if ($_SESSION['id_role'] == 1) {
                                if ($laporan_crane['validasi'] == 0 || $laporan_crane['validasi'] == 2 || $laporan_crane['validasi'] == 6) {
                            ?>
                                    <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button>
                                <?php
                                }
                                ?>
                            <?php
                            } else if ($_SESSION['id_role'] == 2) {
                            ?>
                                <?php
                                if ($laporan_crane['validasi'] == 3 || $laporan_crane['validasi'] == 8) {
                                ?>
                                    <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <!-- <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button> -->
                                <?php
                                }
                                ?>
                                <?php
                            } else if ($_SESSION['id_role'] == 3) {
                                if ($laporan_crane['validasi'] == 1 || $laporan_crane['validasi'] == 4 || $laporan_crane['validasi'] == 9) {
                                ?>
                                    <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button>
                                <?php
                                }
                                ?>
                                <button type="button" class="btn btn-sm btn-danger pull-right" onclick="hapus(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-trash"></i> Hapus</button>
                                <?php
                            } else if ($_SESSION['id_role'] == 4) {
                                if ($laporan_crane['validasi'] == 5 || $laporan_crane['validasi'] == 7) {
                                ?>
                                    <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_crane['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="show_error"></div>
                        <div class="col-xs-12">
                            <b>Tanggal</b> :
                            <?= $laporan_crane['tanggal'] ?>
                        </div>
                        <hr>
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr align="center">
                                        <th rowspan="2">NO</th>
                                        <th rowspan="2" style="width: 40%;">URAIAN</th>
                                        <th colspan="2">KESESUAIAN</th>
                                        <th rowspan="2">KETERANGAN</th>
                                        <th rowspan="2">DASAR HUKUM</th>
                                    </tr>
                                    <tr align="center">
                                        <th width="50">YA</th>
                                        <th width="50">TIDAK</th>
                                    </tr>
                                    <?php
                                    $jawaban = json_decode($laporan_crane['value_json']);
                                    $master_list_crane = $this->mymodel->selectWithQuery("SELECT * FROM master_list_crane");
                                    ?>
                                    <?php
                                    $no = 0;
                                    foreach ($master_list_crane as $dp) {
                                        $no++;
                                        $keterangan = '';
                                        $ya_text = '';
                                        $tidak_text = '';
                                        foreach ($jawaban as $j) {
                                            if ($j->id == $dp['id']) {
                                                if ($j->kesesuaian == 'Ya') {
                                                    $ya_text = 'fa fa-check-circle';
                                                } else {
                                                    $tidak_text = 'fa fa-check-circle';
                                                }
                                                $keterangan = $j->keterangan;
                                            } else {
                                            }
                                        }
                                        // print_r($hasil);
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td>
                                                <?= $dp['nama'] ?>
                                            </td>
                                            <td align="center">
                                                <i class="<?= $ya_text ?>"></i>
                                            </td>
                                            <td align="center">
                                                <i class="<?= $tidak_text ?>"></i>
                                            </td>
                                            <td><?= $keterangan ?></td>
                                            <td>
                                                <?= $dp['dasar_hukum'] ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_fieldinvoice" style="width:100%;">
                                    <tr>
                                        <th style="width: 50%;">
                                            REKOMENDASI
                                        </th>
                                        <th>
                                            TINDAK LANJUT
                                        </th>
                                    </tr>
                                    <?php
                                    $i = 100;
                                    foreach ($rekomendasi_crane as $rc) {
                                        $i++;
                                    ?>
                                        <tr id="rowinvoice<?= $i ?>">
                                            <td><?= $rc->rekomendasi ?></td>
                                            <td>
                                                <?php
                                                if ($rc->gambar != "") {
                                                ?>
                                                    <img src="<?= base_url($rc->gambar) ?>" style="width: 200px" class="img img-thumbnail">
                                                    <br>
                                                <?php } ?>
                                                <?= $rc->tindak_lanjut ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
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

<div class="modal fade bd-example-modal-sm" tabindex="-1" laporan_crane="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post" action="<?= base_url('master/laporan_crane/delete') ?>">
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
        $("#load-form").load("<?= base_url('master/laporan_crane/validasi/') ?>" + id);

    }

    function edit(id) {
        location.href = "<?= base_url('master/laporan_crane/edit/') ?>" + id;
    }

    function cetak(id) {
        window.open("<?= base_url('master/laporan_crane/cetak/') ?>" + id);
    }

    function hapus(id) {
        $("#modal-delete").modal('show');
        $("#delete-input").val(id);
    }
</script>