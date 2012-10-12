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

// Commerce Web Services Client class


require_once ABSPATH.'/WebServiceProxies/CWSServiceInformation.php';
require_once ABSPATH.'/WebServiceProxies/CWSTransactionProcessing.php';
require_once ABSPATH.'/WebServiceProxies/CWSTransactionManagement.php';
require_once ABSPATH.'/WebServiceProxies/FaultHandler.php';

class newTransaction {
	public $TxnData,
	$TndrData;
}
// Holds credit card information
class creditCard {
	public $paymentAccountDataToken = '',
	$type,
	$name,
	$number,
	$expiration, // MMYY
	$cvv = '', // Code on back of card
	$address,
	$city,
	$state,
	$zip = '',
	$phone,
	$country = 'USA',
	$currency = 'USD',
	$track1,
	$track2;
}

class achCheck {
	public $PaymentAccountDataToken,
	$AccountNumber,
	$CheckCountryCode,
	$CheckNumber,
	$OwnerType,
	$RoutingNumber,
	$UseType,
	$BusinessName,
	$FirstName,
	$MiddleName,
	$LastName;
}

class configurationValues {
	public $IdentityToken,
	$ServiceId,
	$ApplicationProfileId,
	$MerchantProfileId;
}

class achTransactionData{
	public $Amount = '0.00', // amount in decimal format
	$EffectiveDate = '', // date string
	$IsRecurring = false, //boolean
	$SECCode = 'WEB', //The three letter code that indicates what NACHA regulations the transaction must adhere to. Required.
	$ServiceType = 'ACH', //Indicates the Electronic Checking service type: ACH, RDC or ECK. Required.
	$TransactionDateTime = '', // date time string
	$TransactionType = 'Debit', //Indicates the transaction type. Required. Debit/Credit
	$Creds = '';
}

// Holds transaction information for bankcard processing
class transData {
	public $InvoiceNumber = '',
	$OrderNumber = '',
	$CustomerPresent = '', // Present, Ecommerce, MOTO, NotPresent
	$EmployeeId = '', //Used for Retail, Restaurant, MOTO
	$EntryMode = '', // Keyed, TrackDataFromMSR
	$GoodsType = '', // DigitalGoods - PhysicalGoods
	$IndustryType = '', // Retail, Restaurant, Ecommerce, MOTO
	$AccountType = '', // SavingsAccount, CheckingAccount
	$Amount = '0.00', // in a decimal format xx.xx
	$CashBackAmount = '', // in a decimal format. used for PINDebit transactions
	$CurrencyCode = '', // TypeISOA3 Currency Codes USD CAD
	$SignatureCaptured = false, // boolean true or false
	$TipAmount = '0.00', // in a decimal format
	$ApprovalCode = '',
	$ReportingData = null,
	$Creds = '',
	$DateTime = '',
	$AltMerchantData = null;
}
class transDataPro {
	public $InvoiceNumber = '',
	$OrderNumber = '',
	$CustomerPresent = '', // Present, Ecommerce, MOTO, NotPresent
	$EmployeeId = '', //Used for Retail, Restaurant, MOTO
	$EntryMode = '', // Keyed, TrackDataFromMSR
	$GoodsType = '', // DigitalGoods - PhysicalGoods
	$IndustryType = '', // Retail, Restaurant, Ecommerce, MOTO
	$AccountType = '', // SavingsAccount, CheckingAccount
	$Amount = '0.00', // in a decimal format xx.xx
	$CashBackAmount = '', // in a decimal format. used for PINDebit transactions
	$CurrencyCode = '', // TypeISOA3 Currency Codes USD CAD
	$SignatureCaptured = false, // boolean true or false
	$TipAmount = '0.00', // in a decimal format
	$ApprovalCode = '',
	$ReportingData = null,
	$DateTime = '',
	$Creds = '',
	$CFeeAmount = '0.00',
	$AltMerchantData = null,
	$InterchangeData = null,
	$Level2Data = null;
}

class altMerchantData{
	public $CustomerServiceInternet = '', $CustomerServicePhone = '', $Description = '', $SIC = '', $MerchantId = '', $Name = '', $Address = null;
}

class interchangeData {
	public $BillPayment = '', $RequestCommercialCard = '', $ExistingDebt = '', $RequestACI = '', $TotalNumberOfInstallments = '', $CurrentInstallmentNumber = '', $RequestAdvice = '';
}

// processes soap error.  Ideally create a class to handle all CWS SOAP faults.  Please see the FaultHandler.php class
function process_soap_error($error) {
	foreach ( $error as $key => $value ) {
		echo $key . '<br>';
		print_r ( $value );
		echo '<br>';
	}
	echo '<br />';
	print_r ( $error );
	echo '<br />';
}

// Creates a client class to process Service Information and Transaction messages
class CWSClient {
	private $token, // IdentityToken
	$session_token = '', // Temporary session token used for transactions (Expires every 30 minutes)
	$serviceKey = '', // Only used with dedicated endpoints
	$merchantProfileID = '', // This is your merchant ProfileId
	$workflowId = '', // ServiceId/WorkFlowId of service connecting to
	$appProfileID = '', // This value is returned on your SaveApplicationData call
	$serviceInfo, // Service information WSDL
	$bankCard, // Bank Card WSDL
	$svc,
	$txnManagement; // Data Services - Transaction Management Service


	public function __construct($token, $serviceKey, $merchProfileID = '', $workflowId = '', $applicationID = '', $session_token = '', $_svc = null) {
		$this->token = new SignOnWithToken ();
		try {
			if ($serviceKey != '')
				$serviceKey = '/' . $serviceKey;
			$this->serviceInfo = new CWSServiceInformation ( dirname(__FILE__).'/WSDL/CWSServiceInformation.wsdl', array ('trace' => 1, 'exceptions' => 1, 'cache_wsdl' => WSDL_CACHE_NONE ) );
			$this->bankCard = new CwsTransactionProcessing (  dirname(__FILE__).'/WSDL/CwsTransactionProcessing.wsdl', array ('trace' => 1, 'exceptions' => 1, 'cache_wsdl' => WSDL_CACHE_NONE ) );
			$this->txnManagement = new CWSTransactionManagement (  dirname(__FILE__).'/WSDL/CWSTransactionManagement.wsdl', array ('trace' => 1, 'exceptions' => 1, 'cache_wsdl' => WSDL_CACHE_NONE ) );
			
			$this->serviceInfo->__setLocation(Settings::BaseSvcEndpointPrimary);
			$this->bankCard->__setLocation(Settings::BaseTxnEndpointPrimary);
			$this->txnManagement->__setLocation(Settings::BaseDataServicesEndpointPrimary);
			
		} catch ( SoapFault $e ) {
			// You can also try the secondary endpoints to see if they are up.
			/*$this->serviceInfo = new CWSServiceInformation("https://cws-02.cert.ipcommerce.com/2.0.13/SvcInfo/".$serviceKey."?wsdl", array('trace'=>1, 'exceptions'=>1));
			 *$this->bankCard = new CWSBankcard("https://cws-02.cert.ipcommerce.com/2.0.13/Txn/".$serviceKey."?wsdl", array('trace'=>1, 'exceptions'=>1));
			 */
			echo 'SERVER ERROR: Error trying to initialize.<br />';

			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
		$this->token->identityToken = $token;
		$this->serviceKey = $serviceKey;
		$this->merchantProfileID = $merchProfileID;
		$this->workflowId = $workflowId;
		$this->appProfileID = $applicationID;
		$this->svc = $_svc;
	}

	/*
	 *
	 * Sign on and retrieve the session token from the WSDL
	 *
	 */
	public function signOn() {

		if ($this->session_token == '') {
			try {
				$st = new SignOnWithToken ();
				$st->identityToken = $this->token->identityToken;
				$response = $this->serviceInfo->SignOnWithToken ( $st );
				$this->session_token = $response->SignOnWithTokenResult;
			} catch ( Exception $e ) {
				echo '<br/>SERVER ERROR: Error Signing On. <br/> ';
				echo $this->serviceInfo->__getLastRequestHeaders();
				echo $this->serviceInfo->__getLastRequest();
				echo 'REQUEST<br/>' . $this->serviceInfo->__getLastRequest ();
				$xmlFault = $this->serviceInfo->__getLastResponse ();
				$errors = handleSvcInfoFault ( $e, $xmlFault );
				echo $errors;
				exit ();
			}
		}
		return true;
	}

	/*
	 *
	 * Retrieve all available services
	 *
	 */
	public function getServiceInformation() {
		if (! $this->signOn ())
		return false;
		try {
			$si = new GetServiceInformation ();
			$si->sessionToken = $this->session_token;
			$response = $this->serviceInfo->GetServiceInformation ( $si );
			if ($response)
			//echo $this->serviceInfo->__getLastResponse();
			//return $response->GetServiceInformationResult->BankcardServices->BankcardService;
			return $response->GetServiceInformationResult;

		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Service Information.<br/>';
			$xmlFault = $this->serviceInfo->__getLastResponse ();
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	// Return only the ServiceID
	public function getServiceID() {
		$response = $this->getServiceInformation ();
		if ($response)
		//return $response->GetServiceInformationResult->BankcardServices->BankcardService->ServiceId;
		return $response->GetServiceInformationResponse;
		return false;
	}

	/*
	 *
	 * Retrieve all available Merchant Profiles for a given Service Id
	 *
	 */
	public function getMerchantProfiles($svcId, $tndrType) {
		if (! $this->signOn ())
		return false;
		try {
			$mp = new GetMerchantProfiles ();
			$mp->sessionToken = $this->session_token;
			$mp->serviceId = $svcId;
			$mp->tenderType = $tndrType;
			$response = $this->serviceInfo->GetMerchantProfiles ( $mp );
			//									echo ('<br />'.$this->serviceInfo->__getLastRequestHeaders());
			//			 echo ('<br />'.$this->serviceInfo->__getLastRequest());
			//			 echo ('<br />'.$this->serviceInfo->__getLastResponseHeaders());
			//			 echo ('<br />'.$this->serviceInfo->__getLastResponse());
			return $response->GetMerchantProfilesResult->MerchantProfile;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Merchant Profiles.<br/>';
			$xmlFault = $this->serviceInfo->__getLastResponse ();
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	
	/*
	 *
	 * Retrieve a specific Merchant Profile for a given Service Id and Merchant ProfileId
	 *
	 */
	public function getMerchantProfile($svcId, $merchProfId, $tndrType) {
		if (! $this->signOn ())
		return false;
		try {
			$mp = new GetMerchantProfile ();
			$mp->sessionToken = $this->session_token;
			$mp->serviceId = $svcId;
			$mp->merchantProfileId = $merchProfId;
			$mp->tenderType = $tndrType;			
			$response = $this->serviceInfo->GetMerchantProfile ( $mp );
			return $response->GetMerchantProfilesResult->MerchantProfile;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Merchant Profiles.<br/>';
			$xmlFault = $this->serviceInfo->__getLastResponse ();
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Return only the Profile Id
	 *
	 */

	public function getMerchantProfileId() {
		$response = $this->getMerchantProfiles ();
		if ($response)
		return $response->GetMerchantProfilesResult->MerchantProfile->ProfileId;
		return false;
	}

	/*
	 *
	 * Is the Merchant Profile Initialized
	 *
	 */
	public function isMerchantProfileInitialized($merchProfileId, $serviceId) {
		if (! $this->signOn ())
		return false;
		try {
			$mi = new IsMerchantProfileInitialized ();
			$mi->sessionToken = $this->session_token;
			$mi->serviceId = $serviceId;
			$mi->tenderType = 'Credit';
			$mi->merchantProfileId = $merchProfileId;
			$response = $this->serviceInfo->isMerchantProfileInitialized ( $mi );
			//			echo ('<br />'.$this->serviceInfo->__getLastRequest());
			//			echo ('<br />'.$this->serviceInfo->__getLastResponse());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Checking if Merchant Profile is Initialized.<br/>';
			$xmlFault = $this->serviceInfo->__getLastResponse ();
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}

	}
	/*
	 *
	 * Save Application Data
	 *
	 */
	public function saveApplicationData($appData) {
		if (! $this->signOn ())
		return false;
		try {
			$ad = new SaveApplicationData ();
			$ad->sessionToken = $this->session_token;
			$ad->applicationData = $appData;
			$response = $this->serviceInfo->SaveApplicationData ( $ad );
			return $response->SaveApplicationDataResult; //application profile id
		} catch ( SoapFault $e ) {
			echo '<br />SERVER ERROR: Error Retrieving Merchant Profiles.<br />';
			$xmlFault = $this->serviceInfo->__getLastResponse ();
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Save Merchant Profiles
	 *
	 */
	public function saveMerchantProfiles($merchantProfile, $tenderType, $serviceId) {
		if (! $this->signOn ())
		return false;
		try {
			$mp = new merchantProfiles ();
			$mp->MerchantProfile = $merchantProfile;

			$smp = new SaveMerchantProfiles ();
			$smp->sessionToken = $this->session_token;
			$smp->serviceId = $serviceId;
			$smp->tenderType = $tenderType;
			$smp->merchantProfiles = $mp;
			$response = $this->serviceInfo->SaveMerchantProfiles ( $smp );
			//						echo ('<br />'.$this->serviceInfo->__getLastRequestHeaders());
			//			 echo ('<br />'.$this->serviceInfo->__getLastRequest());
			//			 echo ('<br />'.$this->serviceInfo->__getLastResponseHeaders());
			//			 echo ('<br />'.$this->serviceInfo->__getLastResponse());
			return $response;

		} catch ( SoapFault $e ) {
			echo '<br />SERVER ERROR: Error Saving Merchant Profiles.<br />';
			//echo ('<br />'.$this->serviceInfo->__getLastRequest());
			//echo ('<br />'.$this->serviceInfo->__getLastResponse());
			$xmlFault = $this->serviceInfo->__getLastResponse ();
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			//echo $xmlFault;
			exit ();
		}
	}

	/*
	 *
	 * Authorize a payment amount
	 * $credit_info is class type creditCard
	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function queryAccount($ach_info, $trans_info) {
		if (! $this->signOn ())
		return false;

		$ach_trans = buildACHTransaction($ach_info, $trans_info) ;

		// Build QueryAccount
		$queryAccount = new QueryAccount();
		$queryAccount->sessionToken = $this->session_token;
		$queryAccount->transaction = $ach_trans;
		$queryAccount->merchantProfileId = $this->merchantProfileID;
		$queryAccount->workflowId = $this->workflowId;
		$queryAccount->applicationProfileId = $this->appProfileID;

		try {
			$authResponse = $this->bankCard->QueryAccount( $queryAccount )->QueryAccountResult;
			//var_dump($queryAccount);
			//echo ($this->bankCard->__getLastRequest ());
			//echo ('<br/>' . $this->bankCard->__getLastResponse ());
			return $authResponse;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Query Account.<br/>';
			//var_dump($queryAccount);
			//echo('<br/>'.$this->bankCard->__getLastRequestHeaders());
			//echo ('<br/>' . $this->bankCard->__getLastRequest ());
			//echo ('<br/>' . $this->bankCard->__getLastResponse ());
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Authorize a payment amount
	 * $credit_info is class type creditCard
	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function authorize($credit_info, $trans_info, $processAsPro = false) {
		if (! $this->signOn ())
		return false;

		if ($this->svc instanceof BankcardService || $this->svc == null){  
			// Bank transactionPro
			if ($processAsPro == true)
			$trans = buildTransactionPro ( $credit_info, $trans_info );

			// Bank Transaction
			else
			$trans = buildTransaction ( $credit_info, $trans_info );
		}
		if ($this->svc instanceof ElectronicCheckingService){
			$trans = buildACHTransaction($credit_info, $trans_info);
		}
		//Verify that the Amount is in the proper format of two decimals
		//$bank_trans->TransactionData->Amount = number_format($bank_trans->TransactionData->Amount, 2, '.', '');

		// Build Authorize
		$auth = new Authorize ();
		$auth->sessionToken = $this->session_token;
		$auth->transaction = $trans;
		$auth->merchantProfileId = $this->merchantProfileID;
		$auth->workflowId = $this->workflowId;
		$auth->applicationProfileId = $this->appProfileID;

		try {
			$authResponse = $this->bankCard->Authorize ( $auth )->AuthorizeResult;
			//var_dump($auth);
			//echo ($this->bankCard->__getLastRequestHeaders ());
			//echo ($this->bankCard->__getLastRequest ());
			//echo ('<br/>' . $this->bankCard->__getLastResponse ());
			return $authResponse;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error t\nrying to Authorize.<br/>';
			//var_dump($auth);
			//echo('<br/>'.$this->bankCard->__getLastRequestHeaders());
			echo ('<br/>' . $this->bankCard->__getLastRequest ());
			//echo ('<br/>' . $this->bankCard->__getLastResponse ());
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Charge funds from an account based on transaction id
	 * $transactionID is the known transaction ID of a previous transaction
	 * $amount is the amount of money to charge, leave it empty to charge existing amount
	 * $tip_amount is the amount of tip money to charge, leave it empty to charge existing amount
	 *
	 */
	public function capture($transactionID, $creds = null, $amount = null, $tip_amount = null) {
		if (! $this->signOn ())
		return false;

		$cap = new BankcardCapture ();
		$cap->TransactionId = $transactionID;
		$cap->Amount = $amount;
		$cap->TipAmount = $tip_amount;
		if ($creds != null) {
			$cap->Addendum = new Addendum ();
			$cap->Addendum->Unmanaged = new Unmanaged ();
			$cap->Addendum->Unmanaged->Any = new Any ();
			$cap->Addendum->Unmanaged->Any->string = $creds;
		}

		// Build Capture
		$trans = new CaptureAuth ();
		$trans->sessionToken = $this->session_token;
		$trans->differenceData = $cap;
		$trans->merchantProfileId = $this->merchantProfileID;
		$trans->workflowId = $this->workflowId;
		$trans->applicationProfileId = $this->appProfileID;

		try {
			$capResponse = $this->bankCard->Capture ( $trans )->CaptureResult;
			//echo ('<br />'.$this->bankCard->__getLastRequestHeaders());
			//echo ('<br />'.$this->bankCard->__getLastRequest());
			/*echo ('<br />'.$this->bankCard->__getLastResponseHeaders());
			 echo ('<br />'.$this->bankCard->__getLastResponse());*/
			return $capResponse;
		} catch ( SoapFault $e ) {
			echo "<br>REQUEST:\n" . $this->bankCard->__getLastRequest() . "\n<Br>";
			process_soap_error ( $e );
			echo 'SERVER ERROR: Error trying to Capture.<br/>';
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Authorize and Capture a payment amount
	 * $credit_info is class type creditCard
	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function authorizeAndCapture($credit_info, $trans_info, $processAsPro) {
		if (! $this->signOn ())
		return false;

		// Build BankcardTransactionPro transaction if interchange data is present
		if ($processAsPro == true) // Bank transaction
		$bank_trans = buildTransactionPro ( $credit_info, $trans_info );

		// Build Bankcard transaction
		else
		$bank_trans = buildTransaction ( $credit_info, $trans_info );

		// Build AuthorizeAndCapture
		$auth = new AuthorizeAndCapture ();
		$auth->sessionToken = $this->session_token;
		$auth->transaction = $bank_trans;
		$auth->merchantProfileId = $this->merchantProfileID;
		$auth->workflowId = $this->workflowId;
		$auth->applicationProfileId = $this->appProfileID;

		try {
			$response = $this->bankCard->AuthorizeAndCapture ( $auth )->AuthorizeAndCaptureResult;
			//echo ($this->bankCard->__getLastRequest());
			//echo('<br/>'.$this->bankCard->__getLastResponse());*/
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Authorize and Capture.<br/>';
			//echo ('<br />' . $this->bankCard->__getLastRequest ());
			//echo ('<br />' . $this->bankCard->__getLastResponse ());
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Void or Return funds to an account based on transaction id
	 * NOTE: Use this function to void Authorize
	 * $transactionID is the known transaction ID of a previous transaction
	 *
	 */
	public function undo($transactionID, $creds = null, $txnType = null) {
		if (! $this->signOn ())
		return false;

		if ($this->svc instanceof BankcardService || $txnType == "BCP"){
			$differenceData = new BankcardUndo();
		}
		if ($this->svc instanceof ElectronicCheckingService || $txnType == "ECK"){
			$differenceData = new UndoDifferenceData();
		}
		$differenceData->TransactionId = $transactionID;
		if ($creds != null) {
			$differenceData->Addendum = new Addendum ();
			$differenceData->Addendum->Unmanaged = new Unmanaged ();
			$differenceData->Addendum->Unmanaged->Any = new Any ();
			$differenceData->Addendum->Unmanaged->Any->string = $creds;
		}


		// Build Undo
		$trans = new Undo ();
		$trans->sessionToken = $this->session_token;
		$trans->differenceData = $differenceData;
		$trans->workflowId = $this->workflowId;
		$trans->applicationProfileId = $this->appProfileID;
		//var_dump($trans);


		try {
			$response = $this->bankCard->Undo ( $trans )->UndoResult;
			//echo ($this->bankCard->__getLastRequest ());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Undo.<br/>';
			echo ('<br />'.$this->bankCard->__getLastRequestHeaders());
			echo ('<br />' . $this->bankCard->__getLastRequest ());
			echo ('<br />' . $this->bankCard->__getLastResponse ());
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Return funds to an account based on transaction id
	 * $transactionID is the known transaction ID of a previous transaction
	 * $amount is the amount of money to return, leave it empty to return full amount
	 *
	 */
	public function returnByID($transactionID, $creds = null, $amount = null) {
		if (! $this->signOn ())
		return false;

		$return_amount = new BankcardReturn ();
		$return_amount->Amount = $amount;
		$return_amount->TransactionId = $transactionID;
		if ($creds != null) {
			$return_amount->Addendum = new Addendum ();
			$return_amount->Addendum->Unmanaged = new Unmanaged ();
			$return_amount->Addendum->Unmanaged->Any = new Any ();
			$return_amount->Addendum->Unmanaged->Any->string = $creds;
		}

		// Build ReturnById
		$trans = new ReturnById ();
		$trans->sessionToken = $this->session_token;
		$trans->transactionId = $transactionID;
		$trans->differenceData = $return_amount;
		$trans->merchantProfileId = $this->merchantProfileID;
		$trans->workflowId = $this->workflowId;
		$trans->applicationProfileId = $this->appProfileID;

		try {
			$response = $this->bankCard->ReturnById ( $trans )->ReturnByIdResult;
			/*echo 'RETURNBYID: <br/>';
			 echo ('<br />'.$this->bankCard->__getLastRequestHeaders());*/
			//echo ('<br />'.$this->bankCard->__getLastRequest());
			/*echo ('<br />'.$this->bankCard->__getLastResponseHeaders());
			 echo ('<br />'.$this->bankCard->__getLastResponse());*/
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Return By ID.<br/>';
			//echo ('<br />'.$this->bankCard->__getLastRequest());
			//echo ('<br />'.$this->bankCard->__getLastResponse());
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Return funds to an account (see Authorize/Authorize and Capture for structure)
	 *
	 */
	public function returnUnlinked($credit_info, $trans_info) {
		if (! $this->signOn ())
		return false;

		// Bank transaction
		$bank_trans = buildTransaction ( $credit_info, $trans_info );

		// Build Return Unlinked
		//
		$trans = new ReturnUnlinked ();
		$trans->sessionToken = $this->session_token;
		$trans->transaction = $bank_trans;
		$trans->merchantProfileId = $this->merchantProfileID;
		$trans->workflowId = $this->workflowId;
		$trans->applicationProfileId = $this->appProfileID;

		try {
			$response = $this->bankCard->ReturnUnlinked ( $trans )->ReturnUnlinkedResult;
			//echo ('<br />'.$this->bankCard->__getLastRequest());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Return Unlinked.';
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Settle specific transactions from the day - Do not pass in Undo's or Authorize txns
	 * that have had an Undo processed against it
	 * $transactionIds are a list of transactions that you wish to settle
	 * $differenceData is an object that contains any data to adjust at the time of settlement
	 *
	 */
	public function captureSelective($transactionIds, $differenceData, $creds = null) {
		if (! $this->signOn ())
		return false;
		$diffDataArray = array ();

		if ($differenceData != null) {
			$i = 0;
			if (is_array ( $differenceData )) {
				foreach ( $diffData as $differenceData ) {
					$csDiffData = new CaptureDifferenceData ();
					$csDiffData->TransactionId = $diffData->transactionID;
					$csDiffData->Amount = $diffData->amount;
					$csDiffData->TipAmount = $diffData->tip_amount;
					$csDiffData->ShipDate = $diffData->shipDate;
					$diffDataArray [] = $csDiffData;
				}
			} else {
				$csDiffData = new CaptureDifferenceData ();
				$csDiffData->TransactionId = $diffData->transactionID;
				$csDiffData->Amount = $diffData->amount;
				$csDiffData->TipAmount = $diffData->tip_amount;
				$csDiffData->ShipDate = $diffData->shipDate;
				$diffDataArray [] = $csDiffData;
			}
			if ($creds != null) {
				$diffDataArray [0]->Addendum = new Addendum ();
				$diffDataArray [0]->Addendum->Unmanaged = new Unmanaged ();
				$diffDataArray [0]->Addendum->Unmanaged->Any = new Any ();
				$diffDataArray [0]->Addendum->Unmanaged->Any->string = $creds;
			}
		}

		// Build Capture


		$trans = new CaptureSelective ();
		$trans->sessionToken = $this->session_token;
		$trans->transactionIds = $transactionIds;
		$trans->differenceData = $diffDataArray;
		$trans->merchantProfileId = $this->merchantProfileID;
		$trans->workflowId = $this->workflowId;
		$trans->applicationProfileId = $this->appProfileID;

		try {
			$capSelectiveResponse = $this->bankCard->CaptureSelective ( $trans )->CaptureSelectiveResult;
			/*echo ('<br />'.$this->bankCard->__getLastRequestHeaders());
			 echo ('<br />'.$this->bankCard->__getLastRequest());
			 echo ('<br />'.$this->bankCard->__getLastResponseHeaders());
			 echo ('<br />'.$this->bankCard->__getLastResponse());*/
			return $capSelectiveResponse;
		} catch ( SoapFault $e ) {
			/*echo "<br>REQUEST:\n" . $this->bankCard->__getLastRequest() . "\n<Br>";*/
			echo 'SERVER ERROR: Error trying to Capture.<br/>';
			echo ('<br />'.$this->bankCard->__getLastRequest());
			//echo ('<br />'.$this->bankCard->__getLastResponse());
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Settle all transactions from the day
	 *
	 * $differenceData is an object that contains any data to adjust at the time of settlement
	 *
	 */
	public function captureAll($differenceData, $creds = null) {
		if (! $this->signOn ())
		return false;

		if ($this->svc instanceof BankcardService){
			$diffDataArray = array ();
			$caDiffData = new CaptureDifferenceData ();
				
			if ($differenceData != null) {
				$i = 0;
				if (is_array ( $differenceData )) {
					foreach ( $diffData as $differenceData ) {
						$caDiffData->TransactionId = $diffData->transactionID;
						$caDiffData->Amount = $diffData->amount;
						$caDiffData->TipAmount = $diffData->tip_amount;
						$caDiffData->ShipDate = $diffData->shipDate;
						$diffDataArray [] = $caDiffData;
					}
				} else {
					$caDiffData->TransactionId = $diffData->transactionID;
					$caDiffData->Amount = $diffData->amount;
					$caDiffData->TipAmount = $diffData->tip_amount;
					$caDiffData->ShipDate = $diffData->shipDate;
					$diffDataArray [] = $caDiffData;
				}
				if ($creds != null) {
					$diffDataArray [0]->Addendum = new Addendum ();
					$diffDataArray [0]->Addendum->Unmanaged = new Unmanaged ();
					$diffDataArray [0]->Addendum->Unmanaged->Any = new Any ();
					$diffDataArray [0]->Addendum->Unmanaged->Any->string = $creds;
				}
			}
		}

		if ($creds != null) {
			$diffDataArray = array ();			
			$caDiffData = new CaptureDifferenceData ();
			$caDiffData->TransactionId = '-1';
			$diffDataArray [] = $caDiffData;
			$diffDataArray [0]->Addendum = new Addendum ();
			$diffDataArray [0]->Addendum->Unmanaged = new Unmanaged ();
			$diffDataArray [0]->Addendum->Unmanaged->Any = new Any ();
			$diffDataArray [0]->Addendum->Unmanaged->Any->string = $creds;
		}
		// Build Capture


		$trans = new CaptureAll ();
		$trans->sessionToken = $this->session_token;
		$trans->differenceData = $diffDataArray;
		$trans->merchantProfileId = $this->merchantProfileID;
		$trans->workflowId = $this->workflowId;
		$trans->applicationProfileId = $this->appProfileID;

		try {
			$capAllResponse = $this->bankCard->CaptureAll ( $trans )->CaptureAllResult;
			//echo ('<br />'.$this->bankCard->__getLastRequestHeaders());
			//echo ('<br />'.$this->bankCard->__getLastRequest());
			//echo ('<br />'.$this->bankCard->__getLastResponseHeaders());
			//echo ('<br />\n'.$this->bankCard->__getLastResponse().'\n');
			return $capAllResponse;
		} catch ( SoapFault $e ) {
			/*echo "<br>REQUEST:\n" . $this->bankCard->__getLastRequest() . "\n<Br>";*/
			//process_soap_error ( $e );
			echo 'SERVER ERROR: Error trying to Capture.<br/>';
			echo ('<br />'.$this->bankCard->__getLastRequest());
			$xmlFault = $this->bankCard->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 * Data Services API calls below
	 */

	public function queryTransactionsSummary($queryTransactionParameters, $includeRelated, $pagingParameters) {
		if (! $this->signOn ())
		return false;

		// Build QueryTransactionsSummary
		$qts = new QueryTransactionsSummary();
		$qts->sessionToken = $this->session_token;
		$qts->queryTransactionsParameters = $queryTransactionParameters;
		$qts->includeRelated = $includeRelated;
		$qts->pagingParameters = $pagingParameters;


		try {
			$response = $this->txnManagement->QueryTransactionsSummary($qts)->QueryTransactionsSummaryResult;
			//echo ($this->txnManagement->__getLastRequest ());
			//echo ($this->txnManagement->__getLastResponse());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to QueryTransactionsSummary.<br/>';
			echo ('<br />'.$this->txnManagement->__getLastRequestHeaders());
			echo ('<br />' . $this->txnManagement->__getLastRequest ());
			echo ('<br />' . $this->txnManagement->__getLastResponse ());
			$xmlFault = $this->txnManagement->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	public function queryTransactionFamilies($queryTransactionParameters, $includeRelated, $pagingParameters) {
		if (! $this->signOn ())
		return false;

		// Build QueryTransactionsSummary
		$qtf = new QueryTransactionFamilies();
		$qtf->sessionToken = $this->session_token;
		$qtf->queryTransactionsParameters = $queryTransactionParameters;
		$qtf->includeRelated = $includeRelated;
		$qtf->pagingParameters = $pagingParameters;


		try {
			$response = $this->txnManagement->QueryTransactionFamilies($qtf)->QueryTransactionFamiliesResult;
			echo ($this->txnManagement->__getLastRequest ());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to QueryTransactionFamilies.<br/>';
			echo ('<br />'.$this->txnManagement->__getLastRequestHeaders());
			echo ('<br />' . $this->txnManagement->__getLastRequest ());
			echo ('<br />' . $this->txnManagement->__getLastResponse ());
			$xmlFault = $this->txnManagement->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	public function queryTransactionsDetail($queryTransactionParameters, $includeRelated, $transactionDetailFormat, $pagingParameters) {
		if (! $this->signOn ())
		return false;

		// Build QueryTransactionsDetail
		$qtd = new QueryTransactionsDetail();
		$qtd->sessionToken = $this->session_token;
		$qtd->queryTransactionsParameters = $queryTransactionParameters;
		$qtd->includeRelated = $includeRelated;
		$qtd->transactionDetailFormat = $transactionDetailFormat;
		$qtd->pagingParameters = $pagingParameters;


		try {
			$response = $this->txnManagement->QueryTransactionsDetail($qtd)->QueryTransactionsDetailResult->TransactionDetail;
			//echo ($this->txnManagement->__getLastRequest ());
			return $response;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to QueryTransactionFamilies.<br/>';
			echo ('<br />'.$this->txnManagement->__getLastRequestHeaders());
			echo ('<br />' . $this->txnManagement->__getLastRequest ());
			echo ('<br />' . $this->txnManagement->__getLastResponse ());
			$xmlFault = $this->txnManagement->__getLastResponse ();
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

}

?>