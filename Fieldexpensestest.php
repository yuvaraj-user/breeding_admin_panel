

<?php include "Header.php"; 

function Generate_Document_No($id)
{
    global $conn;
    //$Emp_Id=$Emp_Id !=''? strtoupper(trim($Emp_Id)) : "";
    $Doc_No_Auto_Generation_Sql = "Breeding_Generate_No @Id=" . $id . ",@EmployeeCode=" . @$_SESSION['EmpID']. " ";

    //  echo "Vechicle_Auot_Generate_No @Id=".$id."";
    $Doc_No_Auto_Generation_Dets = sqlsrv_query(
        $conn,
        $Doc_No_Auto_Generation_Sql
    );
    $Doc_No_Auto_Generation_Result = sqlsrv_fetch_array(
        $Doc_No_Auto_Generation_Dets
    );
    return $MC_Doc_No_Generation_Id =
        $Doc_No_Auto_Generation_Result["PrimaryId"];
}
$Doc_No = Generate_Document_No(0);




  /*$sql="SELECT COUNT(*) as count FROM BreedingAdmin_Type Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Currentstatus ='1'";
$stmt = sqlsrv_query($conn, $sql);
   $Header_data = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

*/



?>

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css">


<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />

                 <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />



<style>
#dt-example{
  td.details-control{
    // background: url('../images/dt-plus.png') no-repeat center center;
    cursor: pointer;

  }
  tr.shown {
    td{
        background-color: #225699;
        color: #fff !important;
        border:none;
        border-right:1px solid #4D7CB0;
        &:last-child{
          border-right:none;
        }
        &.details-control {
          // background: #225699 url('../images/dt-minus.png') no-repeat center center;
        }
     }
  }  
  tr.details-row{
      .details-table {
        tr:first-child td{
          color: #FFF;
          background: #8FC2E2;
          border:none;
       }
     >td{
      padding:0;
    }
        .fchild td:first-child{
          cursor:pointer;
          &:hover{
            background:#fff;
          }
        }  
   }
}
  .form-group.agdb-dt-lst{
    padding:2px;
    height: 23px;
    margin-bottom: 0;
    .form-control{
      height: 23px;
      padding: 2px;
    }
  }
  .adb-dtb-gchild{
    padding-left:2px;
    td{
    background:#F5FAFC;
    padding-left:15px;
      &:first-child{
        cursor:default;
      }
    }
  }
  .fchild ~ .adb-dtb-gchild{
/*       display: none; */
    }
}

    </style>

<script>
function Alert_Msg(Msg,Type){
    swal({
  title: Msg,
  icon: Type,
});
}

</script>


       





           <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->


                   <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right hide-phone">
                                <ul class="list-inline">
                                  
                                  
                                </ul>                                
                            </div>
                            
                            <div class="btn-group mt-2">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#">Breeding</a></li>
                                    <li class="breadcrumb-item active">Project Acrage</li>
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                </div>


             
                <!-- end page title end breadcrumb -->
                


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                           


                           






   <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Field Expenses</h4>
                              

                             <div class="cf">
    <div class="panel panel-default">        
        <div class="panel-body">
<!-- Dynamic table was here -->
<table id="dt-example" class="stripe row-border order-column cl-table dataTable no-footer" cellspacing="0" width="100%">
  <thead>
    <tr>
<th>Sno</th>
<th>Location</th>
<th>Project</th>
<th>Activity</th>
<th>type</th>
<th>Status</th>
<th>Calls</th>
<th>Duration</th>
<th>Invoice</th>
<th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>22</td>
      <td>10</td>
      <td>12</td>
      <td>23 Feb 2017</td>
      <td>Active</td>
      <td>5,290</td>
      <td>7,245m</td>
      <td>$2,275.75</td>
      <td>[V][E]</td>
    </tr>
    
  </tbody>
</table>
  </div>
                
 </div>
</div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


                       








                                    <!-- Modal -->


                 <div align="center">
                    <button type="button" class="btn btn-sm btn-success ">Submit</button>



                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>

                    </div>


                        </div>                                
                    </div> <!-- end col -->
                </div> <!-- end row --> 

            
              
          

            </div> <!-- end container -->
        </div>



        <!-- end wrapper -->







        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- KNOB JS -->
        <script src="assets/plugins/jquery-knob/excanvas.js"></script>
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script> 

        <!-- Plugins js -->
        <script src="assets/plugins/timepicker/moment.js"></script>
        <script src="assets/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>
        <script src="assets/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
        <script src="assets/plugins/clockpicker/jquery-clockpicker.min.js"></script>
        <script src="assets/plugins/colorpicker/jquery-asColor.js"></script>
        <script src="assets/plugins/colorpicker/jquery-asGradient.js"></script>
        <script src="assets/plugins/colorpicker/jquery-asColorPicker.min.js"></script>
        <script src="assets/plugins/select2/select2.min.js"></script>

        <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>


         <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Plugins Init js -->
        <script src="assets/pages/form-advanced.js"></script> 

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script src="../../../common/checkSession.js"></script>

       <!-- Required datatable js -->
       



    <script>





  $(document).ready(function(){
     //$('.js-example-basic-single').select2();


  


    $('#data-table').dataTable();
        $(".dataTable").on("draw.dt", function (e) {
          //console.log("drawing");
          setCustomPagingSigns.call($(this));
        }).each(function () {
          setCustomPagingSigns.call($(this)); // initialize
        });
        function setCustomPagingSigns() {
          var wrapper = this.parent();
          wrapper.find("a.previous").text("<");
          wrapper.find("a.next").text(">");
        }
// =============Display details onclick===============
var data = [
    {"accounts":"1","numbers":"Daniels","campaigns":"cdaniels0@java.com","users":"China","created_date":"27.159.97.60","status":"active","calls":"22","duration":"50","invoice":"3434","actions":"1"},
       
  ];
  
 

  function format (data) {
    console.log(data);
      return '<div class="details-container">'+
          '<table cellpadding="0" cellspacing="0" border="0" class="details-table">'+
              '<tr>'+
                  '<td>'+
                  '<div class="form-group agdb-dt-lst"><select class="form-control" id="dt-sel-year"><option value="cYear">Current Year</option><option>2016</option><option>2015</option><option>2014</option></select></div>'+
                  '</td>'+
                  
                  '<td>May &apos;17</td>'+
                  '<td>Apr &apos;17</td>'+
                  '<td>Mar &apos;17</td>'+
                  '<td>Feb &apos;17</td>'+
                  '<td>Jan &apos;17</td>'+
                  '<td>Dec &apos;16</td>'+
                  '<td>Nov &apos;16</td>'+
                  '<td>Oct &apos;16</td>'+
                  '<td>Sep &apos;16</td>'+
                  '<td>Aug &apos;16</td>'+
                  '<td>Jul &apos;16</td>'+
                  '<td>Jun &apos;16</td>'+
                  '<td>Total</td>'+
              '</tr>'+
              '<tr class="fchild">'+
                  '<td>'+
                  'Numbers'+
                  '</td>'+              
                  '<td>22</td>'+
                  '<td>21</td>'+
                  '<td>20</td>'+
                  '<td>21</td>'+
                  '<td>18</td>'+
                  '<td>19</td>'+
                  '<td>16</td>'+
                  '<td>22</td>'+
                  '<td>13</td>'+
                  '<td>16</td>'+
                  '<td>20</td>'+
                  '<td>21</td>'+
                  '<td>19</td>'+
                '</tr>'+
               
                
            '</table>'+
        '</div>';
  };
  
  var table = $('.dataTable').DataTable({

    // Column definitions
    columns : [  

    {data : 'accounts',className : 'details-control',},    
        {
            data : 'numbers',
            className : 'details-control',
        },
        
        {data : 'campaigns'},
        {data : 'users'},
        {data : 'created_date'},
        {data : 'status'},
        {data : 'calls'},
        {data : 'duration'},
        {data : 'invoice'},
        {data : 'actions'}
    ],    
    data : data,    
    pagingType : 'full_numbers',    
    // Localization
    language : {
      emptyTable     : 'No data to display.',
      zeroRecords    : 'No records found!',
      thousands      : ',',
      // processing     : 'Processing...',
      loadingRecords : 'Loading...',
      search         : 'Search:',
      paginate       : {
        next     : 'next',
        previous : 'previous'
      }
    }
  });
 
  $('.dataTable tbody').on('click', 'td.details-control', function () {
     var tr  = $(this).closest('tr'),
         row = table.row(tr);
    
     if (row.child.isShown()) {
       tr.next('tr').removeClass('details-row');
       row.child.hide();
       tr.removeClass('shown');
     }
     else {
       row.child(format(row.data())).show();
       tr.next('tr').addClass('details-row');
       tr.addClass('shown');
     }
  });

$('#dt-example').on('click','.details-table tr',function(){
  $('.details-table').find('.adb-dtb-gchild:not(:first-child)').slideToggle();       
    });

//dropdown style
setTimeout(function(){
  $('#dt-sel-year').select2({});
}, 2000);



  });







    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
 <!-- jQuery  -->
     

        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>




        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>



<?php include "footer.php"; ?>




   

