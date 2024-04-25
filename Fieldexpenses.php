


<?php include "header.php" ?>


<?php include "topmenubar.php" ?>


<?php include "sidebarmenu.php" ?>


<script>
    function Alert_Msg(Msg,Type){
        swal({
          title: Msg,
          icon: Type,
      });
    }

</script>

<style>

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

	</style>




<style>
    .bg-secondary {
        --bs-bg-opacity: 1;
        background-color: rgb(227 242 255) !important;
    }.tablecolor{

        background-color: #007bff;
        color: white;
    }.monthinputbox{

        border: none;
        background: transparent;
    }.close{

      background-color: red;
  }.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 13px !important;
}.header-title{

    color: blue;
    font-weight: 900;
}

/*#manDaysCountTable th{
    font-size: 12px;
    padding: 0;
    line-height: 4em;
}*/

/*#manDaysCountTable td{
    text-align: center !important;
}*/



.input_no_border {
    width: 46px;
    border: none;
    outline: none;
    background-color: transparent;
    text-align: center;
}

</style>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.css"/>
    <body data-sidebar="colored" class="sidebar-enable vertical-collpsed">


        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="layout-wrapper">

     

         


            


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                      

                        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bootstrap-select-1">
<h6 style="text-align: center;color: blue;">Field Expenses</h6>

       



        <div class="row">
            <div class="col-lg-12">
                <div class="card">










                    <div>
                        <ul class="nav nav-tabs" id="expenseTabs" role="tablist">
            <!-- <li class="nav-item">
                <a class="nav-link fieldTab active" id="fieldExpenses-tab" data-toggle="tab" href="#fieldExpenses" role="tab" aria-controls="fieldExpenses" aria-selected="true">Field Expenses</a>
            </li> -->
            <li class="nav-item ">
                <a class="nav-link fieldTab active" id="manDaysCount-tab" data-toggle="tab" href="#manDaysCount" role="tab" aria-controls="manDaysCount" aria-selected="false">ManDays Count</a>
            </li>

            <li class="nav-item">
                <a class="nav-link fieldTab" id="viewReport-tab" data-toggle="tab" href="#viewReport" role="tab" aria-controls="viewReport" aria-selected="false">View</a>
            </li>

        </ul>
        <div class="tab-content mt-3" id="expenseTabsContent">
            <!-- Field Expenses Tab -->
            <!-- <div class="tab-pane fade show active" id="fieldExpenses" role="tabpanel" aria-labelledby="fieldExpenses-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Field Expenses</h4>
                                <div class="cf">
                                    <div class="panel panel-default">        
                                        <div class="panel-body">
                                            <table id="fieldExpensesTable" class="stripe row-border order-column cl-table dataTable no-footer" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>Location</th>
                                                        <th>Project</th>
                                                        <th>Activity</th>
                                                        <th>Type</th>
                                                        <th>MaleAmount</th>
                                                        <th>FemaleAmount</th>
                                                        <th>Average</th>
                                                        <th>MF</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="fieldExpensesData">-->
                                                    <!-- Populate this with dynamic data
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- ManDays Count Tab -->
            <div class="tab-pane fade show active" id="manDaysCount" role="tabpanel" aria-labelledby="manDaysCount-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">ManDays Count</h4>
                                <div class="cf">
                                    <div class="panel panel-default">        
                                        <div class="panel-body">
                                            <table id="manDaysCountTable" class=" table table-bordered table-striped table-hover stripe row-border order-column cl-table dataTable no-footer" cellspacing="0" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>Location</th>
                                                        <th>Project</th>
                                                        <th>Activity</th>
                                                        <th>Type</th>
                                                        <th>Gender</th>
                                                        <th>Count</th>
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
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="manDaysCountData">
                                                    <!-- Populate this with dynamic data -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- View Report Tab -->
            <div class="tab-pane fade" id="viewReport" role="tabpanel" aria-labelledby="viewReport-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">View Report</h4>
                                <div class="cf">
                                    <div class="panel panel-default">        
                                        <div class="panel-body">
                                            <table id="viewReportTable" class="table table-bordered table-striped table-hover stripe row-border order-column cl-table dataTableView no-footer" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>Location</th>
                                                        <th>Project</th>
                                                        <th>Activity</th>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                        <th>Gender</th>
                                                        <th>Count</th>
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
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="viewReportData">
                                                    <!-- Populate this with dynamic data -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal" id="monthwisedetails" role="dialog">


        <form method="POST" class="monthwisedetails">

            <div class="modal-dialog modal-lg" style="max-width: 1200px !important">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-bs-dismiss='modal'>&times;</button>
                  <h6 style="color: #b48608; font-family: 'Droid serif', serif; font-size: 15px; font-weight: 400; font-style: italic; line-height: 44px;  text-align: center;margin-right: 465px;">Sowing and  Harvesting(Month Wise)</h6> 
              </div>
              <div class="Conformation-body">






              </div>

          </div>
      </div>

  </form>


</div>
<!-- End Modal--> 

<!-- Labour Rate Per Month -->

<div id="popupModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="tab-pane p-3" id="profile-1" role="tabpanel">
          <table class="table table-bordered nowrap assumptionwise_Amount_completed">
            <thead>
              <tr>
                <th>Location</th>
                <th>From</th>
                <th>To</th>
                <th>Male</th>
                <th>Female</th>
            </tr>
        </thead>
        <tbody class="Conformation-body-Div">
          <!-- Table body content will be populated dynamically -->
      </tbody>
  </table>
</div>
<div align="center">
  <button type="button" class="btn btn-sm btn-success finalsubmittioncompleted">Submit</button>
  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
</div>


<!-- <div class="tab-pane p-3" id="profile-1" role="tabpanel">
 <table  class="table table-bordered  nowrap assumptionwise_Amount_completed" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
     <thead >
         <tr>                    
                   
            <th>Location</th>
            <th>From</th>
            <th>To</th>
            <th>Male</th>
            <th>Female</th>

        </tr>
    </thead >
    <tbody class="">

    </tbody>            
    </table>
</div>
<div align="center">
 <button type="button" class="btn btn-sm btn-success finalsubmittioncompleted">Submit</button>
 <button type="button" class="btn btn-sm btn-danger " data-dismiss='modal'>Cancel</button>
</div>
-->

<!-- Labour Rate Per Month End -->







<!-- Modal -->


                <!--  <div align="center">
                    <button type="button" class="btn btn-sm btn-success ">Submit</button>



                    <button type="button" class="btn btn-sm btn-danger deleterow cancelbutton">Cancel</button>

                </div> -->


            </div>                                
        </div> <!-- end col -->
    </div> <!-- end row --> 




  

                    </div>    
                </div>
                <!-- End Page-content -->

                
                
               <?php include "footer.php"; ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

                             
        <!-- JAVASCRIPT -->
         <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <script src="assets/js/app.js"></script>

       
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>

       <script src="../common/checkSession.js"></script>

<!-- Required datatable js -->


<script>





  $(document).ready(function(){

    getManCountDays();
    getViewReport();

    var extractedValues=[];
    var subTableArr=[];
     //$('.js-example-basic-single').select2();  


   // $('#data-table').dataTable();



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


  $(".dataTableView").on("draw.dt", function (e) {
          //console.log("drawing");
      setCustomPagingSigns1.call($(this));
  }).each(function () {
          setCustomPagingSigns1.call($(this)); // initialize
      });
  function setCustomPagingSigns1() {
      var wrapper = this.parent();
      wrapper.find("a.previous").text("<");
      wrapper.find("a.next").text(">");
  }

// =============Display details onclick===============



// var data = [
//     {"accounts":"1","numbers":"Daniels","campaigns":"cdaniels0@java.com","users":"China","created_date":"27.159.97.60","status":"active","calls":"22","duration":"50","invoice":"3434","actions":"1"},

//   ];

  function format(data, tr, row) {

        // var InsertData = data;

        // console.log(data)

     // Extract specific values from the data array
    const [sno, location, crop, activity, type, value1, value2, buttonHtml, buttonHtml2] = data;

        // Extract values associated with specific HTML elements
        const passingIdLoc = buttonHtml.match(/value="([^"]+)"/)[1];
        const passingId = buttonHtml.match(/value="([^"]+)"/)[1];
        const passingIdProj = buttonHtml.match(/value="([^"]+)"/)[1];

        // Create an array of objects with named keys
        extractedValues = [
        {
            'sno': sno,
            'location': location,
            'project': crop,
            'activity': activity,
            'type': type,
            'maleAmount': value1,
            'femaleAmount': value2,
            'passing_id_loc': passingIdLoc,
            'passing_id': passingId,
            'passing_id_proj': passingIdProj
        }
        ];

        $.ajax({
            url: 'Common_Ajax.php',
            type: 'POST',
            dataType: 'json',
            data: { Action: 'getSubTableDetails', data: data },
            success: function(res) {
                var maleData = res.male[0];
                var femaleData = res.female[0];

                if (res && res.male && res.male.length > 0 && res.female && res.female.length > 0)
                {

                    var months = ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'];

                    var tableHtml = '<table cellpadding="0" cellspacing="0" border="0" class="details-table" style="width:100%; table-layout:fixed;">' +
                    '<tr style="background: #8FC2E2;">' +
                    '<td>Month</td>' +
                    '<td>Counts</td>';

                // Loop through months to create table headers
                    months.forEach(function(month) {
                        tableHtml += '<td>' + month + '</td>';
                    });

                // Add Total column
                    tableHtml += '<td>Total</td><td><button class="btn btn-primary btn-sm edit-subtable">Edit</button></td></tr>';

                // Function to calculate total for male
                    function calculateTotal(data) {
                        var total = 0;
                        months.forEach(function(month) {
                            total += parseFloat(data[month + '_Male_value']);
                        });
                        return total.toFixed(2);
                    }

                // Function to calculate total for female
                    function calculateTotalF(data) {
                        var total = 0;
                        months.forEach(function(month) {
                            total += parseFloat(data[month + '_femalevalue']);
                        });
                        return total.toFixed(2);
                    }

                    tableHtml += '<tr class="mchild"><td>Male</td><td><input type="text" style="width:55px" class="male_count" value="' + maleData.malecount + '" disabled readonly></td>';
                    months.forEach(function(month) {
                        tableHtml += '<td><input type="text" style="width:70px" value="' + parseFloat(maleData[month + '_Male_value']).toFixed(2) + '" disabled readonly></td>';
                    });
                    tableHtml += '<td><input type="text" id="mtotal" style="width:71px" value="' + calculateTotal(maleData) + '" disabled readonly></td></tr>';

                    tableHtml += '<tr class="fchild"><td>Female</td><td><input type="text" style="width:55px" value="' + femaleData.femalecount + '" disabled readonly></td>';
                    months.forEach(function(month) {
                        tableHtml += '<td><input type="text" style="width:70px" value="' + parseFloat(femaleData[month + '_femalevalue']).toFixed(2) + '" disabled readonly></td>';
                    });
                    tableHtml += '<td><input type="text" id="ftotal" style="width:71px" value="' + calculateTotalF(femaleData) + '" disabled readonly></td></tr>';
                    tableHtml +='<tr><td><button class="btn btn-primary btn-sm update-subtable" style="display:none">Save</button></td></tr>';
                    tableHtml += '</table>';

                    row.child(tableHtml).show();
                    tr.next('tr').addClass('details-row');
                    tr.addClass('shown');
                }
                else {
                    var tableHtml = '<table cellpadding="0" cellspacing="0" border="0" class="details-table">';
                    tableHtml += '<tr><td>No data available</td></tr>';
                    tableHtml += '</table>';

                // Show the child row with no data message
                    row.child(tableHtml).show();
                    tr.next('tr').addClass('details-row');
                    tr.addClass('shown');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
}


$(document).on('click','.edit-subtable', function() {


    // Initialize arrays to store values
    var valuesArray = [];
    var inputs = $('.details-table').closest('tr').find('input[type="text"]');

    // Iterate over each input element to extract its value
    inputs.each(function() {
        // Push the value of each input into the valuesArray
        valuesArray.push($(this).val());
    });

    // Display the extracted values in the console
   // console.log(valuesArray);
    

    subTableArr['male']=[{
        'Count':valuesArray[0],
        'Jun':valuesArray[1],
        'Jul':valuesArray[2],
        'Aug':valuesArray[3],
        'Sep':valuesArray[4],
        'Oct':valuesArray[5],
        'Nov':valuesArray[6],
        'Dec':valuesArray[7],
        'Jan':valuesArray[8],
        'Feb':valuesArray[9],
        'Mar':valuesArray[10],
        'Apr':valuesArray[11],
        'May':valuesArray[12],
        'Total':valuesArray[13]

    }];

    subTableArr['female']=[{
        'Count':valuesArray[14],
        'Jun':valuesArray[15],
        'Jul':valuesArray[16],
        'Aug':valuesArray[17],
        'Sep':valuesArray[18],
        'Oct':valuesArray[19],
        'Nov':valuesArray[20],
        'Dec':valuesArray[21],
        'Jan':valuesArray[22],
        'Feb':valuesArray[23],
        'Mar':valuesArray[24],
        'Apr':valuesArray[25],
        'May':valuesArray[26],
        'Total':valuesArray[27]

    }];

    //console.log(subTableArr)
// subTableArr=JSON.stringify(subTableArr)
    var requestData = {
        'Action': 'InsertMainSubTableData',
        'extractedValues': extractedValues,
        'Male': subTableArr['male'],
        'Female': subTableArr['female']
    };

    //console.log(requestData) 

    $.ajax({
        url: 'Common_Ajax.php',
        type: 'POST',
        dataType: 'json',
        data: requestData,
        success: function(res) {
           Alert_Msg(res.Status);

        //  setTimeout(function() {
        //     // Redirect to 'Fieldexpensestest_Div.php' after 2 seconds (adjust delay as needed)
        //     window.location.href = 'Fieldexpensestest_Div.php';
        // }, 2000); 

       }
   });
    //console.log(extractedValues);

    inputs.prop('disabled', false).removeAttr('readonly');
    $('#mtotal').prop('disabled', true).attr('readonly');
    $('#ftotal').prop('disabled', true).attr('readonly');
    $('.update-subtable').css('display','block');
});


$(document).on('click','.update-subtable', function() {

    console.log('Update Function')
    // Initialize arrays to store values
    var valuesArray = [];
    var inputs = $('.details-table').closest('tr').find('input[type="text"]');

    // Iterate over each input element to extract its value
    inputs.each(function() {
        // Push the value of each input into the valuesArray
        valuesArray.push($(this).val());
    });

    // Display the extracted values in the console
    //console.log(valuesArray);

    var subTableArrUpdate=[];

    subTableArrUpdate['male']=[{
        'Count':valuesArray[0],
        'Jun':valuesArray[1],
        'Jul':valuesArray[2],
        'Aug':valuesArray[3],
        'Sep':valuesArray[4],
        'Oct':valuesArray[5],
        'Nov':valuesArray[6],
        'Dec':valuesArray[7],
        'Jan':valuesArray[8],
        'Feb':valuesArray[9],
        'Mar':valuesArray[10],
        'Apr':valuesArray[11],
        'May':valuesArray[12],
        'Total':valuesArray[13]
    }];

    subTableArrUpdate['female']=[{
        'Count':valuesArray[14],
        'Jun':valuesArray[15],
        'Jul':valuesArray[16],
        'Aug':valuesArray[17],
        'Sep':valuesArray[18],
        'Oct':valuesArray[19],
        'Nov':valuesArray[20],
        'Dec':valuesArray[21],
        'Jan':valuesArray[22],
        'Feb':valuesArray[23],
        'Mar':valuesArray[24],
        'Apr':valuesArray[25],
        'May':valuesArray[26],
        'Total':valuesArray[27]
    }];

    var isTotalEqualMale;
    var isTotalEqualFemale;

    function checkMonthlyTotalEqualityMale(data) {
        var totalSum = 0;

        for (var month in data) {
            if (month !== 'Count' && month !== 'Total' && data.hasOwnProperty(month)) {
                totalSum += parseFloat(data[month]);
            }
        }    
        // Compare the calculated total sum with the 'Total' value

        return totalSum === parseFloat(data['Total']);
    }

    subTableArrUpdate['male'].forEach(function(item) {
       isTotalEqualMale = checkMonthlyTotalEqualityMale(item);
   });

    function checkMonthlyTotalEqualityFemale(data) {
        var totalSum = 0;

        // Calculate the sum of monthly amounts
        for (var month in data) {
            if (month !== 'Count' && month !== 'Total' && data.hasOwnProperty(month)) {
                totalSum += parseFloat(data[month]);
            }
        }    

        // Compare the calculated total sum with the 'Total' value
        return totalSum === parseFloat(data['Total']);
    }

    subTableArrUpdate['female'].forEach(function(item1) {
       isTotalEqualFemale = checkMonthlyTotalEqualityFemale(item1);
   });

    if(isTotalEqualFemale && isTotalEqualMale)
    {



       var requestData = {
        'Action': 'UpdateMainSubTableData',
        'extractedValues': extractedValues,
        'Male': subTableArrUpdate['male'],
        'Female': subTableArrUpdate['female']
    };

        //console.log(requestData) 

    $.ajax({
        url: 'Common_Ajax.php',
        type: 'POST',
        dataType: 'json',
        data: requestData,
        success: function(res) {
           Alert_Msg(res.Status);
             //location.reload();

           setTimeout(function() {
                // Redirect to 'Fieldexpensestest_Div.php' after 2 seconds (adjust delay as needed)
            window.location.href = 'Fieldexpensestest_Div.php';
        }, 2000); 

       }
   });
}
else
{
    alert('MonthWise Total and Total Not Equal');
        //location.reload();
}



});

function getViewReport()
{
    $.ajax({
        url: 'Common_Ajax.php',
        type: 'POST',
        dataType: 'json',
        data: { Action: 'getBreederDetailsManCount' },
        success: function(res) {
            console.log(res.male);

            resData = res;

            // Select the table body to populate
            var tableBody = $('#viewReportData');
            tableBody.empty();

            var sno = 1;

            // Iterate over the 'data' array
            for (var i = 0; i < res.data.length; i++) {
                var dataRow = res.data[i];

                //console.log(dataRow)
                var maleRow = res.male[i];
                var femaleRow = res.female[i];

                var dataRowAct = res.dataAct[i];
                var maleRowAct = res.maleAct[i];
                var femaleRowAct = res.femaleAct[i];


                if (dataRow && maleRow && femaleRow) {


                 // Calculate monthly totals for male row
                var maleTotal = (
                    parseFloat(maleRow.Jun_Male_value) +
                    parseFloat(maleRow.Jul_Male_value) +
                    parseFloat(maleRow.Aug_Male_value) +
                    parseFloat(maleRow.Sep_Male_value) +
                    parseFloat(maleRow.Oct_Male_value) +
                    parseFloat(maleRow.Nov_Male_value) +
                    parseFloat(maleRow.Dec_Male_value) +
                    parseFloat(maleRow.Jan_Male_value) +
                    parseFloat(maleRow.Feb_Male_value) +
                    parseFloat(maleRow.Mar_Male_value) +
                    parseFloat(maleRow.Apr_Male_value) +
                    parseFloat(maleRow.May_Male_value)
                    ).toFixed(2);

                // Calculate monthly totals for female row
                var femaleTotal = (
                    parseFloat(femaleRow.Jun_femalevalue) +
                    parseFloat(femaleRow.Jul_femalevalue) +
                    parseFloat(femaleRow.Aug_femalevalue) +
                    parseFloat(femaleRow.Sep_femalevalue) +
                    parseFloat(femaleRow.Oct_femalevalue) +
                    parseFloat(femaleRow.Nov_femalevalue) +
                    parseFloat(femaleRow.Dec_femalevalue) +
                    parseFloat(femaleRow.Jan_femalevalue) +
                    parseFloat(femaleRow.Feb_femalevalue) +
                    parseFloat(femaleRow.Mar_femalevalue) +
                    parseFloat(femaleRow.Apr_femalevalue) +
                    parseFloat(femaleRow.May_femalevalue)
                    ).toFixed(2);

                    var maleRowHtml = '<tr class="male_details'+i+'">' +
                    '<td>' + sno + '</td>' +
                    '<td>' + dataRow.BreedingLocation + '</td>' +
                    '<td>' + dataRow.Project + '</td>' +
                    '<td>' + dataRow.BreedingActivity + '</td>' +
                    '<td>' + dataRow.Breedingtype + '</td>' +
                    '<td>' + dataRow.MaleAmount + '</td>' +
                    '<td>' + maleRow.gender + '</td>' +
                    '<td>' + maleRow.malecount + '</td>' +
                    '<td>' + parseFloat((maleRow.Jun_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Jul_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Aug_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Sep_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Oct_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Nov_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Dec_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Jan_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Feb_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Mar_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.Apr_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRow.May_Male_value)*(dataRow.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + ((maleTotal)*(dataRow.MaleAmount)) + '</td>' +
                    '<input type="hidden" name="passing_id[]" value="' + dataRow.passing_id + '">' +
                    '<input type="hidden" name="passing_id_loc[]" value="' + dataRow.passing_id_loc + '">' +
                    '<input type="hidden" name="passing_id_proj[]" value="' + dataRow.passing_id_proj + '">' +
                    '</tr>';

                    // Append the male row to the table
                    tableBody.append(maleRowHtml);

                    sno++;


                    // Create a new row for female data
                var femaleRowHtml = '<tr class="female_details'+i+'">' +
                '<td>' + sno + '</td>' +
                '<td>' + dataRow.BreedingLocation + '</td>' +
                '<td>' + dataRow.Project + '</td>' +
                '<td>' + dataRow.BreedingActivity + '</td>' +
                '<td>' + dataRow.Breedingtype + '</td>' +
                '<td>' + dataRow.FemaleAmount + '</td>' +
                '<td>' + femaleRow.gender + '</td>' +
                '<td>' + femaleRow.femalecount + '</td>' +
                '<td>' + parseFloat((femaleRow.Jun_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Jul_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Aug_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Sep_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Oct_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Nov_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Dec_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Jan_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Feb_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Mar_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.Apr_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + parseFloat((femaleRow.May_femalevalue)*(dataRow.FemaleAmount)).toFixed(2) + '</td>' +
                '<td>' + ((femaleTotal)*(dataRow.FemaleAmount)) + '</td>' +
                '<input type="hidden" name="passing_id[]" value="' + dataRow.passing_id + '">' +
                '<input type="hidden" name="passing_id_loc[]" value="' + dataRow.passing_id_loc + '">' +
                '<input type="hidden" name="passing_id_proj[]" value="' + dataRow.passing_id_proj + '">' +

                '</tr>';

                // Append the female row to the table
                tableBody.append(femaleRowHtml);

                sno++;

                }

                if (dataRowAct && maleRowAct && femaleRowAct) {
                    // Calculate monthly totals for male row
                    var maleTotalAct = (
                        parseFloat(maleRowAct.Jun_Male_value) +
                        parseFloat(maleRowAct.Jul_Male_value) +
                        parseFloat(maleRowAct.Aug_Male_value) +
                        parseFloat(maleRowAct.Sep_Male_value) +
                        parseFloat(maleRowAct.Oct_Male_value) +
                        parseFloat(maleRowAct.Nov_Male_value) +
                        parseFloat(maleRowAct.Dec_Male_value) +
                        parseFloat(maleRowAct.Jan_Male_value) +
                        parseFloat(maleRowAct.Feb_Male_value) +
                        parseFloat(maleRowAct.Mar_Male_value) +
                        parseFloat(maleRowAct.Apr_Male_value) +
                        parseFloat(maleRowAct.May_Male_value)
                        ).toFixed(2);

                    // Calculate monthly totals for female row
                    var femaleTotalAct = (
                        parseFloat(femaleRowAct.Jun_femalevalue) +
                        parseFloat(femaleRowAct.Jul_femalevalue) +
                        parseFloat(femaleRowAct.Aug_femalevalue) +
                        parseFloat(femaleRowAct.Sep_femalevalue) +
                        parseFloat(femaleRowAct.Oct_femalevalue) +
                        parseFloat(femaleRowAct.Nov_femalevalue) +
                        parseFloat(femaleRowAct.Dec_femalevalue) +
                        parseFloat(femaleRowAct.Jan_femalevalue) +
                        parseFloat(femaleRowAct.Feb_femalevalue) +
                        parseFloat(femaleRowAct.Mar_femalevalue) +
                        parseFloat(femaleRowAct.Apr_femalevalue) +
                        parseFloat(femaleRowAct.May_femalevalue)
                        ).toFixed(2);



                    var maleRowHtmlAct = '<tr class="male_details_actdataRowAct'+i+'">' +
                    '<td>' + sno + '</td>' +
                    '<td>' + dataRowAct.BreedingLocation + '</td>' +
                    '<td>' + dataRowAct.Project + '</td>' +
                    '<td>' + dataRowAct.Activity + '</td>' +
                    '<td>' + dataRowAct.Breedingtype + '</td>' +
                    '<td>' + dataRowAct.MaleAmount + '</td>' +
                    '<td>' + maleRowAct.gender + '</td>' +
                    '<td>' + maleRowAct.malecount + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Jun_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Jul_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Aug_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Sep_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Oct_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Nov_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Dec_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Jan_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Feb_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Mar_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.Apr_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((maleRowAct.May_Male_value)*(dataRowAct.MaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + ((maleTotalAct)*(dataRowAct.MaleAmount)) + '</td>' +
                    '<input type="hidden" name="passing_id[]" value="' + dataRowAct.passing_id + '">' +
                    '<input type="hidden" name="passing_id_loc[]" value="' + dataRowAct.passing_id_loc + '">' +
                    '<input type="hidden" name="passing_id_proj[]" value="' + dataRowAct.passing_id_proj + '">' +
                    '<input type="hidden" name="Activity_Id[]" value="' + dataRowAct.Act_Id + '">' +
                    '</tr>';

                    // Append the male row to the table
                    tableBody.append(maleRowHtmlAct);

                    sno++;
     
                    // Create a new row for female data
                    var femaleRowHtmlAct = '<tr class="female_details_act'+i+'">' +
                    '<td>' + sno + '</td>' +
                    '<td>' + dataRowAct.BreedingLocation + '</td>' +
                    '<td>' + dataRowAct.Project + '</td>' +
                    '<td>' + dataRowAct.Activity + '</td>' +
                    '<td>' + dataRowAct.Breedingtype + '</td>' +
                    '<td>' + dataRowAct.FemaleAmount + '</td>' +
                    '<td>' + femaleRowAct.gender + '</td>' +
                    '<td>' + femaleRowAct.femalecount + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Jun_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Jul_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Aug_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Sep_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Oct_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Nov_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Dec_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Jan_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Feb_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Mar_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.Apr_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + parseFloat((femaleRowAct.May_femalevalue)*(dataRowAct.FemaleAmount)).toFixed(2) + '</td>' +
                    '<td>' + ((femaleTotalAct)*(dataRowAct.FemaleAmount)) + '</td>' +
                    '<input type="hidden" name="passing_id[]" value="' + dataRowAct.passing_id + '">' +
                    '<input type="hidden" name="passing_id_loc[]" value="' + dataRowAct.passing_id_loc + '">' +
                    '<input type="hidden" name="passing_id_proj[]" value="' + dataRowAct.passing_id_proj + '">' +
                    '<input type="hidden" name="Activity_Id[]" value="' + dataRowAct.Act_Id + '">' +
                    '</tr>';

                    // Append the female row to the table
                    tableBody.append(femaleRowHtmlAct);

                    sno++;
                }
            }

            if ($.fn.DataTable.isDataTable('#viewReportTable')) {
                    $('#viewReportTable').DataTable().destroy();
                }

          var table = $('#viewReportTable').DataTable({
            pagingType: 'full_numbers',
            language: {
                emptyTable: 'No data to display.',
                zeroRecords: 'No records found!',
                thousands: ',',
                loadingRecords: 'Loading...',
                search: 'Search:',
                paginate: {
                    next: 'Next',
                    previous: 'Previous'
                }
            },
            scrollX: true,
            fixedColumns: {
                leftColumns: 2,
                heightMatch: 'auto'
            }
        });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });

}

$(document).on('click', '.nav-link.fieldTab', function() {
    var href = $(this).attr('href');

    if(href == '#manDaysCount')
    {
        //$('.dataTable').DataTable().destroy();
        getManCountDays();
    }
    else if(href == '#viewReport')
    {
         //$('.dataTableView').DataTable().destroy();
        getViewReport(); 
    }
    console.log(href)
});


// $.ajax({
//     url: 'Common_Ajax.php',
//     type: 'POST',
//     dataType: 'json',
//     data: { Action: 'getBreederDetails' },
//     success: function(res) {
//         //var tableData = res.data;

//         //console.log(res.data)


//         var htmlTable = $("#fieldExpensesData");
//         htmlTable.empty();

//          // Loop through the response data and append rows to the table
//         var sno=1;
//         for (var i = 0; i < res.data.length; i++) {
//             var row = '<tr>';

//             row += '<td>' + sno + '</td>';
//             row += '<td class="details-control" id="details-control' + sno + '" style="cursor: pointer;">' + (res.data[i].BreedingLocation || '') + '</td>';
//             row += '<td>' + (res.data[i].Project || '') + '</td>';
//             row += '<td>' + (res.data[i].BreedingActivity || '') + '</td>';
//             row += '<td>' + (res.data[i].Breedingtype || '') + '</td>';
//             row += '<td>' + (res.data[i].MaleAmount || '') + '</td>';
//             row += '<td>' + (res.data[i].FemaleAmount || '') + '</td>';
//                     // Adding hidden input fields with unique names to hold additional data
//             row += '<td class="View_Month_wise_popup_Completed" id="View_Month_wise_popup_Completed">';
//             row += '<button type="button" class="btn btn-xs btn-danger View_Month_wise_popup_Completed">View</button>';
//             row += '<input type="hidden" class="passing_id_loc" name="passing_id_loc[]" value="' + (res.data[i].passing_id_loc || '') + '">';
//             row += '<input type="hidden" class="passing_id_proj" name="passing_id_proj[]" value="' + (res.data[i].passing_id_proj || '') + '">';
//             row += '<input type="hidden" class="passing_id" name="passing_id[]" value="' + (res.data[i].passing_id || '') + '">';
//             row += '</td>';
//             row += '<td class="labour_rate_per_month"><button type="button" class="btn btn-danger labour_rate_per_month"> Labour Rate </button></td>';
//                     // row += '<td></td>';
//                     // row += '<td></td>';


//             row += '</tr>';
//             sno++;
//                    // console.log(row);
//             htmlTable.append(row);

//         }

//         // var table = $('.dataTable').DataTable({
//         //     pagingType: 'full_numbers',
//         //     language: {
//         //         emptyTable: 'No data to display.',
//         //         zeroRecords: 'No records found!',
//         //         thousands: ',',
//         //         loadingRecords: 'Loading...',
//         //         search: 'Search:',
//         //         paginate: {
//         //             next: 'Next',
//         //             previous: 'Previous'
//         //         }
//         //     }
//         // });

//         var table = $('.dataTable').DataTable({
//             pagingType: 'full_numbers',
//             language: {
//                 emptyTable: 'No data to display.',
//                 zeroRecords: 'No records found!',
//                 thousands: ',',
//                 loadingRecords: 'Loading...',
//                 search: 'Search:',
//                 paginate: {
//                     next: 'Next',
//                     previous: 'Previous'
//                 }
//             },
//             scrollX: true,
//             fixedColumns: {
//                 leftColumns: 2,
//                 heightMatch: 'auto'
//             }
//         });

    

//         $('.dataTable tbody').on('click', 'td.details-control', function () {
//             var tr = $(this).closest('tr'),
//             row = table.row(tr);

//             if (row.child.isShown()) {
//                 tr.next('tr').removeClass('details-row');
//                 row.child.hide();
//                 tr.removeClass('shown');
//             } else {
//         // Call format function to fetch and display the details
//                 format(row.data(), tr, row);
//             }
//         });

//         // Event handler for clicking the "View" button
//         $('.dataTable tbody').on('click', 'td.View_Month_wise_popup_Completed button', function () {
//     // Get the closest row associated with the clicked button
//             var row = $(this).closest('tr');

//             var rowData = table.row(row).data();
//     //console.log(rowData)

//     // Access specific column values from rowData
//             var breedingLocation = rowData[1]
//             var project = rowData[2];
//             var breedingActivity = rowData[3];
//             var breedingType = rowData[4];
//             var maleAmount = rowData[5];
//             var femaleAmount = rowData[6];
//     // Retrieve hidden input values within the closest row
//             var passing_id_loc = row.find('.passing_id_loc').val();
//             var passing_id_proj = row.find('.passing_id_proj').val();
//             var passing_id = row.find('.passing_id').val();
//             $('#myModal').modal('show');

//             var currentRequest = $.ajax({
//                 type: "POST",
//                 url: "ajax_popup_details_View.php",
//                 beforeSend: function() {
//                     var sdata = checkSession();
//                     if(sdata.status=='expired')
//                       currentRequest.abort();
//               },
//               data: {
//                 breedingLocation: breedingLocation,
//                 project: project,
//                 breedingActivity: breedingActivity,
//                 breedingType: breedingType,
//                 passing_id_loc: passing_id_loc,
//                 passing_id_proj: passing_id_proj,
//                 passing_id: passing_id,
//                 action_type: "monthwisedata_view"
//             },
//             success: function (output) {
//               var rowdata = JSON.parse(output);
//               $("#monthwisedetails").modal('show');
//               $(".Conformation-body").html(rowdata);

//   //$(".Total_acrage").val(passing_total_acrage);
//           }
//       });

//         });


// // Event handler for clicking the "View" button
//         $('.dataTable tbody').on('click', 'td.labour_rate_per_month button', function () {
//     // Get the closest row associated with the clicked button
//             var row = $(this).closest('tr');

//             var rowData = table.row(row).data();

//     // Access specific column values from rowData
//             var breedingLocation = rowData[1];
//             var project = rowData[2];
//             var breedingActivity = rowData[3];
//             var breedingType = rowData[4];
//             var maleAmount = rowData[5];
//             var femaleAmount = rowData[6];

//     // Retrieve hidden input values within the closest row
//             var passing_id_loc = row.find('.passing_id_loc').val();
//             var passing_id_proj = row.find('.passing_id_proj').val();
//             var passing_id = row.find('.passing_id').val();

//     // AJAX request to fetch data from server
//             $.ajax({
//                 type: "POST",
//                 url: "Common_Ajax.php",
//                 data: {
//                     breedingLocation: breedingLocation,
//                     project: project,
//                     breedingActivity: breedingActivity,
//                     breedingType: breedingType,
//                     passing_id_loc: passing_id_loc,
//                     passing_id_proj: passing_id_proj,
//                     passing_id: passing_id,
//                     Action: "AssumptionEnrty_malefemaleamount_completed_Div"
//                 },
//                 success: function(response) {
//           // Parse the JSON response into a JavaScript object
//                   var responseData = JSON.parse(response);

//           // Extract the 'data' array from the responseData object
//                   var dataArray = responseData.data;

//           // Check if 'dataArray' is an array and contains at least one element
//                   if (Array.isArray(dataArray) && dataArray.length > 0) {
//             // Get the first element (assuming there's only one)
//                     var dataEntry = dataArray[0];

//             // Extract properties from the 'dataEntry' object
//                     var location = dataEntry.Location;
//                     var fromMonth = dataEntry.Frommonth;
//                     var toMonth = dataEntry.Tomonth;
//                     var maleAmount = dataEntry.MaleAmount;
//             var femaleAmount = dataEntry.FemaleAmount; // Assuming 'FemaleAmount' exists

//             // Clear existing table rows
//             $('.Conformation-body-Div').empty();

//             // Construct HTML row with input fields
//             var htmlRow = '<tr>' +
//             '<td><input type="text" class="form-control location" value="' + location + '" readonly disabled></td>' +
//             '<td><input type="month"   class="form-control form-control-sm fontdesign"  name="Frommonth[]" value="' + fromMonth + '"></td>' +
//             '<td><input type="month"   class="form-control form-control-sm fontdesign"  name="tomonth[]" value="' + toMonth + '"></td>' +
//             '<td><input type="number"   class="form-control form-control-sm" name="maleamount[]" value="' + maleAmount + '"></td>' +
//             '<td><input type="number"   class="form-control form-control-sm" name="femaleamount[]" value="' + femaleAmount + '"></td>' +
//             '</tr>';

//             // Append the HTML row to the table body
//             $('.Conformation-body-Div').append(htmlRow);

//             // Show the modal after populating the table
//             $('#popupModal').modal('show');
//         } else {
//             console.error('Invalid or empty data array:', dataArray);
//             // Handle error: Display an error message or take appropriate action
//         }
//     },


//     error: function (xhr, status, error) {
//         console.log("Error: " + error);
//     }
// });
//         });


        
//     },
//     error: function(xhr, status, error) {
//         console.error("Error fetching data:", error);
//     }



// });



$(document).on("blur", ".monthinputbox", function() {
    if(isNaN($(this).val())) {
        $(this).val('');
    } else {
        var Total=0;
        var Total_1=parseFloat($(".jun_acrage").val(),10);
        if (isNaN(Total_1) ) {
            var Total_1=0;
        }
        var Total_2=parseFloat($(".jun_acrage_harvesting").val(),10);
        if (isNaN(Total_2) ) {
            var Total_2=0;
        }
        var amt=(Total_1)-(Total_2);
    //console.log('amt;'+amt);
        $(".jun_acrage_netsatanding").val(amt);





        var Total_jul_1=parseFloat($(".jul_acrage").val(),10);
        if (isNaN(Total_jul_1) ) {
            var Total_jul_1=0;
        }
        var Total_jul_2=parseFloat($(".jul_acrage_harvesting").val(),10);
        if (isNaN(Total_jul_2) ) {
            var Total_jul_2=0;
        }
        var amtjul=(amt+Total_jul_1)-(Total_jul_2);
    //console.log('jul;'+jul);
        $(".jul_acrage_netsatanding").val(amtjul);




        var Total_aug_1=parseFloat($(".aug_acrage").val(),10);
        if (isNaN(Total_aug_1) ) {
            var Total_aug_1=0;
        }
        var Total_aug_2=parseFloat($(".aug_acrage_harvesting").val(),10);
        if (isNaN(Total_aug_2) ) {
            var Total_aug_2=0;
        }
        var amtaug=(amtjul+Total_aug_1)-(Total_aug_2);
    //console.log('aug;'+aug);
        $(".aug_acrage_netsatanding").val(amtaug);



        var Total_sep_1=parseFloat($(".sep_acrage").val(),10);
        if (isNaN(Total_sep_1) ) {
            var Total_sep_1=0;
        }
        var Total_sep_2=parseFloat($(".sep_acrage_harvesting").val(),10);
        if (isNaN(Total_sep_2) ) {
            var Total_sep_2=0;
        }
        var amtsep=(amtaug+Total_sep_1)-(Total_sep_2);

        $(".sep_acrage_netsatanding").val(amtsep);


        var Total_oct_1=parseFloat($(".oct_acrage").val(),10);
        if (isNaN(Total_oct_1) ) {
            var Total_oct_1=0;
        }
        var Total_oct_2=parseFloat($(".oct_acrage_harvesting").val(),10);
        if (isNaN(Total_oct_2) ) {
            var Total_oct_2=0;
        }
        var amtoct=(amtsep+Total_oct_1)-(Total_oct_2);

        $(".oct_acrage_netsatanding").val(amtoct);


        var Total_nov_1=parseFloat($(".nov_acrage").val(),10);
        if (isNaN(Total_nov_1) ) {
            var Total_nov_1=0;
        }
        var Total_nov_2=parseFloat($(".nov_acrage_harvesting").val(),10);
        if (isNaN(Total_nov_2) ) {
            var Total_nov_2=0;
        }
        var amtnov=(amtoct+Total_nov_1)-(Total_nov_2);

        $(".nov_acrage_netsatanding").val(amtnov);


        var Total_dec_1=parseFloat($(".dec_acrage").val(),10);
        if (isNaN(Total_dec_1) ) {
            var Total_dec_1=0;
        }
        var Total_dec_2=parseFloat($(".dec_acrage_harvesting").val(),10);
        if (isNaN(Total_dec_2) ) {
            var Total_dec_2=0;
        }
        var amtdec=(amtnov+Total_dec_1)-(Total_dec_2);

        $(".dec_acrage_netsatanding").val(amtdec);


        var Total_jan_1=parseFloat($(".jan_acrage").val(),10);
        if (isNaN(Total_jan_1) ) {
            var Total_jan_1=0;
        }
        var Total_jan_2=parseFloat($(".jan_acrage_harvesting").val(),10);
        if (isNaN(Total_jan_2) ) {
            var Total_jan_2=0;
        }
        var amtjan=(amtdec+Total_jan_1)-(Total_jan_2);

        $(".jan_acrage_netsatanding").val(amtjan);


        var Total_feb_1=parseFloat($(".feb_acrage").val(),10);
        if (isNaN(Total_feb_1) ) {
            var Total_feb_1=0;
        }
        var Total_feb_2=parseFloat($(".feb_acrage_harvesting").val(),10);
        if (isNaN(Total_feb_2) ) {
            var Total_feb_2=0;
        }
        var amtfeb=(amtjan+Total_feb_1)-(Total_feb_2);

        $(".feb_acrage_netsatanding").val(amtfeb);




        var Total_mar_1=parseFloat($(".mar_acrage").val(),10);
        if (isNaN(Total_mar_1) ) {
            var Total_mar_1=0;
        }
        var Total_mar_2=parseFloat($(".mar_acrage_harvesting").val(),10);
        if (isNaN(Total_mar_2) ) {
            var Total_mar_2=0;
        }
        var amtmar=(amtfeb+Total_mar_1)-(Total_mar_2);

        $(".mar_acrage_netsatanding").val(amtmar);





        var Total_apr_1=parseFloat($(".apr_acrage").val(),10);
        if (isNaN(Total_apr_1) ) {
            var Total_apr_1=0;
        }
        var Total_apr_2=parseFloat($(".apr_acrage_harvesting").val(),10);
        if (isNaN(Total_apr_2) ) {
            var Total_apr_2=0;
        }
        var amtapr=(amtmar+Total_apr_1)-(Total_apr_2);

        $(".apr_acrage_netsatanding").val(amtapr);


        var Total_may_1=parseFloat($(".may_acrage").val(),10);
        if (isNaN(Total_may_1) ) {
            var Total_may_1=0;
        }
        var Total_may_2=parseFloat($(".may_acrage_harvesting").val(),10);
        if (isNaN(Total_may_2) ) {
            var Total_may_2=0;
        }
        var amtmay=(amtapr+Total_may_1)-(Total_may_2);

        $(".may_acrage_netsatanding").val(amtmay);

    }



});




$(document).on("keyup", ".validatetotalacr", function() {


  //alert("hai");
  validatevalue=$(this).val();

  //alert(validatevalue);

  var Total_acrage  =  $(this).parents('tr').find('.Total_acrage').val();

  var totWgt = 0;


  $(".validatetotalacr").each(function(index, el) {
    wgt =  parseFloat($(el).val(),10);


       // console.log(wgt[0].last()[0]);
    





    if(wgt!="" && !isNaN(wgt) && $(el).val()!="" && !isNaN($(el).val())){


        totWgt += wgt;

             // console.log(totWgt);



    }


});


//alert(totWgt);

  if(totWgt > Total_acrage)

  {

             // alert("Greater Than Total Acreage Value.Please Check");
      Alert_Msg("Greater Than Total Acreage Value.Please Check.","warning");
      $(this).val(0);
      // var exceed_col_class = $(this).attr('class').split(' ');
      // $('.'+exceed_col_class[0]+'_netsatanding').val(Total_acrage);
      $('.net_input').val(Total_acrage);
  }


});


$(document).on("click",".Savemonthvalue",function(){




 let Uset_Input=$(".monthwisedetails").serializeArray();

 Uset_Input.push({"name":"Action","value":"monthwisedetails"});

 $.ajax 
 ({
  type: "POST",
  url: "Common_Ajax.php",
  data:Uset_Input,
       async:false,//
       success: function(data){

         result=JSON.parse(data);

         if(result.Status == 1){


            Alert_Msg("Added Month Wise.","success");


            $(".close").trigger('click'); 


            var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            LocationwiseprojectDetails("yes",user_input);


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

$(document).on("click",".Editmonthvaue",function(){




 let Uset_Input=$(".monthwisedetails").serializeArray();

 Uset_Input.push({"name":"Action","value":"monthwisedetails_Edit"});

 $.ajax 
 ({
  type: "POST",
  url: "Common_Ajax.php",
  data:Uset_Input,
       async:false,//
       success: function(data){

         result=JSON.parse(data);

         if(result.Status == 1){


            Alert_Msg("Updated Month Wise.","success");


            $(".close").trigger('click'); 


            var Autoincnum=$(".Autonumloc").val();
            var  autoid=$(".Autonumid").val();
         // window.location.href ='VechicleRequest.php';
            var user_input={};


            user_input.Autoincnum=Autoincnum;
            user_input.autoid=autoid;

            LocationwiseprojectDetails("yes",user_input);


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

$(document).on("click",".finalsubmittioncompleted",function(){

   let Uset_Input=$(".assumptionwise_Amount_completed").serializeArray();



   var Location = $('.location').val();
   var maleCount = $('input[name="maleamount[]"]').val();
   var femaleCount = $('input[name="femaleamount[]"]').val();


    //Uset_Input.push({"name":"Action","value":"FinalsubmittionAssumption_Div",Location:Location,maleCount:maleCount,femaleCount:femaleCount});
     //console.log(Uset_Input)

   $.ajax 
   ({
      type: "POST",
      url: "Common_Ajax.php",
      data: {
        Location: Location,
        maleCount: maleCount,
        femaleCount: femaleCount,
        Action: "FinalsubmittionAssumption_Div"
    },
       async:false,//
       success: function(data){

           result=JSON.parse(data);

           if(result){
            Alert_Msg(result.Status);
            setTimeout(function() {
            // Redirect to 'Fieldexpensestest_Div.php' after 2 seconds (adjust delay as needed)
                window.location.href = 'Fieldexpensestest_Div.php';
        }, 2000); // Delay in milliseconds (e.g., 2000ms = 2 seconds)


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


$('#dt-example').on('click','.details-table tr',function(){
  $('.details-table').find('.adb-dtb-gchild:not(:first-child)').slideToggle();       
});

//dropdown style
setTimeout(function(){
  $('#dt-sel-year').select2({});
}, 2000);


var resData = null;

function getManCountDays() {

    $.ajax({
        url: 'Common_Ajax.php',
        type: 'POST',
        dataType: 'json',
        data: { Action: 'getBreederDetailsManCount' },
        success: function(res) {
           // console.log(res.male);

            resData = res;

            // Select the table body to populate
            var tableBody = $('#manDaysCountData');
            tableBody.empty();

            var sno = 1;

            // Iterate over the 'data' array
            for (var i = 0; i < res.data.length; i++) {
                var dataRow = res.data[i];
                var maleRow = res.male[i];
                var femaleRow = res.female[i];

                var dataRowAct = res.dataAct[i];
                var maleRowAct = res.maleAct[i];
                var femaleRowAct = res.femaleAct[i];

               // console.log(femaleRowAct)

                if (dataRow && maleRow && femaleRow) {
                    var maleRowHtml = '<tr class="male_details'+i+'">' +
                    '<td>' + sno + '</td>' +
                    '<td>' + dataRow.BreedingLocation + '</td>' +
                    '<td>' + dataRow.Project + '</td>' +
                    '<td>' + dataRow.BreedingActivity + '</td>' +
                    '<td>' + dataRow.Breedingtype + '</td>' +
                    '<td>' + maleRow.gender + '</td>' +
                    '<td>' + maleRow.malecount + '</td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Jun_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Jul_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Aug_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Sep_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Oct_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Nov_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Dec_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Jan_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Feb_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Mar_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.Apr_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRow.May_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><button class="btn btn-primary btn-sm updateCount" data-type="male" data-index="' + i + '">Edit</button></td>' +
                    '<input type="hidden" name="passing_id[]" value="' + dataRow.passing_id + '">' +
                    '<input type="hidden" name="passing_id_loc[]" value="' + dataRow.passing_id_loc + '">' +
                    '<input type="hidden" name="passing_id_proj[]" value="' + dataRow.passing_id_proj + '">' +
                    '</tr>';

                    // Append the male row to the table
                    tableBody.append(maleRowHtml);

                    sno++;


                     // Create a new row for female data
                var femaleRowHtml = '<tr class="female_details'+i+'">' +
                '<td>' + sno + '</td>' +
                '<td>' + dataRow.BreedingLocation + '</td>' +
                '<td>' + dataRow.Project + '</td>' +
                '<td>' + dataRow.BreedingActivity + '</td>' +
                '<td>' + dataRow.Breedingtype + '</td>' +
                '<td>' + femaleRow.gender + '</td>' +
                '<td>' + femaleRow.femalecount + '</td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Jun_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Jul_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Aug_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Sep_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Oct_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Nov_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Dec_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Jan_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Feb_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Mar_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.Apr_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRow.May_femalevalue).toFixed(2) + '" disabled></td>' +
                '<td><button class="btn btn-primary btn-sm updateCount" data-type="female" data-index="' + i + '">Edit</button></td>' +
                '<input type="hidden" name="passing_id[]" value="' + dataRow.passing_id + '">' +
                '<input type="hidden" name="passing_id_loc[]" value="' + dataRow.passing_id_loc + '">' +
                '<input type="hidden" name="passing_id_proj[]" value="' + dataRow.passing_id_proj + '">' +

                '</tr>';

                // Append the female row to the table
                tableBody.append(femaleRowHtml);

                sno++;
                }


                if (dataRowAct && maleRowAct && femaleRowAct) {
                    var maleRowHtmlAct = '<tr class="male_details_act'+i+'">' +
                    '<td>' + sno + '</td>' +
                    '<td>' + dataRowAct.BreedingLocation + '</td>' +
                    '<td>' + dataRowAct.Project + '</td>' +
                    '<td>' + dataRowAct.Activity + '</td>' +
                    '<td>' + dataRowAct.Breedingtype + '</td>' +
                    '<td>' + maleRowAct.gender + '</td>' +
                    '<td>' + maleRowAct.malecount + '</td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Jun_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Jul_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Aug_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Sep_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Oct_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Nov_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Dec_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Jan_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Feb_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Mar_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.Apr_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(maleRowAct.May_Male_value).toFixed(2) + '" disabled></td>' +
                    '<td><button class="btn btn-primary btn-sm updateCount" data-typeact="male" data-indexact="' + i + '">Edit</button></td>' +
                    '<input type="hidden" name="passing_id[]" value="' + dataRowAct.passing_id + '">' +
                    '<input type="hidden" name="passing_id_loc[]" value="' + dataRowAct.passing_id_loc + '">' +
                    '<input type="hidden" name="passing_id_proj[]" value="' + dataRowAct.passing_id_proj + '">' +
                    '<input type="hidden" name="Activity_Id[]" value="' + dataRowAct.Act_Id + '">' +
                    '</tr>';

                    // Append the male row to the table
                    tableBody.append(maleRowHtmlAct);

                    sno++;

                    // Create a new row for female data
                    var femaleRowHtmlAct = '<tr class="female_details_act'+i+'">' +
                    '<td>' + sno + '</td>' +
                    '<td>' + dataRowAct.BreedingLocation + '</td>' +
                    '<td>' + dataRowAct.Project + '</td>' +
                    '<td>' + dataRowAct.Activity + '</td>' +
                    '<td>' + dataRowAct.Breedingtype + '</td>' +
                    '<td>' + femaleRowAct.gender + '</td>' +
                    '<td>' + femaleRowAct.femalecount + '</td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Jun_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Jul_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Aug_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Sep_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Oct_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Nov_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Dec_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Jan_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Feb_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Mar_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.Apr_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><input type="text" class="input_no_border" style="width:46px;" value="' + parseFloat(femaleRowAct.May_femalevalue).toFixed(2) + '" disabled></td>' +
                    '<td><button class="btn btn-primary btn-sm updateCount" data-typeact="female" data-indexact="' + i + '">Edit</button></td>' +
                    '<input type="hidden" name="passing_id[]" value="' + dataRowAct.passing_id + '">' +
                    '<input type="hidden" name="passing_id_loc[]" value="' + dataRowAct.passing_id_loc + '">' +
                    '<input type="hidden" name="passing_id_proj[]" value="' + dataRowAct.passing_id_proj + '">' +
                    '<input type="hidden" name="Activity_Id[]" value="' + dataRowAct.Act_Id + '">' +

                    '</tr>';

                    // Append the female row to the table
                    tableBody.append(femaleRowHtmlAct);

                    sno++;
                }
            }
 
            if ($.fn.DataTable.isDataTable('#manDaysCountTable')) {
                    $('#manDaysCountTable').DataTable().destroy();
                }

          var table1 = $('#manDaysCountTable').DataTable({
            pagingType: 'full_numbers',
            language: {
                emptyTable: 'No data to display.',
                zeroRecords: 'No records found!',
                thousands: ',',
                loadingRecords: 'Loading...',
                search: 'Search:',
                paginate: {
                    next: 'Next',
                    previous: 'Previous'
                }
            },
            scrollX: true,
            fixedColumns: {
                leftColumns: 2,
                heightMatch: 'auto'
            }
        });

        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

// Click event handler for updateCount buttons
$(document).on('click', '.updateCount', function() {
    // Ensure that resData is defined and contains the response data
    if (!resData) {
        console.error('Response data is not available.');
        return;
    }

    var type = $(this).data('type');
    var dataIndex = $(this).data('index');
    var dataDet = resData.data[dataIndex];
    var dataRow = (type === 'male') ? resData.male[dataIndex] : resData.female[dataIndex];
    var requestData='';
    var trName='';


     var typeAct = $(this).data('typeact');
    var dataIndexAct = $(this).data('indexact');
    var dataDetAct = resData.dataAct[dataIndexAct];
    var dataRowAct = (typeAct === 'male') ? resData.maleAct[dataIndexAct] : resData.femaleAct[dataIndexAct];
    var requestData='';
    var trName='';

    console.log(type,typeAct)


    if(type != undefined || type != null)
        {
            //alert('Divya')
            if(type === 'male')
            {
                trName='.male_details'+dataIndex;
                requestData = {
                    Action: 'InsertManCountTableData',
                    Location: dataDet.BreedingLocation,
                    Project: dataDet.Project,
                    Activity: dataDet.BreedingActivity,
                    Type: dataDet.Breedingtype,
                    passing_id: dataDet.passing_id,
                    passing_id_loc: dataDet.passing_id_loc,
                    passing_id_proj: dataDet.passing_id_proj,
                    Gender: dataRow.gender,
                    Count: dataRow.malecount,
                    Jun: dataRow.Jun_Male_value,
                    Jul: dataRow.Jul_Male_value,
                    Aug: dataRow.Aug_Male_value,
                    Sep: dataRow.Sep_Male_value,
                    Oct: dataRow.Oct_Male_value,
                    Nov: dataRow.Nov_Male_value,
                    Dec: dataRow.Dec_Male_value,
                    Jan: dataRow.Jan_Male_value,
                    Feb: dataRow.Feb_Male_value,
                    Mar: dataRow.Mar_Male_value,
                    Apr: dataRow.Apr_Male_value,
                    May: dataRow.May_Male_value,
                };
            }else
            {
                trName='.female_details'+dataIndex;
                requestData = {
                    Action: 'InsertManCountTableData',
                    Location: dataDet.BreedingLocation,
                    Project: dataDet.Project,
                    Activity: dataDet.BreedingActivity,
                    Type: dataDet.Breedingtype,
                    passing_id: dataDet.passing_id,
                    passing_id_loc: dataDet.passing_id_loc,
                    passing_id_proj: dataDet.passing_id_proj,
                    Gender: dataRow.gender,
                    Count: dataRow.femalecount,
                    Jun: dataRow.Jun_femalevalue,
                    Jul: dataRow.Jul_femalevalue,
                    Aug: dataRow.Aug_femalevalue,
                    Sep: dataRow.Sep_femalevalue,
                    Oct: dataRow.Oct_femalevalue,
                    Nov: dataRow.Nov_femalevalue,
                    Dec: dataRow.Dec_femalevalue,
                    Jan: dataRow.Jan_femalevalue,
                    Feb: dataRow.Feb_femalevalue,
                    Mar: dataRow.Mar_femalevalue,
                    Apr: dataRow.Apr_femalevalue,
                    May: dataRow.May_femalevalue,
                };
            }
        }
        else if(typeAct != undefined || typeAct != null)
        {
            if(typeAct === 'male')
            {
                trName='.male_details_act'+dataIndexAct;
                requestData = {
                    Action: 'InsertManCountTableData',
                    Location: dataDetAct.BreedingLocation,
                    Project: dataDetAct.Project,
                    Activity: dataDetAct.Activity,
                    Type: dataDetAct.Breedingtype,
                    passing_id: dataDetAct.passing_id,
                    passing_id_loc: dataDetAct.passing_id_loc,
                    passing_id_proj: dataDetAct.passing_id_proj,
                    Activity_Id: dataDetAct.Act_Id,
                    Gender: dataRowAct.gender,
                    Count: dataRowAct.malecount,
                    Jun: dataRowAct.Jun_Male_value,
                    Jul: dataRowAct.Jul_Male_value,
                    Aug: dataRowAct.Aug_Male_value,
                    Sep: dataRowAct.Sep_Male_value,
                    Oct: dataRowAct.Oct_Male_value,
                    Nov: dataRowAct.Nov_Male_value,
                    Dec: dataRowAct.Dec_Male_value,
                    Jan: dataRowAct.Jan_Male_value,
                    Feb: dataRowAct.Feb_Male_value,
                    Mar: dataRowAct.Mar_Male_value,
                    Apr: dataRowAct.Apr_Male_value,
                    May: dataRowAct.May_Male_value,
                };
            }else
            {
                trName='.female_details_act'+dataIndexAct;
                requestData = {
                    Action: 'InsertManCountTableData',
                    Location: dataDetAct.BreedingLocation,
                    Project: dataDetAct.Project,
                    Activity: dataDetAct.BreedingActivity,
                    Type: dataDetAct.Breedingtype,
                    passing_id: dataDetAct.passing_id,
                    passing_id_loc: dataDetAct.passing_id_loc,
                    passing_id_proj: dataDetAct.passing_id_proj,
                    Activity_Id: dataDetAct.Act_Id,
                    Gender: dataRowAct.gender,
                    Count: dataRowAct.femalecount,
                    Jun: dataRowAct.Jun_femalevalue,
                    Jul: dataRowAct.Jul_femalevalue,
                    Aug: dataRowAct.Aug_femalevalue,
                    Sep: dataRowAct.Sep_femalevalue,
                    Oct: dataRowAct.Oct_femalevalue,
                    Nov: dataRowAct.Nov_femalevalue,
                    Dec: dataRowAct.Dec_femalevalue,
                    Jan: dataRowAct.Jan_femalevalue,
                    Feb: dataRowAct.Feb_femalevalue,
                    Mar: dataRowAct.Mar_femalevalue,
                    Apr: dataRowAct.Apr_femalevalue,
                    May: dataRowAct.May_femalevalue,
                };
            }
        }

    //console.log(requestData);

    // Perform AJAX POST request to update the count
    $.ajax({
        url: 'Common_Ajax.php',
        type: 'POST',
        dataType: 'json',
        data: requestData,
        success: function(response) {
            // Handle success response (e.g., show alert)
             //Alert_Msg(response.Status);

           $(trName).find('.updateCount').text('Update').removeClass('updateCount').addClass('saveManCount');
       },
       error: function(xhr, status, error) {
        console.error('Error:', error);
        alert('Failed to Insert count details!');
    }
});

    var inputs = $(trName).closest('tr').find('input[type="text"]');
    inputs.prop('disabled', false)
});

$(document).on('click', '.saveManCount', function() {
    // Retrieve the parent table row of the clicked button
    var tableRow = $(this).closest('tr');

    // Retrieve the updated values from input fields within this table row
    var location = tableRow.find('td:eq(1)').text();
    var project = tableRow.find('td:eq(2)').text();
    var activity = tableRow.find('td:eq(3)').text();
    var type = tableRow.find('td:eq(4)').text();
    var passing_id = tableRow.find('input[name="passing_id[]"]').val();
    var passing_id_loc = tableRow.find('input[name="passing_id_loc[]"]').val();
    var passing_id_proj = tableRow.find('input[name="passing_id_proj[]"]').val();
    var Activity_Id = tableRow.find('input[name="Activity_Id[]"]').val();
    var gender = tableRow.find('td:eq(5)').text();
    var count = tableRow.find('td:eq(6)').text();
    
    var Jun = tableRow.find('input:eq(0)').val();
    var Jul = tableRow.find('input:eq(1)').val();
    var Aug = tableRow.find('input:eq(2)').val();
    var Sep = tableRow.find('input:eq(3)').val();
    var Oct = tableRow.find('input:eq(4)').val();
    var Nov = tableRow.find('input:eq(5)').val();
    var Dec = tableRow.find('input:eq(6)').val();
    var Jan = tableRow.find('input:eq(7)').val();
    var Feb = tableRow.find('input:eq(8)').val();
    var Mar = tableRow.find('input:eq(9)').val();
    var Apr = tableRow.find('input:eq(10)').val();
    var May = tableRow.find('input:eq(11)').val();

    var requestData='';

    // Prepare the request data for updating
    if(Activity_Id!=null || Activity_Id!=undefined || Activity_Id!='')
    {
        requestData = {
        Action: 'UpdateManCountTableData',
        Location: location,
        Project: project,
        Activity: activity,
        Type: type,
        passing_id: passing_id,
        passing_id_loc: passing_id_loc,
        passing_id_proj: passing_id_proj,
        Activity_Id: Activity_Id,
        Gender: gender,
        Count: count,
        Jun: Jun,
        Jul: Jul,
        Aug: Aug,
        Sep: Sep,
        Oct: Oct,
        Nov: Nov,
        Dec: Dec,
        Jan: Jan,
        Feb: Feb,
        Mar: Mar,
        Apr: Apr,
        May: May,
    };
    }
    else
    {
        requestData = {
        Action: 'UpdateManCountTableData',
        Location: location,
        Project: project,
        Activity: activity,
        Type: type,
        passing_id: passing_id,
        passing_id_loc: passing_id_loc,
        passing_id_proj: passing_id_proj,
        Gender: gender,
        Count: count,
        Jun: Jun,
        Jul: Jul,
        Aug: Aug,
        Sep: Sep,
        Oct: Oct,
        Nov: Nov,
        Dec: Dec,
        Jan: Jan,
        Feb: Feb,
        Mar: Mar,
        Apr: Apr,
        May: May,
    };
    }


    // Perform AJAX POST request to update the count
    $.ajax({
        url: 'Common_Ajax.php',
        type: 'POST',
        dataType: 'json',
        data: requestData,
        success: function(response) {
            Alert_Msg(response.Status);

            // Reload the page after a delay (2 seconds in this example)
            setTimeout(function() {
                window.location.href = 'Fieldexpensestest_Div.php';
            }, 2000);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Failed to update count!');
        }
    });
});

});




// function getManCountDays()
// {
//     //console.log('entered')
//      $.ajax({
//     url: 'Common_Ajax.php',
//     type: 'POST',
//     dataType: 'json',
//     data: { Action: 'getBreederDetailsManCount' },
//     success: function(res) {
//         //var tableData = res.data;

//         console.log(res)


//         // var htmlTable = $("#manDaysCountData");
//         // htmlTable.empty();

//         //  // Loop through the response data and append rows to the table
//         // var sno=1;
//         // for (var i = 0; i < res.data.length; i++) {
//         //     var row = '<tr>';

//         //             row += '<td>' + sno + '</td>';
//         //             row += '<td class="details-control" id="details-control' + sno + '" style="cursor: pointer;">' + (res.data[i].location || '') + '</td>';
//         //             row += '<td>' + (res.data[i].Project || '') + '</td>';
//         //             row += '<td>' + (res.data[i].BreedingActivity || '') + '</td>';
//         //             row += '<td>' + (res.data[i].Breedingtype || '') + '</td>';
//         //             row += '<td>' + (res.data[i].MaleAmount || '') + '</td>';
//         //             row += '<td>' + (res.data[i].FemaleAmount || '') + '</td>';
//         //             // Adding hidden input fields with unique names to hold additional data
//         //             row += '<td class="View_Month_wise_popup_Completed" id="View_Month_wise_popup_Completed">';
//         //             row += '<button type="button" class="btn btn-xs btn-danger View_Month_wise_popup_Completed">View</button>';
//         //             row += '<input type="hidden" class="passing_id_loc" name="passing_id_loc[]" value="' + (res.data[i].passing_id_loc || '') + '">';
//         //             row += '<input type="hidden" class="passing_id_proj" name="passing_id_proj[]" value="' + (res.data[i].passing_id_proj || '') + '">';
//         //             row += '<input type="hidden" class="passing_id" name="passing_id[]" value="' + (res.data[i].passing_id || '') + '">';
//         //             row += '</td>';
//         //             row += '<td class="labour_rate_per_month"><button type="button" class="btn btn-danger labour_rate_per_month"> LbRtPrMnth </button></td>';
//         //             // row += '<td></td>';
//         //             // row += '<td></td>';


//         //             row += '</tr>';
//         //             sno++;
//         //            // console.log(row);
//         //             htmlTable.append(row);

//         //         }
//             }
//         });
// }


// var table = $('.dataTable').DataTable({
//             // Column definitions
//             columns: [  
//                 { data: null, className: "snos", render: function (data, type, row, meta) { return meta.row + 1; }},    
//                 { data: 'BreedingLocation', className: 'details-control' },
//                 { data: 'Project' },
//                 { data: 'BreedingActivity' },
//                 { data: '' },
//                 { data: '' },
//                 { data: '' },
//                 { data: '' },
//                 { data: '' },
//                 { data: '' }
//             ],
//             data: tableData,
//             pagingType: 'full_numbers',
//             // Localization
//             language: {
//                 emptyTable: 'No data to display.',
//                 zeroRecords: 'No records found!',
//                 thousands: ',',
//                 loadingRecords: 'Loading...',
//                 search: 'Search:',
//                 paginate: {
//                     next: 'Next',
//                     previous: 'Previous'
//                 }
//             }
//         });




</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script> 
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js"></script>-->


   <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script> 

    </body>
</html>



