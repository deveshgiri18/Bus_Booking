<div class="content-wrapper">
  <div class="card mt-4">
    <div class="card-header">
      <h2>Manage Bus Booking <a href="#" data-toggle='modal' data-target='#exampleModalCenter' class="btn btn-info btn-sm float-right">Add Schedule</a></h2>
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
                <label>Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Location Name">
                <div id="err_name" style="color: red;"></div>
              </div>

              <input type="hidden" id="edit_id">

              <div class="form-group">
                <label>Bus No</label>
                <select name="busno" id="busno" required class="form-control">

                  <option value="">Bus No</option>
                  <?php
                  if ($role_list != FALSE) {
                    foreach ($role_list as $rolelist) {
                      echo "<option value='" . $rolelist->busno . "'>" . $rolelist->busno . "</option>";
                    }
                  }
                  ?>
                </select>
                <div id="err_busno" style="color: red;"></div>
              </div>


              <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" id="date" required class="form-control">
                <div id="err_date" style="color: red;"></div>
              </div>

              <div class="form-group">
                <label>Seats</label>
                <input type="number" class="form-control" id="seats" name="seats" placeholder="Location Name">
                <div id="err_seats" style="color: red;"></div>
              </div>

              <div class="form-group">
                <label>Phone No</label>
                <input type="number" class="form-control" id="num" name="num" placeholder="Phone No">
                <div id="err_num" style="color: red;"></div>
              </div>


              <div class="form-group">
                <div id="edit_err_mgs" style="color: red;"></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="sub_btn" onclick="bus_booking_add();">Add</button>
            </div>
          </form>
        </div>
      </div>
      </div>

             <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src=" https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src=" https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
            <script src=" https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
            <script src=" https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
            <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src=" https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
            <script src=" https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
            <script src=" https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">   

            <script>
            
            $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );

</script>

      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Bus No</th>
             <th>Start</th>
            <th>End</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Seats</th>
            <th>Number</th>
            <th>Status</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <?php if($list != FALSE){
            foreach($list as $listo => $book) { ?>
              <tr>
                <td><?php echo $listo+1 ?></td>
                <td><?php echo "$book->name" ?></td>
                <td><?php echo "$book->busno" ?></td>
                <td><?php echo "$book->start" ?></td>
                <td><?php echo "$book->end" ?></td>
                <td><?php echo "$book->amount" ?></td>
                <td><?php echo "$book->date" ?></td>
                <td><?php echo "$book->seats" ?></td>
                <td><?php echo "$book->number" ?></td>
                <td><?php
                if("$book->status"==1){ echo "Pending";
                
                }else if("$book->status"==1){
                  echo "Success";
                }
                ?></td>

                
                <td><button type="button" id="btn_class" class="btn btn-success" name="btn_class" data-toggle="modal" data-target="#exampleModalCenter2">Edit</button>;</td>
              </tr>

          <?php }
          } ?>
        </tbody>
      </table>

    

    <script>
      function bus_booking_add() {
        $("#err_name").html("");
        $("#err_busno").html("");
        $("#err_date").html("");
        $("#err_seats").html("");
        $("#err_num").html("");

        var name = $("#name").val();
        var busno = $("#busno").val();
        var date = $("#date").val();
        var seats = $("#seats").val();
        var num = $("#num").val();

        if (name == "") {
          $("#err_name").html("Please enter bus No");
          $("#name").focus();
        } else if (busno == "") {
          $("#err_busno").html("From");
          $("#busno").focus();
        } else if (date == "") {
          $("#err_date").html("Please Fill");
          $("#date").focus();
        } else if (seats == "") {
          $("#err_seats").html("Please Fill");
          $("#seats").focus();
        } else if (num == "") {
          $("#err_num").html("Please Fill");
          $("#num").focus();
        } else {

          var base_url = '<?php echo base_url(); ?>';
          let myForm = document.getElementById('regdata');
          let formData = new FormData(myForm);
          $.ajax({
            type: "POST",
            dataType: "JSON",
            url: base_url + "admin_bus_booking/bus_booking_add",
            data: formData,

            processData: false,
            contentType: false,
            cache: false,
            success: function(data, textStatus, jqXHR) {
              console.log(data);
              if (data.response == true) {

                $("#name").val("");
                $("#busno").val("");
                $("#date").val("");
                $("#seats").val("");
                $("#num").val("");
                alert(data.message);
                $('#exampleModalCenter').modal('hide');


              } else {
                alert(data.message);
              }

            }
          });

        }
      }
    </script>