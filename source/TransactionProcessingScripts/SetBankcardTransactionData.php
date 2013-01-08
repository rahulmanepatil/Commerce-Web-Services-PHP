<?php
require_once ABSPATH.'/ConfigFiles/app.config.php';
// Credit Card Info
/* SEE CREDIT CARD CLASS IN CWSClient.php FOR MORE INFO */

function  setBCPTxnData($_serviceInformation) {
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
		$tenderData->track1 = 'B4111111111111111^IPCOMMERCE/TESTCARD^10121010454500415000010';
		//$tenderData->track2 = '4111111111111111=10121010454541500010';
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
		$tenderData->track1 = 'B4111111111111111^IPCOMMERCE/TESTCARD^10121010454500415000010';
		//$tenderData->track2 = '4111111111111111=10121010454541500010';
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


	// Transaction information
	/* SEE TRANSACTION INFORMATION CLASS IN CWSClient.php FOR MORE INFO */
	$transactionData = new transData ();
	$transactionData->OrderNumber = '546846'; // Order Number needs to be unique
	$transactionData->CustomerPresent = Settings::CustomerPresent; // Present, Ecommerce, MOTO, NotPresent
	$transactionData->EmployeeId = '12'; //Used for Retail, Restaurant, MOTO
	$transactionData->EntryMode = Settings::TxnData_EntryMode; // Keyed, TrackDataFromMSR
	$transactionData->GoodsType = 'DigitalGoods'; // DigitalGoods - PhysicalGoods - Used only for Ecommerce	
	//$transactionData->AccountType = ''; // SavingsAccount, CheckingAccount used only for PINDebit
	$transactionData->Amount = '10.00'; // in a decimal format xx.xx
	//$transactionData->CashBackAmount = '0.00'; // in a decimal format. used for PINDebit transactions
	$transactionData->CurrencyCode = 'USD'; // TypeISOA3 Currency Codes USD CAD
	$transactionData->SignatureCaptured = false; // boolean true or false
	$transactionData->LaneId = "1";
	if(isset($transactionData->IsPartialShipment))$transactionData->IsPartialShipment = false; // boolean true or false
	if(isset($transactionData->IsQuasiCash))$transactionData->IsQuasiCash = false; // boolean true or false
	//$transactionData->TipAmount = '0.00'; // in a decimal format

	if (Settings::Pro_IncludeLevel2OrLevel3Data)
	{
		// Transaction information
		/* SEE TRANSACTION INFORMATION CLASS IN CWSClient.php FOR MORE INFO */
		$transactionData = new transDataPro();
		$transactionData->OrderNumber = '546846'; // Order Number needs to be unique
		$transactionData->SignatureCaptured = 'false';
		$transactionData->CustomerPresent = Settings::CustomerPresent; // Present, Ecommerce, MOTO, NotPresent
		$transactionData->EmployeeId = '12'; //Used for Retail, Restaurant, MOTO
		$transactionData->EntryMode = Settings::TxnData_EntryMode; // Keyed, TrackDataFromMSR
		$transactionData->GoodsType = 'DigitalGoods'; // DigitalGoods - PhysicalGoods - Used only for Ecommerce
		//$transactionData->IndustryType = Settings::IndustryType; 
		$transactionData->AccountType = 'NotSet'; // SavingsAccount, CheckingAccount used only for PINDebit
		$transactionData->Amount = '10.00'; // in a decimal format xx.xx
		$transactionData->CashBackAmount = '0.00'; // in a decimal format. used for PINDebit transactions
		$transactionData->CurrencyCode = 'USD'; // TypeISOA3 Currency Codes USD CAD
		$transactionData->SignatureCaptured = false; // boolean true or false		
		$transactionData->PartialApprovalCapable = 'NotSet'; // Capable | NotCapable | NotSet
		$transactionData->IsPartialShipment = false; // boolean true or false
		$transactionData->IsQuasiCash = false; // boolean true or false
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

	if (Settings::TxnData_SoftDescriptors){
		/*
		 * Note: not all processors support the new Alternative Merchant Data object
		 * 		 See else statement below for alternate format of Soft Descriptors
		 */
		if ($_serviceInformation->BankcardServices->BankcardService->AlternativeMerchantData){
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

	if ($_serviceInformation->BankcardServices->BankcardService->Tenders->CredentialsRequired)
	{
		$credentials = '<c:string>&lt;UserId&gt;'.Settings::TxnData_UserId.'&lt;/UserId&gt;</c:string>'.
					   '<c:string>&lt;Password&gt;'.Settings::TxnData_Password.'&lt;/Password&gt;</c:string>';
		$transactionData->Creds = $credentials;
	}

	$transaction = new newTransaction();
	$transaction->TndrData = $tenderData;
	$transaction->TxnData = $transactionData;
	
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
        if($interchangeData->BillPayment = "Installment" or $interchangeData->BillPayment = "DeferredBilling" or $interchangeData->BillPayment = "Recurring")
            $transactionData->CustomerPresent = 'BillPayment';
        
			$transactionData->InterchangeData = $interchangeData;
		}

		$transaction->TxnData = $transactionData;
		return $transaction;

}
?>