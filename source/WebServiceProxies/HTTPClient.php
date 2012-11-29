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
class HTTPClient {
	private $token, // IdentityToken
	$session_token = '', // Temporary session token used for transactions (Expires every 30 minutes)
	$serviceKey = '', // Only used with dedicated endpoints
	$merchantProfileID = '', // This is your merchant ProfileId
	$workflowId = '', // ServiceId/WorkFlowId of service connecting to
	$appProfileID = '', // This value is returned on your SaveApplicationData call
	$svcInfo, // Service information WSDL
	$txn, // Bank Card WSDL
	$svc,
	$tms; // Data Services - Transaction Management Service


	public function __construct($token, $baseURL, $merchProfileID = '', $workflowId = '', $applicationID = '', $_svc = null) {
		$this->token = new SignOnWithToken ();

		$this->svcInfo = $baseURL.'SvcInfo';
		$this->txn = $baseURL.'Txn';
		$this->tms = $baseURL.'DataServices/TMS';

		$this->token->identityToken = $token;
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
				$msgBody = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
								'<s:Body>'.
									'<SignOnWithToken xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
										'<identityToken>'.$this->token->identityToken.'</identityToken>'.
									'</SignOnWithToken>'.
								'</s:Body>'.
							'</s:Envelope>';
				$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/SignOnWithToken';

				$response = curl_soap($msgBody, $this->svcInfo, $action);
				$sessToken = $response['Body']['SignOnWithTokenResponse']['SignOnWithTokenResult'];
				$this->session_token = $sessToken;
				if (isset($response['Body']['Fault'])){
					$xmlFault = generate_valid_xml_from_array($response);
					throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
				}

			} catch ( SoapFault $e ) {
				echo '<br/>SERVER ERROR: Error Signing On. <br/> ';
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
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<GetServiceInformation xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
								'</GetServiceInformation>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/GetServiceInformation';
			//$siResponse = SendMessage($msgBody, $this->svcInfo, $action);

			$siResponse = curl_soap($msgBody, $this->svcInfo, $action);
			$siResponse = $siResponse['Body']['GetServiceInformationResponse']['GetServiceInformationResult'];
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			$si = new ServiceInformation();
			if(count($siResponse['BankcardServices']) > 0){
				$si->BankcardServices = arrayToObject($siResponse['BankcardServices']);
			}
			if(count($siResponse['ElectronicCheckingServices']) > 0){
				$si->BankcardServices = arrayToObject($siResponse['ElectronicCheckingServices']);
			}
			if(count($siResponse['StoredValueServices']) > 0){
				$si->BankcardServices = arrayToObject($siResponse['StoredValueServices']);
			}
			if(count($siResponse['Workflows']) > 0){
				$si->BankcardServices = arrayToObject($siResponse['Workflows']);
			}
			
			return ($si);

		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Service Information.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	// Return only the ServiceID
	public function getServiceID() {
		try{
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<GetServiceInformation xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.					
								'</GetServiceInformation>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/GetServiceInformation';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response['GetServiceInformationResponse'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Service Information.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
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
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<GetMerchantProfiles xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									'<serviceId>'.$svcId.'</serviceId>'.
									'<tenderType>'.$tndrType.'</tenderType>'.									
								'</GetMerchantProfiles>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/GetMerchantProfiles';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return arrayToObject($response['Body']['GetMerchantProfilesResponse']['GetMerchantProfilesResult']['MerchantProfile']);
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Merchant Profiles.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	// TODO: add GetMerchantProfile
	/*
	 *
	 * Return only the Profile Id
	 *
	 */

	public function getMerchantProfileId() {
		try{
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<GetMerchantProfileIds xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									'<serviceId>'.$serviceId.'</serviceId>'.
									'<tenderType>'.$tenderType.'</tenderType>'.									
								'</GetMerchantProfileIds>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/GetMerchantProfileIds';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response->GetMerchantProfilesResult->MerchantProfile->ProfileId;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Retrieving Merchant ProfileId.<br/>';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
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
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<IsMerchantProfileInitialized xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									'<serviceId>'.$serviceId.'</serviceId>'.
									'<merchantProfileId>'.$merchProfileId.'</merchantProfileId>'.
									'<tenderType>Credit</tenderType>'.									
								'</IsMerchantProfileInitialized>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/IsMerchantProfileInitialized';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response['Body']['IsMerchantProfileInitializedResponse']['IsMerchantProfileInitializedResult'];

		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error Checking if Merchant Profile is Initialized.<br/>';
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
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<SaveApplicationData xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$appData.
								'</SaveApplicationData>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/SaveApplicationData';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			$response = $response['Body']['SaveApplicationDataResponse']['SaveApplicationDataResult'];
			$this->appProfileID = $response;
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response;
		} catch ( SoapFault $e ) {
			echo '<br />SERVER ERROR: Error Retrieving Merchant Profiles.<br />';
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

		$merchantProfile = $this->createMerchantProfileXML($merchantProfile);
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<SaveMerchantProfiles xmlns="http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
									'<serviceId>'.$serviceId.'</serviceId>'.
									'<tenderType>'.$tenderType.'</tenderType>'.
									'<merchantProfiles xmlns:i="http://www.w3.org/2001/XMLSchema-instance">'.
			$merchantProfile.
									'</merchantProfiles>'.
								'</SaveMerchantProfiles>'.
							'</s:Body>'.
						'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation/ICWSServiceInformation/SaveMerchantProfiles';
			$response = curl_soap($msgBody, $this->svcInfo, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $response;

		} catch ( SoapFault $e ) {
			echo '<br />SERVER ERROR: Error Saving Merchant Profiles.<br />';
			$errors = handleSvcInfoFault ( $e, $xmlFault );
			echo $errors;
			//echo $xmlFault;
			exit ();
		}
	}

	/*
	 *
	 * Authorize a payment amount

	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function queryAccount($ach_info, $trans_info) {
		if (! $this->signOn ())
		return false;

		$ach_trans = $this->buildACHTransaction($ach_info, $trans_info) ;

		// Build QueryAccount
		$queryAccount = new QueryAccount();
		$queryAccount->sessionToken = $this->session_token;
		$queryAccount->transaction = $ach_trans;
		$queryAccount->merchantProfileId = $this->merchantProfileID;
		$queryAccount->workflowId = $this->workflowId;
		$queryAccount->applicationProfileId = $this->appProfileID;

		try {
			$authResponse = $this->bankCard->QueryAccount( $queryAccount )->QueryAccountResult;
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return $authResponse;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Query Account.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Authorize a payment amount

	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function authorize($credit_info, $trans_info, $processAsPro = false) {
		if (! $this->signOn ())
			return false;
				
		$transaction = $this->buildTransactionXML($credit_info, $trans_info);

		// Build Authorize
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<Authorize xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'
									.$transaction.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</Authorize>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/Authorize';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return arrayToObject($response['Body']['AuthorizeResponse']['AuthorizeResult']);

		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error t\nrying to Authorize.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	/*
	 *
	 * Verify a payment amount

	 * $trans_info is class type transData
	 *
	 */
	public function verify($trans_info) {
		if (! $this->signOn ())
			return false;

		// Build Verify
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<Verify xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</Verify>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/Verify';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return arrayToObject($response['Body']['VerifyResponse']['VerifyResult']);

		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error t\nrying to Verify.<br/>';
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
		
		$capDiffData = new CaptureDifferenceData();
		$capDiffData->TransactionId = $transactionID;
		if (Settings::IndustryType == 'Restaurant'){
			$capDiffData->TipAmount = '2.00';
			$capDiffData->Amount = $response->Amount + $capDiffData->TipAmount;
		}
		$capDiffData->Amount = '2.00';
		$capDiffXML = $this->buildCaptureXML($capDiffData);	

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<Capture xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'
									.$capDiffXML.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.									
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</Capture>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/Capture';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return $response['Body']['CaptureResponse']['CaptureResult'];
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Capture.<br/>';
			$errors = handleTxnFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	/*
	 *
	 * Authorize and Capture a payment amount
	 * $trans_info is class type transData
	 * $amount and $tip_amount: ('#.##'} (At least $1, two decimals required (1.00))
	 *
	 */
	public function authorizeAndCapture($credit_info, $trans_info, $processAsPro) {
		if (! $this->signOn ())
		return false;
				
		$transaction = $this->buildTransactionXML($credit_info, $trans_info);

		// Build AuthorizeAndCapture
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<AuthorizeAndCapture xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'
									.$transaction.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</AuthorizeAndCapture>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/AuthorizeAndCapture';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return arrayToObject($response['Body']['AuthorizeAndCaptureResponse']['AuthorizeAndCaptureResult']);
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Authorize and Capture.<br/>';
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
	public function undo( $transactionID, $creds = null, $txnType = null ) {
		if (! $this->signOn ())
			return false;
			
		$undoDiffData = new UndoDifferenceData();
		$undoDiffData->TransactionId = $transactionID;
		$undoDiffData->Amount = '2.00';
		$trans_info = $this->buildUndoXML($undoDiffData);

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<Undo xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'
									.$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.									
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</Undo>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/Undo';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return arrayToObject($response['Body']['UndoResponse']['UndoResult']);
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Undo.<br/>';

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
	public function returnByID( $transactionID, $creds = null, $amount = null) {
		if (! $this->signOn ())
			return false;
		
		$returnDiffData = new ReturnByIdDifferenceData();	
		$returnDiffData->TransactionId = $transactionID;
		$returnDiffData->Amount = $amount;
		$trans_info = $this->buildReturnByIdXML($returnDiffData);

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<ReturnById xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'
									.$trans_info.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.									
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</ReturnById>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/ReturnById';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}
			return arrayToObject($response['Body']['ReturnByIdResponse']['ReturnByIdResult']);
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Return By ID.<br/>';
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
	public function returnUnlinked( $credit_info, $trans_info) {
		if (! $this->signOn ())
			return false;

		$transaction = $this->buildTransactionXML($credit_info, $trans_info);
			
		// Build Return Unlinked
		//
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<ReturnUnlinked xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'
									.$transaction.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</ReturnUnlinked>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/ReturnUnlinked';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return arrayToObject($response['Body']['ReturnUnlinkedResponse']['ReturnUnlinkedResult']);
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Return Unlinked.';
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
		
		$capDiffData = new CaptureDifferenceData();
		$capDiffData->TransactionId = $transactionIds;
		if (Settings::IndustryType == 'Restaurant'){
			$capDiffData->TipAmount = '2.00';
			$capDiffData->Amount = $response->Amount + $capDiffData->TipAmount;
		}
		$capDiffData->Amount = '2.00';
		$differenceData = $this->buildCaptureSelectiveXML($capDiffData);
		$transactionIds = $this->buildTxnIdsXML($transactionIds);

		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<CaptureSelective xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$transactionIds.
			$differenceData.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</CaptureSelective>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/CaptureSelective';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			$obj = new stdClass();
			$obj->Response = arrayToObject($response['Body']['CaptureSelectiveResponse']['CaptureSelectiveResult']['Response']);
			return $obj;
		} catch ( SoapFault $e ) {
			echo 'SERVER ERROR: Error trying to Capture.<br/>';
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
		try {
			$msgBody = 	'<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">'.
							'<s:Body>'.
								'<CaptureAll xmlns="http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing">'.
									'<sessionToken>'.$this->session_token.'</sessionToken>'.
			$differenceData.
									'<applicationProfileId>'.$this->appProfileID.'</applicationProfileId>'.
									'<merchantProfileId>'.$this->merchantProfileID.'</merchantProfileId>'.
									'<workflowId>'.$this->workflowId.'</workflowId>'.
								'</CaptureAll>'.
							'</s:Body>'.
							'</s:Envelope>';							
			$action = 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing/ICwsTransactionProcessing/CaptureAll';
			$response = curl_soap($msgBody, $this->txn, $action);
			if (isset($response['Body']['Fault'])){
				$xmlFault = generate_valid_xml_from_array($response);
				throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
			}

			return arrayToObject($response['Body']['CaptureAllResponse']['CaptureAllResult']);
		} catch ( SoapFault $e ) {

			echo 'SERVER ERROR: Error trying to Capture.<br/>';
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
		try{
			$msgBody = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">';
			$msgBody .= '<s:Body>';
			$msgBody .= '<QueryTransactionsSummary xmlns="http://schemas.ipcommerce.com/CWS/v2.0/DataServices/TMS">';
			$msgBody .= '<sessionToken>'.$this->session_token.'</sessionToken>';
			$msgBody .= '<queryTransactionsParameters xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
			if ($queryTransactionParameters->Amounts != null){
				$msgBody .= '<Amounts xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
				if (is_array ($queryTransactionParameters->Amounts))
				{ foreach ( $queryTransactionParameters->Amounts as $Amount ) {
					$msgBody .= '<a:string>'.$Amount.'</a:string>';
				}
				}
				if (!is_array ($queryTransactionParameters->Amounts) && ($queryTransactionParameters->Amounts != null))
				$msgBody .= '<a:string>'.$Amount.'</a:string>';
				$msgBody .= '</Amounts>';
			}
			if ($queryTransactionParameters->ApprovalCodes != null){
				$msgBody .= '<ApprovalCodes xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
				if (is_array ($queryTransactionParameters->ApprovalCodes))
				{ foreach ( $queryTransactionParameters->ApprovalCodes as $ApprovalCode ) {
					$msgBody .= '<a:string>'.$ApprovalCode.'</a:string>';
				}
				}
				if (!is_array ($queryTransactionParameters->ApprovalCodes) && ($queryTransactionParameters->ApprovalCodes != null))
				$msgBody .= '<a:string>'.$ApprovalCodes.'</a:string>';
				$msgBody .= '</ApprovalCodes>';}
				if ($queryTransactionParameters->BatchIds != null){
					$msgBody .= '<BatchIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
					if (is_array ($queryTransactionParameters->BatchIds))
					{ foreach ( $queryTransactionParameters->BatchIds as $BatchId ) {
						$msgBody .= '<a:string>'.$BatchId.'</a:string>';
					}
					}
					if (!is_array ($queryTransactionParameters->BatchIds) && ($queryTransactionParameters->BatchIds != null))
					$msgBody .= '<a:string>'.$BatchIds.'</a:string>';
					$msgBody .= '</BatchIds>';}
					if ($queryTransactionParameters->CaptureDateRange != null){
						$msgBody .= '<CaptureDateRange xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices">'.$queryTransactionParameters->CaptureDateRange.'</CaptureDateRange>';}
						if ($queryTransactionParameters->CaptureStates != null){
							$msgBody .= '<CaptureStates xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions">';
							if (is_array ($queryTransactionParameters->CaptureStates))
							{ foreach ( $queryTransactionParameters->CaptureStates as $CaptureState ) {
								$msgBody .= '<a:string>'.$CaptureState.'</a:string>';
							}
							}
							if (!is_array ($queryTransactionParameters->CaptureStates) && ($queryTransactionParameters->CaptureStates != null))
							$msgBody .= '<a:string>'.$CaptureStates.'</a:string>';
							$msgBody .= '</CaptureStates>';}
							if ($queryTransactionParameters->CardTypes != null){
								$msgBody .= '<CardTypes xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">';
								if (is_array ($queryTransactionParameters->CardTypes))
								{ foreach ( $queryTransactionParameters->CardTypes as $CardType ) {
									$msgBody .= '<a:string>'.$CardType.'</a:string>';
								}
								}
								if (!is_array ($queryTransactionParameters->CardTypes) && ($queryTransactionParameters->CardTypes != null))
								$msgBody .= '<a:string>'.$CardTypes.'</a:string>';
								$msgBody .= '</CardTypes>';}
								$msgBody .= '<IsAcknowledged>'.$queryTransactionParameters->IsAcknowledged.'</IsAcknowledged>';
								if ($queryTransactionParameters->MerchantProfileIds != null){
									$msgBody .= '<MerchantProfileIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
									if (is_array ($queryTransactionParameters->MerchantProfileIds))
									{ foreach ( $queryTransactionParameters->MerchantProfileIds as $MerchantProfileId )														{
										$msgBody .= '<a:string>'.$MerchantProfileId.'</a:string>';
									}
									}
									if (!is_array ($queryTransactionParameters->MerchantProfileIds) && ($queryTransactionParameters->MerchantProfileIds != null))
									$msgBody .= '<a:string>'.$MerchantProfileIds.'</a:string>';
									$msgBody .= '</MerchantProfileIds>';}
									$msgBody .= '<QueryType>'.$queryTransactionParameters->QueryType.'</QueryType>';
									if ($queryTransactionParameters->ServiceIds != null){
										$msgBody .= '<ServiceIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
										if (is_array ($queryTransactionParameters->ServiceIds))
										{ foreach ( $queryTransactionParameters->ServiceIds as $ServiceId ) {
											$msgBody .= '<a:string>'.$ServiceId.'</a:string>';
										}
										}
										if (!is_array ($queryTransactionParameters->ServiceIds) && ($queryTransactionParameters->ServiceIds != null))
										$msgBody .= '<a:string>'.$ServiceIds.'</a:string>';
										$msgBody .= '</ServiceIds>';}
										if ($queryTransactionParameters->ServiceKeys != null){
											$msgBody .= '<ServiceKeys xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
											if (is_array ($queryTransactionParameters->ServiceKeys))
											{ foreach ( $queryTransactionParameters->ServiceKeys as $ServiceKey ) {
												$msgBody .= '<a:string>'.$ServiceKey.'</a:string>';
											}
											}
											if (!is_array ($queryTransactionParameters->ServiceKeys) && ($queryTransactionParameters->ServiceKeys != null))
											$msgBody .= '<a:string>'.$ServiceKeys.'</a:string>';
											$msgBody .= '</ServiceKeys>';}
											if ($queryTransactionParameters->TransactionClassTypePairs != null){
												$msgBody .= '<TransactionClassTypePairs>';
												if (is_array ($queryTransactionParameters->TransactionClassTypePairs))
												{ foreach ( $queryTransactionParameters->TransactionClassTypePairs as $TransactionClassTypePair ) {
													$msgBody .= '<a:string>'.$TransactionClassTypePair.'</a:string>';
												}
												}
												if (!is_array ($queryTransactionParameters->TransactionClassTypePairs) && ($queryTransactionParameters->TransactionClassTypePairs != null))
												$msgBody .= '<a:string>'.$TransactionClassTypePairs.'</a:string>';
												$msgBody .= '</TransactionClassTypePairs>';}
												if(isset($queryTransactionParameters->TransactionDateRange->StartDateTime)){
													$msgBody .= '<TransactionDateRange xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices">';
													$msgBody .= '<a:EndDateTime>'.$queryTransactionParameters->TransactionDateRange->EndDateTime.'</a:EndDateTime>';
													$msgBody .= '<a:StartDateTime>'.$queryTransactionParameters->TransactionDateRange->StartDateTime.'</a:StartDateTime>';
													$msgBody .= '</TransactionDateRange>';
												}	
												if ($queryTransactionParameters->TransactionIds != null){
													$msgBody .= '<TransactionIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
													if (is_array ($queryTransactionParameters->TransactionIds))
													{ foreach ( $queryTransactionParameters->TransactionIds as $TransactionId ) {
														$msgBody .= '<a:string>'.$TransactionId.'</a:string>';
													}
													}
													if (!is_array ($queryTransactionParameters->TransactionIds) && ($queryTransactionParameters->TransactionIds != null))
													$msgBody .= '<a:string>'.$TransactionIds[0]->transactionId.'</a:string>';
													$msgBody .= '</TransactionIds>';}
													if ($queryTransactionParameters->TransactionStates != null){
														$msgBody .= '<TransactionStates xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions">';
														if (is_array ($queryTransactionParameters->TransactionStates))
														{ foreach ( $queryTransactionParameters->TransactionStates as $TransactionState ) {
															$msgBody .= '<a:string>'.$TransactionState.'</a:string>';
														}
														}
														if (!is_array ($queryTransactionParameters->TransactionStates) && ($queryTransactionParameters->TransactionStates != null))
														$msgBody .= '<a:string>'.$TransactionStates.'</a:string>';
														$msgBody .= '</TransactionStates>';}
														$msgBody .= '</queryTransactionsParameters>';
														$msgBody .= '<includeRelated>'.$queryTransactionParameters->IncludeRelated.'</includeRelated>';
														$msgBody .= '<pagingParameters xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
														$msgBody .= '<a:Page>'.$pagingParameters->Page.'</a:Page>';
														$msgBody .= '<a:PageSize>'.$pagingParameters->PageSize.'</a:PageSize>';
														$msgBody .= '</pagingParameters>';
														$msgBody .= '</QueryTransactionsSummary>';
														$msgBody .= '</s:Body>';
														$msgBody .= '</s:Envelope>';
														echo ($msgBody);
														$action =  'http://schemas.ipcommerce.com/CWS/v2.0/DataServices/TMS/ITMSOperations/QueryTransactionsSummary';
														$response = curl_soap($msgBody, $this->tms, $action);
														if (isset($response['Body']['Fault'])){
															$xmlFault = generate_valid_xml_from_array($response);
															throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
														}
														// Only one transaction SummaryDetail was returned. - Ex. Searching on a single TxnId
														if(isset($response['Body']['QueryTransactionsSummaryResponse']['QueryTransactionsSummaryResult']['SummaryDetail']['FamilyInformation'])){
															$obj = new stdClass();
															$temp = arrayToObject($response['Body']['QueryTransactionsSummaryResponse']['QueryTransactionsSummaryResult']['SummaryDetail']);															
															$obj->SummaryDetail = array('0' => $temp);
															return $obj;
														}														
														// Multiple transaction SummaryDetails were returned.
														$obj = new stdClass();
														$obj->SummaryDetail = $response['Body']['QueryTransactionsSummaryResponse']['QueryTransactionsSummaryResult']['SummaryDetail'];
														$count = 0;
														foreach($obj->SummaryDetail as $SummaryDetail){
															$obj->SummaryDetail[$count] = arrayToObject($SummaryDetail);
															$count++;
														}
														return $obj;														
		} catch ( SoapFault $e ) {

			echo 'SERVER ERROR: Error trying to QueryTransactionsSummary.<br/>';
			$errors = handleTmsFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}

	public function queryTransactionFamilies($queryTransactionParameters, $includeRelated, $pagingParameters) {
		if (! $this->signOn ())
		return false;
		try{
			$msgBody = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">';
			$msgBody .= '<s:Body>';
			$msgBody .= '<QueryTransactionFamilies xmlns="http://schemas.ipcommerce.com/CWS/v2.0/DataServices/TMS">';
			$msgBody .= '<sessionToken>'.$this->session_token.'</sessionToken>';
			$msgBody .= '<queryTransactionsParameters xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
			if ($queryTransactionParameters->Amounts != null){
				$msgBody .= '<Amounts xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
				if (is_array ($queryTransactionParameters->Amounts))
				{ foreach ( $queryTransactionParameters->Amounts as $Amount ) {
					$msgBody .= '<a:string>'.$Amount.'</a:string>';
				}
				}
				if (!is_array ($queryTransactionParameters->Amounts) && ($queryTransactionParameters->Amounts != null))
				$msgBody .= '<a:string>'.$Amount.'</a:string>';
				$msgBody .= '</Amounts>';
			}
			if ($queryTransactionParameters->ApprovalCodes != null){
				$msgBody .= '<ApprovalCodes xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
				if (is_array ($queryTransactionParameters->ApprovalCodes))
				{ foreach ( $queryTransactionParameters->ApprovalCodes as $ApprovalCode ) {
					$msgBody .= '<a:string>'.$ApprovalCode.'</a:string>';
				}
				}
				if (!is_array ($queryTransactionParameters->ApprovalCodes) && ($queryTransactionParameters->ApprovalCodes != null))
				$msgBody .= '<a:string>'.$ApprovalCodes.'</a:string>';
				$msgBody .= '</ApprovalCodes>';}
				if ($queryTransactionParameters->BatchIds != null){
					$msgBody .= '<BatchIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
					if (is_array ($queryTransactionParameters->BatchIds))
					{ foreach ( $queryTransactionParameters->BatchIds as $BatchId ) {
						$msgBody .= '<a:string>'.$BatchId.'</a:string>';
					}
					}
					if (!is_array ($queryTransactionParameters->BatchIds) && ($queryTransactionParameters->BatchIds != null))
					$msgBody .= '<a:string>'.$BatchIds.'</a:string>';
					$msgBody .= '</BatchIds>';}
					if ($queryTransactionParameters->CaptureDateRange != null){
						$msgBody .= '<CaptureDateRange xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices">'.$queryTransactionParameters->CaptureDateRange.'</CaptureDateRange>';}
						if ($queryTransactionParameters->CaptureStates != null){
							$msgBody .= '<CaptureStates xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions">';
							if (is_array ($queryTransactionParameters->CaptureStates))
							{ foreach ( $queryTransactionParameters->CaptureStates as $CaptureState ) {
								$msgBody .= '<a:string>'.$CaptureState.'</a:string>';
							}
							}
							if (!is_array ($queryTransactionParameters->CaptureStates) && ($queryTransactionParameters->CaptureStates != null))
							$msgBody .= '<a:string>'.$CaptureStates.'</a:string>';
							$msgBody .= '</CaptureStates>';}
							if ($queryTransactionParameters->CardTypes != null){
								$msgBody .= '<CardTypes xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">';
								if (is_array ($queryTransactionParameters->CardTypes))
								{ foreach ( $queryTransactionParameters->CardTypes as $CardType ) {
									$msgBody .= '<a:string>'.$CardType.'</a:string>';
								}
								}
								if (!is_array ($queryTransactionParameters->CardTypes) && ($queryTransactionParameters->CardTypes != null))
								$msgBody .= '<a:string>'.$CardTypes.'</a:string>';
								$msgBody .= '</CardTypes>';}
								$msgBody .= '<IsAcknowledged>'.$queryTransactionParameters->IsAcknowledged.'</IsAcknowledged>';
								if ($queryTransactionParameters->MerchantProfileIds != null){
									$msgBody .= '<MerchantProfileIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
									if (is_array ($queryTransactionParameters->MerchantProfileIds))
									{ foreach ( $queryTransactionParameters->MerchantProfileIds as $MerchantProfileId )														{
										$msgBody .= '<a:string>'.$MerchantProfileId.'</a:string>';
									}
									}
									if (!is_array ($queryTransactionParameters->MerchantProfileIds) && ($queryTransactionParameters->MerchantProfileIds != null))
									$msgBody .= '<a:string>'.$MerchantProfileIds.'</a:string>';
									$msgBody .= '</MerchantProfileIds>';}
									$msgBody .= '<QueryType>'.$queryTransactionParameters->QueryType.'</QueryType>';
									if ($queryTransactionParameters->ServiceIds != null){
										$msgBody .= '<ServiceIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
										if (is_array ($queryTransactionParameters->ServiceIds))
										{ foreach ( $queryTransactionParameters->ServiceIds as $ServiceId ) {
											$msgBody .= '<a:string>'.$ServiceId.'</a:string>';
										}
										}
										if (!is_array ($queryTransactionParameters->ServiceIds) && ($queryTransactionParameters->ServiceIds != null))
										$msgBody .= '<a:string>'.$ServiceIds.'</a:string>';
										$msgBody .= '</ServiceIds>';}
										if ($queryTransactionParameters->ServiceKeys != null){
											$msgBody .= '<ServiceKeys xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
											if (is_array ($queryTransactionParameters->ServiceKeys))
											{ foreach ( $queryTransactionParameters->ServiceKeys as $ServiceKey ) {
												$msgBody .= '<a:string>'.$ServiceKey.'</a:string>';
											}
											}
											if (!is_array ($queryTransactionParameters->ServiceKeys) && ($queryTransactionParameters->ServiceKeys != null))
											$msgBody .= '<a:string>'.$ServiceKeys.'</a:string>';
											$msgBody .= '</ServiceKeys>';}
											if ($queryTransactionParameters->TransactionClassTypePairs != null){
												$msgBody .= '<TransactionClassTypePairs>';
												if (is_array ($queryTransactionParameters->TransactionClassTypePairs))
												{ foreach ( $queryTransactionParameters->TransactionClassTypePairs as $TransactionClassTypePair ) {
													$msgBody .= '<a:string>'.$TransactionClassTypePair.'</a:string>';
												}
												}
												if (!is_array ($queryTransactionParameters->TransactionClassTypePairs) && ($queryTransactionParameters->TransactionClassTypePairs != null))
												$msgBody .= '<a:string>'.$TransactionClassTypePairs.'</a:string>';
												$msgBody .= '</TransactionClassTypePairs>';}

												$msgBody .= '<TransactionDateRange xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices">';
												$msgBody .= '<a:EndDateTime>'.$queryTransactionParameters->TransactionDateRange->EndDateTime.'</a:EndDateTime>';
												$msgBody .= '<a:StartDateTime>'.$queryTransactionParameters->TransactionDateRange->StartDateTime.'</a:StartDateTime>';
												$msgBody .= '</TransactionDateRange>';
												if ($queryTransactionParameters->TransactionIds != null){
													$msgBody .= '<TransactionIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
													if (is_array ($queryTransactionParameters->TransactionIds))
													{ foreach ( $queryTransactionParameters->TransactionIds as $TransactionId ) {
														//$msgBody .= '<a:string>'.$TransactionId->transactionId.'</a:string>';
														$msgBody .= '<a:string>'.$TransactionId.'</a:string>';
													}
													}
													if (!is_array ($queryTransactionParameters->TransactionIds) && ($queryTransactionParameters->TransactionIds != null))
													$msgBody .= '<a:string>'.$TransactionIds[0]->transactionId.'</a:string>';
													$msgBody .= '</TransactionIds>';}
													if ($queryTransactionParameters->TransactionStates != null){
														$msgBody .= '<TransactionStates xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions">';
														if (is_array ($queryTransactionParameters->TransactionStates))
														{ foreach ( $queryTransactionParameters->TransactionStates as $TransactionState ) {
															$msgBody .= '<a:string>'.$TransactionState.'</a:string>';
														}
														}
														if (!is_array ($queryTransactionParameters->TransactionStates) && ($queryTransactionParameters->TransactionStates != null))
														$msgBody .= '<a:string>'.$TransactionStates.'</a:string>';
														$msgBody .= '</TransactionStates>';}
														$msgBody .= '</queryTransactionsParameters>';
														$msgBody .= '<includeRelated>'.$queryTransactionParameters->IncludeRelated.'</includeRelated>';
														$msgBody .= '<pagingParameters xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
														$msgBody .= '<a:Page>'.$pagingParameters->Page.'</a:Page>';
														$msgBody .= '<a:PageSize>'.$pagingParameters->PageSize.'</a:PageSize>';
														$msgBody .= '</pagingParameters>';
														$msgBody .= '</QueryTransactionFamilies>';
														$msgBody .= '</s:Body>';
														$msgBody .= '</s:Envelope>';
														$action =  'http://schemas.ipcommerce.com/CWS/v2.0/DataServices/TMS/ITMSOperations/QueryTransactionFamilies';
														$response = curl_soap($msgBody, $this->tms, $action);
														if (isset($response['Body']['Fault'])){
															$xmlFault = generate_valid_xml_from_array($response);
															throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
														}
														
														$obj = new stdClass();
														$obj = arrayToObject($response['Body']['QueryTransactionFamiliesResponse']['QueryTransactionFamiliesResult']);
														return $obj;
		} catch ( SoapFault $e ) {

			echo 'SERVER ERROR: Error trying to QueryTransactionFamilies.<br/>';
			$errors = handleTmsFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	public function queryTransactionsDetail($queryTransactionParameters, $includeRelated, $transactionDetailFormat, $pagingParameters) {
		if (! $this->signOn ())
		return false;
		try{
			$msgBody = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">';
			$msgBody .= '<s:Body>';
			$msgBody .= '<QueryTransactionsDetail xmlns="http://schemas.ipcommerce.com/CWS/v2.0/DataServices/TMS">';
			$msgBody .= '<sessionToken>'.$this->session_token.'</sessionToken>';
			$msgBody .= '<queryTransactionsParameters xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
			if ($queryTransactionParameters->Amounts != null){
				$msgBody .= '<Amounts xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
				if (is_array ($queryTransactionParameters->Amounts))
				{ foreach ( $queryTransactionParameters->Amounts as $Amount ) {
					$msgBody .= '<a:string>'.$Amount.'</a:string>';
				}
				}
				if (!is_array ($queryTransactionParameters->Amounts) && ($queryTransactionParameters->Amounts != null))
				$msgBody .= '<a:string>'.$Amount.'</a:string>';
				$msgBody .= '</Amounts>';
			}
			if ($queryTransactionParameters->ApprovalCodes != null){
				$msgBody .= '<ApprovalCodes xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
				if (is_array ($queryTransactionParameters->ApprovalCodes))
				{ foreach ( $queryTransactionParameters->ApprovalCodes as $ApprovalCode ) {
					$msgBody .= '<a:string>'.$ApprovalCode.'</a:string>';
				}
				}
				if (!is_array ($queryTransactionParameters->ApprovalCodes) && ($queryTransactionParameters->ApprovalCodes != null))
				$msgBody .= '<a:string>'.$ApprovalCodes.'</a:string>';
				$msgBody .= '</ApprovalCodes>';}
				if ($queryTransactionParameters->BatchIds != null){
					$msgBody .= '<BatchIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
					if (is_array ($queryTransactionParameters->BatchIds))
					{ foreach ( $queryTransactionParameters->BatchIds as $BatchId ) {
						$msgBody .= '<a:string>'.$BatchId.'</a:string>';
					}
					}
					if (!is_array ($queryTransactionParameters->BatchIds) && ($queryTransactionParameters->BatchIds != null))
					$msgBody .= '<a:string>'.$BatchIds.'</a:string>';
					$msgBody .= '</BatchIds>';}
					if ($queryTransactionParameters->CaptureDateRange != null){
						$msgBody .= '<CaptureDateRange xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices">'.$queryTransactionParameters->CaptureDateRange.'</CaptureDateRange>';}
						if ($queryTransactionParameters->CaptureStates != null){
							$msgBody .= '<CaptureStates xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions">';
							if (is_array ($queryTransactionParameters->CaptureStates))
							{ foreach ( $queryTransactionParameters->CaptureStates as $CaptureState ) {
								$msgBody .= '<a:string>'.$CaptureState.'</a:string>';
							}
							}
							if (!is_array ($queryTransactionParameters->CaptureStates) && ($queryTransactionParameters->CaptureStates != null))
							$msgBody .= '<a:string>'.$CaptureStates.'</a:string>';
							$msgBody .= '</CaptureStates>';}
							if ($queryTransactionParameters->CardTypes != null){
								$msgBody .= '<CardTypes xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">';
								if (is_array ($queryTransactionParameters->CardTypes))
								{ foreach ( $queryTransactionParameters->CardTypes as $CardType ) {
									$msgBody .= '<a:string>'.$CardType.'</a:string>';
								}
								}
								if (!is_array ($queryTransactionParameters->CardTypes) && ($queryTransactionParameters->CardTypes != null))
								$msgBody .= '<a:string>'.$CardTypes.'</a:string>';
								$msgBody .= '</CardTypes>';}
								$msgBody .= '<IsAcknowledged>'.$queryTransactionParameters->IsAcknowledged.'</IsAcknowledged>';
								if ($queryTransactionParameters->MerchantProfileIds != null){
									$msgBody .= '<MerchantProfileIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
									if (is_array ($queryTransactionParameters->MerchantProfileIds))
									{ foreach ( $queryTransactionParameters->MerchantProfileIds as $MerchantProfileId )														{
										$msgBody .= '<a:string>'.$MerchantProfileId.'</a:string>';
									}
									}
									if (!is_array ($queryTransactionParameters->MerchantProfileIds) && ($queryTransactionParameters->MerchantProfileIds != null))
									$msgBody .= '<a:string>'.$MerchantProfileIds.'</a:string>';
									$msgBody .= '</MerchantProfileIds>';}
									$msgBody .= '<QueryType>'.$queryTransactionParameters->QueryType.'</QueryType>';
									if ($queryTransactionParameters->ServiceIds != null){
										$msgBody .= '<ServiceIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
										if (is_array ($queryTransactionParameters->ServiceIds))
										{ foreach ( $queryTransactionParameters->ServiceIds as $ServiceId ) {
											$msgBody .= '<a:string>'.$ServiceId.'</a:string>';
										}
										}
										if (!is_array ($queryTransactionParameters->ServiceIds) && ($queryTransactionParameters->ServiceIds != null))
										$msgBody .= '<a:string>'.$ServiceIds.'</a:string>';
										$msgBody .= '</ServiceIds>';}
										if ($queryTransactionParameters->ServiceKeys != null){
											$msgBody .= '<ServiceKeys xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
											if (is_array ($queryTransactionParameters->ServiceKeys))
											{ foreach ( $queryTransactionParameters->ServiceKeys as $ServiceKey ) {
												$msgBody .= '<a:string>'.$ServiceKey.'</a:string>';
											}
											}
											if (!is_array ($queryTransactionParameters->ServiceKeys) && ($queryTransactionParameters->ServiceKeys != null))
											$msgBody .= '<a:string>'.$ServiceKeys.'</a:string>';
											$msgBody .= '</ServiceKeys>';}
											if ($queryTransactionParameters->TransactionClassTypePairs != null){
												$msgBody .= '<TransactionClassTypePairs>';
												if (is_array ($queryTransactionParameters->TransactionClassTypePairs))
												{ foreach ( $queryTransactionParameters->TransactionClassTypePairs as $TransactionClassTypePair ) {
													$msgBody .= '<a:string>'.$TransactionClassTypePair.'</a:string>';
												}
												}
												if (!is_array ($queryTransactionParameters->TransactionClassTypePairs) && ($queryTransactionParameters->TransactionClassTypePairs != null))
												$msgBody .= '<a:string>'.$TransactionClassTypePairs.'</a:string>';
												$msgBody .= '</TransactionClassTypePairs>';}

												$msgBody .= '<TransactionDateRange xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices">';
												$msgBody .= '<a:EndDateTime>'.$queryTransactionParameters->TransactionDateRange->EndDateTime.'</a:EndDateTime>';
												$msgBody .= '<a:StartDateTime>'.$queryTransactionParameters->TransactionDateRange->StartDateTime.'</a:StartDateTime>';
												$msgBody .= '</TransactionDateRange>';
												if ($queryTransactionParameters->TransactionIds != null){
													$msgBody .= '<TransactionIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">';
													if (is_array ($queryTransactionParameters->TransactionIds))
													{ foreach ( $queryTransactionParameters->TransactionIds as $TransactionId ) {
														$msgBody .= '<a:string>'.$TransactionId.'</a:string>';
													}
													}
													if (!is_array ($queryTransactionParameters->TransactionIds) && ($queryTransactionParameters->TransactionIds != null))
													$msgBody .= '<a:string>'.$TransactionIds[0]->transactionId.'</a:string>';
													$msgBody .= '</TransactionIds>';}
													if ($queryTransactionParameters->TransactionStates != null){
														$msgBody .= '<TransactionStates xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions">';
														if (is_array ($queryTransactionParameters->TransactionStates))
														{ foreach ( $queryTransactionParameters->TransactionStates as $TransactionState ) {
															$msgBody .= '<a:string>'.$TransactionState.'</a:string>';
														}
														}
														if (!is_array ($queryTransactionParameters->TransactionStates) && ($queryTransactionParameters->TransactionStates != null))
														$msgBody .= '<a:string>'.$TransactionStates.'</a:string>';
														$msgBody .= '</TransactionStates>';}
														$msgBody .= '</queryTransactionsParameters>';
														$msgBody .= '<includeRelated>'.$queryTransactionParameters->IncludeRelated.'</includeRelated>';
														$msgBody .= '<pagingParameters xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/DataServices" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
														$msgBody .= '<a:Page>'.$pagingParameters->Page.'</a:Page>';
														$msgBody .= '<a:PageSize>'.$pagingParameters->PageSize.'</a:PageSize>';
														$msgBody .= '</pagingParameters>';
														$msgBody .= '</QueryTransactionsDetail>';
														$msgBody .= '</s:Body>';
														$msgBody .= '</s:Envelope>';
														$action =  'http://schemas.ipcommerce.com/CWS/v2.0/DataServices/TMS/ITMSOperations/QueryTransactionsDetail';
														$response = curl_soap($msgBody, $this->tms, $action);
														if (isset($response['Body']['Fault'])){
															$xmlFault = generate_valid_xml_from_array($response);
															throw new SoapFault($response['Body']['Fault']['faultcode'], $response['Body']['Fault']['faultstring'], null, $response['Body']['Fault']['detail'], $xmlFault);
														}

														return arrayToObject($response['Body']['QueryTransactionsDetailResponse']['QueryTransactionsDetailResult']['TransactionDetail']);
		} catch ( SoapFault $e ) {

			echo 'SERVER ERROR: Error trying to QueryTransactionsDetail.<br/>';
			$errors = handleTmsFault ( $e, $xmlFault );
			echo $errors;
			exit ();
		}
	}
	
/*
 *
 * Build a bankcardtransaction on the provided data.
 *
 */

public function buildTransactionXML($credit_info, $trans_info) {
	$trans =
	'<transaction i:type="b:BankcardTransactionPro" xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions" xmlns:i="http://www.w3.org/2001/XMLSchema-instance" xmlns:b="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard/Pro">'.
				'<a:CustomerData i:nil="true"/>';
	if ($trans_info->ReportingData != null) {
		$trans = $trans.'<a:ReportingData>'.
							'<a:Comments>'.$trans_info->ReportingData->Comment.'</a:Comments>'.
							'<a:Description>'.$trans_info->ReportingData->Description.'</a:Description>'.
							'<a:Reference>'.$trans_info->ReportingData->Reference.'</a:Reference>'.
						'</a:ReportingData>';
	}

				'<a:ReportingData i:nil="true"/>';
	if ($trans_info->Creds != null) {
		$trans = $trans.'<a:Addendum>'.
						   '<a:Unmanaged>'.
							'<a:Any xmlns:c="http://schemas.microsoft.com/2003/10/Serialization/Arrays">'.
								$trans_info->Creds.
							'</a:Any>'.
						   '</a:Unmanaged>'.
						'</a:Addendum>';	
	}
	$trans = $trans.'<ApplicationConfigurationData i:nil="true" xmlns="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard"/>'.
				'<TenderData xmlns="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">';	
	if ($credit_info->paymentAccountDataToken != '')
	$trans = $trans.'<a:PaymentAccountDataToken>'.$credit_info->paymentAccountDataToken.'</a:PaymentAccountDataToken>';
	if ($credit_info->paymentAccountDataToken == ''){
		$trans = $trans.
					'<CardData>'.
						'<CardType>'.$credit_info->type.'</CardType>'.
						'<CardholderName>'.$credit_info->name.'</CardholderName>'.
						'<PAN>'.$credit_info->number.'</PAN>'.
						'<Expire>'.$credit_info->expiration.'</Expire>'.
						'<Track1Data>'.$credit_info->track1.'</Track1Data>'.
						'<Track2Data>'.$credit_info->track2.'</Track2Data>'.
					'</CardData>';		
	}
	if ($credit_info->zip != '' or $credit_info->cvv != '') {
		$trans = $trans.'<CardSecurityData>';
		if ($credit_info->zip != '') {
			$trans = $trans.'<AVSData>'.
							'<CardholderName>'.$credit_info->name.'</CardholderName>'.
							'<Street>'.$credit_info->address.'</Street>'.
							'<City>'.$credit_info->city.'</City>'.
							'<StateProvince>'.$credit_info->state.'</StateProvince>'.
							'<PostalCode>'.$credit_info->zip.'</PostalCode>'.
							'<Country>'.$credit_info->country.'</Country>'.
							'<Phone>'.$credit_info->phone.'</Phone>'.
						'</AVSData>';
		}
		if ($credit_info->cvv != '') {
			$trans = $trans.
			'<CVDataProvided>Provided</CVDataProvided>'.
			'<CVData>'.$credit_info->cvv.'</CVData>';
		}
		$trans = $trans.
					'</CardSecurityData>';
	}
	$trans = $trans.'<EcommerceSecurityData i:nil="true"/>'.
				'</TenderData>'.
				'<TransactionData i:type="b:BankcardTransactionDataPro" xmlns="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">';

	$trans = $trans. '<a:Amount>'.sprintf("%0.2f", $trans_info->Amount).'</a:Amount>';
	$trans = $trans.'<a:CurrencyCode>'.$trans_info->CurrencyCode.'</a:CurrencyCode>'.
					'<a:TransactionDateTime>'.$trans_info->DateTime.'</a:TransactionDateTime>';
	if ($trans_info->AccountType != '')
	$trans = $trans. '<AccountType>'.$trans_info->AccountType.'</AccountType>';
	if ($trans_info->AltMerchantData != null){
		$trans = $trans.'<AlternativeMerchantData>'.
						'<a:CustomerServiceInternet>'.$trans_info->AltMerchantData->CustomerServiceInternet.'</a:CustomerServiceInternet>'.
						'<a:CustomerServicePhone>'.$trans_info->AltMerchantData->CustomerServicePhone.'</a:CustomerServicePhone>'.
						'<a:Description>'.$trans_info->AltMerchantData->Description.'</a:Description>'.
						'<a:SIC>'.$trans_info->AltMerchantData->SIC.'</a:SIC>'.
						'<a:Address>'.
							'<a:Street1>'.$trans_info->AltMerchantData->Address->Street1.'</a:Street1>'.
							'<a:Street2>'.$trans_info->AltMerchantData->Address->Street2.'</a:Street2>'.
							'<a:City>'.$trans_info->AltMerchantData->Address->City.'</a:City>'.
							'<a:StateProvince>'.$trans_info->AltMerchantData->Address->StateProvince.'</a:StateProvince>'.
							'<a:PostalCode>'.$trans_info->AltMerchantData->Address->PostalCode.'</a:PostalCode>'.
							'<a:CountryCode>'.$trans_info->AltMerchantData->Address->CountryCode.'</a:CountryCode>'.
						'</a:Address>'.
						'<a:MerchantId>'.$trans_info->AltMerchantData->MerchantId.'</a:MerchantId>'.
						'<a:Name>'.$trans_info->AltMerchantData->Name.'</a:Name>'.
					'</AlternativeMerchantData>';
	}

	if ($trans_info->ApprovalCode != '')
	$trans = $trans. '<ApprovalCode>'.$trans_info->ApprovalCode.'</ApprovalCode>';
	if ($trans_info->CashBackAmount != '')
	$trans = $trans. '<CashBackAmount>'.sprintf("%0.2f", $trans_info->CashBackAmount).'</CashBackAmount>';
	$trans = $trans.'<CustomerPresent>'.$trans_info->CustomerPresent.'</CustomerPresent>';
	if($trans_info->IndustryType != 'Ecommerce')
	$trans = $trans.'<EmployeeId>'.$trans_info->EmployeeId.'</EmployeeId>';
	$trans = $trans.'<EntryMode>'.$trans_info->EntryMode.'</EntryMode>';
	$trans = $trans.'<GoodsType>'.$trans_info->GoodsType.'</GoodsType>'.
					'<IndustryType>'.$trans_info->IndustryType.'</IndustryType>';	
	$trans = $trans.'<InvoiceNumber>'.$trans_info->InvoiceNumber.'</InvoiceNumber>'.
					'<OrderNumber>'.$trans_info->OrderNumber.'</OrderNumber>'.
					'<IsPartialShipment>false</IsPartialShipment>'.
					'<SignatureCaptured>'.($trans_info->SignatureCaptured ? 'true' : 'false').'</SignatureCaptured>';
	if($trans_info->CFeeAmount != '0.00')
	$trans = $trans.'<FeeAmount>'.sprintf("%0.2f", $trans_info->CFeeAmount).'</FeeAmount>';	
	if ( $trans_info->LaneId != '')
	$trans = $trans.'<LaneId>'.$trans_info->LaneId.'</LaneId>';
	$trans = $trans.'<TipAmount>'.sprintf("%0.2f", $trans_info->TipAmount).'</TipAmount>'.
					'<BatchAssignment i:nil="true"/>'.
					'<b:ManagedBilling i:nil="true"/>'.
					'<b:Level2Data i:nil="true"/>'.
					'<b:LineItemDetails i:nil="true"/>'.
					'<b:PINlessDebitData i:nil="true"/>'.
					'</TransactionData>';
	if ( $trans_info->InterchangeData != '')
	{
	$trans = $trans.'<b:InterchangeData>'; 
		if($trans_info->InterchangeData->BillPayment != '')
			$trans = $trans.'<b:BillPayment>'.$trans_info->InterchangeData->BillPayment.'</b:BillPayment>';
	
		if($trans_info->InterchangeData->RequestCommercialCard != '')
			$trans = $trans.'<b:RequestCommercialCard>'.$trans_info->InterchangeData->RequestCommercialCard.'</b:RequestCommercialCard>';
	
		if($trans_info->InterchangeData->ExistingDebt != '')
			$trans = $trans.'<b:ExistingDebt>'.$trans_info->InterchangeData->ExistingDebt.'</b:ExistingDebt>';
	
		if($trans_info->InterchangeData->RequestACI != '')
			$trans = $trans.'<b:RequestACI>'.$trans_info->InterchangeData->RequestACI.'</b:RequestACI>';
	
		if($trans_info->InterchangeData->TotalNumberOfInstallments != '')
			$trans = $trans.'<b:TotalNumberOfInstallments>'.$trans_info->InterchangeData->TotalNumberOfInstallments.'</b:TotalNumberOfInstallments>';
	
		if($trans_info->InterchangeData->CurrentInstallmentNumber != '')
			$trans = $trans.'<b:CurrentInstallmentNumber>'.$trans_info->InterchangeData->CurrentInstallmentNumber.'</b:CurrentInstallmentNumber>';
	
		if($trans_info->InterchangeData->RequestAdvice != '')
			$trans = $trans.'<b:RequestAdvice>'.$trans_info->InterchangeData->RequestAdvice.'</b:RequestAdvice>';
	
	$trans = $trans.'</b:InterchangeData>';
	}
	else
	{
		$trans = $trans.'<b:InterchangeData i:nil="true"/>';
	}
					$trans = $trans.'</transaction>';
	return $trans;
}

/*
 *
 * Build a CaptureDifferenceData object on the provided data.
 *
 */
public function buildCaptureXML($captureDiffData, $creds = ''){
	$capture = '<differenceData i:type="b:BankcardCapturePro" xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions" xmlns:i="http://www.w3.org/2001/XMLSchema-instance" xmlns:b="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard/Pro">';
	if (is_array($captureDiffData->TransactionId)){
		foreach ($captureDiffData->TransactionId as $txnId){
			$capture = $capture.'<a:TransactionId>'.$txnId.'</a:TransactionId>';
		}
	}
	else
	$capture = $capture.'<a:TransactionId>'.$captureDiffData->TransactionId.'</a:TransactionId>';
	if ($creds != ''){
		$capture = $capture.'<Addendum>'.
											'<Any>'.
												'<string>'.$creds.'</string>'.
											'</Any>'.
										'</Addendum>';	
	}
	$capture = $capture.'<Amount xmlns="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.$captureDiffData->Amount.'</Amount>';
	if (isset($captureDiffData->ChargeType))
	$capture = $capture.'<ChargeType xmlns="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.$captureDiffData->ChargeType.'</ChargeType>';
	if (isset($captureDiffData->ShipDate))
	$capture = $capture.'<ShipDate xmlns="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.$captureDiffData->ShipDate.'</ShipDate>';
	if (isset($captureDiffData->TipAmount))
	$capture = $capture.'<TipAmount xmlns="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.$captureDiffData->TipAmount.'</TipAmount>';
	if (isset($captureDiffData->MultiplePartialCapture))
	$capture = $capture.'<b:MultiplePartialCapture>'.$captureDiffData->MultiPartialCapture.'</b:MultiplePartialCapture>';
	$capture = $capture.'<b:Level2Data i:nil="true" xmlns:c="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard"/>'.
				'<b:LineItemDetails i:nil="true" xmlns:c="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard"/>'.
				'<b:ShippingData i:nil="true"/>'.
			'</differenceData>';
	return $capture;
}
/*
 *
 * Build a CaptureDifferenceData object on the provided data.
 *
 */
public function buildCaptureSelectiveXML($captureDiffData, $creds = ''){
	$capture = '<differenceData xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
	$i = 0;
	$count = count($captureDiffData->TransactionId);
	if (is_array($captureDiffData->TransactionId)){
		for ($i = 0; $i < $count ; $i++){
			if ($captureDiffData->TransactionId[$i] != null){
				$capture = $capture.'<a:Capture i:type="b:BankcardCapture" xmlns:b="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.
					'<a:TransactionId>'.$captureDiffData->TransactionId[$i].'</a:TransactionId>';
				if ($creds != ''){
					$capture = $capture.'<Addendum>'.
											'<Any>'.
												'<string>'.$creds.'</string>'.
											'</Any>'.
										'</Addendum>';	
				}
				$capture=$capture.'<b:Amount>'.$captureDiffData->Amount.'</b:Amount>';
				if (isset($captureDiffData->ChargeType))
					$capture=$capture.'<b:ChargeType>'.$captureDiffData->ChargeType.'</b:ChargeType>';
				if (isset($captureDiffData->ShipDate))
					$capture=$capture.'<b:ShipDate>'.$captureDiffData->ShipDate.'</b:ShipDate>';
				if (isset($captureDiffData->TipAmount))
					$capture=$capture.'<b:TipAmount>'.$captureDiffData->TipAmount.'</b:TipAmount>';
				$capture=$capture.'</a:Capture>';
				$i++;
			}
			elseif ($captureDiffData->TransactionId[$i] == null)
			break;

		}
		$capture=$capture.'</differenceData>';
	}
	else{
		$capture = '<differenceData xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
		$capture = $capture.'<a:Capture i:type="b:BankcardCapture" xmlns:b="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.
					'<a:TransactionId>'.$captureDiffData->TransactionId.'</a:TransactionId>';
		if ($creds != ''){
			$capture = $capture.'<Addendum>'.
											'<Any>'.
												'<string>'.$creds.'</string>'.
											'</Any>'.
										'</Addendum>';	
		}
		$capture=$capture.'<b:Amount>'.$captureDiffData->Amount.'</b:Amount>';
		if ($captureDiffData->ChargeType != NULL)
		$capture=$capture.'<b:ChargeType>'.$cap->ChargeType.'</b:ChargeType>';
		if ($captureDiffData->ChargeType != NULL)
		$capture=$capture.'<b:ShipDate>'.$captureDiffData->ShipDate.'</b:ShipDate>';
		if ($captureDiffData->ChargeType != NULL)
		$capture=$capture.'<b:TipAmount>'.$captureDiffData->TipAmount.'</b:TipAmount>';
		$capture=$capture.'</a:Capture>';
		$capture=$capture.'</differenceData>';
	}

	return $capture;
}

public function buildTxnIdsXML($transactionIds){

	$txnIds = '<transactionIds xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">';
	if (is_array($transactionIds)){
		foreach ($transactionIds as $txnId){
			if ($txnId != null)
			$txnIds = $txnIds.'<a:string>'.$txnId.'</a:string>';
			elseif ($txnId == null)
				break;
		}
	}
	else{
		$txnIds = $txnIds.'<a:string>'.$transactionIds.'</a:string>';
	}
	$txnIds=$txnIds.'</transactionIds>';
	return $txnIds;
}

/*
 *
 * Build a ReturnDifferenceData object on the provided data.
 *
 */
public function buildReturnByIdXML($returnDiffData, $creds = ''){

	$return = '<differenceData i:type="b:BankcardReturn" xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions" xmlns:i="http://www.w3.org/2001/XMLSchema-instance" xmlns:b="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.
				'<a:TransactionId>'.$returnDiffData->TransactionId.'</a:TransactionId>';
	if ($creds != ''){
		$return = $return.'<Addendum>'.
											'<Any>'.
												'<string>'.$creds.'</string>'.
											'</Any>'.
										'</Addendum>';	
	}
	$return = $return.'<a:TransactionDateTime>'.$returnDiffData->TransactionDateTime.'</a:TransactionDateTime>'.
				'<Amount xmlns="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.$returnDiffData->Amount.'</Amount>'.
			'</differenceData>';
	return $return;
}

/*
 *
 * Build a ReturnDifferenceData object on the provided data.
 *
 */
public function buildUndoXML($undoDiffData, $creds = ''){

	$undo = '<differenceData i:type="b:BankcardUndo" xmlns:a="http://schemas.ipcommerce.com/CWS/v2.0/Transactions" xmlns:i="http://www.w3.org/2001/XMLSchema-instance" xmlns:b="http://schemas.ipcommerce.com/CWS/v2.0/Transactions/Bankcard">'.
				'<a:TransactionId>'.$undoDiffData->TransactionId.'</a:TransactionId>';
	if ($creds != ''){
		$undo = $undo.'<Addendum>'.
											'<Any>'.
												'<string>'.$creds.'</string>'.
											'</Any>'.
										'</Addendum>';	
	}
	if (isset($undoDiffData->PINDebitReason))
	$undo = $undo.'<b:PINDebitReason>'.$undoDiffData->PINDebitReason.'</b:PINDebitReason>';
	if (isset($undoDiffData->TenderData))
	$undo = $undo.'<b:TenderData i:nil="true"/>';
	$undo = $undo.'</differenceData>';
	return $undo;
}

/*
 * Function to create BCP MerchantProfile XML
 */
function createMerchantProfileXML($merchProfileData){
	$merchantProfileXML =
				'<MerchantProfile>'.
					'<ProfileId>'.$merchProfileData->ProfileId.'</ProfileId>'.
					'<LastUpdated>'.$merchProfileData->LastUpdated.'</LastUpdated>'.
					'<MerchantData>'.
						'<CustomerServiceInternet>'.$merchProfileData->MerchantData->CustomerServiceInternet.'</CustomerServiceInternet>'.
						'<CustomerServicePhone>'.$merchProfileData->MerchantData->CustomerServicePhone.'</CustomerServicePhone>'.
						'<Language>'.$merchProfileData->MerchantData->Language.'</Language>'.
						'<Address>'.
							'<Street1>'.$merchProfileData->MerchantData->Address->Street1.'</Street1>'.
							'<Street2>'.$merchProfileData->MerchantData->Address->Street2.'</Street2>'.
							'<City>'.$merchProfileData->MerchantData->Address->City.'</City>'.
							'<StateProvince>'.$merchProfileData->MerchantData->Address->StateProvince.'</StateProvince>'.
							'<PostalCode>'.$merchProfileData->MerchantData->Address->PostalCode.'</PostalCode>'.
							'<CountryCode>'.$merchProfileData->MerchantData->Address->CountryCode.'</CountryCode>'.
						'</Address>'.
						'<MerchantId>'.$merchProfileData->MerchantData->MerchantId.'</MerchantId>'.
						'<Name>'.$merchProfileData->MerchantData->Name.'</Name>'.
						'<Phone>'.$merchProfileData->MerchantData->Phone.'</Phone>'.
						'<TaxId>'.$merchProfileData->MerchantData->TaxId.'</TaxId>'.
						'<BankcardMerchantData>'.
							'<ABANumber>'.$merchProfileData->MerchantData->BankcardMerchantData->ABANumber.'</ABANumber>'.
							'<AcquirerBIN>'.$merchProfileData->MerchantData->BankcardMerchantData->AcquirerBIN.'</AcquirerBIN>'.
							'<AgentBank>'.$merchProfileData->MerchantData->BankcardMerchantData->AgentBank.'</AgentBank>'.
							'<AgentChain>'.$merchProfileData->MerchantData->BankcardMerchantData->AgentChain.'</AgentChain>'.
							'<Aggregator>'.$merchProfileData->MerchantData->BankcardMerchantData->Aggregator.'</Aggregator>'.
							'<ClientNumber>'.$merchProfileData->MerchantData->BankcardMerchantData->ClientNumber.'</ClientNumber>'.
							'<IndustryType>'.$merchProfileData->MerchantData->BankcardMerchantData->IndustryType.'</IndustryType>'.
							'<Location>'.$merchProfileData->MerchantData->BankcardMerchantData->Location.'</Location>'.
							'<PrintCustomerServicePhone>false</PrintCustomerServicePhone>'.
							'<ReimbursementAttribute>'.$merchProfileData->MerchantData->BankcardMerchantData->ReimbursementAttribute.'</ReimbursementAttribute>'.
							'<SIC>'.$merchProfileData->MerchantData->BankcardMerchantData->SIC.'</SIC>'.
							'<SecondaryTerminalId>'.$merchProfileData->MerchantData->BankcardMerchantData->SecondaryTerminalId.'</SecondaryTerminalId>'.
							'<SettlementAgent>'.$merchProfileData->MerchantData->BankcardMerchantData->SettlementAgent.'</SettlementAgent>'.
							'<SharingGroup>'.$merchProfileData->MerchantData->BankcardMerchantData->SharingGroup.'</SharingGroup>'.
							'<StoreId>'.$merchProfileData->MerchantData->BankcardMerchantData->StoreId.'</StoreId>'.
							'<TerminalId>'.$merchProfileData->MerchantData->BankcardMerchantData->TerminalId.'</TerminalId>'.
							'<TimeZoneDifferential>'.$merchProfileData->MerchantData->BankcardMerchantData->TimeZoneDifferential.'</TimeZoneDifferential>'.
						'</BankcardMerchantData>'.
						'<ElectronicCheckingMerchantData i:nil="true"/>'.
					'</MerchantData>'.
					'<TransactionData>'.
						'<BankcardTransactionDataDefaults>'.
							'<CurrencyCode>'.$merchProfileData->TransactionData->BankcardTransactionDataDefaults->CurrencyCode.'</CurrencyCode>'.
							'<CustomerPresent>'.$merchProfileData->TransactionData->BankcardTransactionDataDefaults->CustomerPresent.'</CustomerPresent>'.
							'<EntryMode>'.$merchProfileData->TransactionData->BankcardTransactionDataDefaults->EntryMode.'</EntryMode>'.
							'<RequestACI>'.$merchProfileData->TransactionData->BankcardTransactionDataDefaults->RequestACI.'</RequestACI>'.
							'<RequestAdvice>'.$merchProfileData->TransactionData->BankcardTransactionDataDefaults->RequestAdvice.'</RequestAdvice>'.
						'</BankcardTransactionDataDefaults>'.
					'</TransactionData>'.
				'</MerchantProfile>';
				
	return $merchantProfileXML;
}
}
?>