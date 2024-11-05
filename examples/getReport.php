<?php
declare(strict_types=1);

['api' => $api, 'credentials' => $credentials] = require 'client.php';
require_once 'helper.php';

use Readdle\AppStoreServerAPI\Exception\AppStoreServerAPIException;

try {
    $reportInfoResponse = $api->retrieveExternalPurchaseReport($credentials['requestIdentifier']);
} catch (AppStoreServerAPIException $e) {
    exit($e->getMessage());
}

$reportInfo = $reportInfoResponse->getReport();

//printJsonSerializableEntity($reportInfo['report']);
//echo "\nAs JSON: " . json_encode($reportInfo) . "\n\n";
var_dump($reportInfo);