

<?php 



    if($this->session->userdata('session_sop')!="") {

            redirect('/');

    }

?>

<!DOCTYPE html>

<html>
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url('assets/login/Login_v1')?>/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/Login_v1')?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/Login_v1')?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/Login_v1')?>/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/Login_v1')?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/Login_v1')?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/Login_v1')?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/Login_v1')?>/css/main.css">
<!--===============================================================================================-->
</head>

<body class="hold-transition login-page">

<!-- <div class="limiter">

  <div class="container-login100" style="<?= LOGIN_BACKGROUND ?>">

    <div class="wrap-login100" style="<?= LOGIN_BOX  ?>"> 

      <form action="<?= base_url('login/act_login')?>" method="post" id="upload">

        <span class="login100-form-logo">

          <img src=" <?= LOGO ?>" width="150">


        </span>



        <span class="login100-form-title p-b-34 p-t-27">

         <b><?= LOGIN_TITLE  ?></a>

        </span>

        <div class="show_error"></div>

        <div class="wrap-input100 validate-input" data-validate = "Enter username">

          <input class="input100" type="text" name="username" placeholder="Username">

          <span class="focus-input100" data-placeholder="&#xf207;"></span>

        </div>



        <div class="wrap-input100 validate-input" data-validate="Enter password">

          <input class="input100" type="password" name="password" placeholder="Password">

          <span class="focus-input100" data-placeholder="&#xf191;"></span>

        </div>

        <div class="container-login100-form-btn">

          <button class="btn btn-block btn-primary">

            Login

          </button>

        </div>

      </form>

    </div>

  </div>

</div> -->


<div class="limiter">
		<div class="container-login100" style="background-color: #28b79c;background:#28b79c;">
			<div class="wrap-login100"  style="padding: 100px 130px 100px 95px;">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?= base_url('assets/login/Login_v1')?>/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="<?= base_url('login/act_login')?>" method="post" id="upload">
					<span class="login100-form-title">
						LOGIN
					</span>
          <div class="show_error"></div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="background-color: #28b79c;background:#28b79c;">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>

<!-- jQuery 3 -->

<!--===============================================================================================-->	
<script src="<?= base_url('assets/login/Login_v1')?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/Login_v1')?>/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url('assets/login/Login_v1')?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/Login_v1')?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/login/Login_v1')?>/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


<script type="text/javascript">

        $("#upload").submit(function(){



            var mydata = new FormData(this);

            var form = $(this);

            $.ajax({

                type: "POST",

                url: form.attr("action"),

                data: mydata,

                cache: false,

                contentType: false,

                processData: false,

                beforeSend : function(){

                    $("#send-btn").addClass("disabled").html("<i class='fa fa-spinner fa-spin'></i>  Send...");

                    form.find(".show_error").slideUp().html("");



                },

                    success: function(response, textStatus, xhr) {

                    var str = response;

                    if (str.indexOf("oke") != -1){

                        document.getElementById('upload').reset();

                        $("#send-btn").removeClass("disabled").html("Sign in");

                         location.href = '<?= base_url("/") ?>';

                    }else{

                         $("#send-btn").removeClass("disabled").html("Sign in");

                        form.find(".show_error").hide().html(response).slideDown("fast");

                       

                        

                    }

                },

                error: function(xhr, textStatus, errorThrown) {

            

                }

            });

            return false;

            });

    </script>

<script>

  $(function () {

    $('input').iCheck({

      checkboxClass: 'icheckbox_square-blue',

      radioClass: 'iradio_square-blue',

      increaseArea: '20%' /* optional */

    });

  });

</script>

</body>

</html>

