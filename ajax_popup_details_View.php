<?php 

include '../../../auto_load.php';
//include 'Send_Mail.php';
$action_type = $_REQUEST['action_type'];

?>

<?php 



if($action_type == 'monthwisedata' && isset($_REQUEST['passing_id']) && $_REQUEST['passing_id'] != '' ){  
 $passing_id = $_REQUEST['passing_id'];
 $passing_id_loc = $_REQUEST['passing_id_loc'];
 $passing_id_proj = $_REQUEST['passing_id_proj'];



 $view_part_adv = sqlsrv_query($conn,"Select TOTALROW = count(*) OVER(), Breedingtype,BreedingAdmin_project.Docid,BreedingAdmin_project.Ordernum,Breedinglocation,Project,BreedingAdmin_Type.id As passing_id,BreedingAdmin_location.id ,BreedingAdmin_project.id  from BreedingAdmin_Type

  Inner Join (Select * from BreedingAdmin_location Where BreedingAdmin_location.id='$passing_id_loc')BreedingAdmin_location On BreedingAdmin_location.Docid=BreedingAdmin_Type.id
  Inner Join (Select * from BreedingAdmin_project Where BreedingAdmin_project.id='$passing_id_loc') BreedingAdmin_project On BreedingAdmin_project.Docid=BreedingAdmin_Type.id AND BreedingAdmin_project.ordernum=BreedingAdmin_location.ordernum


  Where 1=1 
  AND BreedingAdmin_Type.CreatedBy  IN ('".$_SESSION['EmpID']."') and BreedingAdmin_Type.Currentstatus='1' AND BreedingAdmin_Type.id='$passing_id'  Order by BreedingAdmin_location.Id DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY");

 


 $fetch_adv_det = sqlsrv_fetch_array($view_part_adv);
 $Breedingtype     = $fetch_adv_det['Breedingtype'];
 $Project     = $fetch_adv_det['Project'];
 $location     = $fetch_adv_det['Breedinglocation'];
 $Main_id     = $fetch_adv_det['passing_id'];




 $sno=0;

 $reqdet = "<div class='row pop-req'>
 <div class='col-md-4 py-7' style='text-align: center;'> <span > Location : </span>$location   </div>
 <div class='col-md-5 py-7' style='text-align: center;'> <span> Project : </span> $Project </div>
 <div class='col-md-3 py-7' style='text-align: center;'> <span> Type : </span> $Breedingtype  </div>

 </div><div><br></div>";

 $reqdet.="<div style='overflow-x:auto'><table class='table table-bordered table  table-hover' cellspacing='0' width='100%'  >";

 $reqdet.="

 <thead>

 <tr>

 <td colspan='4' valign='bottom'>
 Year
 </td>


 <td colspan='4' valign='bottom'>
 Standing Acreage
 </td>

 <td colspan='4' valign='bottom'>
 JUN
 </td>

 <td colspan='4' valign='bottom'>
 JUL
 </td>

 <td colspan='4' valign='bottom'>
 AUG
 </td>


 <td colspan='4' valign='bottom'>
 SEP
 </td>

 <td colspan='4' valign='bottom'>
 OCT
 </td>

 <td colspan='4' valign='bottom'>
 NOV
 </td>

 <td colspan='4' valign='bottom'>
 DEC
 </td>

 <td colspan='4' valign='bottom'>
 JAN
 </td>

 <td colspan='4' valign='bottom'>
 FEB
 </td>

 <td colspan='4' valign='bottom'>
 MAR
 </td>

 <td colspan='4' valign='bottom'>
 APR
 </td>

 <td colspan='4' valign='bottom'>
 MAY
 </td>

 <td colspan='4' valign='bottom'>
 Total Acreage
 </td>







 </tr>

 </thead>";



 $reqdet.="

 <tbody>

 <tr>

 <td colspan='4' valign='bottom'>
 Sowing
 <input type='hidden' class='Sowing' name='typeofbreeding[]' value='Sowing' style='width:60px'>
 <input type='hidden' name='passing_id_loc[]' value='".$passing_id_loc."'><input type='hidden' name='passing_id_proj[]' value='".$passing_id_proj."'><input type='hidden' name='passing_id[]' value='".$passing_id."'><input type='hidden' name='decreased_harvest_count' value='0'>
 </td>

  <td colspan='4' valign='bottom'>
 <input type='text' class='stand_acrage monthinputbox validatetotalacr' name='stand_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jun_acrage monthinputbox validatetotalacr' name='jun_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jul_acrage monthinputbox validatetotalacr' name='jul_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='aug_acrage monthinputbox validatetotalacr' name='aug_acrage[]'  style='width:60px'>
 </td>


 <td colspan='4' valign='bottom'>
 <input type='text' class='sep_acrage monthinputbox validatetotalacr' name='sep_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='oct_acrage monthinputbox validatetotalacr' name='oct_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='nov_acrage monthinputbox validatetotalacr' name='nov_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='dec_acrage monthinputbox validatetotalacr' name='dec_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jan_acrage monthinputbox validatetotalacr' name='jan_acrage[]' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='feb_acrage monthinputbox validatetotalacr' name='feb_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='mar_acrage monthinputbox validatetotalacr' name='mar_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='apr_acrage monthinputbox validatetotalacr' name='apr_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='may_acrage monthinputbox validatetotalacr' name='may_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='Total_acrage monthinputbox ' name='Total_acrage[]'  style='width:60px'>
 </td>









 </tr>


 <tr>

 <td colspan='4' valign='bottom'>
 Harvesting
 <input type='hidden' class='Harvesting' name='typeofbreeding[]' value='Harvesting' style='width:60px'>
 <input type='hidden' name='passing_id_loc[]' value='".$passing_id_loc."'><input type='hidden' name='passing_id_proj[]' value='".$passing_id_proj."'><input type='hidden' name='passing_id[]' value='".$passing_id."'><input type='hidden' class='decreased_harvest_count' value='0'>
 </td>

  <td colspan='4' valign='bottom'>
 <input type='text' class='stand_acrage_harvesting monthinputbox Harvesting' data-input='stand' name='stand_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jun_acrage_harvesting monthinputbox Harvesting' data-input='jun' name='jun_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jul_acrage_harvesting monthinputbox Harvesting' data-input='jul' name='jul_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='aug_acrage_harvesting monthinputbox Harvesting' data-input='aug' name='aug_acrage[]'  style='width:60px'>
 </td>


 <td colspan='4' valign='bottom'>
 <input type='text' class='sep_acrage_harvesting monthinputbox Harvesting' data-input='sep' name='sep_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='oct_acrage_harvesting monthinputbox Harvesting' data-input='oct' name='oct_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='nov_acrage_harvesting monthinputbox Harvesting' data-input='nov' name='nov_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='dec_acrage_harvesting monthinputbox Harvesting' data-input='dec' name='dec_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jan_acrage_harvesting monthinputbox Harvesting' data-input='jan' name='jan_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='feb_acrage_harvesting monthinputbox Harvesting' data-input='feb' name='feb_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='mar_acrage_harvesting monthinputbox Harvesting' data-input='mar' name='mar_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='apr_acrage_harvesting monthinputbox Harvesting' data-input='apr' name='apr_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='may_acrage_harvesting monthinputbox Harvesting' data-input='may' name='may_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='Total_acrage_harvesting monthinputbox Harvesting'name='Total_acrage[]'  style='width:60px'>
 </td>









 </tr>


 <tr>

 <td colspan='4' valign='bottom'>
 Net Standing
 <input type='hidden' class='Harvesting' name='typeofbreeding[]' value='netsatanding' style='width:60px'>
 <input type='hidden' name='passing_id_loc[]' value='".$passing_id_loc."'><input type='hidden' name='passing_id_proj[]' value='".$passing_id_proj."'><input type='hidden' name='passing_id[]' value='".$passing_id."'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='stand_acrage_netsatanding monthinputbox' name='stand_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jun_acrage_netsatanding monthinputbox net_input' name='jun_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jul_acrage_netsatanding monthinputbox net_input' name='jul_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='aug_acrage_netsatanding monthinputbox net_input' name='aug_acrage[]'  style='width:60px'>
 </td>


 <td colspan='4' valign='bottom'>
 <input type='text' class='sep_acrage_netsatanding monthinputbox net_input' name='sep_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='oct_acrage_netsatanding monthinputbox net_input' name='oct_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='nov_acrage_netsatanding monthinputbox net_input' name='nov_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='dec_acrage_netsatanding monthinputbox net_input' name='dec_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jan_acrage_netsatanding monthinputbox net_input' name='jan_acrage[]' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='feb_acrage_netsatanding monthinputbox net_input' name='feb_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='mar_acrage_netsatanding monthinputbox net_input' name='mar_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='apr_acrage_netsatanding monthinputbox net_input' name='apr_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='may_acrage_netsatanding monthinputbox net_input' name='may_acrage[]'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='Total_acrage_netsatanding monthinputbox' name='Total_acrage[]'  style='width:60px'>
 </td>









 </tr>

 </tbody>";






 $reqdet.="</table></div>
 <div class='modal-footer'>


 <button type='button'  class='btn  btn-success Savemonthvalue' >SAVE</button>
 <button type='button' class='btn btn-default close' data-dismiss='modal'>Close</button>

 </div>";







 echo json_encode($reqdet);
} 



if($action_type == 'monthwisedata_view' && isset($_REQUEST['passing_id']) && $_REQUEST['passing_id'] != '' ){  
 $passing_id = $_REQUEST['passing_id'];
 $passing_id_loc = $_REQUEST['passing_id_loc'];
 $passing_id_proj = $_REQUEST['passing_id_proj'];



 $view_part_adv = sqlsrv_query($conn,"Select TOTALROW = count(*) OVER(), Breedingtype,BreedingAdmin_project.Docid,BreedingAdmin_project.Ordernum,Breedinglocation,Project,BreedingAdmin_Type.id As passing_id,BreedingAdmin_location.id ,BreedingAdmin_project.id  from BreedingAdmin_Type

  Inner Join (Select * from BreedingAdmin_location Where BreedingAdmin_location.id='$passing_id_loc')BreedingAdmin_location On BreedingAdmin_location.Docid=BreedingAdmin_Type.id
  Inner Join (Select * from BreedingAdmin_project Where BreedingAdmin_project.id='$passing_id_loc') BreedingAdmin_project On BreedingAdmin_project.Docid=BreedingAdmin_Type.id AND BreedingAdmin_project.ordernum=BreedingAdmin_location.ordernum


  Where 1=1 
  AND BreedingAdmin_Type.CreatedBy  IN ('".$_SESSION['EmpID']."') and BreedingAdmin_Type.Currentstatus='1' AND BreedingAdmin_Type.id='$passing_id'  Order by BreedingAdmin_location.Id DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY");

 


 $fetch_adv_det = sqlsrv_fetch_array($view_part_adv);
 $Breedingtype     = $fetch_adv_det['Breedingtype'];
 $Project     = $fetch_adv_det['Project'];
 $location     = $fetch_adv_det['Breedinglocation'];
 $Main_id     = $fetch_adv_det['passing_id'];










 $sno=0;

 $reqdet = "<div class='row pop-req'>
 <div class='col-md-4 py-7' style='text-align: center;'> <span > Location : </span>$location   </div>
 <div class='col-md-5 py-7' style='text-align: center;'> <span> Project : </span> $Project </div>
 <div class='col-md-3 py-7' style='text-align: center;'> <span> Type : </span> $Breedingtype  </div>

 </div><div><br></div>";

 $reqdet.="<div style='overflow-x:auto'><table class='table table-bordered table  table-hover' cellspacing='0' width='100%'  >";

 $reqdet.="

 <thead>

 <tr>

 <td colspan='4' valign='bottom'>
 Year
 </td>

 <td colspan='4' valign='bottom'>
 Standing Acreage
 </td>

 <td colspan='4' valign='bottom'>
 JUN
 </td>

 <td colspan='4' valign='bottom'>
 JUL
 </td>

 <td colspan='4' valign='bottom'>
 AUG
 </td>


 <td colspan='4' valign='bottom'>
 SEP
 </td>

 <td colspan='4' valign='bottom'>
 OCT
 </td>

 <td colspan='4' valign='bottom'>
 NOV
 </td>

 <td colspan='4' valign='bottom'>
 DEC
 </td>

 <td colspan='4' valign='bottom'>
 JAN
 </td>

 <td colspan='4' valign='bottom'>
 FEB
 </td>

 <td colspan='4' valign='bottom'>
 MAR
 </td>

 <td colspan='4' valign='bottom'>
 APR
 </td>

 <td colspan='4' valign='bottom'>
 MAY
 </td>

 <td colspan='4' valign='bottom'>
 Total Acreage
 </td>







 </tr>

 </thead>";


 $view_part_month_Sowing = sqlsrv_query($conn,"Select Breed_id,Loc_id,Proj_id,type,standing_acrage,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage,ReqDate from BreedingAdmin_MonthwiseDetails

  Where BreedingAdmin_MonthwiseDetails.Breed_id='".$passing_id."' AND BreedingAdmin_MonthwiseDetails.Loc_id='".$passing_id_loc."' and BreedingAdmin_MonthwiseDetails.Proj_id='".$passing_id_proj."'  AND type='Sowing'");



 $fetch_activity_det = sqlsrv_fetch_array($view_part_month_Sowing);

    // $sno++;


 $Breed_id   = $fetch_activity_det['Breed_id'];
 $Loc_id   = $fetch_activity_det['Loc_id'];
 $Proj_id   = $fetch_activity_det['Proj_id'];
 $type   = $fetch_activity_det['type'];
 $stand_acrage   = $fetch_activity_det['standing_acrage'];
 $Jun   = $fetch_activity_det['Jun'];
 $Jul   = $fetch_activity_det['Jul'];
 $Aug   = $fetch_activity_det['Aug'];
 $Sep   = $fetch_activity_det['Sep'];
 $Oct   = $fetch_activity_det['Oct'];
 $Nov   = $fetch_activity_det['Nov'];
 $Dec   = $fetch_activity_det['Dec'];
 $Jan   = $fetch_activity_det['Jan'];
 $Feb   = $fetch_activity_det['Feb'];
 $Mar   = $fetch_activity_det['Mar'];
 $Apr   = $fetch_activity_det['Apr'];
 $May   = $fetch_activity_det['May'];
 $Total_acrage   = $fetch_activity_det['Total_acrage'];






 $view_part_month_Harvesting = sqlsrv_query($conn,"Select Breed_id,Loc_id,Proj_id,type,standing_acrage,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage,ReqDate from BreedingAdmin_MonthwiseDetails

  Where BreedingAdmin_MonthwiseDetails.Breed_id='".$passing_id."' AND BreedingAdmin_MonthwiseDetails.Loc_id='".$passing_id_loc."' and BreedingAdmin_MonthwiseDetails.Proj_id='".$passing_id_proj."'  AND type='Harvesting'");



 $fetch_activity_det = sqlsrv_fetch_array($view_part_month_Harvesting);

    // $sno++;


 $Breed_id_Harvesting   = $fetch_activity_det['Breed_id'];
 $Loc_id_Harvesting   = $fetch_activity_det['Loc_id'];
 $Proj_id_Harvesting   = $fetch_activity_det['Proj_id'];
 $type_Harvesting   = $fetch_activity_det['type'];
 $stand_acrage_Harvesting   = $fetch_activity_det['standing_acrage'];
 $Jun_Harvesting   = $fetch_activity_det['Jun'];
 $Jul_Harvesting   = $fetch_activity_det['Jul'];
 $Aug_Harvesting   = $fetch_activity_det['Aug'];
 $Sep_Harvesting   = $fetch_activity_det['Sep'];
 $Oct_Harvesting   = $fetch_activity_det['Oct'];
 $Nov_Harvesting   = $fetch_activity_det['Nov'];
 $Dec_Harvesting   = $fetch_activity_det['Dec'];
 $Jan_Harvesting   = $fetch_activity_det['Jan'];
 $Feb_Harvesting   = $fetch_activity_det['Feb'];
 $Mar_Harvesting   = $fetch_activity_det['Mar'];
 $Apr_Harvesting   = $fetch_activity_det['Apr'];
 $May_Harvesting   = $fetch_activity_det['May'];
 $Total_acrage_Harvesting   = $fetch_activity_det['Total_acrage'];




 $view_part_month_netsatanding = sqlsrv_query($conn,"Select Breed_id,Loc_id,Proj_id,type,standing_acrage,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage,ReqDate from BreedingAdmin_MonthwiseDetails

  Where BreedingAdmin_MonthwiseDetails.Breed_id='".$passing_id."' AND BreedingAdmin_MonthwiseDetails.Loc_id='".$passing_id_loc."' and BreedingAdmin_MonthwiseDetails.Proj_id='".$passing_id_proj."'  AND type='netsatanding'");



 $fetch_activity_det = sqlsrv_fetch_array($view_part_month_netsatanding);

    // $sno++;


 $Breed_id_netsatanding   = $fetch_activity_det['Breed_id'];
 $Loc_id_netsatanding   = $fetch_activity_det['Loc_id'];
 $Proj_id_netsatanding   = $fetch_activity_det['Proj_id'];
 $type_netsatanding   = $fetch_activity_det['type'];
 $stand_acrage_netsatanding   = $fetch_activity_det['standing_acrage'];
 $Jun_netsatanding   = $fetch_activity_det['Jun'];
 $Jul_netsatanding   = $fetch_activity_det['Jul'];
 $Aug_netsatanding   = $fetch_activity_det['Aug'];
 $Sep_netsatanding   = $fetch_activity_det['Sep'];
 $Oct_netsatanding   = $fetch_activity_det['Oct'];
 $Nov_netsatanding   = $fetch_activity_det['Nov'];
 $Dec_netsatanding   = $fetch_activity_det['Dec'];
 $Jan_netsatanding   = $fetch_activity_det['Jan'];
 $Feb_netsatanding   = $fetch_activity_det['Feb'];
 $Mar_netsatanding   = $fetch_activity_det['Mar'];
 $Apr_netsatanding   = $fetch_activity_det['Apr'];
 $May_netsatanding   = $fetch_activity_det['May'];
 $Total_acrage_netsatanding   = $fetch_activity_det['Total_acrage'];






 $reqdet.="

 <tbody>

 <tr>

 <td colspan='4' valign='bottom'>
 Sowing
 <input type='hidden' class='Sowing' name='typeofbreeding[]' value='Sowing' style='width:60px'>
 <input type='hidden' name='passing_id_loc[]' value='".$passing_id_loc."'><input type='hidden' name='passing_id_proj[]' value='".$passing_id_proj."'><input type='hidden' name='passing_id[]' value='".$passing_id."'>
 </td>

<td colspan='4' valign='bottom'>
 <input type='text' class='stand_acrage monthinputbox validatetotalacr' name='stand_acrage[]'  value='".$stand_acrage."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jun_acrage monthinputbox validatetotalacr' name='jun_acrage[]'  value='".$Jun."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jul_acrage monthinputbox validatetotalacr' name='jul_acrage[]'  value='".$Jul."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='aug_acrage monthinputbox validatetotalacr' name='aug_acrage[]' value='".$Aug."'  style='width:60px'>
 </td>


 <td colspan='4' valign='bottom'>
 <input type='text' class='sep_acrage monthinputbox validatetotalacr' name='sep_acrage[]'  value='".$Sep."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='oct_acrage monthinputbox validatetotalacr' name='oct_acrage[]'  value='".$Oct."'   style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='nov_acrage monthinputbox validatetotalacr' name='nov_acrage[]'  value='".$Nov."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='dec_acrage monthinputbox validatetotalacr' name='dec_acrage[]'  value='".$Dec."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jan_acrage monthinputbox validatetotalacr' name='jan_acrage[]' value='".$Jan."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='feb_acrage monthinputbox validatetotalacr' name='feb_acrage[]'  value='".$Feb."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='mar_acrage monthinputbox validatetotalacr' name='mar_acrage[]'  value='".$Mar."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='apr_acrage monthinputbox validatetotalacr' name='apr_acrage[]'  value='".$Apr."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='may_acrage monthinputbox validatetotalacr' name='may_acrage[]'  value='".$May."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='Total_acrage monthinputbox ' name='Total_acrage[]'  value='".$Total_acrage."'  style='width:60px'>
 </td>









 </tr>


 <tr>

 <td colspan='4' valign='bottom'>
 Harvesting
 <input type='hidden' class='Harvesting' name='typeofbreeding[]' value='Harvesting' style='width:60px'>
 <input type='hidden' name='passing_id_loc[]' value='".$passing_id_loc."'><input type='hidden' name='passing_id_proj[]' value='".$passing_id_proj."'><input type='hidden' name='passing_id[]' value='".$passing_id."'><input type='hidden' class='decreased_harvest_count' value='0'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='stand_acrage_harvesting monthinputbox Harvesting' data-input='stand' name='stand_acrage[]'  value='".$stand_acrage_Harvesting."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jun_acrage_harvesting monthinputbox Harvesting' data-input='jun' name='jun_acrage[]'  value='".$Jun_Harvesting."'  style='width:60px' >
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jul_acrage_harvesting monthinputbox Harvesting' data-input='jul' name='jul_acrage[]' value='".$Jul_Harvesting."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='aug_acrage_harvesting monthinputbox Harvesting' data-input='aug' name='aug_acrage[]' value='".$Aug_Harvesting."'  style='width:60px'>
 </td>


 <td colspan='4' valign='bottom'>
 <input type='text' class='sep_acrage_harvesting monthinputbox Harvesting' data-input='sep' name='sep_acrage[]' value='".$Sep_Harvesting."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='oct_acrage_harvesting monthinputbox Harvesting' data-input='oct' name='oct_acrage[]' value='".$Oct_Harvesting."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='nov_acrage_harvesting monthinputbox Harvesting' data-input='nov' name='nov_acrage[]' value='".$Nov_Harvesting."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='dec_acrage_harvesting monthinputbox Harvesting' data-input='dec' name='dec_acrage[]' value='".$Dec_Harvesting."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jan_acrage_harvesting monthinputbox Harvesting' data-input='jan' name='jan_acrage[]' value='".$Jan_Harvesting."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='feb_acrage_harvesting monthinputbox Harvesting' data-input='feb' name='feb_acrage[]' value='".$Feb_Harvesting."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='mar_acrage_harvesting monthinputbox Harvesting' data-input='mar' name='mar_acrage[]' value='".$Mar_Harvesting."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='apr_acrage_harvesting monthinputbox Harvesting' data-input='apr' name='apr_acrage[]' value='".$Apr_Harvesting."'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='may_acrage_harvesting monthinputbox Harvesting' data-input='may' name='may_acrage[]' value='".$May_Harvesting."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='Total_acrage_harvesting monthinputbox' value='0' name='Total_acrage[]'  style='width:60px'>
 </td>









 </tr>


 <tr>

 <td colspan='4' valign='bottom'>
 Net Standing
 <input type='hidden' class='Harvesting' name='typeofbreeding[]' value='netsatanding' style='width:60px'>
 <input type='hidden' name='passing_id_loc[]' value='".$passing_id_loc."'><input type='hidden' name='passing_id_proj[]' value='".$passing_id_proj."'><input type='hidden' name='passing_id[]' value='".$passing_id."'>
 </td>

  <td colspan='4' valign='bottom'>
 <input type='text' class='stand_acrage_netsatanding monthinputbox' name='stand_acrage[]'  value='".$stand_acrage_netsatanding."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jun_acrage_netsatanding monthinputbox' name='jun_acrage[]'   value='".$Jun_netsatanding."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jul_acrage_netsatanding monthinputbox' name='jul_acrage[]'   value='".$Jul_netsatanding."'style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='aug_acrage_netsatanding monthinputbox' name='aug_acrage[]'  value='".$Aug_netsatanding."'  style='width:60px'>
 </td>


 <td colspan='4' valign='bottom'>
 <input type='text' class='sep_acrage_netsatanding monthinputbox' name='sep_acrage[]'   value='".$Sep_netsatanding."'style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='oct_acrage_netsatanding monthinputbox' name='oct_acrage[]'   value='".$Oct_netsatanding."'style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='nov_acrage_netsatanding monthinputbox' name='nov_acrage[]'   value='".$Nov_netsatanding."'style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='dec_acrage_netsatanding monthinputbox' name='dec_acrage[]'   value='".$Dec_netsatanding."'style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jan_acrage_netsatanding monthinputbox' name='jan_acrage[]'  value='".$Jan_netsatanding."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='feb_acrage_netsatanding monthinputbox' name='feb_acrage[]'   value='".$Feb_netsatanding."'style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='mar_acrage_netsatanding monthinputbox' name='mar_acrage[]'   value='".$Mar_netsatanding."'style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='apr_acrage_netsatanding monthinputbox' name='apr_acrage[]'  value='".$Apr_netsatanding."' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='may_acrage_netsatanding monthinputbox' name='may_acrage[]'   value='".$May_netsatanding."'style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='Total_acrage_netsatanding monthinputbox' name='Total_acrage[]'  Value ='0'style='width:60px'>
 </td>









 </tr>

 </tbody>";






 $reqdet.="</table></div>
 <div class='modal-footer'>


 <button type='button'  class='btn  btn-success Editmonthvaue' >Edit</button>
 <button type='button' class='btn btn-default close' data-dismiss='modal'>Close</button>
 </div>";







 echo json_encode($reqdet);
} 


if($action_type == 'deleterowwisedata' && isset($_REQUEST['passing_id']) && $_REQUEST['passing_id'] != '' ){  
 $passing_id = $_REQUEST['passing_id'];
 $passing_id_loc = $_REQUEST['passing_id_loc'];
 $passing_id_proj = $_REQUEST['passing_id_proj'];

 $CreatedAt=date('Y-m-d H:i:s');
 $CreatedBy=@$_SESSION['EmpID'];

 if($CreatedBy !=''){


  $Sql="UPDATE BreedingAdmin_Type SET Rejectionstatus='2',Rejectby='".$CreatedBy."',Rejectat='".$CreatedAt."' Where Id='".@$passing_id."'";
        $Result=sqlsrv_query($conn,$Sql);


  $Sql="UPDATE BreedingAdmin_Location SET Rejectionstatus='2',Rejectby='".$CreatedBy."',Rejectat='".$CreatedAt."' Where Id='".@$passing_id_loc."'";
  $Result=sqlsrv_query($conn,$Sql);


  $Sql="UPDATE BreedingAdmin_Project SET Rejectionstatus='2',Rejectby='".$CreatedBy."',Rejectat='".$CreatedAt."' Where id='".@$passing_id_proj."'";
  $Result=sqlsrv_query($conn,$Sql);

  $reqdet=1;
}else{

  $reqdet=0;
}


echo json_encode($reqdet);
} 








if($action_type == 'landleasemonthwise' && isset($_REQUEST['passing_id']) && $_REQUEST['passing_id'] != '' ){  
 $passing_id = $_REQUEST['passing_id'];
 
 $sql = "Select TOTALROW = count(*) OVER(), Lease_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage from BreedingAdmin_MonthwiseLandlease
  Where 1=1 AND BreedingAdmin_MonthwiseLandlease.CreatedBy  IN ('".$_SESSION['EmpID']."') and BreedingAdmin_MonthwiseLandlease.Currentstatus='1' AND BreedingAdmin_MonthwiseLandlease.Lease_id='$passing_id'  Order by BreedingAdmin_MonthwiseLandlease.Id DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY";

  if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'completed') {
    $sql = "Select TOTALROW = count(*) OVER(), Lease_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage from BreedingAdmin_MonthwiseLandlease Where 1=1 AND BreedingAdmin_MonthwiseLandlease.CreatedBy  IN ('".$_SESSION['EmpID']."') and BreedingAdmin_MonthwiseLandlease.Currentstatus='2' AND BreedingAdmin_MonthwiseLandlease.Lease_id='$passing_id'  Order by BreedingAdmin_MonthwiseLandlease.Id DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY";
  }

  $view_part_adv = sqlsrv_query($conn,$sql); 

 $fetch_adv_det = sqlsrv_fetch_array($view_part_adv);
 $Lease_id     = $fetch_adv_det['Lease_id'];
 $Jun     = $fetch_adv_det['Jun'];
 $Jul     = $fetch_adv_det['Jul'];
 $Aug     = $fetch_adv_det['Aug'];
 $Sep     = $fetch_adv_det['Sep'];
 $Oct     = $fetch_adv_det['Oct'];
 $Nov     = $fetch_adv_det['Nov'];
 $Dec     = $fetch_adv_det['Dec'];
 $Jan     = $fetch_adv_det['Jan'];
 $Feb     = $fetch_adv_det['Feb'];
 $Mar     = $fetch_adv_det['Mar'];
 $Apr     = $fetch_adv_det['Apr'];
 $May     = $fetch_adv_det['May'];
 $Total_acrage     = $fetch_adv_det['Total_acrage'];


 $sno=0;

 $reqdet = "<div class='row pop-req'>
 

 </div><div><br></div>";

 $reqdet.="<div style='overflow-x:auto'><table class='table table-bordered table  table-hover' cellspacing='0' width='100%'  ><input type='hidden' class='form-control' name='landleaseid' value='".$passing_id."'>";

 $reqdet.="

 <thead>

 <tr>

 <td colspan='4' valign='bottom'>
 Year
 </td>

 <td colspan='4' valign='bottom'>
 JUN
 </td>

 <td colspan='4' valign='bottom'>
 JUL
 </td>

 <td colspan='4' valign='bottom'>
 AUG
 </td>


 <td colspan='4' valign='bottom'>
 SEP
 </td>

 <td colspan='4' valign='bottom'>
 OCT
 </td>

 <td colspan='4' valign='bottom'>
 NOV
 </td>

 <td colspan='4' valign='bottom'>
 DEC
 </td>

 <td colspan='4' valign='bottom'>
 JAN
 </td>

 <td colspan='4' valign='bottom'>
 FEB
 </td>

 <td colspan='4' valign='bottom'>
 MAR
 </td>

 <td colspan='4' valign='bottom'>
 APR
 </td>

 <td colspan='4' valign='bottom'>
 MAY
 </td>

 <td colspan='4' valign='bottom'>
 Total Acreage
 </td>







 </tr>

 </thead>";



 $reqdet.="

 <tbody>

 <tr>

 <td colspan='4' valign='bottom'>
 Land Lease
 
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jun_acrage monthinputbox validatetotalacr' name='jun_acrage[]' value='$Jun' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jul_acrage monthinputbox validatetotalacr' name='jul_acrage[]' value='$Jul'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='aug_acrage monthinputbox validatetotalacr' name='aug_acrage[]' value='$Aug'  style='width:60px'>
 </td>


 <td colspan='4' valign='bottom'>
 <input type='text' class='sep_acrage monthinputbox validatetotalacr' name='sep_acrage[]' value='$Sep'   style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='oct_acrage monthinputbox validatetotalacr' name='oct_acrage[]' value='$Oct'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='nov_acrage monthinputbox validatetotalacr' name='nov_acrage[]' value='$Nov'   style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='dec_acrage monthinputbox validatetotalacr' name='dec_acrage[]' value='$Dec'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jan_acrage monthinputbox validatetotalacr' name='jan_acrage[]' value='$Jan'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='feb_acrage monthinputbox validatetotalacr' name='feb_acrage[]' value='$Feb'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='mar_acrage monthinputbox validatetotalacr' name='mar_acrage[]' value='$Mar'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='apr_acrage monthinputbox validatetotalacr' name='apr_acrage[]' value='$Apr'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='may_acrage monthinputbox validatetotalacr' name='may_acrage[]' value='$May'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='Total_acrage monthinputbox ' name='Total_acrage[]' value='$Total_acrage'  style='width:60px'>
 </td>









 </tr>



 </tbody>";






 $reqdet.="</table></div>
 <div class='modal-footer'>


 <button type='button'  class='btn  btn-success Savemonthvalue' >SAVE</button>
 <button type='button' class='btn btn-default close' data-dismiss='modal'>Close</button>

 </div>";







 echo json_encode($reqdet);
} 




if($action_type == 'monthwiseconsumbales' && isset($_REQUEST['passing_id']) && $_REQUEST['passing_id'] != '' ){  
 $passing_id = $_REQUEST['passing_id'];





  $view_part_adv = sqlsrv_query($conn,"Select TOTALROW = count(*) OVER(), Consum_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage from BreedingAdmin_MonthwiseConsumbales


  Where 1=1 
  AND BreedingAdmin_MonthwiseConsumbales.CreatedBy  IN ('".$_SESSION['EmpID']."') and BreedingAdmin_MonthwiseConsumbales.Currentstatus='1' AND BreedingAdmin_MonthwiseConsumbales.Consum_id='$passing_id'  Order by BreedingAdmin_MonthwiseConsumbales.Id DESC OFFSET 0 ROWS FETCH NEXT 5 ROWS ONLY");

 


 $fetch_adv_det = sqlsrv_fetch_array($view_part_adv);
 $Consum_id     = $fetch_adv_det['Consum_id'];
 $Jun     = $fetch_adv_det['Jun'];
 $Jul     = $fetch_adv_det['Jul'];
 $Aug     = $fetch_adv_det['Aug'];
 $Sep     = $fetch_adv_det['Sep'];
 $Oct     = $fetch_adv_det['Oct'];
 $Nov     = $fetch_adv_det['Nov'];
 $Dec     = $fetch_adv_det['Dec'];
 $Jan     = $fetch_adv_det['Jan'];
 $Feb     = $fetch_adv_det['Feb'];
 $Mar     = $fetch_adv_det['Mar'];
 $Apr     = $fetch_adv_det['Apr'];
 $May     = $fetch_adv_det['May'];
 $Total_acrage     = $fetch_adv_det['Total_acrage'];


 $sno=0;

 $reqdet = "<div class='row pop-req'>
 

 </div><div><br></div>";

 $reqdet.="<div style='overflow-x:auto'><table class='table table-bordered table  table-hover' cellspacing='0' width='100%'  ><input type='hidden' class='form-control' name='consumableid' value='".$passing_id."'>";

 $reqdet.="

 <thead>

 <tr>

 <td colspan='4' valign='bottom'>
 Year
 </td>

 <td colspan='4' valign='bottom'>
 JUN
 </td>

 <td colspan='4' valign='bottom'>
 JUL
 </td>

 <td colspan='4' valign='bottom'>
 AUG
 </td>


 <td colspan='4' valign='bottom'>
 SEP
 </td>

 <td colspan='4' valign='bottom'>
 OCT
 </td>

 <td colspan='4' valign='bottom'>
 NOV
 </td>

 <td colspan='4' valign='bottom'>
 DEC
 </td>

 <td colspan='4' valign='bottom'>
 JAN
 </td>

 <td colspan='4' valign='bottom'>
 FEB
 </td>

 <td colspan='4' valign='bottom'>
 MAR
 </td>

 <td colspan='4' valign='bottom'>
 APR
 </td>

 <td colspan='4' valign='bottom'>
 MAY
 </td>

 <td colspan='4' valign='bottom'>
 Total Acreage
 </td>







 </tr>

 </thead>";



 $reqdet.="

 <tbody>

 <tr>

 <td colspan='4' valign='bottom'>
 
 Consumables
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jun_acrage monthinputbox validatetotalacr' name='jun_acrage[]' value='$Jun' style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jul_acrage monthinputbox validatetotalacr' name='jul_acrage[]' value='$Jul'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='aug_acrage monthinputbox validatetotalacr' name='aug_acrage[]' value='$Aug'  style='width:60px'>
 </td>


 <td colspan='4' valign='bottom'>
 <input type='text' class='sep_acrage monthinputbox validatetotalacr' name='sep_acrage[]' value='$Sep'   style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='oct_acrage monthinputbox validatetotalacr' name='oct_acrage[]' value='$Oct'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='nov_acrage monthinputbox validatetotalacr' name='nov_acrage[]' value='$Nov'   style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='dec_acrage monthinputbox validatetotalacr' name='dec_acrage[]' value='$Dec'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='jan_acrage monthinputbox validatetotalacr' name='jan_acrage[]' value='$Jan'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='feb_acrage monthinputbox validatetotalacr' name='feb_acrage[]' value='$Feb'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='mar_acrage monthinputbox validatetotalacr' name='mar_acrage[]' value='$Mar'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='apr_acrage monthinputbox validatetotalacr' name='apr_acrage[]' value='$Apr'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='may_acrage monthinputbox validatetotalacr' name='may_acrage[]' value='$May'  style='width:60px'>
 </td>

 <td colspan='4' valign='bottom'>
 <input type='text' class='Total_acrage monthinputbox ' name='Total_acrage[]' value='$Total_acrage'  style='width:60px'>
 </td>









 </tr>



 </tbody>";






 $reqdet.="</table></div>
 <div class='modal-footer'>


 <button type='button'  class='btn  btn-success Savemonthvalue' >SAVE</button>
 <button type='button' class='btn btn-default close' data-dismiss='modal'>Close</button>

 </div>";







 echo json_encode($reqdet);
} 





?>

