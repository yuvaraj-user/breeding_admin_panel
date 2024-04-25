<?php
//production_summary_table

include '../../auto_load.php';


//$locbaseproject=@$_POST['locbaseproject'];
$locbaseproject	= isset($_POST["locbaseproject"]) && !empty($_POST["locbaseproject"]) ? $_POST["locbaseproject"] : "0";

$Expensegroup	= isset($_POST["Expensegroup"]) && !empty($_POST["Expensegroup"]) ? $_POST["Expensegroup"] : "0";

//$locbaseproject	= isset($_POST["locbaseproject"]) && !empty($_POST["locbaseproject"]) ? implode(",", $_POST["locbaseproject"]) : "0";
$Action=isset($_POST["Action"]) && !empty($_POST["Action"]) ? trim($_POST["Action"]) : "0";

       $option="";


if($Action=="Get_Location_Based_Project") /* Crop_Code Based on Year_Code  Display  */
{
	$Sql="SELECT  DISTINCT Project  from BreedingAdmin_Location

LEFT Join BreedingAdmin_Project On BreedingAdmin_Project.Docid=BreedingAdmin_Location.Docid

Left Join BreedingAdmin_Assumption On BreedingAdmin_Assumption.AssumProject=BreedingAdmin_Project.Project  and BreedingAdmin_Location.BreedingLocation=BreedingAdmin_Assumption.AssumLocation


Where 1=1 and BreedingAdmin_Location.Currentstatus='2' and BreedingAdmin_project.Rejectionstatus is NULL AND BreedingLocation in ('".@$locbaseproject."') AND  BreedingAdmin_Location.CreatedBy='" . @$_SESSION['EmpID']. "' and BreedingAdmin_Assumption.AssumProject is NULL ";
echo $Sql;




$Details  = sqlsrv_query($conn,$Sql);
	//$option='<option value="">Select Material</option>';
	while($result = sqlsrv_fetch_array($Details))
	{ 
	//$option='<option value="">Select</option>';		
	$option.='<option value="'.trim($result['Project']).'" selected>'.$result['Project'].'</option>';
    }
}

if($Action=="Get_Expensegroupbyname") /* Crop_Code Based on Year_Code  Display  */
{
	$Sql="SELECT Distinct CostElementName FROM Budget_CostCenter_CostElement_19_20_SAP Where 1=1  AND CostElementGroup in ('".@$Expensegroup."')  ";
//echo $Sql;

$Details  = sqlsrv_query($conn,$Sql);
	//$option='<option value="">Select Material</option>';
	while($result = sqlsrv_fetch_array($Details))
	{ 
	//$option='<option value="">Select</option>';		
	$option.='<option value="'.trim($result['CostElementName']).'" selected>'.$result['CostElementName'].'</option>';
    }
}

if($Action=="Get_Location_Based_Project_Consumables") /* Crop_Code Based on Year_Code  Display  */
{
	$Sql=" SELECT  DISTINCT BreedingAdmin_Project.Project   from BreedingAdmin_Location

LEFT Join BreedingAdmin_Project On BreedingAdmin_Project.Docid=BreedingAdmin_Location.Docid

LEFT JOIN (Select * from BreedingAdmin_Consumables Where Rejectionstatus is NULL)BreedingAdmin_Consumables On BreedingAdmin_Consumables.ConsumLocation=BreedingAdmin_Location.BreedingLocation and BreedingAdmin_Project.Project=BreedingAdmin_Consumables.ConsumProject
where  BreedingAdmin_project.Rejectionstatus is NULL AND BreedingLocation in ('".@$locbaseproject."') AND  BreedingAdmin_Location.CreatedBy='" . @$_SESSION['EmpID']. "'  and BreedingAdmin_Consumables.ConsumProject is NULL and BreedingAdmin_project.Rejectionstatus is NULL and BreedingAdmin_Location.Currentstatus='2'


 ";




echo $Sql;




$Details  = sqlsrv_query($conn,$Sql);
	//$option='<option value="">Select Material</option>';
	while($result = sqlsrv_fetch_array($Details))
	{ 
	//$option='<option value="">Select</option>';		
	$option.='<option value="'.trim($result['Project']).'" selected>'.$result['Project'].'</option>';
    }
}

echo $option;

?>

