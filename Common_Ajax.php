<?php 
include '../../../auto_load.php';
include 'Common_Filter.php';
error_reporting(-1);
$Common_Filter=new Common_Filter($conn);
$Action=@$_POST['Action'];

if($Action=="locationwiseacrage")
{
	$locationwiseacrage=$Common_Filter->locationwiseacrage($_POST);
	echo json_encode($locationwiseacrage);exit;
}if($Action=="ProjectWiseDetails")
{
	$ProjectWiseDetails=$Common_Filter->ProjectWiseDetails($_POST);
	echo json_encode($ProjectWiseDetails);exit;
}if($Action=="monthwisedetails")
{
	$monthwisedetails=$Common_Filter->monthwisedetails($_POST);
	echo json_encode($monthwisedetails);exit;
}if($Action=="monthwisedetails_Edit")
{
	$monthwisedetails_Edit=$Common_Filter->monthwisedetails_Edit($_POST);
	echo json_encode($monthwisedetails_Edit);exit;
}if($Action=="Assumptionwisemalefemale")
{
	$Assumptionwisemalefemale=$Common_Filter->Assumptionwisemalefemale($_POST);
	echo json_encode($Assumptionwisemalefemale);exit;
}if($Action=="AssumptionEnrty")
{
	$AssumptionEnrty=$Common_Filter->AssumptionEnrty($_POST);
	echo json_encode($AssumptionEnrty);exit;
}if($Action=="deleterowwisedata")
{
	$deleterowwisedata=$Common_Filter->deleterowwisedata($_POST);
	echo json_encode($deleterowwisedata);exit;
}if($Action=="Finalsubmittiondetails")
{
	$Finalsubmittiondetails=$Common_Filter->Finalsubmittiondetails($_POST);
	echo json_encode($Finalsubmittiondetails);exit;
}if($Action=="AssumptionEnrty_malefemaleamount")
{
	$AssumptionEnrty_malefemaleamount=$Common_Filter->AssumptionEnrty_malefemaleamount($_POST);
	echo json_encode($AssumptionEnrty_malefemaleamount);exit;
}if($Action=="FinalsubmittionAssumption")
{
	$FinalsubmittionAssumption=$Common_Filter->FinalsubmittionAssumption($_POST);
	echo json_encode($FinalsubmittionAssumption);exit;
}if($Action=="singlemalefemale")
{
	$singlemalefemale=$Common_Filter->singlemalefemale($_POST);
	echo json_encode($singlemalefemale);exit;
}if($Action=="Fieldexpensedataform")
{
	$Fieldexpensedataform=$Common_Filter->Fieldexpensedataform($_POST);
	echo json_encode($Fieldexpensedataform);exit;
}if($Action=="FiledExpensesEnrty")
{
	$FiledExpensesEnrty=$Common_Filter->FiledExpensesEnrty($_POST);
	echo json_encode($FiledExpensesEnrty);exit;
}if($Action=="finalassumptiondata")
{
	$finalassumptiondata=$Common_Filter->finalassumptiondata($_POST);
	echo json_encode($finalassumptiondata);exit;
}if($Action=="CompletedProjectWiseDetails")
{
	$CompletedProjectWiseDetails=$Common_Filter->CompletedProjectWiseDetails($_POST);
	echo json_encode($CompletedProjectWiseDetails);exit;
}if($Action=="AssumptionEnrtyCompleted")
{
	$AssumptionEnrtyCompleted=$Common_Filter->AssumptionEnrtyCompleted($_POST);
	echo json_encode($AssumptionEnrtyCompleted);exit;
}if($Action=="AssumptionEnrty_malefemaleamount_completed")
{
	$AssumptionEnrty_malefemaleamount_completed=$Common_Filter->AssumptionEnrty_malefemaleamount_completed($_POST);
	echo json_encode($AssumptionEnrty_malefemaleamount_completed);exit;
}if($Action=="LocationMaster")
{
	$LocationMaster=$Common_Filter->LocationMaster($_POST);
	echo json_encode($LocationMaster);exit;
}
if($Action=="ProjectMaster")
{
	$ProjectMaster=$Common_Filter->ProjectMaster($_POST);
	echo json_encode($ProjectMaster);exit;
}
if($Action=="ActivityMaster")
{
	$ActivityMaster=$Common_Filter->ActivityMaster($_POST);
	echo json_encode($ActivityMaster);exit;
}if($Action=="Consumablesallvalues")
{
	$Consumablesallvalues=$Common_Filter->Consumablesallvalues($_POST);
	echo json_encode($Consumablesallvalues);exit;
}if($Action=="consumablesentry")
{
	$consumablesentry=$Common_Filter->consumablesentry($_POST);
	echo json_encode($consumablesentry);exit;
}if($Action=="consumablesentryuom")
{
	$consumablesentryuom=$Common_Filter->consumablesentryuom($_POST);
	echo json_encode($consumablesentryuom);exit;
}if($Action=="tablewisedataconsumtion")
{
	$tablewisedataconsumtion=$Common_Filter->tablewisedataconsumtion($_POST);
	echo json_encode($tablewisedataconsumtion);exit;
}if($Action=="consumablesentry_confirm")
{
	$consumablesentry_confirm=$Common_Filter->consumablesentry_confirm($_POST);
	echo json_encode($consumablesentry_confirm);exit;
}if($Action=="consumablesentryuom_confirm")
{
	$consumablesentryuom_confirm=$Common_Filter->consumablesentryuom_confirm($_POST);
	echo json_encode($consumablesentryuom_confirm);exit;
}

if($Action=="getBreederDetails")
{
	$getBreederDetails=$Common_Filter->getBreederDetails($_POST);
	echo json_encode($getBreederDetails);exit;
}
if($Action=="getSubTableDetails")
{
	$getSubTableDetails=$Common_Filter->getSubTableDetails($_POST);
	echo json_encode($getSubTableDetails);exit;
}

if($Action=="consumablesreport")
{
	$consumablesreport=$Common_Filter->consumablesreport($_POST);
	echo json_encode($consumablesreport);exit;
}

if($Action=="assumption_malefemale_count_update")
{
	$count_update  =$Common_Filter->assumption_malefemale_count_update($_POST);
	echo json_encode($count_update);exit;
}

if($Action=="assumption_malefemale_amount_update")
{
	$amount_update  =$Common_Filter->assumption_malefemale_amount_update($_POST);
	echo json_encode($amount_update);exit;
}if($Action=="locationwiseacrageland")
{
	$locationwiseacrageland=$Common_Filter->locationwiseacrageland($_POST);
	echo json_encode($locationwiseacrageland);exit;
}if($Action=="landleasedata")
{
	$landleasedata=$Common_Filter->landleasedata($_POST);
	echo json_encode($landleasedata);exit;
}if($Action=="Add_TFA")
{
	$tfa_data=$Common_Filter->Add_TFA($_POST);
	echo json_encode($tfa_data);exit;
}if($Action=="Get_TFA_Details")
{
	$get_tfa_data=$Common_Filter->Get_TFA_Details($_POST);
	echo json_encode($get_tfa_data);exit;
}if($Action=="Add_TFA_labour_rate")
{
	$labour_rate_data=$Common_Filter->Add_TFA_labour_rate($_POST);
	echo json_encode($labour_rate_data);exit;
}if($Action=="Get_TFA_labour_rate")
{
	$get_tfa_labour_data=$Common_Filter->Get_TFA_labour_rate($_POST);
	echo json_encode($get_tfa_labour_data);exit;
}if($Action=="Delete_TFA_labour_rate")
{
	$deletion_status =$Common_Filter->Delete_TFA_labour_rate($_POST);
	echo json_encode($deletion_status);exit;
}if($Action=="TFA_finaldata")
{
	$final_tfa_submit =$Common_Filter->TFA_finaldata($_POST);
	echo json_encode($final_tfa_submit);exit;
}if($Action=="monthwiselandleasedata")
{
	$monthwiselandleasedata=$Common_Filter->monthwiselandleasedata($_POST);
	echo json_encode($monthwiselandleasedata);exit;
}if($Action=="Finaltabledetailsland")
{
	$Finaltabledetailsland=$Common_Filter->Finaltabledetailsland($_POST);
	echo json_encode($Finaltabledetailsland);exit;
}




?>