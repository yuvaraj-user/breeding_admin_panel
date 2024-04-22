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
Class Common_Filter_Div{
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
    $location_array = implode(', ', @$data['location']);
    $project_array = implode(', ', @$data['project']);

    $breedingloc=@$data['breedingloc'];


    foreach(@$data['project'] as $key=>$value)
    {
     $project_val=@$data['project'][$key];

     foreach(@$data['location'] as $key=>$value)
     {

      $location_val=@$data['location'][$key];

      $SqlQuery="SELECT Count(*) as insertcount from BreedingAdmin_Type

      Inner Join BreedingAdmin_location On BreedingAdmin_location.Docid=BreedingAdmin_Type.id
      Inner Join BreedingAdmin_project On BreedingAdmin_project.Docid=BreedingAdmin_Type.id AND BreedingAdmin_project.ordernum=BreedingAdmin_location.ordernum


      Where 1=1 and BreedingAdmin_Type.Currentstatus in ('1','2') 

      AND BreedingAdmin_Type.Breedingtype='".@$breedingloc."' and BreedingLocation='".@$location_val."' and Project='".$project_val."' ";
      $Result=sqlsrv_query($this->conn,$SqlQuery);


      $countofinsertvalue=sqlsrv_fetch_array($Result,SQLSRV_FETCH_ASSOC);

      $countvalueinser=$countofinsertvalue['insertcount'];

      if($countvalueinser>0){
        $status=1;
        $Autoincnum='';
        $autoid='';
      }else{

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


           

           foreach(@$data['location'] as $key=>$value)
           {

            $location_val=@$data['location'][$key];

            for($i = 0; $i<sizeof(@$data['project']); $i++) {
              $SQL1="INSERT INTO  BreedingAdmin_Location(Docid,Ordernum,BreedingLocation,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$i."','".$location_val."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
               $Result=sqlsrv_query($this->conn,$SQL1);


               

             }


           }

           $i_project = 0;
           foreach(@$data['project'] as $key=>$value)
           {

            $location_val=@$data['project'][$key];


            $SQL1="INSERT INTO  BreedingAdmin_project(Docid,Ordernum,project,ReqDate,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES('".$Last_Insert_Id_sub."','".$i_project."','".$location_val."','".$Created_date."','".$CreatedBy."','".$CreatedAt."','1')";
             $Result=sqlsrv_query($this->conn,$SQL1);


             

             
             $i_project++;

             $status=1;

           }

           

           $SQL="SELECT DISTINCT  Breed_no as Breed_no,id as autoid from BreedingAdmin_Type Where id='".$Last_Insert_Id_sub."'";
           $Result_data=sqlsrv_query($this->conn,$SQL);

           $Autonum_details=sqlsrv_fetch_array($Result_data,SQLSRV_FETCH_ASSOC);

           $Autoincnum=@$Autonum_details['Breed_no'];
           $autoid=@$Autonum_details['autoid'];





           


           $count=0;



         }else{


          $status=0;
          $Autoincnum='';
          $autoid='';


        }







      }else{


       $status=0;
       $Autoincnum='';
       $autoid='';
     }
     


   }





// echo $SqlQuery;
//echo "<br>";
   

   
 }



}






  //  exit;











   //exit;
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





//  exit;
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
  $Sql="Exec BreedingAdmin_Assumption_Datatable_MaleFemale @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length." ";
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $recordsTotal = @$Sql_Result['TOTALROW'];
    $resarr = array();
     // $resarr[] = $sno++;
    $resarr[] = utf8_encode(@$Sql_Result['Assumlocation'])."<input type='hidden' id='example-input-small'  class='form-control form-control-sm assumlocationdata' placeholder='count' name='Assumlocation_month[]' style='width: 10px;' value='".utf8_encode(@$Sql_Result['Assumlocation'])."'>";
    
    
    $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign'  name='Frommonth[]' style='width: 60px;'>"; 

    $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign'  name='tomonth[]' style='width: 60px;'>"; 


    $resarr[]="<input type='number'   class='form-control form-control-sm ' name='maleamount[]' style='width: 60px;'>"; 


    $resarr[]="<input type='number'   class='form-control form-control-sm ' name='femaleamount[]' style='width: 60px;'>"; 



    
    
    
    
    
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

  echo "<pre>";print_r($data);

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

  //  echo "<pre>";print_r($data);

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



    
    foreach(@$data['Assumlocation_month'] as $key=>$value)
    {

      //$location_val=@$data['location'][$key];
      $Assumlocation_month=@$data['Assumlocation_month'][$key];
      $Frommonth=@$data['Frommonth'][$key];
      $tomonth=@$data['tomonth'][$key];
      $maleamount=@$data['maleamount'][$key];
      $femaleamount=@$data['femaleamount'][$key];



      

 //$location_val=@$data['location'];

      $SQL1="INSERT INTO  BreedingAdmin_Monthwise_amount(Docid,Ordernum,Location,Frommonth,Tomonth,MaleAmount,FemaleAmount,CreatedBy,CreatedAt,CurrentStatus)output inserted.Id VALUES(1,'".$i."','".$Assumlocation_month."','".$Frommonth."','".$tomonth."','".$maleamount."','".$femaleamount."','".$CreatedBy."','".$CreatedAt."','1')";

        $Result=sqlsrv_query($this->conn,$SQL1);
        


        

        $status=1;     


      }





    }else{

      $status=0;

      
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

public function getSubTableDetails($User_Input=array())
{
    //  echo "<pre>";
    //  print_r($User_Input);
    // exit;
  $location = @$User_Input['data'][1];
  $project = @$User_Input['data'][2];
  $activity = @$User_Input['data'][3];
  $breeType = @$User_Input['data'][4];

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

  $Sql="Exec Get_Breed_MFCount_MonthWise_Datatable @EMPID='".$Emp_Id."',@BreedingLocation='".$location."',@Project='".$project."',@BreedingActivity='".$activity."',@type='".$type."',@Breedingtype='".$breeType."' ";

  // echo $Sql;
  // exit;
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $resultarr[] = $Sql_Result;
  }

$maleValuesArray = array();
$femaleValuesArray = array();

foreach ($resultarr as $row) {
    // Collect male values
    $maleValuesArray[] = [
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

    // Collect female values
    $femaleValuesArray[] = [
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

$res['male'] = @$maleValuesArray;
$res['female'] = @$femaleValuesArray;
    

  $result = $res;
    // echo "<pre>";
    // print_r($maleValuesArray);
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

public function AssumptionEnrty_malefemaleamount_completed_Div($User_Input=array())
{

  // echo "<pre>";
  // print_r($User_Input);
  // exit;
  $breedingLocation=@$User_Input['breedingLocation'];
  $project=@$User_Input['project'];
  $breedingActivity=@$User_Input['breedingActivity'];
  $breedingType=@$User_Input['breedingType'];
  $passing_id_loc=@$User_Input['passing_id_loc'];
  $passing_id_proj=@$User_Input['passing_id_proj'];
  $passing_id=@$User_Input['passing_id'];


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
  $i=0;
  $Sql="Exec BreedingAdmin_Assumption_Month_Details @EMPID='".$Emp_Id."',@autoid=".$autoid.",@OFFSET=".$Offset.",@Length=".$Length.",@Location='".$breedingLocation."' ";

  // echo $Sql;
  // exit;
  $Sql_Connection =sqlsrv_query($this->conn,$Sql);
  while($Sql_Result = sqlsrv_fetch_array($Sql_Connection))
  {
    $resultarr[]=$Sql_Result;
    // $recordsTotal = @$Sql_Result['TOTALROW'];
    // $resarr = array();
    //  // $resarr[] = $sno++;
    // $resarr[] = utf8_encode(@$Sql_Result['Location'])."<input type='hidden' id='example-input-small'  class='form-control form-control-sm assumlocationdata' placeholder='count' name='Assumlocation_month[]' style='width: 10px;' value='".utf8_encode(@$Sql_Result['Location'])."'>";
    
    
    // $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign'  name='Frommonth[]' value='".utf8_encode(@$Sql_Result['Frommonth'])."' >"; 

    // $resarr[]="<input type='month'   class='form-control form-control-sm fontdesign'  name='tomonth[]' value='".utf8_encode(@$Sql_Result['Tomonth'])."'>"; 


    // $resarr[]="<input type='number'   class='form-control form-control-sm ' name='maleamount[]' value='".utf8_encode(@$Sql_Result['MaleAmount'])."'>"; 


    // $resarr[]="<input type='number'   class='form-control form-control-sm ' name='femaleamount[]' value='".utf8_encode(@$Sql_Result['FemaleAmount'])."'>"; 



    
    
    
    
    
    // $resultarr[] = $resarr;
    // $i++;
  }
  // $res=array();
  // if(isset($User_Input['draw']))
  // {
  //   $res['draw'] = @$User_Input['draw'];  
  // }else
  // {
  //   $res['draw'] = 1; 
  // }
  // $res['recordsFiltered'] = @$recordsTotal;
  // $res['recordsTotal'] = @$recordsTotal;
   $res['data'] = @$resultarr;
  // $res['sql'] = @$Sql;
  $result = $res;
  return $result;
}

public function FinalsubmittionAssumption_Div($User_Input=array())
{

  // echo "<pre>";print_r($User_Input);
  // exit; 


  $CreatedBy=@$_SESSION['EmpID'];


   $Location=@$User_Input['Location'] !='' ? @$User_Input['Location'] : 0;
   $maleCount=@$User_Input['maleCount'] !='' ? @$User_Input['maleCount'] : 0;
   $femaleCount=@$User_Input['femaleCount'] !='' ? @$User_Input['femaleCount'] : 0;

   if(($Location!='' || $Location!=0) && ($maleCount!='' || $maleCount!=0) && ($femaleCount!='' || $femalecount!=0))
   {
//     $Sql = "SELECT Location,MaleAmount,FemaleAmount FROM BreedingAdmin_Monthwise_amount WHERE Location='".$Location."'";


//     $Sql_Connection =sqlsrv_query($this->conn,$Sql);

//     if ($Sql_Connection === false) {
//     die(print_r(sqlsrv_errors(), true)); // Print SQL Server errors
// }
//     $count = sqlsrv_num_rows($Sql_Connection);

//     echo $count;
//     exit;

//     if($count>0)
//     {
      $query ="UPDATE BreedingAdmin_Monthwise_amount SET MaleAmount='".$maleCount."',FemaleAmount='".$femaleCount."' WHERE Location='".$Location."'";
       $rest =sqlsrv_query($this->conn,$query);
       $status ='Amount Added Successfully';
    // }
    // else
    // {
    //   $status ='No Data';
    // }

   }
   else
   {
    $status='Please Check Male and Female Amount';
   }

  

  return array('Status'=>$status);
}







}?>