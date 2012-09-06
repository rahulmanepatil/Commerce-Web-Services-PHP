<?php

class Settings
{
	/*
	 * Identity Token : Identity tokens are signed authentication tokens provided to merchants or other transaction originators to prevent the unauthorized use
	 * of an application. Identity tokens are set to expire after 3 years, and therefore will require renewal. Identity tokens should be managed and protected in a
	 * manner consistent with current key management best practices which may include access control, encryption, or use of specialized security devices. Identity
	 * token owners are responsible for establishing practices for managing sensitive data like any other secure credential or business certificate.
	 *
	 */ 


	const IdentityToken = '';
	// encryption key value
	const key = '1234567890123456ABCDEFGHIJKLMNOP';
	// Application Data Values 
	const ApplicationAttended = 'false';		// Valid Values 'true', 'false' 
	const ApplicationLocation = 'HomeInternet';		// Valid Values 'Unknown', 'OnPremises', 'OffPremises', 'HomeInternet' 
	const PINCapability = 'PINNotSupported';		// Valid Values 'PINNotSupported', 'PINPadInoperative', 'PINSupported', 'PINVerifiedByDevice', 'Unknown' 
	const ReadCapability = 'KeyOnly';		// Common Value Used 'HasMSR', 'KeyOnly' 
	const PTLSSocketId = 'MIIEwjCCA6qgAwIBAgIBEjANBgkqhkiG9w0BAQUFADCBsTE0MDIGA1UEAxMrSVAgUGF5bWVudHMgRnJhbWV3b3JrIENlcnRpZmljYXRlIEF1dGhvcml0eTELMAkGA1UEBhMCVVMxETAPBgNVBAgTCENvbG9yYWRvMQ8wDQYDVQQHEwZEZW52ZXIxGjAYBgNVBAoTEUlQIENvbW1lcmNlLCBJbmMuMSwwKgYJKoZIhvcNAQkBFh1hZG1pbkBpcHBheW1lbnRzZnJhbWV3b3JrLmNvbTAeFw0wNjEyMTUxNzQyNDVaFw0xNjEyMTIxNzQyNDVaMIHAMQswCQYDVQQGEwJVUzERMA8GA1UECBMIQ29sb3JhZG8xDzANBgNVBAcTBkRlbnZlcjEeMBwGA1UEChMVSVAgUGF5bWVudHMgRnJhbWV3b3JrMT0wOwYDVQQDEzRFcWJwR0crZi8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vL0E9MS4wLAYJKoZIhvcNAQkBFh9zdXBwb3J0QGlwcGF5bWVudHNmcmFtZXdvcmsuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQD7BTLqXah9t6g4W2pJUfFKxJj/R+c1Dt5MCMYGKeJCMvimAJOoFQx6Cg/OO12gSSipAy1eumAqClxxpR6QRqO3iv9HUoREq+xIvORxm5FMVLcOv/oV53JctN2fwU2xMLqnconD0+7LJYZ+JT4z3hY0mn+4SFQ3tB753nqc5ZRuqQIDAQABo4IBVjCCAVIwCQYDVR0TBAIwADAdBgNVHQ4EFgQUk7zYAajw24mLvtPv7KnMOzdsJuEwgeYGA1UdIwSB3jCB24AU3+ASnJQimuunAZqQDgNcnO2HuHShgbekgbQwgbExNDAyBgNVBAMTK0lQIFBheW1lbnRzIEZyYW1ld29yayBDZXJ0aWZpY2F0ZSBBdXRob3JpdHkxCzAJBgNVBAYTAlVTMREwDwYDVQQIEwhDb2xvcmFkbzEPMA0GA1UEBxMGRGVudmVyMRowGAYDVQQKExFJUCBDb21tZXJjZSwgSW5jLjEsMCoGCSqGSIb3DQEJARYdYWRtaW5AaXBwYXltZW50c2ZyYW1ld29yay5jb22CCQD/yDY5hYVsVzA9BglghkgBhvhCAQQEMBYuaHR0cHM6Ly93d3cuaXBwYXltZW50c2ZyYW1ld29yay5jb20vY2EtY3JsLnBlbTANBgkqhkiG9w0BAQUFAAOCAQEAFk/WbEleeGurR+FE4p2TiSYHMau+e2Tgi+L/oNgIDyvAatgosk0TdSndvtf9YKjCZEaDdvWmWyEMfirb5mtlNnbZz6hNpYoha4Y4ThrEcCsVhfHLLhGZZ1YaBD+ZzCQA7vtb0v5aQb25jX262yPVshO+62DPxnMiJevSGFUTjnNisVniX23NVouUwR3n12GO8wvzXF8IYb5yogaUcVzsTIxEFQXEo1PhQF7JavEnDksVnLoRf897HwBqcdSs0o2Fpc/GN1dgANkfIBfm8E9xpy7k1O4MuaDRqq5XR/4EomD8BWQepfJY0fg8zkCfkuPeGjKkDCitVd3bhjfLSgTvDg==';
	
	// MerchantProfile Values 
	const IndustryType = 'Ecommerce';		// Valid Values 'Ecommerce', 'MOTO', 'Retail', 'Restaurant' 
	const CustomerPresent = 'Ecommerce';		// Common Values Used [Ecommerce : Ecommerce] [MOTO : MOTO] [Retail/Restaurant : Present] 
	const RequestACI = 'IsCPSMeritCapable';		// In general default to 'IsCPSMeritCapable'. Other value is 'NotCPSMeritCapable' 

	// TransactionData Values 
	const TxnData_ProcessAsKeyed = 'false';		// 'true', 'false' Depending on industrytype toggle between a swipe example and a keyed transaction
	const TxnData_EntryMode = 'Keyed';		// [Ecommerce/MOTO : Keyed] [Retail/Restaurant : Keyed/TrackDataFromMSR] 
	const TxnData_OrderOfProcessingTracks = 'Track2|Track1|Keyed';		// The order consists of three values seperated by Pipe. Ex. Track2|Track1|Keyed 
	const TxnData_IndustryType = 'Ecommerce';		// Valid Values 'Ecommerce', 'MOTO', 'Retail', 'Restaurant' 
	const TxnData_CustomerPresent = 'Ecommerce';		// [Ecommerce : Ecommerce] [MOTO : MOTO] [Retail/Restaurant : Present] 
	const TxnData_SignatureCaptured = 'false';		// 'true', 'false' - For retail/restaurant should be configurable in their software and should be marked whether or not software actually gets the signature for each transaction 
	const TxnData_IncludeAVS = 'true';		// 'true', 'false' 
	const TxnData_IncludeCV = 'true';		// 'true', 'false' 
	const TxnData_IncludeVPAS = 'false';		// 'true', 'false' 
	const TxnData_IncludeUCAF = 'false';		// 'true', 'false' 
	const TxnData_IncludeCFees = 'false';		// 'true', 'false'
	// Support Tokenization
	const TxnData_SupportTokenization = 'true'; // 'true', 'false'

	// Process as a BankcardTransaction object or as a BankcardTransactionPro object
	const ProcessAsBankcardTransaction_Pro = 'true';		// 'true', 'false' If set to true the following Pro parameters are required
	const Pro_PurchaseCardLevel = 'true';		// 'Level1', 'Level2', 'Level3' 
	const Pro_InterchangeData = 'false';		// 'true', 'false'
	const Pro_IncludeLevel2OrLevel3Data = 'true';		// 'true', 'false'
	const Pro_IncludeAlternativeMerchantData = 'true';		// 'true', 'false'
	
	/// ACH Transaction Data Values
	const TxnData_SECCode = 'WEB'; //  WEB,PPD,CCD,BOC,TEL The three letter code that indicates what NACHA regulations the transaction must adhere to. Required.
	const TxnData_ServiceType = 'ACH';   //Indicates the Electronic Checking service type: ACH, RDC or ECK. Required.
	
	// URL Endpoints
	const URL_BaseURL = 'https://cws-01.cert.ipcommerce.com/2.0.18/';	
	//const URL_BaseURL = 'https://cws-01.stage.ipcommerce.com/2.0.18/';
	

	}
?>