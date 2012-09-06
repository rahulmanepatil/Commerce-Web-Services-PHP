<?php
/**
 * CWSServiceInformation class file
 * 
 */

class PingResponse {
	public $IsSuccess; // boolean
	public $Message; // string
}

class SvcInfo_Ping {
}

class SvcInfo_PingResponse {
  public $PingResult; // PingResponse
}

class char {
}

class duration {
}

class guid {
}

class STSUnavailableFault {
}

class BaseFault {
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
}

class ExpiredTokenFault {
}

class InvalidTokenFault {
}

class AuthenticationFault {
}

class LockedByAdminFault {
}

class PasswordExpiredFault {
}

class BadAttemptThresholdExceededFault {
}

class OneTimePasswordFault {
}

class SendEmailFault {
}

class GeneratePasswordFault {
}

class PasswordInvalidFault {
}

class UserNotFoundFault {
}

class InvalidEmailFault {
}

class ClaimMetaData {
  public $ClaimDescription; // string
  public $ClaimGuid; // string
  public $ClaimNs; // string
  public $ClaimType; // string
  public $ClaimValue; // string
  public $Confidential; // boolean
}

class ClaimNotFoundFault {
}

class AuthorizationFault {
}

class RelyingPartyNotAssociatedToSecurityDomainFault {
}

class SystemFault {
}

class NonRenewableTokenFault {
}

class ClaimMappingsNotFoundFault {
}

class SignOnWithToken {
  public $identityToken; // string
}

class SignOnWithTokenResponse {
  public $SignOnWithTokenResult; // string
}

class GetServiceInformation {
  public $sessionToken; // string
}

class GetServiceInformationResponse {
  public $GetServiceInformationResult; // ServiceInformation
}

class ServiceInformation {
  public $BankcardServices; // ArrayOfBankcardService
  public $ElectronicCheckingServices; // ArrayOfElectronicCheckingService
  public $StoredValueServices; // ArrayOfStoredValueService
  public $Workflows; // ArrayOfWorkflow
}

class BankcardService {
  public $AlternativeMerchantData; // boolean
  public $AutoBatch; // boolean
  public $AVSData; // BankcardServiceAVSData
  public $CutoffTime; // dateTime
  public $EncryptionKey; // string
  public $ManagedBilling; // boolean
  public $MaximumBatchItems; // long
  public $MaximumLineItems; // long
  public $MultiplePartialCapture; // boolean
  public $Operations; // Operations
  public $PurchaseCardLevel; // PurchaseCardLevel
  public $ServiceId; // string
  public $ServiceName; // string
  public $Tenders; // Tenders
}

class BankcardServiceAVSData {
  public $CardholderName; // boolean
  public $Street; // boolean
  public $City; // boolean
  public $StateProvince; // boolean
  public $PostalCode; // boolean
  public $Country; // boolean
  public $Phone; // boolean
}

class Operations {
  public $Verify; // boolean
  public $QueryAccount; // boolean
  public $AuthAndCapture; // boolean
  public $Authorize; // boolean
  public $Adjust; // boolean
  public $ReturnById; // boolean
  public $ReturnUnlinked; // boolean
  public $Undo; // boolean
  public $Capture; // boolean
  public $CaptureSelective; // boolean
  public $CaptureAll; // boolean
  public $CloseBatch; // CloseBatch
  public $QueryRejected; // boolean
  public $ManageAccount; // boolean
  public $ManageAccountById; // boolean
  public $Disburse; // boolean
}

class CloseBatch {
}

class PurchaseCardLevel {
}

class Tenders {
  public $Credit; // boolean
  public $PINDebit; // boolean
  public $PINlessDebit; // boolean
  public $PINDebitReturnSupportType; // PINDebitReturnSupportType
  public $PINDebitUndoTenderDataRequired; // boolean
  public $CreditAuthorizeSupport; // CreditAuthorizeSupportType
  public $QueryRejectedSupport; // QueryRejectedSupportType
  public $PinDebitUndoSupport; // PinDebitUndoSupportType
  public $BatchAssignmentSupport; // BatchAssignmentSupport
  public $CreditReturnSupportType; // CreditReturnSupportType
  public $TrackDataSupport; // TrackDataSupportType
  public $CredentialsRequired; // boolean
  public $CreditReversalSupportType; // CreditReversalSupportType
  public $PartialApprovalSupportType; // PartialApprovalSupportType
}

class PINDebitReturnSupportType {
}

class CreditAuthorizeSupportType {
}

class QueryRejectedSupportType {
}

class PinDebitUndoSupportType {
}

class BatchAssignmentSupport {
}

class CreditReturnSupportType {
}

class TrackDataSupportType {
}

class CreditReversalSupportType {
}

class PartialApprovalSupportType {
}

class ElectronicCheckingService {
  public $Operations; // Operations
  public $ServiceId; // string
  public $ServiceName; // string
  public $Tenders; // Tenders
}

class StoredValueService {
  public $Operations; // Operations
  public $ServiceId; // string
  public $ServiceName; // string
  public $Tenders; // Tenders
  public $SecureMSRAllowed; // boolean
}

class Workflow {
  public $WorkflowId; // string
  public $Name; // string
  public $ServiceId; // string
  public $WorkflowServices; // ArrayOfWorkflowService
}

class WorkflowService {
  public $ServiceId; // string
  public $ServiceName; // string
  public $ServiceType; // string
  public $Ordinal; // int
}

class SaveApplicationData {
  public $sessionToken; // string
  public $applicationData; // ApplicationData
}

class ApplicationData {
  public $ApplicationAttended; // boolean
  public $ApplicationLocation; // ApplicationLocation
  public $ApplicationName; // string
  public $DeveloperId; // string
  public $HardwareType; // HardwareType
  public $PINCapability; // PINCapability
  public $PTLSSocketId; // string
  public $ReadCapability; // ReadCapability
  public $SerialNumber; // string
  public $SoftwareVersion; // string
  public $SoftwareVersionDate; // dateTime
  public $VendorId; // string
  public $EncryptionType; // EncryptionType
  public $DeviceSerialNumber; // string
}

class ApplicationLocation {
}

class HardwareType {
}

class PINCapability {
}

class ReadCapability {
}

class EncryptionType {
}

class SaveApplicationDataResponse {
  public $SaveApplicationDataResult; // string
}

class GetApplicationData {
  public $sessionToken; // string
  public $applicationProfileId; // string
}

class GetApplicationDataResponse {
  public $GetApplicationDataResult; // ApplicationData
}

class DeleteApplicationData {
  public $sessionToken; // string
  public $applicationProfileId; // string
}

class DeleteApplicationDataResponse {
}

class IsMerchantProfileInitialized {
  public $sessionToken; // string
  public $serviceId; // string
  public $merchantProfileId; // string
  public $tenderType; // TenderType
}

class TenderType {
}

class IsMerchantProfileInitializedResponse {
  public $IsMerchantProfileInitializedResult; // boolean
}

class merchantProfiles {
	public $MerchantProfile; //array of MerchantProfiles
}

class GetMerchantProfiles {
  public $sessionToken; // string
  public $serviceId; // string
  public $tenderType; // TenderType
}

class GetMerchantProfilesResponse {
  public $GetMerchantProfilesResult; // ArrayOfMerchantProfile
}

class MerchantProfile {
  public $ProfileId; // string
  public $ServiceId; // string
  public $ServiceName; // string
  public $LastUpdated; // dateTime
  public $MerchantData; // MerchantProfileMerchantData
  public $TransactionData; // MerchantProfileTransactionData
}

class MerchantProfileMerchantData {
  public $CustomerServiceInternet; // string
  public $CustomerServicePhone; // string
  public $Language; // TypeISOLanguageCodeA3
  public $Address; // AddressInfo
  public $MerchantId; // string
  public $Name; // string
  public $Phone; // string
  public $TaxId; // string
  public $BankcardMerchantData; // BankcardMerchantData
  public $ElectronicCheckingMerchantData; // ElectronicCheckingMerchantData
  public $StoredValueMerchantData; // StoredValueMerchantData
}

class TypeISOLanguageCodeA3 {
}

class AddressInfo {
  public $Street1; // string
  public $Street2; // string
  public $City; // string
  public $StateProvince; // TypeStateProvince
  public $PostalCode; // string
  public $CountryCode; // TypeISOCountryCodeA3
}

class TypeStateProvince {
}

class TypeISOCountryCodeA3 {
}

class BankcardMerchantData {
  public $ABANumber; // string
  public $AcquirerBIN; // string
  public $AgentBank; // string
  public $AgentChain; // string
  public $Aggregator; // boolean
  public $ClientNumber; // string
  public $IndustryType; // IndustryType
  public $Location; // string
  public $MerchantType; // string
  public $PrintCustomerServicePhone; // boolean
  public $QualificationCodes; // string
  public $ReimbursementAttribute; // string
  public $SIC; // string
  public $SecondaryTerminalId; // string
  public $SettlementAgent; // string
  public $SharingGroup; // string
  public $StoreId; // string
  public $TerminalId; // string
  public $TimeZoneDifferential; // string
}

class IndustryType {
}

class ElectronicCheckingMerchantData {
  public $OrginatorId; // string
  public $ProductId; // string
  public $SiteId; // string
}

class StoredValueMerchantData {
  public $AgentChain; // string
  public $ClientNumber; // string
  public $IndustryType; // IndustryType
  public $SIC; // string
  public $StoreId; // string
  public $TerminalId; // string
}

class MerchantProfileTransactionData {
  public $BankcardTransactionDataDefaults; // BankcardTransactionDataDefaults
}

class BankcardTransactionDataDefaults {
  public $CurrencyCode; // TypeISOCurrencyCodeA3
  public $CustomerPresent; // CustomerPresent
  public $EntryMode; // EntryMode
  public $RequestACI; // RequestACI
  public $RequestAdvice; // RequestAdvice
}

class TypeISOCurrencyCodeA3 {
}

class CustomerPresent {
}

class EntryMode {
}

class RequestACI {
}

class RequestAdvice {
}

class GetMerchantProfileIds {
  public $sessionToken; // string
  public $serviceId; // string
  public $tenderType; // TenderType
}

class GetMerchantProfileIdsResponse {
  public $GetMerchantProfileIdsResult; // ArrayOfstring
}

class GetMerchantProfilesByProfileId {
  public $sessionToken; // string
  public $merchantProfileId; // string
}

class GetMerchantProfilesByProfileIdResponse {
  public $GetMerchantProfilesByProfileIdResult; // ArrayOfMerchantProfile
}

class GetMerchantProfile {
  public $sessionToken; // string
  public $merchantProfileId; // string
  public $serviceId; // string
  public $tenderType; // TenderType
}

class GetMerchantProfileResponse {
  public $GetMerchantProfileResult; // MerchantProfile
}

class DeleteMerchantProfile {
  public $sessionToken; // string
  public $merchantProfileId; // string
  public $serviceId; // string
  public $tenderType; // TenderType
}

class DeleteMerchantProfileResponse {
}

class SaveMerchantProfiles {
  public $sessionToken; // string
  public $serviceId; // string
  public $tenderType; // TenderType
  public $merchantProfiles; // ArrayOfMerchantProfile
}

class SaveMerchantProfilesResponse {
}

class SignOnWithUsernamePasswordForServiceKey {
  public $serviceKey; // string
  public $username; // string
  public $password; // string
}

class SignOnWithUsernamePasswordForServiceKeyResponse {
  public $SignOnWithUsernamePasswordForServiceKeyResult; // string
}

class ResetPasswordForServiceKey {
  public $serviceKey; // string
  public $userName; // string
}

class ResetPasswordForServiceKeyResponse {
}

class ChangePasswordForServiceKey {
  public $serviceKey; // string
  public $userName; // string
  public $password; // string
  public $newPassword; // string
}

class ChangePasswordForServiceKeyResponse {
}

class ChangeUsernameForServiceKey {
  public $serviceKey; // string
  public $userName; // string
  public $password; // string
  public $newUsername; // string
}

class ChangeUsernameForServiceKeyResponse {
}

class ChangeEmailForServiceKey {
  public $serviceKey; // string
  public $userName; // string
  public $password; // string
  public $newEmail; // string
}

class ChangeEmailForServiceKeyResponse {
}

class GetPasswordExpirationForServiceKey {
  public $serviceKey; // string
  public $userName; // string
  public $password; // string
}

class GetPasswordExpirationForServiceKeyResponse {
  public $GetPasswordExpirationForServiceKeyResult; // dateTime
}

class ValidateMerchantProfile {
  public $sessionToken; // string
  public $serviceId; // string
  public $tenderType; // TenderType
  public $merchantProfile; // MerchantProfile
}

class ValidateMerchantProfileResponse {
}

class GetAllClaims {
  public $authenticatingToken; // string
  public $verifiedToken; // string
}

class GetAllClaimsResponse {
  public $GetAllClaimsResult; // ArrayOfClaimMetaData
}

class GetClaims {
  public $authenticatingToken; // string
  public $verifiedToken; // string
  public $claimNSs; // ArrayOfstring
}

class GetClaimsResponse {
  public $GetClaimsResult; // ArrayOfstring
}

class Renew {
  public $authenticatingToken; // string
  public $toRenewToken; // string
}

class RenewResponse {
  public $RenewResult; // string
}

class SignOnAndAddClaims {
  public $identityToken; // string
  public $claims; // ArrayOfClaimMetaData
}

class SignOnAndAddClaimsResponse {
  public $SignOnAndAddClaimsResult; // string
}

class DelegatedSignOn {
  public $identityToken; // string
  public $onBehalfOfSk; // string
  public $claims; // ArrayOfClaimMetaData
}

class DelegatedSignOnResponse {
  public $DelegatedSignOnResult; // string
}

class FederatedSignOn {
  public $identityToken; // string
  public $externalDomainToken; // string
}

class FederatedSignOnResponse {
  public $FederatedSignOnResult; // string
}

class FederatedSignOnAndAddClaims {
  public $identityToken; // string
  public $externalDomainToken; // string
  public $claims; // ArrayOfClaimMetaData
}

class FederatedSignOnAndAddClaimsResponse {
  public $FederatedSignOnAndAddClaimsResult; // string
}

class CWSFault {
}

class CWSBaseFault {
  public $ErrorID; // int
  public $HelpURL; // string
  public $Operation; // string
  public $ProblemType; // string
}

class CWSServiceInformationUnavailableFault {
}

class CWSValidationResultFault {
  public $Errors; // ArrayOfCWSValidationErrorFault
}

class CWSValidationErrorFault {
  public $ErrorType; // CWSValidationErrorFault.EErrorType
  public $RuleKey; // string
  public $RuleLocationKey; // string
  public $RuleMessage; // string
  public $TransactionId; // string
}

class CWSValidationErrorFault_EErrorType {
}

class CWSServiceInformation extends SoapClient {

 private static $classmap = array( 
                                    'PingResponse' => 'PingResponse',
                                    'Ping' => 'Ping',
                                    'PingResponse' => 'PingResponse',
                                    'char' => 'char',
                                    'duration' => 'duration',
                                    'guid' => 'guid',
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
                                    'CWSFault' => 'CWSFault',
                                    'CWSBaseFault' => 'CWSBaseFault',
                                    'CWSServiceInformationUnavailableFault' => 'CWSServiceInformationUnavailableFault',
                                    'CWSValidationResultFault' => 'CWSValidationResultFault',
                                    'CWSValidationErrorFault' => 'CWSValidationErrorFault',
                                    'CWSValidationErrorFault.EErrorType' => 'CWSValidationErrorFault.EErrorType',
                                   );

  public function CWSServiceInformation($wsdl = "", $options = array()) {
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
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Sign on using an identity token.
            </summary>
     
   *        <param name="identityToken">Identity token associated with your service key</param>
 
   *            <returns>Session token</returns> 
   *
   * @param SignOnWithToken $parameters
   * @return SignOnWithTokenResponse
   */
  public function SignOnWithToken(SignOnWithToken $parameters) {
    return $this->__soapCall('SignOnWithToken', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Retrieve service information.
            </summary>
        
   *     <param name="sessionToken">Session token</param>
            <returns>Service information 
   * associated with the session token</returns> 
   *
   * @param GetServiceInformation $parameters
   * @return GetServiceInformationResponse
   */
  public function GetServiceInformation(GetServiceInformation $parameters) {
    return $this->__soapCall('GetServiceInformation', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Save application configuration data.
            </summary>
 
   *            <param name="sessionToken">Session token</param>
            <param name="applicationData">Application 
   * common configuration data</param>
            <returns>Application profile ID</returns> 
   * 
   *
   * @param SaveApplicationData $parameters
   * @return SaveApplicationDataResponse
   */
  public function SaveApplicationData(SaveApplicationData $parameters) {
    return $this->__soapCall('SaveApplicationData', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Retrieves all current application configuration data associated 
   * with the Service Key.
            </summary>
            <param name="sessionToken">Session 
   * token</param>
            <param name="applicationProfileId">Application profile ID returned 
   * from SaveApplicationData()</param>
            <returns>Application common configuration 
   * data associated with the session token</returns> 
   *
   * @param GetApplicationData $parameters
   * @return GetApplicationDataResponse
   */
  public function GetApplicationData(GetApplicationData $parameters) {
    return $this->__soapCall('GetApplicationData', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Deletes application configuration data.
            </summary>
 
   *            <param name="sessionToken">Session token</param>
            <param name="applicationProfileId">Application 
   * profile ID</param> 
   *
   * @param DeleteApplicationData $parameters
   * @return DeleteApplicationDataResponse
   */
  public function DeleteApplicationData(DeleteApplicationData $parameters) {
    return $this->__soapCall('DeleteApplicationData', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Tests whether merchant profile is initialized for a specific Tender 
   * Type.
            </summary>
            <param name="sessionToken">Session token</param>
 
   *            <param name="serviceId">Service ID</param>
            <param name="merchantProfileId">Merchant 
   * profile ID</param>
            <param name="tenderType">Tender type</param>
        
   *     <returns><c>true</c> if the merchant profile has been initialized</returns> 
   *
   * @param IsMerchantProfileInitialized $parameters
   * @return IsMerchantProfileInitializedResponse
   */
  public function IsMerchantProfileInitialized(IsMerchantProfileInitialized $parameters) {
    return $this->__soapCall('IsMerchantProfileInitialized', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Retrieves all merchant profiles associated with a specific Service 
   * ID and Tender Type.
            </summary>
            <param name="sessionToken">Session 
   * token</param>
            <param name="serviceId">Service ID</param>
            <param 
   * name="tenderType">Tender type</param>
            <returns>Collection of merchant profiles</returns> 
   * 
   *
   * @param GetMerchantProfiles $parameters
   * @return GetMerchantProfilesResponse
   */
  public function GetMerchantProfiles(GetMerchantProfiles $parameters) {
    return $this->__soapCall('GetMerchantProfiles', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Retrieves all merchant profile IDs associated with a specific Service 
   * ID and Tender Type.
            </summary>
            <param name="sessionToken">Session 
   * token</param>
            <param name="serviceId">Service ID</param>
            <param 
   * name="tenderType">Tender type</param>
            <returns>Collection of merchant profile 
   * IDs</returns> 
   *
   * @param GetMerchantProfileIds $parameters
   * @return GetMerchantProfileIdsResponse
   */
  public function GetMerchantProfileIds(GetMerchantProfileIds $parameters) {
    return $this->__soapCall('GetMerchantProfileIds', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Retrieves a specific merchant's merchant profiles for all Service 
   * IDs and Tender Types.
            </summary>
            <param name="sessionToken">Session 
   * token</param>
            <param name="merchantProfileId">Merchant profile ID</param>
 
   *            <returns>Collection of merchant profiles</returns> 
   *
   * @param GetMerchantProfilesByProfileId $parameters
   * @return GetMerchantProfilesByProfileIdResponse
   */
  public function GetMerchantProfilesByProfileId(GetMerchantProfilesByProfileId $parameters) {
    return $this->__soapCall('GetMerchantProfilesByProfileId', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Retrieves the merchant profile associated with a specific Service 
   * ID and Tender Type.
            </summary>
            <param name="sessionToken">Session 
   * token</param>
            <param name="merchantProfileId">Merchant profile ID</param>
 
   *            <param name="serviceId">Service ID</param>
            <param name="tenderType">Tender 
   * type</param>
            <returns>The requested merchant profile</returns> 
   *
   * @param GetMerchantProfile $parameters
   * @return GetMerchantProfileResponse
   */
  public function GetMerchantProfile(GetMerchantProfile $parameters) {
    return $this->__soapCall('GetMerchantProfile', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Deletes a specific merchant profile for a Tender Type.
       
   *      </summary>
            <param name="sessionToken">Session token</param>
       
   *      <param name="merchantProfileId">Merchant profile ID</param>
            <param name="serviceId">Service 
   * ID</param>
            <param name="tenderType">Tender type</param> 
   *
   * @param DeleteMerchantProfile $parameters
   * @return DeleteMerchantProfileResponse
   */
  public function DeleteMerchantProfile(DeleteMerchantProfile $parameters) {
    return $this->__soapCall('DeleteMerchantProfile', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Saves one or more merchant profiles for a Tender Type.
       
   *      </summary>
            <param name="sessionToken">Session token</param>
       
   *      <param name="serviceId">Service ID</param>
            <param name="tenderType">Tender 
   * type</param>
            <param name="merchantProfiles">Merchant profiles</param> 
   *
   * @param SaveMerchantProfiles $parameters
   * @return SaveMerchantProfilesResponse
   */
  public function SaveMerchantProfiles(SaveMerchantProfiles $parameters) {
    return $this->__soapCall('SaveMerchantProfiles', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Sign on using a username and password.
            </summary>
 
   *            <param name="serviceKey">Service key to sign on</param>
            <param 
   * name="username">Username associated with the specified service key</param>
          
   *   <param name="password">Password associated with the specified service key and username</param>
 
   *            <returns>Session token</returns> 
   *
   * @param SignOnWithUsernamePasswordForServiceKey $parameters
   * @return SignOnWithUsernamePasswordForServiceKeyResponse
   */
  public function SignOnWithUsernamePasswordForServiceKey(SignOnWithUsernamePasswordForServiceKey $parameters) {
    return $this->__soapCall('SignOnWithUsernamePasswordForServiceKey', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Reset the password for the specified service key and username.
 
   *            </summary>
            <param name="serviceKey">Service key</param>
     
   *        <param name="userName">User name associated with specified service key</param> 
   * 
   *
   * @param ResetPasswordForServiceKey $parameters
   * @return ResetPasswordForServiceKeyResponse
   */
  public function ResetPasswordForServiceKey(ResetPasswordForServiceKey $parameters) {
    return $this->__soapCall('ResetPasswordForServiceKey', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Change the password for the specified service key and username.
 
   *            </summary>
            <param name="serviceKey">Service key</param>
     
   *        <param name="userName">Username associated with specified service key</param>
 
   *            <param name="password">Password currently associated with specified service 
   * key and username</param>
            <param name="newPassword">New password to associate 
   * with specified service key and username</param> 
   *
   * @param ChangePasswordForServiceKey $parameters
   * @return ChangePasswordForServiceKeyResponse
   */
  public function ChangePasswordForServiceKey(ChangePasswordForServiceKey $parameters) {
    return $this->__soapCall('ChangePasswordForServiceKey', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Change the username for the specified service key and username.
 
   *            </summary>
            <param name="serviceKey">Service key</param>
     
   *        <param name="userName">Username associated with specified service key</param>
 
   *            <param name="password">Password associated with specified service key and username</param>
 
   *            <param name="newUsername">New username to associate with specified service 
   * key</param> 
   *
   * @param ChangeUsernameForServiceKey $parameters
   * @return ChangeUsernameForServiceKeyResponse
   */
  public function ChangeUsernameForServiceKey(ChangeUsernameForServiceKey $parameters) {
    return $this->__soapCall('ChangeUsernameForServiceKey', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Change the email address for the specified service key and username.
 
   *            </summary>
            <param name="serviceKey">Service key</param>
     
   *        <param name="userName">Username associated with specified service key</param>
 
   *            <param name="password">Password associated with specified service key and username</param>
 
   *            <param name="newEmail">New email to associate with specified service key and 
   * username</param> 
   *
   * @param ChangeEmailForServiceKey $parameters
   * @return ChangeEmailForServiceKeyResponse
   */
  public function ChangeEmailForServiceKey(ChangeEmailForServiceKey $parameters) {
    return $this->__soapCall('ChangeEmailForServiceKey', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Change the username for the specified service key and username.
 
   *            </summary>
            <param name="serviceKey">Service key</param>
     
   *        <param name="userName">Username associated with specified service key</param>
 
   *            <param name="password">Password associated with specified service key and username</param> 
   * 
   *
   * @param GetPasswordExpirationForServiceKey $parameters
   * @return GetPasswordExpirationForServiceKeyResponse
   */
  public function GetPasswordExpirationForServiceKey(GetPasswordExpirationForServiceKey $parameters) {
    return $this->__soapCall('GetPasswordExpirationForServiceKey', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Validates a provided merchant proifile. If the profile is invalid, 
   * the operation will throw a 
            CWSValidationResultFault containing the details 
   * of the exception. If your application does not implement 
            unmanaged merchant 
   * profiles – you do not need to call this method.  Your merchant profile will automatically 
   * 
            be validated when you call SaveMerchantProfiles.
            </summary>
 
   *            <param name="sessionToken">The session token associated with this call.</param>
 
   *            <param name="serviceId">The service id of record for the profile.</param>
 
   *            <param name="tenderType">The tender type of record for the profile.</param>
 
   *            <param name="merchantProfile">The merchant profile.</param> 
   *
   * @param ValidateMerchantProfile $parameters
   * @return ValidateMerchantProfileResponse
   */
  public function ValidateMerchantProfile(ValidateMerchantProfile $parameters) {
    return $this->__soapCall('ValidateMerchantProfile', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Get a list of claims given a pair of security tokens. The claims 
   * returned are presented as a list of ClaimMetaData objects which is a pairing of the claim 
   * namespace and the claim value.
            </summary>
            <param name="authenticatingToken">This 
   * security token is used to authorize the request by verifying the 'verifiedToken' and extract 
   * claims data from it.</param>
            <param name="verifiedToken">The security token 
   * that will yield the claims data.</param>
            <returns>A list of claim namespace 
   * and value pairs.</returns> 
   *
   * @param GetAllClaims $parameters
   * @return GetAllClaimsResponse
   */
  public function GetAllClaims(GetAllClaims $parameters) {
    return $this->__soapCall('GetAllClaims', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Get a list of claims, within a specific list of claim namespaces, 
   * given a pair of security tokens. The claims returned are presented as a list of values 
   * that are sequenced to collate with the order of the 
            list of namespaces passed 
   * in.
            </summary>
            <param name="authenticatingToken">This security 
   * token is used to authorize the request by verifying the 'verifiedToken' and extract claims 
   * data from it.</param>
            <param name="verifiedToken">The security token that 
   * will yield the claims data.</param>
            <param name="claimNSs">A list of claims 
   * namespaces to limit the list of claims returned. The returned list if claim values will 
   * be in the same order as specified in this list.</param>
            <returns>A list of 
   * claims values.</returns> 
   *
   * @param GetClaims $parameters
   * @return GetClaimsResponse
   */
  public function GetClaims(GetClaims $parameters) {
    return $this->__soapCall('GetClaims', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
            Uses an identity token to authorize the renewal of a another, lower-level 
   * security token.
            </summary>
            <param name="authenticatingToken">An 
   * identity token that is used to authorize the renewal of the 'toRenewToken' parameter.</param>
 
   *            <param name="toRenewToken">A security token that is to be renewed.</param>
 
   *            <returns>A renewed token.</returns> 
   *
   * @param Renew $parameters
   * @return RenewResponse
   */
  public function Renew(Renew $parameters) {
    return $this->__soapCall('Renew', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
             Allows a service key identity token holder to add dynamic claims 
   * as allowed for their service key
             to the resultant session token
       
   *      </summary>
             <param name="identityToken">Identity token associated with 
   * your service key</param>
            <param name="claims">claims to add to the generated 
   * session token</param>
            <returns>session token</returns> 
   *
   * @param SignOnAndAddClaims $parameters
   * @return SignOnAndAddClaimsResponse
   */
  public function SignOnAndAddClaims(SignOnAndAddClaims $parameters) {
    return $this->__soapCall('SignOnAndAddClaims', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
             Allows an initiator (IDT) to receive a session token for onBehalf 
   * SK and add dynamic claims as 
             allowed for their service key
           
   *  </summary>
             <param name="identityToken">Identity token associated with your 
   * service key</param>
            <param name="onBehalfOfSk">service key to generate session 
   * token for.</param>
            <param name="claims">claims to add to the generated session 
   * token</param>
            <returns>session token</returns> 
   *
   * @param DelegatedSignOn $parameters
   * @return DelegatedSignOnResponse
   */
  public function DelegatedSignOn(DelegatedSignOn $parameters) {
    return $this->__soapCall('DelegatedSignOn', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
             Allow a service key identity token holder to receive a session 
   * token with some claims sourced from an external domain token
            </summary>
 
   *             <param name="identityToken">Identity token associated with your service key</param>
 
   *            <param name="externalDomainToken">external domain token containing claims to 
   * add to session token</param>
            <returns>session token</returns> 
   *
   * @param FederatedSignOn $parameters
   * @return FederatedSignOnResponse
   */
  public function FederatedSignOn(FederatedSignOn $parameters) {
    return $this->__soapCall('FederatedSignOn', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

  /**
   * <summary>
             Allow a service key identity token holder to receive a session 
   * token with some claims sourced from an 
             external domain token and add dynamic 
   * claims as allowed for their service key
            </summary>
             <param name="identityToken">Identity 
   * token associated with your service key</param>
            <param name="externalDomainToken">external 
   * domain token containing claims to add to session token</param>
            <param name="claims">claims 
   * to add to the generated session token</param>
            <returns>session token</returns> 
   * 
   *
   * @param FederatedSignOnAndAddClaims $parameters
   * @return FederatedSignOnAndAddClaimsResponse
   */
  public function FederatedSignOnAndAddClaims(FederatedSignOnAndAddClaims $parameters) {
    return $this->__soapCall('FederatedSignOnAndAddClaims', array($parameters),       array(
            'uri' => 'http://schemas.ipcommerce.com/CWS/v2.0/ServiceInformation',
            'soapaction' => ''
           )
      );
  }

}

?>
