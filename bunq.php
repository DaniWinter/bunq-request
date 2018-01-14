<?php
/*
* bunq Requests Helper
* An easy way to create requests.
* Because the bunq API is a mess, this code can get you started without needing to guess how things work.
* Coded by Qarizma
* https://www.github.com/qarizma
*/

use bunq\Context\ApiContext;
use bunq\Http\ApiClient;
use bunq\Model\Generated\Endpoint\AttachmentPublic;
use bunq\Model\Generated\Endpoint\AttachmentTab;
use bunq\Model\Generated\Endpoint\Avatar;
use bunq\Model\Generated\Endpoint\CashRegister;
use bunq\Model\Generated\Endpoint\MonetaryAccount;
use bunq\Model\Generated\Endpoint\TabItemShop;
use bunq\Model\Generated\Endpoint\TabUsageSingle;
use bunq\Model\Generated\Object\Amount;
use bunq\Model\Generated\Object\Geolocation;
use bunq\Model\Generated\Object\TabVisibility;
use bunq\Util\BunqEnumApiEnvironmentType;
use bunq\Model\Generated\Endpoint\User;
use bunq\Model\Generated\Endpoint\UserCompany;
use bunq\Model\Generated\Endpoint\BunqMeTab;
use bunq\Model\Generated\Endpoint\BunqMeTabEntry;
require_once __DIR__ . '/vendor/autoload.php';

/*
* Creates a PRODUCTION bunq context which is required for API interaction.
* This should be executed once, then bunq.conf will be created for future use.
*/
function bunq_CreateContext($key, $device, $ips = []) {

	$apiContext = ApiContext::create(BunqEnumApiEnvironmentType::PRODUCTION(), $key, $device);
	$apiContext->save(ApiContext::FILENAME_CONFIG_DEFAULT);
	
}

/*
* Creates a SANDBOX bunq context which is required for API interaction.
* This should be executed once, then bunq.conf will be created for future use.
*/
function bunq_CreateContextSandbox($key, $device, $ips = []) {

	$apiContext = ApiContext::create(BunqEnumApiEnvironmentType::SANDBOX(), $key, $device);
	$apiContext->save(ApiContext::FILENAME_CONFIG_DEFAULT);

}

/*
* Creates a bunq payment request which can be shared with anyone.
* Requires the amount of payment, description and redirect url.
* Optionally you can pass user id and account id.
* Returns the array as seen below, including the raw object from the API.
*/
function bunq_CreateRequest($amount, $description, $redirect, $user = 0, $account = 0) {

	$apiContext = ApiContext::restore(ApiContext::FILENAME_CONFIG_DEFAULT);
	$users = User::listing($apiContext)->getValue();
	//$user = $users[$user]->getUserPerson();
	$user = $users[$user]->getUserCompany();
	$userId = $user->getId();
	$monetaryAccounts = MonetaryAccount::listing($apiContext, $userId)->getValue();
	$monetaryAccount = $monetaryAccounts[$account]->getMonetaryAccountBank();
	$monetaryAccountId = $monetaryAccount->getId();
	$requestMap = [
		BunqMeTab::FIELD_BUNQME_TAB_ENTRY => [
			BunqMeTabEntry::FIELD_AMOUNT_INQUIRED => new Amount($amount, 'EUR'),
			BunqMeTabEntry::FIELD_REDIRECT_URL => $redirect,
			BunqMeTabEntry::FIELD_DESCRIPTION => $description
		]
	];
	$createBunqMeTab = BunqMeTab::create($apiContext, $requestMap, $userId, $monetaryAccountId)->getValue();
	$bunqMeRequest = BunqMeTab::get($apiContext, $userId, $monetaryAccountId, $createBunqMeTab)->getValue();
	$r["id"] = $bunqMeRequest->getId();
	$r["uuid"] = $bunqMeRequest->getBunqmeTabEntry()->getUuid();
	$r["amount"] = $bunqMeRequest->getBunqmeTabEntry()->getAmountInquired()->getValue();
	$r["paymentlink"] = $bunqMeRequest->getBunqmeTabShareUrl();
	$r["status"] = $bunqMeRequest->getBunqmeTabEntry()->getStatus();
	$r["description"] = $bunqMeRequest->getBunqmeTabEntry()->getDescription();
	$r["redirecturl"] = $bunqMeRequest->getBunqmeTabEntry()->getRedirectUrl();
	$r["raw"] = $bunqMeRequest;
	return $r;

}

/*
* Gets the status of the payment request, so you can check if it's paid or nah.
* Requires the payment ID (not UUID), and optionally user id with account id.
* Returns the array as seen below, including the raw object from the API.
* TODO: Implement resultInquiries[] to get actual information about the payer.
*/
function bunq_StatusRequest($id, $user = 0, $account = 0) {

	$apiContext = ApiContext::restore(ApiContext::FILENAME_CONFIG_DEFAULT);
	$users = User::listing($apiContext)->getValue();
	$user = $users[$user]->getUserCompany();
	$userId = $user->getId();
	$monetaryAccounts = MonetaryAccount::listing($apiContext, $userId)->getValue();
	$monetaryAccount = $monetaryAccounts[$account]->getMonetaryAccountBank();
	$monetaryAccountId = $monetaryAccount->getId();
	$bunqMeRequest = BunqMeTab::get($apiContext, $userId, $monetaryAccountId, $id)->getValue();
	$r["id"] = $bunqMeRequest->getId();
	$r["uuid"] = $bunqMeRequest->getBunqmeTabEntry()->getUuid();
	$r["amount"] = $bunqMeRequest->getBunqmeTabEntry()->getAmountInquired()->getValue();
	$r["paymentlink"] = $bunqMeRequest->getBunqmeTabShareUrl();
	$r["status"] = $bunqMeRequest->getBunqmeTabEntry()->getStatus();
	$r["description"] = $bunqMeRequest->getBunqmeTabEntry()->getDescription();
	$r["redirecturl"] = $bunqMeRequest->getBunqmeTabEntry()->getRedirectUrl();
	// We still need to add the contents of resultInquiries[], but I can't test it so I didn't implement it.
	$r["raw"] = $bunqMeRequest;
	return $r;

}

/*
* EXAMPLE CODE
*/

// Run the following line just once:
//bunq_CreateContextSandbox("API-KEY-HERE", "My server name");

$create = bunq_CreateRequest("10", "My Payment", 0, 0, "http://bunq.com/");
echo "<pre>";
print_r($create);
echo "</pre>";

echo "<hr>";

$status = bunq_StatusRequest($create["id"]);
echo "<pre>";
print_r($status);
echo "</pre>";

/*
* BETA CODE
* WARNING THE FOLLOWING CODE HAS NOT BEEN TESTED OR OPTIMISED!!!
* I don't have bunq Premium to test this out, and the sandbox mode of bunq isn't really functional (it doesn't return real data).
* These functions have been ported from Javascript to work with PHP.
*/
/*
// generateId() generates a unique ID used for API calls.
// Ported from Javascript @ https://github.com/basst85/bunq_pay
function generateId() {
	return bin2hex(random_bytes(8))."-".bin2hex(random_bytes(4))."-".bin2hex(random_bytes(4))."-".bin2hex(random_bytes(4))."-".bin2hex(random_bytes(12));
}

// getBanks() function to get all current banks from bunq for iDeal payment.
// Ported from Javascript @ https://github.com/basst85/bunq_pay
function getBanks() {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.bunq.me/v1/bunqme-merchant-directory-ideal");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = ['X-Bunq-Client-Request-Id: '.generateId()];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$server_output = json_decode(curl_exec($ch), true);
curl_close ($ch);
return $server_output['Response'][0]['IdealDirectory']['country'][0]['issuer'];
}
// print_r(getBanks()); // prints all banks

// getiDeal() function should return the direct iDeal link based on the bank.
// Ported from Javascript @ https://github.com/basst85/bunq_pay
function getiDeal($uuid) {
$json = '{"amount_requested":{"currency":"EUR","value":"10"}, "bunqme_type":"TAB", "issuer":"RABONL2U","merchant_type":"IDEAL","bunqme_uuid":"'.$uuid.'"}';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.bunq.me/v1/bunqme-merchant-request");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = ['X-Bunq-Client-Request-Id: '.generateId()];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$server_output = json_decode(curl_exec($ch), true);
curl_close ($ch);
return $server_output;
}
//print_r(getiDeal($getUuid)); // prints the results from the ideal request

// getQR() function should echo a QR image for bunq users
// Ported from Javascript @ https://github.com/basst85/bunq_pay
function getQR($uuid) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.bunq.me/v1/bunqme-tab-entry/".$uuid."/qr-code-content");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, []);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = ['X-Bunq-Client-Request-Id: '.generateId()];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$server_output = json_decode(curl_exec($ch), true);
curl_close ($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.bunq.me/v1/bunqme-tab-entry/".$uuid."/qr-code-content/".$server_output['Response'][0]['Uuid']['uuid']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = ['X-Bunq-Client-Request-Id: '.generateId()];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$server_output = json_decode(curl_exec($ch), true);
curl_close ($ch);
echo "<img src='data:image/png;base64,".$server_output['Response'][0]['QrCodeImage']['base64']."'>";
}
//echo getQR($getUuid); // should display an image with the QR code
*/
