<?php
/**
 * CwsTransactionProcessing class file
 * 
 */

class AccountType {
}

class Acknowledge {
  public $sessionToken; // string
  public $transactionId; // string
  public $applicationProfileId; // string
  public $workflowId; // string
}

class AcknowledgeResponse {
  public $AcknowledgeResult; // Response
}

class Addendum {
  public $Unmanaged; // Unmanaged
}

//class AddressInfo {
//  public $Street1; // string
//  public $Street2; // string
//  public $City; // string
//  public $StateProvince; // string
//  public $PostalCode; // string
//  public $CountryCode; // TypeISOCountryCodeA3
//}

class AddressResult {
}

class Adjust {
  public $sessionToken; // string
  public $differenceData; // Adjust
  public $applicationProfileId; // string
  public $workflowId; // string
}

class AdjustDifferenceData {
  public $Amount; // decimal
  public $TransactionId; // string
  public $Addendum; // Addendum
  public $TipAmount; // decimal
}

class AdjustResponse {
  public $AdjustResult; // Response
}

class AdviceResponse {
}

class AlternativeMerchantData {
  public $CustomerServiceInternet; // string
  public $CustomerServicePhone; // string
  public $Description; // string
  public $SIC; // string
  public $Address; // AddressInfo
  public $MerchantId; // string
  public $Name; // string
}

class Txn_ApplicationLocation {
}

class Authorize {
  public $sessionToken; // string
  public $transaction; // Transaction
  public $applicationProfileId; // string
  public $merchantProfileId; // string
  public $workflowId; // string

}

class AuthorizeAndCapture {
  public $sessionToken; // string
  public $transaction; // Transaction
  public $applicationProfileId; // string
  public $merchantProfileId; // string
  public $workflowId; // string
}

class AuthorizeAndCaptureResponse {
  public $AuthorizeAndCaptureResult; // Response
}
class AuthorizeResponse {
	public $AuthorizeResult; // Response
}

class AVSData {
  public $CardholderName; // string
  public $Street; // string
  public $City; // string
  public $StateProvince; // string
  public $PostalCode; // string
  public $Country; // TypeISOCountryCodeA3
  public $Phone; // string
  public $Email; // string
}

class AVSResult {
  public $ActualResult; // string
  public $AddressResult; // AddressResult
  public $CountryResult; // CountryResult
  public $StateResult; // StateResult
  public $PostalCodeResult; // PostalCodeResult
  public $PhoneResult; // PhoneResult
  public $CardholderNameResult; // CardholderNameResult
  public $CityResult; // CityResult
}

class BankcardApplicationConfigurationData {
  public $ApplicationAttended; // boolean
  public $ApplicationLocation; // ApplicationLocation
  public $HardwareType; // HardwareType
  public $PINCapability; // PINCapability
  public $ReadCapability; // ReadCapability
}

class BankcardCapture {
  public $Amount; // decimal
  public $ChargeType; // ChargeType
  public $ShipDate; // dateTime
  public $TipAmount; // decimal
}

class BankcardCapturePro {
  public $MultiplePartialCapture; // boolean
  public $Level2Data; // Level2Data
  public $LineItemDetails; // ArrayOfLineItemDetail
  public $ShippingData; // CustomerInfo
}

class BankcardCaptureResponse {
  public $BatchId; // string
  public $IndustryType; // IndustryType
  public $TransactionSummaryData; // TransactionSummaryData
  public $PrepaidCard; // PrepaidCard
}

class BankcardCaptureResponsePro {
}

class BankcardInterchangeData {
  public $BillPayment; // BillPayment
  public $RequestCommercialCard; // RequestCommercialCard
  public $ExistingDebt; // ExistingDebt
  public $RequestACI; // RequestACI
  public $TotalNumberOfInstallments; // int
  public $CurrentInstallmentNumber; // int
  public $RequestAdvice; // RequestAdvice
}

class BankcardReturn {
  public $Amount; // decimal
  public $TenderData; // BankcardTenderData
}

class BankcardReturnPro {
  public $LineItemDetails; // ArrayOfLineItemDetail
}

class BankcardTenderData {
  public $CardData; // CardData
  public $CardSecurityData; // CardSecurityData
  public $EcommerceSecurityData; // EcommerceSecurityData
}

class BankcardTransaction {
  public $ApplicationConfigurationData; // BankcardApplicationConfigurationData
  public $TenderData; // BankcardTenderData
  public $TransactionData; // BankcardTransactionData
}

class BankcardTransactionData {
  public $AccountType; // AccountType
  public $AlternativeMerchantData; // AlternativeMerchantData
  public $ApprovalCode; // string
  public $CashBackAmount; // decimal
  public $CustomerPresent; // CustomerPresent
  public $EmployeeId; // string
  public $EntryMode; // EntryMode
  public $GoodsType; // GoodsType
  public $InternetTransactionData; // InternetTransactionData
  public $InvoiceNumber; // string
  public $OrderNumber; // string
  public $IsPartialShipment; // boolean
  public $SignatureCaptured; // boolean
  public $FeeAmount; // decimal
  public $TerminalId; // string
  public $LaneId; // string
  public $TipAmount; // decimal
  public $BatchAssignment; // string
  public $PartialApprovalCapable; // PartialApprovalSupportType
  public $ScoreThreshold; // string
  public $IsQuasiCash; // boolean
  public $TransactionDateTime; // string - was not generated
}

class BankcardTransactionDataPro {
  public $ManagedBilling; // ManagedBilling
  public $Level2Data; // Level2Data
  public $LineItemDetails; // ArrayOfLineItemDetail
  public $PINlessDebitData; // PINlessDebitData
  public $IIASData; // IIASData
}

class BankcardTransactionPro {
  public $InterchangeData; // BankcardInterchangeData
}

class BankcardTransactionResponse {
  public $Amount; // decimal
  public $CardType; // TypeCardType
  public $FeeAmount; // decimal
  public $ApprovalCode; // string
  public $AVSResult; // AVSResult
  public $BatchId; // string
  public $CVResult; // CVResult
  public $CardLevel; // string
  public $DowngradeCode; // string
  public $MaskedPAN; // string
  public $PaymentAccountDataToken; // string
  public $RetrievalReferenceNumber; // string
  public $Resubmit; // Resubmit
  public $SettlementDate; // dateTime
  public $FinalBalance; // decimal
  public $OrderId; // string
  public $CashBackAmount; // decimal
  public $PrepaidCard; // PrepaidCard
}

class BankcardTransactionResponsePro {
  public $AdviceResponse; // AdviceResponse
  public $CommercialCardResponse; // CommercialCardResponse
  public $ReturnedACI; // string
}

class BankcardUndo {
  public $PINDebitReason; // PINDebitUndoReason
  public $TenderData; // BankcardTenderData
  public $ForceVoid; // boolean
}

class BillPayment {
}

class BillPayServiceData {
  public $CompanyName; // string
  public $CompanyAddress; // AddressInfo
}

class Capture {
  public $sessionToken; // string
  public $differenceData; // Capture
  public $applicationProfileId; // string
  public $workflowId; // string
}

class CaptureAll {
  public $sessionToken; // string
  public $differenceData; // ArrayOfCapture
  public $batchIds; // ArrayOfstring
  public $applicationProfileId; // string
  public $merchantProfileId; // string
  public $workflowId; // string
}

class CaptureAllAsync {
  public $sessionToken; // string
  public $differenceData; // ArrayOfCapture
  public $batchIds; // ArrayOfstring
  public $applicationProfileId; // string
  public $merchantProfileId; // string
  public $workflowId; // string
}

class CaptureAllAsyncResponse {
  public $CaptureAllAsyncResult; // Response
}

class CaptureAllResponse {
  public $CaptureAllResult; // ArrayOfResponse
}

class CaptureAuth {
	public $sessionToken; // string
	public $differenceData; // Capture
	public $applicationProfileId; // string
	public $workflowId; // string
}

class CaptureDifferenceData {
	public $TransactionId; // string
	public $Addendum; // Addendum
	public $TransactionDateTime; // dateTime
}

class CaptureResponse {
  public $CaptureResult; // Response
}

class CaptureSelective {
  public $sessionToken; // string
  public $transactionIds; // ArrayOfstring
  public $differenceData; // ArrayOfCapture
  public $applicationProfileId; // string
  public $workflowId; // string
}

class CaptureSelectiveAsync {
  public $sessionToken; // string
  public $transactionIds; // ArrayOfstring
  public $differenceData; // ArrayOfCapture
  public $applicationProfileId; // string
  public $workflowId; // string
}

class CaptureSelectiveAsyncResponse {
  public $CaptureSelectiveAsyncResult; // Response
}

class CaptureSelectiveResponse {
  public $CaptureSelectiveResult; // ArrayOfResponse
}

class CaptureState {
}

class CardData {
  public $CardType; // TypeCardType
  public $CardholderName; // string
  public $PAN; // string
  public $Expire; // string
  public $Track1Data; // string
  public $Track2Data; // string
}

class Txn_CardData {
  public $AccountNumber; // string
  public $Expire; // string
  public $Track1Data; // string
  public $Track2Data; // string
}

class CardholderNameResult {
}

class CardSecurityData {
  public $AVSData; // AVSData
  public $CVDataProvided; // CVDataProvided
  public $CVData; // string
  public $KeySerialNumber; // string
  public $PIN; // string
  public $IdentificationInformation; // string
}

class Txn_CardSecurityData {
  public $CVDataProvided; // CVDataProvided
  public $CVData; // string
}

class CardStatus {
}

class ChargeType {
}

class CheckCountryCode {
}

class CheckData {
  public $AccountNumber; // string
  public $CheckCountryCode; // CheckCountryCode
  public $CheckNumber; // string
  public $OwnerType; // OwnerType
  public $RoutingNumber; // string
  public $UseType; // UseType
}

class CityResult {
}

class CommercialCardResponse {
}

class ConsumerIdentification {
  public $IdType; // IdType
  public $IdData; // string
  public $IdEntryMode; // IdEntryMode
}

class CountryResult {
}

class CustomerInfo {
  public $Name; // NameInfo
  public $Address; // AddressInfo
  public $BusinessName; // string
  public $Phone; // string
  public $Fax; // string
  public $Email; // string
}

class CVDataProvided {
}

class CVResult {
}

class Txn_CWSBaseFault {
  public $BatchId; // string
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
  public $TransactionId; // string
  public $TransactionState; // TransactionState
}

class CWSConnectionFault {
}

class CWSDeserializationFault {
}

class CWSExtendedDataNotSupportedFault {
}

class CWSInvalidMessageFormatFault {
}

class CWSInvalidOperationFault {
}

class CWSInvalidServiceInformationFault {
}

class CWSOperationNotSupportedFault {
}

class CWSTransactionAlreadySettledFault {
}

class CWSTransactionFailedFault {
}

class CWSTransactionServiceUnavailableFault {
}

class DriversLicense {
  public $Number; // string
  public $State; // TypeStateProvince
  public $Track1; // string
  public $Track2; // string
}

class EcommerceSecurityData {
  public $TokenData; // string
  public $TokenIndicator; // TokenIndicator
  public $XID; // string
}

class ElectronicCheckingCaptureResponse {
  public $SummaryData; // SummaryData
}

class ElectronicCheckingCustomerData {
  public $AdditionalBillingData; // PersonalInfo
}

class ElectronicCheckingTenderData {
  public $CheckData; // CheckData
}

class ElectronicCheckingTransaction {
  public $TenderData; // ElectronicCheckingTenderData
  public $TransactionData; // ElectronicCheckingTransactionData
}

class ElectronicCheckingTransactionData {
  public $EffectiveDate; // dateTime
  public $IsRecurring; // boolean
  public $SECCode; // SECCode
  public $ServiceType; // ServiceType
  public $TransactionType; // TransactionType
}

class ElectronicCheckingTransactionResponse {
  public $ACHCapable; // boolean
  public $Amount; // decimal
  public $ApprovalCode; // string
  public $ModifiedAccountNumber; // string
  public $ModifiedRoutingNumber; // string
  public $PaymentAccountDataToken; // string
  public $ReturnInformation; // ReturnInformation
  public $SubmitDate; // dateTime
}

class ExistingDebt {
}

class GoodsType {
}

class IdEntryMode {
}

class IdType {
}

class IIASData {
  public $HealthcareAmount; // decimal
  public $ClinicOtherAmount; // decimal
  public $DentalAmount; // decimal
  public $PrescriptionAmount; // decimal
  public $VisionAmount; // decimal
  public $IIASDesignation; // IIASDesignation
}

class IIASDesignation {
}

class InternetTransactionData {
  public $IpAddress; // string
  public $SessionId; // string
}

class Interval {
}

class IsTaxExempt {
}

class ItemizedTax {
  public $Amount; // decimal
  public $Rate; // decimal
  public $Type; // TypeTaxType
}

class Level2Data {
  public $BaseAmount; // decimal
  public $CommodityCode; // string
  public $CompanyName; // string
  public $CustomerCode; // string
  public $DestinationCountryCode; // TypeISOCountryCodeA3
  public $DestinationPostal; // string
  public $Description; // string
  public $DiscountAmount; // decimal
  public $DutyAmount; // decimal
  public $FreightAmount; // decimal
  public $MiscHandlingAmount; // decimal
  public $OrderDate; // dateTime
  public $OrderNumber; // string
  public $RequesterName; // string
  public $ShipFromPostalCode; // string
  public $ShipmentId; // string
  public $TaxExempt; // TaxExempt
  public $Tax; // Tax
}

class LineItemDetail {
  public $Amount; // decimal
  public $CommodityCode; // string
  public $Description; // string
  public $DiscountAmount; // decimal
  public $DiscountIncluded; // boolean
  public $ProductCode; // string
  public $Quantity; // decimal
  public $Tax; // Tax
  public $TaxIncluded; // boolean
  public $UnitOfMeasure; // TypeUnitOfMeasure
  public $UnitPrice; // decimal
  public $UPC; // string
}

class Manage {
  public $TransactionId; // string
  public $Addendum; // Addendum
}

class ManageAccount {
  public $sessionToken; // string
  public $transaction; // Transaction
  public $applicationProfileId; // string
  public $merchantProfileId; // string
  public $workflowId; // string
}

class ManageAccountById {
  public $sessionToken; // string
  public $differenceData; // Manage
  public $applicationProfileId; // string
  public $workflowId; // string
}

class ManageAccountByIdResponse {
  public $ManageAccountByIdResult; // Response
}

class ManageAccountResponse {
  public $ManageAccountResult; // Response
}

class ManagedBilling {
  public $DownPayment; // decimal
  public $Installments; // ManagedBillingInstallments
  public $Interval; // Interval
  public $Period; // int
  public $StartDate; // dateTime
}

class ManagedBillingInstallments {
  public $Amount; // decimal
  public $Count; // int
}

class NameInfo {
  public $Title; // string
  public $First; // string
  public $Middle; // string
  public $Last; // string
  public $Suffix; // string
}

class OperationType {
}

class OwnerType {
}

class PayeeData {
  public $CompanyName; // string
  public $Phone; // string
  public $AccountNumber; // string
}

class PersonalInfo {
  public $Company; // string
  public $DateOfBirth; // dateTime
  public $DriversLicense; // DriversLicense
  public $EmployeeIdNumber; // string
  public $Gender; // string
  public $GovernmentIdNumber; // string
  public $MilitaryIdNumber; // string
  public $SocialSecurityNumber; // string
  public $TaxId; // string
}

class PhoneResult {
}

class PINDebitUndoReason {
}

class Ping {
}

class PingResult {
  public $PingResult; // PingResponse
}

class Txn_PingResponse {
  public $IsSuccess; // boolean
  public $Message; // string
}

class PINlessDebitData {
  public $BillPayServiceData; // BillPayServiceData
  public $PayeeData; // PayeeData
}

class PostalCodeResult {
}

class PrepaidCard {
}

class QueryAccount {
  public $sessionToken; // string
  public $transaction; // Transaction
  public $applicationProfileId; // string
  public $merchantProfileId; // string
  public $workflowId; // string
}

class QueryAccountResponse {
  public $QueryAccountResult; // Response
}

class RequestCommercialCard {
}

class RequestTransaction {
  public $sessionToken; // string
  public $merchantProfileId; // string
  public $tenderData; // TransactionTenderData
}

class RequestTransactionResponse {
  public $RequestTransactionResult; // ArrayOfResponse
}

class Response {
  public $Status; // Status
  public $StatusCode; // string
  public $StatusMessage; // string
  public $TransactionId; // string
  public $OriginatorTransactionId; // string
  public $ServiceTransactionId; // string
  public $ServiceTransactionDateTime; // ServiceTransactionDateTime
  public $Addendum; // Addendum
  public $CaptureState; // CaptureState
  public $TransactionState; // TransactionState
  public $IsAcknowledged; // boolean
  public $Reference; // string
}

class Resubmit {
}



class ReturnById {
  public $sessionToken; // string
  public $differenceData; // Return
  public $applicationProfileId; // string
  public $workflowId; // string
}

class ReturnByIdDifferenceData {
  public $TransactionId; // string
  public $Addendum; // Addendum
  public $TransactionDateTime; // dateTime
}

class ReturnByIdResponse {
  public $ReturnByIdResult; // Response
}

class ReturnInformation {
  public $ReturnCode; // string
  public $ReturnDate; // dateTime
  public $ReturnReason; // string
}

class ReturnUnlinked {
  public $sessionToken; // string
  public $transaction; // Transaction
  public $applicationProfileId; // string
  public $merchantProfileId; // string
  public $workflowId; // string
}

class ReturnUnlinkedResponse {
  public $ReturnUnlinkedResult; // Response
}

class SECCode {
}

class ServiceTransactionDateTime {
  public $Date; // string
  public $Time; // string
  public $TimeZone; // string
}

class ServiceType {
}

class StateResult {
}

class Status {
}

class StoredValueActivateTenderData {
  public $VirtualCardData; // VirtualCardData
}

class StoredValueBalanceTransferTenderData {
  public $SourceCardData; // CardData
  public $ConsumerIdentification; // ConsumerIdentification
}

class StoredValueCapture {
  public $Amount; // decimal
}

class StoredValueCaptureResponse {
  public $BatchId; // string
  public $SummaryData; // SummaryData
}

class StoredValueManage {
  public $Amount; // decimal
  public $SourceCardData; // CardData
  public $CardStatus; // CardStatus
  public $IsCashOut; // boolean
  public $OperationType; // OperationType
}

class StoredValueReturn {
  public $Amount; // decimal
}

class StoredValueTenderData {
  public $CardData; // CardData
  public $CardSecurityData; // CardSecurityData
  public $CardholderId; // string
  public $ConsumerIdentifications; // ArrayOfConsumerIdentification
}

class StoredValueTransaction {
  public $TenderData; // StoredValueTenderData
  public $TransactionData; // StoredValueTransactionData
}

class StoredValueTransactionData {
  public $EmployeeId; // string
  public $IndustryType; // IndustryType
  public $TipAmount; // decimal
  public $TenderCurrencyCode; // TypeISOCurrencyCodeA3
  public $CardRestrictionValue; // string
  public $EntryMode; // EntryMode
  public $Unload; // boolean
  public $CardStatus; // CardStatus
  public $OperationType; // OperationType
  public $OrderNumber; // string
}

class StoredValueTransactionResponse {
  public $Amount; // decimal
  public $FeeAmount; // decimal
  public $ApprovalCode; // string
  public $CVResult; // CVResult
  public $CashBackAmount; // decimal
  public $LockAmount; // decimal
  public $NewBalance; // decimal
  public $PreviousBalance; // decimal
  public $CardStatus; // CardStatus
  public $AccountNumber; // string
  public $CVData; // string
  public $CardRestrictionValue; // string
  public $PaymentAccountDataToken; // string
  public $MaskedPAN; // string
  public $OrderId; // string
}

class SummaryData {
  public $CashBackTotals; // SummaryTotals
  public $CreditReturnTotals; // SummaryTotals
  public $CreditTotals; // SummaryTotals
  public $DebitReturnTotals; // SummaryTotals
  public $DebitTotals; // SummaryTotals
  public $NetTotals; // SummaryTotals
  public $VoidTotals; // SummaryTotals
}

class SummaryTotals {
  public $NetAmount; // decimal
  public $Count; // int
}

class Tax {
  public $Amount; // decimal
  public $Rate; // decimal
  public $InvoiceNumber; // string
  public $ItemizedTaxes; // ArrayOfItemizedTax
}

class TaxExempt {
  public $IsTaxExempt; // IsTaxExempt
  public $TaxExemptNumber; // string
}

class TokenIndicator {
}

class Totals {
  public $NetAmount; // decimal
  public $Count; // int
}

class Transaction {
  public $Addendum; // Addendum
  public $CustomerData; // TransactionCustomerData
  public $ReportingData; // TransactionReportingData
  public $TenderData; // TransactionTenderData - Added for REST, may not generate
  public $TransactionData; // Transaction Details - Added for REST, may not generate 
}

class TransactionCustomerData {
  public $BillingData; // CustomerInfo
  public $CustomerId; // string
  public $CustomerTaxId; // string
  public $ShippingData; // CustomerInfo
}

class TransactionData {
  public $Amount; // decimal
  public $CampaignId; // string
  public $CurrencyCode; // TypeISOCurrencyCodeA3
  public $Reference; // string
  public $TransactionDateTime; // string  
}

class TransactionReportingData {
  public $Comment; // string
  public $Description; // string
  public $Reference; // string
}

class TransactionState {
}

class TransactionSummaryData {
  public $CashBackTotals; // Totals
  public $NetTotals; // Totals
  public $ReturnTotals; // Totals
  public $SaleTotals; // Totals
  public $VoidTotals; // Totals
  public $PINDebitReturnTotals; // Totals
  public $PINDebitSaleTotals; // Totals
}

class TransactionTenderData {
  public $PaymentAccountDataToken; // string
  public $SecurePaymentAccountData; // string
  public $EncryptionKeyId; // string
  public $SwipeStatus; // string
}

class TransactionType {
}

class TypeCardType {
}

class TypeTaxType {
}

class TypeUnitOfMeasure {
}

class Undo {
  public $sessionToken; // string
  public $differenceData; // Undo
  public $applicationProfileId; // string
  public $workflowId; // string
}

class UndoDifferenceData {
  public $TransactionId; // string
  public $Addendum; // Addendum
}

class UndoResponse {
  public $UndoResult; // Response
}

class Unmanaged {
  public $Any; // ArrayOfstring
}

class UseType {
}

class Verify {
  public $sessionToken; // string
  public $transaction; // Transaction
  public $applicationProfileId; // string
  public $merchantProfileId; // string
  public $workflowId; // string
}

class VerifyResponse {
  public $VerifyResult; // Response
}

class VirtualCardData {
  public $AccountNumberLength; // int
  public $BIN; // string
}

  /*
   *  REST SPECIFIC CLASSES BELOW
   */
class Rest_AuthorizeTransaction {
  public $ApplicationProfileId; //string
  public $MerchantProfileId; // string
  public $Transaction; // Transaction data, if level 2/3 data this is a BankcardTransactionPro
}

class Rest_Capture {
  public $ApplicationProfileId; // string
  public $DifferenceData; // Capture data object - maps to Capture
}

class Rest_CaptureSelective {
  public $ApplicationProfileId; // string
  public $TransactionIds; // List<Strings>
  public $DifferenceData; // List<Capture>  
}

class Rest_CaptureAll {
  public $ApplicationProfileId; // string
  public $BatchIds; // List<String> - A list of batches to settle. Conditional, required for customer-defined batches.
  public $MerchantProfileId; // string
  public $DifferenceData; // List<Capture> 
}

class Rest_Undo {
  public $ApplicationProfileId; // string
  public $DifferenceData; // Undo data object - maps to Undo
}

class Rest_ReturnById {
  public $ApplicationProfileId; // string
  public $DifferenceData; // Return data object - maps to Return
}

class Rest_ReturnTransaction {
  public $ApplicationProfileId; // string
  public $MerchantProfileId; // string
  public $Transaction; // Transaction data, if level 2/3 data this is a BankcardTransactionPro
}

// END REST SPECIFIC CLASSES

class CwsTransactionProcessing extends SoapClient {

 private static $classmap = array( 
                                    'AccountType' => 'AccountType',
                                    'Acknowledge' => 'Acknowledge',
                                    'AcknowledgeResponse' => 'AcknowledgeResponse',
                                    'Addendum' => 'Addendum',
                                    'AddressInfo' => 'AddressInfo',
                                    'AddressResult' => 'AddressResult',
                                    'Adjust' => 'Adjust',
                                   'AdjustDifferenceData' => 'Adjust',
                                    'AdjustResponse' => 'AdjustResponse',
                                    'AdviceResponse' => 'AdviceResponse',
                                    'AlternativeMerchantData' => 'AlternativeMerchantData',
                                    'ApplicationLocation' => 'ApplicationLocation',
                                    'AuthenticationFault' => 'AuthenticationFault',
                                    'AuthorizationFault' => 'AuthorizationFault',
                                    'Authorize' => 'Authorize',
                                    'AuthorizeAndCapture' => 'AuthorizeAndCapture',
                                    'AuthorizeAndCaptureResponse' => 'AuthorizeAndCaptureResponse',
                                    'AuthorizeResponse' => 'AuthorizeResponse',
                                    'AVSData' => 'AVSData',
                                    'AVSResult' => 'AVSResult',
                                    'BadAttemptThresholdExceededFault' => 'BadAttemptThresholdExceededFault',
                                    'BankcardApplicationConfigurationData' => 'BankcardApplicationConfigurationData',
                                    'BankcardCapture' => 'BankcardCapture',
                                    'BankcardCapturePro' => 'BankcardCapturePro',
                                    'BankcardCaptureResponse' => 'BankcardCaptureResponse',
                                    'BankcardCaptureResponsePro' => 'BankcardCaptureResponsePro',
                                    'BankcardInterchangeData' => 'BankcardInterchangeData',
                                    'BankcardReturn' => 'BankcardReturn',
                                    'BankcardReturnPro' => 'BankcardReturnPro',
                                    'BankcardTenderData' => 'BankcardTenderData',
                                    'BankcardTransaction' => 'BankcardTransaction',
                                    'BankcardTransactionData' => 'BankcardTransactionData',
                                    'BankcardTransactionDataPro' => 'BankcardTransactionDataPro',
                                    'BankcardTransactionPro' => 'BankcardTransactionPro',
                                    'BankcardTransactionResponse' => 'BankcardTransactionResponse',
                                    'BankcardTransactionResponsePro' => 'BankcardTransactionResponsePro',
                                    'BankcardUndo' => 'BankcardUndo',
                                    'BaseFault' => 'BaseFault',
                                    'BillPayment' => 'BillPayment',
                                    'BillPayServiceData' => 'BillPayServiceData', 				   												 'CaptureAuth' => 'Capture',
                                    'Capture' => 'Capture',
                                    'CaptureAll' => 'CaptureAll',
                                    'CaptureAllAsync' => 'CaptureAllAsync',
                                    'CaptureAllAsyncResponse' => 'CaptureAllAsyncResponse',
                                    'CaptureAllResponse' => 'CaptureAllResponse',
                                    'CaptureResponse' => 'CaptureResponse',
                                    'CaptureSelective' => 'CaptureSelective',
                                    'CaptureSelectiveAsync' => 'CaptureSelectiveAsync',
                                    'CaptureSelectiveAsyncResponse' => 'CaptureSelectiveAsyncResponse',
                                    'CaptureSelectiveResponse' => 'CaptureSelectiveResponse',
                                    'CaptureState' => 'CaptureState',
                                    'CardData' => 'CardData',
                                    'CardData' => 'CardData',
                                    'CardholderNameResult' => 'CardholderNameResult',
                                    'CardSecurityData' => 'CardSecurityData',
                                    'CardSecurityData' => 'CardSecurityData',
                                    'CardStatus' => 'CardStatus',
                                    'char' => 'char',
                                    'ChargeType' => 'ChargeType',
                                    'CheckCountryCode' => 'CheckCountryCode',
                                    'CheckData' => 'CheckData',
                                    'CityResult' => 'CityResult',
                                    'ClaimMappingsNotFoundFault' => 'ClaimMappingsNotFoundFault',
                                    'ClaimMetaData' => 'ClaimMetaData',
                                    'ClaimNotFoundFault' => 'ClaimNotFoundFault',
                                    'CommercialCardResponse' => 'CommercialCardResponse',
                                    'ConsumerIdentification' => 'ConsumerIdentification',
                                    'CountryResult' => 'CountryResult',
                                    'CustomerInfo' => 'CustomerInfo',
                                    'CustomerPresent' => 'CustomerPresent',
                                    'CVDataProvided' => 'CVDataProvided',
                                    'CVResult' => 'CVResult',
                                    'CWSBaseFault' => 'CWSBaseFault',
                                    'CWSConnectionFault' => 'CWSConnectionFault',
                                    'CWSDeserializationFault' => 'CWSDeserializationFault',
                                    'CWSExtendedDataNotSupportedFault' => 'CWSExtendedDataNotSupportedFault',
                                    'CWSFault' => 'CWSFault',
                                    'CWSInvalidMessageFormatFault' => 'CWSInvalidMessageFormatFault',
                                    'CWSInvalidOperationFault' => 'CWSInvalidOperationFault',
                                    'CWSInvalidServiceInformationFault' => 'CWSInvalidServiceInformationFault',
                                    'CWSOperationNotSupportedFault' => 'CWSOperationNotSupportedFault',
                                    'CWSTransactionAlreadySettledFault' => 'CWSTransactionAlreadySettledFault',
                                    'CWSTransactionFailedFault' => 'CWSTransactionFailedFault',
                                    'CWSTransactionServiceUnavailableFault' => 'CWSTransactionServiceUnavailableFault',
                                    'CWSValidationErrorFault' => 'CWSValidationErrorFault',
                                    'CWSValidationErrorFault.EErrorType' => 'CWSValidationErrorFault.EErrorType',
                                    'CWSValidationResultFault' => 'CWSValidationResultFault',
                                    'DriversLicense' => 'DriversLicense',
                                    'duration' => 'duration',
                                    'EcommerceSecurityData' => 'EcommerceSecurityData',
                                    'ElectronicCheckingCaptureResponse' => 'ElectronicCheckingCaptureResponse',
                                    'ElectronicCheckingCustomerData' => 'ElectronicCheckingCustomerData',
                                    'ElectronicCheckingTenderData' => 'ElectronicCheckingTenderData',
                                    'ElectronicCheckingTransaction' => 'ElectronicCheckingTransaction',
                                    'ElectronicCheckingTransactionData' => 'ElectronicCheckingTransactionData',
                                    'ElectronicCheckingTransactionResponse' => 'ElectronicCheckingTransactionResponse',
                                    'EntryMode' => 'EntryMode',
                                    'ExistingDebt' => 'ExistingDebt',
                                    'ExpiredTokenFault' => 'ExpiredTokenFault',
                                    'GeneratePasswordFault' => 'GeneratePasswordFault',
                                    'GoodsType' => 'GoodsType',
                                    'guid' => 'guid',
                                    'HardwareType' => 'HardwareType',
                                    'IdEntryMode' => 'IdEntryMode',
                                    'IdType' => 'IdType',
                                    'IIASData' => 'IIASData',
                                    'IIASDesignation' => 'IIASDesignation',
                                    'IndustryType' => 'IndustryType',
                                    'InternetTransactionData' => 'InternetTransactionData',
                                    'Interval' => 'Interval',
                                    'InvalidEmailFault' => 'InvalidEmailFault',
                                    'InvalidTokenFault' => 'InvalidTokenFault',
                                    'IsTaxExempt' => 'IsTaxExempt',
                                    'ItemizedTax' => 'ItemizedTax',
                                    'Level2Data' => 'Level2Data',
                                    'LineItemDetail' => 'LineItemDetail',
                                    'LockedByAdminFault' => 'LockedByAdminFault',
                                    'Manage' => 'Manage',
                                    'ManageAccount' => 'ManageAccount',
                                    'ManageAccountById' => 'ManageAccountById',
                                    'ManageAccountByIdResponse' => 'ManageAccountByIdResponse',
                                    'ManageAccountResponse' => 'ManageAccountResponse',
                                    'ManagedBilling' => 'ManagedBilling',
                                    'ManagedBillingInstallments' => 'ManagedBillingInstallments',
                                    'NameInfo' => 'NameInfo',
                                    'NonRenewableTokenFault' => 'NonRenewableTokenFault',
                                    'OneTimePasswordFault' => 'OneTimePasswordFault',
                                    'OperationType' => 'OperationType',
                                    'OwnerType' => 'OwnerType',
                                    'PartialApprovalSupportType' => 'PartialApprovalSupportType',
                                    'PasswordExpiredFault' => 'PasswordExpiredFault',
                                    'PasswordInvalidFault' => 'PasswordInvalidFault',
                                    'PayeeData' => 'PayeeData',
                                    'PersonalInfo' => 'PersonalInfo',
                                    'PhoneResult' => 'PhoneResult',
                                    'PINCapability' => 'PINCapability',
                                    'PINDebitUndoReason' => 'PINDebitUndoReason',
                                    'Ping' => 'Ping',
                                    'PingResponse' => 'PingResponse',
                                    'PingResponse' => 'PingResponse',
                                    'PINlessDebitData' => 'PINlessDebitData',
                                    'PostalCodeResult' => 'PostalCodeResult',
                                    'PrepaidCard' => 'PrepaidCard',
                                    'QueryAccount' => 'QueryAccount',
                                    'QueryAccountResponse' => 'QueryAccountResponse',
                                    'ReadCapability' => 'ReadCapability',
                                    'RelyingPartyNotAssociatedToSecurityDomainFault' => 'RelyingPartyNotAssociatedToSecurityDomainFault',
                                    'RequestACI' => 'RequestACI',
                                    'RequestAdvice' => 'RequestAdvice',
                                    'RequestCommercialCard' => 'RequestCommercialCard',
                                    'RequestTransaction' => 'RequestTransaction',
                                    'RequestTransactionResponse' => 'RequestTransactionResponse',
                                    'Response' => 'Response',
                                    'Resubmit' => 'Resubmit',
                                    'Return' => 'Return',
                                    'ReturnById' => 'ReturnById',
                                    'ReturnByIdResponse' => 'ReturnByIdResponse',
                                    'ReturnInformation' => 'ReturnInformation',
                                    'ReturnUnlinked' => 'ReturnUnlinked',
                                    'ReturnUnlinkedResponse' => 'ReturnUnlinkedResponse',
                                    'SECCode' => 'SECCode',
                                    'SendEmailFault' => 'SendEmailFault',
                                    'ServiceTransactionDateTime' => 'ServiceTransactionDateTime',
                                    'ServiceType' => 'ServiceType',
                                    'StateResult' => 'StateResult',
                                    'Status' => 'Status',
                                    'StoredValueActivateTenderData' => 'StoredValueActivateTenderData',
                                    'StoredValueBalanceTransferTenderData' => 'StoredValueBalanceTransferTenderData',
                                    'StoredValueCapture' => 'StoredValueCapture',
                                    'StoredValueCaptureResponse' => 'StoredValueCaptureResponse',
                                    'StoredValueManage' => 'StoredValueManage',
                                    'StoredValueReturn' => 'StoredValueReturn',
                                    'StoredValueTenderData' => 'StoredValueTenderData',
                                    'StoredValueTransaction' => 'StoredValueTransaction',
                                    'StoredValueTransactionData' => 'StoredValueTransactionData',
                                    'StoredValueTransactionResponse' => 'StoredValueTransactionResponse',
                                    'STSUnavailableFault' => 'STSUnavailableFault',
                                    'SummaryData' => 'SummaryData',
                                    'SummaryTotals' => 'SummaryTotals',
                                    'SystemFault' => 'SystemFault',
                                    'Tax' => 'Tax',
                                    'TaxExempt' => 'TaxExempt',
                                    'TokenIndicator' => 'TokenIndicator',
                                    'Totals' => 'Totals',
                                    'Transaction' => 'Transaction',
                                    'TransactionCustomerData' => 'TransactionCustomerData',
                                    'TransactionData' => 'TransactionData',
                                    'TransactionReportingData' => 'TransactionReportingData',
                                    'TransactionState' => 'TransactionState',
                                    'TransactionSummaryData' => 'TransactionSummaryData',
                                    'TransactionTenderData' => 'TransactionTenderData',
                                    'TransactionType' => 'TransactionType',
                                    'TypeCardType' => 'TypeCardType',
                                    'TypeISOCountryCodeA3' => 'TypeISOCountryCodeA3',
                                    'TypeISOCurrencyCodeA3' => 'TypeISOCurrencyCodeA3',
                                    'TypeStateProvince' => 'TypeStateProvince',
                                    'TypeTaxType' => 'TypeTaxType',
                                    'TypeUnitOfMeasure' => 'TypeUnitOfMeasure', 				   												 'UndoDifferenceData' => 'Undo',
                                    'Undo' => 'Undo',
                                    'UndoResponse' => 'UndoResponse',
                                    'Unmanaged' => 'Unmanaged',
                                    'UserNotFoundFault' => 'UserNotFoundFault',
                                    'UseType' => 'UseType',
                                    'Verify' => 'Verify',
                                    'VerifyResponse' => 'VerifyResponse',
                                    'VirtualCardData' => 'VirtualCardData',

                                   );

  public function CwsTransactionProcessing($wsdl = "", $options = array()) {
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
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Performs a balance inquiry on the cardholder's account to determine 
   * the current account balance.
            </summary>
            <param name="sessionToken">Session 
   * token obtained from SignOn()</param>
            <param name="transaction">Transaction 
   * details</param>
            <param name="applicationProfileId">Application profile ID 
   * obtained from SaveApplicationData()</param>
            <param name="merchantProfileId">Merchant 
   * profile ID</param>
            <param name="workflowId">Workflow ID</param>
        
   *     <returns></returns> 
   *
   * @param QueryAccount $parameters
   * @return QueryAccountResponse
   */
  public function QueryAccount(QueryAccount $parameters) {
    return $this->__soapCall('QueryAccount', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Performs a check on the cardholder's account without reserving 
   * any funds.
            </summary>
            <param name="sessionToken">Session token 
   * obtained from SignOn()</param>
            <param name="transaction">Transaction details</param>
 
   *            <param name="applicationProfileId">Application profile ID obtained from SaveApplicationData()</param>
 
   *            <param name="merchantProfileId">Merchant profile ID</param>
            <param 
   * name="workflowId">Workflow ID</param>
            <returns></returns> 
   *
   * @param Verify $parameters
   * @return VerifyResponse
   */
  public function Verify(Verify $parameters) {
    return $this->__soapCall('Verify', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Performs a check on cardholder's funds and reserves the queried 
   * amount if sufficient funds are available. Transaction must be captured before funds transfer 
   * will occur.
            </summary>
            <param name="sessionToken">Session token 
   * obtained from SignOn()</param>
            <param name="transaction">Transaction details</param>
 
   *            <param name="applicationProfileId">Application profile ID obtained from SaveApplicationData()</param>
 
   *            <param name="merchantProfileId">Merchant profile ID</param>
            <param 
   * name="workflowId">Workflow ID</param>
            <returns></returns> 
   *
   * @param Authorize $parameters
   * @return AuthorizeResponse
   */
  public function Authorize(Authorize $parameters) {
    return $this->__soapCall('Authorize', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Performs an incremental or reversal authorization to increase or 
   * decrease the amount of an existing authorization.
            </summary>
           
   *  <param name="sessionToken">Session token obtained from SignOn()</param>
            
   * <param name="differenceData">Adjustment details</param>
            <param name="applicationProfileId">Application 
   * profile ID obtained from SaveApplicationData()</param>
            <param name="workflowId">Workflow 
   * ID</param>
            <returns></returns> 
   *
   * @param Adjust $parameters
   * @return AdjustResponse
   */
  public function Adjust(Adjust $parameters) {
    return $this->__soapCall('Adjust', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Performs a check on cardholder's funds and reserves the queried 
   * amount if sufficient funds are available, then marks the transaction for capture.
   
   *          </summary>
            <param name="sessionToken">Session token obtained from 
   * SignOn()</param>
            <param name="transaction">Transaction details</param>
 
   *            <param name="applicationProfileId">Application profile ID obtained from SaveApplicationData()</param>
 
   *            <param name="merchantProfileId">Merchant profile ID</param>
            <param 
   * name="workflowId">Workflow ID</param>
            <returns></returns> 
   *
   * @param AuthorizeAndCapture $parameters
   * @return AuthorizeAndCaptureResponse
   */
  public function AuthorizeAndCapture(AuthorizeAndCapture $parameters) {
    return $this->__soapCall('AuthorizeAndCapture', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Performs an unlinked or 'standalone' credit to a cardholder's account 
   * from a merchant's account.
            </summary>
            <param name="sessionToken">Session 
   * token obtained from SignOn()</param>
            <param name="transaction">Transaction 
   * details</param>
            <param name="applicationProfileId">Application profile ID 
   * obtained from SaveApplicationData()</param>
            <param name="merchantProfileId">Merchant 
   * profile ID</param>
            <param name="workflowId">Workflow ID</param>
        
   *     <returns></returns> 
   *
   * @param ReturnUnlinked $parameters
   * @return ReturnUnlinkedResponse
   */
  public function ReturnUnlinked(ReturnUnlinked $parameters) {
    return $this->__soapCall('ReturnUnlinked', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Performs a linked credit to a cardholder's account from a merchant's 
   * account using data from the authorization.
            </summary>
            <param 
   * name="sessionToken">Session token obtained from SignOn()</param>
            <param name="differenceData">Return 
   * details</param>
            <param name="applicationProfileId">Application profile ID 
   * obtained from SaveApplicationData()</param>
            <param name="workflowId">Workflow 
   * ID</param>
            <returns></returns> 
   *
   * @param ReturnById $parameters
   * @return ReturnByIdResponse
   */
  public function ReturnById(ReturnById $parameters) {
    return $this->__soapCall('ReturnById', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Void or reverse an authorization in order to release cardholder 
   * funds. If transaction to be Undone is in an ErrorUnknown state, the TenderData must be 
   * set on the BankcardUndo.
            </summary>
            <param name="sessionToken">Session 
   * token obtained from SignOn()</param>
            <param name="differenceData">Undo details</param>
 
   *            <param name="applicationProfileId">Application profile ID obtained from SaveApplicationData()</param>
 
   *            <param name="workflowId">Workflow ID</param>
            <returns></returns> 
   * 
   *
   * @param Undo $parameters
   * @return UndoResponse
   */
  public function Undo(Undo $parameters) {
    return $this->__soapCall('Undo', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Mark a succesfully authorized transaction for settlement by the 
   * processor.
            </summary>
            <param name="sessionToken">Session token 
   * obtained from SignOn()</param>
            <param name="differenceData">Capture details</param>
 
   *            <param name="applicationProfileId">Application profile ID obtained from SaveApplicationData()</param>
 
   *            <param name="workflowId">Workflow ID</param>
            <returns></returns> 
   * 
   *
   * @param Capture $parameters
   * @return CaptureResponse
   */
  public function Capture(CaptureAuth $parameters) {
    return $this->__soapCall('Capture', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Mark all succesfully authorized transactions for settlement by 
   * the processor.
            </summary>
            <param name="sessionToken">Session 
   * token obtained from SignOn()</param>
            <param name="differenceData">Capture 
   * details</param>
            <param name="batchIds">A list of batch ids.</param>
    
   *         <param name="applicationProfileId">Application profile ID obtained from SaveApplicationData()</param>
 
   *            <param name="merchantProfileId">Merchant profile ID</param>
            <param 
   * name="workflowId">Workflow ID</param>
            <returns></returns> 
   *
   * @param CaptureAll $parameters
   * @return CaptureAllResponse
   */
  public function CaptureAll(CaptureAll $parameters) {
    return $this->__soapCall('CaptureAll', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Mark all succesfully authorized transactions for settlement by 
   * the processor without waiting for 
            the settlement to complete. The Response 
   * object will indicate a successful receipt of the settlement request.
            </summary>
 
   *            <param name="sessionToken">Session token obtained from SignOn()</param>
  
   *           <param name="differenceData">Capture details</param>
            <param name="batchIds">A 
   * list of batch ids.</param>
            <param name="applicationProfileId">Application 
   * profile ID obtained from SaveApplicationData()</param>
            <param name="merchantProfileId">Merchant 
   * profile ID</param>
            <param name="workflowId">Workflow ID</param>
        
   *     <returns>Single Response object.</returns> 
   *
   * @param CaptureAllAsync $parameters
   * @return CaptureAllAsyncResponse
   */
  public function CaptureAllAsync(CaptureAllAsync $parameters) {
    return $this->__soapCall('CaptureAllAsync', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Mark one or more specific succesfully authorized transactions for 
   * settlement by the processor.
            </summary>
            <param name="sessionToken">Session 
   * token obtained from SignOn()</param>
            <param name="transactionIds">Transaction 
   * IDs to capture</param>
            <param name="differenceData">Capture details</param>
 
   *            <param name="applicationProfileId">Application profile ID obtained from SaveApplicationData()</param>
 
   *            <param name="workflowId">Workflow ID</param>
            <returns></returns> 
   * 
   *
   * @param CaptureSelective $parameters
   * @return CaptureSelectiveResponse
   */
  public function CaptureSelective(CaptureSelective $parameters) {
    return $this->__soapCall('CaptureSelective', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Mark one or more specific succesfully authorized transactions for 
   * settlement by the processor without waiting for 
            the settlement to complete. 
   * The Response object will indicate a successful receipt of the settlement request.
   
   *          </summary>
            <param name="sessionToken">Session token obtained from 
   * SignOn()</param>
            <param name="transactionIds">Transaction IDs to capture</param>
 
   *            <param name="differenceData">Capture details</param>
            <param name="applicationProfileId">Application 
   * profile ID obtained from SaveApplicationData()</param>
            <param name="workflowId">Workflow 
   * ID</param>
            <returns>Single Response object.</returns> 
   *
   * @param CaptureSelectiveAsync $parameters
   * @return CaptureSelectiveAsyncResponse
   */
  public function CaptureSelectiveAsync(CaptureSelectiveAsync $parameters) {
    return $this->__soapCall('CaptureSelectiveAsync', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Mark a transaction acknowledged after successfully receiving a 
   * response. This is helpful for later reporting.
            </summary>
            <param 
   * name="sessionToken">Session token obtained from SignOn()</param>
            <param name="transactionId">Transaction 
   * ID to acknowledge</param>
            <param name="applicationProfileId">Application 
   * profile ID obtained from SaveApplicationData()</param>
            <param name="workflowId">Workflow 
   * ID</param>
            <returns></returns> 
   *
   * @param Acknowledge $parameters
   * @return AcknowledgeResponse
   */
  public function Acknowledge(Acknowledge $parameters) {
    return $this->__soapCall('Acknowledge', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Provides the mechanism to request any transactions that match given 
   * tender data.
            </summary>
            <param name="tenderData">The tender 
   * data tro match.</param>
            <param name="sessionToken">Session token obtained 
   * from SignOn()</param>
            <param name="merchantProfileId">Aids in the distinction 
   * of the transaction(s) located.</param>
            <returns>One or more transaction instances 
   * that match the supplied tender data.</returns> 
   *
   * @param RequestTransaction $parameters
   * @return RequestTransactionResponse
   */
  public function RequestTransaction(RequestTransaction $parameters) {
    return $this->__soapCall('RequestTransaction', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Used to activate, reload, deactivate an account or to transfer 
   * the balance from another card.
            </summary>
            <param name="sessionToken">Session 
   * token obtained from SignOn()</param>
            <param name="transaction">Transaction 
   * details</param>
            <param name="applicationProfileId">Application profile ID 
   * obtained from SaveApplicationData()</param>
            <param name="merchantProfileId">Merchant 
   * profile ID</param>
            <param name="workflowId">Workflow ID</param>
        
   *     <returns></returns> 
   *
   * @param ManageAccount $parameters
   * @return ManageAccountResponse
   */
  public function ManageAccount(ManageAccount $parameters) {
    return $this->__soapCall('ManageAccount', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Used to update an existing account.
            </summary>
  
   *           <param name="sessionToken">Session token obtained from SignOn()</param>
   
   *          <param name="differenceData">Manage details</param>
            <param name="applicationProfileId">Application 
   * profile ID obtained from SaveApplicationData()</param>
            <param name="workflowId">Workflow 
   * ID</param>
            <returns></returns> 
   *
   * @param ManageAccountById $parameters
   * @return ManageAccountByIdResponse
   */
  public function ManageAccountById(ManageAccountById $parameters) {
    return $this->__soapCall('ManageAccountById', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/TransactionProcessing',
            'soapaction' => ''
           )
      );
  }

}

?>
