<?php 
include '../../auto_load.php';
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
}if($Action=="Delete_TFA")
{
	$deletion_status =$Common_Filter->Delete_TFA($_POST);
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
}if($Action=="land_lease_keyup_update")
{
	$land_lease_update_data=$Common_Filter->land_lease_keyup_update($_POST);
	echo json_encode($land_lease_update_data);exit;
}if($Action=="Add_Travel")
{
	$add_travel_data=$Common_Filter->Add_Travel($_POST);
	echo json_encode($add_travel_data);exit;
}if($Action=="Get_Travel_Details")
{
	$Get_Travel_data=$Common_Filter->Get_Travel_Details($_POST);
	echo json_encode($Get_Travel_data);exit;
}if($Action=="travel_per_visit_update")
{
	$travel_visit_update =$Common_Filter->travel_per_visit_update($_POST);
	echo json_encode($travel_visit_update);exit;
}if($Action=="Add_Travel_expense")
{
	$Add_Travel_expense  =$Common_Filter->Add_Travel_expense($_POST);
	echo json_encode($Add_Travel_expense);exit;
}if($Action=="Get_Travel_expense")
{
	$Get_Travel_expense  =$Common_Filter->Get_Travel_expense($_POST);
	echo json_encode($Get_Travel_expense);exit;
}if($Action=="Delete_Travel_expense")
{
	$deletion_status =$Common_Filter->Delete_Travel_expense($_POST);
	echo json_encode($deletion_status);exit;
}if($Action=="Travel_finaldata")
{
	$final_travel_submit =$Common_Filter->Travel_finaldata($_POST);
	echo json_encode($final_travel_submit);exit;
}if($Action=="exppostingvalue")
{
	$exppostingvalue=$Common_Filter->exppostingvalue($_POST);
	echo json_encode($exppostingvalue);exit;
}if($Action=="Otherexptablerecord")
{
	$Otherexptablerecord=$Common_Filter->Otherexptablerecord($_POST);
	echo json_encode($Otherexptablerecord);exit;
}if($Action=="Add_Others_expense")
{
	$Add_Others_expense  =$Common_Filter->Add_Others_expense($_POST);
	echo json_encode($Add_Others_expense);exit;
}if($Action=="Get_Others_expense")
{
	$Get_Others_expense  =$Common_Filter->Get_Others_expense($_POST);
	echo json_encode($Get_Others_expense);exit;
}if($Action=="Delete_Others_expense")
{
	$deletion_status =$Common_Filter->Delete_Others_expense($_POST);
	echo json_encode($deletion_status);exit;
}if($Action=="Others_finaldata")
{
	$final_others_submit =$Common_Filter->Others_finaldata($_POST);
	echo json_encode($final_others_submit);exit;
}if($Action=="monthwisestoreconsumables")
{
	$monthwisestoreconsumables=$Common_Filter->monthwisestoreconsumables($_POST);
	echo json_encode($monthwisestoreconsumables);exit;
}if($Action=="ConsumablesMaster")
{
	$ConsumablesMaster=$Common_Filter->ConsumablesMaster($_POST);
	echo json_encode($ConsumablesMaster);exit;
}if($Action=="getBreederDetailsManCount")
{
	$getBreederDetailsManCount=$Common_Filter->getBreederDetailsManCount($_POST);
	echo json_encode($getBreederDetailsManCount);exit;
}
if($Action=="InsertManCountTableData")
{
	$InsertManCountTableData=$Common_Filter->InsertManCountTableData($_POST);
	echo json_encode($InsertManCountTableData);exit;
}if($Action=="UpdateManCountTableData")
{
	$UpdateManCountTableData=$Common_Filter->UpdateManCountTableData($_POST);
	echo json_encode($UpdateManCountTableData);exit;
}if($Action=="AssumptionEnrty_malefemaleamount_activity")
{
	$AssumptionEnrty_malefemaleamount_activity=$Common_Filter->AssumptionEnrty_malefemaleamount_activity($_POST);
	echo json_encode($AssumptionEnrty_malefemaleamount_activity);exit;
}

if($Action=="update_location_responsible_person")
{
	$responsible_person_data =$Common_Filter->update_location_responsible_person($_POST);
	echo json_encode($responsible_person_data);exit;
}

if($Action=="Get_UOM_Details")
{
	$Get_UOM_Details=$Common_Filter->Get_UOM_Details($_POST);
	echo json_encode($Get_UOM_Details);exit;
}

if($Action=="update_consumables_uom")
{
	$update_consumables_uom=$Common_Filter->update_consumables_uom($_POST);
	echo json_encode($update_consumables_uom);exit;
}if($Action=="getConsumablesReport")
{
	$getConsumablesReport  =$Common_Filter->getConsumablesReport($_POST);
	echo json_encode($getConsumablesReport);exit;
}
if($Action=="getLocationWiseLandLeaseData")
{
	$getLocationWiseLandLeaseData  =$Common_Filter->getLocationWiseLandLeaseData($_POST);
	echo json_encode($getLocationWiseLandLeaseData);exit;
}

if($Action=="Get_tfa_employees")
{
	$Get_tfa_employees=$Common_Filter->Get_tfa_employees($_POST);
	echo json_encode($Get_tfa_employees);exit;
}

if($Action=="InsertLeaseLandVendorDetails")
{
	$InsertLeaseLandVendorDetails=$Common_Filter->InsertLeaseLandVendorDetails($_POST);
	echo json_encode($InsertLeaseLandVendorDetails);exit;
}

if($Action=="getCompletedLocationWiseLandLeaseData")
{
	$getCompletedLocationWiseLandLeaseData=$Common_Filter->getCompletedLocationWiseLandLeaseData();
	echo json_encode($getCompletedLocationWiseLandLeaseData);exit;
}

if($Action=="FinaltabledetailslandCompleted")
{
	$FinaltabledetailslandCompleted=$Common_Filter->FinaltabledetailslandCompleted($_POST);
	echo json_encode($FinaltabledetailslandCompleted);exit;
}
if($Action=="DeleteFinaltabledetailslandCompleted")
{
	$DeleteFinaltabledetailslandCompleted=$Common_Filter->DeleteFinaltabledetailslandCompleted($_POST);
	echo json_encode($DeleteFinaltabledetailslandCompleted);exit;
}
if($Action=="getAddLandLeaseData")
{
	$getAddLandLeaseData  =$Common_Filter->getAddLandLeaseData($_POST);
	echo json_encode($getAddLandLeaseData);exit;
}

if($Action == "TFA_fields_update") {
	$TFA_fields_update =$Common_Filter->TFA_fields_update($_POST);
	echo json_encode($TFA_fields_update);exit;
}

if($Action=="Add_TFA_row")
{
	$Add_TFA_row=$Common_Filter->Add_TFA_row($_POST);
	echo json_encode($Add_TFA_row);exit;
}



?>