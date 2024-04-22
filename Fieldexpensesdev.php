

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
.bg-secondary {
    --bs-bg-opacity: 1;
    background-color: rgb(227 242 255) !important;
}.tablecolor{

    background-color: #007bff;
    color: white;
}.dt-buttons{
    display: none;
}.monthinputbox{

        border: none;
    background: transparent;
}.close{

  background-color: red;
}.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 13px !important;
}table thead{

      background-color: #0033c4;
    color: white;
}.header-title{

    color: blue;
    font-weight: 900;
}

</style>


 <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 100%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {

  background-color: #ffffff;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 10px 16px;
  background-color: #042649;
  color: white;
}.name_user{

  font-weight: 700;
  padding-left: 1000px;

}.name_Id{

  font-weight: 700;
  padding-left: 1000px;

}.multiselect-container>li>a>label {
    margin: 0;
    height: 100%;
    cursor: pointer;
    font-weight: 400;
     padding: 0px 1px 1px 22px; 
}.select2-container {
    box-sizing: border-box;
  /*  display: inline; */
    margin: 0;
    position: relative;
    vertical-align: middle;
}.closereuest{

  font-size: 11px !important;
}table tr{

    font-size: 11px !important;
}.tripdetails,.pagination{
font-size: 11px !important;

}.dt-buttons{

  display: none;
}.duplicate_row{
background: floralwhite;
  }.btn-default{
  background-color: #bb0e0e;
  color: white;
}input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}table tr{

    color: black;
}.fontdesign{

    font-size: 9px !important;
}.swal-text {
    font-size: 13px !important;

}.monthinputbox{

        border: none;
    background: transparent;
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
                              

                                <table id="fieldexpensedata" class="table table-striped table-bordered  nowrap fieldexpensedata" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Location</th>
                                        <th>Project</th>
                                        <th>Activity</th>
                                        <th>type</th>
                                        
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Aug</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dec</th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>May</th>



                                    </tr>
                                    </thead>


                                   <tbody>

                                   </tbody>
                                </table>

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



        $(document).on("click",".addbtn",function(){

//alert("Hai");

//return false;


var locationvalue=$("#location").val();

var projectnvalue=$("#project").val();


//alert(locationvalue);

if(locationvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}

if(projectnvalue ==''){

 Alert_Msg("Please Select project.","warning");
 return false;
}

           // alert(breedingtype);

//alert("Hai");
         // return false;

 let Uset_Input=$(".Fieldexpensedataform").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"Fieldexpensedataform"});
    
      $.ajax 
      ({
      type: "POST",
      url: "Common_Ajax.php",
       data:Uset_Input,
       async:false,//
      success: function(data){

      //  $(".loadingclasspre").hide()

        //$(".projectwisehide").css("display","block")
          
         result=JSON.parse(data);



         
         if(result.Status == 1){
           

            Alert_Msg("Added.","success");

             var user_input={};


  
  

     //  assumptionwiseprojectDetails_month_amount("yes",user_input);
            return false;
         }else{

           // alert("Wrong");
               Alert_Msg("Something Went Wrong.","error");
               return false;
         }
        }
      });




return false;



      




   
      
      
});



/*

 $(document).on("click",".singleseletion",function(){




var locationvalue=$("#location").val();

var projectnvalue=$("#project").val();


//alert(locationvalue);

if(locationvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}

if(projectnvalue ==''){

 Alert_Msg("Please Select project.","warning");
 return false;
}

           // alert(breedingtype);

//alert("Hai");
        //  return false;

 let Uset_Input=$(".Assumptionwisemalefemale").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"Assumptionwisemalefemale"});
    
      $.ajax 
      ({
      type: "POST",
      url: "Common_Ajax.php",
       data:Uset_Input,
       async:false,//
      success: function(data){

      //  $(".loadingclasspre").hide()

        //$(".projectwisehide").css("display","block")
          
         result=JSON.parse(data);



         
         if(result.Status == 1){
           

            Alert_Msg("Added.","success");

             var user_input={};


  
   assumptionwiseprojectDetails("yes",user_input);

       assumptionwiseprojectDetails_month_amount("yes",user_input);
            return false;
         }else{

           // alert("Wrong");
               Alert_Msg("Something Went Wrong.","error");
               return false;
         }
        }
      });




return false;



      




   
      
      
});

*/


$(document).on("change",".locationvalue",function(){
    ///$(this).closest("tr").find(".QtyInBag").removeAttr("readonly");
    var locbaseproject=$(this).val();
    //var curren_tr=$(this).closest("tr");
     $.ajax 
      ({
      type: "POST",
      url: "AutoFill_Details.php",
      data:{"Action":"Get_Location_Based_Project","locbaseproject":locbaseproject},
       async:false,
     

       success: function(html){

          $(".locbaseprojectvalue").html(html);
        
        }


    });
   });









function fieldexpensewiseprojectDetails(destroy_status,user_input)
{



   var data_table='fieldexpensedata'
   if(destroy_status == "yes")
  {
    $('.'+data_table).DataTable().destroy();
  }
 $('.' + data_table).DataTable({

    "dom": 'Bfrtip',

 
  
   //"columnDefs": [{ "className":"y desine", "targets": [1] }],
    "dom": 'Bfrtip',
    

    "scrollX": true,
    "bScrollCollapse": true,

      "buttons": [{
          extend: 'copy',
          title: 'Rasi Seeds (P) Ltd - A & P Portal - Qulaity'         
        }, {
          extend: 'csv',
           customize: function (csv) {
           return "Rasi Seeds (P) Ltd - A & P Portal - Qulaity\n\n"+  csv;
          }
               
        }, {
          extend: 'excel',
          customize: function (excel) {
           return "Rasi Seeds (P) Ltd - A & P Portal - Qulaity\n\n"+  excel;
          }     
        }, {
          extend: 'pdf',
           customize: function (pdf) {
           return "Rasi Seeds (P) Ltd - A & P Portal - Qulaity\n\n"+  pdf;
          }         
        }, {
          extend: 'print',
          title: 'Rasi Seeds (P) Ltd - A & P Portal - Qulaity'     
        },],
    "bprocessing": true,
    "serverSide": true,
    "info": false,
    "pageLength": 10,
    "ajax": 
    {
      "url": "Common_Ajax.php", 
      "type": "POST",
      "data": {Action:"FiledExpensesEnrty"}
    }
  });
}




function assumptionwiseprojectDetails_month_amount(destroy_status,user_input)
{


Autoincnum=user_input.Autoincnum;
autoid=user_input.autoid;

   var data_table='assumptionwise_Amount'
   if(destroy_status == "yes")
  {
    $('.'+data_table).DataTable().destroy();
  }
 $('.' + data_table).DataTable({

    "dom": 'Bfrtip',

 
  
  //"columnDefs": [{ "className":"y desine", "targets": [1,2,3,4,5] }],
    "scrollX": true,
    "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
    "bprocessing": true,
    "serverSide": true,
    "pageLength": 5,
      "searching": false,
    "ajax": 
    {
      "url": "Common_Ajax.php", 
      "type": "POST",
      "data": {Action:"AssumptionEnrty_malefemaleamount"}
    }
  });
}




  $(document).ready(function(){
     //$('.js-example-basic-single').select2();


  


   var user_input={};

  
   fieldexpensewiseprojectDetails("yes",user_input);



  });




$(document).on("click", ".Add_Popup", function (){

      //  alert("Hai");

       var passing_total_acrage=$(this).parents('tr').find(".acragevaluemain").val();

      // var CTC_Value = $(this).parents('tr').find(".CTC_Value").val();

      // alert(passing_total_acrage);

       //return false;

       if(passing_total_acrage ==''){

        var passing_total_acrage=0;


       }

    $("#monthwisedetails").modal('show');
 var passing_id_loc=$(this).closest('td').find('.passing_id_loc').val();
 var passing_id_proj=$(this).closest('td').find('.passing_id_proj').val();






 

     var passing_id = $(this).attr("attributeid");
       var currentRequest = $.ajax({
            type: "POST",
            url: "ajax_popup_details_View.php",
            beforeSend: function() {
                var sdata = checkSession();
                if(sdata.status=='expired')
                  currentRequest.abort();
            },
            data: {
                passing_id: passing_id,
                passing_id_loc: passing_id_loc,
                passing_id_proj: passing_id_proj,
                action_type:"monthwisedata"
            },
            success: function (output) {
              var rowdata = JSON.parse(output);
              $("#monthwisedetails").modal('show');
              $(".Conformation-body").html(rowdata);

              $(".Total_acrage").val(passing_total_acrage);
            }
        });




    });
    





$(document).on("click",".finalsubmittion",function(){


 let Uset_Input=$(".tablewisedataassumption").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"FinalsubmittionAssumption"});
    
      $.ajax 
      ({
      type: "POST",
      url: "Common_Ajax.php",
       data:Uset_Input,
       async:false,//
      success: function(data){
          
         result=JSON.parse(data);
         
         if(result.Status == 1){
           

            Alert_Msg("Submitted.","success");


          window.location.href ='Assumptions.php';
  

            return false;
         }else{

           // alert("Wrong");
               Alert_Msg("Something Went Wrong.","error");
               return false;
         }
        }
      });




return false;



      


});




$(document).on("click",".singleseletion",function(){

    //alert("hai");



var locationvalue=$("#location").val();

var projectnvalue=$("#project").val();


//alert(locationvalue);

if(locationvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}

if(projectnvalue ==''){

 Alert_Msg("Please Select project.","warning");
 return false;
}



    $("#Assumptionpopup").modal('show');



 







});






        $(document).on("click",".savemalefemale",function(){

alert("Hai");

//return false;


var locationvalue=$("#location").val();

var projectnvalue=$("#project").val();


//alert(locationvalue);

if(locationvalue ==''){

 Alert_Msg("Please Select Location.","warning");
 return false;
}

if(projectnvalue ==''){

 Alert_Msg("Please Select project.","warning");
 return false;
}

           // alert(breedingtype);

//alert("Hai");
         // return false;

 let Uset_Input=$(".Assumptionwisemalefemale").serializeArray();
    
    Uset_Input.push({"name":"Action","value":"singlemalefemale"});
    
      $.ajax 
      ({
      type: "POST",
      url: "Common_Ajax.php",
       data:Uset_Input,
       async:false,//
      success: function(data){

      //  $(".loadingclasspre").hide()

        //$(".projectwisehide").css("display","block")
          
         result=JSON.parse(data);



         
         if(result.Status == 1){
           

            Alert_Msg("Added.","success");

             var user_input={};

   $(".close").trigger('closebutton'); 
  
   assumptionwiseprojectDetails("yes",user_input);

       assumptionwiseprojectDetails_month_amount("yes",user_input);



            return false;
         }else{

           // alert("Wrong");
               Alert_Msg("Something Went Wrong.","error");
               return false;
         }
        }
      });
return false;
   
});

  function format (data) {
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
  }

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




   

