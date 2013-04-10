<?php

class Settings
{
	const Timezone = 'America/Denver'; // To get a list of supported timezones see http://php.net/manual/en/timezones.php
	const MsgFormat = 'JSON'; // 'SOAP', 'HTTP', 'JSON', 'XML' - Selects the message type SOAP, HTTP, REST_JSON, or REST_XML - REST_XML has not been implemented yet.
	/*
	 * Identity Token : Identity tokens are signed authentication tokens provided to merchants or other transaction originators to prevent the unauthorized use
	 * of an application. Identity tokens are set to expire after 3 years, and therefore will require renewal. Identity tokens should be managed and protected in a
	 * manner consistent with current key management best practices which may include access control, encryption, or use of specialized security devices. Identity
	 * token owners are responsible for establishing practices for managing sensitive data like any other secure credential or business certificate.
	 *
	 */
	const IdentityToken = '';
	// encryption key value
	const key = '1234567890123456ABCDEFGHIJKLMNOP'; // Used for Salt for encryption and decryption
	// Application Data Values 
	const ApplicationName = 'My Test App';
	const SoftwareVersion = 'v1.0';
	const SoftwareVersionDate = '2012-07-24';
	const DeviceSerialNumber = '1264682310';
	const ApplicationAttended = false;		// Valid Values 'true', 'false' 
	const ApplicationLocation = 'OffPremises';		// Valid Values 'Unknown', 'OnPremises', 'OffPremises', 'HomeInternet' 
	const PINCapability = 'PINNotSupported';		// Valid Values 'PINNotSupported', 'PINPadInoperative', 'PINSupported', 'PINVerifiedByDevice', 'Unknown' 
	const ReadCapability = 'KeyOnly';		// Common Value Used 'HasMSR', 'KeyOnly' 
	const PTLSSocketId = 'MIIEwjCCA6qgAwIBAgIBEjANBgkqhkiG9w0BAQUFADCBsTE0MDIGA1UEAxMrSVAgUGF5bWVudHMgRnJhbWV3b3JrIENlcnRpZmljYXRlIEF1dGhvcml0eTELMAkGA1UEBhMCVVMxETAPBgNVBAgTCENvbG9yYWRvMQ8wDQYDVQQHEwZEZW52ZXIxGjAYBgNVBAoTEUlQIENvbW1lcmNlLCBJbmMuMSwwKgYJKoZIhvcNAQkBFh1hZG1pbkBpcHBheW1lbnRzZnJhbWV3b3JrLmNvbTAeFw0wNjEyMTUxNzQyNDVaFw0xNjEyMTIxNzQyNDVaMIHAMQswCQYDVQQGEwJVUzERMA8GA1UECBMIQ29sb3JhZG8xDzANBgNVBAcTBkRlbnZlcjEeMBwGA1UEChMVSVAgUGF5bWVudHMgRnJhbWV3b3JrMT0wOwYDVQQDEzRFcWJwR0crZi8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vL0E9MS4wLAYJKoZIhvcNAQkBFh9zdXBwb3J0QGlwcGF5bWVudHNmcmFtZXdvcmsuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQD7BTLqXah9t6g4W2pJUfFKxJj/R+c1Dt5MCMYGKeJCMvimAJOoFQx6Cg/OO12gSSipAy1eumAqClxxpR6QRqO3iv9HUoREq+xIvORxm5FMVLcOv/oV53JctN2fwU2xMLqnconD0+7LJYZ+JT4z3hY0mn+4SFQ3tB753nqc5ZRuqQIDAQABo4IBVjCCAVIwCQYDVR0TBAIwADAdBgNVHQ4EFgQUk7zYAajw24mLvtPv7KnMOzdsJuEwgeYGA1UdIwSB3jCB24AU3+ASnJQimuunAZqQDgNcnO2HuHShgbekgbQwgbExNDAyBgNVBAMTK0lQIFBheW1lbnRzIEZyYW1ld29yayBDZXJ0aWZpY2F0ZSBBdXRob3JpdHkxCzAJBgNVBAYTAlVTMREwDwYDVQQIEwhDb2xvcmFkbzEPMA0GA1UEBxMGRGVudmVyMRowGAYDVQQKExFJUCBDb21tZXJjZSwgSW5jLjEsMCoGCSqGSIb3DQEJARYdYWRtaW5AaXBwYXltZW50c2ZyYW1ld29yay5jb22CCQD/yDY5hYVsVzA9BglghkgBhvhCAQQEMBYuaHR0cHM6Ly93d3cuaXBwYXltZW50c2ZyYW1ld29yay5jb20vY2EtY3JsLnBlbTANBgkqhkiG9w0BAQUFAAOCAQEAFk/WbEleeGurR+FE4p2TiSYHMau+e2Tgi+L/oNgIDyvAatgosk0TdSndvtf9YKjCZEaDdvWmWyEMfirb5mtlNnbZz6hNpYoha4Y4ThrEcCsVhfHLLhGZZ1YaBD+ZzCQA7vtb0v5aQb25jX262yPVshO+62DPxnMiJevSGFUTjnNisVniX23NVouUwR3n12GO8wvzXF8IYb5yogaUcVzsTIxEFQXEo1PhQF7JavEnDksVnLoRf897HwBqcdSs0o2Fpc/GN1dgANkfIBfm8E9xpy7k1O4MuaDRqq5XR/4EomD8BWQepfJY0fg8zkCfkuPeGjKkDCitVd3bhjfLSgTvDg==';
	const EncryptionType = 'NotSet'; // Valid Values 'IPADV1Compatible', 'MagneSafeV4V5Compatible', 'NotSet'
	
	// MerchantProfile Values 
	const IndustryType = 'Ecommerce';		// Valid Values 'Ecommerce', 'MOTO', 'Retail', 'Restaurant' 
	const CustomerPresent = 'Ecommerce';		// Common Values Used [Ecommerce : Ecommerce] [MOTO : MOTO] [Retail/Restaurant : Present] 
	const RequestACI = 'IsCPSMeritCapable';		// In general default to 'IsCPSMeritCapable'. Other value is 'NotCPSMeritCapable' 
 	const EntryMode = 'Keyed'; //Valid Values [Ecommerce/MOTO : Keyed] [Retail/Restaurant : Keyed/TrackDataFromMSR] 
	
	// TransactionData Values 
	const TxnData_ProcessAsKeyed = true;		// 'true', 'false' Depending on industrytype toggle between a swipe example and a keyed transaction
	const TxnData_EntryMode = 'Keyed';		// [Ecommerce/MOTO : Keyed] [Retail/Restaurant : Keyed/TrackDataFromMSR] 
	const TxnData_OrderOfProcessingTracks = 'Track2|Track1|Keyed';		// The order consists of three values seperated by Pipe. Ex. Track2|Track1|Keyed 
	const TxnData_ProcessMagensaTxn = false; // Magensa is an End to End encryptions solution offered through MagTek	
	const TxnData_IndustryType = 'Ecommerce';		// Valid Values 'Ecommerce', 'MOTO', 'Retail', 'Restaurant' 
	const TxnData_CustomerPresent = 'Ecommerce';		// [Ecommerce : Ecommerce] [MOTO : MOTO] [Retail/Restaurant : Present] 
	const TxnData_UserId = 'UTest';				// Some services require a UserId and Password
	const TxnData_Password = 'UPassword';		// Some services require a UserId and Password
	// ** ALL THE FOLOWING WERE IN SINGLE QUOTES IN HTTP
	const TxnData_SignatureCaptured = false;		// 'true', 'false' - For retail/restaurant should be configurable in their software and should be marked whether or not software actually gets the signature for each transaction 
	const TxnData_IncludeAVS = true;		// 'true', 'false' 
	const TxnData_IncludeCV = true;			// 'true', 'false' 
	const TxnData_IncludeVPAS = false;		// 'true', 'false' 
	const TxnData_IncludeUCAF = false;		// 'true', 'false' 
	const TxnData_IncludeCFees = false;		// 'true', 'false'
	const TxnData_SoftDescriptors = true;		// 'true', 'false'
	// Support Tokenization
	const TxnData_SupportTokenization = true; // 'true', 'false'
	const TxnData_ProcessEncrypted = true;

	// Process as a BankcardTransaction object or as a BankcardTransactionPro object
	const ProcessAsBankcardTransaction_Pro = true;		// 'true', 'false' If set to true the following Pro parameters are required
	// THE FOLLOWING WAS 'true' NOT LEVEL1 IN HTTP
	const Pro_PurchaseCardLevel = Level1;		// 'Level1', 'Level2', 'Level3' 
	const Pro_InterchangeData = false;		// 'true', 'false'
	const Pro_IncludeLevel2OrLevel3Data = true;		// 'true', 'false'
	const Pro_IncludeAlternativeMerchantData = 'true';		// 'true', 'false'
	
	/// ACH Transaction Data Values
	const TxnData_SECCode = 'WEB'; //  WEB,PPD,CCD,BOC,TEL The three letter code that indicates what NACHA regulations the transaction must adhere to. Required.
	const TxnData_ServiceType = 'ACH';   //Indicates the Electronic Checking service type: ACH, RDC or ECK. Required.
	
	// Endpoint Management
	const BaseSvcEndpointPrimary = 'https://cws-01.cert.ipcommerce.com/2.0.18/SvcInfo';
	const BaseSvcEndpointSecondary = 'https://cws-01.cert.ipcommerce.com/2.0.18/SvcInfo';
	const BaseTxnEndpointPrimary = 'https://cws-01.cert.ipcommerce.com/2.0.18/Txn';
	const BaseTxnEndpointSecondary = 'https://cws-01.cert.ipcommerce.com/2.0.18/Txn';
	const BaseDataServicesEndpointPrimary = 'https://cws-01.cert.ipcommerce.com/2.0.18/DataServices/TMS';
	const BaseDataServicesEndpointSecondary = 'https://cws-01.cert.ipcommerce.com/2.0.18/DataServices/TMS';
	const URL_BaseURL = 'https://cws-01.cert.ipcommerce.com/2.0.18/';
	const URL_RestURL = 'https://cws-01.cert.ipcommerce.com/REST/2.0.18/';
}
?>