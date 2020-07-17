<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= TITLE_APPLICATION  ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
</head>

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

    .page {
        width: 100%;
        height: 100%;
        page-break-before: always;
        top: 100%;
    }

    .page:nth-of-type(2) {
        page-break-before: always;
        top: 100%;
    }
</style>

<body>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header">
                        <div class="col-md-12" align="center">
                            <h4><b>Laporan Crane</b></h4>
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
                                    <tr>
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
                        <div class="col-xs-12">
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
        </div>
    </section>


    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>