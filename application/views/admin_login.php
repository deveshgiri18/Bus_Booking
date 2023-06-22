<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>


<body>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <form id="reg_data">

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="typeEmailX">Email</label>
                  <input type="email" id="email" class="form-control form-control-lg" />
                  <div id="err_email"></div>
                </div>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="typePasswordX">Password</label>
                  <input type="password" id="password" class="form-control form-control-lg" />
                  <div id="err_pass"></div>

                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                <div class="form-group">
                  <button type="button" id="sub_btn" class="btn btn-outline-light btn-lg px-5" onclick="admin_login();">Submit</button>
                </div>

              </form>

              <!-- <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div> -->

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

<script>
  function admin_login() {
    $("#err_pass").html("");
    $("#err_email").html("");
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var email = $("#email").val();
    var password = $("#password").val();
    if (email == "") {
      $("#err_email").html("Please enter your email id");
      $("#email").focus();
    } else if (!regex.test(email)) {
      $("#err_email").html("Please enter your Valid email address");
      $("#email").focus();
    } else if (password == "") {
      $("#err_pass").html("Please enter your password");
      $("#password").focus();
    } else if (password.length < 6) {
      $("#err_pass").html("Please enter your 6 digit  password");
      $("#password").focus();
    } else {
      // $("#sub_btn").prop("disabled", true);
      var base_url = 'http://localhost/booking_prac/';
      let myForm = document.getElementById('reg_data');
      let formData = new FormData(myForm);
       
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + "Admin/admin_login",
        data: {
          'email': email,
					'password': password,
        },
        	
        // processData: false,
        // contentType: false,
        cache: false,
        success: function(data, textStatus, jqXHR) {
          console.log(data);
          if (data.response == true) {
          
            window.location.replace("http://localhost/booking_prac/admin/admin_page");

          }


        }
      });


    }

  }
  </script>