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

       AND BreedingAdmin_Type.Breedingtype='".@$breedingloc."' and BreedingLocation='".@$location_val."' and Project='".$project_val."' ";

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



 public function ProjectWiseDetails($User_Input=array())
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
  $Sql="Exec BreedingAdmin_LocationWise_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
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

     $resarr[]  ='<input type="number" class="Acrage acragevaluemain" name=acragevaluemain[] value="'.$month_data_acr['Total_acrage'] .'" style="width: 78px;background-color:#ff0854;color:white" readonly>';

   }else{

     $resarr[]  ='<input type="number" class="Acrage acragevaluemain" name=acragevaluemain[] value="'.$month_data_acr['Total_acrage'] .'" style="width: 78px;" >';


   }

   if($month_data['count']>0){
    $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-danger View_Month_wise_popup' >View</button><input type='hidden' class='passing_id_loc' value='".@$Sql_Result['passing_id_loc']."' name=passing_id_loc[]><input type='hidden' class='passing_id_proj' value='".@$Sql_Result['passing_id_proj']."' name=passing_id_proj[]><input type='hidden' class='allpassing_id' value='".@$Sql_Result['passing_id']."' name=allpassing_id[] >";


  }else{

    $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-info Add_Month_wise_popup' >Add</button><input type='hidden' class='passing_id_loc' value='".@$Sql_Result['passing_id_loc']."' name=passing_id_loc[]><input type='hidden' class='passing_id_proj' value='".@$Sql_Result['passing_id_proj']."' name=passing_id_proj[]><input type='hidden' class='allpassing_id' value='".@$Sql_Result['passing_id']."' name=allpassing_id[] >";
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




  
  $resarr[]='<button type="button" class="btn btn-sm btn-success editbutton"><i class="fas fa-edit"></i></button>
  <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>  '; 
  
  
  
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

      $SQL="INSERT INTO  BreedingAdmin_MonthwiseDetails(Breed_id,Loc_id,Proj_id,type,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Breed_id."','".$Loc_id."','".$Proj_id."','".$type."','".$Jun."','".$Jul."','".$Aug."','".$Sep."','".$Oct."','".$Nov."','".$Dec."','".$Jan."','".$Feb."','".$Mar."','".$Apr."','".$May."','".$Total_acrage."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
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

      $SQL="UPDATE  BreedingAdmin_MonthwiseDetails SET Jun='$Jun',Jul='$Jul',Aug='$Aug',Sep='$Sep',Oct='$Oct',Nov='$Nov',Dec='$Dec',Jan='$Jan',Feb='$Feb',Mar='$Mar',Apr='$Apr',May='$May',ModifiedBy='$CreatedBy',ModifiedAt='$CreatedAt' Where Breed_id='$Breed_id' AND Loc_id='$Loc_id'  AND Proj_id='$Proj_id' AND type='$type' ";
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

    $sql="INSERT INTO BreedingAdmin_Monthwise_amount(Docid,Ordernum,Location,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES(1,0,'".$data['location']."','".$CreatedBy."','".$CreatedAt."','1')";

    $Result=sqlsrv_query($this->conn,$sql);

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



        
        $SQL1="INSERT INTO  BreedingAdmin_Activity(Docid,Ordernum,BreedingActivity,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$i."','".$WorkActivity."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
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


$resarr[]=" <input type='number' id='example-input-small'  class='form-control form-control-sm count_num' data-gender='male' placeholder='count' name='malecount[]' style='width: 50px;' value='".utf8_encode(@$Sql_Result['malecount'])."'>"; 
$resarr[]="<input type='number' id='example-input-small'  class='form-control form-control-sm count_num' data-gender='female' placeholder='count' name='femalecount[]' style='width: 50px;' value='".utf8_encode(@$Sql_Result['femalecount'])."'>"; 









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

   // echo "<pre>";print_r($data);
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

          $acragevaluemain=@$data['acragevaluemain'][$key];   

 //$location_val=@$data['location'];


          $SQL="UPDATE  BreedingAdmin_Location SET CurrentStatus='2',finalsubmitat='$CreatedAt',responsible_person='$Responsible_person',totalacreage='$acragevaluemain'  Where id='$passing_id_loc' ";
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
    } 




    return array('Status'=>$status);
  }






  public function AssumptionEnrty_malefemaleamount($User_Input=array())
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
    // $Sql="Exec BreedingAdmin_Assumption_Datatable_MaleFemale @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql = "SELECT *,COUNT(*) OVER() as TOTALROW FROM BreedingAdmin_Monthwise_amount WHERE CreatedBy = '".$_SESSION['EmpID']."' AND Currentstatus = '1'"; 
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

          $malecount=@$data['malecount'];
          $femalecount=@$data['femalecount'];


          $SQL1="INSERT INTO  BreedingAdmin_Activity(Docid,Ordernum,BreedingActivity,ReqDate,CreatedBy,CreatedAt,CurrentStatus,malecount,femalecount)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$i."','".$WorkActivity."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1','".$malecount."','".$femalecount."')";
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

      $sql2 = "SELECT COUNT(*) as Monthwise_amount_entered,(SELECT COUNT(*) from BreedingAdmin_Monthwise_amount where CreatedBy = '".$CreatedBy."') as total from BreedingAdmin_Monthwise_amount where CreatedBy = '".$CreatedBy."' and Frommonth IS NOT NULL and Frommonth != ''
        and Tomonth IS NOT NULL and Tomonth != '' and MaleAmount IS NOT NULL and FemaleAmount IS NOT NULL";
      $Sql_Connection  =  sqlsrv_query($this->conn,$sql2);
      $second_result  = sqlsrv_fetch_array($Sql_Connection);

      if(($result['malefemale_entered_count'] != $result['total_assumption']) || ($second_result['Monthwise_amount_entered'] != $second_result['total'])) {
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

          foreach ($data['monthwise_amt_id'] as $key => $value) {

            $SQL1="UPDATE BreedingAdmin_Monthwise_amount SET CurrentStatus = '2' WHERE Id = '".$value."'";

              $Result=sqlsrv_query($this->conn,$SQL1);

              $status=1; 
          }




          }else{

            $status=0;


          }

        }





//  exit;
      return array('Status'=>$status);
    }






    public function CompletedProjectWiseDetails($User_Input=array())
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
      $Sql="Exec BreedingAdmin_LocationWise_Datatable_Completed @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
      $Sql_Connection =sqlsrv_query($this->conn,$Sql);
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

         $resarr[]  ='<input type="number" class="Acrage acragevaluemain" name=acragevaluemain[] value="'.$month_data_acr['Total_acrage'] .'" style="width: 78px;background-color:#ff0854;color:white" readonly>';

       }else{

         $resarr[]  ='<input type="number" class="Acrage acragevaluemain" name=acragevaluemain[] value="'.$month_data_acr['Total_acrage'] .'" style="width: 78px;" >';


       }

       if($month_data['count']>0){
        $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-danger View_Month_wise_popup_Completed' >View</button><input type='hidden' class='passing_id_loc' value='".@$Sql_Result['passing_id_loc']."' name=passing_id_loc[]><input type='hidden' class='passing_id_proj' value='".@$Sql_Result['passing_id_proj']."' name=passing_id_proj[]><input type='hidden' class='allpassing_id' value='".@$Sql_Result['passing_id']."' name=allpassing_id[] >";


      }else{

        $resarr[]  =" <button type='button' attributeid='".@$Sql_Result['passing_id']."' class='btn btn-xs btn-info Add_Month_wise_popup' >Add</button><input type='hidden' class='passing_id_loc' value='".@$Sql_Result['passing_id_loc']."' name=passing_id_loc[]><input type='hidden' class='passing_id_proj' value='".@$Sql_Result['passing_id_proj']."' name=passing_id_proj[]><input type='hidden' class='allpassing_id' value='".@$Sql_Result['passing_id']."' name=allpassing_id[] >";
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





      $resarr[]='<button type="button" class="btn btn-sm btn-success editbutton"><i class="fas fa-edit"></i></button>
      <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>  '; 



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
      $resarr[] = utf8_encode(@$Sql_Result['Assumlocation']).'<input type="hidden" class="Assumlocation" name="Assumlocation[]" value="'.utf8_encode(@$Sql_Result['Assumlocation']).'"><input type="hidden" class="AssumProject" name="AssumProject[]" value="'.utf8_encode(@$Sql_Result['AssumProject']).'"><input type="hidden" class="AssumptionId" name="AssumptionId[]" value="'.utf8_encode(@$Sql_Result['Id']).'">';
      $resarr[] = '<div class="Assumproj" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['AssumProject']).'</div>';

      $resarr[] = utf8_encode(@$Sql_Result['BreedingActivity']).'<input type="hidden" class="BreedingActivity" name="BreedingActivity[]" value="'.utf8_encode(@$Sql_Result['BreedingActivity']).'">';


      $resarr[]=" <input type='number' id='example-input-small'  class='form-control form-control-sm' placeholder='count' name='malecount[]' style='width: 50px;' value='".utf8_encode(@$Sql_Result['malecount'])."'>"; 
      $resarr[]="<input type='number' id='example-input-small'  class='form-control form-control-sm' placeholder='count' name='femalecount[]' style='width: 50px;' value='".utf8_encode(@$Sql_Result['femalecount'])."'>"; 









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
      $resarr[] = utf8_encode(@$Sql_Result['ConsumLocation']).'<input type="hidden" class="ConsumLocation" name="ConsumLocation[]" value="'.utf8_encode(@$Sql_Result['ConsumLocation']).'"><input type="hidden" class="ConsumProject" name="ConsumProject[]" value="'.utf8_encode(@$Sql_Result['ConsumProject']).'"><input type="hidden" class="ConsumId" name="ConsumId[]" value="'.utf8_encode(@$Sql_Result['Id']).'"><input type="hidden" class="consumtypeid" name="consumtypeid[]" value="'.utf8_encode(@$Sql_Result['consumtypeid']).'">';
      $resarr[] = '<div class="ConsumProject" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['ConsumProject']).'</div>';

      $resarr[] = '<div class="Breedingconsumables" style="word-wrap: break-word">'.utf8_encode(@$Sql_Result['Breedingconsumables']).'</div>';
      $resarr[] ="<input type='number' class='form-control acraege' name='acraege[]' style='width:70px'>";
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
    $Sql="Exec BreedingAdmin_Consumption_Datatable_UOM @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $recordsTotal = @$Sql_Result['TOTALROW'];
      $resarr = array();
     // $resarr[] = $sno++;
      $resarr[] = '<span style="word-break:break-all;">'.utf8_encode(@$Sql_Result['Breedingconsumables']).'</span> <input type="hidden" class="Breedingconsumables" name="Breedingconsumables[]" value="'.utf8_encode(@$Sql_Result['Breedingconsumables']).'"><input type="hidden" class="ConsumProject" name="ConsumProject[]" value="'.utf8_encode(@$Sql_Result['ConsumProject']).'"><input type="hidden" class="ConsumId" name="ConsumId[]" value="'.utf8_encode(@$Sql_Result['Id']).'"><input type="hidden" class="consumtypeid" name="consumtypeid[]" value="'.utf8_encode(@$Sql_Result['consumtypeid']).'">';

      $resarr[] ="<input type='number' class='form-control UOM' name='UOM[]' style='width:70px'>";







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
    $groupedData=array();
    $i=0;
    $Sql="Exec BreedingAdmin_FieldExpense_Datatable @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
    //echo $Sql;
    //exit;
    $Sql_Connection =sqlsrv_query($this->conn,$Sql);
    while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
    {
      $dataarr = array();
      $dataarr['BreedingLocation'] = $Sql_Result['BreedingLocation'];
      $dataarr['Project'] = $Sql_Result['Project'];
      $dataarr['BreedingActivity'] = $Sql_Result['BreedingActivity'];
      $resultarr[] = $dataarr;
    }
      // Serialize each sub-array to make it a string
    $serializedArrays = array_map('serialize', $resultarr);

      // Remove duplicate serialized arrays
    $uniqueSerializedArrays = array_unique($serializedArrays);

      // Unserialize each unique serialized array to get back the original format
    $uniqueArrays = array_map('unserialize', $uniqueSerializedArrays);

      // Reset array keys to start from 0
    $uniqueArrays = array_values($uniqueArrays);

    $res['data'] = @$uniqueArrays;

    $result = $res;
    // echo "<pre>";
    // print_r($result);
    // exit;
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
    echo "<pre>";
    print_r($resultarr);
    exit;
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

      $resarr[] ="";
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
      
     


          $SQL="INSERT INTO  BreedingAdmin_Landlese(Location,Name,Leaserate,Leaseend,Landto,Months,Escalation,Total,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$location_val."','','','','','','','','".$CreatedBy."','".$CreatedAt."','1')";
           $Result=sqlsrv_query($this->conn,$SQL);

           $status=1;

     
   }

 }


  //exit; 

   return array('Status'=>$status);
 }







public function Add_TFA($data)
{
  $Emp_Id=isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $CreatedAt=date('Y-m-d H:i:s');
  $CurrentStatus="1";
  $RejectionStatus="1";

  $sql = "INSERT INTO BreedingAdmin_TFA (Location,Name,No_of_persons,CreatedBy,CreatedAt,Currentstatus,Rejectionstatus) VALUES ('".$data['location']."','".$data['name']."',".$data['no_of_persons'].",'".$Emp_Id."','".$CreatedAt."','".$CurrentStatus."','".$CurrentStatus."')";
  
  $result = sqlsrv_query($this->conn,$sql); 

  if($result === false) {
      $status = 0;
  } else {
      $status = 1;
  }

  return array('Status'=>$status);

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
  $Sql="SELECT Location,Name,No_of_persons,count(*) over() as TOTALROW,Id from BreedingAdmin_TFA where CreatedBy = '".$Emp_Id."' AND Currentstatus = '1' AND RejectionStatus = '1'";

  if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_TFA') {
      $Sql="SELECT Location,Name,No_of_persons,count(*) over() as TOTALROW,Id from BreedingAdmin_TFA where CreatedBy = '".$Emp_Id."' AND Currentstatus = '2' AND RejectionStatus = '1'";
  }
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $result = array();
    $recordsTotal   = @$Sql_Result['TOTALROW'];
    $result[]       = $i;
    $result[]       = $Sql_Result['Location'];
    $result[]       = $Sql_Result['Name']; 
    $result[]       = $Sql_Result['No_of_persons'];

    //check monthwise labour rate is exist start   
    $check_sql      = "SELECT COUNT(*) as total FROM BreedingAdmin_TFA_MonthwiseDetails WHERE TFA_id = ".$Sql_Result['Id']." AND Currentstatus = '1' AND RejectionStatus = '1'";
    $from_action = 'pending';
    if(isset($User_Input['function']) && $User_Input['function'] == 'get_completed_TFA') {
      $check_sql="SELECT COUNT(*) as total FROM BreedingAdmin_TFA_MonthwiseDetails WHERE TFA_id = ".$Sql_Result['Id']." AND Currentstatus = '2' AND RejectionStatus = '1'";
      $from_action = 'completed';
    }
    $result_sql     = sqlsrv_query($this->conn,$check_sql);
    $count          = sqlsrv_fetch_array($result_sql,SQLSRV_FETCH_ASSOC);
    // echo "<pre>";print_r($count['total']);exit;
    //check monthwise labour rate is exist end    

    if($count['total'] > 0) {
      $result[]       = "<button type='button' class='btn btn-sm  btn-info labour_rate_edit' data-action='edit' data-tfaid='".$Sql_Result['Id']."' data-loc='".$Sql_Result['Location']."' data-name ='".$Sql_Result['Name']."' data-nop ='".$Sql_Result['No_of_persons']."' data-fromaction ='".$from_action."'>View</button><button type='button' class='btn btn-sm btn-danger labour_rate_delete ml-2' data-action='delete' data-tfaid='".$Sql_Result['Id']."' data-fromaction ='".$from_action."'><i class='fa fa-trash'></i></button><input type='hidden' value='".$Sql_Result['Id']."' name='TFA_ID[]'>"; 
    } else {
      $result[]       = "<button type='button' style='width: 49px;' class='btn btn-sm btn-primary labour_rate_add' data-action='add' data-tfaid='".$Sql_Result['Id']."' data-loc='".$Sql_Result['Location']."' data-name ='".$Sql_Result['Name']."' data-nop ='".$Sql_Result['No_of_persons']."' data-fromaction ='".$from_action."'>Add</button><button type='button' class='btn btn-sm btn-danger labour_rate_delete ml-2' data-action='delete' data-tfaid='".$Sql_Result['Id']."' data-fromaction ='".$from_action."'><i class='fa fa-trash'></i></button><input type='hidden' value='".$Sql_Result['Id']."' name='TFA_ID[]'>"; 
    }

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
  $month_arr = ['jun','jul','aug','sep','oct','nov','dec','jan','feb','mar','apr','may'];
  foreach ($month_arr as $key => $month) {
    $index = $month."_rate";
    if($data[$index] == '') {
      $status = 0;
    }
  }
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

public function Delete_TFA_labour_rate($data)
{
  $final_result  = []; 
  $Emp_Id        = isset($_SESSION['EmpID']) && ($_SESSION['EmpID'] !='Admin' || $_SESSION['EmpID'] !='SuperAdmin') ? $_SESSION['EmpID'] : '';
  $RejectBy      = $_SESSION['EmpID'];
  $RejectAt      =  date('Y-m-d H:i:s');

  $sql           = "UPDATE BreedingAdmin_TFA_MonthwiseDetails SET Rejectionstatus = 2,Rejectby = '".$RejectBy."',Rejectat = '".$RejectAt."' WHERE TFA_id = ".$data['tfa_id']."";
  $result        = sqlsrv_query($this->conn,$sql);

  $sql1           = "UPDATE BreedingAdmin_TFA SET Rejectionstatus = 2,Rejectby = '".$RejectBy."',Rejectat = '".$RejectAt."' WHERE id = ".$data['tfa_id']."";
  $result_sql     = sqlsrv_query($this->conn,$sql1);


  if($result === false || $result_sql === false) {
    $status = 0;
  } else {
    $status = 1;
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







  public function Finaltabledetailsland($data)
  {


    echo "<pre>";print_r($data);
   
 

   

  exit; 

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
  $Sql="SELECT TOTALROW = count(*) OVER(), Location,Id as leaseid FROM BreedingAdmin_Landlese Group by  Location,Id  ORDER BY Location ASC OFFSET  $Offset ROWS FETCH NEXT $Length ROWS ONLY";
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $recordsTotal = @$Sql_Result['TOTALROW'];
    $resarr = array();
     $resarr[] = $sno++;
    $resarr[] = @$Sql_Result['Location'];
    $resarr[] = "<input type='text' class='' name='Employee_name[]' style='border:none;backgroud:transparent;width:70px' >";
    $resarr[] = "<input type='text' class='' name='Leaserate[]' style='border:none;backgroud:transparent;width:70px' >";
    $resarr[] = "<input type='text' class='' name='Leaseenddate[]' style='border:none;backgroud:transparent;width:70px' >";
  
 
  ///  $resarr[]='<button type="button" attributeid="'.@$Sql_Result['leaseid'].'" class="tabledit-save-button btn btn-sm btn-success Add_Month_wise_popup" style="float: none; margin: 4px;">ADD</button><button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>  '; 


    
    $SQL="SELECT count(*) as leasecount from BreedingAdmin_MonthwiseLandlease where Lease_id='".@$Sql_Result['leaseid']."' ";
       $Result_count=sqlsrv_query($this->conn,$SQL);

        $countvalue=sqlsrv_fetch_array($Result_count,SQLSRV_FETCH_ASSOC);

        $leasecount=$countvalue['leasecount'];

     //   print_r($leasecount);

        if($leasecount==0){

     $resarr[]='<button type="button" attributeid="'.@$Sql_Result['leaseid'].'" class="tabledit-save-button btn btn-sm btn-success Add_Month_wise_popup" style="float: none; margin: 4px;">ADD</button>
      '; 

    }else{


      $resarr[]='<button type="button" attributeid="'.@$Sql_Result['leaseid'].'" class="tabledit-save-button btn btn-sm btn-primary Add_Month_wise_popup" style="float: none; margin: 4px;">View</button>
      <button type="button" class="btn btn-sm btn-danger deleterow deletebutton"><i class="fas fa-trash-alt"></i></button>  '; 


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

  //  echo "<pre>";print_r($data);
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



      $SQL="INSERT INTO  BreedingAdmin_MonthwiseLandlease(Lease_id,Jun,Jul,Aug,Sep,Oct,Nov,Dec,Jan,Feb,Mar,Apr,May,Total_acrage,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$landleaseid."','".$Jun."','".$Jul."','".$Aug."','".$Sep."','".$Oct."','".$Nov."','".$Dec."','".$Jan."','".$Feb."','".$Mar."','".$Apr."','".$May."','".$Total_acrage."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
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









}

?>