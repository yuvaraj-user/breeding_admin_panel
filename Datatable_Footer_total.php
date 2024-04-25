<?php 


include '../../auto_load.php';


if(isset($_POST['Action']) && $_POST['Action']=='Get_total_Footer_Value_Acreage')
{


	$offset=@$_POST['start'];
	$length=@$_POST['length'];
	$length=$length == '-1' ? "All" : $length;

	
		  //EXEC PP_Showing_Agewise_Crop_Report 
	$sql="SELECT SUM(totalacreage) as totalacreage from BreedingAdmin_Location Where Currentstatus='2' and Rejectionstatus is NULL and CreatedBy='" . @$_SESSION['EmpID']. "' ";
	$stmt = sqlsrv_prepare($conn, $sql);
	
	sqlsrv_execute($stmt);
	$sno=$offset+1;
	$res['recordsTotal']=0;
	$resultarr=array();
	$totalacreage=0;

	
//30_45_Age,46_50_Age,55_60_Age,Above_60_Age

	//Production_Center_Name,Description,Total_farmer
	while($prow = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
	{		

	    $totalacreage 	=@$prow['totalacreage'];
		
		
	}


echo $html="<tr>
                      <td colspan='4'  style='text-align: right;'>Total Acreage</td>
                    
                      <td align='right'>".$totalacreage."</td>
                      <td colspan='4'></td>
                    
                     

                      
                    </tr>";
	
}

?>