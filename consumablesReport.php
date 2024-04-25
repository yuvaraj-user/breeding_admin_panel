


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


#manDaysCountTable td{
   /* font-size: 12px;
    padding: 0;
    line-height: 2em;*/

    padding-left: 17px;
}



.input_no_border {
    width: 46px;
    border: none;
    outline: none;
    background-color: transparent;
    text-align: center;
}

/*#viewReportTable {
    overflow-x: scroll;
    max-width: 40%;
    display: block;
    white-space: nowrap;
}*/

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
                                    <h6 style="text-align: center;color: blue;">Consumables Report</h6>

                                    <table id="viewReportTable" class="table table-bordered table-striped table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">Sno</th>
                                                <th style="text-align:center">Location</th>
                                                <th style="text-align:center">Project</th>
                                                <th style="text-align:center">Consumables</th>
                                                <th style="text-align:center">ConsumablesAcre</th>
                                                <th style="text-align:center">UOM</th>
                                                <th style="text-align:center">TotalAcre</th>
                                                <th style="text-align:center">Total</th>
                                                <th style="text-align:center">Jun</th>
                                                <th style="text-align:center">Jul</th>
                                                <th style="text-align:center">Aug</th>
                                                <th style="text-align:center">Sep</th>
                                                <th style="text-align:center">Oct</th>
                                                <th style="text-align:center">Nov</th>
                                                <th style="text-align:center">Dec</th>
                                                <th style="text-align:center">Jan</th>
                                                <th style="text-align:center">Feb</th>
                                                <th style="text-align:center">Mar</th>
                                                <th style="text-align:center">Apr</th>
                                                <th style="text-align:center">May</th>
                                                <th style="text-align:center">Total</th>
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
            getComsumablesReport();
// //alert("hai");
//     $(".dataTable").on("draw.dt", function (e) {
//           //console.log("drawing");
//       setCustomPagingSigns.call($(this));
//   }).each(function () {
//           setCustomPagingSigns.call($(this)); // initialize
//       });
//   function setCustomPagingSigns() {
//       var wrapper = this.parent();
//       wrapper.find("a.previous").text("<");
//       wrapper.find("a.next").text(">");
//   }



        });

          function getComsumablesReport()
          {

   // alert("hai");
              $.ajax({
                url: 'Common_Ajax.php',
                type: 'POST',
                dataType: 'json',
                data: { Action: 'getConsumablesReport'},
                success: function(res) {

            // Select the table body to populate
                    var tableBody = $('#viewReportData');
                    tableBody.empty();


                    var sno = 1;

            // Iterate over the 'data' array
                    for (var i = 0; i < res.data.length; i++) {
                        var dataRow = res.data[i];

                //console.log(res.data)

                        var acre = parseFloat(dataRow.acre);
                        var uom = parseFloat(dataRow.UOM);
                        var totalAcreage = parseFloat(dataRow.totalacreage);

                        var calculatedValue = 0;

                        if (!isNaN(acre) && !isNaN(uom) && !isNaN(totalAcreage)) {
                            calculatedValue = acre * uom * totalAcreage;
                        }

                        var acreValue = dataRow.acre ? parseFloat(dataRow.acre) : 0;
                        var uomValue = dataRow.UOM ? parseFloat(dataRow.UOM) : 0;
                        var totAcr = dataRow.totalacreage ? parseFloat(dataRow.totalacreage) : 0;

                        var consumeRowHtml = '<tr class="consume_details'+i+'">' +
                        '<td style="text-align:center">' + sno + '</td>' +
                        '<td style="text-align:center">' + dataRow.ConsumLocation + '</td>' +
                        '<td style="text-align:center">' + dataRow.ConsumProject + '</td>' +
                        '<td style="text-align:center">' + dataRow.Breedingconsumables + '</td>' +
                        '<td style="text-align:center">' + acreValue + '</td>' +
                        '<td style="text-align:center">' + uomValue + '</td>' +
                        '<td style="text-align:center">' + totAcr + '</td>' +
                        '<td style="text-align:center">' + parseFloat(calculatedValue).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Jun_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Jul_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Aug_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Sep_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Oct_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Nov_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Dec_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Jan_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Feb_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Mar_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.Apr_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + parseFloat(dataRow.May_Consume_value).toFixed(2) + '</td>' +
                        '<td style="text-align:center">' + 0 + '</td>' +
                        '</tr>';

                    // Append the male row to the table
                        tableBody.append(consumeRowHtml);

                        sno++;
                    }
                    datatable_call();
                }
            });  

          }

          function datatable_call()
          {
            $('.dataTable').DataTable({
                "dom": 'Bfrtip',
                "scrollX": true,
                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
                "autoWidth": true
            });
        }


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



