

<div class="container-fluid bg-primary py-5 mb-5 hero-header">
  <div class="container py-5">
    <div class="row justify-content-center py-5">
      <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Make Your Trip Now </h1>
        <p class="fs-4 text-white mb-4 animated slideInDown">We Will Trying To Make Your Trip Memorable</p>
        <div class="position-relative w-75 mx-auto animated slideInDown">

          <form id="regdata">

            <select name="gofrom" id="gofrom" required class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" required>
              <option value="">SELECT FROM LOCATION</option>
              <?php
              if ($role_list != FALSE) {
                foreach ($role_list as $rolelist) {
                  echo "<option value='" . $rolelist->name . "'>" . $rolelist->name . "</option>";
                }
              }
              ?>
            </select>
            <br>
            <select name="goto" id="goto" required class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" required>
              <option value="">SELECT TO LOCATION</option>
              <?php
              if ($role_list != FALSE) {
                foreach ($role_list as $rolelist) {
                  echo "<option value='" . $rolelist->name . "'>" . $rolelist->name . "</option>";
                }
              }
              ?>
            </select>
            <br>
            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" name="dateid" id="dateid" type="date" placeholder="____Date___" required>
            <br>

        </div>
        <div class="position-relative w-75 mx-auto animated slideInDown">

          <button type="button" class="btn btn-primary rounded-pill py-2 px-4 w-50" style="margin-top: 7px;" onclick="get_bus_booking_details();">Search</button>

        </div>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Navbar & Hero End -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="regdata">

        <div class="modal-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            <div id="err_name" style="color: red;"></div>
          </div>

          <input type="hidden" id="edit_id">


          <div class="form-group">
            <label>Number</label>
            <input type="number" class="form-control" id="number" name="number" placeholder="Enter your number" required>
            <div id="err_number" style="color: red;"></div>
          </div>

          <div class="form-group">
            <label>seats</label>
            <input type="number" class="form-control" id="seats" name="seats" placeholder="seats" required>
            <div id="err_seats" style="color: red;"></div>
          </div>


          <div class="form-group">
            <div id="edit_err_mgs" style="color: red;"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="sub_btn" onclick="confirm_booking();">Booked</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- ////////////////////////////////////////////////////////////////// -->

<!-- <div class="w3-container">
 
  <button onclick="document.getElementById('id01').style.display='block'" >Open Animated Modal</button>

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <div class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Modal Header</h2>
            </div>
      <div class="w3-container">
      <form id="regdata">

<div class="modal-body">
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
    <div id="err_name" style="color: red;"></div>
  </div>

  <input type="hidden" id="edit_id">


  <div class="form-group">
    <label>Number</label>
    <input type="number" class="form-control" id="number" name="number" placeholder="Enter your number" required>
    <div id="err_number" style="color: red;"></div>
  </div>

  <div class="form-group">
    <label>seats</label>
    <input type="number" class="form-control" id="seats" name="seats" placeholder="seats" required>
    <div id="err_seats" style="color: red;"></div>
  </div>


  <div class="form-group">
    <div id="edit_err_mgs" style="color: red;"></div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" onclick="document.getElementById('id01').style.display='none'" data-dismiss="modal">Cancel</button>
  <button type="button" class="btn btn-primary" id="sub_btn" onclick="confirm_booking();">Booked</button>
</div>
</form>
</div>
</div>
</div>

      </div>
     
    </div>
  </div>
</div> -->
    

<!-- ///////////////////////////////////////////////////////////////////////////////////// -->

<div class="container" style="margin-top: 20px">
  <div class="card custom-card" style="background-color: darkred;">
    <div style="padding-top: 34px;padding-top: 34px; color:black ;padding-bottom: 10px;padding-left: 34px;display: flex;flex-direction: column;" id="view_all_data">
    <!-- <div style="float: left; width: 100%; background-color: white;">
                <div style='width:30%;float: left;'><h3 style='color:black'>` + data.all_records[i].busno + `</h3><p>` + data.all_records[i].date + `</p> </div>
                <div style='width:15%;float: left;'><b>From: ` + data.all_records[i].start + `</b></div>
                <div style='width:15%;float: left;'><b>` + data.all_records[i].end + `</b></div>
                <div style='width:20%;float: left;'><b>` + data.all_records[i].amount + `</b></div>
                <div style='width:20%;float: left;'><button type='button' id='btn_class' <a href='#' data-toggle='modal' data-target='#exampleModalCenter2' class='btn btn-success' onclick='get_data_by_id(` + data.all_records[0].id + `);' >Book Now</a></button></div>
                </div> -->
      <div style="padding-left: 35%;" id="no_record_view">
        <h3 style="color:black">No Records Found</h3>
      </div>
    </div>
  </div>
</div>

<script>
  function get_bus_booking_details() {


    var goto = $("#goto").val();
    var gofrom = $("#gofrom").val();
    var dateid = $("#dateid").val();


    if (gofrom == "") {
      // $("#err_name").html("Please enter bus No");
      $("#gofrom").focus();
    } else if (goto == "") {
      // $("#err_busno").html("From");
      $("#goto").focus();
    } else if (dateid == "") {
      // $("#err_date").html("Please Fill");
      $("#dateid").focus();
    } else {
      var base_url = '<?php echo base_url(); ?>';

      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + "Home/get_bus_booking_details",
        data: {
          'goto': goto,
          'gofrom': gofrom,
          'dateid': dateid
        },

        // processData: false,
        //  contentType: false,
        cache: false,
        success: function(data, textStatus, jqXHR) {
          console.log(data);
          if (data.response == true) {
            $("#no_record_view").css("display", "none");

            for (var i = 0; i < data.total_records; i++) {

              $("#view_all_data").append(`
                  <div style='float: left; width: 100%;'>
                  <div style='width:30%;float: left;'><h3 style='color:black'>` + data.all_records[i].busno + `</h3><p>` + data.all_records[i].date + `</p> </div>
                  <div style='width:15%;float: left;'><b>From: ` + data.all_records[i].start + `</b></div>
                  <div style='width:15%;float: left;'><b>` + data.all_records[i].end + `</b></div>
                  <div style='width:20%;float: left;'><b>` + data.all_records[i].amount + `</b></div>
                  <div style='width:20%;float: left;'><button type='button' id='btn_class' <a href='#' data-toggle='modal' data-target='#exampleModalCenter2' class='btn btn-success' onclick='get_data_by_id(` + data.all_records[0].id + `);' >Book Now</a></button></div>
                  </div>
                <div style="padding-left: 35%;" id="no_record_view">
              `);
            }

          } else if (data.response == false) {
            $("#view_all_data").html("<b>No records</b>");

          }

        }
      });

    }
  }



  function get_data_by_id(id) {
    if (id == "") {
      alert("Invalid request");
    } else {
      var base_url = '<?php echo base_url(); ?>';
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + "Home/get_data_by_id",
        data: {
          'id': id
        },
        //processData: false,
        //contentType: false,
        cache: false,
        success: function(data, textStatus, jqXHR) {
          if (data.response == true) {

            $("#edit_id").val(data.no_of_records[0].id);


          } else {
            alert(data.message);
          }

        }
      });

    }

  }

  function confirm_booking(){

    $("#err_name").html("");
      $("#err_number").html("");
      $("#err_seats").html("");
     

      var name = $("#name").val();
      var number = $("#number").val();
      var seats = $("#seats").val();
      var id = $("#edit_id").val();
      

      if (name == "") {
        $("#err_name").html("Please enter bus No");
        $("#name").focus();
      }
      else if (number == "") {
        $("#err_number").html("From");
        $("#number").focus();
      }
      else if (seats == "To") {
        $("#err_seats").html("Please Fill");
        $("#seats").focus();
      }
      
       else {
        
        var base_url = '<?php echo base_url(); ?>';
        let myForm = document.getElementById('regdata');
        let formData = new FormData(myForm);
        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: base_url + "Home/confirm_booking",
          data:  {
      'id': id,
      'name': name,
      'number': number,
      'seats': seats
      
    },
          
          // processData: false,
          // contentType: false,
          cache: false,
          success: function(data, textStatus, jqXHR) {
            console.log(data);
            if (data.response == true) {

              $("#name").val("");
              $("#seats").val("");
              $("#number").val("");
             
              alert(data.message);
              
              
              $('#exampleModalCenter2').modal('hide');
              window.location.replace("http://localhost/booking_prac/home/success");

            } else {
              alert(data.message);
            }

          }
        });

      }


  }
</script>