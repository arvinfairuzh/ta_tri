<!-- Content Wrapper. Contains page content -->
<form method="POST" action="<?= base_url('master/Pegawai/update') ?>" id="upload-create" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $pegawai['id'] ?>">
  <input type="hidden" name="nik" value="<?= $pegawai['nik'] ?>">
  <input type="hidden" name="email" value="<?= $pegawai['email'] ?>">
  <input type="hidden" name="password" value="<?= $pegawai['password'] ?>">
  <div class="show_error"></div>
  <div class="form-group">
    <label for="form-nik">Nik</label>
    <input type="text" class="form-control" id="form-nik" placeholder="Masukan Nik" name="dt[nik]" value="<?= $pegawai['nik'] ?>">
  </div>
  <div class="form-group">
    <label for="form-email">Email</label>
    <input type="email" class="form-control" id="form-email" placeholder="Masukan Email" name="dt[email]" value="<?= $pegawai['email'] ?>">
  </div>
  <div class="form-group">
    <label for="form-password">Password</label>
    <input type="password" class="form-control" id="form-password" placeholder="Masukan Password" name="dt[password]">
  </div>
  <div class="form-group">
    <label for="form-password">Konfirmasi Password</label>
    <input type="password" class="form-control" id="form-password" placeholder="Masukan Konfirmasi Password" name="password_confirmation_field">
  </div>
  <div class="form-group">
    <label for="form-nama">Nama</label>
    <input type="text" class="form-control" id="form-nama" placeholder="Masukan Nama" name="dt[nama]" value="<?= $pegawai['nama'] ?>">
  </div>
  <div class="form-group">
    <label for="form-id_role">Id Role</label>
    <select style='width:100%' name="dt[id_role]" class="form-control select2">
      <?php
      $role = $this->mymodel->selectWhere('role', null);
      foreach ($role as $role_record) {
        $text = "";
        if ($role_record['id'] == $pegawai['id_role']) {
          $text = "selected";
        }
        echo "<option value=" . $role_record['id'] . " " . $text . " >" . $role_record['role'] . "</option>";
      }
      ?>
    </select>
  </div>
  <?php
  if ($file['dir'] != "") {
    $types = explode("/", $file['mime']);
    if ($types[0] == "image") {
  ?>
      <img src="<?= base_url($file['dir']) ?>" style="width: 200px" class="img img-thumbnail">
      <br>
    <?php } else { ?>
      <i class="fa fa-file fa-5x text-danger"></i>
      <br>
      <a href="<?= base_url($file['dir']) ?>" target="_blank"><i class="fa fa-download"></i> <?= $file['name'] ?></a>
      <br>
      <br>
    <?php } ?>
  <?php } ?>
  <div class="form-group">
    <label for="form-file">File</label>
    <input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file">
  </div>
  <hr>
  <button type="submit" class="btn btn-primary btn-send"><i class="fa fa-save"></i> Save</button>
  <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>
</form>
<!-- /.content-wrapper -->
<script type="text/javascript">
  $("#upload-create").submit(function() {

    var form = $(this);

    var mydata = new FormData(this);

    $.ajax({

      type: "POST",

      url: form.attr("action"),

      data: mydata,

      cache: false,

      contentType: false,

      processData: false,

      beforeSend: function() {

        $(".btn-send").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Processing...").attr('disabled', true);

        form.find(".show_error").slideUp().html("");

      },

      success: function(response, textStatus, xhr) {

        // alert(mydata);

        var str = response;

        if (str.indexOf("success") != -1) {

          form.find(".show_error").hide().html(response).slideDown("fast");

          setTimeout(function() {

            // window.location.href = "<?= base_url('master/Pegawai') ?>";
            $("#load-table").html('');
            loadtable($("#select-status").val());
            $("#modal-form").modal('hide');

          }, 1000);

          $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);





        } else {

          form.find(".show_error").hide().html(response).slideDown("fast");

          $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);



        }

      },

      error: function(xhr, textStatus, errorThrown) {

        console.log(xhr);

        $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);

        form.find(".show_error").hide().html(xhr).slideDown("fast");



      }

    });

    return false;



  });
</script>