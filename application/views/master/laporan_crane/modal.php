<div class="show_error"></div>
<?php
if ($_SESSION['id_role'] == 1) {
?>
    <?php
    if ($laporan_crane['validasi'] == 2) {
    ?>
        <div class="form-group">
            <label for="form-file">Butuh Perbaikan ?</label>
        </div>
        <hr>
        <a href="<?= base_url('master/laporan_crane/validasi_act/' . $id . '/terima') ?>" class="btn btn-primary btn-sm btn-send">Ya</a>
        <button class="btn btn-danger btn-sm btn-send" onclick="tolak(<?= $id ?>)">Tolak</button>
    <?php
    } else {
    ?>
        <div class="form-group">
            <label for="form-file">Periksa Laporan Crane Ini ?</label>
        </div>
        <hr>
        <a href="<?= base_url('master/laporan_crane/validasi_act/' . $id . '/terima') ?>" class="btn btn-primary btn-sm btn-send">Terima</a>
        <a href="<?= base_url('master/laporan_crane/validasi_act/' . $id . '/tolak') ?>" class="btn btn-danger btn-sm btn-send">Tolak</a>
    <?php
    }
    ?>
<?php
} else if ($_SESSION['id_role'] == 2) {
?>
    <div class="form-group">
        <label for="form-file">Validasi Laporan Crane Ini ?</label>
    </div>
    <hr>
    <a href="<?= base_url('master/laporan_crane/validasi_act/' . $id . '/terima') ?>" class="btn btn-primary btn-sm btn-send">Terima</a>
    <button class="btn btn-danger btn-sm btn-send" onclick="tolak(<?= $id ?>)">Tolak</button>
<?php
} else if ($_SESSION['id_role'] == 3) {
?>
    <div class="form-group">
        <label for="form-file">Ajukan Rekomendasi Laporan Crane Ini ?</label>
    </div>
    <hr>
    <a href="<?= base_url('master/laporan_crane/validasi_act/' . $id . '/terima') ?>" class="btn btn-primary btn-sm btn-send">Ya</a>
    <button class="btn btn-danger btn-sm btn-send" data-dismiss="modal">Tidak</button>
<?php
} else if ($_SESSION['id_role'] == 4) {
?>
    <div class="form-group">
        <label for="form-file">Ajukan Rekomendasi Laporan Crane Ini ?</label>
    </div>
    <hr>
    <a href="<?= base_url('master/laporan_crane/validasi_act/' . $id . '/terima') ?>" class="btn btn-primary btn-sm btn-send">Ya</a>
    <button class="btn btn-danger btn-sm btn-send" data-dismiss="modal">Tidak</button>
<?php
}
?>
<script type="text/javascript">
    function tolak(id) {
        $("#load-form").html('loading...');
        $("#modal-form").modal();
        $("#title-form").html('Validasi');
        $("#load-form").load("<?= base_url('master/laporan_crane/validasi_tolak/') ?>" + id);
    }
</script>