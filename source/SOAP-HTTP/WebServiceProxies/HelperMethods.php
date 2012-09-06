<?php

/************************************************************
 **                   HELPER FUNCTIONS
 ************************************************************/

function encrypt($string, $key) {
	$result = '';
	for($i = 0; $i < strlen ( $string ); $i ++) {
		$char = substr ( $string, $i, 1 );
		$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
		$char = chr ( ord ( $char ) + ord ( $keychar ) );
		$result .= $char;
	}

	return base64_encode ( $result );
}

function decrypt($string, $key) {
	$result = '';
	$string = base64_decode ( $string );

	for($i = 0; $i < strlen ( $string ); $i ++) {
		$char = substr ( $string, $i, 1 );
		$keychar = substr ( $key, ($i % strlen ( $key )) - 1, 1 );
		$char = chr ( ord ( $char ) - ord ( $keychar ) );
		$result .= $char;
	}

	return $result;
}
function translateSvcName($svcId) {
	$tsvcName ='';
	switch ($svcId) {

		//Sandbox
		case "214DF00001" :
			$tsvcName =  "Chase Paymentech Orbital - Tampa";
			break;
		case "B51E100001" :
			$tsvcName =  "Chase Paymentech Orbital - Salem";
			break;
		case "7B62B00001" :
			$tsvcName =  "First Data - Nashville";
			break;
		case "786F400001" :
			$tsvcName =  "Chase Paymentech Orbital - Tampa Retail";
			break;
		case "A656D00001" :
			$tsvcName =  "First Data - Nashville US";
			break;
		case "4CACF00001" :
			$tsvcName =  "Chase Tampa Direct TCS";
			break;
		case "3E2DE00001" :
			$tsvcName =  "RBS Global Gateway";
			break;
		case "832E400001" :
			$tsvcName =  "RBS Worldpay";
			break;
		case "C82ED00001" :
			$tsvcName =  "TSYS Sierra";
			break;
		case "5A38100001" :
			$tsvcName =  "Tampa - Canada";
			break;
		case "71C8700001" :
			$tsvcName =  "TSYS Sierra Canada";
			break;
		case "8335000001" :
			$tsvcName =  "TSYS Summit";
			break;
		case "A4F2B00001" :
			$tsvcName =  "Salem Direct";
			break;
		case "E4FB800001" :
			$tsvcName =  "First Data - Nashville";
			break;
		case "16E5800001" :
			$tsvcName =  "Intuit QBMS";
			break;
		case "A8CFF00001" :
			$tsvcName =  "First Data BUYPASS";
			break;
		case "36EBE00001" :
			$tsvcName =  "Tampa TCS for Canada";
			break;
		case "6429C00001" :
			$tsvcName =  "Intuit QBMS Inline Tokenization";
			break;
		case "8046100001" :
			$tsvcName =  "Intuit QBMS No Tokenization";
			break;
		case "207CE00001" :
			$tsvcName =  "Adaptive Payments";
			break;
		case "88D9300001" :
			$tsvcName =  "Vantiv FTPS";
			break;
		case "8077500001" :
			$tsvcName =  "Intuit QBMS Inline Tokenization";
			break;
		case "B447F00001" :
			$tsvcName =  "Vantiv IBM FTPS";
			break;
		case "D806000001" :
			$tsvcName =  "Vantiv IBM FTPS";
			break;
		case "9B0C200001" :
			$tsvcName =  "Intuit QBMS No Tokenization";
			break;
		case "4365400001" :
			$tsvcName =  "Vantiv Tandem HC FTPS";
			break;
		case "2C36000001" :
			$tsvcName =  "RBS Worldpay";
			break;
		case "E88FD00001" :
			$tsvcName =  "TSYS Summit";
			break;
		case "35A7700001" :
			$tsvcName =  "Billing Tree - ACH";
			break;
		case "C58FD00001" :
			$tsvcName =  "Vantiv Stored Value";
			break;
		case "676EF00001" :
			$tsvcName =  "Adaptive CNP PINDebit Service";
			break;
				

			//Production
		case "C97EF1300C" :
			$tsvcName =  "Chase Paymentech Orbital - Tampa";
			break;
		case "8A4B91300C" :
			$tsvcName =  "Chase Paymentech Orbital - Salem";
			break;
		case "19F161300C" :
			$tsvcName =  "First Data - Nashville";
			break;
		case "3257B1300C" :
			$tsvcName =  "Chase Paymentech Orbital - Tampa Retail";
			break;
		case "859AC1300C" :
			$tsvcName =  "First Data - Nashville US";
			break;
		case "633511300C" :
			$tsvcName =  "Chase Tampa Direct TCS";
			break;
		case "355931300C" :
			$tsvcName =  "RBS Global Gateway";
			break;
		case "8CEA11300C" :
			$tsvcName =  "RBS Worldpay";
			break;
		case "168511300C" :
			$tsvcName =  "TSYS Sierra";
			break;
		case "852BB1300C" :
			$tsvcName =  "Tampa - Canada";
			break;
		case "507BF1300C" :
			$tsvcName =  "TSYS Sierra Canada";
			break;
		case "55C3C1300C" :
			$tsvcName =  "TSYS Summit";
			break;
		case "D1DDF1300C" :
			$tsvcName =  "Salem Direct";
			break;
		case "D917B1300C" :
			$tsvcName =  "First Data - Nashville";
			break;
		case "7AC431300C" :
			$tsvcName =  "Intuit QBMS";
			break;
		case "7B4DD1300C" :
			$tsvcName =  "First Data BUYPASS";
			break;
		case "9461F1300C" :
			$tsvcName =  "Tampa TCS for Canada";
			break;
		case "CE4AE1300C" :
			$tsvcName =  "Intuit QBMS Inline Tokenization";
			break;
		case "E7DFB1300C" :
			$tsvcName =  "Intuit QBMS No Tokenization";
			break;
		case "CAFF61300C" :
			$tsvcName =  "Adaptive Payments";
			break;
		case "9999999999" :
			$tsvcName =  "Vantiv FTPS";//NOTE : Placeholder
			break;
		case "DF29D1300C" :
			$tsvcName =  "Billing Tree - ACH";
			break;

	}
	return $tsvcName;
}
function transalateBool($bvalue) {
	switch ($bvalue) {
		case "0" :
			return "----";
			//break;
		case "1" :
			return "* Supported *";
			//break;
	}

}
/*
 * ---------------------------------------------------------------------------
 * Helper Functions to Print Responses
 * ---------------------------------------------------------------------------
 */
function printCaptureResults($response, $merchantProfileId)
{
	//NOTE : Please reference the developers guide for a more complete explination of the return fields
	//Note Highly recommended to save
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h2>Capture Results</h2></div>';
	echo '<b>Merchant ProfileId:</b><font color="#800080"> '.$merchantProfileId['ProfileId'].'</font><br />';
	echo '<b>Service Name:</b><font color="#800080"> '.translateSvcName($merchantProfileId['ServiceId']).'</font><br />';
	echo '<b>Status:</b><font color="#800080"> '. $response['Status'].'</font><br />';

	echo '<b>TransactionId :</b><font color="#800080"> ' . $response['TransactionId'] . '</font><br />';
	//Note Optional but recommended to save
	echo '<b>Status Code : </b><font color="#800080">' . $response['StatusCode'] . '</font><br />';
	echo '<b>Status Message : </b><font color="#800080">' . $response['StatusMessage'] . '</font><br />';
	//Note Optional data about the batch
	if ($response['BatchId'] != null)
	echo '<b>Batch Id : </b><font color="#800080">' . $response['BatchId'] . '</font><br />';
	if (isset($response['TransactionSummaryData']['CashBackTotals']['Count']))
	echo '<b>Cash Back Totals <br />  Count : </b><font color="#800080">' . $response['TransactionSummaryData']['CashBackTotals']['Count'] . '</font><br /><b>  Net Amount : </b><font color="#800080">' . $response['TransactionSummaryData']['CashBackTotals']['NetAmount'] . '</font><br />';
	if (isset($response['TransactionSummaryData']['NetTotals']['Count']))
	echo '<b>Net Totals <br />  Count : </b><font color="#800080">' . $response['TransactionSummaryData']['NetTotals']['Count'] . '</font><br /><b>  Net Amount : </b><font color="#800080">' . $response['TransactionSummaryData']['NetTotals']['NetAmount'] . '</font><br />';
	if (isset($response['TransactionSummaryData']['PINDebitReturnTotals']['Count']))
	echo '<b>PINDebit Return Totals <br />  Count : </b><font color="#800080">' . $response['TransactionSummaryData']['PINDebitReturnTotals']['Count'] . '</font><br /><b>  Net Amount : </b><font color="#800080">' . $response['TransactionSummaryData']['PINDebitReturnTotals']['NetAmount'] . '</font><br />';
	if (isset($response['TransactionSummaryData']['PINDebitSaleTotals']['Count']))
	echo '<b>PINDebit Sale Totals <br />  Count : </b><font color="#800080">' . $response['TransactionSummaryData']['PINDebitSaleTotals']['Count'] . '</font><br /><b>  Net Amount : </b><font color="#800080">' . $response['TransactionSummaryData']['PINDebitSaleTotals']['NetAmount'] . '</font><br />';
	if (isset($response['TransactionSummaryData']['ReturnTotals']['Count']))
	echo '<b>Return Totals <br />  Count : </b><font color="#800080">' . $response['TransactionSummaryData']['ReturnTotals']['Count'] . '</font><br /><b>  Net Amount : </b><font color="#800080">' . $response['TransactionSummaryData']['ReturnTotals']['NetAmount'] . '</font><br />';
	if (isset($response['TransactionSummaryData']['SaleTotals']['Count']))
	echo '<b>Sale Totals <br />  Count : </b><font color="#800080">' . $response['TransactionSummaryData']['SaleTotals']['Count'] . '</font><br /> <b> Net Amount : </b><font color="#800080">' . $response['TransactionSummaryData']['SaleTotals']['NetAmount'] . '</font><br />';
	if (isset($response['TransactionSummaryData']['VoidTotals']['Count']))
	echo '<b>Void Totals <br />  Count : </b><font color="#800080">' . $response['TransactionSummaryData']['VoidTotals']['Count'] . '</font><br /> <b> Net Amount : </b><font color="#800080">' . $response['TransactionSummaryData']['VoidTotals']['NetAmount'] . '</font><br />';

}
function printTransactionResults($response, $transactionType, $merchantProfileId)
{
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h2>'.$transactionType.'</h2></div>';
	echo '<b>Merchant ProfileId:</b><font color="#800080"> '.$merchantProfileId['ProfileId'].'</font><br />';
	echo '<b>Service Name:</b><font color="#800080"> '.translateSvcName($merchantProfileId['ServiceId']).'</font><br />';
	echo '<b>Status:</b><font color="#800080"> '.$response['Status'].'</font><br />';
	echo '<b>Status Code:</b> <font color="#800080">'.$response['StatusCode'].'</font><br />';
	echo '<b>Status Message:</b><font color="#800080"> '.$response['StatusMessage'].'</font><br />';
	echo '<b>Amount:</b><font color="#800080"> '.$response['Amount'].'</font><br />';
	echo '<b>AVSResult:</b><br />';
	if (isset($response['AVSResult']['ActualResult'])){
		echo '<b><t>- ActualResult:</b> <font color="#800080">'.$response['AVSResult']['ActualResult'].'</font><br />';
		echo '<b><t>- Address Result: </b><font color="#800080">'.$response['AVSResult']['AddressResult'].'</font><br />';
		echo '<b><t>- Postal Code Result:</b><font color="#800080"> '.$response['AVSResult']['PostalCodeResult'].'</font><br />';
	}

	echo '<b>CVResult:</b><font color="#800080"> '.$response['CVResult'].'</font><br />';
	echo '<b>Approval Code:</b><font color="#800080"> '.$response['ApprovalCode'].'</font><br />';

	echo '<b>TransactionId:</b><font color="#800080"> '.$response['TransactionId'].'</font><br />';
	echo '<b>OriginatorTransactionId:</b><font color="#800080"> '.$response['OriginatorTransactionId'].'</font><br />';
	echo '<b>ServiceTransactionId:</b><font color="#800080"> '.$response['ServiceTransactionId'].'</font><br />';
	echo '<b>OrderId:</b><font color="#800080"> '.$response['OrderId'].'</font><br />';
	echo '<b>CaptureState:</b><font color="#800080"> '.$response['CaptureState'].'</font><br />';
	echo '<b>TransactionState:</b><font color="#800080"> '.$response['TransactionState'].'</font><br />';
	echo '<b>PaymentAccountDataToken:</b><font color="#800080"> '.$response['PaymentAccountDataToken'].'</font><br />';
}
function printQueryAccountResults($response, $transactionType, $merchantProfileId)
{
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h2>'.$transactionType.'</h2></div>';
	echo '<b>Merchant ProfileId:</b><font color="#800080"> '.$merchantProfileId['ProfileId'].'</font><br />';
	echo '<b>Service Name:</b><font color="#800080"> '.translateSvcName($merchantProfileId['ServiceId']).'</font><br />';
	echo '<b>Status:</b><font color="#800080"> '.$response['Status'].'</font><br />';
	echo '<b>Status Code:</b> <font color="#800080">'.$response['StatusCode'].'</font><br />';
	echo '<b>Status Message:</b><font color="#800080"> '.$response['StatusMessage'].'</font><br />';
	echo '<b>Amount:</b><font color="#800080"> '.$response['Amount'].'</font><br />';
	echo '<b>TransactionId:</b><font color="#800080"> '.$response['TransactionId'].'</font><br />';
	echo '<b>OriginatorTransactionId:</b><font color="#800080"> '.$response['OriginatorTransactionId'].'</font><br />';
	echo '<b>ServiceTransactionId:</b><font color="#800080"> '.$response['ServiceTransactionId'].'</font><br />';
	echo '<b>OrderId:</b><font color="#800080"> '.$response['OrderId'].'</font><br />';
	echo '<b>CaptureState:</b><font color="#800080"> '.$response['CaptureState'].'</font><br />';
	echo '<b>TransactionState:</b><font color="#800080"> '.$response['TransactionState'].'</font><br />';
	echo '<b>ACHCapable:</b><font color="#800080"> '.$response['ACHCapable'].'</font><br />';
	echo '<b>ModifiedAccountNumber:</b><font color="#800080"> '.$response['ModifiedAccountNumber'].'</font><br />';
	echo '<b>ModifiedRoutingNumber:</b><font color="#800080"> '.$response['ModifiedRoutingNumber'].'</font><br />';
	echo '<b>PaymentAccountDataToken:</b><font color="#800080"> '.$response['PaymentAccountDataToken'].'</font><br />';
}
function printBatchResults($response, $merchantProfileId){
	//NOTE : Please reference the developers guide for a more complete explination of the return fields
	//Note Highly recommended to save
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h2>Capture Results</h2></div>';
	echo '<b>Merchant ProfileId:</b><font color="#800080"> '.$merchantProfileId['ProfileId'].'</font><br />';
	echo '<b>Service Name:</b><font color="#800080"> '.translateSvcName($merchantProfileId['ServiceId']).'</font><br />';
	echo '<b>Status:</b><font color="#800080"> '. $response['Response']['Status'].'</font><br />';

	echo '<b>TransactionId :</b><font color="#800080"> ' . $response['Response']['TransactionId'] . '</font><br />';
	//Note Optional but recommended to save
	echo '<b>Status Code : </b><font color="#800080">' . $response['Response']['StatusCode'] . '</font><br />';
	echo '<b>Status Message : </b><font color="#800080">' . $response['Response']['StatusMessage'] . '</font><br />';
}
function printACHBatchResults($response, $merchantProfileId){
	//NOTE : Please reference the developers guide for a more complete explination of the return fields
	//Note Highly recommended to save
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h2>Capture Results</h2></div>';
	echo '<b>Merchant ProfileId:</b><font color="#800080"> '.$merchantProfileId['ProfileId'] . '</font><br />';
	echo '<b>Service Name:</b><font color="#800080"> '.translateSvcName($merchantProfileId['ServiceId']) . '</font><br />';
	echo '<b>Status:</b><font color="#800080"> '. $response['Response']['Status'] . '</font><br />';

	echo '<b>TransactionId :</b><font color="#800080"> ' . $response['Response']['TransactionId'] . '</font><br />';
	//Note Optional but recommended to save
	echo '<b>Status Code : </b><font color="#800080">' . $response['Response']['StatusCode'] . '</font><br />';
	echo '<b>Status Message : </b><font color="#800080">' . $response['Response']['StatusMessage'] . '</font><br />';
	//Note Optional data about the batch
	if ($response['Response']['BatchId'] != null)
	echo '<b>Batch Id : </b><font color="#800080">' . $response['Response']['BatchId'] . '</font><br />';
	if ($response['Response']['SummaryData']['CashBackTotals'] instanceof SummaryTotals)
	echo '<b>Cash Back Totals <br /> -     Count : </b><font color="#800080">' . $response['Response']['SummaryData']['CashBackTotals']['Count'] . '</font><br /><b>  -     Net Amount : </b><font color="#800080">' . $response['Response']['SummaryData']['CashBackTotals']['NetAmount'] . '</font><br />';
	if ($response['Response']['SummaryData']['CreditReturnTotals'] instanceof SummaryTotals)
	echo '<b>Credit Return Totals <br /> -     Count : </b><font color="#800080">' . $response['Response']['SummaryData']['CreditReturnTotals']['Count'] . '</font><br /><b>  -     Net Amount : </b><font color="#800080">' . $response['Response']['SummaryData']['CreditReturnTotals']['NetAmount'] . '</font><br />';
	if ($response['Response']['SummaryData']['CreditTotals'] instanceof SummaryTotals)
	echo '<b>Credit Totals <br /> -     Count : </b><font color="#800080">' . $response['Response']['SummaryData']['NetTotals']['Count'] . '</font><br /><b>  -     Net Amount : </b><font color="#800080">' . $response['Response']['SummaryData']['NetTotals']['NetAmount'] . '</font><br />';
	if ($response['Response']['SummaryData']['DebitReturnTotals'] instanceof SummaryTotals)
	echo '<b>Debit Return Totals <br /> -     Count : </b><font color="#800080">' . $response['Response']['SummaryData']['DebitReturnTotals']['Count'] . '</font><br /><b>  -     Net Amount : </b><font color="#800080">' . $response['Response']['SummaryData']['DebitReturnTotals']['NetAmount'] . '</font><br />';
	if ($response['Response']['SummaryData']['DebitTotals'] instanceof SummaryTotals)
	echo '<b>Debit Totals <br /> -     Count : </b><font color="#800080">' . $response['Response']['SummaryData']['DebitTotals']['Count'] . '</font><br /><b>  -     Net Amount : </b><font color="#800080">' . $response['Response']['SummaryData']['DebitTotals']['NetAmount'] . '</font><br />';
	if ($response['Response']['SummaryData']['NetTotals'] instanceof SummaryTotals)
	echo '<b>Net Totals <br /> -     Count : </b><font color="#800080">' . $response['Response']['SummaryData']['NetTotals']['Count'] . '</font><br /><b>  -     Net Amount : </b><font color="#800080">' . $response['Response']['SummaryData']['NetTotals']['NetAmount'] . '</font><br />';
	if ($response['Response']['SummaryData']['VoidTotals'] instanceof SummaryTotals)
	echo '<b>Void Totals <br /> -     Count : </b><font color="#800080">' . $response['Response']['SummaryData']['VoidTotals']['Count'] . '</font><br /> <b> -     Net Amount : </b><font color="#800080">' . $response['Response']['SummaryData']['VoidTotals']['NetAmount'] . '</font><br />';

}
function printTransactionDetailInformation($response)
{
	//NOTE : Please reference the developers guide for a more complete explination of the return fields
	//Note Highly recommended to save
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h2>Summary Detail for TransactionId: '.$response['CompleteTransaction']['CWSTransaction']['MetaData']['TransactionId'] . '</h2></div>';
	if ($response['CompleteTransaction']['CWSTransaction'] != null){
		echo '<b>     CWSTransaction:</b><br />';
		echo '<b>     - ApplicationData:</b><br />';
		echo '<b>     -- ApplicationAttended:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['ApplicationData']['ApplicationAttended'] . '</font><br />';
		echo '<b>     -- ApplicationLocation:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['ApplicationLocation'] . '</font><br />';
		echo '<b>     -- ApplicationName:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['ApplicationName'] . '</font><br />';
		echo '<b>     -- DeveloperId:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['DeveloperId'] . '</font><br />';
		echo '<b>     -- HardwareType:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['HardwareType'] . '</font><br />';
		echo '<b>     -- PINCapability:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['PINCapability'] . '</font><br />';
		echo '<b>     -- PTLSSocketId:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['PTLSSocketId'] . '</font><br />';
		echo '<b>     -- ReadCapability:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['ReadCapability'] . '</font><br />';
		echo '<b>     -- SerialNumber:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['SerialNumber'] . '</font><br />';
		echo '<b>     -- SoftwareVersion:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['SoftwareVersion'] . '</font><br />';
		echo '<b>     -- SoftwareVersionDate:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['SoftwareVersionDate'] . '</font><br />';
		echo '<b>     -- VendorId:</b><font color="#800080"> '.$response['CompleteTransaction']['CWSTransaction']['ApplicationData']['VendorId'] . '</font><br />';

		echo '<b>     - MerchantProfile Data:</b><br />';
		echo '<b>     -- CustomerServiceInternet:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['CustomerServiceInternet'] . '</font><br />';
		echo '<b>     -- CustomerServicePhone:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['CustomerServicePhone'] . '</font><br />';
		echo '<b>     -- Language:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Language'] . '</font><br />';
		echo '<b>     -- Address:</b><br />';
		echo '<b>     --- Street1:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Address']['Street1'] . '</font><br />';
		echo '<b>     --- Street2:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Address']['Street2'] . '</font><br />';
		echo '<b>     --- City:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Address']['City'] . '</font><br />';
		echo '<b>     --- StateProvince:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Address']['StateProvince'] . '</font><br />';
		echo '<b>     --- PostalCode:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Address']['PostalCode'] . '</font><br />';
		echo '<b>     --- CountryCode:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Address']['CountryCode'] . '</font><br />';

		echo '<b>     -- MerchantId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['MerchantId'] . '</font><br />';
		echo '<b>     -- MerchantName:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Name'] . '</font><br />';
		echo '<b>     -- Phone:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['Phone'] . '</font><br />';
		echo '<b>     -- TaxId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['TaxId'] . '</font><br />';

		echo '<b>     -- BankcardMerchantData:</b><br />';
		echo '<b>     --- ABANumber:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['ABANumber'] . '</font><br />';
		echo '<b>     --- AcquirerBIN:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['AcquirerBIN'] . '</font><br />';
		echo '<b>     --- AgentBank:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['AgentBank'] . '</font><br />';
		echo '<b>     --- AgentChain:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['AgentChain'] . '</font><br />';
		echo '<b>     --- Aggregator:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['Aggregator'] . '</font><br />';
		echo '<b>     --- ClientNumber:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['ClientNumber'] . '</font><br />';
		echo '<b>     --- IndustryType:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['IndustryType'] . '</font><br />';
		echo '<b>     --- Location:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['Location'] . '</font><br />';
		echo '<b>     --- MerchantType:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['MerchantType'] . '</font><br />';
		echo '<b>     --- PrintCustomerServicePhone:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['PrintCustomerServicePhone'] . '</font><br />';
		echo '<b>     --- QualificationCodes:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['QualificationCodes'] . '</font><br />';
		echo '<b>     --- ReimbursementAttribute:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['ReimbursementAttribute'] . '</font><br />';
		echo '<b>     --- SIC:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['SIC'] . '</font><br />';
		echo '<b>     --- SecondaryTerminalId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['SecondaryTerminalId'] . '</font><br />';
		echo '<b>     --- SettlementAgent:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['SettlementAgent'] . '</font><br />';
		echo '<b>     --- SharingGroup:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['SharingGroup'] . '</font><br />';
		echo '<b>     --- StoreId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['StoreId'] . '</font><br />';
		echo '<b>     --- TerminalId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['TerminalId'] . '</font><br />';
		echo '<b>     --- TimeZoneDifferential:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MerchantProfileMerchantData']['BankcardMerchantData']['TimeZoneDifferential'] . '</font><br />';

		echo '<b>     - Meta Data:</b><br />';
		echo '<b>     -- Amount:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['Amount'] . '</font><br />';
		echo '<b>     -- CardType:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['CardType'] . '</font><br />';
		echo '<b>     -- MaskedPAN:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['MaskedPAN'] . '</font><br />';
		echo '<b>     -- MaskedPAN:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['MaskedPAN'] . '</font><br />';
		echo '<b>     -- MaskedPAN:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['MaskedPAN'] . '</font><br />';
		echo '<b>     -- TransactionClassTypePair:</b><br />';
		echo '<b>     --- Street1:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['TransactionClassTypePair']['TransactionClass'] . '</font><br />';
		echo '<b>     --- Street2:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['TransactionClassTypePair']['TransactionType'] . '</font><br />';
		echo '<b>     -- TransactionDateTime:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['TransactionDateTime'] . '</font><br />';
		echo '<b>     -- TransactionId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['TransactionId'] . '</font><br />';
		echo '<b>     -- TransactionState:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['TransactionState'] . '</font><br />';
		echo '<b>     -- WorkflowId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['MetaData']['WorkflowId'] . '</font><br />';

		echo '<b>     - <br />Transaction Response:</b><br />';
		echo '<b>     -- Status:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['Status'] . '</font><br />';
		echo '<b>     -- StatusCode:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['StatusCode'] . '</font><br />';
		echo '<b>     -- StatusMessage:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['StatusMessage'] . '</font><br />';
		echo '<b>     -- TransactionId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['TransactionId'] . '</font><br />';
		echo '<b>     -- OriginatorTransactionId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['OriginatorTransactionId'] . '</font><br />';
		echo '<b>     -- ServiceTransactionId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['ServiceTransactionId'] . '</font><br />';
		echo '<b>     -- ServiceTransactionDateTime:</b><br />';
		echo '<b>     --- Date:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['ServiceTransactionDateTime']['Date'] . '</font><br />';
		echo '<b>     --- Time:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['ServiceTransactionDateTime']['Time'] . '</font><br />';
		echo '<b>     --- TimeZone:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['ServiceTransactionDateTime']['TimeZone'] . '</font><br />';

		echo '<b>     -- CaptureState:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['CaptureState'] . '</font><br />';
		echo '<b>     -- TransactionState:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['TransactionState'] . '</font><br />';
		echo '<b>     -- Amount:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['Amount'] . '</font><br />';
		echo '<b>     -- CardType:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['CardType'] . '</font><br />';
		echo '<b>     -- FeeAmount:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['FeeAmount'] . '</font><br />';
		echo '<b>     -- ApprovalCode:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['ApprovalCode'] . '</font><br />';
		if (isset($response['CompleteTransaction']['CWSTransaction']['Response']['AVSResult']['ActualResult'])){
			echo '<b>     -- AVSResult:</b><br />';
			echo '<b>     --- ActualResult:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['AVSResult']['ActualResult'] . '</font><br />';
			echo '<b>     --- AddressResult:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['AVSResult']['AddressResult'] . '</font><br />';
			echo '<b>     --- PostalCodeResult:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['AVSResult']['PostalCodeResult'] . '</font><br />';
		}
		echo '<b>     -- BatchId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['BatchId'] . '</font><br />';
		echo '<b>     -- CVResult:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['CVResult'] . '</font><br />';
		echo '<b>     -- CardLevel:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['CardLevel'] . '</font><br />';
		echo '<b>     -- DowngradeCode:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['DowngradeCode'] . '</font><br />';
		echo '<b>     -- MaskedPAN:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['MaskedPAN'] . '</font><br />';
		echo '<b>     -- PaymentAccountDataToken:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['PaymentAccountDataToken'] . '</font><br />';
		echo '<b>     -- RetrievalReferenceNumber:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['RetrievalReferenceNumber'] . '</font><br />';
		echo '<b>     -- Resubmit:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['Resubmit'] . '</font><br />';
		echo '<b>     -- SettlementDate:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['SettlementDate'] . '</font><br />';
		echo '<b>     -- FinalBalance:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['FinalBalance'] . '</font><br />';
		echo '<b>     -- OrderId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['OrderId'] . '</font><br />';
		echo '<b>     -- AdviceResponse:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['AdviceResponse'] . '</font><br />';
		echo '<b>     -- CommercialCardResponse:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['CommercialCardResponse'] . '</font><br />';
		echo '<b>     -- ReturnedACI:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Response']['ReturnedACI'] . '</font><br />';

		echo '<b>     - <br />Transaction Request:</b><br />';
		echo '<b>     -- TenderData:</b><br />';
		echo '<b>     --- PaymentAccountDataToken:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TenderData']['PaymentAccountDataToken'] . '</font><br />';
		echo '<b>     --- PaymentAccountDataToken:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TenderData']['PaymentAccountDataToken'] . '</font><br />';
		echo '<b>     --- CardData:</b><br />';
		echo '<b>     ---- CardType:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TenderData']['CardData']['CardType'] . '</font><br />';
		echo '<b>     ---- CardholderName:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TenderData']['CardData']['CardholderName'] . '</font><br />';
		echo '<b>     ---- PAN:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TenderData']['CardData']['PAN'] . '</font><br />';
		echo '<b>     ---- Expire:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TenderData']['CardData']['Expire'] . '</font><br />';

		echo '<b>     -- <br />TransactionData:</b><br />';
		echo '<b>     --- Amount:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['Amount'] . '</font><br />';
		echo '<b>     --- TransactionDateTime:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['TransactionDateTime'] . '</font><br />';
		echo '<b>     --- AccountType:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['AccountType'] . '</font><br />';
		echo '<b>     --- AlternativeMerchantData:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['AlternativeMerchantData'] . '</font><br />';
		echo '<b>     --- ApprovalCode:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['ApprovalCode'] . '</font><br />';
		echo '<b>     --- CashBackAmount:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['CashBackAmount'] . '</font><br />';
		echo '<b>     --- CustomerPresent:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['CustomerPresent'] . '</font><br />';
		echo '<b>     --- EmployeeId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['EmployeeId'] . '</font><br />';
		echo '<b>     --- EntryMode:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['EntryMode'] . '</font><br />';
		echo '<b>     --- GoodsType:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['GoodsType'] . '</font><br />';
		echo '<b>     --- IndustryType:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['IndustryType'] . '</font><br />';
		echo '<b>     --- InternetTransactionData:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['InternetTransactionData'] . '</font><br />';
		echo '<b>     --- InvoiceNumber:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['InvoiceNumber'] . '</font><br />';
		echo '<b>     --- OrderNumber:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['OrderNumber'] . '</font><br />';
		echo '<b>     --- IsPartialShipment:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['IsPartialShipment'] . '</font><br />';
		echo '<b>     --- SignatureCaptured:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['SignatureCaptured'] . '</font><br />';
		echo '<b>     --- TerminalId:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['TerminalId'] . '</font><br />';
		echo '<b>     --- TipAmount:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['TipAmount'] . '</font><br />';
		echo '<b>     --- BatchAssignment:</b><font color="#800080"> '. $response['CompleteTransaction']['CWSTransaction']['Transaction']['TransactionData']['BatchAssignment'] . '</font><br />';

		echo '<b>     - <br />Family Information:</b><br />';
		echo '<b>     -- FamilyId:</b><font color="#800080"> '. $response['FamilyInformation']['FamilyId'] . '</font><br />';
		echo '<b>     -- FamilySequenceCount:</b><font color="#800080"> '. $response['FamilyInformation']['FamilySequenceCount'] . '</font><br />';
		echo '<b>     -- FamilySequenceNumber:</b><font color="#800080"> '. $response['FamilyInformation']['FamilySequenceNumber'] . '</font><br />';
		echo '<b>     -- FamilyState:</b><font color="#800080"> '. $response['FamilyInformation']['FamilyState'] . '</font><br />';
		echo '<b>     -- NetAmount:</b><font color="#800080"> '. $response['FamilyInformation']['NetAmount'] . '</font><br />';

		echo '<b>     - <br />Transaction Information:</b><br />';
		echo '<b>     -- Amount:</b><font color="#800080"> '. $response['TransactionInformation']['Amount'] . '</font><br />';
		echo '<b>     -- ApprovalCode:</b><font color="#800080"> '. $response['TransactionInformation']['ApprovalCode'] . '</font><br />';
		echo '<b>     -- <br />BankcardData:</b><br />';

		if ($response['TransactionInformation']['BankcardData']['AVSResult'] != null){
			echo '<b>     -- AVSResult:</b><br />';
			echo '<b>     --- ActualResult:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['AVSResult']['ActualResult'] . '</font><br />';
			echo '<b>     --- AddressResult:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['AVSResult']['AddressResult'] . '</font><br />';
			echo '<b>     --- PostalCodeResult:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['AVSResult']['PostalCodeResult'] . '</font><br />';
		}
		echo '<b>     --- CVResult:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['CVResult'] . '</font><br />';
		echo '<b>     --- CardType:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['CardType'] . '</font><br />';
		echo '<b>     -- BatchId:</b><font color="#800080"> '. $response['TransactionInformation']['BatchId'] . '</font><br />';
		echo '<b>     -- CaptureDateTime:</b><font color="#800080"> '. $response['TransactionInformation']['CaptureDateTime'] . '</font><br />';
		echo '<b>     -- CaptureState:</b><font color="#800080"> '. $response['TransactionInformation']['CaptureState'] . '</font><br />';
		echo '<b>     -- CaptureStatusMessage:</b><font color="#800080"> '. $response['TransactionInformation']['CaptureStatusMessage'] . '</font><br />';
		echo '<b>     -- CapturedAmount:</b><font color="#800080"> '. $response['TransactionInformation']['CapturedAmount'] . '</font><br />';
		echo '<b>     -- CustomerId:</b><font color="#800080"> '. $response['TransactionInformation']['CustomerId'] . '</font><br />';
		echo '<b>     -- CustomerId:</b><font color="#800080"> '. $response['TransactionInformation']['CaptureState'] . '</font><br />';
		echo '<b>     -- ElectronicCheckData:</b><font color="#800080"> '. $response['TransactionInformation']['ElectronicCheckData'] . '</font><br />';
		echo '<b>     -- IsAcknowledged:</b><font color="#800080"> '. $response['TransactionInformation']['IsAcknowledged'] . '</font><br />';
		echo '<b>     -- MaskedPAN:</b><font color="#800080"> '. $response['TransactionInformation']['MaskedPAN'] . '</font><br />';
		echo '<b>     -- MerchantProfileId:</b><font color="#800080"> '. $response['TransactionInformation']['MerchantProfileId'] . '</font><br />';
		echo '<b>     -- OriginatorTransactionId:</b><font color="#800080"> '. $response['TransactionInformation']['OriginatorTransactionId'] . '</font><br />';
		echo '<b>     -- ServiceId:</b><font color="#800080"> '. $response['TransactionInformation']['ServiceId'] . '</font><br />';
		echo '<b>     -- ServiceKey:</b><font color="#800080"> '. $response['TransactionInformation']['ServiceKey'] . '</font><br />';
		echo '<b>     -- ServiceTransactionId:</b><font color="#800080"> '. $response['TransactionInformation']['ServiceTransactionId'] . '</font><br />';
		echo '<b>     -- Status:</b><font color="#800080"> '. $response['TransactionInformation']['Status'] . '</font><br />';
		echo '<b>     -- TransactionClassTypePair:</b><br />';
		echo '<b>     --- TransactionClass:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionClassTypePair']['TransactionClass'] . '</font><br />';
		echo '<b>     --- TransactionType:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionClassTypePair']['TransactionType'] . '</font><br />';
		echo '<b>     -- TransactionId:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionId'] . '</font><br />';
		echo '<b>     -- TransactionState:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionState'] . '</font><br />';
		echo '<b>     -- TransactionStatusCode:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionStatusCode'] . '</font><br />';
		echo '<b>     -- TransactionTimestamp:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionTimestamp'] . '</font><br />';
	}

}
function printFamilyDetailInformation($response)
{
	//NOTE : Please reference the developers guide for a more complete explination of the return fields
	//Note Highly recommended to save
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h2>Summary Detail FamilyId: '.$response['FamilyId'] . '</h2></div>';
	echo '<b>     BatchId:</b><font color="#800080"> '. $response['BatchId'] . '</font><br />';
	echo '<b>     CaptureDateTime:</b><font color="#800080"> '. $response['CaptureDateTime'] . '</font><br />';
	echo '<b>     CapturedAmount:</b><font color="#800080"> '. $response['CapturedAmount'] . '</font><br />';
	echo '<b>     CustomerId:</b><font color="#800080"> '. $response['CustomerId'] . '</font><br />';
	echo '<b>     FamilyState:</b><font color="#800080"> '. $response['FamilyState'] . '</font><br />';
	echo '<b>     LastAuthorizedAmount:</b><font color="#800080"> '. $response['LastAuthorizedAmount'] . '</font><br />';
	echo '<b>     MerchantProfileId:</b><font color="#800080"> '. $response['MerchantProfileId'] . '</font><br />';
	echo '<b>     NetAmount:</b><font color="#800080"> '. $response['NetAmount'] . '</font><br />';
	echo '<b>     ServiceKey:</b><font color="#800080"> '. $response['ServiceKey'] . '</font><br />';

	echo '<b>TransactionIds:</b><br />';
	if (is_array($response['TransactionIds']['string']))
	{
		foreach( $response['TransactionIds']['string'] as $string)
		echo '<b>     --- TransactionId:</b><font color="#800080"> '. $string . '</font><br />';
	}
	else
	echo '<b>     --- TransactionId:</b><font color="#800080"> '. $response['TransactionIds']['string'] . '</font><br />';
	echo '<b>     FamilyId:</b><font color="#800080"> '. $response['FamilyId'] . '</font><br />';
	echo '<b><br />Family Transaction Meta Data</b><br />';
	if (is_array($response['TransactionMetaData']['TransactionMetaData']))
	{
		foreach( $response['TransactionMetaData'] as $TransactionMetaData)
		{
			echo '<b>     <br />TransactionMetaData:</b><br />';
			echo '<b>     -   Amount:</b><font color="#800080"> '. $TransactionMetaData['Amount'] . '</font><br />';
			echo '<b>     -   CardType:</b><font color="#800080"> '. $TransactionMetaData['CardType'] . '</font><br />';
			echo '<b>     -   MaskedPAN:</b><font color="#800080"> '. $TransactionMetaData['MaskedPAN'] . '</font><br />';
			echo '<b>     -   SequenceNumber:</b><font color="#800080"> '. $TransactionMetaData['SequenceNumber'] . '</font><br />';
			echo '<b>     -   ServiceId:</b><font color="#800080"> '. $TransactionMetaData['ServiceId'] . '</font><br />';
			echo '<b>     -   TransactionClass:</b><font color="#800080"> '. $TransactionMetaData['TransactionClassTypePair']['TransactionClass'] . '</font><br />';
			echo '<b>     -   TransactionType:</b><font color="#800080"> '. $TransactionMetaData['TransactionClassTypePair']['TransactionType'] . '</font><br />';
			echo '<b>     -   TransactionDateTime:</b><font color="#800080"> '. $TransactionMetaData['TransactionDateTime'] . '</font><br />';
			echo '<b>     -   TransactionId:</b><font color="#800080"> '. $TransactionMetaData['TransactionId'] . '</font><br />';
			echo '<b>     -   TransactionState:</b><font color="#800080"> '. $TransactionMetaData['TransactionState'] . '</font><br />';
			echo '<b>     -   WorkflowId:</b><font color="#800080"> '. $TransactionMetaData['WorkflowId'] . '</font><br />';
			echo '<b>----------------------------------------------------------------------------------------<br />';
		}
	}

	else
	{
		echo '<b>     TransactionMetaData:</b><br />';
		echo '<b>     -   Amount:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['Amount'] . '</font><br />';
		echo '<b>     -   CardType:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['CardType'] . '</font><br />';
		echo '<b>     -   MaskedPAN:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['MaskedPAN'] . '</font><br />';
		echo '<b>     -   SequenceNumber:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['SequenceNumber'] . '</font><br />';
		echo '<b>     -   ServiceId:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['ServiceId'] . '</font><br />';
		echo '<b>     -   TransactionClass:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['TransactionClassTypePair']['TransactionClass'] . '</font><br />';
		echo '<b>     -   TransactionType:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['TransactionClassTypePair']['TransactionType'] . '</font><br />';
		echo '<b>     -   TransactionDateTime:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['TransactionDateTime'] . '</font><br />';
		echo '<b>     -   TransactionId:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['TransactionId'] . '</font><br />';
		echo '<b>     -   TransactionState:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['TransactionState'] . '</font><br />';
		echo '<b>     -   WorkflowId:</b><font color="#800080"> '. $response['TransactionMetaData']['TransactionMetaData']['WorkflowId'] . '</font><br />';
	}


}
function printSummaryDetailInformation($response)
{
	//NOTE : Please reference the developers guide for a more complete explination of the return fields
	//Note Highly recommended to save
	echo '<div style="text-align:center; border-width: thin; border-color: black; border-style:solid; "><h2>Transaction Summary Detail: '.$response['TransactionInformation']['TransactionId'] . '</h2></div>';
	echo '<b>Family Information</b><br />';
	echo '<b>     FamilyId:</b><font color="#800080"> '. $response['FamilyInformation']['FamilyId'] . '</font><br />';
	echo '<b>     FamilySequenceCount:</b><font color="#800080"> '. $response['FamilyInformation']['FamilySequenceCount'] . '</font><br />';
	echo '<b>     FamilySequenceNumber:</b><font color="#800080"> '. $response['FamilyInformation']['FamilySequenceNumber'] . '</font><br />';
	echo '<b>     FamilyState:</b><font color="#800080"> '. $response['FamilyInformation']['FamilyState'] . '</font><br />';
	echo '<b>     NetAmount:</b><font color="#800080"> '. $response['FamilyInformation']['NetAmount'] . '</font><br /><br />';

	echo '<b>Transaction Information</b><br />';
	echo '<b>     TransactionId:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionId'] . '</font><br />';
	echo '<b>     Amount:</b><font color="#800080"> '. $response['TransactionInformation']['Amount'] . '</font><br />';
	echo '<b>     ApprovalCode:</b><font color="#800080"> '. $response['TransactionInformation']['ApprovalCode'] . '</font><br />';
	echo '<b>     AVS ActualResult:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['AVSResult']['ActualResult'] . '</font><br />';
	echo '<b>     AVS AddressResult:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['AVSResult']['AddressResult'] . '</font><br />';
	echo '<b>     AVS PostalCodeResult:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['AVSResult']['PostalCodeResult'] . '</font><br />';
	echo '<b>     CVResult:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['CVResult'] . '</font><br />';
	echo '<b>     CardType:</b><font color="#800080"> '. $response['TransactionInformation']['BankcardData']['CardType'] . '</font><br />';
	echo '<b>     BatchId:</b><font color="#800080"> '. $response['TransactionInformation']['BatchId'] . '</font><br />';
	echo '<b>     CaptureDateTime:</b><font color="#800080"> '. $response['TransactionInformation']['CaptureDateTime'] . '</font><br />';
	echo '<b>     CaptureState:</b><font color="#800080"> '. $response['TransactionInformation']['CaptureState'] . '</font><br />';
	echo '<b>     CaptureStatusMessage:</b><font color="#800080"> '. $response['TransactionInformation']['CaptureStatusMessage'] . '</font><br />';
	echo '<b>     CapturedAmount:</b><font color="#800080"> '. $response['TransactionInformation']['CapturedAmount'] . '</font><br />';
	echo '<b>     MaskedPAN:</b><font color="#800080"> '. $response['TransactionInformation']['MaskedPAN'] . '</font><br />';
	echo '<b>     MerchantProfileId:</b><font color="#800080"> '. $response['TransactionInformation']['MerchantProfileId'] . '</font><br />';
	echo '<b>     OriginatorTransactionId:</b><font color="#800080"> '. $response['TransactionInformation']['OriginatorTransactionId'] . '</font><br />';
	echo '<b>     ServiceId:</b><font color="#800080"> '. $response['TransactionInformation']['ServiceId'] . '</font><br />';
	echo '<b>     ServiceKey:</b><font color="#800080"> '. $response['TransactionInformation']['ServiceKey'] . '</font><br />';
	echo '<b>     ServiceTransactionId:</b><font color="#800080"> '. $response['TransactionInformation']['ServiceTransactionId'] . '</font><br />';
	echo '<b>     Status:</b><font color="#800080"> '. $response['TransactionInformation']['Status'] . '</font><br />';
	echo '<b>     TransactionClassTypePair:</b><br />';
	echo '<b>          TransactionClass:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionClassTypePair']['TransactionClass'] . '</font><br />';
	echo '<b>          TransactionType:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionClassTypePair']['TransactionType'] . '</font><br />';
	echo '<b>     TransactionState:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionState'] . '</font><br />';
	echo '<b>     TransactionStatusCode:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionStatusCode'] . '</font><br />';
	echo '<b>     TransactionTimestamp:</b><font color="#800080"> '. $response['TransactionInformation']['TransactionTimestamp'] . '</font><br />';
}
/*
 *
 * Function to parse the GetMerchantProfilesResult
 *
 */
function printMerchantProfiles($MerchantProfiles) {

	echo '<h2><b>Merchant ProfileId:</b><font color="#800080"> ' . $MerchantProfiles['ProfileId'] . '</font></h2>';
	echo '<b>LastUpdated:</b><font color="#800080"> ' . $MerchantProfiles['LastUpdated'] . '</font><br />';
	echo '<b>ServiceId:</b><font color="#800080"> ' . $MerchantProfiles['ServiceId'] . '</font><br />';
	echo '<b>ServiceName:</b><font color="#800080"> ' . translateSvcName ( $MerchantProfiles['ServiceId'] ) . '</font><br />';
	echo '<h3><b>Bankcard Merchant Data: </h3>';
	echo '<b>Merchant Name:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Name'] . '</font><br />';
	echo '<b>Merchant ID:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['MerchantId'] . '</font><br />';
	echo '<b>Merchant Address: </font><br />';
	echo '<b><ul><li>Street  :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['Street1'] . '</font><br />';
	echo '<b><li>Street 2:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['Street2'] . '</font><br />';
	echo '<b><li>City    :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['City'] . '</font><br />';
	echo '<b><li>State   :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['StateProvince'] . '</font><br />';
	echo '<b><li>Postal  :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['PostalCode'] . '</font><br />';
	echo '<b><li>Country :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['CountryCode'] . '</font><br /></ul>';
	echo '<b>Merchant Phone:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Phone'] . '</font><br />';
	echo '<b>Customer Service Phone:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['CustomerServicePhone'] . '</font><br />';
	echo '<b>Customer Service Internet:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['CustomerServiceInternet'] . '</font><br />';
	echo '<b>Language:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Language'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['TaxId'][1] ))
	echo '<b>Tax Id:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['TaxId'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['BankcardMerchantData']['AcquirerBIN'][1] ))
	echo '<b>AcquirerBIN:  </b><font color="#800080">	 	 ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['AcquirerBIN'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['BankcardMerchantData']['AgentBank'][1] ))
	echo '<b>AgentBank: 	</b><font color="#800080">			 ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['AgentBank'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['BankcardMerchantData']['ClientNumber'][1] ))
	echo '<b>ClientNumber:   </b><font color="#800080"> 			 ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['ClientNumber'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['BankcardMerchantData']['Location'][1] ))
	echo '<b>Location:   	</b><font color="#800080">			 ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['Location'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['BankcardMerchantData']['PrintCustomerServicePhone'][1] ))
	echo '<b>PrintCustomerServicePhone:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['PrintCustomerServicePhone'] . '</font><br />';
	echo '<b>SIC: 			</b><font color="#800080">			 ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['SIC'] . '</font><br />';
	echo '<b>TerminalId:   	</b><font color="#800080">		 ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['TerminalId'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['BankcardMerchantData']['SecondaryTerminalId'][1] ))
	echo '<b>SecondaryTerminalId:  </b><font color="#800080">	 ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['SecondaryTerminalId'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['BankcardMerchantData']['StoreId'][1] ))
	echo '<b>StoreId:				</b><font color="#800080">	 ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['StoreId'] . '</font><br />';
	if (isset($MerchantProfiles['MerchantData']['BankcardMerchantData']['TimeZoneDifferential'][1] ))
	echo '<b>TimeZoneDifferential:	</b><font color="#800080">     ' . $MerchantProfiles['MerchantData']['BankcardMerchantData']['TimeZoneDifferential'] . '</font><br />';

	echo '<b><h3>Merchant Transaction Data:</h3>';
	echo '<b>CreditTransactionData:';
	echo '<b><ul><li>CurrencyCode:  </b><font color="#800080">  ' . $MerchantProfiles['TransactionData']['BankcardTransactionDataDefaults']['CurrencyCode'] . '</font><br />';
	echo '<b><li>CustomerPresent:</b><font color="#800080"> ' . $MerchantProfiles['TransactionData']['BankcardTransactionDataDefaults']['CustomerPresent'] . '</font><br />';
	echo '<b><li>RequestACI    :</b><font color="#800080"> ' . $MerchantProfiles['TransactionData']['BankcardTransactionDataDefaults']['RequestACI'] . '</font><br />';
	echo '<b><li>RequestAdvice    :</b><font color="#800080"> ' . $MerchantProfiles['TransactionData']['BankcardTransactionDataDefaults']['RequestAdvice'] . '</font>';
	echo '<b><li>EntryMode    :</b><font color="#800080"> ' . $MerchantProfiles['TransactionData']['BankcardTransactionDataDefaults']['EntryMode'] . '</font></ul>';

}

/*
 *
 * Function to parse the GetMerchantProfilesResult
 *
 */
function printACHMerchantProfiles($MerchantProfiles) {

	echo '<h2><b>Merchant ProfileId:</b><font color="#800080"> ' . $MerchantProfiles['ProfileId'] . '</font></h2>';
	echo '<b>LastUpdated:</b><font color="#800080"> ' . $MerchantProfiles['LastUpdated'] . '</font><br />';
	echo '<b>ServiceId:</b><font color="#800080"> ' . $MerchantProfiles['ServiceId'] . '</font><br />';
	echo '<b>ServiceName:</b><font color="#800080"> ' . translateSvcName ( $MerchantProfiles['ServiceId'] ) . '</font><br />';
	echo '<h3><b>ACH Merchant Data: </h3>';
	echo '<b>Merchant Name:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData->Name'] . '</font><br />';
	echo '<b>Merchant Address: </font><br />';
	echo '<b><ul><li>Street  :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['Street1'] . '</font><br />';
	echo '<b><li>Street 2:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['Street2'] . '</font><br />';
	echo '<b><li>City    :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['City'] . '</font><br />';
	echo '<b><li>State   :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['StateProvince'] . '</font><br />';
	echo '<b><li>Postal  :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['PostalCode'] . '</font><br />';
	echo '<b><li>Country :</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Address']['CountryCode'] . '</font><br /></ul>';
	echo '<b>Merchant Phone:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Phone'] . '</font><br />';
	echo '<b>Customer Service Phone:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['CustomerServicePhone'] . '</font><br />';
	echo '<b>Customer Service Internet:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['CustomerServiceInternet'] . '</font><br />';
	echo '<b>Language:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['Language'] . '</font><br />';
	if ($MerchantProfiles['MerchantData']['TaxId'] != '')
	echo '<b>Tax Id:</b><font color="#800080"> ' . $MerchantProfiles['MerchantData']['TaxId'] . '</font><br />';

	echo '<b>OriginatorId:  </b><font color="#800080">	 	 ' . $MerchantProfiles['MerchantData']['ElectronicCheckingMerchantData']['OrginatorId'] . '</font><br />';
	echo '<b>ProductId: 	</b><font color="#800080">			 ' . $MerchantProfiles['MerchantData']['ElectronicCheckingMerchantData']['ProductId'] . '</font><br />';
	echo '<b>SiteId:   </b><font color="#800080"> 			 ' . $MerchantProfiles['MerchantData']['ElectronicCheckingMerchantData']['SiteId'] . '</font><br />';

}

/*
 *
 * function to parse the Service Information Result
 *
 */
function printServiceInformation($service) {
	$_serviceName = translateSvcName ( $service['ServiceId'] );

	echo '<h2><b>ServiceName:</b><font color="#800080"> '.$_serviceName.'</font></h2>';
	echo '<b>ServiceId:</b><font color="#800080"> '.$service['ServiceId'].'<br /></font><br />';
	echo '<b>AlternativeMerchantData Supported:</b><font color="#800080"> '.$service['AlternativeMerchantData'].'<br /></font><br />';
	echo '<b>AutoBatch Supported:</b><font color="#800080"> '.$service['AutoBatch'].'<br /></font><br />';

	echo '<h3><b>Transaction Operations Supported:</h3>';
	echo '<ul><li><b>Verify:</b><font color="#800080"> ' .  ( $service['Operations']['Verify'] ) . '</font><br />';
	echo '<li><b>QueryAccount:</b><font color="#800080"> ' .  ( $service['Operations']['QueryAccount'] ) . '</font><br />';
	echo '<li><b>AuthorizeAndCapture:</b><font color="#800080"> ' .  ( $service['Operations']['AuthAndCapture'] ) . '</font><br />';
	echo '<li><b>Authorize:</b><font color="#800080"> ' .  ( $service['Operations']['Authorize'] ) . '</font><br />';
	echo '<li><b>ReturnById:</b><font color="#800080"> ' .  ( $service['Operations']['ReturnById'] ) . '</font><br />';
	echo '<li><b>Undo:</b><font color="#800080"> ' .  ( $service['Operations']['Undo'] ) . '</font><br />';
	echo '<li><b>Capture:</b><font color="#800080"> ' .  ( $service['Operations']['Capture'] ) . '</font><br />';
	echo '<li><b>CaptureSelective:</b><font color="#800080"> ' .  ( $service['Operations']['CaptureSelective'] ) . '</font><br />';
	echo '<li><b>CaptureAll:</b><font color="#800080"> ' .  ( $service['Operations']['CaptureAll'] ) . '</ul></font><br />';

	echo '<h3><b>AVSData Fields Required:</h3>';
	echo '<ul><li><b>CardholderName:</b><font color="#800080"> ' .  ( $service['AVSData']['CardholderName'] ) . '</font><br />';
	echo '<li><b>Street:</b><font color="#800080"> ' .  ( $service['AVSData']['Street'] ) . '</font><br />';
	echo '<li><b>City:</b><font color="#800080"> ' .  ( $service['AVSData']['City'] ) . '</font><br />';
	echo '<li><b>StateProvince:</b><font color="#800080"> ' .  ( $service['AVSData']['StateProvince'] ) . '</font><br />';
	echo '<li><b>PostalCode:</b><font color="#800080"> ' .  ( $service['AVSData']['PostalCode'] ) . '</font><br />';
	echo '<li><b>Country:</b><font color="#800080"> ' .  ( $service['AVSData']['Country'] ) . '</font><br />';
	echo '<li><b>Phone:</b><font color="#800080"> ' .  ( $service['AVSData']['Phone'] ) . '</font><br /></ul>';

	echo '<h3><b>Tenders Supported:</h3>';
	echo '<ul><li><b>Credit:</b><font color="#800080"> ' .  ( $service['Tenders']['Credit'] ) . '</font><br />';
	echo '<li><b>PINDebit:</b><font color="#800080"> ' .  ( $service['Tenders']['PINDebit'] ) . '</font><br />';
	echo '<li><b>PINLessDebit:</b><font color="#800080"> ' .  ( $service['Tenders']['PINlessDebit'] ) . '</font><br />';
	echo '<li><b>PINDebitReturnSupportType:</b><font color="#800080"> ' .  ( $service['Tenders']['PINDebitReturnSupportType'] ) . '</font><br />';
	echo '<li><b>PINDebitUndoTenderDataRequired:</b><font color="#800080"> ' .  ( $service['Tenders']['PINDebitUndoTenderDataRequired'] ) . '</font><br />';
	echo '<li><b>CreditAuthorizeSupport:</b><font color="#800080"> ' .  ( $service['Tenders']['CreditAuthorizeSupport'] ) . '</font><br />';
	echo '<li><b>QueryRejectedSupport:</b><font color="#800080"> ' .  ( $service['Tenders']['QueryRejectedSupport'] ) . '</font><br />';
	echo '<li><b>PinDebitUndoSupport:</b><font color="#800080"> ' .  ( $service['Tenders']['PinDebitUndoSupport'] ) . '</font><br />';
	echo '<li><b>BatchAssignmentSupport:</b><font color="#800080"> ' .  ( $service['Tenders']['BatchAssignmentSupport'] ) . '</font><br />';
	echo '<li><b>CreditReturnSupportType:</b><font color="#800080"> ' .  ( $service['Tenders']['CreditReturnSupportType'] ) . '</font><br />';
	echo '<li><b>TrackDataSupport:</b><font color="#800080"> ' .  ( $service['Tenders']['TrackDataSupport'] ) . '</font><br />';
	echo '<li><b>CredentialsRequired:</b><font color="#800080"> ' .  ( $service['Tenders']['CredentialsRequired'] ) . '</font><br />';
	echo '<li><b>CreditReversalSupportType:</b><font color="#800080"> ' .  ( $service['Tenders']['CreditReversalSupportType'] ) . '</font><br />';
	echo '<li><b>PartialApprovalSupportType:</b><font color="#800080"> ' .  ( $service['Tenders']['PartialApprovalSupportType'] ) . '</font><br /></ul>';


	if(!"ElectronicCheckingService")
	{
		echo '<h3><b>AVS Data that is accepted:</h3>';
		echo '<ul><li><b>CardholderName:</b><font color="#800080"> ' .  ( $service['AVSData']['CardholderName'] ) . '</font><br />';
		echo '<li><b>Street:</b><font color="#800080"> ' .  ( $service['AVSData']['Street'] ) . '</font><br />';
		echo '<li><b>City:</b><font color="#800080"> ' .  ( $service['AVSData']['City'] ) . '</font><br />';
		echo '<li><b>StateProvince:</b><font color="#800080"> ' .  ( $service['AVSData']['StateProvince'] ) . '</font><br />';
		echo '<li><b>PostalCode:</b><font color="#800080"> ' .  ( $service['AVSData']['PostalCode'] ) . '</font><br />';
		echo '<li><b>Country:</b><font color="#800080"> ' .  ( $service['AVSData']['Country'] ) . '</font><br />';
		echo '<li><b>Phone:</b><font color="#800080"> ' .  ( $service['AVSData']['Phone'] ) . '</ul></font><br />';

		echo '<h3><b>Service Support Details:</h3>';
		echo '<ul><li><b>AutoBatch:</b><font color="#800080"> ' .  ( $service['AutoBatch'] ) . '</font><br />';
		//echo '-CutoffTime:</b><font color="#800080"> '.$service['CutoffTime'].'</font><br />';
		echo '<li><b>Managed Billing:</b><font color="#800080"> ' .  ( $service['ManagedBilling'] ) . '</font><br />';
		echo '<li><b>Maximum Batch Items:</b><font color="#800080"> ' .  ( $service['MaximumBatchItems'] ) . '</font><br />';
		echo '<li><b>Maximum Line Items:</b><font color="#800080"> ' .  ( $service['MaximumLineItems'] ) . '</font><br />';
		echo '<li><b>Multiple Partial Capture:</b><font color="#800080"> ' .  ( $service['MultiplePartialCapture'] ) . '</font><br />';
		echo '<li><b>PurchaseCardLevel Supported:</b><font color="#800080"> ' . $service['PurchaseCardLevel'] . '</font><br />';
		echo '<li><b>Tenders: <br/ >';
		echo '<ul><li><b>Credit:  </b><font color="#800080"> ' .  ( $service['Tenders']['Credit'] ) . '</font><br />';
		echo '<li><b>PINDebit:</b><font color="#800080"> ' .  ( $service['Tenders']['PINDebit'] ) . '</font><br />';
		echo '<li><b>PINDebitReturnSupportType:</b><font color="#800080"> ' . $service['Tenders']['PINDebitReturnSupportType'] . '</ul></ul></font><br />';
	}
}

function generate_xml_from_array($array, $node_name) {
	$xml = '';

	if (is_array($array) || is_object($array)) {
		foreach ($array as $key=>$value) {
			if (is_numeric($key)) {
				$key = $node_name;
			}

			$xml .= '<' . $key . '>' . generate_xml_from_array($value, $node_name) . '</' . $key . '>' ;
		}
	} else {
		$xml = htmlspecialchars($array, ENT_QUOTES) ;
	}

	return $xml;
}

function generate_valid_xml_from_array($array, $node_block='SoapFault', $node_name='node') {
	/*$xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";*/

	$xml = '<' . $node_block . '>' ;
	$xml .= generate_xml_from_array($array, $node_name);
	$xml .= '</' . $node_block . '>' ;
	$xml = str_replace('<@attributes>', '', $xml);// Remove the XML namespace closing tags
	$xml = str_replace('</@attributes>', '', $xml);
	$xml = str_replace('<nil>', '', $xml);
	$xml = str_replace('</nil>', '', $xml);
	$xml = str_replace('&quot;', '', $xml);

	return $xml;
}
/**
 * convert xml string to php array - useful to get a serializable value
 *
 * @param string $xmlstr
 * @return array
 * @author Adrien aka Gaarf
 */
function xmlstr_to_array($xmlstr) {
	$doc = new DOMDocument();
	$doc->loadXML($xmlstr);
	return domnode_to_array($doc->documentElement);
}
function domnode_to_array($node) {
	$output = array();
	switch ($node->nodeType) {
		case XML_CDATA_SECTION_NODE:
		case XML_TEXT_NODE:
			$output = trim($node->textContent);
			break;
		case XML_ELEMENT_NODE:
			for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
				$child = $node->childNodes->item($i);
				$v = domnode_to_array($child);
				if(isset($child->tagName)) {
					$t = $child->tagName;
					if(!isset($output[$t])) {
						$output[$t] = array();
					}
					$output[$t][] = $v;
				}
				elseif($v) {
					$output = (string) $v;
				}
			}
			if(is_array($output)) {
				if($node->attributes->length) {
					$a = array();
					foreach($node->attributes as $attrName => $attrNode) {
						$a[$attrName] = (string) $attrNode->value;
					}
					$output['@attributes'] = $a;
				}
				foreach ($output as $t => $v) {
					if(is_array($v) && count($v)==1 && $t!='@attributes') {
						$output[$t] = $v[0];
					}
				}
			}
			break;
	}
	return $output;
}

function curl_soap($xml,$api_url,$soap_action,$timeout=60) {
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $api_url ); // set url to post to
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return variable
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); // connection timeout
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml );
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

	$header[] = "SOAPAction: ". $soap_action ;
	$header[] = "MIME-Version: 1.0";
	$header[] = "Content-type: text/xml; charset=utf-8";

	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$xml = curl_exec($ch); // run the whole process

	if (curl_errno($ch)) {
		$error['curl_error'] = 'Connection Error : '. curl_error($ch) ;
		return $error ;
	} else {
		curl_close($ch);
		$xml = str_replace('<s:', '<', $xml);// Remove the XML namespace closing tags
		$xml = str_replace('</s:', '</', $xml);
		$xml = str_replace('<a:', '<', $xml);// Remove the XML namespace closing tags
		$xml = str_replace('</a:', '</', $xml);
		$xml = str_replace('<b:', '<', $xml);// Remove the XML namespace closing tags
		$xml = str_replace('</b:', '</', $xml);

		$arr = xmlstr_to_array($xml);
		return $arr ;
	}
}
?>