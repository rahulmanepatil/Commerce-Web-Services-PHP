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


include_once ABSPATH.'/TransactionProcessingScripts/SetBankcardTransactionData.php';

$_bcs = null;

/*if (is_array($_merchantProfileId)){
 foreach($_merchantProfileId as $profileId){
 if ($profileId['ServiceId'] == '214DF00001'  )
 {
 $_merchantProfileId = array(ProfileId => $profileId['ProfileId'], ServiceId => $profileId['ServiceId']);
 break;
 }
 else
 $_merchantProfileId = array('ProfileId' => $profileId['ProfileId'], 'ServiceId' => $profileId['ServiceId']);
 }
 }*/

if (is_array($_merchantProfileId)){
	foreach($_merchantProfileId as $profileId){
		$response = null;
		$response2 = null;
		$response3 = null;
		$response4 = null;
		$response5 = null;
		$response6 = null;
		$response7 = null;
		$transactionIds [] = null;
		$txnIds [] = null;
		$txnIdCs [] = null;

		$merchProfileId = array(ProfileId => $profileId['ProfileId'], ServiceId => $profileId['ServiceId']);
		
		if (count($_serviceInformation['BankcardServices'] == 1) && (!isset($_serviceId['singleService']))){

			foreach ($_bankcardServices['BankcardService'] as $bankcardService)
			{
				if ($bankcardService['ServiceId'] == $merchProfileId['ServiceId'])
				{
					$_bcs = $bankcardService;
					break;
				}
			}
		}
		else {
			$_bcs = $_bankcardServices['BankcardService'];
		}

		$client = new HTTPClient($_identityToken, $_baseURL, $merchProfileId['ProfileId'], $merchProfileId['ServiceId'] , $_applicationProfileId , $_bcs);

		$bcpTxn = new newTransaction();

		$bcpTxn->TxnData = setBCPTxnData($_serviceInformation);

		$bcpTxn->TndrData = setBCPTenderData();

		$bcpTxnXML = buildTransactionXML($bcpTxn->TndrData, $bcpTxn->TxnData);


		/*
		 *
		 * Authorize using credit card
		 *
		 */


		if($_bcs['Operations']['Authorize']  == 'true')
		{
			$response = $client->authorize($bcpTxnXML);
			printTransactionResults($response, 'Authorize', $merchProfileId);
		}

		if($_bcs['Operations']['Authorize']  == 'true' && Settings::TxnData_SupportTokenization)
		{
			$tokenTransaction = new newTransaction();
			$tokenTransaction->TxnData = setBCPTxnData($_serviceInformation);
			$tokenTransaction->TndrData = setBCPTenderData($response['PaymentAccountDataToken']);
			$tokenTxn = buildTransactionXML($tokenTransaction->TndrData, $tokenTransaction->TxnData);
			$response = $client->authorize($tokenTxn);
			printTransactionResults($response, 'Authorize using PaymentAccountDataToken', $merchProfileId);

		}

		/*
		 *
		 * Capture an authorized transaction
		 *
		 */
		if($_bcs['Operations']['Capture']   == 'true')
		{
			$capDiffData = new CaptureDifferenceData();
			$capDiffData->TransactionId = $response['TransactionId'];
			if (Settings::IndustryType == 'Restaurant'){
				$capDiffData->TipAmount = '2.00';
				$capDiffData->Amount = $response->Amount + $capDiffData->TipAmount;
			}
			$capDiffData->Amount = '2.00';
			$capDiffXML = buildCaptureXML($capDiffData);
			$response2 = $client->capture( $capDiffXML, $credentials );
			printCaptureResults($response2, $merchProfileId);
		}

		if($_bcs['Operations']['CaptureSelective']  == 'true')
		{
			$response = $client->authorize( $bcpTxnXML );
			printTransactionResults($response, 'Authorize For CaptureSelective', $merchProfileId);
			$txnIdCs [0] = $response['TransactionId'];
			$capDiffData = new CaptureDifferenceData();
			$capDiffData->TransactionId = $txnIdCs;
			if (Settings::IndustryType == 'Restaurant'){
				$capDiffData->TipAmount = '2.00';
				$capDiffData->Amount = $response->Amount + $capDiffData->TipAmount;
			}
			$capDiffData->Amount = '2.00';
			$capDiffXML = buildCaptureSelectiveXML($capDiffData);
			$txnIdsXML = buildTxnIdsXML($txnIdCs);
			$response2 = $client->captureSelective($txnIdsXML, $capDiffXML, null);
			printBatchResults($response2, $merchProfileId);
		}
		if($_bcs['Operations']['CaptureAll']  == 'true'  && $_bcs['AutoBatch'] == 'false' )
		{
			$response2 = $client->captureAll(null, null);
			printBatchResults($response2, $merchProfileId);
		}

		/*
		 *
		 * Undo funds based on previous transactionId
		 * May also include , $amount) where $amount is what you want to return e.g. 10.00
		 *
		 */
		if($_bcs['Operations']['Undo']  == 'true')
		{
			// First send an Authorize to Void
			$response3 = $client->authorize( $bcpTxnXML );
			printTransactionResults($response3, 'Authorize for Undo', $merchProfileId);
			// Now send the Void using TransactionId from above transaction response
			$undoDiffData = new UndoDifferenceData();
			$undoDiffData->TransactionId = $response3['TransactionId'];
			$undoDiffData->Amount = '2.00';
			$undoDiffXML = buildUndoXML($undoDiffData);
			$response4 = $client->undo($undoDiffXML, null);
			printTransactionResults($response4, 'Undo', $merchProfileId);
		}

		/*
		 *
		 * Authorize and Capture using credit card
		 * Note: in a terminal capture environment AuthorizeAndCapture is only available for PINDebit transactions
		 */
		if($_bcs['Operations']['AuthAndCapture']  == 'true' && $_bcs['AutoBatch']  == 'true')
		{
			$response5 = $client->authorizeAndCapture( $bcpTxnXML );
			printTransactionResults($response5, 'AuthorizeAndCapture', $merchProfileId);
		}


		/*
		 *
		 * Return funds based on previous transactionId
		 * May also incluse , $amount) where $amount is what you want to return e.g. 10.00
		 *
		 */

		if($_bcs['Operations']['ReturnById']  == 'true' && $_bcs['AutoBatch']  == 'true')
		{
			// Note: You must provide an already captured Authorize TransactionId for ReturnById
			// Now send the Void using TransactionId from above transaction response
			$returnDiffData = new ReturnByIdDifferenceData();
			$returnDiffData->TransactionId = $response5['TransactionId'];
			$returnDiffData->Amount = '2.00';
			$returnDiffXML = buildReturnByIdXML($returnDiffData);
			$response6 = $client->returnByID($returnDiffXML);
			printTransactionResults($response6, 'ReturnById', $merchProfileId);
		}
		if($_bcs['Operations']['ReturnById'] == 'true' && $_bcs['AutoBatch']  == 'false')
		{
			// First send an Authorize to Capture
			$response3 = $client->authorize($bcpTxnXML);
			printTransactionResults($response3, 'Authorize For CaptureSelective', $merchProfileId);
			$txnIds [0] = $response3['TransactionId'];
			// Now send the Void using TransactionId from above transaction response
			
			$txnIdCs [0] = $response3['TransactionId'];
			$capDiffData = new CaptureDifferenceData();
			$capDiffData->TransactionId = $txnIdCs;
			if (Settings::IndustryType == 'Restaurant'){
				$capDiffData->TipAmount = '2.00';
				$capDiffData->Amount = $response->Amount + $capDiffData->TipAmount;
			}
			$capDiffData->Amount = '2.00';
			$capDiffXML = buildCaptureSelectiveXML($capDiffData);
			$txnIdsXML = buildTxnIdsXML($txnIdCs);
			$response2 = $client->captureSelective($txnIdsXML, $capDiffXML, null);
			printBatchResults($response4, $merchProfileId);

			// Note: You must provide an already captured Authorize TransactionId for ReturnById$returnDiffData = new ReturnByIdDifferenceData();
			$returnDiffData->TransactionId = $response3['TransactionId'];
			$returnDiffData->Amount = '2.00';
			$returnDiffXML = buildReturnByIdXML($returnDiffData);
			$response6 = $client->returnByID($returnDiffXML);
			printTransactionResults($response6, 'ReturnById After Capture', $merchProfileId);
		}


		/*
		 *
		 * Return funds to a specified acocunt
		 * May also incluse , $amount) where $amount is what you want to return e.g. 10.00
		 *
		 */

		if( $_bcs['Operations']['ReturnUnlinked'] )
		{
			$response7 = $client->returnUnlinked($bcpTxnXML);
			printTransactionResults($response7, 'ReturnUnlinked', $merchProfileId);
		}
	}
}


?>