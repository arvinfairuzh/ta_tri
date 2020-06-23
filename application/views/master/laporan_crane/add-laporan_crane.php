

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

                <div class="show_error"></div><div class="form-group">

                      <label for="form-tanggal">Tanggal</label>

                      <input type="text" class="form-control" id="form-tanggal" placeholder="Masukan Tanggal" name="dt[tanggal]">

                  </div><div class="form-group">

                      <label for="form-value_json">Value Json</label>

                      <input type="text" class="form-control" id="form-value_json" placeholder="Masukan Value Json" name="dt[value_json]">

                  </div><div class="form-group">

                      <label for="form-keterangan_tolak">Keterangan Tolak</label>

                      <input type="text" class="form-control" id="form-keterangan_tolak" placeholder="Masukan Keterangan Tolak" name="dt[keterangan_tolak]">

                  </div><div class="form-group">

                      <label for="form-validasi">Validasi</label>

                      <input type="text" class="form-control" id="form-validasi" placeholder="Masukan Validasi" name="dt[validasi]">

                  </div><div class="form-group">

                      <label for="form-id_se">Id Se</label>

                      <input type="text" class="form-control" id="form-id_se" placeholder="Masukan Id Se" name="dt[id_se]">

                  </div><div class="form-group">

                      <label for="form-id_spv">Id Spv</label>

                      <input type="text" class="form-control" id="form-id_spv" placeholder="Masukan Id Spv" name="dt[id_spv]">

                  </div><div class="form-group">

                      <label for="form-id_inspektor">Id Inspektor</label>

                      <input type="text" class="form-control" id="form-id_inspektor" placeholder="Masukan Id Inspektor" name="dt[id_inspektor]">

                  </div><div class="form-group">

                      <label for="form-id_gudang">Id Gudang</label>

                      <input type="text" class="form-control" id="form-id_gudang" placeholder="Masukan Id Gudang" name="dt[id_gudang]">

                  </div><div class="form-group">

                      <label for="form-file">File</label>

                      <input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file">

                  </div></div>

            <div class="box-footer">

                <button type="submit" class="btn btn-primary btn-send" ><i class="fa fa-save"></i> Save</button>

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

      $("#upload-create").submit(function(){

            var form = $(this);

            var mydata = new FormData(this);

            $.ajax({

                type: "POST",

                url: form.attr("action"),

                data: mydata,

                cache: false,

                contentType: false,

                processData: false,

                beforeSend : function(){

                    $(".btn-send").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Processing...").attr('disabled',true);

                    form.find(".show_error").slideUp().html("");

                },

                success: function(response, textStatus, xhr) {

                    // alert(mydata);

                   var str = response;

                    if (str.indexOf("success") != -1){

                        form.find(".show_error").hide().html(response).slideDown("fast");

                        setTimeout(function(){ 

                           window.location.href = "<?= base_url('master/Laporan_crane') ?>";

                        }, 1000);

                        $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled',false);





                    }else{

                        form.find(".show_error").hide().html(response).slideDown("fast");

                        $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled',false);

                        

                    }

                },

                error: function(xhr, textStatus, errorThrown) {

                  console.log(xhr);

                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled',false);

                    form.find(".show_error").hide().html(xhr).slideDown("fast");



                }

            });

            return false;

    

        });

  </script>