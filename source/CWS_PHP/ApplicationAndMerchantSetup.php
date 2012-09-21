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

define('ABSPATH', dirname(__FILE__).'/');
require_once ABSPATH.'/WebServiceProxies/HelperMethods.php'; // Require and bring in all helper functions
require_once ABSPATH.'/ConfigFiles/app.config.php';
date_default_timezone_set(Settings::Timezone);

global $_identityToken;
global $_serviceKey;
global $_serviceId;
global $_applicationProfileId;
global $_merchantProfileId;
global $_serviceInformation;
global $_baseURL;
global $_msgFormat;
global $client;
$_msgFormat = Settings::MsgFormat;

require_once ABSPATH.'/ConfigFiles/ReadConfigValues.php';

/*
 *
 * Create new web service client class using provided IdentityToken
 * Merchant Profile ID, Application Profile ID, and service ID are required, 
 * these values are generated below. Please cache these values in a config file 
 * for later use.
 * You may also pass the session token to increase speed again, but that token
 * will need to be generated and saved elsewhere.
 * Your client is based on the message format being used, set in the app.config.php
 *
 */
switch ($_msgFormat)
{
	case 'SOAP':
		$_baseURL = Settings::URL_BaseURL;
		require_once ABSPATH.'/WebServiceProxies/CWSClient.php';
		$client = new CWSClient ( $_identityToken, $_serviceKey );
		break;
	case 'HTTP':
		$_baseURL = Settings::URL_BaseURL;
		require_once ABSPATH.'/WebServiceProxies/HTTPClient.php';
		$client = new HTTPClient($_identityToken, $_baseURL);
		break;
	case 'JSON': 
		$_baseURL = Settings::URL_RestURL;
		require_once ABSPATH.'/WebServiceProxies/JSONClient.php';
		$client = new JSONClient($_identityToken, $_baseURL);	
		break;
	case 'XML': // TODO IMPLEMENT THE XML CLIENT
		$_baseURL = Settings::URL_RestURL;
		require_once ABSPATH.'/WebServiceProxies/XMLClient.php';
		$client = new XMLClient($_identityToken, $_baseURL);
		break; 
}

if($_applicationProfileId == null){
	include_once ABSPATH.'/ApplicationAndMerchantSetupFiles/SaveApplicationData.php';
}
if($_serviceInformation == null){
	include_once ABSPATH.'/ApplicationAndMerchantSetupFiles/GetServiceInformation.php';
}
if (isset($_serviceInformation->BankcardServices->BankcardService)  || 
		is_array($_serviceInformation->BankcardServices->BankcardService)){
	include_once ABSPATH.'/ApplicationAndMerchantSetupFiles/Create_BCP_MerchantProfiles.php';
}
//Following is the call from the HTTP Soap using arrays 
//if ($_serviceInformation['BankcardServices']['BankcardService'] != NULL ){
//	include_once ABSPATH.'/ApplicationAndMerchantSetupFiles/Create_BCP_MerchantProfiles.php';
//}


//if ($_serviceInformation->ElectronicCheckingServices->ElectronicCheckingService instanceof ElectronicCheckingService || is_array($_serviceInformation->ElectronicCheckingServices->ElectronicCheckingService)){
//	include_once ABSPATH.'/ApplicationAndMerchantSetupFiles/Create_ACH_MerchantProfiles.php';
//}
include_once ABSPATH.'/ConfigFiles/SaveConfigValues.php';

?>
