<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Laporan Operator
      <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Master</a></li>
      <li class="#">Laporan Operator</li>
      <li class="active">Edit</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <form method="POST" action="<?= base_url('master/Laporan_operator/update') ?>" id="upload-create" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $laporan_operator['id'] ?>">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header">
              <h5 class="box-title">
                Edit Laporan Operator
              </h5>
            </div>
            <div class="box-body">
              <div class="show_error"></div>
              <?php
              if ($_SESSION['id_role'] == 3) {
                $form_atas = '';
                $form_bawah = 'hide';
              } else {
                $form_atas = 'hide';
                $form_bawah = '';
              }
              ?>
                <div class="form-group <?= $form_atas ?>">
                  <label for="form-tanggal">Tanggal</label>
                  <input type="date" class="form-control" id="form-tanggal" placeholder="Masukan Tanggal" name="dt[tanggal]" value="<?= $laporan_operator['tanggal'] ?>">
                </div>
                <div class="form-group col-md-12 <?= $form_atas ?>">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Uraian</th>
                        <th width="120" rowspan="2">Kesesuaian </th>
                        <th rowspan="2">Keterangan</th>
                        <th colspan="3">Dasar Hukum</th>
                      </tr>
                      <tr>
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
                        foreach ($jawaban as $j) {
                          if ($j->id == $dp['id']) {
                            if ($j->kesesuaian == 'Ya') {
                              $hasil = 'checked';
                              $hasil_text = 'Ya';
                            } else {
                              $hasil = '';
                              $hasil_text = 'Tidak';
                            }
                            $keterangan = $j->keterangan;
                          } else {
                          }
                        }
                      ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td>
                            <input type="hidden" name="id_dp[]" value="<?= $dp['id'] ?>">
                            <?= $dp['nama'] ?>
                          </td>
                          <td>
                            <input type="checkbox" class="hasil_toggle" id="hasil_toggle<?= $dp['id'] ?>" data-toggle="toggle" <?= $hasil ?>>
                            <input type="hidden" name="hasil[]" id="hasil<?= $dp['id'] ?>" value="<?= $hasil_text ?>">
                          </td>
                          <td><textarea name="keterangan[]" id="" rows="1" class="form-control"><?= $keterangan ?></textarea></td>
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
                </div>
                <div class="form-group col-md-12 <?= $form_bawah ?>">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_fieldinvoice" style="width:100%;">
                      <tr>
                        <th>
                          REKOMENDASI
                        </th>
                        <th>
                          TINDAK LANJUT
                        </th>
                        <th>
                        </th>
                      </tr>
                      <?php
                      $i = 100;
                      foreach ($rekomendasi_operator as $rc) {
                        $i++;
                      ?>
                        <tr id="rowinvoice<?= $i ?>">
                          <td>
                            <textarea class="form-control" name="rekomendasi[]" rows="1"><?= $rc->rekomendasi ?></textarea>
                          </td>
                          <td>
                            <?php
                            if ($rc->gambar != "") {
                            ?>
                              <img src="<?= base_url($rc->gambar) ?>" style="width: 200px" class="img img-thumbnail">
                              <br>
                            <?php } ?>
                            <textarea class="form-control" name="tindak_lanjut[]" rows="1"><?= $rc->tindak_lanjut ?></textarea>
                            <input type="hidden" class="form-control" name="hasil_file_old[]" value="<?= $rc->gambar ?>">
                            <input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file[]">
                          </td>
                          <td align="center">
                            <button type="button" name="remove" id="<?= $i ?>" data-toggle="modal" title="Hapus" data-target="#modal-delete-file-<?= $i ?>" class="btn pull-right btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                          </td>
                          <div class="modal modal-default fade" id="modal-delete-file-<?= $i ?>" style="display: none;">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header bg-red">
                                  <h4 class="modal-title" align="center"> Hapus File</h4>
                                </div>
                                <div class="modal-body" align="center">
                                  <h4>Anda yakin ingin menghapus data ini?</h4>
                                  <div class="box-footer" align="center">
                                    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="mdi mdi-close"></i> Tutup</button>
                                    <button type="button" id="<?= $i ?>" class="btn btn-danger btn_remove"><i class="mdi mdi-delete"></i> Hapus</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </tr>
                      <?php
                      } ?>
                      <tfoot>
                        <tr>
                          <td colspan="4">
                          </td>
                          <td style="width:5%;">
                            <button type="button" name="addinvoice" id="addinvoice" class="btn btn-primary pull-right"><i class="fa fa-plus"></i></button>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-send"><i class="fa fa-save"></i> Save</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  $(function() {
    $('.hasil_toggle').bootstrapToggle({
      on: 'Ya',
      off: 'Tidak'
    });
  })
  $(document).on('change', '.hasil_toggle', function() {
    var switchStatus = false;
    var str = $(this).attr("id");
    var id = str.substring(12);
    if ($("#hasil_toggle" + id).is(':checked')) {
      switchStatus = $("#hasil_toggle" + id).is(':checked');
      $("#hasil" + id).val('Ya');
    } else {
      switchStatus = $("#hasil_toggle" + id).is(':checked');
      $("#hasil" + id).val('Tidak');
    }
  });

  $(document).ready(function() {
    var i = 1;
    $('#addinvoice').click(function() {
      i++;
      $('#dynamic_fieldinvoice').append('<tr id="rowinvoice' + i + '">' +
        '<td>' +
        '<textarea class="form-control" name="rekomendasi[]" rows="1"></textarea>' +
        '</td>' +
        '<td>' +
        '<textarea style="margin-bottom: 5px;" class="form-control" name="tindak_lanjut[]" rows="1"></textarea>' +
        '<input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file[]">' +
        '</td>' +
        '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove pull-right"><i class="fa fa-trash"></i></button></td>' +
        '</tr>');
      $('.select2').select2();

    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $("#modal-delete-file-" + button_id).modal('hide');
      $('#rowinvoice' + button_id + '').remove();
    });

  });

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

            window.location.href = "<?= base_url('master/Laporan_operator') ?>";

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