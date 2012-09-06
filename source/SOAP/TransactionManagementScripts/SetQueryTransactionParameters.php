<?php

function setQueryTransctionParameters()
{
	$txnDateRange = new DateRange();
	$txnDateRange->EndDateTime = '2011-06-20T23:59:59.9999999Z';
	$txnDateRange->StartDateTime = '2011-06-20T00:00:00.0000000Z';
	
	$queryTxnParameters = new QueryTransactionsParameters();
	$queryTxnParameters->Amounts = null; // ArrayOfdecimal
	$queryTxnParameters->ApprovalCodes = null; // ArrayOfstring
	$queryTxnParameters->BatchIds = null; // ArrayOfstring
	$queryTxnParameters->CaptureDateRange = null; // DateRange
	$queryTxnParameters->CaptureStates = null; // ArrayOfCaptureState
	$queryTxnParameters->CardTypes = null; // ArrayOfTypeCardType
	$queryTxnParameters->IsAcknowledged = 'NotSet'; // BooleanParameter  true/false
	$queryTxnParameters->MerchantProfileIds = ''; // ArrayOfstring
	$queryTxnParameters->QueryType = 'AND'; // QueryType  AND/OR
	$queryTxnParameters->ServiceIds = null; // ArrayOfstring
	$queryTxnParameters->ServiceKeys = null; // ArrayOfstring
	$queryTxnParameters->TransactionClassTypePairs = null; // ArrayOfTransactionClassTypePair
	$queryTxnParameters->TransactionDateRange = $txnDateRange; // DateRange
	$queryTxnParameters->TransactionIds = null; // ArrayOfstring
	$queryTxnParameters->TransactionStates = null; // ArrayOfTransactionState

	return $queryTxnParameters;

}
?>