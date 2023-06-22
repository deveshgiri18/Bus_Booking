<!-- 
<link href="<?php echo base_url(); ?>includes/plugins/advance_datatable/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>includes/plugins/advance_datatable/buttons.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/advance_datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/advance_datatable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/advance_datatable/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/advance_datatable/buttons.colVis.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/advance_datatable/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/advance_datatable/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/advance_datatable/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>includes/plugins/advance_datatable/jszip.min.js"></script>

 

<script>
  function makeDataTable_Basic(tableID) {
    var tableMDT = $('#' + tableID).DataTable({
      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        // Bold the grade for all 'A' grade browsers
        if ( aData[4] == "A" )
                     	  {
                       	   $('td:eq(4)', nRow).html( '<b>A</b>' );
                     	  }
                   	},
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis',
                            { extend: 'print', exportOptions: { columns: ':visible' }  },
                            { extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'LEGAL',  download: 'open' },
                            { extend: 'excelHtml5', customize: function( xlsx ) { var sheet = xlsx.xl.worksheets['sheet1.xml']; $('row c[r^="C"]', sheet).attr( 's', '2' ); }}
                          ]
                 });
 }
</script> -->




<div class="content-wrapper">
  <div class="card mt-4">
    <div class="card-header">
      <h2>Manage Locations <a href="#" data-toggle='modal' data-target='#exampleModalCenter' class="btn btn-info btn-sm float-right">Add New</a></h2>
    </div>



    <!-- <div class="container ml-1 "><br>
      <input type="text" name="" id="myinput" placeholder="names..">
    </div> -->

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



              <label for="exampleInputEmail1">Location Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Location Name">
              <div id="err_name"></div>
            </div>

            <div class="form-group">
              <div id="edit_err_mgs"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="sub_btn" onclick="add_data();">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal update -->
  <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- <form id="regdata"> -->

        <div class="modal-body">
          <div class="form-group">

            <input type="hidden" id="edit_id">

            <label for="exampleInputEmail1">Location Name</label>
            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Location Name">
            <div id="edit_err_name"></div>
          </div>

          <div class="form-group">
            <div id="edit_err_mgs"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="update_data();">Update</button>
        </div>
        <!-- </form> -->
      </div>
    </div>
  </div>

  <!-- <script type="text/javascript">
  $(document).ready(function(){
    $("#myinput").on("keyup",function(){
 var value = $(this).val().toLowerCase();
    $("#tbl_students tr").filter(function(){
      $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1);
    });
    });
  });
</script> -->




  <script>
    function add_data() {
      $("#err_name").html("");
      var name = $("#name").val();

      if (name == "") {
        $("#err_name").html("Please enter Location Name");
        $("#name").focus();
      } else {
        // $("#sub_btn").prop("disabled", true);
        var base_url = '<?php echo base_url(); ?>';
        let myForm = document.getElementById('regdata');
        let formData = new FormData(myForm);
        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: base_url + "admin/add_location",
          data: formData,
          processData: false,
          contentType: false,
          cache: false,
          success: function(data, textStatus, jqXHR) {
            console.log(data);
            if (data.response == true) {

              $("#name").val("");
              alert(data.message);
              $('#exampleModalCenter').modal('hide');
              get_all_data();

            } else {
              alert(data.message);
            }

          }
        });

      }
    }
    get_all_data();

    function get_all_data() {
      var base_url = '<?php echo base_url(); ?>';
      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: base_url + "admin/get_all_data",
        cache: false,
        success: function(data, textStatus, jqXHR) {
          // console.log(data.no_of_records);
          if (data.response = true) {

            var txt = "<table class='table table-bordered table-sm' id='tbl_students'>";

            txt += "<head>";
            txt += "<tr>";

            txt += "<th>#</th>";
            txt += "<th>Location Name</th>";

            txt += "<th>Status</th>";
            txt += "<th>Action</th>";
            txt += "<th>Action</th>";
            txt += "</tr>";

            txt += "</head>";
            txt += "<body>";
            for (var i = 0; i < data.total_records; i++) {
              txt += "<tr>";
              txt += "<td>" + data.no_of_records[i].id + "</td>";
              txt += "<td>" + data.no_of_records[i].name + "</td>";
              if(data.no_of_records[i].action == 1){
                txt += "<td><input type='checkbox' id='active' name='btn_dele'  onclick='status(" + data.no_of_records[i].id + ");' checked> Active</button></td>";
              }else if(data.no_of_records[i].action == 0){
                txt += "<td><input type='checkbox' id='active' name='btn_dele'  onclick='status2(" + data.no_of_records[i].id + ");' > Active</button></td>";
              }
              





              // txt += "<td><input type='text' id='"+data.no_of_records[i].id+"_stu_clss' class='form-control' name='stu_clss' ></td>";
              txt += "<td><button type='button' id='btn_class' class='btn btn-success' name='btn_class' data-toggle='modal' data-target='#exampleModalCenter2' onclick='get_data_by_id(" + data.no_of_records[i].id + ");' >update</button></td>";
              txt += "<td><button type='button' id='btn_dele' class='btn btn-danger' name='btn_dele'  onclick='delete_user(" + data.no_of_records[i].id + ");' >delete</button></td>";
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
    get_all_data();

    function status(id) {

      if (id == "") {
        alert("Invalid request");
      } else {
        var base_url = '<?php echo base_url(); ?>';
        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: base_url + "Admin/status_update",
          data: { 'id': id},
          cache: false,
          success: function(data, textStatus, jqXHR) {
            if (data.response == true) {
               get_all_data();
            } else {
              alert(data.message);
            }

          }
        });

      }

    }

    function status2(id) {

if (id == "") {
  alert("Invalid request");
} else {
  var base_url = '<?php echo base_url(); ?>';
  $.ajax({
    type: "POST",
    dataType: "JSON",
    url: base_url + "Admin/status2_update",
    data: { 'id': id},
    cache: false,
    success: function(data, textStatus, jqXHR) {
      if (data.response == true) {
         get_all_data();
      } else {
        alert(data.message);
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
          url: base_url + "Admin/get_data_by_id",
          data: {
            'id': id
          },
          //processData: false,
          //contentType: false,
          cache: false,
          success: function(data, textStatus, jqXHR) {
            if (data.response == true) {
              $("#edit_name").val(data.no_of_records[0].name);
              $("#edit_id").val(data.no_of_records[0].id);

            } else {
              alert(data.message);
            }

          }
        });

      }

    }

    function update_data() {

      $("#edit_err_name").html("");


      var id = $("#edit_id").val();
      var name = $("#edit_name").val();


      if (name == "") {
        $("#err_name").html("Please enter Location");
        $("#name").focus();
      } else {
        $("#sub_btn").prop("disabled", true);
        var base_url = '<?php echo base_url(); ?>';

        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: base_url + "Admin/update_data",
          data: {
            'name': name,
            'id': id
          },

          cache: false,
          success: function(data, textStatus, jqXHR) {
            console.log(data);
            if (data.response == true) {
              alert(data.message);
              $('#exampleModalCenter2').modal('hide');
              get_all_data();

            } else {
              alert(data.message);
            }

          }
        });


      }


    }
    get_all_data();

    function delete_user(user_id) {
      var conf = confirm("Are you sure to delete this Location?");
      if (conf == true) {
        var base_url = '<?php echo base_url(); ?>';
        $.ajax({
          type: "POST",
          dataType: "JSON",
          url: base_url + "admin/delete_user",
          data: {
            'user_id': user_id
          },
          cache: false,
          success: function(data, textStatus, jqXHR) {

            if (data.response == true) {
              get_all_data();
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