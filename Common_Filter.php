<?php 

//include 'Send_Mail.php';

function Generate_Auto_Breedid($id){

 global $conn;
 $Sql="Exec Breeding_Generate_No @Id=" . $id . ",@EmployeeCode=" . @$_SESSION['EmpID']. " ";
 $Sql_Connection=sqlsrv_query($conn,$Sql);
 $Sql_Result=sqlsrv_fetch_array($Sql_Connection);
    //print_r(@$Sql_Result['PrimaryId']);
 return @$Sql_Result['PrimaryId'];

 
 
}


//error_reporting(-1);
Class Common_Filter{
  public $conn;
  //public $User_Id;
 // public $Role_Id;
  function __construct($conn) {
    $this->conn = $conn;
    ///  $this->User_Id = $_SESSION['EmpID'];
    ///  $this->Role_Id = $_SESSION['Dcode'];
  }

  private function get_Sql_Result($Sql_Dets){
    $result=array();
    while($value=sqlsrv_fetch_array($Sql_Dets)){
      $result[]=$value;
    }
    return $result;
  }




  public function locationwiseacrage($data)
  {

   // echo "hs";exit;
    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $location_array = implode(', ', @$data['location']);
    $project_array = implode(', ', @$data['project']);

    $breedingloc=@$data['breedingloc'];


    foreach(@$data['location'] as $key=>$value)
    {
      $location_val=@$data['location'][$key];

      foreach(@$data['project'] as $pkey=>$value)
      {

       $project_val=@$data['project'][$pkey];

       $SqlQuery="SELECT Count(*) as insertcount from BreedingAdmin_Type

       Inner Join BreedingAdmin_location On BreedingAdmin_location.Docid=BreedingAdmin_Type.id
       Inner Join BreedingAdmin_project On BreedingAdmin_project.Docid=BreedingAdmin_Type.id AND BreedingAdmin_project.ordernum=BreedingAdmin_location.ordernum


       Where 1=1 and BreedingAdmin_Type.Currentstatus in ('1','2') and BreedingAdmin_Type.Rejectionstatus IS NULL  

       AND BreedingAdmin_Type.Breedingtype='".@$breedingloc."' and BreedingLocation='".@$location_val."' and Project='".$project_val."' and BreedingAdmin_Type.CreatedBy = '".$Emp_Id."' and BreedingAdmin_project.Rejectionstatus IS NULL";

       $Result=sqlsrv_query($this->conn,$SqlQuery);

       
       $countofinsertvalue=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);

       $countvalueinser=$countofinsertvalue['insertcount'];

       if($countvalueinser>0){
        $status=1;
        $Autoincnum='';
        $autoid='';
      } else{

        $CreatedBy=@$_SESSION['EmpID'];

        $Dcode=@$_SESSION['Dcode'];
        $CreatedAt=date('Y-m-d H:i:s');
        $Created_date=date('Y-m-d');
        $CurrentStatus="1";
        $RejectionStatus="1";

        $breedingloc=@$data['breedingloc'];

        if($CreatedBy !=''){
         $Doc_No=Generate_Auto_Breedid(0);
         $autonum=@$Doc_No;
       } else{
        $autonum='';
      }

      if($autonum !=''){

        if($CreatedBy !=''){
          $SQL="INSERT INTO  BreedingAdmin_Type(Breed_no,Breedingtype,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$autonum."','".$breedingloc."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
           $Result=sqlsrv_query($this->conn,$SQL);


           $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);

           $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];


               // foreach(@$data['location'] as $key=>$value)
               // {

                // $location_val=@$data['location'][$key];

                // for($i = 0; $i<sizeof(@$data['project']); $i++) {
           $SQL1="INSERT INTO  BreedingAdmin_Location(Docid,Ordernum,BreedingLocation,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$pkey."','".$location_val."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
             $Result=sqlsrv_query($this->conn,$SQL1);

                 // }


               // }

               // $i_project = 0;
               // foreach(@$data['project'] as $key=>$value)
               // {

               //  $location_val=@$data['project'][$key];

                // for($i = 0; $i<sizeof(@$data['project']); $i++) {

             $SQL1="INSERT INTO  BreedingAdmin_project(Docid,Ordernum,project,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$pkey."','".$project_val."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
               $Result=sqlsrv_query($this->conn,$SQL1);

                 // $i_project++;

               $status=1;
               // }

               // }

               

               $SQL="SELECT DISTINCT  Breed_no as Breed_no,id as autoid from BreedingAdmin_Type Where Id='".$Last_Insert_Id_sub."'";
               $Result_data=sqlsrv_query($this->conn,$SQL);

               $Autonum_details=sqlsrv_fetch_array($Result_data,SQLSRV_FETCH_ASSOC);

               $Autoincnum=@$Autonum_details['Breed_no'];
               $autoid=@$Autonum_details['autoid'];

               $count=0;

             }  else {
              $status=0;
              $Autoincnum='';
              $autoid='';
            }

          } else{
           $status=0;
           $Autoincnum='';
           $autoid='';
         }
       }   
     }
   }

   return array('Status'=>$status,'Autoincnum'=>$Autoincnum,'autoid'=>$autoid);
 }

 public function all_pending_project_acreage_completion_validation($Emp_Id,$autoid,$Offset,$Length)
 {
  $Sql="Exec BreedingAdmin_LocationWise_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  $acrage_completed = 1;
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $recordsTotal = @$Sql_Result['TOTALROW'];
    $resarr = array();
    $resarr[] = utf8_encode(@$Sql_Result['Breedinglocation']);
    $resarr[] = utf8_encode(@$Sql_Result['Project']);
    $resarr[] = utf8_encode(@$Sql_Result['Breedingtype']);

    //total Acreage get
    $sql_month_acr="SELECT DISTINCT Total_acrage FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' AND Total_acrage !='' ";
    $stmt = sqlsrv_query($this->conn, $sql_month_acr);
    $month_data_acr = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

    // splited acreage is equal to total acreage validation 
    $sql_acrage="SELECT (CASE WHEN ISNULL(Jun, '') = '' THEN 0 ELSE CAST(Jun AS decimal(20,2)) END +
      CASE WHEN ISNULL(Jul, '') = '' THEN 0 ELSE CAST(Jul AS decimal(20,2)) END +
      CASE WHEN ISNULL(Aug, '') = '' THEN 0 ELSE CAST(Aug AS decimal(20,2)) END +
      CASE WHEN ISNULL(Sep, '') = '' THEN 0 ELSE CAST(Sep AS decimal(20,2)) END +
      CASE WHEN ISNULL(Oct, '') = '' THEN 0 ELSE CAST(Oct AS decimal(20,2)) END +
      CASE WHEN ISNULL(Nov, '') = '' THEN 0 ELSE CAST(Nov AS decimal(20,2)) END +
      CASE WHEN ISNULL(Dec, '') = '' THEN 0 ELSE CAST(Dec AS decimal(20,2)) END +
      CASE WHEN ISNULL(Jan, '') = '' THEN 0 ELSE CAST(Jan AS decimal(20,2)) END +
      CASE WHEN ISNULL(Feb, '') = '' THEN 0 ELSE CAST(Feb AS decimal(20,2)) END +
      CASE WHEN ISNULL(Mar, '') = '' THEN 0 ELSE CAST(Mar AS decimal(20,2)) END +
      CASE WHEN ISNULL(Apr, '') = '' THEN 0 ELSE CAST(Apr AS decimal(20,2)) END +
      CASE WHEN ISNULL(May, '') = '' THEN 0 ELSE CAST(May AS decimal(20,2)) END ) AS monthwise_count_details FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' AND type='Sowing'";
    $acg_stmt = sqlsrv_query($this->conn, $sql_acrage);
    $acrage_count = sqlsrv_fetch_array($acg_stmt,SQLSRV_FETCH_ASSOC);

    if($acrage_count['monthwise_count_details'] == '' || $acrage_count['monthwise_count_details'] == 0 || ($acrage_count['monthwise_count_details'] != $month_data_acr['Total_acrage'])) {
      $acrage_completed = 0;

    }
  }
  return $acrage_completed; 
}

 public function ProjectWiseDetails($User_Input=array())
 {

  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'];
  $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

 //total data acreage completion status validation functionality 
  $validate_res = $this->all_pending_project_acreage_completion_validation($Emp_Id,$autoid,0,50000);  

  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $i=0;
  $Sql="Exec BreedingAdmin_LocationWise_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  $acrage_completed = true;
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $recordsTotal = @$Sql_Result['TOTALROW'];
    $resarr = array();
    $resarr[] = $sno++;
    $resarr[] = utf8_encode(@$Sql_Result['Breedinglocation']);
    $resarr[] = utf8_encode(@$Sql_Result['Project']);
    $resarr[] = utf8_encode(@$Sql_Result['Breedingtype']);

    $sql_month="SELECT COUNT(*) as count FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' ";
    $stmt = sqlsrv_query($this->conn, $sql_month);
    $month_data = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);



    $sql_month_acr="SELECT DISTINCT Total_acrage FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' AND Total_acrage !='' ";
    $stmt = sqlsrv_query($this->conn, $sql_month_acr);
    $month_data_acr = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

    if($month_data['count']>0){

     $resarr[]  ='<input type="number" class="Acrage acragevaluemain" name=acragevaluemain[] value="'.$month_data_acr['Total_acrage'] .'" style="width: 78px;background-color:#5dd099;color:white" readonly>';

   }else{

     $resarr[]  ='<input type="number" class="Acrage acragevaluemain" name=acragevaluemain[] value="'.$month_data_acr['Total_acrage'] .'" style="width: 78px;" >';


   }

   if($month_data['count']>0){
    $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-info View_Month_wise_popup' >View</button><input type='hidden' class='passing_id_loc' value='".@$Sql_Result['passing_id_loc']."' name=passing_id_loc[]><input type='hidden' class='passing_id_proj' value='".@$Sql_Result['passing_id_proj']."' name=passing_id_proj[]><input type='hidden' class='allpassing_id' value='".@$Sql_Result['passing_id']."' name=allpassing_id[] >";


  }else{

    $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-primary Add_Month_wise_popup' >Add</button><input type='hidden' class='passing_id_loc' value='".@$Sql_Result['passing_id_loc']."' name=passing_id_loc[]><input type='hidden' class='passing_id_proj' value='".@$Sql_Result['passing_id_proj']."' name=passing_id_proj[]><input type='hidden' class='allpassing_id' value='".@$Sql_Result['passing_id']."' name=allpassing_id[] >";
  }




  
  
  $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-info Add_landblock_popup' >Add</button>";





  $SQL="SELECT DISTINCT Employee_name,Employee_Code,Department FROM HR_Master_Table  Where Employee_Code IS NOT NULL AND Employment_Status='Active'";
  $Result_HR=sqlsrv_query($this->conn,$SQL);


  $i = 0;

  $Divition_Crop_Id=array();


  while( $row = sqlsrv_fetch_array( $Result_HR )) {

    $Divition_Crop_Id[]=array('code'=>$row['Employee_Code'],'Employee_name'=>$row['Employee_name'],'Department'=>$row['Department']);
//$Project_Code_value[]=array();

  }


  $ProjectWorkCode_selectbox='';


  $ProjectWorkCode_selectbox.=  '<select class="select2 form-control mb-3 custom-select Responsible_person dt-select2"    name="Responsible_person[]"  style="width: 150px !important;" > <option value=""> SELECT   </option>';

  foreach ($Divition_Crop_Id as $key => $value) {

///$selectedLWC=@$Sql_Result['Project_Code']==$value['Project_Value'] ? 'selected' :'';


    $ProjectWorkCode_selectbox.= ' <option  value='.$value['code'].' >'.$value['code'].'-'.$value['Employee_name'].'-'.$value['Department'].'  </option>';

  }


  $ProjectWorkCode_selectbox.= '</select>';

  $resarr[]=$ProjectWorkCode_selectbox;




  
  // $resarr[]='<button type="button" class="btn btn-sm btn-success editbutton"><i class="fas fa-edit"></i></button>
  // <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>  '; 
      
  // Acrage is equal to monthwise entered acrage validation check 
  $sql_acrage="SELECT (CASE WHEN ISNULL(Jun, '') = '' THEN 0 ELSE CAST(Jun AS decimal(20,2)) END +
      CASE WHEN ISNULL(Jul, '') = '' THEN 0 ELSE CAST(Jul AS decimal(20,2)) END +
      CASE WHEN ISNULL(Aug, '') = '' THEN 0 ELSE CAST(Aug AS decimal(20,2)) END +
      CASE WHEN ISNULL(Sep, '') = '' THEN 0 ELSE CAST(Sep AS decimal(20,2)) END +
      CASE WHEN ISNULL(Oct, '') = '' THEN 0 ELSE CAST(Oct AS decimal(20,2)) END +
      CASE WHEN ISNULL(Nov, '') = '' THEN 0 ELSE CAST(Nov AS decimal(20,2)) END +
      CASE WHEN ISNULL(Dec, '') = '' THEN 0 ELSE CAST(Dec AS decimal(20,2)) END +
      CASE WHEN ISNULL(Jan, '') = '' THEN 0 ELSE CAST(Jan AS decimal(20,2)) END +
      CASE WHEN ISNULL(Feb, '') = '' THEN 0 ELSE CAST(Feb AS decimal(20,2)) END +
      CASE WHEN ISNULL(Mar, '') = '' THEN 0 ELSE CAST(Mar AS decimal(20,2)) END +
      CASE WHEN ISNULL(Apr, '') = '' THEN 0 ELSE CAST(Apr AS decimal(20,2)) END +
      CASE WHEN ISNULL(May, '') = '' THEN 0 ELSE CAST(May AS decimal(20,2)) END ) AS monthwise_count_details FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' AND type='Sowing'";
  $acg_stmt = sqlsrv_query($this->conn, $sql_acrage);
  $acrage_count = sqlsrv_fetch_array($acg_stmt,SQLSRV_FETCH_ASSOC);
  $completion_class = ($acrage_count['monthwise_count_details'] == '' && $acrage_count['monthwise_count_details'] == 0) ? 'failed' : (($acrage_count['monthwise_count_details'] != '' && $acrage_count['monthwise_count_details'] > 0 && ($acrage_count['monthwise_count_details'] == $month_data_acr['Total_acrage'])) ? 'success' : 'mismatch');
  if($completion_class == 'failed') {
    $acrage_completed = false;
    $resarr[]='<span title="Incompleted"><i class="fa fa-check-circle failed_completion" aria-hidden="true"></i></span>
    <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>';
  } elseif ($completion_class == 'success') {
     $resarr[]='<span title="Completed"><i class="fa fa-check-circle success_completion" aria-hidden="true"></i></span>
     <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>';
  } elseif($completion_class == 'mismatch') {
    $acrage_completed = false;
     $resarr[]='<span title="Mismatch"><i class="fa fa-check-circle mismatch_completion" aria-hidden="true"></i></span>
     <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>';
  }

  
  
  $resultarr[] = $resarr;
  $i++;
}
$res=array();
if(isset($User_Input['draw']))
{
  $res['draw'] = @$User_Input['draw'];  
}else
{
  $res['draw'] = 1; 
}
$res['recordsFiltered'] = @$recordsTotal;
$res['recordsTotal'] = @$recordsTotal;
$res['data'] = @$resultarr;
$res['sql'] = @$Sql;
// $res['acrage_completed_status'] = $acrage_completed;
$res['acrage_completed_status'] = ($validate_res == 1) ? true : false;
$result = $res;
return $result;
}






public function monthwisedetails($data)
{

  //  echo "<pre>";print_r($data);
   // exit; 


  $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
  $Dcode=@$_SESSION['Dcode'];
  $CreatedAt=date('Y-m-d H:i:s');
  $Created_date=date('Y-m-d');
  $CurrentStatus="1";
  $RejectionStatus="1";



  $passing_id_loc=@$data['passing_id_loc'];
  $passing_id_proj=@$data['passing_id_proj'];
  $passing_id=@$data['passing_id'];
  $passing_id=@$data['passing_id'];


  $status=0;
  if($CreatedBy !=''){



    foreach(@$data['typeofbreeding'] as $key=>$value)
    {

      $type=@$data['typeofbreeding'][$key];
      $Breed_id=@$data['passing_id'][$key];
      $Loc_id=@$data['passing_id_loc'][$key];
      $Proj_id=@$data['passing_id_proj'][$key];
      $stand_acrage=@$data['stand_acrage'][$key];
      $Jun=@$data['jun_acrage'][$key];
      $Jul=@$data['jul_acrage'][$key];
      $Aug=@$data['aug_acrage'][$key];
      $Sep=@$data['sep_acrage'][$key];
      $Oct=@$data['oct_acrage'][$key];
      $Nov=@$data['nov_acrage'][$key];
      $Dec=@$data['dec_acrage'][$key];
      $Jan=@$data['jan_acrage'][$key];
      $Feb=@$data['feb_acrage'][$key];
      $Mar=@$data['mar_acrage'][$key];
      $Apr=@$data['apr_acrage'][$key];
      $May=@$data['may_acrage'][$key];
      $Total_acrage=@$data['Total_acrage'][$key];

      $SQL="INSERT INTO  BreedingAdmin_MonthwiseDetails(Breed_id,Loc_id,Proj_id,type,standing_acrage,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Breed_id."','".$Loc_id."','".$Proj_id."','".$type."','".$stand_acrage."','".$Jun."','".$Jul."','".$Aug."','".$Sep."','".$Oct."','".$Nov."','".$Dec."','".$Jan."','".$Feb."','".$Mar."','".$Apr."','".$May."','".$Total_acrage."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
       $Result=sqlsrv_query($this->conn,$SQL);


          // $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);
       $status=1;

     }


   }else{

    $status=0;


  }


          // $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];

  // exit;
  return array('Status'=>$status);
}


public function monthwisedetails_Edit($data)
{

    //echo "<pre>";print_r($data);
   // exit; 


  $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
  $Dcode=@$_SESSION['Dcode'];
  $CreatedAt=date('Y-m-d H:i:s');
  $Created_date=date('Y-m-d');
  $CurrentStatus="1";
  $RejectionStatus="1";



  $passing_id_loc=@$data['passing_id_loc'];
  $passing_id_proj=@$data['passing_id_proj'];
  $passing_id=@$data['passing_id'];
  $passing_id=@$data['passing_id'];


  $status=0;
  if($CreatedBy !=''){



    foreach(@$data['typeofbreeding'] as $key=>$value)
    {

      $type=@$data['typeofbreeding'][$key];
      $Breed_id=@$data['passing_id'][$key];
      $Loc_id=@$data['passing_id_loc'][$key];
      $Proj_id=@$data['passing_id_proj'][$key];
      $stand_acrage=@$data['stand_acrage'][$key];
      $Jun=@$data['jun_acrage'][$key];
      $Jul=@$data['jul_acrage'][$key];
      $Aug=@$data['aug_acrage'][$key];
      $Sep=@$data['sep_acrage'][$key];
      $Oct=@$data['oct_acrage'][$key];
      $Nov=@$data['nov_acrage'][$key];
      $Dec=@$data['dec_acrage'][$key];
      $Jan=@$data['jan_acrage'][$key];
      $Feb=@$data['feb_acrage'][$key];
      $Mar=@$data['mar_acrage'][$key];
      $Apr=@$data['apr_acrage'][$key];
      $May=@$data['may_acrage'][$key];
      $Total_acrage=@$data['Total_acrage'][$key];

      $SQL="UPDATE  BreedingAdmin_MonthwiseDetails SET standing_acrage = '$stand_acrage',Jun='$Jun',Jul='$Jul',Aug='$Aug',Sep='$Sep',Oct='$Oct',Nov='$Nov',Dec='$Dec',Jan='$Jan',Feb='$Feb',Mar='$Mar',Apr='$Apr',May='$May',ModifiedBy='$CreatedBy',ModifiedAt='$CreatedAt' Where Breed_id='$Breed_id' AND Loc_id='$Loc_id'  AND Proj_id='$Proj_id' AND type='$type' ";
      $Result=sqlsrv_query($this->conn,$SQL);


          // $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);
      $status=1;

    }


  }else{

    $status=0;


  }


          // $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];

   //exit;
  return array('Status'=>$status);
}






public function Assumptionwisemalefemale($data)
{

    //echo "<pre>";print_r($data);
    //exit; 


  $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
  $Dcode=@$_SESSION['Dcode'];
  $CreatedAt=date('Y-m-d H:i:s');
  $Created_date=date('Y-m-d');
  $CurrentStatus="1";
  $RejectionStatus="1";

  

   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);
  

  $status=0;  
    // $autonum=@$data['autonum'];


  if($CreatedBy !=''){


    $i=0;



    // $sql_month_acr="SELECT Count(*) as Month_count from BreedingAdmin_Monthwise_amount Where Location='".@$data['location']."'";
    // $stmt = sqlsrv_query($this->conn, $sql_month_acr);
    // $month_data_acr = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

    // if($month_data_acr['Month_count']==0){
    //     $sql="INSERT INTO BreedingAdmin_Monthwise_amount(Docid,Ordernum,Location,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES(1,0,'".$data['location']."','".$CreatedBy."','".$CreatedAt."','1')";

    //     $Result=sqlsrv_query($this->conn,$sql);

    // }

    foreach(@$data['project'] as $key=>$value)
    {

      //$location_val=@$data['location'][$key];
      $Project_val=@$data['project'][$key];

      $WorkActivity=@$data['WorkActivity'][$key];
      

      $location_val=@$data['location'];


      $SQL1="INSERT INTO  BreedingAdmin_Assumption(Ordernum,AssumLocation,AssumProject,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$i."','".$location_val."','".$Project_val."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
       $Result=sqlsrv_query($this->conn,$SQL1);

       $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);





       $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];


       foreach(@$data['WorkActivity'] as $key=>$value)
       {

        $WorkActivity=@$data['WorkActivity'][$key];



        
        $SQL1="INSERT INTO  BreedingAdmin_Activity(Docid,Ordernum,BreedingActivity,ReqDate,CreatedBy,CreatedAt,CurrentStatus,malecount,femalecount)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$i."','".$WorkActivity."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1','0','0')";
         $Result=sqlsrv_query($this->conn,$SQL1);

         $status=1;  

       }

       

     }

//$i_project = 0;


     


   }else{

    $status=0;

    
  }





//  exit;
  return array('Status'=>$status);
}







public function AssumptionEnrty($User_Input=array())
{


  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'];
  $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $i=0;
  $Sql="Exec BreedingAdmin_Assumption_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $recordsTotal = @$Sql_Result['TOTALROW'];
    $resarr = array();
     // $resarr[] = $sno++;
    $resarr[] = utf8_encode(@$Sql_Result['Assumlocation']).'<input type="hidden" class="Assumlocation" name="Assumlocation[]" value="'.utf8_encode(@$Sql_Result['Assumlocation']).'"><input type="hidden" class="AssumProject" name="AssumProject[]" value="'.utf8_encode(@$Sql_Result['AssumProject']).'"><input type="hidden" class="AssumptionId" name="AssumptionId[]" value="'.utf8_encode(@$Sql_Result['Id']).'"><input type="hidden" class="activeid" name="activeid[]" value="'.utf8_encode(@$Sql_Result['activeid']).'">';
    $resarr[] = '<div class="Assumproj" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['AssumProject']).'</div>';
      //$resarr[] = "";
    //  $resarr[] = utf8_encode(@$Sql_Result['Breedingtype']);


/*

$SQL="Select DISTINCT work from Farm_DRS_New_Labour_Workcode_DETAILS";
$Result_HR=sqlsrv_query($this->conn,$SQL);


$i = 0;

$Activitycode=array();


 while( $row = sqlsrv_fetch_array( $Result_HR )) {

$Activitycode[]=array('code'=>$row['work']);
//$Project_Code_value[]=array();

}


$Activity_selectbox='';


$Activity_selectbox.=  '<select class="js-example-basic-single dt-select2 form-control Activitytype"    name="Activitytype[]"  style="width: 150px !important;" > <option value=""> SELECT   </option>';

foreach ($Activitycode as $key => $value) {

///$selectedLWC=@$Sql_Result['Project_Code']==$value['Project_Value'] ? 'selected' :'';


$Activity_selectbox.= ' <option  value='.$value['code'].' >'.$value['code'].' </option>';

}


$Activity_selectbox.= '</select>';

$resarr[]=$Activity_selectbox;


*/
$resarr[] = utf8_encode(@$Sql_Result['BreedingActivity']).'<input type="hidden" class="BreedingActivity" name="BreedingActivity[]" value="'.utf8_encode(@$Sql_Result['BreedingActivity']).'">';


$resarr[]=" <input type='number' id='example-input-small'  class='form-control form-control-sm count_num' data-gender='male' placeholder='count' name='malecount[]'  style='width: 50px;' value='".utf8_encode(@$Sql_Result['malecount'])."'>"; 
$resarr[]="<input type='number' id='example-input-small'  class='form-control form-control-sm count_num' data-gender='female' placeholder='count' name='femalecount[]'  style='width: 50px;' value='".utf8_encode(@$Sql_Result['femalecount'])."'>"; 









$resultarr[] = $resarr;
$i++;
}
$res=array();
if(isset($User_Input['draw']))
{
  $res['draw'] = @$User_Input['draw'];  
}else
{
  $res['draw'] = 1; 
}
$res['recordsFiltered'] = @$recordsTotal;
$res['recordsTotal'] = @$recordsTotal;
$res['data'] = @$resultarr;
$res['sql'] = @$Sql;
$result = $res;
return $result;
}


public function Finalsubmittiondetails($data)
{

    //echo "<pre>";print_r($data);exit;
//
   // $passing_id_proj = $_REQUEST['passing_id_proj'];

   // echo "<pre>";print_r($passing_id_proj);
  //  exit; 


  $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
  $Dcode=@$_SESSION['Dcode'];
  $CreatedAt=date('Y-m-d H:i:s');
  $Created_date=date('Y-m-d');
  $CurrentStatus="1";
  $RejectionStatus="1";

  
    $status=0;  

   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);

  $sql = "SELECT COUNT(*) as Acreage_entered_count,(SELECT COUNT(*) FROM BreedingAdmin_Type where BreedingAdmin_Type.CreatedBy = '".$CreatedBy."' and BreedingAdmin_Type.Currentstatus = '1' and BreedingAdmin_Type.Rejectionstatus IS NULL) as total from BreedingAdmin_Type  
    inner join BreedingAdmin_MonthwiseDetails on BreedingAdmin_Type.Id = BreedingAdmin_MonthwiseDetails.Breed_id and BreedingAdmin_MonthwiseDetails.type = 'Sowing'
    where BreedingAdmin_Type.CreatedBy = '".$CreatedBy."' and BreedingAdmin_Type.Currentstatus = '1' and BreedingAdmin_Type.Rejectionstatus IS NULL";
    $Sql_Connection  =  sqlsrv_query($this->conn,$sql);
    $result  = sqlsrv_fetch_array($Sql_Connection);
    if($result['Acreage_entered_count'] != $result['total']) {
      $status = 0;  
    } else {
          // $autonum=@$data['autonum'];

      if($CreatedBy !=''){

        $i=0;
        foreach(@$data['allpassing_id'] as $key=>$value)
        {

          $passing_id_loc=@$data['passing_id_loc'][$key];
          $allpassing_id=@$data['allpassing_id'][$key];
          $passing_id_proj=@$data['passing_id_proj'][$key];

          $SQL="UPDATE  BreedingAdmin_Type SET CurrentStatus='2',finalsubmitat='$CreatedAt'  Where id='$allpassing_id' ";
          $Result=sqlsrv_query($this->conn,$SQL);

          $status=1;     

        }




        foreach(@$data['passing_id_loc'] as $key=>$value)
        {

          $passing_id_loc=@$data['passing_id_loc'][$key];
          $Responsible_person=@$data['Responsible_person'][$key];

          $acragevaluemain=@$data['acragevaluemain'][$key];   

          $SQL="UPDATE  BreedingAdmin_Location SET CurrentStatus='2',finalsubmitat='$CreatedAt',responsible_person='$Responsible_person',totalacreage='$acragevaluemain'  Where id='$passing_id_loc' ";
          $Result=sqlsrv_query($this->conn,$SQL);

          $status=1;     

        }




        foreach(@$data['passing_id_proj'] as $key=>$value)
        {

          $passing_id_proj=@$data['passing_id_proj'][$key];

          $SQL="UPDATE  BreedingAdmin_Project SET CurrentStatus='2',finalsubmitat='$CreatedAt'  Where id='$passing_id_proj' ";
          $Result=sqlsrv_query($this->conn,$SQL);

          $status=1;     


        }


      }else{

        $status=0;


      }
    } 




    return array('Status'=>$status);
  }






//   public function AssumptionEnrty_malefemaleamount($User_Input=array())
//   {


//     $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
//     $Length=@$User_Input['length'];
//     $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
//     $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

//     $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

// //  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//     $Dcode=$_SESSION['Dcode'];
//     $sno=$Offset+1;
//     $recordsTotal=0;
//     $resultarr=array();
//     $i=0;
//     // $Sql="Exec BreedingAdmin_Assumption_Datatable_MaleFemale @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
//     $Sql = "SELECT *,COUNT(*) OVER() as TOTALROW FROM BreedingAdmin_Monthwise_amount WHERE CreatedBy = '".$_SESSION['EmpID']."' AND Currentstatus = '1' ORDER BY Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY"; 
//     $Sql_Connection =sqlsrv_query($this->conn,$Sql);
//     while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
//     {
//       $recordsTotal = @$Sql_Result['TOTALROW'];
//       $resarr = array();
//      // $resarr[] = $sno++;
//       $resarr[] = "<input type='hidden' class='monthwise_amt_id' name='monthwise_amt_id[]' value='".$Sql_Result['Id']."'>".utf8_encode(@$Sql_Result['Location'])."<input type='hidden' id='example-input-small'  class='form-control form-control-sm assumlocationdata' placeholder='count' name='Assumlocation_month[]' style='width: 10px;' value='".utf8_encode(@$Sql_Result['Location'])."'>";


//       $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign month' data-monthtype='from' value='".$Sql_Result['Frommonth']."' name='Frommonth[]' style='width: 60px;'>"; 

//       $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign month' data-monthtype='to' value='".$Sql_Result['Tomonth']."' name='tomonth[]' style='width: 60px;'>"; 


//       $resarr[]="<input type='number'   class='form-control form-control-sm amount' data-gender='male' name='maleamount[]' value='".$Sql_Result['MaleAmount']."' style='width: 60px;'>"; 


//       $resarr[]="<input type='number'   class='form-control form-control-sm amount' data-gender='female' name='femaleamount[]' value='".$Sql_Result['FemaleAmount']."' style='width: 60px;'>"; 


//       $resultarr[] = $resarr;
//       $i++;
//     }
//     $res=array();
//     if(isset($User_Input['draw']))
//     {
//       $res['draw'] = @$User_Input['draw'];  
//     }else
//     {
//       $res['draw'] = 1; 
//     }
//     $res['recordsFiltered'] = @$recordsTotal;
//     $res['recordsTotal'] = @$recordsTotal;
//     $res['data'] = @$resultarr;
//     $res['sql'] = @$Sql;
//     $result = $res;
//     return $result;
//   }

   public function AssumptionEnrty_malefemaleamount($User_Input=array())
  {

   $location = @$User_Input['user_input'] !='' ? @$User_Input['user_input'] : 0;
    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;

    $CreatedBy=@$_SESSION['EmpID'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');

    if($location!='')
    {
      foreach($location as $val)
      {
        $Sql12 = "SELECT Location,Id FROM BreedingAdmin_Monthwise_amount WHERE Location='".$val."'";

        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $exec =sqlsrv_query($this->conn,$Sql12,$params,$options);

        if ($exec === false) {
          die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
        }
        $cnt = sqlsrv_num_rows($exec);

           // echo $count;
           // exit;

        if($cnt==0)
        {
           $SQL1="INSERT INTO  BreedingAdmin_Monthwise_amount(Docid,Ordernum,Location,Frommonth,Tomonth,MaleAmount,FemaleAmount,CreatedBy,CreatedAt,CurrentStatus) VALUES('0','0','".$val."','0','0','0','0','".$CreatedBy."','".$CreatedAt."',1)";

          //$SQL1="INSERT INTO  BreedingAdmin_Monthwise_amount(Location,CreatedBy,CreatedAt) VALUES('".$val."','".$CreatedBy."','".$CreatedAt."')";

             // echo $SQL1;
             // exit;


           $Result1=sqlsrv_query($this->conn,$SQL1);
        }
      }
    }

    // $Sql="Exec BreedingAdmin_Assumption_Datatable_MaleFemale @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql = "SELECT *,COUNT(*) OVER() as TOTALROW FROM BreedingAdmin_Monthwise_amount WHERE CreatedBy = '".$_SESSION['EmpID']."' AND Currentstatus = '1' ORDER BY Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY"; 
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = "<input type='hidden' class='monthwise_amt_id' name='monthwise_amt_id[]' value='".$Sql_Result['Id']."'>".utf8_encode(@$Sql_Result['Location'])."<input type='hidden' id='example-input-small'  class='form-control form-control-sm assumlocationdata' placeholder='count' name='Assumlocation_month[]' style='width: 10px;' value='".utf8_encode(@$Sql_Result['Location'])."'>";


      $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign month' data-monthtype='from' value='".$Sql_Result['Frommonth']."' name='Frommonth[]' style='width: 60px;'>"; 

      $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign month' data-monthtype='to' value='".$Sql_Result['Tomonth']."' name='tomonth[]' style='width: 60px;'>"; 


      $resarr[]="<input type='number'   class='form-control form-control-sm amount' data-gender='male' name='maleamount[]' value='".$Sql_Result['MaleAmount']."' style='width: 60px;'>"; 


      $resarr[]="<input type='number'   class='form-control form-control-sm amount' data-gender='female' name='femaleamount[]' value='".$Sql_Result['FemaleAmount']."' style='width: 60px;'>";

      //$resarr[]="<button class='btn btn-primary btn-sm add_activity_amount'>Edit</button>"; 








      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }






  public function FinalsubmittionAssumption($data)
  {

  // echo "<pre>";print_r($data);

   // $passing_id_proj = $_REQUEST['passing_id_proj'];

   // echo "<pre>";print_r($passing_id_proj);
    exit; 


    $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
    $Dcode=@$_SESSION['Dcode'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');
    $CurrentStatus="1";
    $RejectionStatus="1";



   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);


    $status=0;  
    // $autonum=@$data['autonum'];


    if($CreatedBy !=''){


      $i=0;
      foreach(@$data['allpassing_id'] as $key=>$value)
      {

      //$location_val=@$data['location'][$key];
        $passing_id_loc=@$data['passing_id_loc'][$key];
        $allpassing_id=@$data['allpassing_id'][$key];
        $passing_id_proj=@$data['passing_id_proj'][$key];


 //$location_val=@$data['location'];


        $SQL="UPDATE  BreedingAdmin_Type SET CurrentStatus='2',finalsubmitat='$CreatedAt'  Where id='$allpassing_id' ";
        $Result=sqlsrv_query($this->conn,$SQL);





        $status=1;     


      }




      foreach(@$data['passing_id_loc'] as $key=>$value)
      {

      //$location_val=@$data['location'][$key];
        $passing_id_loc=@$data['passing_id_loc'][$key];
        $Responsible_person=@$data['Responsible_person'][$key];


 //$location_val=@$data['location'];


        $SQL="UPDATE  BreedingAdmin_Location SET CurrentStatus='2',finalsubmitat='$CreatedAt',responsible_person='$Responsible_person'  Where id='$passing_id_loc' ";
        $Result=sqlsrv_query($this->conn,$SQL);





        $status=1;     


      }




      foreach(@$data['passing_id_proj'] as $key=>$value)
      {

      //$location_val=@$data['location'][$key];
        $passing_id_proj=@$data['passing_id_proj'][$key];



 //$location_val=@$data['location'];


        $SQL="UPDATE  BreedingAdmin_Project SET CurrentStatus='2',finalsubmitat='$CreatedAt'  Where id='$passing_id_proj' ";
        $Result=sqlsrv_query($this->conn,$SQL);





        $status=1;     


      }

//$i_project = 0;





    }else{

      $status=0;


    }





//  exit;
    return array('Status'=>$status);
  }





  public function singlemalefemale($data)
  {

   // echo "<pre>";print_r($data);
   // exit; 


    $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
    $Dcode=@$_SESSION['Dcode'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');
    $CurrentStatus="1";
    $RejectionStatus="1";



   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);


    $status=0;  
    // $autonum=@$data['autonum'];


    if($CreatedBy !=''){


      $i=0;

      // $sql="INSERT INTO BreedingAdmin_Monthwise_amount(Docid,Ordernum,Location,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES(1,0,'".$data['location']."','".$CreatedBy."','".$CreatedAt."','1')";

      //   $Result=sqlsrv_query($this->conn,$sql);

      foreach(@$data['project'] as $key=>$value)
      {

      //$location_val=@$data['location'][$key];
        $Project_val=@$data['project'][$key];

        $WorkActivity=@$data['WorkActivity'][$key];


        $location_val=@$data['location'];



        $SQL1="INSERT INTO  BreedingAdmin_Assumption(Ordernum,AssumLocation,AssumProject,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$i."','".$location_val."','".$Project_val."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','2')";
         $Result=sqlsrv_query($this->conn,$SQL1);

         $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);





         $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];


         foreach(@$data['WorkActivity'] as $key=>$value)
         {

          $WorkActivity=@$data['WorkActivity'][$key];

          $malecount=@$data['malecount'];
          $femalecount=@$data['femalecount'];


          $SQL1="INSERT INTO  BreedingAdmin_Activity(Docid,Ordernum,BreedingActivity,ReqDate,CreatedBy,CreatedAt,CurrentStatus,malecount,femalecount)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$i."','".$WorkActivity."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','2','".$malecount."','".$femalecount."')";
           $Result=sqlsrv_query($this->conn,$SQL1);

           $status=1;  

         }






       }

//$i_project = 0;





     }else{

      $status=0;


    }





//  exit;
    return array('Status'=>$status);
  }




  public function Fieldexpensedataform($data)
  {

    //echo "<pre>";print_r($data);
    //exit; 


    $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
    $Dcode=@$_SESSION['Dcode'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');
    $CurrentStatus="1";
    $RejectionStatus="1";



   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);


    $status=0;  
    // $autonum=@$data['autonum'];


    if($CreatedBy !=''){


      $i=0;
      foreach(@$data['project'] as $key=>$value)
      {

      //$location_val=@$data['location'][$key];
        $Project_val=@$data['project'][$key];

        $WorkActivity=@$data['WorkActivity'][$key];


        $location_val=@$data['location'];


        $SQL1="INSERT INTO  BreedingAdmin_FieldExp(Ordernum,AssumLocation,AssumProject,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$i."','".$location_val."','".$Project_val."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
         $Result=sqlsrv_query($this->conn,$SQL1);

         $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);





         $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];


         foreach(@$data['WorkActivity'] as $key=>$value)
         {

          $WorkActivity=@$data['WorkActivity'][$key];




          $SQL1="INSERT INTO  BreedingAdmin_FieldExpActivity(Docid,Ordernum,BreedingActivity,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$i."','".$WorkActivity."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
           $Result=sqlsrv_query($this->conn,$SQL1);

           $status=1;  













           $status=1;   



         }






       }

//$i_project = 0;





     }else{

      $status=0;


    }





//  exit;
    return array('Status'=>$status);
  }


  public function FiledExpensesEnrty($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $Sql="Exec BreedingAdmin_FieldExpense_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['BreedingLocation']).'<input type="hidden" class="Assumlocation" name="Assumlocation[]" value="'.utf8_encode(@$Sql_Result['BreedingLocation']).'">';
      $resarr[] = utf8_encode(@$Sql_Result['Project']).'<input type="hidden" class="AssumProject" name="AssumProject[]" value="'.utf8_encode(@$Sql_Result['Project']).'">';
      //$resarr[] = "";
    //  $resarr[] = utf8_encode(@$Sql_Result['Breedingtype']);


      $resarr[] = utf8_encode(@$Sql_Result['BreedingActivity']).'<input type="hidden" class="BreedingActivity" name="BreedingActivity[]" value="'.utf8_encode(@$Sql_Result['BreedingActivity']).'">';

      $resarr[] = utf8_encode(@$Sql_Result['type']);





      $sql_month="SELECT TOTALROW = count(*) OVER(),BreedingLocation,Project

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Jun is Not Null then (cast(ISNULL(NULLIF(Jun, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As JUn_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Jun is Not Null then (cast(ISNULL(NULLIF(Jun, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Jun_femalevalue



      ,SUM(case when BreedingAdmin_MonthwiseDetails.Jul is Not Null then (cast(ISNULL(NULLIF(JUL, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Jul_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Jul is Not Null then (cast(ISNULL(NULLIF(JUL, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Jul_femalevalue





      ,SUM(case when BreedingAdmin_MonthwiseDetails.Aug is Not Null then (cast(ISNULL(NULLIF(Aug, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Aug_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Aug is Not Null then (cast(ISNULL(NULLIF(Aug, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Aug_femalevalue



      ,SUM(case when BreedingAdmin_MonthwiseDetails.Sep is Not Null then (cast(ISNULL(NULLIF(Sep, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Sep_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Sep is Not Null then (cast(ISNULL(NULLIF(Sep, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Sep_femalevalue


      ,SUM(case when BreedingAdmin_MonthwiseDetails.Oct is Not Null then (cast(ISNULL(NULLIF(Oct, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Oct_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Sep is Not Null then (cast(ISNULL(NULLIF(Oct, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Oct_femalevalue



      ,SUM(case when BreedingAdmin_MonthwiseDetails.Nov is Not Null then (cast(ISNULL(NULLIF(Nov, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Nov_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Nov is Not Null then (cast(ISNULL(NULLIF(Nov, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Nov_femalevalue





      ,SUM(case when BreedingAdmin_MonthwiseDetails.Dec is Not Null then (cast(ISNULL(NULLIF(Dec, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Dec_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Dec is Not Null then (cast(ISNULL(NULLIF(Dec, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Dec_femalevalue


      ,SUM(case when BreedingAdmin_MonthwiseDetails.Jan is Not Null then (cast(ISNULL(NULLIF(Jan, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Jan_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Jan is Not Null then (cast(ISNULL(NULLIF(Jan, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Jan_femalevalue



      ,SUM(case when BreedingAdmin_MonthwiseDetails.Feb is Not Null then (cast(ISNULL(NULLIF(Feb, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Feb_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Feb is Not Null then (cast(ISNULL(NULLIF(Feb, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Feb_femalevalue



      ,SUM(case when BreedingAdmin_MonthwiseDetails.Mar is Not Null then (cast(ISNULL(NULLIF(Mar, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Mar_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Mar is Not Null then (cast(ISNULL(NULLIF(Mar, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Mar_femalevalue


      ,SUM(case when BreedingAdmin_MonthwiseDetails.Apr is Not Null then (cast(ISNULL(NULLIF(Apr, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As Apr_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.Apr is Not Null then (cast(ISNULL(NULLIF(Apr, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As Apr_femalevalue



      ,SUM(case when BreedingAdmin_MonthwiseDetails.May is Not Null then (cast(ISNULL(NULLIF(May, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.malecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.maleamount AS DECIMAL(18,2)) ) else 0 end)As May_Male_value

      ,SUM(case when BreedingAdmin_MonthwiseDetails.May is Not Null then (cast(ISNULL(NULLIF(May, ''),0) AS DECIMAL(18,2)) * cast(BreedingAdmin_Activity.femalecount AS DECIMAL(18,2)) * cast(BreedingAdmin_Monthwise_amount.femaleamount AS DECIMAL(18,2)) ) else 0 end)As May_femalevalue





      ,BreedingAdmin_Activity.malecount,BreedingAdmin_Activity.femalecount    from BreedingAdmin_Type

      Inner Join BreedingAdmin_location On BreedingAdmin_location.Docid=BreedingAdmin_Type.id
      Inner Join BreedingAdmin_project On BreedingAdmin_project.Docid=BreedingAdmin_Type.id AND BreedingAdmin_project.ordernum=BreedingAdmin_location.ordernum

      Inner Join (Select * from BreedingAdmin_MonthwiseDetails Where type='Sowing')BreedingAdmin_MonthwiseDetails On BreedingAdmin_MonthwiseDetails.Breed_id=BreedingAdmin_Type.id and BreedingAdmin_MonthwiseDetails.Loc_id=BreedingAdmin_location.Id and BreedingAdmin_MonthwiseDetails.Proj_id=BreedingAdmin_project.Id

      Inner Join (Select * from BreedingAdmin_Assumption )BreedingAdmin_Assumption On BreedingAdmin_Assumption.AssumLocation=BreedingAdmin_location.BreedingLocation 
      And BreedingAdmin_Assumption.AssumProject=BreedingAdmin_project.Project

      Inner Join BreedingAdmin_Activity On BreedingAdmin_Activity.Docid=BreedingAdmin_Assumption.Id


      Inner Join BreedingAdmin_Monthwise_amount On BreedingAdmin_Monthwise_amount.Location=BreedingAdmin_Assumption.AssumLocation

      Where 1=1 and BreedingAdmin_Type.Currentstatus='2' AND BreedingAdmin_location.RejectionStatus is NULL AND BreedingAdmin_location.BreedingLocation='".utf8_encode(@$Sql_Result['BreedingLocation'])."'  and BreedingAdmin_project.Project='".utf8_encode(@$Sql_Result['Project'])."'


      Group By BreedingLocation,Project,BreedingAdmin_MonthwiseDetails.Jun,BreedingAdmin_Activity.malecount,BreedingAdmin_Activity.femalecount,BreedingAdmin_Monthwise_amount.maleamount,BreedingAdmin_Monthwise_amount.femaleamount ";


      $stmt = sqlsrv_query($this->conn, $sql_month);
      $month_data = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
      $Jun_month_malevalue = $month_data['JUn_Male_value'];
      $Jun_month_Femalevalue = $month_data['Jun_femalevalue'];

      $JuL_month_malevalue = $month_data['Jul_Male_value'];
      $JuL_month_Femalevalue = $month_data['Jul_femalevalue'];

      $Aug_month_malevalue = $month_data['Aug_Male_value'];
      $Aug_month_Femalevalue = $month_data['Aug_femalevalue'];

      $Sep_month_malevalue = $month_data['Sep_Male_value'];
      $Sep_month_Femalevalue = $month_data['Sep_femalevalue'];

      $Oct_month_malevalue = $month_data['Oct_Male_value'];
      $Oct_month_Femalevalue = $month_data['Oct_femalevalue'];

      $Nov_month_malevalue = $month_data['Nov_Male_value'];
      $Nov_month_Femalevalue = $month_data['Nov_femalevalue'];



      $Dec_month_malevalue = $month_data['Dec_Male_value'];
      $Dec_month_Femalevalue = $month_data['Dec_femalevalue'];

      $Jan_month_malevalue = $month_data['Jan_Male_value'];
      $Jan_month_Femalevalue = $month_data['Jan_femalevalue'];

      $Feb_month_malevalue = $month_data['Feb_Male_value'];
      $Feb_month_Femalevalue = $month_data['Feb_femalevalue'];

      $Mar_month_malevalue = $month_data['Mar_Male_value'];
      $Mar_month_Femalevalue = $month_data['Mar_femalevalue'];

      $Apr_month_malevalue = $month_data['Apr_Male_value'];
      $Apr_month_Femalevalue = $month_data['Apr_femalevalue'];

      $May_month_malevalue = $month_data['May_Male_value'];
      $May_month_Femalevalue = $month_data['May_femalevalue'];
      $malecount = $month_data['malecount'];
      $femalecount = $month_data['femalecount'];







      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Jun_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($JuL_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Aug_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Sep_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Oct_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Nov_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Dec_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Jan_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Feb_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Mar_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($Apr_month_malevalue).' style="width:50px">';
      $resarr[] ='<input type="text" class="monthinputbox" name="jun_value[]" value='.round($May_month_malevalue).' style="width:50px">';











      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }

  //Divya

  public function finalmalefemaleamountdata($data)
  {

    //echo "<pre>";print_r($data);exit;

   // $passing_id_proj = $_REQUEST['passing_id_proj'];

   // echo "<pre>";print_r($passing_id_proj);
  // exit; 


    $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
    $Dcode=@$_SESSION['Dcode'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');
    $CurrentStatus="1";
    $RejectionStatus="1";



   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);


    $status=0;  
//     // $autonum=@$data['autonum'];
//     $sql ="SELECT COUNT(*) as malefemale_entered_count,(SELECT COUNT(*) from BreedingAdmin_Assumption 
//       inner join BreedingAdmin_Activity on BreedingAdmin_Activity.Docid = BreedingAdmin_Assumption.Id
//       where BreedingAdmin_Assumption.CreatedBy = '".$CreatedBy."' and BreedingAdmin_Assumption.Currentstatus = '1' and BreedingAdmin_Assumption.Rejectionstatus IS NULL) as total_assumption FROM BreedingAdmin_Assumption 
//       inner join BreedingAdmin_Activity on BreedingAdmin_Activity.Docid = BreedingAdmin_Assumption.Id
//       where BreedingAdmin_Assumption.CreatedBy = '".$CreatedBy."' and BreedingAdmin_Assumption.Currentstatus = '1' and BreedingAdmin_Assumption.Rejectionstatus IS NULL and malecount IS NOT NULL and femalecount IS NOT NULL and BreedingAdmin_Activity.malecount != '' and BreedingAdmin_Activity.femalecount IS NOT NULL and BreedingAdmin_Activity.femalecount != ''";

//       $Sql_Connection  =  sqlsrv_query($this->conn,$sql);
//       $result  = sqlsrv_fetch_array($Sql_Connection);

//       $sql2 = "SELECT COUNT(*) as Monthwise_amount_entered,(SELECT COUNT(*) from BreedingAdmin_Monthwise_amount where CreatedBy = '".$CreatedBy."') as total from BreedingAdmin_Monthwise_amount where CreatedBy = '".$CreatedBy."' and Frommonth IS NOT NULL and Frommonth != ''
//         and Tomonth IS NOT NULL and Tomonth != '' and MaleAmount IS NOT NULL and FemaleAmount IS NOT NULL";
//       $Sql_Connection  =  sqlsrv_query($this->conn,$sql2);
//       $second_result  = sqlsrv_fetch_array($Sql_Connection);

//       if(($result['malefemale_entered_count'] != $result['total_assumption']) || ($second_result['Monthwise_amount_entered'] != $second_result['total'])) {
//         $status = 0;  
//       } else {

//         if($CreatedBy !=''){


//           $i=0;
//           foreach(@$data['AssumptionId'] as $key=>$value)
//           {

//       //$location_val=@$data['location'][$key];
//             $AssumptionId=@$data['AssumptionId'][$key];



//             $SQL="UPDATE  BreedingAdmin_Assumption SET CurrentStatus='2'  Where id='$AssumptionId' ";
//             $Result=sqlsrv_query($this->conn,$SQL);





//             $status=1;     


//           }




//           foreach(@$data['BreedingActivity'] as $key=>$value)
//           {

//       //$location_val=@$data['location'][$key];
//             $BreedingActivity=@$data['BreedingActivity'][$key];
//             $AssumptionId=@$data['activeid'][$key];
//             $malecount=@$data['malecount'][$key];
//             $femalecount=@$data['femalecount'][$key];


// ///$Responsible_person=@$data['Responsible_person'][$key];


//             $SQL="UPDATE  BreedingAdmin_Activity SET CurrentStatus='2',malecount='$malecount',femalecount='$femalecount' Where id='$AssumptionId' ";
//             $Result=sqlsrv_query($this->conn,$SQL);





//             $status=1;     


//           }




 //          foreach(@$data['Assumlocation_month'] as $key=>$value)
 //          {

 //      //$location_val=@$data['location'][$key];
 //            $Assumlocation_month=@$data['Assumlocation_month'][$key];
 //            $Frommonth=@$data['Frommonth'][$key];
 //            $tomonth=@$data['tomonth'][$key];
 //            $maleamount=@$data['maleamount'][$key];
 //            $femaleamount=@$data['femaleamount'][$key];





 // //$location_val=@$data['location'];

 //            $SQL1="INSERT INTO  BreedingAdmin_Monthwise_amount(Docid,Ordernum,Location,Frommonth,Tomonth,MaleAmount,FemaleAmount,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES(1,'".$i."','".$Assumlocation_month."','".$Frommonth."','".$tomonth."','".$maleamount."','".$femaleamount."','".$CreatedBy."','".$CreatedAt."','1')";

 //              $Result=sqlsrv_query($this->conn,$SQL1);





 //              $status=1;     


 //            }

          foreach ($data['monthwise_amt_id'] as $key => $value) {

            $SQL1="UPDATE BreedingAdmin_Monthwise_amount SET CurrentStatus = '2' WHERE Id = '".$value."'";

              $Result=sqlsrv_query($this->conn,$SQL1);

              $status=1; 
          }




          // }else{

          //   $status=0;


          // }

        //}





//  exit;
      return array('Status'=>$status);
    }





  public function finalassumptiondata($data)
  {

   // echo "<pre>";print_r($data);exit;

   // $passing_id_proj = $_REQUEST['passing_id_proj'];

   // echo "<pre>";print_r($passing_id_proj);
  // exit; 


    $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
    $Dcode=@$_SESSION['Dcode'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');
    $CurrentStatus="1";
    $RejectionStatus="1";



   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);


    $status=0;  
    // $autonum=@$data['autonum'];
    $sql ="SELECT COUNT(*) as malefemale_entered_count,(SELECT COUNT(*) from BreedingAdmin_Assumption 
      inner join BreedingAdmin_Activity on BreedingAdmin_Activity.Docid = BreedingAdmin_Assumption.Id
      where BreedingAdmin_Assumption.CreatedBy = '".$CreatedBy."' and BreedingAdmin_Assumption.Currentstatus = '1' and BreedingAdmin_Assumption.Rejectionstatus IS NULL) as total_assumption FROM BreedingAdmin_Assumption 
      inner join BreedingAdmin_Activity on BreedingAdmin_Activity.Docid = BreedingAdmin_Assumption.Id
      where BreedingAdmin_Assumption.CreatedBy = '".$CreatedBy."' and BreedingAdmin_Assumption.Currentstatus = '1' and BreedingAdmin_Assumption.Rejectionstatus IS NULL and malecount IS NOT NULL and femalecount IS NOT NULL and BreedingAdmin_Activity.malecount != '' and BreedingAdmin_Activity.femalecount IS NOT NULL and BreedingAdmin_Activity.femalecount != ''";

      $Sql_Connection  =  sqlsrv_query($this->conn,$sql);
      $result  = sqlsrv_fetch_array($Sql_Connection);

      // $sql2 = "SELECT COUNT(*) as Monthwise_amount_entered,(SELECT COUNT(*) from BreedingAdmin_Monthwise_amount where CreatedBy = '".$CreatedBy."') as total from BreedingAdmin_Monthwise_amount where CreatedBy = '".$CreatedBy."' and Frommonth IS NOT NULL and Frommonth != ''
      //   and Tomonth IS NOT NULL and Tomonth != '' and MaleAmount IS NOT NULL and FemaleAmount IS NOT NULL";
      // $Sql_Connection  =  sqlsrv_query($this->conn,$sql2);
      // $second_result  = sqlsrv_fetch_array($Sql_Connection);

      if(($result['malefemale_entered_count'] != $result['total_assumption'])) {
        $status = 0;  
      } else {

        if($CreatedBy !=''){


          $i=0;
          foreach(@$data['AssumptionId'] as $key=>$value)
          {

      //$location_val=@$data['location'][$key];
            $AssumptionId=@$data['AssumptionId'][$key];



            $SQL="UPDATE  BreedingAdmin_Assumption SET CurrentStatus='2'  Where id='$AssumptionId' ";
            $Result=sqlsrv_query($this->conn,$SQL);





            $status=1;     


          }




          foreach(@$data['BreedingActivity'] as $key=>$value)
          {

      //$location_val=@$data['location'][$key];
            $BreedingActivity=@$data['BreedingActivity'][$key];
            $AssumptionId=@$data['activeid'][$key];
            $malecount=@$data['malecount'][$key];
            $femalecount=@$data['femalecount'][$key];


///$Responsible_person=@$data['Responsible_person'][$key];


            $SQL="UPDATE  BreedingAdmin_Activity SET CurrentStatus='2',malecount='$malecount',femalecount='$femalecount' Where id='$AssumptionId' ";
            $Result=sqlsrv_query($this->conn,$SQL);





            $status=1;     


          }




 //          foreach(@$data['Assumlocation_month'] as $key=>$value)
 //          {

 //      //$location_val=@$data['location'][$key];
 //            $Assumlocation_month=@$data['Assumlocation_month'][$key];
 //            $Frommonth=@$data['Frommonth'][$key];
 //            $tomonth=@$data['tomonth'][$key];
 //            $maleamount=@$data['maleamount'][$key];
 //            $femaleamount=@$data['femaleamount'][$key];





 // //$location_val=@$data['location'];

 //            $SQL1="INSERT INTO  BreedingAdmin_Monthwise_amount(Docid,Ordernum,Location,Frommonth,Tomonth,MaleAmount,FemaleAmount,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES(1,'".$i."','".$Assumlocation_month."','".$Frommonth."','".$tomonth."','".$maleamount."','".$femaleamount."','".$CreatedBy."','".$CreatedAt."','1')";

 //              $Result=sqlsrv_query($this->conn,$SQL1);





 //              $status=1;     


 //            }

          // foreach ($data['monthwise_amt_id'] as $key => $value) {

          //   $SQL1="UPDATE BreedingAdmin_Monthwise_amount SET CurrentStatus = '2' WHERE Id = '".$value."'";

          //     $Result=sqlsrv_query($this->conn,$SQL1);

          //     $status=1; 
          // }




          }else{

            $status=0;


          }

        }





//  exit;
      return array('Status'=>$status);
    }


 public function all_completed_project_acreage_completion_validation($Emp_Id,$autoid,$Offset,$Length)
 {
  $Sql="Exec BreedingAdmin_LocationWise_Datatable_Completed @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  $acrage_completed = 1;
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $recordsTotal = @$Sql_Result['TOTALROW'];
    $resarr = array();
    $resarr[] = utf8_encode(@$Sql_Result['Breedinglocation']);
    $resarr[] = utf8_encode(@$Sql_Result['Project']);
    $resarr[] = utf8_encode(@$Sql_Result['Breedingtype']);

    //total Acreage get
    $sql_month_acr="SELECT DISTINCT Total_acrage FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' AND Total_acrage !='' ";
    $stmt = sqlsrv_query($this->conn, $sql_month_acr);
    $month_data_acr = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

    // splited acreage is equal to total acreage validation 
    $sql_acrage="SELECT (CASE WHEN ISNULL(Jun, '') = '' THEN 0 ELSE CAST(Jun AS decimal(20,2)) END +
      CASE WHEN ISNULL(Jul, '') = '' THEN 0 ELSE CAST(Jul AS decimal(20,2)) END +
      CASE WHEN ISNULL(Aug, '') = '' THEN 0 ELSE CAST(Aug AS decimal(20,2)) END +
      CASE WHEN ISNULL(Sep, '') = '' THEN 0 ELSE CAST(Sep AS decimal(20,2)) END +
      CASE WHEN ISNULL(Oct, '') = '' THEN 0 ELSE CAST(Oct AS decimal(20,2)) END +
      CASE WHEN ISNULL(Nov, '') = '' THEN 0 ELSE CAST(Nov AS decimal(20,2)) END +
      CASE WHEN ISNULL(Dec, '') = '' THEN 0 ELSE CAST(Dec AS decimal(20,2)) END +
      CASE WHEN ISNULL(Jan, '') = '' THEN 0 ELSE CAST(Jan AS decimal(20,2)) END +
      CASE WHEN ISNULL(Feb, '') = '' THEN 0 ELSE CAST(Feb AS decimal(20,2)) END +
      CASE WHEN ISNULL(Mar, '') = '' THEN 0 ELSE CAST(Mar AS decimal(20,2)) END +
      CASE WHEN ISNULL(Apr, '') = '' THEN 0 ELSE CAST(Apr AS decimal(20,2)) END +
      CASE WHEN ISNULL(May, '') = '' THEN 0 ELSE CAST(May AS decimal(20,2)) END ) AS monthwise_count_details FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' AND type='Sowing'";
    $acg_stmt = sqlsrv_query($this->conn, $sql_acrage);
    $acrage_count = sqlsrv_fetch_array($acg_stmt,SQLSRV_FETCH_ASSOC);

    if($acrage_count['monthwise_count_details'] == '' || $acrage_count['monthwise_count_details'] == 0 || ($acrage_count['monthwise_count_details'] != $month_data_acr['Total_acrage'])) {
      $acrage_completed = 0;

    }
  }
  return $acrage_completed; 
}



    public function CompletedProjectWiseDetails($User_Input=array())
    {
      $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
      $Length=@$User_Input['length'];
      $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
      $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

      $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

       //total data acreage completion status validation functionality 
       $validate_res = $this->all_completed_project_acreage_completion_validation($Emp_Id,$autoid,0,50000);  

      $Dcode=$_SESSION['Dcode'];
      $sno=$Offset+1;
      $recordsTotal=0;
      $resultarr=array();
      $i=0;
      $Sql="Exec BreedingAdmin_LocationWise_Datatable_Completed @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
      $Sql_Connection =sqlsrv_query($this->conn,$Sql);
      $acrage_completed = true;
      while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
      {
        $recordsTotal = @$Sql_Result['TOTALROW'];
        $resarr = array();
        $resarr[] = $sno++;
        $resarr[] = utf8_encode(@$Sql_Result['Breedinglocation']);
        $resarr[] = utf8_encode(@$Sql_Result['Project']);
        $resarr[] = utf8_encode(@$Sql_Result['Breedingtype']);






        $sql_month="SELECT COUNT(*) as count FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' ";
        $stmt = sqlsrv_query($this->conn, $sql_month);
        $month_data = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);



        $sql_month_acr="SELECT DISTINCT Total_acrage FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' AND Total_acrage !='' ";
        $stmt = sqlsrv_query($this->conn, $sql_month_acr);
        $month_data_acr = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

        if($month_data['count']>0){

         $resarr[]  ='<input type="number" class="Acrage acragevaluemain" name=acragevaluemain[] value="'.$month_data_acr['Total_acrage'] .'" style="width: 78px;background-color:#5dd099;color:white" readonly>';

       }else{

         $resarr[]  ='<input type="number" class="Acrage acragevaluemain" name=acragevaluemain[] value="'.$month_data_acr['Total_acrage'] .'" style="width: 78px;" >';


       }

       if($month_data['count']>0){
        $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-info View_Month_wise_popup_Completed' >View</button><input type='hidden' class='passing_id_loc' value='".@$Sql_Result['passing_id_loc']."' name=passing_id_loc[]><input type='hidden' class='passing_id_proj' value='".@$Sql_Result['passing_id_proj']."' name=passing_id_proj[]><input type='hidden' class='allpassing_id' value='".@$Sql_Result['passing_id']."' name=allpassing_id[] >";


      }else{

        $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-primary Add_Month_wise_popup' >Add</button><input type='hidden' class='passing_id_loc' value='".@$Sql_Result['passing_id_loc']."' name=passing_id_loc[]><input type='hidden' class='passing_id_proj' value='".@$Sql_Result['passing_id_proj']."' name=passing_id_proj[]><input type='hidden' class='allpassing_id' value='".@$Sql_Result['passing_id']."' name=allpassing_id[] >";
      }






      $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-info Add_landblock_popup' >Add</button>";





      $SQL="SELECT DISTINCT Employee_name,Employee_Code,Department FROM HR_Master_Table  Where Employee_Code IS NOT NULL AND Employment_Status='Active'";
      $Result_HR=sqlsrv_query($this->conn,$SQL);


      $i = 0;

      $Divition_Crop_Id=array();


      while( $row = sqlsrv_fetch_array( $Result_HR )) {

        $Divition_Crop_Id[]=array('code'=>$row['Employee_Code'],'Employee_name'=>$row['Employee_name'],'Department'=>$row['Department']);
//$Project_Code_value[]=array();

      }


      $ProjectWorkCode_selectbox='';


      $ProjectWorkCode_selectbox.=  '<select class="select2 form-control mb-3 custom-select Responsible_person dt-select2"    name="Responsible_person[]"  style="width: 150px !important;" > <option value=""> SELECT   </option>';

      foreach ($Divition_Crop_Id as $key => $value) {

        $selectedLWC=@$Sql_Result['responsible_person']==$value['code'] ? 'selected' :'';


        $ProjectWorkCode_selectbox.= ' <option '.$selectedLWC.' value='.$value['code'].' $selectedLWC>'.$value['code'].'-'.$value['Employee_name'].'-'.$value['Department'].'  </option>';

      }


      $ProjectWorkCode_selectbox.= '</select>';

      $resarr[]=$ProjectWorkCode_selectbox;





      // $resarr[]='<button type="button" class="btn btn-sm btn-success editbutton"><i class="fas fa-edit"></i></button>
      // <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>  '; 
    // Acrage is equal to monthwise entered acrage validation check 
    $sql_acrage="SELECT (CASE WHEN ISNULL(Jun, '') = '' THEN 0 ELSE CAST(Jun AS decimal(20,2)) END +
      CASE WHEN ISNULL(Jul, '') = '' THEN 0 ELSE CAST(Jul AS decimal(20,2)) END +
      CASE WHEN ISNULL(Aug, '') = '' THEN 0 ELSE CAST(Aug AS decimal(20,2)) END +
      CASE WHEN ISNULL(Sep, '') = '' THEN 0 ELSE CAST(Sep AS decimal(20,2)) END +
      CASE WHEN ISNULL(Oct, '') = '' THEN 0 ELSE CAST(Oct AS decimal(20,2)) END +
      CASE WHEN ISNULL(Nov, '') = '' THEN 0 ELSE CAST(Nov AS decimal(20,2)) END +
      CASE WHEN ISNULL(Dec, '') = '' THEN 0 ELSE CAST(Dec AS decimal(20,2)) END +
      CASE WHEN ISNULL(Jan, '') = '' THEN 0 ELSE CAST(Jan AS decimal(20,2)) END +
      CASE WHEN ISNULL(Feb, '') = '' THEN 0 ELSE CAST(Feb AS decimal(20,2)) END +
      CASE WHEN ISNULL(Mar, '') = '' THEN 0 ELSE CAST(Mar AS decimal(20,2)) END +
      CASE WHEN ISNULL(Apr, '') = '' THEN 0 ELSE CAST(Apr AS decimal(20,2)) END +
      CASE WHEN ISNULL(May, '') = '' THEN 0 ELSE CAST(May AS decimal(20,2)) END ) AS monthwise_count_details FROM BreedingAdmin_MonthwiseDetails Where CreatedBy='" . @$_SESSION['EmpID']. "' AND Breed_id ='".@$Sql_Result['passing_id']."' AND Loc_id='".@$Sql_Result['passing_id_loc']."' AND Proj_id='".@$Sql_Result['passing_id_proj']."' AND type='Sowing'";
    $acg_stmt = sqlsrv_query($this->conn, $sql_acrage);
    $acrage_count = sqlsrv_fetch_array($acg_stmt,SQLSRV_FETCH_ASSOC);
    $completion_class = ($acrage_count['monthwise_count_details'] == '' && $acrage_count['monthwise_count_details'] == 0) ? 'failed' : (($acrage_count['monthwise_count_details'] != '' && $acrage_count['monthwise_count_details'] > 0 && ($acrage_count['monthwise_count_details'] == $month_data_acr['Total_acrage'])) ? 'success' : 'mismatch');
    if($completion_class == 'failed') {
      $acrage_completed = false;
      $resarr[]='<span title="Incompleted"><i class="fa fa-check-circle failed_completion" aria-hidden="true"></i></span>
      <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>';
    } elseif ($completion_class == 'success') {
       $resarr[]='<span title="Completed"><i class="fa fa-check-circle success_completion" aria-hidden="true"></i></span>
       <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>';
    } elseif($completion_class == 'mismatch') {
      $acrage_completed = false;
       $resarr[]='<span title="Mismatch"><i class="fa fa-check-circle mismatch_completion" aria-hidden="true"></i></span>
       <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>';
    }


      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;  
    // $res['acrage_completed_status'] = $acrage_completed;
    $res['acrage_completed_status'] = ($validate_res == 1) ? true : false;
    $result = $res;
    return $result;
  }






  public function AssumptionEnrtyCompleted($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';



    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $Sql="Exec BreedingAdmin_Assumption_Datatable_Completed @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['Assumlocation']).'<input type="hidden" class="Assumlocation" name="Assumlocation[]" value="'.utf8_encode(@$Sql_Result['Assumlocation']).'"><input type="hidden" class="AssumProject" name="AssumProject[]" value="'.utf8_encode(@$Sql_Result['AssumProject']).'"><input type="hidden" class="AssumptionId" name="AssumptionId[]" value="'.utf8_encode(@$Sql_Result['Id']).'"><input type="hidden" class="activeid" name="activeid[]" value="'.utf8_encode(@$Sql_Result['activeid']).'">';
      $resarr[] = '<div class="Assumproj" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['AssumProject']).'</div>';

      $resarr[] = utf8_encode(@$Sql_Result['BreedingActivity']).'<input type="hidden" class="BreedingActivity" name="BreedingActivity[]" value="'.utf8_encode(@$Sql_Result['BreedingActivity']).'">';


      $resarr[]=" <input type='number' id='example-input-small'  class='form-control form-control-sm count_num' data-gender='male' placeholder='count' name='malecount[]' style='width: 50px;' value='".utf8_encode(@$Sql_Result['malecount'])."'>"; 
      $resarr[]="<input type='number' id='example-input-small'  class='form-control form-control-sm count_num' data-gender='male' placeholder='count' name='femalecount[]' style='width: 50px;' value='".utf8_encode(@$Sql_Result['femalecount'])."'>"; 









      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }






  public function AssumptionEnrty_malefemaleamount_completed($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $Sql="Exec BreedingAdmin_Assumption_Month_Details @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['Location'])."<input type='hidden' id='example-input-small'  class='form-control form-control-sm assumlocationdata' placeholder='count' name='Assumlocation_month[]' style='width: 10px;' value='".utf8_encode(@$Sql_Result['Location'])."'>";


      $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign'  name='Frommonth[]' value='".utf8_encode(@$Sql_Result['Frommonth'])."' >"; 

      $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign'  name='tomonth[]' value='".utf8_encode(@$Sql_Result['Tomonth'])."'>"; 


      $resarr[]="<input type='number'   class='form-control form-control-sm ' name='maleamount[]' value='".utf8_encode(@$Sql_Result['MaleAmount'])."'>"; 


      $resarr[]="<input type='number'   class='form-control form-control-sm ' name='femaleamount[]' value='".utf8_encode(@$Sql_Result['FemaleAmount'])."'>"; 








      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }






  public function LocationMaster($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';



    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $Sql="SELECT   TOTALROW = count(*) OVER(), Territory from Budget_CostCenter_Mapping_Finance where Territory!='-' Group by Territory";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
      $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['Territory']);
      $resarr[] = "Active";










      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }


  public function ProjectMaster($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';



    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;


    $Sql="SELECT   TOTALROW = count(*) OVER(), BPM.internal_Order_Description FROM Budget_project_Master AS BPM Group by internal_Order_Description";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
      $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['internal_Order_Description']);
      $resarr[] = "Active";










      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }




  public function ActivityMaster($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';



    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;


    $Sql="SELECT   TOTALROW = count(*) OVER(), work from Farm_DRS_New_Labour_Workcode_DETAILS Group by work";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
      $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['work']);
      $resarr[] = "Active";










      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }






  public function Consumablesallvalues($data)
  {

   // echo "<pre>";print_r($data);
    //exit; 


    $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
    $Dcode=@$_SESSION['Dcode'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');
    $CurrentStatus="1";
    $RejectionStatus="1";



   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);


    $status=0;  
    // $autonum=@$data['autonum'];


    if($CreatedBy !=''){


      $i=0;
      foreach(@$data['project'] as $key=>$value)
      {

      //$location_val=@$data['location'][$key];
        $Project_val=@$data['project'][$key];

        $WorkActivity=@$data['WorkActivity'][$key];


        $location_val=@$data['location'];


        $SQL1="INSERT INTO  BreedingAdmin_Consumables(Ordernum,ConsumLocation,ConsumProject,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$i."','".$location_val."','".$Project_val."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
         $Result=sqlsrv_query($this->conn,$SQL1);

         $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);





         $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];


         foreach(@$data['Consumables'] as $key=>$value)
         {

          $Consumables=@$data['Consumables'][$key];




          $SQL1="INSERT INTO  BreedingAdmin_Consumablestype(Docid,Ordernum,Breedingconsumables,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$i."','".$Consumables."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
           $Result=sqlsrv_query($this->conn,$SQL1);

           $status=1;  













           $status=1;   



         }






       }

//$i_project = 0;





     }else{

      $status=0;


    }





//  exit;
    return array('Status'=>$status);
  }







  public function consumablesentry($User_Input=array())
  {
    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $Sql="Exec BreedingAdmin_Consumption_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length.",@Status='1' ";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['ConsumLocation']).'<input type="hidden" class="ConsumLocation" name="ConsumLocation[]" value="'.utf8_encode(@$Sql_Result['ConsumLocation']).'"><input type="hidden" class="ConsumProject" name="ConsumProject[]" value="'.utf8_encode(@$Sql_Result['ConsumProject']).'"><input type="hidden" class="ConsumId" name="ConsumId[]" value="'.utf8_encode(@$Sql_Result['Id']).'"><input type="hidden" class="type_id" name="type_id[]" value="'.utf8_encode(@$Sql_Result['type_id']).'"><input type="hidden" class="consumtypeid" name="consumtypeid[]" value="'.utf8_encode(@$Sql_Result['consumtypeid']).'">';
      $resarr[] = '<div class="ConsumProject" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['ConsumProject']).'</div>';

      $resarr[] = '<div class="Breedingconsumables" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['Breedingconsumables']).'</div>';
      $resarr[] ="<input type='number' class='form-control acraege' name='acraege[]' style='width:70px' value='".utf8_encode(@$Sql_Result['acre'])."''>";
     // $resarr[] ="";

          $resarr[]  =" <button type='button' class='btn btn-sm btn-danger deleterow deletebutton'><i class='fas fa-trash-alt'></i></button>";
  // $resarr[] ="";
   //$resarr[] ="<input type='number' class='form-control UOM' name='UOM[]' style='width:70px'>";
   //$resarr[] ="<span class='totalconsum' style='font-size:14px'></span><input type='hidden' class='appendtotalvalue' name='Total[]'>";






      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }




  public function consumablesentryuom($User_Input=array())
  {
    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $location      = $User_Input['user_input']['location_name'];
    $project_names = implode(',',$User_Input['user_input']['project_name']);
    $consumables   = implode(',',$User_Input['user_input']['consumables']);
    $Sql="Exec BreedingAdmin_Consumption_Datatable_UOM @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length.",@location='".$location."',@project='".$project_names."',@consumables='".$consumables."'";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = '<span style="word-break:break-all;">'.utf8_encode(@$Sql_Result['ConsumLocation']).'</span>';
      $resarr[] = '<span style="word-break:break-all;">'.utf8_encode(@$Sql_Result['ConsumProject']).'</span>';
      $resarr[] = '<span style="word-break:break-all;">'.utf8_encode(@$Sql_Result['Breedingconsumables']).'</span><input type="hidden" class="Breedingconsumables" name="Breedingconsumables[]" value="'.utf8_encode(@$Sql_Result['Breedingconsumables']).'"><input type="hidden" class="ConsumProject" name="ConsumProject[]" value="'.utf8_encode(@$Sql_Result['ConsumProject']).'"><input type="hidden" class="ConsumId" name="ConsumId[]" value="'.utf8_encode(@$Sql_Result['Id']).'"><input type="hidden" class="consumtypeid" name="consumtypeid[]" value="'.utf8_encode(@$Sql_Result['consumtypeid']).'">';

      $resarr[] ="<input type='number' class='form-control UOM' name='UOM[]' style='width:70px' value='".$Sql_Result['UOM']."'>";
      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }






  public function tablewisedataconsumtion($data)
  {

   // echo "<pre>";print_r($data);

   // $passing_id_proj = $_REQUEST['passing_id_proj'];

   // echo "<pre>";print_r($passing_id_proj);
  //  exit; 


    $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
    $Dcode=@$_SESSION['Dcode'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');
    $CurrentStatus="1";
    $RejectionStatus="1";



   //$Doc_No=Generate_Auto_Breedid(0);

  // print_r($Doc_No);


    $status=0;  
    // $autonum=@$data['autonum'];


    if($CreatedBy !=''){


      $i=0;
      foreach(@$data['ConsumId'] as $key=>$value)
      {

      //$location_val=@$data['location'][$key];
        $ConsumId=@$data['ConsumId'][$key];
        $allpassing_id=@$data['allpassing_id'][$key];
        $passing_id_proj=@$data['passing_id_proj'][$key];


 //$location_val=@$data['location'];


        $SQL="UPDATE  BreedingAdmin_Consumables SET CurrentStatus='2'  Where id='$ConsumId' ";
        $Result=sqlsrv_query($this->conn,$SQL);





        $status=1;     


      }




      foreach(@$data['acraege'] as $key=>$value)
      {

      //$location_val=@$data['location'][$key];
        $acraege=@$data['acraege'][$key];
        $consumtypeid=@$data['consumtypeid'][$key];
        $UOM=@$data['UOM'][$key];


 //$location_val=@$data['location'];

        $SQL="UPDATE  BreedingAdmin_Consumablestype SET CurrentStatus='2',finalsubmitat='$CreatedAt',acre='$acraege',UOM='$UOM'  Where id='$consumtypeid' ";
        $Result=sqlsrv_query($this->conn,$SQL);





        $status=1;     


      }







    }else{

      $status=0;


    }





//  exit;
    return array('Status'=>$status);
  }






  public function consumablesentryuom_confirm($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $Sql="Exec BreedingAdmin_Consumption_Datatable_UOM_Completed @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = '<span style="word-break:break-all;">'.utf8_encode(@$Sql_Result['Breedingconsumables']).'</span> <input type="hidden" class="Breedingconsumables" name="Breedingconsumables[]" value="'.utf8_encode(@$Sql_Result['Breedingconsumables']).'"><input type="hidden" class="ConsumProject" name="ConsumProject[]" value="'.utf8_encode(@$Sql_Result['ConsumProject']).'"><input type="hidden" class="ConsumId" name="ConsumId[]" value="'.utf8_encode(@$Sql_Result['Id']).'"><input type="hidden" class="consumtypeid" name="consumtypeid[]" value="'.utf8_encode(@$Sql_Result['consumtypeid']).'">';

      $resarr[] ="<input type='number' class='form-control UOM' name='UOM[]' style='width:70px' value=".utf8_encode(@$Sql_Result['UOM']).">";







      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }






  public function consumablesentry_confirm($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $Sql="Exec BreedingAdmin_Consumption_Datatable_Complete @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['ConsumLocation']).'<input type="hidden" class="ConsumLocation" name="ConsumLocation[]" value="'.utf8_encode(@$Sql_Result['ConsumLocation']).'"><input type="hidden" class="ConsumProject" name="ConsumProject[]" value="'.utf8_encode(@$Sql_Result['ConsumProject']).'"><input type="hidden" class="ConsumId" name="ConsumId[]" value="'.utf8_encode(@$Sql_Result['Id']).'"><input type="hidden" class="consumtypeid" name="consumtypeid[]" value="'.utf8_encode(@$Sql_Result['consumtypeid']).'">';
      $resarr[] = '<div class="ConsumProject" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['ConsumProject']).'</div>';

      $resarr[] = '<div class="Breedingconsumables" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['Breedingconsumables']).'</div>';
      $resarr[] ="<input type='number' class='form-control acraege' name='acraege[]' style='width:70px' value=".utf8_encode(@$Sql_Result['acre']).">";
      $resarr[]  =" <button type='button' class='btn btn-sm btn-danger deleterow deletebutton'><i class='fas fa-trash-alt'></i></button>";
  // $resarr[] ="";
   //$resarr[] ="<input type='number' class='form-control UOM' name='UOM[]' style='width:70px'>";
   //$resarr[] ="<span class='totalconsum' style='font-size:14px'></span><input type='hidden' class='appendtotalvalue' name='Total[]'>";






      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }

  

  public function getSubTableDetails($User_Input=array())
  {
    // echo "<pre>";
    // print_r($User_Input);
    //exit;
    $location = @$User_Input['data'][1];
    $project = @$User_Input['data'][2];
    $activity = @$User_Input['data'][3];

    $type='Sowing';

    // echo $location;
    // exit;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    //$sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $groupedData=array();
    $i=0;
    $Sql="Exec Get_Breed_MFCount_MonthWise_Datatable @EMPID='".$Emp_Id."',@BreedingLocation='".$location."',@Project='".$project."',@BreedingActivity='".$activity."',@type='".$type."' ";
  // echo $Sql;
  // exit;
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $resultarr[] = $Sql_Result;
    }
    

  //$result = $res;
    // echo "<pre>";
    // print_r($resultarr);
    // exit;
    return $result;
  }








  public function consumablesreport($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;
    $Sql="Exec BreedingAdmin_Consumption_Datatable_report @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length.",@Status='2' ";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['ConsumLocation']);
      $resarr[] = '<div class="ConsumProject" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['ConsumProject']).'</div>';

      $resarr[] = '<div class="Breedingconsumables" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['Breedingconsumables']).'</div>';
      $resarr[] ="<input type='number' class='form-control acraege' name='acraege[]' value='".utf8_encode(@$Sql_Result['acre'])."' style='width:70px'>";
      $resarr[] ="<input type='number' class='form-control acraege' name='acraege[]' value='".utf8_encode(@$Sql_Result['totalacreage'])."' style='width:70px'>";

      $resarr[] ="<input type='number' class='form-control acraege' name='acraege[]' value='".utf8_encode(@$Sql_Result['finaconsumablevalue'])."' style='width:70px'>";

       $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['Id']."' class='btn btn-xs btn-info Add_Consmables_monthwise' >Add</button>";
      $resarr[] ="";






      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }


  public function assumption_malefemale_count_update($data)
  {
      $activity_id   = $data['id'];
      $male_count    = ($data['gender'] == 'male') ? $data['count'] : '';
      $female_count  = ($data['gender'] == 'female') ? $data['count'] : ''; 
      $SQL = "UPDATE  BreedingAdmin_Activity SET CurrentStatus='2'";
      if($data['gender'] == 'male') {
        $SQL .= ",malecount='$male_count'";
      } 

      if($data['gender'] == 'female') {
        $SQL .= ",femalecount='$female_count'";
      }
      $SQL .= "Where id='$activity_id'";
      $Result=sqlsrv_query($this->conn,$SQL);

      if($Result == false) {
        $status = 0;
      } else {
        $status = 1;
      }

      return $status;  
  }


  public function assumption_malefemale_amount_update($data)
  {
      $id    = $data['id'];
      $male_amount    = (isset($data['gender']) && $data['gender'] == 'male') ? (($data['amount'] == '') ? "NULL" : $data['amount']) : "NULL";
      $female_amount  = (isset($data['gender']) && $data['gender'] == 'female') ? (($data['amount'] == '') ? "NULL" : $data['amount']) : "NULL"; 
      $from_date      = (isset($data['month_type']) && $data['month_type'] == 'from') ? (($data['date'] == '') ? "NULL" : $data['date']) : "NULL";
      $to_date        = (isset($data['month_type']) && $data['month_type'] == 'to') ? (($data['date'] == '') ? "NULL" : $data['date']) : "NULL";

      $SQL = "UPDATE BreedingAdmin_Monthwise_amount SET ";

      if(isset($data['gender']) && $data['gender'] != '') {
        if($data['gender'] == 'male') {
          $SQL .= "MaleAmount = $male_amount";
        } 

        if($data['gender'] == 'female') {
          $SQL .= "FemaleAmount = $female_amount";
        }
      }

      if(isset($data['month_type']) && $data['month_type'] != '') {
        if($data['month_type'] == 'from') {
          $SQL .= ($from_date == "NULL") ? "Frommonth = $from_date" : "Frommonth = '$from_date'";
        } 

        if($data['month_type'] == 'to') {
          $SQL .= ($to_date == "NULL") ? "Tomonth = $to_date" : "Tomonth = '$to_date'";
        }

      }

      $SQL .= " Where Id='$id'";

      $Result=sqlsrv_query($this->conn,$SQL);

      if($Result == false) {
        $status = 0;
      } else {
        $status = 1;
      }

      return $status;  
  }







  public function locationwiseacrageland($data)
  {


    //echo "<pre>";print_r($data);
   
 

   // $location_array = implode(', ', @$data['location']);
    //$project_array = implode(', ', @$data['project']);

    $breedingloc=@$data['breedingloc'];


        $CreatedBy=@$_SESSION['EmpID'];

        $Dcode=@$_SESSION['Dcode'];
        $CreatedAt=date('Y-m-d H:i:s');
        $Created_date=date('Y-m-d');
        $CurrentStatus="1";
        $RejectionStatus="1";

$status=0;
         if($CreatedBy !=''){


    foreach(@$data['location'] as $key=>$value)
    {
      $location_val=@$data['location'][$key];

          $SQL="INSERT INTO  BreedingAdmin_Landlese(Location,CreatedBy,CreatedAt,Currentstatus,Rejectionstatus)output inserted.Id VALUES('".$location_val."','".$CreatedBy."','".$CreatedAt."','1','1')";
           $Result=sqlsrv_query($this->conn,$SQL);

           $status=1;

     
   }

 }


  //exit; 

   return array('Status'=>$status);
 }



public function get_current_business_year()
{
    $sql     = "SELECT Business_Year,FORMAT(From_Date,'dd-MM-yyyy') as from_date,FORMAT(To_Date,'dd-MM-yyyy') as to_date FROM Breeding_Config_Business_Year where Status = 1";
    $result  = sqlsrv_query($this->conn,$sql); 
    $res_arr = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
    return $res_arr;  
}


public function Add_TFA($data)
{
  $current_byear = $this->get_current_business_year();
  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $CreatedAt=date('Y-m-d H:i:s');
  $CurrentStatus="1";


  foreach($data['TFA_Reqno'] as $key => $value) {
  //validation check for entered month is completed within business year
    $valid_sql = "SELECT from_month,to_month from BreedingAdmin_TFA_Details where Location= '".$data['location']."' and TFA_Reqno = '".$value."' and Breeding_year = '".$current_byear['Business_Year']."' and Rejectionstatus IS NULL";
    $result  = sqlsrv_query($this->conn,$valid_sql); 
    $res_arr = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
    if($res_arr['from_month'] == date('m-Y',strtotime($current_byear['from_date'])) && $res_arr['to_month'] == date('m-Y',strtotime($current_byear['to_date']))) {
        $status = 0;
        return array('Status'=>$status);
    } else {
      //get TFA reqesut no employee
      $sql     = "SELECT DISTINCT Name FROM BreedingAdmin_TFA_Details where TFA_Reqno = '".$value."'";
      $result  = sqlsrv_query($this->conn,$sql); 
      $employee = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

      $sql = "INSERT INTO BreedingAdmin_TFA_Details (TFA_Reqno,Location,Name,Breeding_year,CreatedBy,CreatedAt,Currentstatus) VALUES ('".$value."','".$data['location']."','".$employee['Name']."','".$current_byear['Business_Year']."','".$Emp_Id."','".$CreatedAt."','".$CurrentStatus."')";
      $result = sqlsrv_query($this->conn,$sql); 
    }

  }
  

  if($result === false) {
      $status = 0;
  } else {
      $status = 1;
  }

  return array('Status'=>$status);

}


public function month_format_change($month)
{
    $formattedDate = '';
    if($month != '') {
      $date = DateTime::createFromFormat('m-Y', $month);
      $formattedDate = $date->format('F Y');
    }
    return $formattedDate; 
}

public function Get_TFA_Details($User_Input=array())
{
  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'];


  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';


  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $i=1;
  $Sql="SELECT Location,Name,TFA_Reqno,Existing_rate,from_month,to_month,Crop,count(*) over() as TOTALROW,Id from BreedingAdmin_TFA_Details where RejectionStatus IS NULL AND Currentstatus = 1 ORDER BY Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY";

  // if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_TFA') {
  //     $Sql="SELECT Location,Name,No_of_persons,count(*) over() as TOTALROW,Id from BreedingAdmin_TFA where CreatedBy = '".$Emp_Id."' AND Currentstatus = '2' AND RejectionStatus = '1'  ORDER BY Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY";
  // }

  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $result = array();
    $recordsTotal   = @$Sql_Result['TOTALROW'];
    $result[]       = $sno++;
    $result[]       = $Sql_Result['Location'];
    $result[]       = utf8_encode($Sql_Result['Name']);


    $crop_select    = "<input type='hidden' value='".$Sql_Result['Id']."' id='tfa_id' name='TFA_ID[]'><input type='hidden' value='".$Sql_Result['Location']."' id='location'><input type='hidden' value='".$Sql_Result['TFA_Reqno']."' id='TFA_Reqno'><select class='select2 form-select inputs crop' name='crop'><option value=''>Choose Crop</option>";

    //All crops get from TFA DETAILS
    $crop_list = "SELECT DISTINCT Crop From BreedingAdmin_TFA_Details where RejectionStatus IS NULL AND Crop != ''";
    $crop_conn =sqlsrv_query($this->conn,$crop_list);
    while($crop_res = sqlsrv_fetch_array($crop_conn)) {
      $selected   = '';
      if($Sql_Result['Crop'] == $crop_res['Crop']) {
        $selected   = 'selected';
      }
      $crop_select  .= "<option ".$selected." value='".$crop_res['Crop']."'>".$crop_res['Crop']."</option>"; 
    }
    $crop_select    .= "</select>";
    $result[]       = $crop_select;

    // Last Existing rate get for the location and employee
    $ex_rate = "SELECT Existing_rate from BreedingAdmin_TFA_Details where Location= 'Fazilka' and Name = 'Anil kumar' and Currentstatus = 2 order by Id DESC";
    $exist_conn =sqlsrv_query($this->conn,$ex_rate);
    $result[]       = "<h5><span class='badge bg-success'>".sqlsrv_fetch_array($exist_conn)['Existing_rate']."</span></h5>";

    $result[]       = "<input type='number' class='form-control inputs current_rate' value='".$Sql_Result['Existing_rate']."' name='current_rate[]'>";
    $result[]       = "<input class='form-control inputs from_month' type='text' name='from_month' value='".$Sql_Result['from_month']."' placeholder='MM-YYYY' readonly />";
    $result[]       = "<input class='form-control inputs to_month' type='text' value='".$Sql_Result['to_month']."' name='to_month'  placeholder='MM-YYYY' readonly/>";

    $result[]       = "<button type='button' class='btn btn-sm btn-danger tfa_delete ms-2' data-action='delete' data-tfaid='".$Sql_Result['Id']."'><i class='fa fa-trash'></i></button><button type='button' class='btn btn-sm btn-success tfa_add_row ms-2' data-TFA_Reqno='".$Sql_Result['TFA_Reqno']."' data-location='".$Sql_Result['Location']."' data-name='".$Sql_Result['Name']."'><i class='fa fa-plus'></i></button>";



    //check monthwise labour rate is exist start   
    // $check_sql      = "SELECT COUNT(*) as total FROM BreedingAdmin_TFA_MonthwiseDetails WHERE TFA_id = ".$Sql_Result['Id']." AND Currentstatus = '1' AND RejectionStatus = '1'";
    // $from_action = 'pending';
    // if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_TFA') {
    //   $check_sql="SELECT COUNT(*) as total FROM BreedingAdmin_TFA_MonthwiseDetails WHERE TFA_id = ".$Sql_Result['Id']." AND Currentstatus = '2' AND RejectionStatus = '1'";
    //   $from_action = 'completed';
    // }
    // $result_sql     = sqlsrv_query($this->conn,$check_sql);
    // $count          = sqlsrv_fetch_array($result_sql,SQLSRV_FETCH_ASSOC);
    // echo "<pre>";print_r($count['total']);exit;
    //check monthwise labour rate is exist end    

    // if($count['total'] > 0) {
    //   $result[]       = "<button type='button' class='btn btn-sm  btn-info labour_rate_edit' data-action='edit' data-tfaid='".$Sql_Result['Id']."' data-loc='".$Sql_Result['Location']."' data-name ='".$Sql_Result['Name']."' data-nop ='".$Sql_Result['No_of_persons']."' data-fromaction ='".$from_action."'>View</button><button type='button' class='btn btn-sm btn-danger labour_rate_delete ms-2' data-action='delete' data-tfaid='".$Sql_Result['Id']."' data-fromaction ='".$from_action."'><i class='fa fa-trash'></i></button><input type='hidden' value='".$Sql_Result['Id']."' name='TFA_ID[]'>"; 
    // } else {
    //   $result[]       = "<button type='button' style='width: 43px;' class='btn btn-sm btn-primary labour_rate_add' data-action='add' data-tfaid='".$Sql_Result['Id']."' data-loc='".$Sql_Result['Location']."' data-name ='".$Sql_Result['Name']."' data-nop ='".$Sql_Result['No_of_persons']."' data-fromaction ='".$from_action."'>Add</button><button type='button' class='btn btn-sm btn-danger labour_rate_delete ms-2' data-action='delete' data-tfaid='".$Sql_Result['Id']."' data-fromaction ='".$from_action."'><i class='fa fa-trash'></i></button><input type='hidden' value='".$Sql_Result['Id']."' name='TFA_ID[]'>"; 
    // }

    // echo "<pre>";print_r($Sql_Result);exit;
    $resultarr[] = $result;
    $i++;
  }
  $res=array();
  if(isset($User_Input['draw']))
  {
    $res['draw'] = @$User_Input['draw'];  
  }else
  {
    $res['draw'] = 1; 
  }
  $res['recordsFiltered'] = @$recordsTotal;
  $res['recordsTotal'] = @$recordsTotal;
  $res['data'] = @$resultarr;
  // $res['sql'] = @$Sql;
  $result = $res;
  return $result;

}

public function Add_TFA_labour_rate($data)
{
  // echo "<pre>";print_r($data);exit;
  $Created_date   = date('Y-m-d');
  $CreatedBy     = $_SESSION['EmpID'];
  $CreatedAt     =  date('Y-m-d H:i:s');
  $CurrentStatus  = "1";
  $RejectionStatus= "1";
  $tfa_id = $data['tfa_id'];
  
  $status = 1;

  //month value validation start
  // $month_arr = ['jun','jul','aug','sep','oct','nov','dec','jan','feb','mar','apr','may'];
  // foreach ($month_arr as $key => $month) {
  //   $index = $month."_rate";
  //   if($data[$index] == '') {
  //     $status = 0;
  //   }
  // }
  //month value validation end

  if($status == 1) {
    if($data['function'] == 'Add') {
      $sql = "INSERT INTO BreedingAdmin_TFA_MonthwiseDetails (TFA_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,ReqDate,CreatedBy,CreatedAt,Currentstatus,Rejectionstatus) VALUES (".$tfa_id.",'".$data['jun_rate']."','".$data['jul_rate']."','".$data['aug_rate']."','".$data['sep_rate']."','".$data['oct_rate']."','".$data['nov_rate']."','".$data['dec_rate']."','".$data['jan_rate']."','".$data['feb_rate']."','".$data['mar_rate']."','".$data['apr_rate']."','".$data['may_rate']."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','".$CurrentStatus."','".$RejectionStatus."')";
    } elseif($data['function'] == 'Edit') {
      $sql = "UPDATE BreedingAdmin_TFA_MonthwiseDetails SET Jun = '".$data['jun_rate']."',Jul = '".$data['jul_rate']."',Aug = '".$data['aug_rate']."',Sep = '".$data['sep_rate']."',Oct = '".$data['oct_rate']."',Nov = '".$data['nov_rate']."',Dec = '".$data['dec_rate']."',Jan = '".$data['jan_rate']."',Feb = '".$data['feb_rate']."',Mar = '".$data['mar_rate']."',Apr = '".$data['apr_rate']."',May = '".$data['may_rate']."',ModifiedBy = '".$CreatedBy."',ModifiedAt = '".$CreatedAt."' WHERE TFA_id = ".$tfa_id."";
    }

    // echo $sql;exit;
    $res = sqlsrv_query($this->conn,$sql);

    if($res === false) {
        $status = 0;
    } else {
        $status = 1;
    }

  }

  return array('Status'=>$status);

}

public function Get_TFA_labour_rate($data)
{
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $sql           = "SELECT * FROM BreedingAdmin_TFA_MonthwiseDetails WHERE TFA_id = ".$data['tfa_id']." AND Currentstatus = '1' AND RejectionStatus = '1'";

  if(isset($data['function']) && $data['function'] == 'completed') {
    $sql           = "SELECT * FROM BreedingAdmin_TFA_MonthwiseDetails WHERE TFA_id = ".$data['tfa_id']." AND Currentstatus = '2' AND RejectionStatus = '1'";
  }
  $result        = sqlsrv_query($this->conn,$sql);
  $result_arr    = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

  if($result === false) {
    $status = 0;
  } else {
    $status = 1;
  }

  $final_result['Status'] = $status;
  $final_result['data'] = $result_arr;
  return $final_result;
}

public function Delete_TFA($data)
{
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $RejectBy      = $_SESSION['EmpID'];
  $RejectAt      =  date('Y-m-d H:i:s');

  $sql           = "UPDATE BreedingAdmin_TFA_Details SET Rejectionstatus = 1,Rejectby = '".$RejectBy."',Rejectat = '".$RejectAt."' WHERE Id = ".$data['tfa_id']."";
  $result        = sqlsrv_query($this->conn,$sql);

  // $sql1           = "UPDATE BreedingAdmin_TFA SET Rejectionstatus = 2,Rejectby = '".$RejectBy."',Rejectat = '".$RejectAt."' WHERE id = ".$data['tfa_id']."";
  // $result_sql     = sqlsrv_query($this->conn,$sql1);


  if($result === false) {
    $status = 0;
  } else {
    $status = 1;
  }

  $final_result['Status'] = $status;
  return $final_result;
}

public function TFA_finaldata_old($data)
{
  // echo "<pre>";print_r($data);exit;
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $RejectBy      = $_SESSION['EmpID'];
  $RejectAt      =  date('Y-m-d H:i:s');


  //Submit validation check functionality start
  $validate_sql = "SELECT COUNT(BreedingAdmin_TFA.Id) as total,COUNT(BreedingAdmin_TFA_MonthwiseDetails.Id) as entered_labour_rate from BreedingAdmin_TFA 
  LEFT JOIN BreedingAdmin_TFA_MonthwiseDetails on BreedingAdmin_TFA.Id = BreedingAdmin_TFA_MonthwiseDetails.TFA_id and BreedingAdmin_TFA_MonthwiseDetails.CreatedBy = '".$Emp_Id."' and BreedingAdmin_TFA_MonthwiseDetails.Currentstatus = 1 and BreedingAdmin_TFA_MonthwiseDetails.Rejectionstatus = 1
  WHERE BreedingAdmin_TFA.CreatedBy = '".$Emp_Id."' and BreedingAdmin_TFA.Currentstatus = 1 and BreedingAdmin_TFA.Rejectionstatus = 1";

  $validate_result   = sqlsrv_query($this->conn,$validate_sql);
  $validated_arr     = sqlsrv_fetch_array($validate_result,SQLSRV_FETCH_ASSOC);
  //Submit validation check functionality end


  if($validated_arr['total'] == $validated_arr['entered_labour_rate']) {
      foreach ($data['TFA_ID'] as $key => $value) {
        $sql           = "UPDATE BreedingAdmin_TFA SET CurrentStatus = 2 WHERE id = ".$value."";
        $result_sql    = sqlsrv_query($this->conn,$sql);

         $sql1           = "UPDATE BreedingAdmin_TFA_MonthwiseDetails SET CurrentStatus = 2 WHERE TFA_id = ".$value."";
         $result_sql1    = sqlsrv_query($this->conn,$sql1);
        
      }

      if($result_sql === false || $result_sql1 === false) {
        $status = 0;
      } else {
        $status = 1;
      }
  } else {
        $status = 0; 
  }

  $final_result['Status'] = $status;
  return $final_result;
}


public function TFA_finaldata($data)
{
  // echo "<pre>";print_r($data);exit;
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $RejectBy      = $_SESSION['EmpID'];
  $RejectAt      =  date('Y-m-d H:i:s');


  //Submit validation check functionality start
  $validate_sql = "SELECT count(*) as Empty_count from BreedingAdmin_TFA_Details where CreatedBy = '".$Emp_Id."' and Currentstatus = 1
    and (Crop IS NULL OR Existing_rate IS NULL OR from_month IS NULL OR to_month IS NULL)";
  $validate_result   = sqlsrv_query($this->conn,$validate_sql);
  $validated_arr     = sqlsrv_fetch_array($validate_result,SQLSRV_FETCH_ASSOC);
  //Submit validation check functionality end


  if($validated_arr['Empty_count'] == 0) {
      foreach ($data['TFA_ID'] as $key => $value) {
        $sql           = "UPDATE BreedingAdmin_TFA_Details SET CurrentStatus = 2 WHERE Id = ".$value."";
        $result_sql    = sqlsrv_query($this->conn,$sql);
      }

      if($result_sql === false) {
        $status = 0;
      } else {
        $status = 1;
      }
  } else {
        $status = 0; 
  }

  $final_result['Status'] = $status;
  return $final_result;
}

  public function Finaltabledetailsland($data)
  {
    $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    //Submit validation check functionality start
    $validate_sql = "SELECT COUNT(BreedingAdmin_Landlese.Id) as total,COUNT(BreedingAdmin_MonthwiseLandlease.Id) as monthwise_entered_landlease,(select COUNT(*)from BreedingAdmin_Landlese where Name IS NULL and No_of_acres IS NULL and Per_acre IS NULL and BreedingAdmin_Landlese.CreatedBy = '".$Emp_Id."' and BreedingAdmin_Landlese.Currentstatus = 1 and BreedingAdmin_Landlese.Rejectionstatus = 1) as empty_count from BreedingAdmin_Landlese 
     LEFT JOIN BreedingAdmin_MonthwiseLandlease on BreedingAdmin_Landlese.Id = BreedingAdmin_MonthwiseLandlease.Lease_id and BreedingAdmin_MonthwiseLandlease.CreatedBy = '".$Emp_Id."' and BreedingAdmin_MonthwiseLandlease.Currentstatus = 1 and BreedingAdmin_MonthwiseLandlease.Rejectionstatus = 1
    WHERE BreedingAdmin_Landlese.CreatedBy = '".$Emp_Id."' and BreedingAdmin_Landlese.Currentstatus = 1 and BreedingAdmin_Landlese.Rejectionstatus = 1";

    $validate_result   = sqlsrv_query($this->conn,$validate_sql);
    $validated_arr     = sqlsrv_fetch_array($validate_result,SQLSRV_FETCH_ASSOC);
    //Submit validation check functionality end

    if($validated_arr['empty_count'] == 0 && $validated_arr['total'] == $validated_arr['monthwise_entered_landlease']) {
      foreach ($data['lease_id'] as $key => $value) {
        $sql           = "UPDATE BreedingAdmin_Landlese SET CurrentStatus = 2 WHERE Id = ".$value."";
        $result_sql    = sqlsrv_query($this->conn,$sql);

        $sql1           = "UPDATE BreedingAdmin_MonthwiseLandlease SET CurrentStatus = 2 WHERE Lease_id = ".$value."";
        $result_sql1    = sqlsrv_query($this->conn,$sql1);
        
      }

      if($result_sql === false || $result_sql1 === false) {
        $status = 0;
      } else {
        $status = 1;
      }
    } else {
      $status = 0; 
    }

    return array('Status'=>$status);
 }





 public function landleasedata($User_Input=array())
 {


  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'];
  $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $i=0;
  $Sql="SELECT TOTALROW = count(*) OVER(), Location,Name,No_of_acres,Per_acre,Id as leaseid FROM BreedingAdmin_Landlese WHERE CreatedBy = '".$Emp_Id."' and Currentstatus = 1 and Rejectionstatus = 1 Group by  Location,Name,No_of_acres,Per_acre,Id  ORDER BY Location ASC OFFSET  $Offset ROWS FETCH NEXT $Length ROWS ONLY";

  if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_landleasedata') {
    $Sql="SELECT TOTALROW = count(*) OVER(), Location,Name,No_of_acres,Per_acre,Id as leaseid FROM BreedingAdmin_Landlese WHERE CreatedBy = '".$Emp_Id."' and Currentstatus = 2 and Rejectionstatus = 1 Group by  Location,Name,No_of_acres,Per_acre,Id  ORDER BY Location ASC OFFSET  $Offset ROWS FETCH NEXT $Length ROWS ONLY";
  }
  
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $recordsTotal = @$Sql_Result['TOTALROW'];
    $resarr = array();
     $resarr[] = $sno++;
    $resarr[] = @$Sql_Result['Location'];
    $resarr[] = "<input type='text' class='emp_name' name='Employee_name[]' value='".$Sql_Result['Name']."' style='border:none;backgroud:transparent;width:70px' ><input type='hidden' name='lease_id[]' class='lease_id' value='".$Sql_Result['leaseid']."'>";
    $resarr[] = "<input type='number' class='no_of_acres' name='no_of_acres[]' value='".$Sql_Result['No_of_acres']."' style='border:none;backgroud:transparent;width:70px' >";
    $resarr[] = "<input type='number' class='per_acre' name='per_acre[]' value='".$Sql_Result['Per_acre']."' style='border:none;backgroud:transparent;width:70px' >";
  
 
  ///  $resarr[]='<button type="button" attributeid="'.@$Sql_Result['leaseid'].'" class="tabledit-save-button btn btn-sm btn-success Add_Month_wise_popup" style="float: none; margin: 4px;">ADD</button><button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>  '; 


    
    $SQL="SELECT count(*) as leasecount from BreedingAdmin_MonthwiseLandlease where Lease_id='".@$Sql_Result['leaseid']."' ";
       $Result_count=sqlsrv_query($this->conn,$SQL);

        $countvalue=sqlsrv_fetch_array($Result_count,SQLSRV_FETCH_ASSOC);

        $leasecount=$countvalue['leasecount'];

     //   print_r($leasecount);

    if($leasecount==0){
      if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_landleasedata') {
          $resarr[]='<button type="button" attributeid="'.@$Sql_Result['leaseid'].'" class="tabledit-save-button btn btn-sm btn-success Add_Month_wise_popup" data-from="completed" style="float: none; margin: 4px;">ADD</button>'; 
      } else {
          $resarr[]='<button type="button" attributeid="'.@$Sql_Result['leaseid'].'" class="tabledit-save-button btn btn-sm btn-success Add_Month_wise_popup" data-from="pending" style="float: none; margin: 4px;">ADD</button>'; 
      }

    }else{
      if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_landleasedata') {
        $resarr[]='<button type="button" attributeid="'.@$Sql_Result['leaseid'].'" class="tabledit-save-button btn btn-sm btn-primary Add_Month_wise_popup" data-from="completed" style="float: none; margin: 4px;">View</button>
        <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>';
      } else {
        $resarr[]='<button type="button" attributeid="'.@$Sql_Result['leaseid'].'" class="tabledit-save-button btn btn-sm btn-primary Add_Month_wise_popup" data-from="pending" style="float: none; margin: 4px;">View</button>
        <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>';
      } 


    }
 


    

  $resultarr[] = $resarr;
  $i++;
}
$res=array();
if(isset($User_Input['draw']))
{
  $res['draw'] = @$User_Input['draw'];  
}else
{
  $res['draw'] = 1; 
}
$res['recordsFiltered'] = @$recordsTotal;
$res['recordsTotal'] = @$recordsTotal;
$res['data'] = @$resultarr;
$res['sql'] = @$Sql;
$result = $res;
return $result;
}






public function monthwiselandleasedata($data)
{

   // echo "<pre>";print_r($data);
   // exit; 


  $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
  $Dcode=@$_SESSION['Dcode'];
  $CreatedAt=date('Y-m-d H:i:s');
  $Created_date=date('Y-m-d');
  $CurrentStatus="1";
  $RejectionStatus="1";



 
  $landleaseid=@$data['landleaseid'];
 


  $status=0;

  if($CreatedBy !=''){

    foreach(@$data['jun_acrage'] as $key=>$value)
    {     
      $Jun=@$data['jun_acrage'][$key];
      $Jul=@$data['jul_acrage'][$key];
      $Aug=@$data['aug_acrage'][$key];
      $Sep=@$data['sep_acrage'][$key];
      $Oct=@$data['oct_acrage'][$key];
      $Nov=@$data['nov_acrage'][$key];
      $Dec=@$data['dec_acrage'][$key];
      $Jan=@$data['jan_acrage'][$key];
      $Feb=@$data['feb_acrage'][$key];
      $Mar=@$data['mar_acrage'][$key];
      $Apr=@$data['apr_acrage'][$key];
      $May=@$data['may_acrage'][$key];
      $Total_acrage=@$data['Total_acrage'][$key];



      $SQL="SELECT count(*) as leasecount from BreedingAdmin_MonthwiseLandlease where Lease_id='".$landleaseid."'";
       $Result_count=sqlsrv_query($this->conn,$SQL);

        $countvalue=sqlsrv_fetch_array($Result_count,SQLSRV_FETCH_ASSOC);

        $leasecount=$countvalue['leasecount'];

     //   print_r($leasecount);

        if($leasecount==0){



      $SQL="INSERT INTO  BreedingAdmin_MonthwiseLandlease(Lease_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage,ReqDate,CreatedBy,CreatedAt,Currentstatus,Rejectionstatus)output inserted.Id VALUES('".$landleaseid."','".$Jun."','".$Jul."','".$Aug."','".$Sep."','".$Oct."','".$Nov."','".$Dec."','".$Jan."','".$Feb."','".$Mar."','".$Apr."','".$May."','".$Total_acrage."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1','1')";
       $Result=sqlsrv_query($this->conn,$SQL);

   $status=1;

        }else{


  $SQL="UPDATE BreedingAdmin_MonthwiseLandlease SET Jun='$Jun',Jul='$Jul',Aug='$Aug',Sep='$Sep',Oct='$Oct',Nov='$Nov',Dec='$Dec',Jan='$Jan',Feb='$Feb',Mar='$Mar',Apr='$Apr',May='$May' Where Lease_id='".$landleaseid."'";
       $Result=sqlsrv_query($this->conn,$SQL);

   $status=2;




        }

          // $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);
    

     }


   }else{

    $status=0;


  }


          // $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];

  // exit;
  return array('Status'=>$status);
}



  public function land_lease_keyup_update($data)
  {
      $lease_id   = $data['lease_id'];

      $SQL = "UPDATE BreedingAdmin_Landlese SET ";
      if($data['type'] == 'name') {
        $emp_name = ($data['emp_name'] == '') ? "NULL" : $data['emp_name'];
        if($emp_name == "NULL") {
            $SQL .= "Name =".$emp_name."";
        } else {
            $SQL .= "Name ='".$emp_name."'";
        }
      } 

      if($data['type'] == 'no_of_acres') {
        $no_of_acres = ($data['no_of_acres'] == '') ? "NULL" : $data['no_of_acres']; 
        $SQL .= "No_of_acres =".$no_of_acres."";
      }

      if($data['type'] == 'per_acre') {
        $per_acre = ($data['per_acre'] == '') ? "NULL" : $data['per_acre']; 
        $SQL .= "Per_acre =".$per_acre."";
      }

      $SQL .= " Where Id='$lease_id'";
      $Result=sqlsrv_query($this->conn,$SQL);

      if($Result == false) {
        $status = 0;
      } else {
        $status = 1;
      }
      return $status;  
  }


public function Add_Travel($data)
{
  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $reqdate = date('Y-m-d');
  $CreatedAt=date('Y-m-d H:i:s');
  $CurrentStatus="1";
  $RejectionStatus="1";

  $expen_sql    = "SELECT DISTINCT Expenses_Name,Id FROM BreedingAdmin_Expenses_Master ORDER BY Expenses_Name";
  $expen_result = sqlsrv_query($this->conn,$expen_sql); 

  while($row = sqlsrv_fetch_array($expen_result,SQLSRV_FETCH_ASSOC)) {
      $sql = "INSERT INTO BreedingAdmin_Travel(Employee_Code,Expenses_id,ReqDate,CreatedBy,CreatedAt,Currentstatus,Rejectionstatus) VALUES ('".$data['employee_id']."','".$row['Id']."','".$reqdate."','".$Emp_Id."','".$CreatedAt."','".$CurrentStatus."','".$CurrentStatus."')";
      
      $result = sqlsrv_query($this->conn,$sql); 
  }

  if($result === false) {
      $status = 0;
  } else {
      $status = 1;
  }

  return array('Status'=>$status);

}

public function Get_Travel_Details($User_Input=array())
{
  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'];


  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';


  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $i=1;
  $Sql="SELECT BreedingAdmin_travel.*,HR_Master_Table.Employee_Name,BreedingAdmin_Expenses_Master.Expenses_Name,count(*) over() as TOTALROW from BreedingAdmin_travel LEFT JOIN HR_Master_Table ON BreedingAdmin_travel.Employee_Code = HR_Master_Table.Employee_Code
  LEFT JOIN BreedingAdmin_Expenses_Master ON BreedingAdmin_travel.Expenses_id = BreedingAdmin_Expenses_Master.id
  where BreedingAdmin_travel.CreatedBy = '".$Emp_Id."' AND BreedingAdmin_travel.Currentstatus = '1' AND BreedingAdmin_travel.RejectionStatus = '1'
   ORDER BY BreedingAdmin_travel.Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY";


  if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_Travel') {
      $Sql="SELECT BreedingAdmin_travel.*,HR_Master_Table.Employee_Name,BreedingAdmin_Expenses_Master.Expenses_Name,count(*) over() as TOTALROW from BreedingAdmin_travel LEFT JOIN HR_Master_Table ON BreedingAdmin_travel.Employee_Code = HR_Master_Table.Employee_Code
        LEFT JOIN BreedingAdmin_Expenses_Master ON BreedingAdmin_travel.Expenses_id = BreedingAdmin_Expenses_Master.id
        where BreedingAdmin_travel.CreatedBy = '".$Emp_Id."' AND BreedingAdmin_travel.Currentstatus = '2' AND BreedingAdmin_travel.RejectionStatus = '1'
        ORDER BY BreedingAdmin_travel.Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY";
  }
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $result = array();
    $recordsTotal   = @$Sql_Result['TOTALROW'];
    $result[]       = $sno++;
    $result[]       = $Sql_Result['Employee_Name'];
    $result[]       = $Sql_Result['Expenses_Name']; 
    // $result[]       = $Sql_Result['Per_visit']; 
    $result[]       = "<input type='hidden' class='travel_id' value='".$Sql_Result['Id']."'><input type='number' class='per_visit' name='per_visit[]' value='".$Sql_Result['Per_visit']."' style='border:none;backgroud:transparent;width:70px'>";

    //check monthwise travel expense is exist start   
    $check_sql      = "SELECT COUNT(*) as total FROM BreedingAdmin_Travel_MonthwiseDetails WHERE Travel_id = ".$Sql_Result['Id']." AND Currentstatus = '1' AND RejectionStatus = '1'";
    $from_action = 'pending';
    if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_Travel') {
      $check_sql="SELECT COUNT(*) as total FROM BreedingAdmin_Travel_MonthwiseDetails WHERE Travel_id = ".$Sql_Result['Id']." AND Currentstatus = '2' AND RejectionStatus = '1'";
      $from_action = 'completed';
    }
    $result_sql     = sqlsrv_query($this->conn,$check_sql);
    $count          = sqlsrv_fetch_array($result_sql,SQLSRV_FETCH_ASSOC);
    //check monthwise travel expense is exist end    

    if($count['total'] > 0) {
      $result[]       = "<button type='button' class='btn btn-sm btn-info travel_expense_edit' data-action='edit' data-travelid='".$Sql_Result['Id']."' data-employee='".$Sql_Result['Employee_Name']."' data-expenses ='".$Sql_Result['Expenses_Name']."' data-pervisit ='".$Sql_Result['Per_visit']."' data-fromaction ='".$from_action."'>View</button><button type='button' class='btn btn-sm btn-danger travel_expense_delete ms-2' data-action='delete' data-travelid='".$Sql_Result['Id']."' data-fromaction ='".$from_action."'><i class='fa fa-trash'></i></button><input type='hidden' value='".$Sql_Result['Id']."' name='Travel_id[]'>"; 
    } else {
      $result[]       = "<button type='button' style='width: 43px;' class='btn btn-sm btn-primary travel_expense_add' data-action='add' data-travelid='".$Sql_Result['Id']."' data-employee='".$Sql_Result['Employee_Name']."' data-expenses ='".$Sql_Result['Expenses_Name']."' data-pervisit ='".$Sql_Result['Per_visit']."' data-fromaction ='".$from_action."'>ADD</button><button type='button' class='btn btn-sm btn-danger travel_expense_delete ms-2' data-action='delete' data-travelid='".$Sql_Result['Id']."' data-fromaction ='".$from_action."'><i class='fa fa-trash'></i></button><input type='hidden' value='".$Sql_Result['Id']."' name='Travel_id[]'>"; 
    }

    $resultarr[] = $result;
    $i++;
  }
  $res=array();
  if(isset($User_Input['draw']))
  {
    $res['draw'] = @$User_Input['draw'];  
  }else
  {
    $res['draw'] = 1; 
  }
  $res['recordsFiltered'] = @$recordsTotal;
  $res['recordsTotal'] = @$recordsTotal;
  $res['data'] = @$resultarr;
  // $res['sql'] = @$Sql;
  $result = $res;
  return $result;

}


  public function travel_per_visit_update($data)
  {
      $travel_id        = $data['travel_id'];
      $per_visit_val    = ($data['per_visit_val'] == '') ? "NULL" : $data['per_visit_val'];

      $SQL = "UPDATE BreedingAdmin_Travel SET ";
      if($per_visit_val == "NULL") {
        $SQL .= "Per_visit =".$per_visit_val."";
      } else {
        $SQL .= "Per_visit ='".$per_visit_val."'";
      }

      $SQL .= " Where Id='$travel_id'";
      $Result=sqlsrv_query($this->conn,$SQL);

      if($Result == false) {
        $status = 0;
      } else {
        $status = 1;
      }
      return $status;  
  }

public function Add_Travel_expense($data)
{
  // echo "<pre>";print_r($data);exit;
  $Created_date   = date('Y-m-d');
  $CreatedBy     = $_SESSION['EmpID'];
  $CreatedAt     =  date('Y-m-d H:i:s');
  $CurrentStatus  = "1";
  $RejectionStatus= "1";
  $travel_id = $data['travel_id'];
  
  $status = 1;

  //month value validation start
  // $month_arr = ['jun','jul','aug','sep','oct','nov','dec','jan','feb','mar','apr','may'];
  // foreach ($month_arr as $key => $month) {
  //   $index = $month."_rate";
  //   if($data[$index] == '') {
  //     $status = 0;
  //   }
  // }
  //month value validation end

  if($status == 1) {
    if($data['function'] == 'Add') {
      $sql = "INSERT INTO BreedingAdmin_Travel_MonthwiseDetails (Travel_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,ReqDate,CreatedBy,CreatedAt,Currentstatus,Rejectionstatus) VALUES (".$travel_id.",'".$data['jun_rate']."','".$data['jul_rate']."','".$data['aug_rate']."','".$data['sep_rate']."','".$data['oct_rate']."','".$data['nov_rate']."','".$data['dec_rate']."','".$data['jan_rate']."','".$data['feb_rate']."','".$data['mar_rate']."','".$data['apr_rate']."','".$data['may_rate']."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','".$CurrentStatus."','".$RejectionStatus."')";
    } elseif($data['function'] == 'Edit') {
      $sql = "UPDATE BreedingAdmin_Travel_MonthwiseDetails SET Jun = '".$data['jun_rate']."',Jul = '".$data['jul_rate']."',Aug = '".$data['aug_rate']."',Sep = '".$data['sep_rate']."',Oct = '".$data['oct_rate']."',Nov = '".$data['nov_rate']."',Dec = '".$data['dec_rate']."',Jan = '".$data['jan_rate']."',Feb = '".$data['feb_rate']."',Mar = '".$data['mar_rate']."',Apr = '".$data['apr_rate']."',May = '".$data['may_rate']."',ModifiedBy = '".$CreatedBy."',ModifiedAt = '".$CreatedAt."' WHERE Travel_id = ".$travel_id."";
    }

    $res = sqlsrv_query($this->conn,$sql);

    if($res === false) {
        $status = 0;
    } else {
        $status = 1;
    }

  }

  return array('Status'=>$status);

}

public function Get_Travel_expense($data)
{
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $sql           = "SELECT * FROM BreedingAdmin_Travel_MonthwiseDetails WHERE Travel_id = ".$data['travel_id']." AND Currentstatus = '1' AND RejectionStatus = '1'";

  if(isset($data['function']) && $data['function'] == 'completed') {
    $sql           = "SELECT * FROM BreedingAdmin_Travel_MonthwiseDetails WHERE Travel_id = ".$data['travel_id']." AND Currentstatus = '2' AND RejectionStatus = '1'";
  }
  $result        = sqlsrv_query($this->conn,$sql);
  $result_arr    = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

  if($result === false) {
    $status = 0;
  } else {
    $status = 1;
  }

  $final_result['Status'] = $status;
  $final_result['data'] = $result_arr;
  return $final_result;
}

public function Delete_Travel_expense($data)
{
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $RejectBy      = $_SESSION['EmpID'];
  $RejectAt      =  date('Y-m-d H:i:s');

  $sql           = "UPDATE BreedingAdmin_Travel_MonthwiseDetails SET Rejectionstatus = 2,Rejectby = '".$RejectBy."',Rejectat = '".$RejectAt."' WHERE Travel_id = ".$data['travel_id']."";
  $result        = sqlsrv_query($this->conn,$sql);

  $sql1           = "UPDATE BreedingAdmin_Travel SET Rejectionstatus = 2,Rejectby = '".$RejectBy."',Rejectat = '".$RejectAt."' WHERE Id = ".$data['travel_id']."";
  $result_sql     = sqlsrv_query($this->conn,$sql1);


  if($result === false || $result_sql === false) {
    $status = 0;
  } else {
    $status = 1;
  }

  $final_result['Status'] = $status;
  return $final_result;
}

public function Travel_finaldata($data)
{
  // echo "<pre>";print_r($data);exit;
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $RejectBy      = $_SESSION['EmpID'];
  $RejectAt      =  date('Y-m-d H:i:s');


  //Submit validation check functionality start
  $validate_sql = "SELECT COUNT(BreedingAdmin_Travel.Id) as total,COUNT(BreedingAdmin_Travel_MonthwiseDetails.Id) as monthwise_entered_travel_expense,(select COUNT(*)from BreedingAdmin_Travel where Per_visit IS NULL and BreedingAdmin_Travel.CreatedBy = '".$Emp_Id."' and BreedingAdmin_Travel.Currentstatus = 1 and BreedingAdmin_Travel.Rejectionstatus = 1) as empty_count from BreedingAdmin_Travel 
     LEFT JOIN BreedingAdmin_Travel_MonthwiseDetails on BreedingAdmin_Travel.Id = BreedingAdmin_Travel_MonthwiseDetails.Travel_id and BreedingAdmin_Travel_MonthwiseDetails.CreatedBy = '".$Emp_Id."' and BreedingAdmin_Travel_MonthwiseDetails.Currentstatus = 1 and BreedingAdmin_Travel_MonthwiseDetails.Rejectionstatus = 1
    WHERE BreedingAdmin_Travel.CreatedBy = '".$Emp_Id."' and BreedingAdmin_Travel.Currentstatus = 1 and BreedingAdmin_Travel.Rejectionstatus = 1";

  $validate_result   = sqlsrv_query($this->conn,$validate_sql);
  $validated_arr     = sqlsrv_fetch_array($validate_result,SQLSRV_FETCH_ASSOC);
  //Submit validation check functionality end

  if($validated_arr['empty_count'] == 0 && $validated_arr['total'] == $validated_arr['monthwise_entered_travel_expense']) {
      foreach ($data['Travel_id'] as $key => $value) {
        $sql           = "UPDATE BreedingAdmin_Travel SET CurrentStatus = 2 WHERE Id = ".$value."";
        $result_sql    = sqlsrv_query($this->conn,$sql);

         $sql1           = "UPDATE BreedingAdmin_Travel_MonthwiseDetails SET CurrentStatus = 2 WHERE Travel_id = ".$value."";
         $result_sql1    = sqlsrv_query($this->conn,$sql1);
        
      }

      if($result_sql === false || $result_sql1 === false) {
        $status = 0;
      } else {
        $status = 1;
      }
  } else {
        $status = 0; 
  }

  $final_result['Status'] = $status;
  return $final_result;
}



public function exppostingvalue($data)
{
  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $CreatedAt=date('Y-m-d H:i:s');
  $CurrentStatus="1";
  $RejectionStatus="1";

  $status = 0;
  foreach(@$data['expglname'] as $key=>$value)
  {


    $Expglname=@$data['expglname'][$key];

    foreach($data['location'] as $k => $val) {

        $sql = "INSERT INTO BreedingAdmin_Others (Expgroupname,Expglname,Location,CreatedBy,CreatedAt,Currentstatus,Rejectionstatus)output inserted.Id VALUES ('".$Expglname."','".$data['expensegroup']."','".$val."','".$Emp_Id."','".$CreatedAt."','".$CurrentStatus."','".$CurrentStatus."')";

        $result = sqlsrv_query($this->conn,$sql); 
        $Last_Insert_id=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

    }

      $status = 1;

  }
  return array('Status'=>$status);

}


public function Otherexptablerecord($User_Input=array())
{
  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'];
  // $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  // $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';


  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $i=0;
  $Sql="SELECT Expgroupname,Expglname,Location,count(*) over() as TOTALROW,Id from BreedingAdmin_Others where CreatedBy = '".$Emp_Id."' AND Currentstatus = '1' AND RejectionStatus = '1'ORDER BY Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY";

  if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_Others') {
      $Sql="SELECT Expgroupname,Expglname,Location,count(*) over() as TOTALROW,Id from BreedingAdmin_Others where CreatedBy = '".$Emp_Id."' AND Currentstatus = '2' AND RejectionStatus = '1'ORDER BY Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY";
  }

  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $result = array();
    $recordsTotal   = @$Sql_Result['TOTALROW'];
    $result[]       = $sno++;
    $result[]       = $Sql_Result['Expgroupname'];
    $result[]       = $Sql_Result['Expglname']; 
    $result[]       = $Sql_Result['Location']; 

    $from_action    = 'pending'; 

    //check monthwise others expense is exist start   
    $check_sql      = "SELECT COUNT(*) as total FROM BreedingAdmin_Others_MonthwiseDetails WHERE others_id = ".$Sql_Result['Id']." AND Currentstatus = '1' AND RejectionStatus = '1'";
    $from_action = 'pending';
    if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_Others') {
      $check_sql="SELECT COUNT(*) as total FROM BreedingAdmin_Others_MonthwiseDetails WHERE others_id = ".$Sql_Result['Id']." AND Currentstatus = '2' AND RejectionStatus = '1'";
      $from_action = 'completed';
    }
    $result_sql     = sqlsrv_query($this->conn,$check_sql);
    $count          = sqlsrv_fetch_array($result_sql,SQLSRV_FETCH_ASSOC);
    //check monthwise others expense is exist end  

    if($count['total'] > 0) {
      $result[]       = "<button type='button' style='width: 51px;' class='btn btn-sm btn-info others_edit' data-action='edit' data-othersid='".$Sql_Result['Id']."' data-Expgroupname ='".$Sql_Result['Expgroupname']."' data-Expglname='".$Sql_Result['Expglname']."' data-Location ='".$Sql_Result['Location']."' data-fromaction ='".$from_action."'>VIEW</button><button type='button' class='btn btn-sm btn-danger others_delete ms-2' data-action='delete' data-othersid='".$Sql_Result['Id']."' data-fromaction ='".$from_action."'><i class='fa fa-trash'></i></button><input type='hidden' value='".$Sql_Result['Id']."' name='Others_id[]'>"; 
    } else {
      $result[]       = "<button type='button' style='width: 51px;' class='btn btn-sm btn-primary others_add' data-action='add' data-othersid='".$Sql_Result['Id']."' data-Expgroupname ='".$Sql_Result['Expgroupname']."' data-Expglname='".$Sql_Result['Expglname']."' data-Location ='".$Sql_Result['Location']."' data-fromaction ='".$from_action."'>ADD</button><button type='button' class='btn btn-sm btn-danger others_delete ms-2' data-action='delete' data-othersid='".$Sql_Result['Id']."' data-fromaction ='".$from_action."'><i class='fa fa-trash'></i></button><input type='hidden' value='".$Sql_Result['Id']."' name='Others_id[]'>"; 
    }

    // echo "<pre>";print_r($Sql_Result);exit;
    $resultarr[] = $result;
  }
  $res=array();
  if(isset($User_Input['draw']))
  {
    $res['draw'] = @$User_Input['draw'];  
  }else
  {
    $res['draw'] = 1; 
  }
  $res['recordsFiltered'] = @$recordsTotal;
  $res['recordsTotal'] = @$recordsTotal;
  $res['data'] = @$resultarr;
  // $res['sql'] = @$Sql;
  $result = $res;
  return $result;

}

public function Add_Others_expense($data)
{
  // echo "<pre>";print_r($data);exit;
  $Created_date   = date('Y-m-d');
  $CreatedBy     = $_SESSION['EmpID'];
  $CreatedAt     =  date('Y-m-d H:i:s');
  $CurrentStatus  = "1";
  $RejectionStatus= "1";
  $others_id = $data['others_id'];
  
  $status = 1;

  //month value validation start
  // $month_arr = ['jun','jul','aug','sep','oct','nov','dec','jan','feb','mar','apr','may'];
  // foreach ($month_arr as $key => $month) {
  //   $index = $month."_rate";
  //   if($data[$index] == '') {
  //     $status = 0;
  //   }
  // }
  //month value validation end

  if($status == 1) {
    if($data['function'] == 'Add') {
      $sql = "INSERT INTO BreedingAdmin_Others_MonthwiseDetails (others_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,ReqDate,CreatedBy,CreatedAt,Currentstatus,Rejectionstatus) VALUES (".$others_id.",'".$data['jun_rate']."','".$data['jul_rate']."','".$data['aug_rate']."','".$data['sep_rate']."','".$data['oct_rate']."','".$data['nov_rate']."','".$data['dec_rate']."','".$data['jan_rate']."','".$data['feb_rate']."','".$data['mar_rate']."','".$data['apr_rate']."','".$data['may_rate']."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','".$CurrentStatus."','".$RejectionStatus."')";
    } elseif($data['function'] == 'Edit') {
      $sql = "UPDATE BreedingAdmin_Others_MonthwiseDetails SET Jun = '".$data['jun_rate']."',Jul = '".$data['jul_rate']."',Aug = '".$data['aug_rate']."',Sep = '".$data['sep_rate']."',Oct = '".$data['oct_rate']."',Nov = '".$data['nov_rate']."',Dec = '".$data['dec_rate']."',Jan = '".$data['jan_rate']."',Feb = '".$data['feb_rate']."',Mar = '".$data['mar_rate']."',Apr = '".$data['apr_rate']."',May = '".$data['may_rate']."',ModifiedBy = '".$CreatedBy."',ModifiedAt = '".$CreatedAt."' WHERE others_id = ".$others_id."";
    }

    $res = sqlsrv_query($this->conn,$sql);

    if($res === false) {
        $status = 0;
    } else {
        $status = 1;
    }

  }

  return array('Status'=>$status);

}

public function Get_Others_expense($data)
{
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $sql           = "SELECT * FROM BreedingAdmin_Others_MonthwiseDetails WHERE others_id = ".$data['others_id']." AND Currentstatus = '1' AND RejectionStatus = '1'";

  if(isset($data['function']) && $data['function'] == 'completed') {
    $sql           = "SELECT * FROM BreedingAdmin_Others_MonthwiseDetails WHERE others_id = ".$data['others_id']." AND Currentstatus = '2' AND RejectionStatus = '1'";
  }
  $result        = sqlsrv_query($this->conn,$sql);
  $result_arr    = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

  if($result === false) {
    $status = 0;
  } else {
    $status = 1;
  }

  $final_result['Status'] = $status;
  $final_result['data'] = $result_arr;
  return $final_result;
}


public function Delete_Others_expense($data)
{
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $RejectBy      = $_SESSION['EmpID'];
  $RejectAt      =  date('Y-m-d H:i:s');

  $sql           = "UPDATE BreedingAdmin_Others_MonthwiseDetails SET Rejectionstatus = 2,Rejectby = '".$RejectBy."',Rejectat = '".$RejectAt."' WHERE others_id = ".$data['others_id']."";
  $result        = sqlsrv_query($this->conn,$sql);

  $sql1           = "UPDATE BreedingAdmin_Others SET Rejectionstatus = 2,Rejectby = '".$RejectBy."',Rejectat = '".$RejectAt."' WHERE Id = ".$data['others_id']."";
  $result_sql     = sqlsrv_query($this->conn,$sql1);


  if($result === false || $result_sql === false) {
    $status = 0;
  } else {
    $status = 1;
  }

  $final_result['Status'] = $status;
  return $final_result;
}

public function Others_finaldata($data)
{
  // echo "<pre>";print_r($data);exit;
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $RejectBy      = $_SESSION['EmpID'];
  $RejectAt      =  date('Y-m-d H:i:s');


  //Submit validation check functionality start
  $validate_sql = "SELECT COUNT(BreedingAdmin_Others.Id) as total,COUNT(BreedingAdmin_Others_MonthwiseDetails.Id) as monthwise_entered_others_expense from BreedingAdmin_Others 
   LEFT JOIN BreedingAdmin_Others_MonthwiseDetails on BreedingAdmin_Others.Id = BreedingAdmin_Others_MonthwiseDetails.others_id and BreedingAdmin_Others_MonthwiseDetails.CreatedBy = '".$Emp_Id."' and BreedingAdmin_Others_MonthwiseDetails.Currentstatus = 1 and BreedingAdmin_Others_MonthwiseDetails.Rejectionstatus = 1
     WHERE BreedingAdmin_Others.CreatedBy = '".$Emp_Id."' and BreedingAdmin_Others.Currentstatus = 1 and BreedingAdmin_Others.Rejectionstatus = 1";

  $validate_result   = sqlsrv_query($this->conn,$validate_sql);
  $validated_arr     = sqlsrv_fetch_array($validate_result,SQLSRV_FETCH_ASSOC);
  //Submit validation check functionality end

  if($validated_arr['total'] == $validated_arr['monthwise_entered_others_expense']) {
      foreach ($data['Others_id'] as $key => $value) {
        $sql           = "UPDATE BreedingAdmin_Others SET CurrentStatus = 2 WHERE Id = ".$value."";
        $result_sql    = sqlsrv_query($this->conn,$sql);

         $sql1           = "UPDATE BreedingAdmin_Others_MonthwiseDetails SET CurrentStatus = 2 WHERE others_id = ".$value."";
         $result_sql1    = sqlsrv_query($this->conn,$sql1);
        
      }

      if($result_sql === false || $result_sql1 === false) {
        $status = 0;
      } else {
        $status = 1;
      }
  } else {
        $status = 0; 
  }

  $final_result['Status'] = $status;
  return $final_result;
}






public function monthwisestoreconsumables($data)
{

  //  echo "<pre>";print_r($data);
   // exit; 


  $CreatedBy=@$_SESSION['EmpID'];


      //print_r($CreatedBy);
  $Dcode=@$_SESSION['Dcode'];
  $CreatedAt=date('Y-m-d H:i:s');
  $Created_date=date('Y-m-d');
  $CurrentStatus="1";
  $RejectionStatus="1";



 
  $consumableid=@$data['consumableid'];
 


  $status=0;
  if($CreatedBy !=''){



    foreach(@$data['jun_acrage'] as $key=>$value)
    {

     
      $Jun=@$data['jun_acrage'][$key];
      $Jul=@$data['jul_acrage'][$key];
      $Aug=@$data['aug_acrage'][$key];
      $Sep=@$data['sep_acrage'][$key];
      $Oct=@$data['oct_acrage'][$key];
      $Nov=@$data['nov_acrage'][$key];
      $Dec=@$data['dec_acrage'][$key];
      $Jan=@$data['jan_acrage'][$key];
      $Feb=@$data['feb_acrage'][$key];
      $Mar=@$data['mar_acrage'][$key];
      $Apr=@$data['apr_acrage'][$key];
      $May=@$data['may_acrage'][$key];
      $Total_acrage=@$data['Total_acrage'][$key];



      $SQL="SELECT count(*) as leasecount from BreedingAdmin_MonthwiseConsumbales where Consum_id='".$consumableid."'";
       $Result_count=sqlsrv_query($this->conn,$SQL);

        $countvalue=sqlsrv_fetch_array($Result_count,SQLSRV_FETCH_ASSOC);

        $leasecount=$countvalue['leasecount'];

     //   print_r($leasecount);

        if($leasecount==0){



      $SQL="INSERT INTO  BreedingAdmin_MonthwiseConsumbales(Consum_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$consumableid."','".$Jun."','".$Jul."','".$Aug."','".$Sep."','".$Oct."','".$Nov."','".$Dec."','".$Jan."','".$Feb."','".$Mar."','".$Apr."','".$May."','".$Total_acrage."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
       $Result=sqlsrv_query($this->conn,$SQL);

   $status=1;

        }else{


   $SQL="UPDATE BreedingAdmin_MonthwiseConsumbales SET Jun='$Jun',Jul='$Jul',Aug='$Aug',Sep='$Sep',Oct='$Oct',Nov='$Nov',Dec='$Dec',Jan='$Jan',Feb='$Feb',Mar='$Mar',Apr='$Apr',May='$May' Where Consum_id='".$consumableid."'";
       $Result=sqlsrv_query($this->conn,$SQL);

   $status=2;




        }








          // $Last_Insert_id_sub=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);
    

     }


   }else{

    $status=0;


  }


          // $Last_Insert_Id_sub=@$Last_Insert_id_sub['Id'];

  // exit;
  return array('Status'=>$status);
}




  public function ConsumablesMaster($User_Input=array())
  {


    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';



    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;


    $Sql="SELECT TOTALROW = count(*) OVER(),   Material_Description from Farm_Onhand_Stock Group by Material_Description";

    


    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
      $resarr[] = $sno++;
      $resarr[] = utf8_encode(@$Sql_Result['Material_Description']);
      $resarr[] = "Active";










      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }

public function getBreederDetailsManCount($User_Input=array())
{

  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'] !='' ? @$User_Input['length'] : 0;
  $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $resultarrAct=array();
  $maleValuesArray=array();
  $femaleValuesArray=array();

  $maleValuesArrayAct=array();
  $femaleValuesArrayAct=array();
  // $count=array();
  // $count1=array();
  $i=0;


  $Sql="Exec BreedingAdmin_FieldExpense_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
      // echo $Sql;
      // exit;
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $dataarr = array();
    $getLocation=$Sql_Result['BreedingLocation'];
    $dataarr['BreedingLocation'] = $Sql_Result['BreedingLocation'];
    $dataarr['Project'] = $Sql_Result['Project'];
    $dataarr['BreedingActivity'] = $Sql_Result['BreedingActivity'];
    $dataarr['Breedingtype'] = $Sql_Result['Breedingtype'];
    $dataarr['passing_id'] = $Sql_Result['passing_id'];
    $dataarr['passing_id_loc'] = $Sql_Result['passing_id_loc'];
    $dataarr['passing_id_proj'] = $Sql_Result['passing_id_proj'];


    //Get Male and Female Amount

   // Fetch MaleAmount and FemaleAmount based on BreedingLocation
    $qry = "SELECT Location,MaleAmount, FemaleAmount FROM BreedingAdmin_Monthwise_amount WHERE Location = '".$Sql_Result['BreedingLocation']."' AND Activity='22'";

    // echo $qry;
    // exit;
    $res = sqlsrv_query($this->conn, $qry);


    while ($row = sqlsrv_fetch_array($res)) {
       //$cntarr = array();
      $dataarr['MaleAmount'] = $row['MaleAmount'];
      $dataarr['FemaleAmount'] = $row['FemaleAmount'];
      $dataarr['Location'] = $row['Location'];
       // $resultarr1[] = $cntarr;
      $resultarr[] = $dataarr;

    }

  }

  //Additional Activity------------------------------------------------------------------------------------------------------

  $Sql1="Exec BreedingAdmin_FieldExpense_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
      // echo $Sql;
      // exit;
  $Sql_Connection1 =sqlsrv_query($this->conn,$Sql1);
  while($Sql_Result1 = sqlsrv_fetch_array($Sql_Connection1))
  {
    $dataarrAct = array();
    //$getLocation=$Sql_Result['BreedingLocation'];
    $dataarrAct['BreedingLocation'] = $Sql_Result1['BreedingLocation'];
    $dataarrAct['Project'] = $Sql_Result1['Project'];
    $dataarrAct['BreedingActivity'] = $Sql_Result1['BreedingActivity'];
    $dataarrAct['Breedingtype'] = $Sql_Result1['Breedingtype'];
    $dataarrAct['passing_id'] = $Sql_Result1['passing_id'];
    $dataarrAct['passing_id_loc'] = $Sql_Result1['passing_id_loc'];
    $dataarrAct['passing_id_proj'] = $Sql_Result1['passing_id_proj'];

    // Fetch MaleAmount and FemaleAmount based on Activity
    $qryAct = "SELECT Id,Location,MaleAmount, FemaleAmount,Activity FROM BreedingAdmin_Monthwise_amount WHERE Location = '".$Sql_Result1['BreedingLocation']."' AND CurrentStatus='4'";

    // echo $qry;
    // exit;
    $resAct = sqlsrv_query($this->conn, $qryAct);


    while ($rowAct = sqlsrv_fetch_array($resAct)) {

      if($Sql_Result1['BreedingActivity']!=$rowAct['Activity'])
      {
        $dataarrAct['Act_Id'] = $rowAct['Id'];
        $dataarrAct['MaleAmount'] = $rowAct['MaleAmount'];
        $dataarrAct['FemaleAmount'] = $rowAct['FemaleAmount'];
        $dataarrAct['Location'] = $rowAct['Location'];
        $dataarrAct['Activity'] = $rowAct['Activity'];
         // $resultarr1[] = $cntarr;
        $resultarrAct[] = $dataarrAct;
      }
    }

  }

  //Additional Activity------------------------------------------------------------------------------------------------------


      // Serialize each sub-array to make it a string
  $serializedArrays = array_map('serialize', $resultarr);

      // Remove duplicate serialized arrays
  $uniqueSerializedArrays = array_unique($serializedArrays);

      // Unserialize each unique serialized array to get back the original format
  $uniqueArrays = array_map('unserialize', $uniqueSerializedArrays);

      // Reset array keys to start from 0
  $uniqueArrays = array_values($uniqueArrays);

//   echo "<pre>";
//   print_r($uniqueArrays);
// exit;

//Additional Activity------------------------------------------------------------------------------------------------------

    // Serialize each sub-array to make it a string
  $serializedArraysAct = array_map('serialize', $resultarrAct);

      // Remove duplicate serialized arrays
  $uniqueSerializedArraysAct = array_unique($serializedArraysAct);

      // Unserialize each unique serialized array to get back the original format
  $uniqueArraysAct = array_map('unserialize', $uniqueSerializedArraysAct);

      // Reset array keys to start from 0
  $uniqueArraysAct = array_values($uniqueArraysAct);

//     echo "<pre>";
//   print_r($uniqueArraysAct);
// exit;

  //Additional Activity------------------------------------------------------------------------------------------------------


  $resultarr1=array();


 // echo $query;
 // echo"<br>";
 // echo $query1;
 // echo"<br>";





  foreach($uniqueArrays as $mndata)
  {
    $type='Sowing';

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $recordsTotal=0;

    $i=0;

    $Sql="Exec Get_Breed_MFManCount_MonthWise_Datatable @EMPID='".$Emp_Id."',@BreedingLocation='".$mndata['BreedingLocation']."',@Project='".$mndata['Project']."',@BreedingActivity='".$mndata['BreedingActivity']."',@type='".$type."',@Breedingtype='".$mndata['Breedingtype']."' ";

    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($rowval = sqlsrv_fetch_array($Sql_Connection))
    {
     $resultarr1[] = $rowval;
    }
  }


    foreach ($resultarr1 as $key=>$row) {

      if (!empty($uniqueArrays[$key])) {

             $query = "SELECT mcid,Location,Project,Activity,Type,passing_id_loc,passing_id,passing_id_proj,Gender,Count,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May FROM Fieldexpense_Man_Count_Data_Save WHERE Location='".$uniqueArrays[$key]['BreedingLocation']."' AND Project='".$uniqueArrays[$key]['Project']."' AND Activity='".$uniqueArrays[$key]['BreedingActivity']."' AND Type='".$uniqueArrays[$key]['Breedingtype']."' AND Gender='Male'";

             // echo "<br>";
             // echo $query;
             // exit;

           $params = array();
           $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
           $qryRes =sqlsrv_query($this->conn,$query,$params,$options);

           if ($qryRes === false) {
                  die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
                }
                $count = sqlsrv_num_rows($qryRes);



        $query1 = "SELECT mcid,Location,Project,Activity,Type,passing_id_loc,passing_id,passing_id_proj,Gender,Count,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May FROM Fieldexpense_Man_Count_Data_Save WHERE Location='".$uniqueArrays[$key]['BreedingLocation']."' AND Project='".$uniqueArrays[$key]['Project']."' AND Activity='".$uniqueArrays[$key]['BreedingActivity']."' AND Type='".$uniqueArrays[$key]['Breedingtype']."' AND Gender='Female'";

        $params1 = array();
        $options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $qryRes1 =sqlsrv_query($this->conn,$query1,$params1,$options1);

        if ($qryRes1 === false) {
          die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
        }
        $count1 = sqlsrv_num_rows($qryRes1);



        if($count>0)
          {
            while($qryRow = sqlsrv_fetch_array($qryRes))
            {
              $maleValuesArray[] = [
                'gender' => 'Male',
                'malecount' => $qryRow['Count'],
                'Jun_Male_value' => $qryRow['Jun'],
                'Jul_Male_value' => $qryRow['Jul'],
                'Aug_Male_value' => $qryRow['Aug'],
                'Sep_Male_value' => $qryRow['Sep'],
                'Oct_Male_value' => $qryRow['Oct'],
                'Nov_Male_value' => $qryRow['Nov'],
                'Dec_Male_value' => $qryRow['Dec'],
                'Jan_Male_value' => $qryRow['Jan'],
                'Feb_Male_value' => $qryRow['Feb'],
                'Mar_Male_value' => $qryRow['Mar'],
                'Apr_Male_value' => $qryRow['Apr'],
                'May_Male_value' => $qryRow['May'],

              ];
            }

          }
          else
          {
              // Collect male values
            $maleValuesArray[] = [
              'gender' => 'Male',
              'malecount' => $row['malecount'],
              'Jun_Male_value' => $row['Jun_Male_value'],
              'Jul_Male_value' => $row['Jul_Male_value'],
              'Aug_Male_value' => $row['Aug_Male_value'],
              'Sep_Male_value' => $row['Sep_Male_value'],
              'Oct_Male_value' => $row['Oct_Male_value'],
              'Nov_Male_value' => $row['Nov_Male_value'],
              'Dec_Male_value' => $row['Dec_Male_value'],
              'Jan_Male_value' => $row['Jan_Male_value'],
              'Feb_Male_value' => $row['Feb_Male_value'],
              'Mar_Male_value' => $row['Mar_Male_value'],
              'Apr_Male_value' => $row['Apr_Male_value'],
              'May_Male_value' => $row['May_Male_value'],

            ];

          }

          if($count1>0)
          {
            while($qryRow1 = sqlsrv_fetch_array($qryRes1))
            {
                // Collect female values
              $femaleValuesArray[] = [
                'gender' => 'Female',
                'femalecount' => $qryRow1['Count'],
                'Jun_femalevalue' => $qryRow1['Jun'],
                'Jul_femalevalue' => $qryRow1['Jul'],
                'Aug_femalevalue' => $qryRow1['Aug'],
                'Sep_femalevalue' => $qryRow1['Sep'],
                'Oct_femalevalue' => $qryRow1['Oct'],
                'Nov_femalevalue' => $qryRow1['Nov'],
                'Dec_femalevalue' => $qryRow1['Dec'],
                'Jan_femalevalue' => $qryRow1['Jan'],
                'Feb_femalevalue' => $qryRow1['Feb'],
                'Mar_femalevalue' => $qryRow1['Mar'],
                'Apr_femalevalue' => $qryRow1['Apr'],
                'May_femalevalue' => $qryRow1['May'],
              ];
            }

          }
          else
          {    
                          // Collect female values
            $femaleValuesArray[] = [
              'gender' => 'Female',
              'femalecount' => $row['femalecount'],
              'Jun_femalevalue' => $row['Jun_femalevalue'],
              'Jul_femalevalue' => $row['Jul_femalevalue'],
              'Aug_femalevalue' => $row['Aug_femalevalue'],
              'Sep_femalevalue' => $row['Sep_femalevalue'],
              'Oct_femalevalue' => $row['Oct_femalevalue'],
              'Nov_femalevalue' => $row['Nov_femalevalue'],
              'Dec_femalevalue' => $row['Dec_femalevalue'],
              'Jan_femalevalue' => $row['Jan_femalevalue'],
              'Feb_femalevalue' => $row['Feb_femalevalue'],
              'Mar_femalevalue' => $row['Mar_femalevalue'],
              'Apr_femalevalue' => $row['Apr_femalevalue'],
              'May_femalevalue' => $row['May_femalevalue'],
            ];
          }


      }

if (!empty($uniqueArraysAct[$key])) {

        $query2 = "SELECT mcid,Location,Project,Activity,Type,passing_id_loc,passing_id,passing_id_proj,Gender,Count,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May FROM Fieldexpense_Man_Count_Data_Save WHERE Location='".$uniqueArraysAct[$key]['BreedingLocation']."' AND Project='".$uniqueArraysAct[$key]['Project']."' AND Activity='".$uniqueArraysAct[$key]['Activity']."' AND Type='".$uniqueArraysAct[$key]['Breedingtype']."' AND Gender='Male'";

             // echo "<br>";
             // echo $query;
             // exit;

   $params2 = array();
   $options2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
   $qryRes2 =sqlsrv_query($this->conn,$query2,$params2,$options2);

   if ($qryRes2 === false) {
          die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
        }
        $count2 = sqlsrv_num_rows($qryRes2);



        $query3 = "SELECT mcid,Location,Project,Activity,Type,passing_id_loc,passing_id,passing_id_proj,Gender,Count,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May FROM Fieldexpense_Man_Count_Data_Save WHERE Location='".$uniqueArraysAct[$key]['BreedingLocation']."' AND Project='".$uniqueArraysAct[$key]['Project']."' AND Activity='".$uniqueArraysAct[$key]['Activity']."' AND Type='".$uniqueArraysAct[$key]['Breedingtype']."' AND Gender='Female'";

        $params3 = array();
        $options3 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $qryRes3 =sqlsrv_query($this->conn,$query3,$params3,$options3);

        if ($qryRes3 === false) {
          die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
        }
        $count3 = sqlsrv_num_rows($qryRes3);


         if($count2>0)
          {
            while($qryRow2 = sqlsrv_fetch_array($qryRes2))
            {
              $maleValuesArrayAct[] = [
                'gender' => 'Male',
                'malecount' => $qryRow2['Count'],
                'Jun_Male_value' => $qryRow2['Jun'],
                'Jul_Male_value' => $qryRow2['Jul'],
                'Aug_Male_value' => $qryRow2['Aug'],
                'Sep_Male_value' => $qryRow2['Sep'],
                'Oct_Male_value' => $qryRow2['Oct'],
                'Nov_Male_value' => $qryRow2['Nov'],
                'Dec_Male_value' => $qryRow2['Dec'],
                'Jan_Male_value' => $qryRow2['Jan'],
                'Feb_Male_value' => $qryRow2['Feb'],
                'Mar_Male_value' => $qryRow2['Mar'],
                'Apr_Male_value' => $qryRow2['Apr'],
                'May_Male_value' => $qryRow2['May'],

              ];
            }

          }
          else
          {
              // Collect male values
            $maleValuesArrayAct[] = [
              'gender' => 'Male',
              'malecount' => $row['malecount'],
              'Jun_Male_value' => $row['Jun_Male_value'],
              'Jul_Male_value' => $row['Jul_Male_value'],
              'Aug_Male_value' => $row['Aug_Male_value'],
              'Sep_Male_value' => $row['Sep_Male_value'],
              'Oct_Male_value' => $row['Oct_Male_value'],
              'Nov_Male_value' => $row['Nov_Male_value'],
              'Dec_Male_value' => $row['Dec_Male_value'],
              'Jan_Male_value' => $row['Jan_Male_value'],
              'Feb_Male_value' => $row['Feb_Male_value'],
              'Mar_Male_value' => $row['Mar_Male_value'],
              'Apr_Male_value' => $row['Apr_Male_value'],
              'May_Male_value' => $row['May_Male_value'],

            ];

          }


          if($count3>0)
          {
            while($qryRow3 = sqlsrv_fetch_array($qryRes3))
            {
                // Collect female values
              $femaleValuesArrayAct[] = [
                'gender' => 'Female',
                'femalecount' => $qryRow3['Count'],
                'Jun_femalevalue' => $qryRow3['Jun'],
                'Jul_femalevalue' => $qryRow3['Jul'],
                'Aug_femalevalue' => $qryRow3['Aug'],
                'Sep_femalevalue' => $qryRow3['Sep'],
                'Oct_femalevalue' => $qryRow3['Oct'],
                'Nov_femalevalue' => $qryRow3['Nov'],
                'Dec_femalevalue' => $qryRow3['Dec'],
                'Jan_femalevalue' => $qryRow3['Jan'],
                'Feb_femalevalue' => $qryRow3['Feb'],
                'Mar_femalevalue' => $qryRow3['Mar'],
                'Apr_femalevalue' => $qryRow3['Apr'],
                'May_femalevalue' => $qryRow3['May'],
              ];
            }

          }
          else
          {    
            // Collect female values
            $femaleValuesArrayAct[] = [
              'gender' => 'Female',
              'femalecount' => $row['femalecount'],
              'Jun_femalevalue' => $row['Jun_femalevalue'],
              'Jul_femalevalue' => $row['Jul_femalevalue'],
              'Aug_femalevalue' => $row['Aug_femalevalue'],
              'Sep_femalevalue' => $row['Sep_femalevalue'],
              'Oct_femalevalue' => $row['Oct_femalevalue'],
              'Nov_femalevalue' => $row['Nov_femalevalue'],
              'Dec_femalevalue' => $row['Dec_femalevalue'],
              'Jan_femalevalue' => $row['Jan_femalevalue'],
              'Feb_femalevalue' => $row['Feb_femalevalue'],
              'Mar_femalevalue' => $row['Mar_femalevalue'],
              'Apr_femalevalue' => $row['Apr_femalevalue'],
              'May_femalevalue' => $row['May_femalevalue'],
            ];
          }


}         

        }



      


       // echo "<pre>";
       // print_r($femaleValuesArray);
       // exit;

      $res2['data'] = @$uniqueArrays;

      $res2['dataAct'] = @$uniqueArraysAct;

      $res2['male'] = @$maleValuesArray;
      $res2['female'] = @$femaleValuesArray;

      $res2['maleAct'] = @$maleValuesArrayAct;
      $res2['femaleAct'] = @$femaleValuesArrayAct;


     // echo "<pre>";
     // print_r($res2);
     // exit;






  //$res1['cnt'] = @$resultarr1;

      $result = $res2;
  //$result = $res1;
    // echo "<pre>";
    // print_r($result);
    // exit;
      return $result;
    }


public function getBreederDetails($User_Input=array())
{


  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'] !='' ? @$User_Input['length'] : 0;
  $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  //$resultarr1=array();
  $i=0;


  $Sql="Exec BreedingAdmin_FieldExpense_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
     // echo $Sql;
     // exit;
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $dataarr = array();
    $getLocation=$Sql_Result['BreedingLocation'];
    $dataarr['BreedingLocation'] = $Sql_Result['BreedingLocation'];
    $dataarr['Project'] = $Sql_Result['Project'];
    $dataarr['BreedingActivity'] = $Sql_Result['BreedingActivity'];
    $dataarr['Breedingtype'] = $Sql_Result['Breedingtype'];
    $dataarr['passing_id'] = $Sql_Result['passing_id'];
    $dataarr['passing_id_loc'] = $Sql_Result['passing_id_loc'];
    $dataarr['passing_id_proj'] = $Sql_Result['passing_id_proj'];


    //Get Male and Female Amount

   // Fetch MaleAmount and FemaleAmount based on BreedingLocation
    $qry = "SELECT Location,MaleAmount, FemaleAmount FROM BreedingAdmin_Monthwise_amount WHERE Location = '".$Sql_Result['BreedingLocation']."'";
    $res = sqlsrv_query($this->conn, $qry);


    while ($row = sqlsrv_fetch_array($res)) {
       //$cntarr = array();
      $dataarr['MaleAmount'] = $row['MaleAmount'];
      $dataarr['FemaleAmount'] = $row['FemaleAmount'];
      $dataarr['Location'] = $row['Location'];
       // $resultarr1[] = $cntarr;
      $resultarr[] = $dataarr;
    }

    
  }


      // Serialize each sub-array to make it a string
  $serializedArrays = array_map('serialize', $resultarr);

      // Remove duplicate serialized arrays
  $uniqueSerializedArrays = array_unique($serializedArrays);

      // Unserialize each unique serialized array to get back the original format
  $uniqueArrays = array_map('unserialize', $uniqueSerializedArrays);

      // Reset array keys to start from 0
  $uniqueArrays = array_values($uniqueArrays);

     // echo "<pre>";
     // print_r($uniqueArrays);
     // exit;

  $res1['data'] = @$uniqueArrays;





  
  //$res1['cnt'] = @$resultarr1;

  $result = $res1;
  //$result = $res1;
    // echo "<pre>";
    // print_r($result);
    // exit;
  return $result;
}


 public function InsertManCountTableData($User_Input=array())
    {

     // echo "<pre>";print_r($User_Input);
     // exit; 


     $CreatedBy=@$_SESSION['EmpID'];

  //  echo "<pre>";print_r($User_Input['Male']);
  // exit;

     $Location = $User_Input['Location'];
     $Project = $User_Input['Project'];
     $Activity=$User_Input['Activity'];
     $Type = $User_Input['Type'];
     $passing_id = $User_Input['passing_id'];
     $passing_id_loc=$User_Input['passing_id_loc'];
     $passing_id_proj = $User_Input['passing_id_proj'];

     $Activity_Id = @$User_Input['Activity_Id']!='' ?@$User_Input['Activity_Id'] : 0;

     $Gender = $User_Input['Gender'];
     $Count=$User_Input['Count'];
     $Jun = @$User_Input['Jun']!='' ?@$User_Input['Jun'] : 0.00;
     $Jul = @$User_Input['Jul']!='' ?@$User_Input['Jul'] : 0.00;
     $Aug = @$User_Input['Aug']!='' ?@$User_Input['Aug'] : 0.00;
     $Sep = @$User_Input['Sep']!='' ?@$User_Input['Sep'] : 0.00;
     $Oct = @$User_Input['Oct']!='' ?@$User_Input['Oct'] : 0.00;
     $Nov = @$User_Input['Nov']!='' ?@$User_Input['Nov'] : 0.00;
     $Dec = @$User_Input['Dec']!='' ?@$User_Input['Dec'] : 0.00;
     $Jan = @$User_Input['Jan']!='' ?@$User_Input['Jan'] : 0.00;
     $Feb = @$User_Input['Feb']!='' ?@$User_Input['Feb'] : 0.00;
     $Mar = @$User_Input['Mar']!='' ?@$User_Input['Mar'] : 0.00;
     $Apr = @$User_Input['Apr']!='' ?@$User_Input['Apr'] : 0.00;
     $May = @$User_Input['May']!='' ?@$User_Input['May'] : 0.00;

     if($Location && $Gender && ($Activity_Id!='' || $Activity_Id!=0))
     {

      $SqlAct = "SELECT Location,mcid,Activity_Id FROM Fieldexpense_Man_Count_Data_Save WHERE Location='".$Location."' AND Project='".$Project."' AND Activity='".$Activity."' AND Type='".$Type."' AND passing_id_loc='".$passing_id_loc."' AND passing_id='".$passing_id."' AND passing_id_proj='".$passing_id_proj."' AND Gender='".$Gender."' AND Activity_Id='".$Activity_Id."'";

      $paramsAct = array();
      $optionsAct =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $Sql_ConnectionAct =sqlsrv_query($this->conn,$SqlAct,$paramsAct,$optionsAct);

      if ($Sql_ConnectionAct === false) {
    die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
  }
  $countAct = sqlsrv_num_rows($Sql_ConnectionAct);

  if($countAct==0)
  {
    $SQLAct = "INSERT INTO  Fieldexpense_Man_Count_Data_Save(Location,Project,Activity,Type,passing_id_loc,passing_id,passing_id_proj,Gender,Count,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Activity_Id) VALUES('".$Location."','".$Project."','".$Activity."','".$Type."','".$passing_id_loc."','".$passing_id."','".$passing_id_proj."','".$Gender."','".$Count."','".$Jun."','".$Jul."','".$Aug."','".$Sep."','".$Oct."','".$Nov."','".$Dec."','".$Jan."','".$Feb."','".$Mar."','".$Apr."','".$May."','".$Activity_Id."')";

           //echo $SQL;
           //exit;
     $ResultAct = sqlsrv_query($this->conn, $SQLAct);
     if ($ResultAct === false) {
      die(print_r(sqlsrv_errors(), true));
    }
    $status ='Man Count Added Successfully';

  }
  else
  {
    $status ='Man Count Already Added';
  }

}
else if($Location && $Gender)
     {

      $Sql = "SELECT Location,mcid FROM Fieldexpense_Man_Count_Data_Save WHERE Location='".$Location."' AND Project='".$Project."' AND Activity='".$Activity."' AND Type='".$Type."' AND passing_id_loc='".$passing_id_loc."' AND passing_id='".$passing_id."' AND passing_id_proj='".$passing_id_proj."' AND Gender='".$Gender."'";

      $params = array();
      $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
      $Sql_Connection =sqlsrv_query($this->conn,$Sql,$params,$options);

      if ($Sql_Connection === false) {
    die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
  }
  $count = sqlsrv_num_rows($Sql_Connection);

  if($count==0)
  {
    $SQL = "INSERT INTO  Fieldexpense_Man_Count_Data_Save(Location,Project,Activity,Type,passing_id_loc,passing_id,passing_id_proj,Gender,Count,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May) VALUES('".$Location."','".$Project."','".$Activity."','".$Type."','".$passing_id_loc."','".$passing_id."','".$passing_id_proj."','".$Gender."','".$Count."','".$Jun."','".$Jul."','".$Aug."','".$Sep."','".$Oct."','".$Nov."','".$Dec."','".$Jan."','".$Feb."','".$Mar."','".$Apr."','".$May."')";

           //echo $SQL;
           //exit;
     $Result = sqlsrv_query($this->conn, $SQL);
     if ($Result === false) {
      die(print_r(sqlsrv_errors(), true));
    }
    $status ='Man Count Added Successfully';

  }
  else
  {
    $status ='Man Count Already Added';
  }

}
else
{
  $status='Please Check Post Data';
}



return array('Status'=>$status);
}


public function UpdateManCountTableData($User_Input=array())
{

   // echo "<pre>";print_r($User_Input);
   // exit;

 $Location = $User_Input['Location'];
 $Project = $User_Input['Project'];
 $Activity=$User_Input['Activity'];
 $Type = $User_Input['Type'];
 $passing_id = $User_Input['passing_id'];
 $passing_id_loc=$User_Input['passing_id_loc'];
 $passing_id_proj = $User_Input['passing_id_proj'];
 $Activity_Id = @$User_Input['Activity_Id']!='' ?@$User_Input['Activity_Id'] : 0;
 $Gender = $User_Input['Gender'];
 $Count=$User_Input['Count'];

 $Jun = @$User_Input['Jun']!='' ?@$User_Input['Jun'] : 0.00;
     $Jul = @$User_Input['Jul']!='' ?@$User_Input['Jul'] : 0.00;
     $Aug = @$User_Input['Aug']!='' ?@$User_Input['Aug'] : 0.00;
     $Sep = @$User_Input['Sep']!='' ?@$User_Input['Sep'] : 0.00;
     $Oct = @$User_Input['Oct']!='' ?@$User_Input['Oct'] : 0.00;
     $Nov = @$User_Input['Nov']!='' ?@$User_Input['Nov'] : 0.00;
     $Dec = @$User_Input['Dec']!='' ?@$User_Input['Dec'] : 0.00;
     $Jan = @$User_Input['Jan']!='' ?@$User_Input['Jan'] : 0.00;
     $Feb = @$User_Input['Feb']!='' ?@$User_Input['Feb'] : 0.00;
     $Mar = @$User_Input['Mar']!='' ?@$User_Input['Mar'] : 0.00;
     $Apr = @$User_Input['Apr']!='' ?@$User_Input['Apr'] : 0.00;
     $May = @$User_Input['May']!='' ?@$User_Input['May'] : 0.00;


 // $Jun = $User_Input['Jun'];
 // $Jul = $User_Input['Jul'];
 // $Aug = $User_Input['Aug'];
 // $Sep = $User_Input['Sep'];
 // $Oct = $User_Input['Oct'];
 // $Nov = $User_Input['Nov'];
 // $Dec = $User_Input['Dec'];
 // $Jan = $User_Input['Jan'];
 // $Feb = $User_Input['Feb'];
 // $Mar = $User_Input['Mar'];
 // $Apr = $User_Input['Apr'];
 // $May = $User_Input['May']; 


 $CreatedBy=@$_SESSION['EmpID'];


 if($Location && $Gender && ($Activity_Id!='' || $Activity_Id!=0))
 {

  $Sql = "SELECT Location,mcid,Activity_Id FROM Fieldexpense_Man_Count_Data_Save WHERE Location='".$Location."' AND Project='".$Project."' AND Activity='".$Activity."' AND Type='".$Type."' AND passing_id_loc='".$passing_id_loc."' AND passing_id='".$passing_id."' AND passing_id_proj='".$passing_id_proj."' AND Gender='".$Gender."' AND Activity_Id='".$Activity_Id."'";

  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $Sql_Connection =sqlsrv_query($this->conn,$Sql,$params,$options);

  if ($Sql_Connection === false) {
    die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
  }
  $count = sqlsrv_num_rows($Sql_Connection);

     // echo $count;
     // exit;

  $MCId='';
  $ActId='';



  if($count>0)
  {
    while($row=sqlsrv_fetch_array($Sql_Connection))
    { 
      $MCId=$row['mcid'];
      $ActId=$row['Activity_Id'];
    }

    $query ="UPDATE Fieldexpense_Man_Count_Data_Save SET Jun='".$Jun."',Jul='".$Jul."',Aug='".$Aug."',Sep='".$Sep."',Oct='".$Oct."',Nov='".$Nov."',Dec='".$Dec."',Jan='".$Jan."',Feb='".$Feb."',Mar='".$Mar."',Apr='".$Apr."',May='".$May."' WHERE mcid='".$MCId."' AND Activity_Id='".$ActId."'";
    $rest =sqlsrv_query($this->conn,$query);

    // echo  $query;
    // exit;

    $status ='Man Count Act MonthWise Updated Successfully';
  }
  else
  {
    $status ='Update Failed';
  }


}
 else if($Location && $Gender)
 {

  $Sql1 = "SELECT Location,mcid FROM Fieldexpense_Man_Count_Data_Save WHERE Location='".$Location."' AND Project='".$Project."' AND Activity='".$Activity."' AND Type='".$Type."' AND passing_id_loc='".$passing_id_loc."' AND passing_id='".$passing_id."' AND passing_id_proj='".$passing_id_proj."' AND Gender='".$Gender."'";

  $params1 = array();
  $options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $Sql_Connection1 =sqlsrv_query($this->conn,$Sql1,$params1,$options1);

  if ($Sql_Connection1 === false) {
    die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
  }
  $count1 = sqlsrv_num_rows($Sql_Connection1);

     // echo $count;
     // exit;

  $MCId1='';



  if($count1>0)
  {
    while($row1=sqlsrv_fetch_array($Sql_Connection1))
    { 
      $MCId1=$row1['mcid'];
    }

    $query1 ="UPDATE Fieldexpense_Man_Count_Data_Save SET Jun='".$Jun."',Jul='".$Jul."',Aug='".$Aug."',Sep='".$Sep."',Oct='".$Oct."',Nov='".$Nov."',Dec='".$Dec."',Jan='".$Jan."',Feb='".$Feb."',Mar='".$Mar."',Apr='".$Apr."',May='".$May."' WHERE mcid='".$MCId1."'";
    $rest1 =sqlsrv_query($this->conn,$query1);

    // echo  $query;
    // exit;

    $status ='Man Count MonthWise Updated Successfully';
  }
  else
  {
    $status ='Update Failed';
  }


}
else
{
  $status='Please Check Post Data';
}



return array('Status'=>$status);
}





public function AssumptionEnrty_malefemaleamount_activity($User_Input=array())
  {
    // echo "<pre>";
    // print_r($User_Input);
    // exit;

   $location = @$User_Input['location'] !='' ? @$User_Input['location'] : 0;
   $activity = @$User_Input['activity'] !='' ? @$User_Input['activity'] : 0;
    $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
    $Length=@$User_Input['length'];
    $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
    $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    $Dcode=$_SESSION['Dcode'];
    $sno=$Offset+1;
    $recordsTotal=0;
    $resultarr=array();
    $i=0;

    $CreatedBy=@$_SESSION['EmpID'];
    $CreatedAt=date('Y-m-d H:i:s');
    $Created_date=date('Y-m-d');

    if($location!='' && $activity!='')
    {
      // foreach($location as $val)
      // {
      //   foreach($activity as $act)
        $Sql12 = "SELECT Location,Id FROM BreedingAdmin_Monthwise_amount WHERE Location='".$location."' AND (Activity != '22' AND Activity='".$activity."') AND CreatedBy='".$_SESSION['EmpID']."'";

        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $exec =sqlsrv_query($this->conn,$Sql12,$params,$options);

        if ($exec === false) {
          die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
        }
        $cnt = sqlsrv_num_rows($exec);

           // echo $count;
           // exit;

        if($cnt==0)
        {
           $SQL1="INSERT INTO  BreedingAdmin_Monthwise_amount(Docid,Ordernum,Location,Frommonth,Tomonth,MaleAmount,FemaleAmount,CreatedBy,CreatedAt,CurrentStatus,Activity) VALUES('0','0','".$location."','0','0','0','0','".$CreatedBy."','".$CreatedAt."',3,'".$activity."')";

          //$SQL1="INSERT INTO  BreedingAdmin_Monthwise_amount(Location,CreatedBy,CreatedAt) VALUES('".$val."','".$CreatedBy."','".$CreatedAt."')";

             // echo $SQL1;
             // exit;


           $Result1=sqlsrv_query($this->conn,$SQL1);
        }
      }
    //}

    // $Sql="Exec BreedingAdmin_Assumption_Datatable_MaleFemale @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql = "SELECT *,COUNT(*) OVER() as TOTALROW FROM BreedingAdmin_Monthwise_amount WHERE CreatedBy = '".$_SESSION['EmpID']."' AND Currentstatus = '3' ORDER BY Id OFFSET ".$Offset." ROWS FETCH NEXT ".$Length." ROWS ONLY"; 
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = "<input type='hidden' class='monthwise_amt_id_act' name='monthwise_amt_id_act[]' value='".$Sql_Result['Id']."'>".utf8_encode(@$Sql_Result['Location'])."<input type='hidden' id='example-input-small-act'  class='form-control form-control-sm assumlocationdataAct' placeholder='count' name='Assumlocation_month_act[]' style='width: 10px;' value='".utf8_encode(@$Sql_Result['Location'])."'>";

      $resarr[] = utf8_encode(@$Sql_Result['Activity'])."<input type='hidden' id='example-input-small-act'  class='form-control form-control-sm assumlocationdataAct' placeholder='count' name='Assumlocation_month_act[]' style='width: 10px;' value='".utf8_encode(@$Sql_Result['Activity'])."'>";


      $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign month_act' data-monthtype_act='from' value='".$Sql_Result['Frommonth']."' name='Frommonthact[]' style='width: 60px;'>"; 

      $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign month_act' data-monthtype_act='to' value='".$Sql_Result['Tomonth']."' name='tomonthact[]' style='width: 60px;'>"; 


      $resarr[]="<input type='number'   class='form-control form-control-sm amount_act' data-gender_act='male' name='maleamountact[]' value='".$Sql_Result['MaleAmount']."' style='width: 60px;'>"; 


      $resarr[]="<input type='number'   class='form-control form-control-sm amount_act' data-gender_act='female' name='femaleamountact[]' value='".$Sql_Result['FemaleAmount']."' style='width: 60px;'>";

      $resarr[]="<button class='btn btn-primary btn-sm delete_activity_amount' data-activityid='".$Sql_Result['Id']."' data-activityloc='".$Sql_Result['Location']."' data-activity='".$Sql_Result['Activity']."'>Delete</button>";


      $resultarr[] = $resarr;
      $i++;
    }
    $res=array();
    if(isset($User_Input['draw']))
    {
      $res['draw'] = @$User_Input['draw'];  
    }else
    {
      $res['draw'] = 1; 
    }
    $res['recordsFiltered'] = @$recordsTotal;
    $res['recordsTotal'] = @$recordsTotal;
    $res['data'] = @$resultarr;
    $res['sql'] = @$Sql;
    $result = $res;
    return $result;
  }

  public function update_location_responsible_person($data)
  {
    $SQL1 = "UPDATE BreedingAdmin_Location SET responsible_person = '".$data['res_person']."' Where Id='".$data['location_id']."'";

    $Result1=sqlsrv_query($this->conn,$SQL1);
    
    if($Result1 == false) {
      $status = 0;
    } else {
      $status = 1;
    }

    return $status;
  }

  public function Get_UOM_Details($data)
  {
    $final_arr = [];
    if(isset($data['location_name']) && !isset($data['project_name'])) {
        $SQL = "SELECT DISTINCT ConsumProject from BreedingAdmin_Consumables 
        inner join BreedingAdmin_Consumablestype ON BreedingAdmin_Consumables.Id = BreedingAdmin_Consumablestype.Docid
        where BreedingAdmin_Consumables.Rejectionstatus IS NULL AND BreedingAdmin_Consumables.CreatedBy = '".$_SESSION['EmpID']."' AND ConsumLocation = '".$data['location_name']."'";
    }

    if(isset($data['location_name']) && isset($data['project_name'])) {
        $project_names = implode(',',$data['project_name']);
        $SQL = "SELECT DISTINCT Breedingconsumables from BreedingAdmin_Consumables 
        inner join BreedingAdmin_Consumablestype ON BreedingAdmin_Consumables.Id = BreedingAdmin_Consumablestype.Docid
        where BreedingAdmin_Consumables.Rejectionstatus IS NULL AND BreedingAdmin_Consumables.CreatedBy = '".$_SESSION['EmpID']."' AND ConsumLocation = '".$data['location_name']."' AND ConsumProject IN ('".$project_names."')";
    }

    $Result=sqlsrv_query($this->conn,$SQL);

    while($row = sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC)) {
      $final_arr[] = $row; 
    }
    
    return $final_arr;

  }

  public function update_consumables_uom($data)
  {
    $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    if($data['type'] == 'single') {
      $SQL1 = "UPDATE BreedingAdmin_Consumablestype SET UOM = '".$data['uom_value']."' Where Id='".$data['consum_type_id']."'";

      $Result1=sqlsrv_query($this->conn,$SQL1);
      
      if($Result1 == false) {
        $status = 0;
      } else {
        $status = 1;
      }
    } elseif ($data['type'] == 'bulk') {
      $autoid = 0;
      $Offset = 0;
      $Length = 50000;
      $location = $data['location_name'];
      $project_names = implode(',',$data['project_name']);
      $consumables = implode(',',$data['consumables']);

      // $Sql = "SELECT BreedingAdmin_Consumablestype.Id As consumtypeid from BreedingAdmin_Consumables
      // inner join BreedingAdmin_Consumablestype On BreedingAdmin_Consumablestype.Docid=BreedingAdmin_Consumables.id AND BreedingAdmin_Consumablestype.Rejectionstatus IS NULL Where 1=1 and BreedingAdmin_Consumables.Currentstatus=''1'' AND BreedingAdmin_Consumables.Rejectionstatus IS NULL AND BreedingAdmin_Consumables.CreatedBy  = '".$Emp_Id."'";

        $Sql="Exec BreedingAdmin_Consumption_Datatable_UOM @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length.",@location='".$location."',@project='".$project_names."',@consumables='".$consumables."'";
        $Sql_Connection =sqlsrv_query($this->conn,$Sql);
        while($Sql_Result = sqlsrv_fetch_array($Sql_Connection)) {
             $SQL1 = "UPDATE BreedingAdmin_Consumablestype SET UOM = '".$data['uom_value']."' Where Id='".$Sql_Result['consumtypeid']."'";

             $Result1=sqlsrv_query($this->conn,$SQL1);

             if($Result1 == false) {
                $status = 0;
             } else {
              $status = 1;
             }
        }
    }
    return $status;
  }




public function getConsumablesReport($User_Input=array())
{


  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'] !='' ? @$User_Input['length'] : 0;
  $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;
  $resultarr = array();

            $type='Sowing';

            //$Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
            $Emp_Id = 'RS7361';

            $Dcode=$_SESSION['Dcode'];
            $recordsTotal=0;

            $i=0;

            $Sql="Exec Get_Breed_Consumable_MonthWise_Datatable_Div @EMPID='".$Emp_Id."',@type='".$type."' ";

            //echo $Sql;exit;
         

            $SqlCon =sqlsrv_query($this->conn,$Sql);

          //   if ($SqlCon === false) {
          //     die(print_r(sqlsrv_errors(), true));
          // }
            while($rowVal = sqlsrv_fetch_array($SqlCon))
            {
              $dataarr = array();
            $dataarr['ConsumLocation'] = $rowVal['ConsumLocation'];
            $dataarr['ConsumProject'] = $rowVal['ConsumProject'];
            $dataarr['Breedingconsumables'] = $rowVal['Breedingconsumables'];
            $dataarr['acre'] = $rowVal['acre'];
             $dataarr['UOM'] = $rowVal['UOM'];
             $dataarr['totalacreage'] = $rowVal['totalacreage'];
             $dataarr['Jun_Consume_value'] = $rowVal['Jun_Consume_value'];
             $dataarr['Jul_Consume_value'] = $rowVal['Jul_Consume_value'];
             $dataarr['Aug_Consume_value'] = $rowVal['Aug_Consume_value'];
             $dataarr['Sep_Consume_value'] = $rowVal['Sep_Consume_value'];
             $dataarr['Oct_Consume_value'] = $rowVal['Oct_Consume_value'];
             $dataarr['Nov_Consume_value'] = $rowVal['Nov_Consume_value'];
             $dataarr['Dec_Consume_value'] = $rowVal['Dec_Consume_value'];
             $dataarr['Jan_Consume_value'] = $rowVal['Jan_Consume_value'];
             $dataarr['Feb_Consume_value'] = $rowVal['Feb_Consume_value'];
             $dataarr['Mar_Consume_value'] = $rowVal['Mar_Consume_value'];
             $dataarr['Apr_Consume_value'] = $rowVal['Apr_Consume_value'];
             $dataarr['May_Consume_value'] = $rowVal['May_Consume_value'];

             $resultarr[] = $dataarr;
            }
            $res['data'] = $resultarr;

            $result = $res;
           return $result; 

            //echo "<pre>";print_r($resultarr);exit;    
}


public function getLocationWiseLandLeaseData($User_Input=array())
{
  // echo "<pre>";
  // print_r($User_Input);
  // exit;


  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'] !='' ? @$User_Input['length'] : 0;
  $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $resultarr1=array();
  $i=0;

  $Location=@$User_Input['Location'] !='' ? @$User_Input['Location'] : 0;

if($Location!='')
{
        $Loc = implode(",",$Location);

           $getToYearP = date('Y');
            $getFromYearP = $getToYearP-1;
            $Breeding_YearP = $getFromYearP."-".$getToYearP;

        $Sql="Select * from BreedingAdmin_Land_Lease_master where Location in ('".$Loc."') AND Breeding_Year = '".$Breeding_YearP."'";
            // echo $Sql;
            // exit;
        $Sql_Connection =sqlsrv_query($this->conn,$Sql);
        while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
        {
          $dataarr = array();
          $dataarr['Id'] = $Sql_Result['Id'];
          $dataarr['Location'] = $Sql_Result['Location'];
          $dataarr['Crop'] = $Sql_Result['Crop'];
          $dataarr['Status'] = $Sql_Result['Status'];
          $dataarr['VendorName'] = $Sql_Result['VendorName'];
          $dataarr['VendorCode'] = $Sql_Result['VendorCode'];
          $dataarr['NoOfAcres'] = $Sql_Result['Acre'];
          $dataarr['PerAcre'] = $Sql_Result['PerAcre'];
            $resultarr[] = $dataarr;
          }

           // Fetch MaleAmount and FemaleAmount based on BreedingLocation
            $qryExec = "SELECT DISTINCT Crop FROM BreedingAdmin_Land_Lease_master";
            $execD = sqlsrv_query($this->conn, $qryExec);


            while ($rowExec = sqlsrv_fetch_array($execD)) {
             
              $resultarr1[] = $rowExec;
            }

        $res['data'] = @$resultarr;
        $res['crop'] = @$resultarr1;
      }

        $result = $res;
          // echo "<pre>";
          // print_r($result);
          // exit;
        return $result;
}

public function Get_tfa_employees($data)
{
  $Byear         = $this->get_current_business_year();
  $final_result  = []; 
  $result_arr    = [];
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $sql           = "SELECT DISTINCT TFA_Reqno,Name FROM BreedingAdmin_TFA_Details WHERE Location = '".$data['location']."' AND Rejectionstatus IS NULL";

  $result        = sqlsrv_query($this->conn,$sql);
  while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
      $arr['Name'] = utf8_encode($row['Name']);
      $arr['TFA_Reqno'] = utf8_encode($row['TFA_Reqno']);
      $result_arr[] = $arr;
  }

  if($result === false) {
    $status = 0;
  } else {
    $status = 1;
  }

  $final_result['Status'] = $status;
  $final_result['data'] = $result_arr;
  return $final_result;
}



public function InsertLeaseLandVendorDetails($User_Input)
{
  // echo "<pre>";
  // print_r($User_Input);
  // exit;
  $lease_loc = @$User_Input['lease_loc'];
  $crop = @$User_Input['crop'];
  $vendorStatus = @$User_Input['status'];
  $vendor_name = @$User_Input['vendor_name'];
  $vendor_code = @$User_Input['vendor_code'];
  $no_of_acres = @$User_Input['no_of_acres'];
  $per_acre = @$User_Input['per_acre'];
  $from_date = @$User_Input['from_date'];
  $to_date = @$User_Input['to_date'];

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

    if($lease_loc!='')
      {
        foreach($lease_loc as $key=>$loc)
        {
          if($loc!='' && $loc!=null)
          {
            // echo"<br>";
            // echo $loc;
            // $fromDate = date("d-m-Y", strtotime($from_date[$key]));
            // $toDate = date("d-m-Y", strtotime($to_date[$key]));
            $exp = explode('-',$from_date[$key]);
            $getFromYear = $exp[1];
            $getToYear = $getFromYear+1;
            $Breeding_Year = $getFromYear."-".$getToYear;
            $cDate = date("Y-m-d H:i:s");
            $query = "select * from BreedingAdmin_Land_Lease_master where Frommonth='".$from_date[$key]."' AND Tomonth='".$to_date[$key]."' AND CreatedBy='".$Emp_Id."' AND VendorName='".$vendor_name[$key]."' AND Location='".$lease_loc[$key]."'";

            $params = array();
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $exec =sqlsrv_query($this->conn,$query,$params,$options);

            if ($exec === false) {
              die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
            }
            $cnt = sqlsrv_num_rows($exec);
            if($cnt==0)
            {
               $insQry = "insert into BreedingAdmin_Land_Lease_master(Location,Crop,VendorCode,VendorName,Acre,PerAcre,Status,Frommonth,Tomonth,Breeding_Year,CreatedBy,CreatedAt,Currentstatus) values('".$lease_loc[$key]."','".$crop[$key]."','".$vendor_code[$key]."','".$vendor_name[$key]."','".$no_of_acres[$key]."','".$per_acre[$key]."','".$vendorStatus[$key]."','".$from_date[$key]."','".$to_date[$key]."','".$Breeding_Year."','".$Emp_Id."','".$cDate."',1)";

               // echo $insQry;
               // exit;
               
              if($Result=sqlsrv_query($this->conn,$insQry))
              {
                $status=1;
              }
              else
              {
                $status=2;
              }
            }
          }
          else
          {
            $status=3;
          }
       }
     }
    return array('Status'=>$status);
}

public function getCompletedLocationWiseLandLeaseData()
{
       $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
       $resultarr =array();
       $resultarr1 =array();
       $getFromYear = date('Y');
       $getToYear = $getFromYear+1;
       $Breeding_Year = $getFromYear."-".$getToYear;

        $Sql="Select * from BreedingAdmin_Land_Lease_master where Breeding_Year = '".$Breeding_Year."' AND Currentstatus=1 AND CreatedBy='".$Emp_Id."' AND COALESCE(Rejectionstatus, '') <> '1'";
            // echo $Sql;
            // exit;
        $Sql_Connection =sqlsrv_query($this->conn,$Sql);
        while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
        {
          $dataarr = array();
          $dataarr['Id'] = $Sql_Result['Id'];
          $dataarr['Location'] = $Sql_Result['Location'];
          $dataarr['Crop'] = $Sql_Result['Crop'];
          $dataarr['Status'] = $Sql_Result['Status'];
          $dataarr['VendorName'] = $Sql_Result['VendorName'];
          $dataarr['VendorCode'] = $Sql_Result['VendorCode'];
          $dataarr['NoOfAcres'] = $Sql_Result['Acre'];
          $dataarr['PerAcre'] = $Sql_Result['PerAcre'];
          $dataarr['Frommonth'] = $Sql_Result['Frommonth'];
          $dataarr['Tomonth'] = $Sql_Result['Tomonth'];
          $dataarr['Breeding_Year'] = $Sql_Result['Breeding_Year'];
            $resultarr[] = $dataarr;
          }

        // Fetch MaleAmount and FemaleAmount based on BreedingLocation
            $qryExec = "SELECT DISTINCT Crop FROM BreedingAdmin_Land_Lease_master";
            $execD = sqlsrv_query($this->conn, $qryExec);


            while ($rowExec = sqlsrv_fetch_array($execD)) {
             
              $resultarr1[] = $rowExec;
            }

        $res['data'] = @$resultarr;
        $res['crop'] = @$resultarr1;

        $result = $res;
        return $result;
}

public function FinaltabledetailslandCompleted($User_Input)
{
  // echo "<pre>";
  // print_r($User_Input);
  // exit;
  
  $location = @$User_Input['location'];
  $dataId = @$User_Input['dataId'];
  $crop = @$User_Input['crop'];
  $status = @$User_Input['status'];
  $vendorName = @$User_Input['vendorName'];
  $vendorCode = @$User_Input['vendorCode'];
  $no_of_acres = @$User_Input['no_of_acres'];
  $per_acre = @$User_Input['per_acre'];
  $fromMonth = @$User_Input['fromMonth'];
  $toMonth = @$User_Input['toMonth'];

   $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

   $UpdQry ="UPDATE BreedingAdmin_Land_Lease_master SET Crop='".$crop."',Status='".$status."',Acre='".$no_of_acres."',PerAcre='".$per_acre."' WHERE Id='".$dataId."'";
    if($UpdExec=sqlsrv_query($this->conn,$UpdQry))
    {
      $status=1;
    }
    else
    {
      $status=2;
    }


  
    return array('Status'=>$status);
}

public function DeleteFinaltabledetailslandCompleted($User_Input)
{
  $dataId = @$User_Input['Id'];
  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $rDate = date("Y-m-d H:i:s");

   $RejQry ="UPDATE BreedingAdmin_Land_Lease_master SET Rejectionstatus=1, RejectBy='".$Emp_Id."',Rejectat='".$rDate."' WHERE Id='".$dataId."' AND CreatedBy='".$Emp_Id."'";
    if($RejExec=sqlsrv_query($this->conn,$RejQry))
    {
      $status=1;
    }
    else
    {
      $status=2;
    }

    return array('Status'=>$status);
}

public function getAddLandLeaseData($User_Input=array())
{
  // echo "<pre>";
  // print_r($User_Input);
  // exit;


  $Offset=@$User_Input['start'] !='' ? @$User_Input['start'] : 0;
  $Length=@$User_Input['length'] !='' ? @$User_Input['length'] : 0;
  $Autoincnum=@$User_Input['Autoincnum']!='' ? @$User_Input['Autoincnum'] : 0;
  $autoid=@$User_Input['autoid']!='' ? @$User_Input['autoid'] : 0;

  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

//  $Autoincnum=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';

  $Dcode=$_SESSION['Dcode'];
  $sno=$Offset+1;
  $recordsTotal=0;
  $resultarr=array();
  $resultarr1=array();
  $i=0;

  $Location=@$User_Input['Location'] !='' ? @$User_Input['Location'] : 0;

if($Location!='')
{
       $Loc = implode(",",$Location);
       $getFromYear = date('Y');
       $getToYear = $getFromYear+1;
       $Breeding_Year = $getFromYear."-".$getToYear;

        $Sql="Select * from BreedingAdmin_Land_Lease_master where Location in ('".$Loc."') AND Breeding_Year = '".$Breeding_Year."'";
            // echo $Sql;
            // exit;
        $Sql_Connection =sqlsrv_query($this->conn,$Sql);
        while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
        {
          $dataarr = array();
          $dataarr['Id'] = $Sql_Result['Id'];
          $dataarr['Location'] = $Sql_Result['Location'];
          $dataarr['Crop'] = $Sql_Result['Crop'];
          $dataarr['Status'] = $Sql_Result['Status'];
          $dataarr['VendorName'] = $Sql_Result['VendorName'];
          $dataarr['VendorCode'] = $Sql_Result['VendorCode'];
          $dataarr['NoOfAcres'] = $Sql_Result['Acre'];
          $dataarr['PerAcre'] = $Sql_Result['PerAcre'];
          $dataarr['Frommonth'] = $Sql_Result['Frommonth'];
          $dataarr['Tomonth'] = $Sql_Result['Tomonth'];
          $dataarr['Currentstatus'] = $Sql_Result['Currentstatus'];
          $dataarr['Rejectionstatus'] = $Sql_Result['Rejectionstatus'];
            $resultarr[] = $dataarr;
          }

           // Fetch MaleAmount and FemaleAmount based on BreedingLocation
            $qryExec = "SELECT DISTINCT Crop FROM BreedingAdmin_Land_Lease_master";
            $execD = sqlsrv_query($this->conn, $qryExec);


            while ($rowExec = sqlsrv_fetch_array($execD)) {
             
              $resultarr1[] = $rowExec;
            }

        $res['data'] = @$resultarr;
        $res['crop'] = @$resultarr1;
      }

        $result = $res;
          // echo "<pre>";
          // print_r($result);
          // exit;
        return $result;
}

public function last_entered_to_month($from,$location,$TFA_Reqno,$month)
{
    $current_byear = $this->get_current_business_year();
    $valid_sql = "SELECT TOP 1 to_month from BreedingAdmin_TFA_Details where Location= '".$location."' and TFA_Reqno = '".$TFA_Reqno."' and Breeding_year = '".$current_byear['Business_Year']."' and Rejectionstatus IS NULL order by CONVERT(datetime, to_month+'-01') DESC";

    $result  = sqlsrv_query($this->conn,$valid_sql); 
    $res_arr = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
    return $res_arr;
}

public function TFA_fields_update($data)
{
  if($data['from'] == 'from_month') {

    //validation check for entered month is already exist functionality start
    $validation_res_arr    = $this->last_entered_to_month($data['from'],$data['location'],$data['TFA_Reqno'],$data['from_month']);
    $to_month_last_date    = date('t',strtotime('01-'.$validation_res_arr['to_month']));
    $last_entered_to_month = $to_month_last_date.'-'.$validation_res_arr['to_month'];
    $current_from_month    = '01-'.$data['from_month'];
    if(strtotime($current_from_month) < strtotime($last_entered_to_month)) {
      $status = 0;
      return array('status'=>$status);
    }
    //validation check for entered month is already exist functionality end

    $SQL1 = "UPDATE BreedingAdmin_TFA_Details SET from_month = '".$data['from_month']."' Where Id='".$data['id']."'";
  } elseif($data['from'] == 'to_month') {

    //validation check for entered to month is greater than that from month functionality start
    $from_month          = '01-'.$data['from_month'];
    $to_month_last_date  = date('t',strtotime('01-'.$data['to_month']));
    $current_to_month    = $to_month_last_date.'-'.$data['to_month'];
    if(strtotime($current_to_month) < strtotime($from_month)) {
      $status = 0;
      return array('status'=>$status);
    }     
    //validation check for entered to month is greater than that from month functionality end


    $SQL1 = "UPDATE BreedingAdmin_TFA_Details SET to_month = '".$data['to_month']."' Where Id='".$data['id']."'";
  } elseif($data['from'] == 'current_rate') {
    $SQL1 = "UPDATE BreedingAdmin_TFA_Details SET Existing_rate = '".$data['current_rate']."' Where Id='".$data['id']."'";
  } elseif($data['from'] == 'crop') {
    $SQL1 = "UPDATE BreedingAdmin_TFA_Details SET Crop = '".$data['crop']."' Where Id='".$data['id']."'";
  }
    
  $Result1=sqlsrv_query($this->conn,$SQL1);

  if($Result1 == false) {
    $status = 0;
  } else {
    $status = 1;
  }

  return array('status'=>$status);
}

public function Add_TFA_row($data)
{
  // echo "<pre>";print_r($data);exit;
  $current_byear = $this->get_current_business_year();
  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $CreatedAt=date('Y-m-d H:i:s');
  $CurrentStatus="1";


  //validation check for entered month is completed within business year
    $valid_sql = "SELECT TOP 1 from_month,to_month from BreedingAdmin_TFA_Details where Location= '".$data['location']."' and TFA_Reqno = '".$data['TFA_Reqno']."' and Breeding_year = '".$current_byear['Business_Year']."' and Rejectionstatus IS NULL ORDER BY CONVERT(datetime,to_month+'-01') DESC";
    $valid_result  = sqlsrv_query($this->conn,$valid_sql); 
    $res_arr = sqlsrv_fetch_array($valid_result,SQLSRV_FETCH_ASSOC);
    if($res_arr['to_month'] == date('m-Y',strtotime($current_byear['to_date']))) {
        $status = 0;
        return array('Status'=>$status);
    } else {
      $sql = "INSERT INTO BreedingAdmin_TFA_Details (TFA_Reqno,Location,Name,Breeding_year,CreatedBy,CreatedAt,Currentstatus) VALUES ('".$data['TFA_Reqno']."','".$data['location']."','".$data['name']."','".$current_byear['Business_Year']."','".$Emp_Id."','".$CreatedAt."','".$CurrentStatus."')";
      $result = sqlsrv_query($this->conn,$sql); 
    }  

  if($result === false) {
      $status = 0;
  } else {
      $status = 1;
  }

  return array('Status'=>$status);
}

}

?>