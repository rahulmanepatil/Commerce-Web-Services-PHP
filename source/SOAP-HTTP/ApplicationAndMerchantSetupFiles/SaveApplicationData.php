<?php

/* Copyright (c) 2004-2010 IP Commerce, INC. - All Rights Reserved.
 *
 * This software and documentation is subject to and made
 * available only pursuant to the terms of an executed license
 * agreement, and may be used only in accordance with the terms
 * of said agreement. This software may not, in whole or in part,
 * be copied, photocopied, reproduced, translated, or reduced to
 * any electronic medium or machine-readable form without
 * prior consent, in writing, from IP Commerce, INC.
 *
 * Use, duplication or disclosure by the U.S. Government is subject
 * to restrictions set forth in an executed license agreement
 * and in subparagraph (c)(1) of the Commercial Computer
 * Software-Restricted Rights Clause at FAR 52.227-19; subparagraph
 * (c)(1)(ii) of the Rights in Technical Data and Computer Software
 * clause at DFARS 252.227-7013, subparagraph (d) of the Commercial
 * Computer Software--Licensing clause at NASA FAR supplement
 * 16-52.227-86; or their equivalent.
 *
 * Information in this software is subject to change without notice
 * and does not represent a commitment on the part of IP Commerce.
 *
 * Sample Code is for reference Only and is intended to be used for educational purposes. It's the responsibility of
 * the software company to properly integrate into their solution code that best meets their production needs.
 */
require_once ABSPATH.'/WebServiceProxies/HTTPClient.php';

$client = new HTTPClient($_identityToken, $_baseURL);

// Application Data information
$app_data = new ApplicationData();
// <!--type: boolean-->
$app_data->ApplicationAttended = Settings::ApplicationAttended;
//<!--type: ApplicationLocation - enumeration: [NotSet,Unknown,OnPremises,OffPremises,HomeInternet]-->
$app_data->ApplicationLocation = Settings::ApplicationLocation;
//  <!--type: string-->
$app_data->ApplicationName = "Skyhill App";
// <!--type: HardwareType - enumeration: [NotSet,Unknown,PC,DialTerminal,ElectronicCashRegister,InStoreController,Mainframe,ThirdPartyDeveloper,POSPort,POSPartner]-->
$app_data->HardwareType = 'PC';
// <!--type: PINCapability - enumeration: [NotSet,Unknown,PINSupported,PINNotSupported,PINVerifiedByDevice,PINPadInoperative]-->
$app_data->PINCapability = Settings::PINCapability;
// <!--type: ReadCapability - enumeration: [NotSet,HasMSR,NoMSR,KeyOnly,Chip,ContactlessChip,ContactlessMSR,ECR,VSCCapable,RFIDCapable,EmvICC,MSREMVICC,Unknown,OCRReader,BarCodeReader,NotSpecified,ARUIVR,NoTerminal,NFCCapable]-->
$app_data->ReadCapability = Settings::ReadCapability;
//  <!--type: string-->
$app_data->SerialNumber = '208093707';
//  <!--type: string-->
$app_data->SoftwareVersion = 'v2.054';
//  <!--type: string-->
$app_data->SoftwareVersionDate = '2011-02-10';
// <!--type: string-->
$app_data->PTLSSocketId = trim (Settings::PTLSSocketId);

/*
 * Save Application Data
 *
 * Note:  Store the Application Profile Id after this step.  This will remain
 * static for your application unless you update your PTLS Socket Id.  This step
 * only needs to occur during first time application setup.
 *
 */

if ($_applicationProfileId == null){

	$applicationData = setApplicationData($app_data);

	$response = $client->SaveApplicationData ( $applicationData);

	$_applicationProfileId = $response;
	// Print Application Data
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h1>Application Data</h1></div>';
	echo '<ul><li>ApplicationProfileId:</b><font color="#800080"> ' . $_applicationProfileId . '</li></ul></font><br />';
}

function setApplicationData($appData){
	$applicationData =
						'<applicationData xmlns:i="http://www.w3.org/2001/XMLSchema-instance">'.
							'<ApplicationAttended>'.$appData->ApplicationAttended.'</ApplicationAttended>'.
							'<ApplicationLocation>'.$appData->ApplicationLocation.'</ApplicationLocation>'.
							'<ApplicationName>'.$appData->ApplicationName.'</ApplicationName>'.
							'<DeveloperId>'.$appData->DeveloperId.'</DeveloperId>'.
							'<HardwareType>'.$appData->HardwareType.'</HardwareType>'.
							'<PINCapability>'.$appData->PINCapability.'</PINCapability>'.
							'<PTLSSocketId>'.$appData->PTLSSocketId.'</PTLSSocketId>'.
							'<ReadCapability>'.$appData->ReadCapability.'</ReadCapability>'.
							'<SerialNumber>'.$appData->SerialNumber.'</SerialNumber>'.
							'<SoftwareVersion>'.$appData->SoftwareVersion.'</SoftwareVersion>'.
							'<SoftwareVersionDate>'.$appData->SoftwareVersionDate.'</SoftwareVersionDate>'.
							'<VendorId>'.$appData->VendorId.'</VendorId>'.
						'</applicationData>';

	return $applicationData;

}

?>

