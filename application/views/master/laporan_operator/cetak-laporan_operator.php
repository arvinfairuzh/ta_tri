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
    

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>