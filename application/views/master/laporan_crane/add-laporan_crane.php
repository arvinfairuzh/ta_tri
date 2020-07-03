<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Laporan Crane

      <small>Tambah</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="#">Master</a></li>

      <li class="#">Laporan Crane</li>

      <li class="active">Tambah</li>

    </ol>

  </section>

  <!-- Main content -->

  <section class="content">

    <form method="POST" action="<?= base_url('master/Laporan_crane/store') ?>" id="upload-create" enctype="multipart/form-data">



      <div class="row">

        <div class="col-xs-12">

          <div class="box">

            <!-- /.box-header -->

            <div class="box-header">

              <h5 class="box-title">

                Tambah Laporan Crane

              </h5>

            </div>

            <div class="box-body">

              <div class="show_error"></div>
              <div class="form-group col-md-12">
                <div class="form-group col-md-4">
                  <label for="form-tanggal">Tanggal</label>
                  <input type="date" class="form-control" id="form-tanggal" placeholder="Masukan Tanggal" name="dt[tanggal]">
                </div>
              </div>
              <div class="form-group">
                <!-- <label for="form-value_json">Value Json</label>
                <input type="text" class="form-control" id="form-value_json" placeholder="Masukan Value Json" name="dt[value_json]"> -->
                <div class="form-group col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr>
                        <th>No</th>
                        <th>Uraian</th>
                        <th width="120">Kesesuaian </th>
                        <th>Keterangan</th>
                        <th>Dasar Hukum</th>
                      </tr>
                      <?php
                        $master_list_crane = $this->mymodel->selectWithQuery("SELECT * FROM master_list_crane");
                        ?>
                        <?php
                          $no = 0;
                          foreach ($master_list_crane as $dp) {
                            $no++;
                            ?>
                          <tr>
                            <td><?= $no ?></td>
                            <td>
                              <input type="hidden" name="id_dp[]" value="<?= $dp['id'] ?>">
                              <?= $dp['nama'] ?>
                            </td>
                            
                            <td>
                              <!-- <input type="checkbox" class="hasil_toggle" id="hasil_toggle<?= $dp['id'] ?>" data-toggle="toggle" > -->
                              <input type="radio"  name="hasil[]" value="ya">
                              <label for="Tidak">Ya</label><br>
                              <input type="radio"  name="hasil[]" value="tidak">
                              <label for="Tidak">Tidak</label><br>
                              <input type="radio" name="hasil[]" value="tidak_ada">
                              <label for="Tidak">Tidak Ada</label>
                            </td>
                            <td><textarea name="keterangan[]" id="" rows="1" class="form-control"></textarea></td>
                            <td>
                              <?= $dp['dasar_hukum'] ?>
                            </td>
                          </tr>
                        <?php
                          }
                          ?>
                    </table>
                  </div>
                </div>
              </div>
              <table class="table table-bordered" id="dynamic_fieldinvoice" style="width:100%;">
                      <tr>
                        <th>
                          JENIS TEMUAN
                        </th>
                        <th>
                          HASIL TEMUAN
                        </th>
                        <th>
                          TEMUAN BERULANG KE
                        </th>
                        <th class="hidden">
                          TINDAK LANJUT
                        </th>
                        <th>
                        </th>
                      </tr>
                      <tr>
                        <td>
                          <select style="width: 100%" id="role0" name="jenis_temuan[]" class="form-control select2 role">
                            <option value="">Pilih Jenis Temuan</option>
                            <option value="UA">Sikap Tidak Aman</option>
                            <option value="UC">Kondisi Tidak Aman</option>
                            <option value="LK">Lingkungan Kerja</option>
                          </select>
                        </td>
                        <td>
                          <textarea class="form-control" name="hasil_temuan[]" rows="1"></textarea>
                        </td>
                        <td>
                          <input type="number" class="form-control" name="ke[]">
                        </td>
                        <td class="hidden">
                          <textarea style="margin-bottom: 5px;" class="form-control" name="tindak_lanjut[]" rows="1"></textarea>
                          <input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file[]">
                        </td>
                        <td style="width:5%;">
                          <button type="button" name="addinvoice" id="addinvoice" class="btn btn-primary pull-right"><i class="fa fa-plus"></i></button>
                        </td>
                      </tr>
                    </table>
              <div class="form-group">
                <label for="form-keterangan_tolak">Keterangan Tolak</label>
                <input type="text" class="form-control" id="form-keterangan_tolak" placeholder="Masukan Keterangan Tolak" name="dt[keterangan_tolak]">
              </div>
              <div class="form-group">
                <label for="form-validasi">Validasi</label>
                <input type="text" class="form-control" id="form-validasi" placeholder="Masukan Validasi" name="dt[validasi]">
              </div>
              <div class="form-group">
                <label for="form-id_se">Id Se</label>
                <input type="text" class="form-control" id="form-id_se" placeholder="Masukan Id Se" name="dt[id_se]">
              </div>
              <div class="form-group">
                <label for="form-id_spv">Id Spv</label>
                <input type="text" class="form-control" id="form-id_spv" placeholder="Masukan Id Spv" name="dt[id_spv]">
              </div>
              <div class="form-group">
                <label for="form-id_inspektor">Id Inspektor</label>
                <input type="text" class="form-control" id="form-id_inspektor" placeholder="Masukan Id Inspektor" name="dt[id_inspektor]">
              </div>
              <div class="form-group">
                <label for="form-id_gudang">Id Gudang</label>
                <input type="text" class="form-control" id="form-id_gudang" placeholder="Masukan Id Gudang" name="dt[id_gudang]">
              </div>
              <div class="form-group">
                <label for="form-file">File</label>
                <input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file">
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

$(document).ready(function() {
    var i = 1;
    $('#addinvoice').click(function() {
      i++;
      $('#dynamic_fieldinvoice').append('<tr id="rowinvoice' + i + '">' +
        '<td>' +
        '<select style="width: 100%" id="role0" name="jenis_temuan[]" class="form-control select2 role">' +
        '<option value="">Pilih Jenis Temuan</option>' +
        '<option value="UA">Sikap Tidak Aman</option>' +
        '<option value="UC">Kondisi Tidak Aman</option>' +
        '<option value="LK">Lingkungan Kerja</option>' +
        '</select>' +
        '</td>' +
        '<td>' +
        '<textarea class="form-control" name="hasil_temuan[]" rows="1"></textarea>' +
        '</td>' +
        '<td>' +
        '<input type="number" class="form-control" name="ke[]">' +
        '</td>' +
        '<td class="hidden">' +
        '<textarea style="margin-bottom: 5px;" class="form-control" name="tindak_lanjut[]" rows="1"></textarea>' +
        '<input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file[]">' +
        '</td>' +
        '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove pull-right"><i class="fa fa-trash"></i></button></td>' +
        '</tr>');
      $('.select2').select2();

    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
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

            window.location.href = "<?= base_url('master/Laporan_crane') ?>";

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