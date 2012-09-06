<?php

// Credit Card Info
/* SEE CREDIT CARD CLASS IN CWSClient.php FOR MORE INFO */

function  setACHTxnData() {



	// below demonstrates how to use a PaymentAccountDataToken instead of Card Data
	$tokenizedTenderData = new achCheck();
	$tokenizedTenderData->paymentAccountDataToken = '5bd1daa0-5f38-40ba-a102-7467dcfc624598dabf6c-c849-4822-84cc-f2ad899a054e';
	$tokenizedTenderData->CheckNumber = '1101';
	$tokenizedTenderData->OwnerType = 'Personal';
	$tokenizedTenderData->UseType = 'Checking';
	$tokenizedTenderData->FirstName = 'Johnny';
	$tokenizedTenderData->LastName = 'Check';

	$tenderData = new achCheck();
	$tenderData->AccountNumber = '11302920';
	$tenderData->RoutingNumber = '302075128';
	$tenderData->CheckNumber = '1101';
	$tenderData->CheckCountryCode = 'US'; //  Bank account country of origin for receiver deposit. Required.
	$tenderData->OwnerType = 'Personal';
	$tenderData->UseType = 'Checking';
	$tenderData->FirstName = 'Johnny';
	$tenderData->LastName = 'Check';

	// Transaction information
	/* SEE TRANSACTION INFORMATION CLASS IN CWSClient.php FOR MORE INFO */
	$transactionData = new achTransactionData();
	$transactionData->Amount = '100.00'; // Amount in decimal format
	$transactionData->EffectiveDate = '2011-10-18'; // Date string. Specifies the effective date of the transaction. Required.
	$transactionData->IsRecurring = false; // Indicates whether the transaction is recurring. Conditional, required if SECCode = 'WEB'.
	$transactionData->SECCode = Settings::TxnData_SECCode; // WEB,PPD,CCD,BOC,TEL The three letter code that indicates what NACHA regulations the transaction must adhere to. Required.
	$transactionData->ServiceType = Settings::TxnData_ServiceType; //  Indicates the Electronic Checking service type: ACH, RDC or ECK. Required.
	$dateTime = new DateTime("now", new DateTimeZone('America/Denver'));
	$transactionData->TransactionDateTime = $dateTime->format(DATE_RFC3339);
	$transactionData->TransactionType = 'Debit'; // Indicates Transaction Type Credit/Debit

	if ($_electronicCheckingServices->ElectronicCheckingService->Tenders->CredentialsRequired)
	{
		$credentials = '<UserId>100000007506657</UserId><Password>A1B2C3D4F6</Password>';
		$transactionData->Creds = $credentials;
	}
	$credentials = '<UserId>100000007506657</UserId><Password>A1B2C3D4F6</Password>';
	$transactionData->Creds = $credentials;

	$transaction = new newTransaction();
	$transaction->TndrData = $tenderData;
	$transaction->TxnData = $transactionData;

	return $transaction;
}
/*
 *
 * Build a ach transaction on the provided data.
 *
 */

function buildACHTransaction($ach_info, $trans_info) {
	$ach_trans = new ElectronicCheckingTransaction();
	$ach_trans->TenderData = new ElectronicCheckingTenderData();

	$ach_trans->TenderData->CheckData = new CheckData();
	$ach_trans->TenderData->CheckData->AccountNumber = $ach_info->AccountNumber;
	$ach_trans->TenderData->CheckData->CheckCountryCode = $ach_info->CheckCountryCode;
	$ach_trans->TenderData->CheckData->CheckNumber = $ach_info->CheckNumber;
	$ach_trans->TenderData->CheckData->OwnerType = $ach_info->OwnerType;
	$ach_trans->TenderData->CheckData->RoutingNumber = $ach_info->RoutingNumber;
	$ach_trans->TenderData->CheckData->UseType = $ach_info->UseType;

	$ach_trans->TransactionData = new ElectronicCheckingTransactionData();
	$ach_trans->TransactionData->Amount = $trans_info->Amount;
	$ach_trans->TransactionData->EffectiveDate = $trans_info->EffectiveDate;
	$ach_trans->TransactionData->IsRecurring = $trans_info->IsRecurring;
	$ach_trans->TransactionData->SECCode = $trans_info->SECCode;
	$ach_trans->TransactionData->ServiceType = $trans_info->ServiceType;
	$ach_trans->TransactionData->TransactionDateTime = $trans_info->TransactionDateTime;
	$ach_trans->TransactionData->TransactionType = $trans_info->TransactionType;

	$ach_trans->CustomerData = new TransactionCustomerData();
	$ach_trans->CustomerData->BillingData = new CustomerInfo();
	if ($ach_info->BusinessName != '')
	$ach_trans->CustomerData->BillingData->BusinessName = $ach_info->BusinessName;
	if ($ach_info->FirstName != '')
	{
		$ach_trans->CustomerData->BillingData->Name = new NameInfo();
		$ach_trans->CustomerData->BillingData->Name->First = $ach_info->FirstName;
		$ach_trans->CustomerData->BillingData->Name->Middle = $ach_info->MiddleName;
		$ach_trans->CustomerData->BillingData->Name->Last = $ach_info->LastName;
	}

	if ($trans_info->Creds != null)
	{
		$ach_trans->Addendum = new Addendum();
		$ach_trans->Addendum->Unmanaged = new Unmanaged();
		$ach_trans->Addendum->Unmanaged->Any = new Any();
		$ach_trans->Addendum->Unmanaged->Any->string = $trans_info->Creds;
	}

	return $ach_trans;
}
?>