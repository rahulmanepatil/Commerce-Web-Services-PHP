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
require_once ABSPATH.'/WebServiceProxies/CWSClient.php'; // Require and bring in all required classes
require_once ABSPATH.'/WebServiceProxies/HelperMethods.php'; // Require and bring in all helper functions
require_once ABSPATH.'/ConfigFiles/app.config.php';

$_serviceKey = '';
$credentials = null;
$_identityToken = '';
global $_serviceId;
global $_applicationProfileId;
global $_merchantProfileId;
global $client;
global $_bankcardServices;
global $_electronicCheckingServices;
global $_storedValueServices;
GLOBAL $_serviceInformation;
global $_achs;
global $_bcs;


// Provided Token, The Identity Token should be stored in an encrypted format and read into the application.
// This can be stored either in a database or on the disk, but must always be protected and encrypted.
// If the IdentityToken is compromised you must notify us immmediately so we can issue a new IdentityToken
// This is main means of authentication to the platform, essentially this is your password.

require_once ABSPATH.'/ConfigFiles/ReadConfigValues.php';

/*
 *
 * Create new web service client class using provided token
 * Profile ID and service ID are not required, but increase speed of script
 * You may also pass the session token to increase speed again, but that token
 * will need to be generated and saved elsewhere.
 *
 * If the service key has multiple Merchant Profiles, the CWSClient setup is using the first
 * in the array, others are being ignored.
 */

$client = new CWSClient($_identityToken, $_serviceKey, $_merchantProfileId[0]['ProfileId'], $_merchantProfileId[0]['ServiceId'], $_applicationProfileId);
$_serviceInformation = $client->getServiceInformation();

if ($_serviceInformation->BankcardServices->BankcardService instanceof BankcardService  || is_array($_serviceInformation->BankcardServices->BankcardService)){
	$_bankcardServices = $_serviceInformation->BankcardServices;
	include_once dirname(__FILE__).'../TransactionProcessingScripts/BankcardTransactionProcessing.php';
}

if ($_serviceInformation->ElectronicCheckingServices->ElectronicCheckingService instanceof ElectronicCheckingService || is_array($_serviceInformation->ElectronicCheckingServices->ElectronicCheckingService)){
	$_electronicCheckingServices = $_serviceInformation->ElectronicCheckingServices;
	include_once dirname(__FILE__).'../TransactionProcessingScripts/ElectronicCheckingTransactionProcessing.php';
}

if ($_serviceInformation->StoredValueServices->StoredValueService instanceof StoredValueService  || is_array($_serviceInformation->StoredValueServices->StoredValueService)){
	$_storedvalueServices = $_serviceInformation->StoredValueServices;
	include_once dirname(__FILE__).'../TransactionProcessingScripts/StoredValueTransactionProcessing.php';
}


?>
