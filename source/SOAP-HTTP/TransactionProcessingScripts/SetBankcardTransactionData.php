<?php

// Credit Card Info
/* SEE CREDIT CARD CLASS IN CWSClient.php FOR MORE INFO */
function setBCPTenderData($paymentAccountDataToken = ''){
	if (Settings::IndustryType == 'Retail')
	{
		$tenderData = new creditCard();
		$tenderData->type = 'Visa';
		//$tenderData->name = 'John Doe';
		//$tenderData->number = '4111111111111111';
		//$tenderData->expiration = '1012'; // MMYY
		//$tenderData->cvv = '111'; // Security code
		//$tenderData->address = '1000 1st Av';
		//$tenderData->zip = '10101';
		if ($_serviceInformation['BankcardServices']['BankcardService']['Tenders']['TrackDataSupport'] == 'Track1')
		$tenderData->track1 = 'B4111111111111111^IPCOMMERCE/TESTCARD^10121010454500415000010';
		else
		$tenderData->track2 = '4111111111111111=10121010454541500010';
	}
	if (Settings::IndustryType == 'Restaurant')
	{
		$tenderData = new creditCard();
		$tenderData->type = 'Visa';
		//$tenderData->name = 'John Doe';
		//$tenderData->number = '4111111111111111';
		//$tenderData->expiration = '1012'; // MMYY
		//$tenderData->cvv = '111'; // Security code
		//$tenderData->address = '1000 1st Av';
		//$tenderData->zip = '10101';
		if ($_serviceInformation['BankcardServices']['BankcardService']['Tenders']['TrackDataSupport'] == 'Track1')
		$tenderData->track1 = 'B4111111111111111^IPCOMMERCE/TESTCARD^10121010454500415000010';
		else
		$tenderData->track2 = '4111111111111111=10121010454541500010';
	}
	if (Settings::IndustryType == 'MOTO')
	{
		$tenderData = new creditCard();
		$tenderData->type = 'MasterCard';
		$tenderData->name = 'John Doe';
		$tenderData->number = '5454545454545454';
		$tenderData->expiration = '1012'; // MMYY
		/*$tenderData->cvv = '111'; // Security code
		 $tenderData->address = '1000 1st Av';
		 $tenderData->zip = '10101';*/
	}
	if (Settings::IndustryType == 'Ecommerce')
	{
		$tenderData = new creditCard();
		$tenderData->type = 'Visa';
		$tenderData->name = 'John Doe';
		$tenderData->number = '4111111111111111';
		$tenderData->expiration = '1012'; // MMYY
		$tenderData->cvv = '111'; // Security code
		$tenderData->address = '3000 3rd Av';
		$tenderData->city = 'Denver';
		$tenderData->state = 'CO';
		$tenderData->zip = '10101';
	}
	if (Settings::TxnData_SupportTokenization && $paymentAccountDataToken != '')
	{
		$tenderData = new creditCard();
		$tenderData->paymentAccountDataToken = $paymentAccountDataToken;$tenderData->name = 'John Doe';
		$tenderData->name = 'John Doe';
		$tenderData->address = '3000 3rd Av';
		$tenderData->city = 'Denver';
		$tenderData->state = 'CO';
		$tenderData->zip = '10101';
	}
	return $tenderData;

}
function  setBCPTxnData($_serviceInformation) {


	// Transaction information
	/* SEE TRANSACTION INFORMATION CLASS IN CWSClient.php FOR MORE INFO */
	$transactionData = new transData ();
	$transactionData->OrderNumber = '546846'; // Order Number needs to be unique
	$transactionData->InvoiceNumber = $transactionData->OrderNumber;
	$transactionData->CustomerPresent = Settings::CustomerPresent; // Present, Ecommerce, MOTO, NotPresent
	//$transactionData->EmployeeId = '12'; //Used for Retail, Restaurant, MOTO
	$transactionData->EntryMode = Settings::TxnData_EntryMode; // Keyed, TrackDataFromMSR
	$transactionData->GoodsType = 'DigitalGoods'; // DigitalGoods - PhysicalGoods - Used only for Ecommerce
	$transactionData->IndustryType = Settings::TxnData_IndustryType; // Retail, Restaurant, Ecommerce, MOTO
	//$transactionData->AccountType = ''; // SavingsAccount, CheckingAccount used only for PINDebit
	$transactionData->Amount = '10.00'; // in a decimal format xx.xx
	$transactionData->CashBackAmount = ''; // in a decimal format. used for PINDebit transactions
	$transactionData->CurrencyCode = 'USD'; // TypeISOA3 Currency Codes USD CAD
	$transactionData->SignatureCaptured = Settings::TxnData_SignatureCaptured; // boolean true or false
	$transactionData->LaneId = "1";
	//$transactionData->TipAmount = ''; // in a decimal format

	if (Settings::Pro_IncludeLevel2OrLevel3Data)
	{
		// Transaction information
		/* SEE TRANSACTION INFORMATION CLASS IN CWSClient.php FOR MORE INFO */
		$transactionData = new transDataPro();
		$transactionData->OrderNumber = '546846'; // Order Number needs to be unique
		$transactionData->InvoiceNumber = $transactionData->OrderNumber;
		$transactionData->CustomerPresent = Settings::CustomerPresent; // Present, Ecommerce, MOTO, NotPresent
		//$transactionData->EmployeeId = '12'; //Used for Retail, Restaurant, MOTO
		$transactionData->EntryMode = Settings::TxnData_EntryMode; // Keyed, TrackDataFromMSR
		$transactionData->GoodsType = 'DigitalGoods'; // DigitalGoods - PhysicalGoods - Used only for Ecommerce
		$transactionData->IndustryType = Settings::TxnData_IndustryType; // Retail, Restaurant, Ecommerce, MOTO
		//$transactionData->AccountType = ''; // SavingsAccount, CheckingAccount used only for PINDebit
		$transactionData->Amount = '10.00'; // in a decimal format xx.xx
		$transactionData->CashBackAmount = ''; // in a decimal format. used for PINDebit transactions
		$transactionData->CurrencyCode = 'USD'; // TypeISOA3 Currency Codes USD CAD
		$transactionData->SignatureCaptured = Settings::TxnData_SignatureCaptured; // boolean true or false
		//$transactionData->TipAmount = ''; // in a decimal format
		$transactionData->ReportingData = new TransactionReportingData();
		$transactionData->ReportingData->Description = 'description';
		$transactionData->LaneId = "1";
		$level2Data = new Level2Data();
		$level2Data->BaseAmount = '9.00';
		$level2Data->OrderDate = DateTime::ISO8601;
		$level2Data->OrderNumber = '123545';
		$level2Data->TaxExempt = new TaxExempt();
		$level2Data->TaxExempt = 'IsTaxExempt';
		$level2Data->Tax = new Tax();
		$level2Data->Tax->Amount = '1.00';
		$transactionData->Level2Data = $level2Data;
	}

	if (Settings::Pro_IncludeAlternativeMerchantData){
		/*
		 * Note: not all processors support the new Alternative Merchant Data object
		 * 		 See else statement below for alternate format of Soft Descriptors
		 */   
		if ($_serviceInformation['BankcardServices']['BankcardService']['AlternativeMerchantData']){
			$altMerchData = new AlternativeMerchantData();
			$altMerchData->Name = 'AltMerchName';
			$altMerchData->MerchantId = '122234';
			$altMerchData->Description = 'Blue Bottle';
			$altMerchData->CustomerServiceInternet = 'test@altmerch.com';
			$altMerchData->CustomerServicePhone = '303 5551212';
			$address = new AddressInfo();
			$address->Street1 = '123 Test Street';
			$address->StateProvince = 'CO';
			$address->PostalCode = '80202';
			$address->City = 'Denver';
			$address->CountryCode = 'USA';
			$altMerchData->Address = $address;
			$transactionData->AltMerchantData = $altMerchData;
		}
		/*
		 * Note: older processors support this way of Soft Descriptors/Alternative Merchant Data
		 * 		 the combination of your top level MerchantProfile->MerchantName with MerchantProfile->CustomerServiceInternet
		 * 		 combined with the ReportingData->Description will make the soft descriptor format
		 */
		else {
			$reportingData = new TransactionReportingData();
			$reportingData->Description = 'AltMerchName';
			$transactionData->ReportingData = $reportingData;
		}
	}

	$dateTime = new DateTime("now", new DateTimeZone('America/Denver'));
	$transactionData->DateTime = $dateTime->format(DATE_RFC3339);

	if ($_serviceInformation['BankcardServices']['BankcardService']['Tenders']['CredentialsRequired'])
	{
		$credentials = '<UserId>100000007506657</UserId><Password>A1B2C3D4F6</Password>';
		$transactionData->Creds = $credentials;
	}

	if (Settings::Pro_InterchangeData)
	{
		$interchangeData = new interchangeData();
        $interchangeData->BillPayment = "Recurring";// Any time BillPayInd is set to either "DeferredBilling", "Installment", "SinglePayment" or "Recurring", CustomerPresent should be set to "BillPayment"
        //$interchangeData->RequestCommercialCard = "";
        $interchangeData->ExistingDebt = "NotExistingDebt";
        //$interchangeData->RequestACI = "";
        //$interchangeData->TotalNumberOfInstallments = "1"; //Used for Installment
        $interchangeData->CurrentInstallmentNumber = "1"; // Send 1 for the first payment and any number greater than 1 for the remaining payments.
        //$interchangeData->RequestAdvice = "1"; 
                        
        //Any time BillPayInd is set to either "DeferredBilling", "Installment" or "Recurring", CustomerPresent should be set to "BillPayment"
        if($interchangeData->BillPayment == "Installment" or $interchangeData->BillPayment == "DeferredBilling" or $interchangeData->BillPayment == "Recurring")
            $transactionData->CustomerPresent = 'BillPayment';
        
		$transactionData->InterchangeData = $interchangeData;
	}

		return $transactionData;
	}



/*
 *
 * Build a bankcardtransaction on the provided data.
 *
 */

function buildTransactionXML($credit_info, $trans_info) {
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
		$trans = $trans.'<Addendum>'.
							'<Any>'.
								'<string>'.$trans_info->Creds.'</string>'.
							'</Any>'.
						'</Addendum>';	
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
					'<SignatureCaptured>'.$trans_info->SignatureCaptured.'</SignatureCaptured>';
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
function buildCaptureXML($captureDiffData, $creds = ''){
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
function buildCaptureSelectiveXML($captureDiffData, $creds = ''){
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
				if ($captureDiffData->ChargeType != NULL)
				$capture=$capture.'<b:ChargeType>'.$captureDiffData->ChargeType.'</b:ChargeType>';
				if ($captureDiffData->ChargeType != NULL)
				$capture=$capture.'<b:ShipDate>'.$captureDiffData->ShipDate.'</b:ShipDate>';
				if ($captureDiffData->ChargeType != NULL)
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
function buildTxnIdsXML($transactionIds){

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
function buildReturnByIdXML($returnDiffData, $creds = ''){

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
function buildUndoXML($undoDiffData, $creds = ''){

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

?>