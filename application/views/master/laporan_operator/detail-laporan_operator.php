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
            Laporan Operator
            <small>Detail</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Master</a></li>
            <li class="#">Laporan Operator</li>
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
                            if ($laporan_operator['validasi'] == 0) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_operator['validasi'] == 1) {
                                $badge_color = 'bg-red';
                                $keterangan_tolak = '';
                            } else if ($laporan_operator['validasi'] == 2) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_operator['validasi'] == 3) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_operator['validasi'] == 4) {
                                $badge_color = 'bg-red';
                                $keterangan_tolak = '';
                            } else if ($laporan_operator['validasi'] == 5) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_operator['validasi'] == 6) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_operator['validasi'] == 7) {
                                $badge_color = 'bg-red';
                                $keterangan_tolak = '';
                            } else if ($laporan_operator['validasi'] == 8) {
                                $badge_color = 'bg-yellow';
                            } else if ($laporan_operator['validasi'] == 9) {
                                $badge_color = 'bg-red';
                                $keterangan_tolak = '';
                            } else {
                                $badge_color = 'bg-green';
                            }
                            ?>
                            <label class="">Status Sekarang <span class='badge badge-pill <?= $badge_color ?>'><?= $master_status['nama'] ?></span></label>
                            <br>
                            <div class="<?= $keterangan_tolak ?>"><b class="">Keterangan Ditolak : </b> <?= $laporan_operator['keterangan_tolak'] ?></div>
                        </div>
                        <div class="col-md-5 pull-right">
                            <button type="button" class="btn btn-sm btn-info pull-right" onclick="cetak(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</button>
                            <?php
                            if ($_SESSION['id_role'] == 1) {
                                if ($laporan_operator['validasi'] == 0 || $laporan_operator['validasi'] == 2 || $laporan_operator['validasi'] == 6) {
                            ?>
                                    <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button>
                                <?php
                                }
                                ?>
                            <?php
                            } else if ($_SESSION['id_role'] == 2) {
                            ?>
                                <?php
                                if ($laporan_operator['validasi'] == 3 || $laporan_operator['validasi'] == 8) {
                                ?>
                                    <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <!-- <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button> -->
                                <?php
                                }
                                ?>
                                <?php
                            } else if ($_SESSION['id_role'] == 3) {
                                if ($laporan_operator['validasi'] == 1 || $laporan_operator['validasi'] == 4 || $laporan_operator['validasi'] == 9) {
                                ?>
                                    <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button>
                                <?php
                                }
                                ?>
                                <button type="button" class="btn btn-sm btn-danger pull-right" onclick="hapus(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-trash"></i> Hapus</button>
                                <?php
                            } else if ($_SESSION['id_role'] == 4) {
                                if ($laporan_operator['validasi'] == 5 || $laporan_operator['validasi'] == 7) {
                                ?>
                                    <button type="button" class="btn btn-sm btn-success pull-right" onclick="validasi(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-refresh"></i> Validasi</button>
                                    <button type="button" class="btn btn-sm btn-primary pull-right" onclick="edit(<?= $laporan_operator['id'] ?>)" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</button>
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
                            <?= $laporan_operator['tanggal'] ?>
                        </div>
                        <hr>
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2" style="width: 40%;">Uraian</th>
                                        <th colspan="2">Kesesuaian </th>
                                        <th rowspan="2">Keterangan</th>
                                        <th colspan="3">Dasar Hukum</th>
                                    </tr>
                                    <tr>
                                        <th width="50">YA</th>
                                        <th width="50">TIDAK</th>
                                        <th>Pasal</th>
                                        <th>Ayat</th>
                                        <th>Butir</th>
                                    </tr>
                                    <?php
                                    $jawaban = json_decode($laporan_operator['value_json']);
                                    $master_list_operator = $this->mymodel->selectWithQuery("SELECT * FROM master_list_operator");
                                    ?>
                                    <?php
                                    $no = 0;
                                    foreach ($master_list_operator as $dp) {
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
                                    foreach ($rekomendasi_operator as $rc) {
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

<div class="modal fade bd-example-modal-sm" tabindex="-1" laporan_operator="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="post" action="<?= base_url('master/laporan_operator/delete') ?>">
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
        $("#load-form").load("<?= base_url('master/laporan_operator/validasi/') ?>" + id);

    }

    function edit(id) {
        location.href = "<?= base_url('master/laporan_operator/edit/') ?>" + id;
    }

    function cetak(id) {
        window.open("<?= base_url('master/laporan_operator/cetak/') ?>" + id);
    }

    function hapus(id) {
        $("#modal-delete").modal('show');
        $("#delete-input").val(id);
    }
</script>