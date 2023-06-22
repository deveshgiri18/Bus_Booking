<div class="content-wrapper">
  <div class="card mt-4">
    <div class="card-header">
      <h2>Manage Bus Schedule <a href="#" data-toggle='modal' data-target='#exampleModalCenter' class="btn btn-info btn-sm float-right">Add Schedule</a></h2>
    </div>


    <div class="row">
      <div class="card-body" id="view_all_data"></div>
    </div>

  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
              <label>Bus Number</label>
              <input type="text" class="form-control" id="bus_no" name="bus_no" placeholder="Location Name">
              <div id="err_bus_no" style="color: red;"></div>
            </div>

            <input type="hidden" id="edit_id">

            <div class="form-group">
              <label>Start</label>
             <select name="start"  id="start" required class="form-control">
           
                <option value="">Select Start</option>
                <?php
                   if($role_list != FALSE)
                    {
                     foreach($role_list as $rolelist)
                      {
                       echo "<option value='".$rolelist->name."'>".$rolelist->name."</option>";
                      }
                    }
                  ?>
             </select>
              <div id="err_start" style="color: red;"></div>
            </div>
          

            <div class="form-group">
              <label>End</label>
             <select name="end"  id="end" required class="form-control">
                <option value="">Select End</option>
                <?php
                if($role_list != FALSE)
                    {
                     foreach($role_list as $rolelist)
                      {
                       echo "<option value='".$rolelist->name."'>".$rolelist->name."</option>";
                      }
                    }
                  ?>
             </select>
              <div id="err_end" style="color: red;"></div>
            </div>

            <div class="form-group">
              <label>Date</label>
              <input type="date" class="form-control" id="date" name="date" placeholder="Location Name">
              <div id="err_date" style="color: red;"></div>
            </div>

            <div class="form-group">
              <label>Amount</label>
              <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount">
              <div id="err_amount" style="color: red;"></div>
            </div>


            <div class="form-group">
              <div id="edit_err_mgs" style="color: red;"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="sub_btn" onclick="bus_schedule_add();">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>


   <!--Update Modal -->
   <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

       

          <div class="modal-body">
            <div class="form-group">
              <label>Bus Number</label>
              <input type="text" class="form-control" id="edit_bus_no" name="bus_no" placeholder="Location Name">
              <div id="edit_err_bus_no" style="color: red;"></div>
            </div>

            <div class="form-group">
              <label>Start</label>
             <select name="start"  id="edit_start" required class="form-control">
           
                <option value="">Select Start</option>
                <?php
                   if($role_list != FALSE)
                    {
                     foreach($role_list as $rolelist)
                      {
                       echo "<option value='".$rolelist->name."'>".$rolelist->name."</option>";
                      }
                    }
                  ?>
             </select>
              <div id="edit_err_start" style="color: red;"></div>
            </div>
          

            <div class="form-group">
              <label>End</label>
             <select name="end"  id="edit_end" required class="form-control">
                <option value="">Select End</option>
                <?php
                if($role_list != FALSE)
                    {
                     foreach($role_list as $rolelist)
                      {
                       echo "<option value='".$rolelist->name."'>".$rolelist->name."</option>";
                      }
                    }
                  ?>
             </select>
              <div id="edit_err_end" style="color: red;"></div>
            </div>

            <div class="form-group">
              <label>Date</label>
              <input type="date" class="form-control" id="edit_date" name="date" placeholder="Location Name">
              <div id="edit_date" style="color: red;"></div>
            </div>

            <div class="form-group">
              <label>Amount</label>
              <input type="number" class="form-control" id="edit_amount" name="amount" placeholder="Amount">
              <div id="edit_err_amount" style="color: red;"></div>
            </div>


            <div class="form-group">
              <div id="edit_err_mgs" style="color: red;"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary"  onclick="bus_schedule_update();">Update</button>
          </div>
        
      </div>
    </div>
  </div>

 

  


  <script>
    function bus_schedule_add() {
      $("#err_bus_no").html("");
      $("#err_start").html("");
      $("#err_end").html("");
      $("#err_date").html("");
      $("#err_amount").html("");

      var busno = $("#bus_no").val();
      var start = $("#start").val();
      var end = $("#end").val();
      var date = $("#date").val();
      var amount = $("#amount").val();

      if (busno == "") {
        $("#err_bus_no").html("Please enter bus No");
        $("#bus_no").focus();
      }
      else if (start == "") {
        $("#err_bus_no").html("From");
        $("#start").focus();
      }
      else if (end == "To") {
        $("#err_bus_no").html("Please Fill");
        $("#end").focus();
      }
      else if (date == "") {
        $("#err_bus_no").html("Please Fill");
        $("#date").focus();
      }
      else if (amount == "") {
        $("#err_bus_no").html("Please Fill");
        $("#amount").focus();
      }
       else {
        
        var base_url = '<?php echo base_url(); ?>';
        let myForm = document.getElementById('regdata');
        let formData = new FormData(myForm);
        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: base_url + "admin/bus_schedule_add",
          data: formData,
          
          processData: false,
          contentType: false,
          cache: false,
          success: function(data, textStatus, jqXHR) {
            console.log(data);
            if (data.response == true) {

              $("#bus_no").val("");
              $("#start").val("");
              $("#end").val("");
              $("#date").val("");
              $("#amount").val("");
              alert(data.message);
              $('#exampleModalCenter').modal('hide');
              get_all_data_bus_schedule();

            } else {
              alert(data.message);
            }

          }
        });

      }
    }

    function get_all_data_bus_schedule() {
      var base_url = '<?php echo base_url(); ?>';
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + "admin/get_all_data_bus_schedule",
        cache: false,
        success: function(data, textStatus, jqXHR) {
          // console.log(data.no_of_records);
          if (data.response = true) {

            var txt = "<table class='table table-bordered table-sm' id='tbl_students'>";

            txt += "<head>";
            txt += "<tr>";

            txt += "<th>#</th>";
            txt += "<th>Bus No</th>";

            txt += "<th>Start</th>";
            txt += "<th>End</th>";
            txt += "<th>Date</th>";
            txt += "<th>Amount</th>";
            txt += "<th>Update</th>";
            txt += "<th>Delete</th>";
            txt += "</tr>";

            txt += "</head>";
            txt += "<body>";
            for (var i = 0; i < data.total_records; i++) {
              txt += "<tr>";
              txt += "<td>" + parseInt(i+1) + "</td>";
              txt += "<td>" + data.no_of_records[i].busno + "</td>";
              txt += "<td>" + data.no_of_records[i].start + "</td>";
              txt += "<td>" + data.no_of_records[i].end + "</td>";
              txt += "<td>" + data.no_of_records[i].date + "</td>";
              txt += "<td>" + data.no_of_records[i].amount + "</td>";
              // if(data.no_of_records[i].action == 1){
              //   txt += "<td><input type='checkbox' id='active' name='btn_dele'  onclick='status(" + data.no_of_records[i].id + ");' checked> Active</button></td>";
              // }else if(data.no_of_records[i].action == 0){
              //   txt += "<td><input type='checkbox' id='active' name='btn_dele'  onclick='status2(" + data.no_of_records[i].id + ");' > Active</button></td>";
              // }
              





             
              txt += "<td><button type='button' id='btn_class' class='btn btn-success' name='btn_class' data-toggle='modal' data-target='#exampleModalCenter2' onclick='get_data_by_id_bus_schedule(" + data.no_of_records[i].id + ");' >update</button></td>";
              txt += "<td><button type='button' id='btn_dele' class='btn btn-danger' name='btn_dele'  onclick='delete_user_bus_schedule(" + data.no_of_records[i].id + ");' >delete</button></td>";
              txt += "</tr>";

            }



            txt += "</body>";
            txt += "</table>";
            $("#view_all_data").html(txt);

          } else {
            $("#view_all_data").html("<center><font color='red'><b>" + data.message + "</b></font></center>");

          }
          //  makeDataTable_Basic("tbl_students");
        }

      });
    }
    get_all_data_bus_schedule();

    
    function get_data_by_id_bus_schedule(id) {

if (id == "") {
  alert("Invalid request");
} else {
  var base_url = '<?php echo base_url(); ?>';
 $.ajax({
    type: "POST",
    dataType: "JSON",
    url: base_url + "Admin/get_data_by_id_bus_schedule",
    data: {
      'id': id
    },
    //processData: false,
    //contentType: false,
    cache: false,
    success: function(data, textStatus, jqXHR) {
      if (data.response == true) {
        $("#edit_bus_no").val(data.no_of_records[0].busno);
        $("#edit_id").val(data.no_of_records[0].id);
        $("#edit_start").val(data.no_of_records[0].start);
        $("#edit_end").val(data.no_of_records[0].end);
        $("#edit_date").val(data.no_of_records[0].date);
        $("#edit_amount").val(data.no_of_records[0].amount);

      } else {
        alert(data.message);
      }

    }
  });

}

}

function bus_schedule_update() {

$("#edit_err_bus_no").html("");
$("#edit_err_start").html("");
$("#edit_err_end").html("");
$("#edit_err_date").html("");
$("#edit_err_amount").html("");


var id = $("#edit_id").val();
var busno = $("#edit_bus_no").val();
var start = $("#edit_start").val();
var end = $("#edit_end").val();
var date = $("#edit_date").val();
var amount = $("#edit_amount").val();


if (busno == "") {
  $("#edit_err_bus_no").html("Please enter Bus No");
  $("#edit_bus_no").focus();
}
if (start == "") {
  $("#edit_err_start").html("Please enter start");
  $("#edit_start").focus();
}if (end == "") {
  $("#edit_err_end").html("Please enter end");
  $("#edit_end").focus();
}if (date == "") {
  $("#edit_err_date").html("Please enter date");
  $("#edit_date").focus();
}if (amount == "") {
  $("#edit_err_amount").html("Please enter amount");
  $("#edit_amount").focus();
} else {
 
 
  var base_url = '<?php echo base_url(); ?>';
        

  $.ajax({
    type: "POST",
    dataType: "JSON",
    url: base_url + "admin/bus_schedule_update",
    data: {
      'id' : id,
      'busno' : busno,
      'start' : start,
      'end' : end,
      'date' : date,
      'amount' : amount

    },
          
         
    cache: false,
    success: function(data, textStatus, jqXHR) {
      console.log(data);
      if (data.response == true) {
        alert(data.message);
        $('#exampleModalCenter2').modal('hide');
        get_all_data_bus_schedule();

      } else {
        alert(data.message);
      }

    }
  });


}


}
get_all_data_bus_schedule();

function delete_user_bus_schedule(user_id) {
      var conf = confirm("Are you sure to delete this Location?");
      if (conf == true) {
        var base_url = '<?php echo base_url(); ?>';
        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: base_url + "admin/delete_user_bus_schedule",
          data: {
            'user_id': user_id
          },
          cache: false,
          success: function(data, textStatus, jqXHR) {

            if (data.response == true) {
              get_all_data_bus_schedule();
            } else {
              alert(data.message);
            }

          }
        });
      } else {
        return false;
      }
    }
    </script>