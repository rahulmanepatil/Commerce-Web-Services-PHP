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


/*
 * Retrieve Service Information
 */


if ($_serviceId == null)
{


	$response = $client->getServiceInformation ();

	$_serviceInformation = $response;	

	
	/*
	 * If multiple services exist print them all to the browser
	 */

	/*
	 * Note you may have multiple ServiceId's in your array of
	 * Get Service Information.  Assign your Service Id appropriately
	 * Note:  Store the Service Id after this step.  This will remain
	 * static for your application unless you add additional services.  This step
	 * only needs to occur during first time application setup an or if additional
	 * added at a later date.
	 *
	 */

	// Print Service Information
	if (count($_serviceInformation['BankcardServices'] == 1) && $_serviceInformation['BankcardServices']['BankcardService'] )
	{
		echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h1>Service Information - Bankcard Services</h1></div>';
		if (isset($_serviceInformation['BankcardServices']['BankcardService'][1])){
			foreach ( $_serviceInformation['BankcardServices']['BankcardService'] as $bankcardService) {
				printServiceInformation ( $bankcardService );
				$_serviceId[] = array('ServiceId' => $bankcardService['ServiceId'], 'ServiceName' => translateSvcName( $bankcardService['ServiceId']));

			}
		}
		else {
			printServiceInformation ( $_serviceInformation['BankcardServices']['BankcardService']);
			$_serviceId['singleService'] = array('ServiceId' => $_serviceInformation['BankcardServices']['BankcardService']['ServiceId'], 'ServiceName' => translateSvcName ($_serviceInformation['BankcardServices']['BankcardService']['ServiceId']));

		}
	}
	if (count($_serviceInformation['ElectronicCheckingServices'] == 1) && $_serviceInformation['ElectronicCheckingServices']['ElectronicCheckingService'] != NULL)
	{
		echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h1>Service Information - Electronic Checking Services</h1></div>';
		if (is_array ( $response['ElectronicCheckingServices']['ElectronicCheckingService'] )) {
			foreach ( $response['ElectronicCheckingServices']['ElectronicCheckingService'] as $ElectronickCheckingService ) {
				printServiceInformation ( $ElectronickCheckingService );
				$_serviceId[] = array('ServiceId' => $ElectronickCheckingService->ServiceId, 'ServiceName' => translateSvcName( $ElectronickCheckingService->ServiceId));
			}
		}
		else {
			printServiceInformation ( $response['ElectronicCheckingServices']['ElectronicCheckingService'] );
			$_serviceId['singleService'] = array('ServiceId' => $response['ElectronicCheckingServices']['ElectronicCheckingService']['ServiceId'], 'ServiceName' => translateSvcName ($_serviceInformation['ElectronicCheckingServices']['ElectronicCheckingService']['ServiceId']));
		}
	}

	if (count($_serviceInformation['StoredValueServices'] == 1) && $_serviceInformation['StoredValueServices']['StoredValueService'])
	{
		echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h1>Service Information - Stored Value Services</h1></div>';
		if (is_array ( $_serviceInformation['StoredValueServices']['StoredValueService'] )) {
			foreach ( $_serviceInformation['StoredValueServices']['StoredValueService'] as $StoredValueServices ) {
				printServiceInformation ( $StoredValueServices );
				$_serviceId[] = array('ServiceId' => $response['StoredValueServices']['StoredValueService']['ServiceId'], 'ServiceName' => translateSvcName( $_serviceInformation['StoredValueServices']['StoredValueService']['ServiceId']));
			}
		}
		else {
			printServiceInformation ( $_serviceInformation['StoredValueServices']['StoredValueService'] );
			$_serviceId['singleService'] = array('ServiceId' => $_serviceInformation['StoredValueServices']['StoredValueService']['ServiceId'], 'ServiceName' => translateSvcName ($_serviceInformation['StoredValueServices']['StoredValueService']['ServiceId']));
			break;
		}
	}
}
?>