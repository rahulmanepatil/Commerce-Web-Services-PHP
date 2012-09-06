<?php
/**
 * CWSTransactionManagement class file
 * 
 */

class DateRange {
  public $EndDateTime; // dateTime
  public $StartDateTime; // dateTime
}

class PagingParameters {
  public $Page; // int
  public $PageSize; // int
}

class DataServicesUnavailableFault {
}

class DSBaseFault {
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
}

/*class Return {
  public $TransactionId; // string
  public $Addendum; // Addendum
  public $TransactionDateTime; // string
}*/


class TransactionClassTypePair {
  public $TransactionClass; // string
  public $TransactionType; // string
}

class FamilyInformation {
  public $FamilyId; // guid
  public $FamilySequenceCount; // int
  public $FamilySequenceNumber; // int
  public $FamilyState; // TransactionState
  public $NetAmount; // decimal
}

class TransactionInformation {
  public $Amount; // decimal
  public $ApprovalCode; // string
  public $BankcardData; // BankcardData
  public $BatchId; // string
  public $CaptureDateTime; // dateTime
  public $CaptureState; // CaptureState
  public $CaptureStatusMessage; // string
  public $CapturedAmount; // decimal
  public $CustomerId; // string
  public $ElectronicCheckData; // ElectronicCheckData
  public $IsAcknowledged; // BooleanParameter
  public $MaskedPAN; // string
  public $MerchantProfileId; // string
  public $OriginatorTransactionId; // string
  public $Reference; // string
  public $ServiceId; // string
  public $ServiceKey; // string
  public $ServiceTransactionId; // string
  public $Status; // Status
  public $StoredValueData; // StoredValueData
  public $TransactionClassTypePair; // TransactionClassTypePair
  public $TransactionId; // string
  public $TransactionState; // TransactionState
  public $TransactionStatusCode; // string
  public $TransactionTimestamp; // dateTime
}

class BankcardData {
  public $AVSResult; // AVSResult
  public $CVResult; // CVResult
  public $CardType; // TypeCardType
  public $MaskedPAN; // string
  public $OrderId; // string
}

class ElectronicCheckData {
  public $CheckNumber; // string
  public $MaskedAccountNumber; // string
  public $TransactionType; // TransactionType
}

class BooleanParameter {
}

class StoredValueData {
  public $CVResult; // CVResult
  public $CardRestrictionValue; // string
  public $CardStatus; // CardStatus
  public $NewBalance; // decimal
  public $OrderId; // string
  public $PreviousBalance; // decimal
}

class SummaryDetail {
  public $FamilyInformation; // FamilyInformation
  public $TransactionInformation; // TransactionInformation
}

class ElectronicCheckQueryRejectedParameters {
  public $QueryDateRange; // DateRange
  public $QueryDateType; // TypeDateType
  public $ServiceId; // string
}

class QueryRejectedParameters {
  public $Addendum; // Addendum
}

class TypeDateType {
}

class QueryBatch {
  public $sessionToken; // string
  public $queryBatchParameters; // QueryBatchParameters
  public $pagingParameters; // PagingParameters
}

class QueryBatchParameters {
  public $BatchDateRange; // DateRange
  public $BatchIds; // ArrayOfstring
  public $MerchantProfileIds; // ArrayOfstring
  public $ServiceKeys; // ArrayOfstring
  public $TransactionIds; // ArrayOfstring
}

class QueryBatchResponse {
  public $QueryBatchResult; // ArrayOfBatchDetailData
}

class BatchDetailData {
  public $BatchCaptureDate; // dateTime
  public $BatchId; // string
  public $BatchSummaryData; // TransactionSummaryData
  public $CaptureState; // CaptureState
  public $Description; // string
  public $SummaryData; // SummaryData
  public $TransactionIds; // ArrayOfstring
}

class QueryTransactionFamilies {
  public $sessionToken; // string
  public $queryTransactionsParameters; // QueryTransactionsParameters
  public $pagingParameters; // PagingParameters
}

class QueryTransactionsParameters {
  public $Amounts; // ArrayOfdecimal
  public $ApprovalCodes; // ArrayOfstring
  public $BatchIds; // ArrayOfstring
  public $CaptureDateRange; // DateRange
  public $CaptureStates; // ArrayOfCaptureState
  public $CardTypes; // ArrayOfTypeCardType
  public $IsAcknowledged; // BooleanParameter
  public $MerchantProfileIds; // ArrayOfstring
  public $OrderNumbers; // ArrayOfstring
  public $QueryType; // QueryType
  public $ServiceIds; // ArrayOfstring
  public $ServiceKeys; // ArrayOfstring
  public $TransactionClassTypePairs; // ArrayOfTransactionClassTypePair
  public $TransactionDateRange; // DateRange
  public $TransactionIds; // ArrayOfstring
  public $TransactionStates; // ArrayOfTransactionState
}

class QueryType {
}

class QueryTransactionFamiliesResponse {
  public $QueryTransactionFamiliesResult; // ArrayOfFamilyDetail
}

class FamilyDetail {
  public $BatchId; // string
  public $CaptureDateTime; // dateTime
  public $CapturedAmount; // decimal
  public $CustomerId; // string
  public $FamilyId; // guid
  public $FamilyState; // TransactionState
  public $LastAuthorizedAmount; // decimal
  public $MerchantProfileId; // string
  public $NetAmount; // decimal
  public $ServiceKey; // string
  public $TransactionIds; // ArrayOfstring
  public $TransactionMetaData; // ArrayOfTransactionMetaData
}

// This was not generated but needed for QueryFamily 
class TransactionMetaData {
	public $Amount;   // Decimal
	public $CardType; // TypeCardType
	public $MaskedPAN; // String
	public $SequenceNumber; // int
	public $ServiceId; // String
	public $TransactionClassPair; // TransactionClassPair object
	public $TransactionDateTime; // DateTime
	public $TransactionId; //string
	public $TransactionState; // String
	public $WorkflowId; //string  
}

// This was not generated but needed for TransactionMetaData
class TransactionClassPair {
	public $TransactionClass; // string
	public $TransactionType; // string
}

class QueryTransactionsDetail {
  public $sessionToken; // string
  public $queryTransactionsParameters; // QueryTransactionsParameters
  public $transactionDetailFormat; // TransactionDetailFormat
  public $includeRelated; // boolean
  public $pagingParameters; // PagingParameters
}

class TransactionDetailFormat {
}

class QueryTransactionsDetailResponse {
  public $QueryTransactionsDetailResult; // ArrayOfTransactionDetail
}

// This class was not generated but needed of QueryTransactionsDetailResponse
class TransactionDetail {
	public $CompleteTransaction; // The entire CWSTransaction or SerializedCWS Format
	public $FamilyInformation; // Info about the transaction relative to related transactions
	public $TransactionInformation; // High-level information about the transaction
}

// This class was not generated but needed for TransactionDetail
class CompleteTransaction {
	public $CWSTransaction; // The complete transaction using the CWS Object model
	public $SerializedTransaction; // string
}

// This class was not generated but needed for CompleteTransaction
class CWSTransaction {
	public $ApplicationData; //ApplicationData
	public $MerchantProfileMerchantData; // MerchantProfileMerchantData
	public $Metadata; // Maps to TransactionMetaData
	public $Response; // Response
	public $Transaction; // Transaction
}

class QueryTransactionsSummary {
  public $sessionToken; // string
  public $queryTransactionsParameters; // QueryTransactionsParameters
  public $includeRelated; // boolean
  public $pagingParameters; // PagingParameters
}

class QueryTransactionsSummaryResponse {
  public $QueryTransactionsSummaryResult; // ArrayOfSummaryDetail
}

class QueryRejectedSummary {
  public $sessionToken; // string
  public $queryRejectedParameters; // QueryRejectedParameters
  public $pagingParameters; // PagingParameters
}

class QueryRejectedSummaryResponse {
  public $QueryRejectedSummaryResult; // QueryResponse
}

class QueryRejectedDetail {
  public $sessionToken; // string
  public $queryRejectedParameters; // QueryRejectedParameters
  public $pagingParameters; // PagingParameters
}

class QueryRejectedDetailResponse {
  public $QueryRejectedDetailResult; // QueryResponse
}


class TMSUnknownServiceKeyFault {
}

class TMSBaseFault {
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
}

class TMSTransactionFailedFault {
}

class TMSOperationNotSupportedFault {
}

class TMSUnavailableFault {
}

class CWSTransactionManagement extends SoapClient {

 private static $classmap = array( 
                                    'DateRange' => 'DateRange',
                                    'PagingParameters' => 'PagingParameters',
                                    'DataServicesUnavailableFault' => 'DataServicesUnavailableFault',
                                    'DSBaseFault' => 'DSBaseFault',
                                    'char' => 'char',
                                    'duration' => 'duration',
                                    'guid' => 'guid',
                                    'Response' => 'Response',
                                    'Status' => 'Status',
                                    'ServiceTransactionDateTime' => 'ServiceTransactionDateTime',
                                    'Addendum' => 'Addendum',
                                    'Unmanaged' => 'Unmanaged',
                                    'CaptureState' => 'CaptureState',
                                    'TransactionState' => 'TransactionState',
                                    'SummaryData' => 'SummaryData',
                                    'SummaryTotals' => 'SummaryTotals',
                                    'IndustryType' => 'IndustryType',
                                    'CVResult' => 'CVResult',
                                    'Return' => 'Return',
                                    'TransactionTenderData' => 'TransactionTenderData',
                                    'TypeISOCountryCodeA3' => 'TypeISOCountryCodeA3',
                                    'CVDataProvided' => 'CVDataProvided',
                                    'Undo' => 'Undo',
                                    'Capture' => 'Capture',
                                    'CustomerInfo' => 'CustomerInfo',
                                    'NameInfo' => 'NameInfo',
                                    'AddressInfo' => 'AddressInfo',
                                    'Manage' => 'Manage',
                                    'TransactionData' => 'TransactionData',
                                    'TypeISOCurrencyCodeA3' => 'TypeISOCurrencyCodeA3',
                                    'PINlessDebitData' => 'PINlessDebitData',
                                    'BillPayServiceData' => 'BillPayServiceData',
                                    'PayeeData' => 'PayeeData',
                                    'Transaction' => 'Transaction',
                                    'TransactionCustomerData' => 'TransactionCustomerData',
                                    'PersonalInfo' => 'PersonalInfo',
                                    'DriversLicense' => 'DriversLicense',
                                    'TypeStateProvince' => 'TypeStateProvince',
                                    'TransactionReportingData' => 'TransactionReportingData',
                                    'EntryMode' => 'EntryMode',
                                    'AlternativeMerchantData' => 'AlternativeMerchantData',
                                    'Adjust' => 'Adjust',
                                    'STSUnavailableFault' => 'STSUnavailableFault',
                                    'BaseFault' => 'BaseFault',
                                    'ExpiredTokenFault' => 'ExpiredTokenFault',
                                    'InvalidTokenFault' => 'InvalidTokenFault',
                                    'AuthenticationFault' => 'AuthenticationFault',
                                    'LockedByAdminFault' => 'LockedByAdminFault',
                                    'PasswordExpiredFault' => 'PasswordExpiredFault',
                                    'BadAttemptThresholdExceededFault' => 'BadAttemptThresholdExceededFault',
                                    'OneTimePasswordFault' => 'OneTimePasswordFault',
                                    'SendEmailFault' => 'SendEmailFault',
                                    'GeneratePasswordFault' => 'GeneratePasswordFault',
                                    'PasswordInvalidFault' => 'PasswordInvalidFault',
                                    'UserNotFoundFault' => 'UserNotFoundFault',
                                    'InvalidEmailFault' => 'InvalidEmailFault',
                                    'ClaimMetaData' => 'ClaimMetaData',
                                    'ClaimNotFoundFault' => 'ClaimNotFoundFault',
                                    'AuthorizationFault' => 'AuthorizationFault',
                                    'RelyingPartyNotAssociatedToSecurityDomainFault' => 'RelyingPartyNotAssociatedToSecurityDomainFault',
                                    'SystemFault' => 'SystemFault',
                                    'NonRenewableTokenFault' => 'NonRenewableTokenFault',
                                    'ClaimMappingsNotFoundFault' => 'ClaimMappingsNotFoundFault',
                                    'SignOnWithToken' => 'SignOnWithToken',
                                    'SignOnWithTokenResponse' => 'SignOnWithTokenResponse',
                                    'GetServiceInformation' => 'GetServiceInformation',
                                    'GetServiceInformationResponse' => 'GetServiceInformationResponse',
                                    'ServiceInformation' => 'ServiceInformation',
                                    'BankcardService' => 'BankcardService',
                                    'BankcardServiceAVSData' => 'BankcardServiceAVSData',
                                    'Operations' => 'Operations',
                                    'CloseBatch' => 'CloseBatch',
                                    'PurchaseCardLevel' => 'PurchaseCardLevel',
                                    'Tenders' => 'Tenders',
                                    'PINDebitReturnSupportType' => 'PINDebitReturnSupportType',
                                    'CreditAuthorizeSupportType' => 'CreditAuthorizeSupportType',
                                    'QueryRejectedSupportType' => 'QueryRejectedSupportType',
                                    'PinDebitUndoSupportType' => 'PinDebitUndoSupportType',
                                    'BatchAssignmentSupport' => 'BatchAssignmentSupport',
                                    'CreditReturnSupportType' => 'CreditReturnSupportType',
                                    'TrackDataSupportType' => 'TrackDataSupportType',
                                    'CreditReversalSupportType' => 'CreditReversalSupportType',
                                    'PartialApprovalSupportType' => 'PartialApprovalSupportType',
                                    'ElectronicCheckingService' => 'ElectronicCheckingService',
                                    'StoredValueService' => 'StoredValueService',
                                    'Workflow' => 'Workflow',
                                    'WorkflowService' => 'WorkflowService',
                                    'SaveApplicationData' => 'SaveApplicationData',
                                    'ApplicationData' => 'ApplicationData',
                                    'ApplicationLocation' => 'ApplicationLocation',
                                    'HardwareType' => 'HardwareType',
                                    'PINCapability' => 'PINCapability',
                                    'ReadCapability' => 'ReadCapability',
                                    'EncryptionType' => 'EncryptionType',
                                    'SaveApplicationDataResponse' => 'SaveApplicationDataResponse',
                                    'GetApplicationData' => 'GetApplicationData',
                                    'GetApplicationDataResponse' => 'GetApplicationDataResponse',
                                    'DeleteApplicationData' => 'DeleteApplicationData',
                                    'DeleteApplicationDataResponse' => 'DeleteApplicationDataResponse',
                                    'IsMerchantProfileInitialized' => 'IsMerchantProfileInitialized',
                                    'TenderType' => 'TenderType',
                                    'IsMerchantProfileInitializedResponse' => 'IsMerchantProfileInitializedResponse',
                                    'GetMerchantProfiles' => 'GetMerchantProfiles',
                                    'GetMerchantProfilesResponse' => 'GetMerchantProfilesResponse',
                                    'MerchantProfile' => 'MerchantProfile',
                                    'MerchantProfileMerchantData' => 'MerchantProfileMerchantData',
                                    'TypeISOLanguageCodeA3' => 'TypeISOLanguageCodeA3',
                                    'AddressInfo' => 'AddressInfo',
                                    'TypeStateProvince' => 'TypeStateProvince',
                                    'TypeISOCountryCodeA3' => 'TypeISOCountryCodeA3',
                                    'BankcardMerchantData' => 'BankcardMerchantData',
                                    'IndustryType' => 'IndustryType',
                                    'ElectronicCheckingMerchantData' => 'ElectronicCheckingMerchantData',
                                    'StoredValueMerchantData' => 'StoredValueMerchantData',
                                    'MerchantProfileTransactionData' => 'MerchantProfileTransactionData',
                                    'BankcardTransactionDataDefaults' => 'BankcardTransactionDataDefaults',
                                    'TypeISOCurrencyCodeA3' => 'TypeISOCurrencyCodeA3',
                                    'CustomerPresent' => 'CustomerPresent',
                                    'EntryMode' => 'EntryMode',
                                    'RequestACI' => 'RequestACI',
                                    'RequestAdvice' => 'RequestAdvice',
                                    'GetMerchantProfileIds' => 'GetMerchantProfileIds',
                                    'GetMerchantProfileIdsResponse' => 'GetMerchantProfileIdsResponse',
                                    'GetMerchantProfilesByProfileId' => 'GetMerchantProfilesByProfileId',
                                    'GetMerchantProfilesByProfileIdResponse' => 'GetMerchantProfilesByProfileIdResponse',
                                    'GetMerchantProfile' => 'GetMerchantProfile',
                                    'GetMerchantProfileResponse' => 'GetMerchantProfileResponse',
                                    'DeleteMerchantProfile' => 'DeleteMerchantProfile',
                                    'DeleteMerchantProfileResponse' => 'DeleteMerchantProfileResponse',
                                    'SaveMerchantProfiles' => 'SaveMerchantProfiles',
                                    'SaveMerchantProfilesResponse' => 'SaveMerchantProfilesResponse',
                                    'SignOnWithUsernamePasswordForServiceKey' => 'SignOnWithUsernamePasswordForServiceKey',
                                    'SignOnWithUsernamePasswordForServiceKeyResponse' => 'SignOnWithUsernamePasswordForServiceKeyResponse',
                                    'ResetPasswordForServiceKey' => 'ResetPasswordForServiceKey',
                                    'ResetPasswordForServiceKeyResponse' => 'ResetPasswordForServiceKeyResponse',
                                    'ChangePasswordForServiceKey' => 'ChangePasswordForServiceKey',
                                    'ChangePasswordForServiceKeyResponse' => 'ChangePasswordForServiceKeyResponse',
                                    'ChangeUsernameForServiceKey' => 'ChangeUsernameForServiceKey',
                                    'ChangeUsernameForServiceKeyResponse' => 'ChangeUsernameForServiceKeyResponse',
                                    'ChangeEmailForServiceKey' => 'ChangeEmailForServiceKey',
                                    'ChangeEmailForServiceKeyResponse' => 'ChangeEmailForServiceKeyResponse',
                                    'GetPasswordExpirationForServiceKey' => 'GetPasswordExpirationForServiceKey',
                                    'GetPasswordExpirationForServiceKeyResponse' => 'GetPasswordExpirationForServiceKeyResponse',
                                    'ValidateMerchantProfile' => 'ValidateMerchantProfile',
                                    'ValidateMerchantProfileResponse' => 'ValidateMerchantProfileResponse',
                                    'GetAllClaims' => 'GetAllClaims',
                                    'GetAllClaimsResponse' => 'GetAllClaimsResponse',
                                    'GetClaims' => 'GetClaims',
                                    'GetClaimsResponse' => 'GetClaimsResponse',
                                    'Renew' => 'Renew',
                                    'RenewResponse' => 'RenewResponse',
                                    'SignOnAndAddClaims' => 'SignOnAndAddClaims',
                                    'SignOnAndAddClaimsResponse' => 'SignOnAndAddClaimsResponse',
                                    'DelegatedSignOn' => 'DelegatedSignOn',
                                    'DelegatedSignOnResponse' => 'DelegatedSignOnResponse',
                                    'FederatedSignOn' => 'FederatedSignOn',
                                    'FederatedSignOnResponse' => 'FederatedSignOnResponse',
                                    'FederatedSignOnAndAddClaims' => 'FederatedSignOnAndAddClaims',
                                    'FederatedSignOnAndAddClaimsResponse' => 'FederatedSignOnAndAddClaimsResponse',
                                    'BankcardTransactionResponse' => 'BankcardTransactionResponse',
                                    'BankcardCaptureResponse' => 'BankcardCaptureResponse',
                                    'TransactionSummaryData' => 'TransactionSummaryData',
                                    'Totals' => 'Totals',
                                    'TypeCardType' => 'TypeCardType',
                                    'PrepaidCard' => 'PrepaidCard',
                                    'AVSResult' => 'AVSResult',
                                    'AddressResult' => 'AddressResult',
                                    'CountryResult' => 'CountryResult',
                                    'StateResult' => 'StateResult',
                                    'PostalCodeResult' => 'PostalCodeResult',
                                    'PhoneResult' => 'PhoneResult',
                                    'CardholderNameResult' => 'CardholderNameResult',
                                    'CityResult' => 'CityResult',
                                    'Resubmit' => 'Resubmit',
                                    'AdviceResponse' => 'AdviceResponse',
                                    'CommercialCardResponse' => 'CommercialCardResponse',
                                    'BankcardReturn' => 'BankcardReturn',
                                    'BankcardTenderData' => 'BankcardTenderData',
                                    'CardData' => 'CardData',
                                    'CardSecurityData' => 'CardSecurityData',
                                    'AVSData' => 'AVSData',
                                    'EcommerceSecurityData' => 'EcommerceSecurityData',
                                    'TokenIndicator' => 'TokenIndicator',
                                    'BankcardUndo' => 'BankcardUndo',
                                    'PINDebitUndoReason' => 'PINDebitUndoReason',
                                    'BankcardCapture' => 'BankcardCapture',
                                    'Level2Data' => 'Level2Data',
                                    'TaxExempt' => 'TaxExempt',
                                    'IsTaxExempt' => 'IsTaxExempt',
                                    'Tax' => 'Tax',
                                    'ItemizedTax' => 'ItemizedTax',
                                    'TypeTaxType' => 'TypeTaxType',
                                    'LineItemDetail' => 'LineItemDetail',
                                    'TypeUnitOfMeasure' => 'TypeUnitOfMeasure',
                                    'ChargeType' => 'ChargeType',
                                    'BankcardTransactionData' => 'BankcardTransactionData',
                                    'ManagedBilling' => 'ManagedBilling',
                                    'ManagedBillingInstallments' => 'ManagedBillingInstallments',
                                    'Interval' => 'Interval',
                                    'IIASData' => 'IIASData',
                                    'IIASDesignation' => 'IIASDesignation',
                                    'BankcardTransaction' => 'BankcardTransaction',
                                    'BankcardApplicationConfigurationData' => 'BankcardApplicationConfigurationData',
                                    'ApplicationLocation' => 'ApplicationLocation',
                                    'HardwareType' => 'HardwareType',
                                    'PINCapability' => 'PINCapability',
                                    'ReadCapability' => 'ReadCapability',
                                    'BillPayment' => 'BillPayment',
                                    'RequestCommercialCard' => 'RequestCommercialCard',
                                    'ExistingDebt' => 'ExistingDebt',
                                    'RequestACI' => 'RequestACI',
                                    'RequestAdvice' => 'RequestAdvice',
                                    'AccountType' => 'AccountType',
                                    'CustomerPresent' => 'CustomerPresent',
                                    'GoodsType' => 'GoodsType',
                                    'InternetTransactionData' => 'InternetTransactionData',
                                    'PartialApprovalSupportType' => 'PartialApprovalSupportType',
                                    'ElectronicCheckingTenderData' => 'ElectronicCheckingTenderData',
                                    'CheckData' => 'CheckData',
                                    'CheckCountryCode' => 'CheckCountryCode',
                                    'OwnerType' => 'OwnerType',
                                    'UseType' => 'UseType',
                                    'ElectronicCheckingCaptureResponse' => 'ElectronicCheckingCaptureResponse',
                                    'ElectronicCheckingTransactionResponse' => 'ElectronicCheckingTransactionResponse',
                                    'ReturnInformation' => 'ReturnInformation',
                                    'ElectronicCheckingTransactionData' => 'ElectronicCheckingTransactionData',
                                    'ElectronicCheckingCustomerData' => 'ElectronicCheckingCustomerData',
                                    'ElectronicCheckingTransaction' => 'ElectronicCheckingTransaction',
                                    'SECCode' => 'SECCode',
                                    'ServiceType' => 'ServiceType',
                                    'TransactionType' => 'TransactionType',
                                    'StoredValueReturn' => 'StoredValueReturn',
                                    'StoredValueCapture' => 'StoredValueCapture',
                                    'StoredValueTenderData' => 'StoredValueTenderData',
                                    'CardData' => 'CardData',
                                    'CardSecurityData' => 'CardSecurityData',
                                    'ConsumerIdentification' => 'ConsumerIdentification',
                                    'IdType' => 'IdType',
                                    'IdEntryMode' => 'IdEntryMode',
                                    'StoredValueActivateTenderData' => 'StoredValueActivateTenderData',
                                    'VirtualCardData' => 'VirtualCardData',
                                    'StoredValueBalanceTransferTenderData' => 'StoredValueBalanceTransferTenderData',
                                    'StoredValueManage' => 'StoredValueManage',
                                    'CardStatus' => 'CardStatus',
                                    'OperationType' => 'OperationType',
                                    'StoredValueTransaction' => 'StoredValueTransaction',
                                    'StoredValueTransactionData' => 'StoredValueTransactionData',
                                    'StoredValueTransactionResponse' => 'StoredValueTransactionResponse',
                                    'StoredValueCaptureResponse' => 'StoredValueCaptureResponse',
                                    'ElectronicCheckingRejectedSummaryResponse' => 'ElectronicCheckingRejectedSummaryResponse',
                                    'QueryResponse' => 'QueryResponse',
                                    'ElectronicCheckingRejectedDetailResponse' => 'ElectronicCheckingRejectedDetailResponse',
                                    'RejectedSummary' => 'RejectedSummary',
                                    'TransactionDetail' => 'TransactionDetail',
                                    'CompleteTransaction' => 'CompleteTransaction',
                                    'CWSTransaction' => 'CWSTransaction',
                                    'TransactionMetaData' => 'TransactionMetaData',
                                    'TransactionClassTypePair' => 'TransactionClassTypePair',
                                    'FamilyInformation' => 'FamilyInformation',
                                    'TransactionInformation' => 'TransactionInformation',
                                    'BankcardData' => 'BankcardData',
                                    'ElectronicCheckData' => 'ElectronicCheckData',
                                    'BooleanParameter' => 'BooleanParameter',
                                    'StoredValueData' => 'StoredValueData',
                                    'SummaryDetail' => 'SummaryDetail',
                                    'ElectronicCheckQueryRejectedParameters' => 'ElectronicCheckQueryRejectedParameters',
                                    'QueryRejectedParameters' => 'QueryRejectedParameters',
                                    'TypeDateType' => 'TypeDateType',
                                    'QueryBatch' => 'QueryBatch',
                                    'QueryBatchParameters' => 'QueryBatchParameters',
                                    'QueryBatchResponse' => 'QueryBatchResponse',
                                    'BatchDetailData' => 'BatchDetailData',
                                    'QueryTransactionFamilies' => 'QueryTransactionFamilies',
                                    'QueryTransactionsParameters' => 'QueryTransactionsParameters',
                                    'QueryType' => 'QueryType',
                                    'QueryTransactionFamiliesResponse' => 'QueryTransactionFamiliesResponse',
                                    'FamilyDetail' => 'FamilyDetail',
                                    'QueryTransactionsDetail' => 'QueryTransactionsDetail',
                                    'TransactionDetailFormat' => 'TransactionDetailFormat',
                                    'QueryTransactionsDetailResponse' => 'QueryTransactionsDetailResponse',
                                    'QueryTransactionsSummary' => 'QueryTransactionsSummary',
                                    'QueryTransactionsSummaryResponse' => 'QueryTransactionsSummaryResponse',
                                    'QueryRejectedSummary' => 'QueryRejectedSummary',
                                    'QueryRejectedSummaryResponse' => 'QueryRejectedSummaryResponse',
                                    'QueryRejectedDetail' => 'QueryRejectedDetail',
                                    'QueryRejectedDetailResponse' => 'QueryRejectedDetailResponse',
                                    'BankcardTransactionDataPro' => 'BankcardTransactionDataPro',
                                    'BankcardTransactionPro' => 'BankcardTransactionPro',
                                    'BankcardInterchangeData' => 'BankcardInterchangeData',
                                    'BankcardTransactionResponsePro' => 'BankcardTransactionResponsePro',
                                    'BankcardReturnPro' => 'BankcardReturnPro',
                                    'BankcardCapturePro' => 'BankcardCapturePro',
                                    'BankcardCaptureResponsePro' => 'BankcardCaptureResponsePro',
                                    'TMSUnknownServiceKeyFault' => 'TMSUnknownServiceKeyFault',
                                    'TMSBaseFault' => 'TMSBaseFault',
                                    'TMSTransactionFailedFault' => 'TMSTransactionFailedFault',
                                    'TMSOperationNotSupportedFault' => 'TMSOperationNotSupportedFault',
                                    'TMSUnavailableFault' => 'TMSUnavailableFault',
                                    'PingResponse' => 'PingResponse',
                                    'Ping' => 'Ping',
                                    'PingResponse' => 'PingResponse',
                                   );

  public function CWSTransactionManagement($wsdl = "", $options = array()) {
    foreach(self::$classmap as $key => $value) {
      if(!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = $value;
      }
    }
    parent::__construct($wsdl, $options);
  }

  /**
   *  
   *
   * @param Ping $parameters
   * @return PingResponse
   */
  public function Ping(Ping $parameters) {
    return $this->__soapCall('Ping', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/DataServices',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param QueryBatch $parameters
   * @return QueryBatchResponse
   */
  public function QueryBatch(QueryBatch $parameters) {
    return $this->__soapCall('QueryBatch', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/DataServices',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param QueryTransactionFamilies $parameters
   * @return QueryTransactionFamiliesResponse
   */
  public function QueryTransactionFamilies(QueryTransactionFamilies $parameters) {
    return $this->__soapCall('QueryTransactionFamilies', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/DataServices',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param QueryTransactionsDetail $parameters
   * @return QueryTransactionsDetailResponse
   */
  public function QueryTransactionsDetail(QueryTransactionsDetail $parameters) {
    return $this->__soapCall('QueryTransactionsDetail', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/DataServices',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param QueryTransactionsSummary $parameters
   * @return QueryTransactionsSummaryResponse
   */
  public function QueryTransactionsSummary(QueryTransactionsSummary $parameters) {
    return $this->__soapCall('QueryTransactionsSummary', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/DataServices',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param QueryRejectedSummary $parameters
   * @return QueryRejectedSummaryResponse
   */
  public function QueryRejectedSummary(QueryRejectedSummary $parameters) {
    return $this->__soapCall('QueryRejectedSummary', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/DataServices',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param QueryRejectedDetail $parameters
   * @return QueryRejectedDetailResponse
   */
  public function QueryRejectedDetail(QueryRejectedDetail $parameters) {
    return $this->__soapCall('QueryRejectedDetail', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/DataServices',
            'soapaction' => ''
           )
      );
  }

}

?>
