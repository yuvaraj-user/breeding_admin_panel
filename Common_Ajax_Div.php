<?php
include '../../../auto_load.php';
include 'Common_Filter_Div.php';
error_reporting(-1);
$Common_Filter_Div=new Common_Filter_Div($conn);
$Action=@$_POST['Action'];

if($Action=="locationwiseacrage")
{
	$locationwiseacrage=$Common_Filter_Div->locationwiseacrage($_POST);
	echo json_encode($locationwiseacrage);exit;
}if($Action=="ProjectWiseDetails")
{
	$ProjectWiseDetails=$Common_Filter_Div->ProjectWiseDetails($_POST);
	echo json_encode($ProjectWiseDetails);exit;
}if($Action=="monthwisedetails")
{
	$monthwisedetails=$Common_Filter_Div->monthwisedetails($_POST);
	echo json_encode($monthwisedetails);exit;
}if($Action=="monthwisedetails_Edit")
{
	$monthwisedetails_Edit=$Common_Filter_Div->monthwisedetails_Edit($_POST);
	echo json_encode($monthwisedetails_Edit);exit;
}if($Action=="Assumptionwisemalefemale")
{
	$Assumptionwisemalefemale=$Common_Filter_Div->Assumptionwisemalefemale($_POST);
	echo json_encode($Assumptionwisemalefemale);exit;
}if($Action=="AssumptionEnrty")
{
	$AssumptionEnrty=$Common_Filter_Div->AssumptionEnrty($_POST);
	echo json_encode($AssumptionEnrty);exit;
}if($Action=="deleterowwisedata")
{
	$deleterowwisedata=$Common_Filter_Div->deleterowwisedata($_POST);
	echo json_encode($deleterowwisedata);exit;
}if($Action=="Finalsubmittiondetails")
{
	$Finalsubmittiondetails=$Common_Filter_Div->Finalsubmittiondetails($_POST);
	echo json_encode($Finalsubmittiondetails);exit;
}if($Action=="AssumptionEnrty_malefemaleamount")
{
	$AssumptionEnrty_malefemaleamount=$Common_Filter_Div->AssumptionEnrty_malefemaleamount($_POST);
	echo json_encode($AssumptionEnrty_malefemaleamount);exit;
}if($Action=="FinalsubmittionAssumption")
{
	$FinalsubmittionAssumption=$Common_Filter_Div->FinalsubmittionAssumption($_POST);
	echo json_encode($FinalsubmittionAssumption);exit;
}if($Action=="singlemalefemale")
{
	$singlemalefemale=$Common_Filter_Div->singlemalefemale($_POST);
	echo json_encode($singlemalefemale);exit;
}if($Action=="Fieldexpensedataform")
{
	$Fieldexpensedataform=$Common_Filter_Div->Fieldexpensedataform($_POST);
	echo json_encode($Fieldexpensedataform);exit;
}if($Action=="FiledExpensesEnrty")
{
	$FiledExpensesEnrty=$Common_Filter_Div->FiledExpensesEnrty($_POST);
	echo json_encode($FiledExpensesEnrty);exit;
}if($Action=="finalassumptiondata")
{
	$finalassumptiondata=$Common_Filter_Div->finalassumptiondata($_POST);
	echo json_encode($finalassumptiondata);exit;
}if($Action=="CompletedProjectWiseDetails")
{
	$CompletedProjectWiseDetails=$Common_Filter_Div->CompletedProjectWiseDetails($_POST);
	echo json_encode($CompletedProjectWiseDetails);exit;
}if($Action=="AssumptionEnrtyCompleted")
{
	$AssumptionEnrtyCompleted=$Common_Filter_Div->AssumptionEnrtyCompleted($_POST);
	echo json_encode($AssumptionEnrtyCompleted);exit;
}if($Action=="AssumptionEnrty_malefemaleamount_completed")
{
	$AssumptionEnrty_malefemaleamount_completed=$Common_Filter_Div->AssumptionEnrty_malefemaleamount_completed($_POST);
	echo json_encode($AssumptionEnrty_malefemaleamount_completed);exit;
}if($Action=="LocationMaster")
{
	$LocationMaster=$Common_Filter_Div->LocationMaster($_POST);
	echo json_encode($LocationMaster);exit;
}
if($Action=="ProjectMaster")
{
	$ProjectMaster=$Common_Filter_Div->ProjectMaster($_POST);
	echo json_encode($ProjectMaster);exit;
}
if($Action=="ActivityMaster")
{
	$ActivityMaster=$Common_Filter_Div->ActivityMaster($_POST);
	echo json_encode($ActivityMaster);exit;
}if($Action=="Consumablesallvalues")
{
	$Consumablesallvalues=$Common_Filter_Div->Consumablesallvalues($_POST);
	echo json_encode($Consumablesallvalues);exit;
}if($Action=="consumablesentry")
{
	$consumablesentry=$Common_Filter_Div->consumablesentry($_POST);
	echo json_encode($consumablesentry);exit;
}if($Action=="consumablesentryuom")
{
	$consumablesentryuom=$Common_Filter_Div->consumablesentryuom($_POST);
	echo json_encode($consumablesentryuom);exit;
}if($Action=="tablewisedataconsumtion")
{
	$tablewisedataconsumtion=$Common_Filter_Div->tablewisedataconsumtion($_POST);
	echo json_encode($tablewisedataconsumtion);exit;
}if($Action=="consumablesentry_confirm")
{
	$consumablesentry_confirm=$Common_Filter_Div->consumablesentry_confirm($_POST);
	echo json_encode($consumablesentry_confirm);exit;
}if($Action=="consumablesentryuom_confirm")
{
	$consumablesentryuom_confirm=$Common_Filter_Div->consumablesentryuom_confirm($_POST);
	echo json_encode($consumablesentryuom_confirm);exit;
}

if($Action=="getBreederDetails")
{
	$getBreederDetails=$Common_Filter_Div->getBreederDetails($_POST);
	echo json_encode($getBreederDetails);exit;
}
if($Action=="getSubTableDetails")
{
	$getSubTableDetails=$Common_Filter_Div->getSubTableDetails($_POST);
	echo json_encode($getSubTableDetails);exit;
}

if($Action=="AssumptionEnrty_malefemaleamount_completed_Div")
{
	$AssumptionEnrty_malefemaleamount_completed_Div=$Common_Filter_Div->AssumptionEnrty_malefemaleamount_completed_Div($_POST);
	echo json_encode($AssumptionEnrty_malefemaleamount_completed_Div);exit;
}
if($Action=="FinalsubmittionAssumption_Div")
{
	$FinalsubmittionAssumption_Div=$Common_Filter_Div->FinalsubmittionAssumption_Div($_POST);
	echo json_encode($FinalsubmittionAssumption_Div);exit;
}
if($Action=="InsertMainSubTableData")
{
	$InsertMainSubTableData=$Common_Filter_Div->InsertMainSubTableData($_POST);
	echo json_encode($InsertMainSubTableData);exit;
}

if($Action=="UpdateMainSubTableData")
{
	$UpdateMainSubTableData=$Common_Filter_Div->UpdateMainSubTableData($_POST);
	echo json_encode($UpdateMainSubTableData);exit;
}
if($Action=="getBreederDetailsManCount")
{
	$getBreederDetailsManCount=$Common_Filter_Div->getBreederDetailsManCount($_POST);
	echo json_encode($getBreederDetailsManCount);exit;
}
if($Action=="InsertManCountTableData")
{
	$InsertManCountTableData=$Common_Filter_Div->InsertManCountTableData($_POST);
	echo json_encode($InsertManCountTableData);exit;
}

if($Action=="UpdateManCountTableData")
{
	$UpdateManCountTableData=$Common_Filter_Div->UpdateManCountTableData($_POST);
	echo json_encode($UpdateManCountTableData);exit;
}

if($Action=="consumablesreport")
{
	$consumablesreport=$Common_Filter_Div->consumablesreport($_POST);
	echo json_encode($consumablesreport);exit;
}


?>