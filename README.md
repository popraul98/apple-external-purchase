# apple-external-purchase

# About

This is a ***zero-dependencies\* pure PHP*** library that allows managing customer transactions using the [`App Store Server API`](https://developer.apple.com/documentation/appstoreserverapi) and handling server-to-server notifications by providing everything you need to implement the [`App Store Server Notifications V2`](https://developer.apple.com/documentation/appstoreservernotifications) endpoint.

<sub>* Zero-dependencies means this library doesn't rely on any third-party library. At the same time, this library relies on such essential PHP extensions as `json` and `openssl`</sub>

> **NOTE**
> 
> If you need to deal with receipts instead of (or additionally to) API, check out [this library](https://github.com/readdle/app-store-receipt-verification).

# Installation

Nothing special here, just use composer to install the package:

> composer require readdle/app-store-server-api

# Usage

### App Store Server API

API initialization:

```
try {
    $api = new \Readdle\AppStoreServerAPI\AppStoreServerAPI(
        \Readdle\AppStoreServerAPI\Environment::PRODUCTION,
        '1a2b3c4d-1234-4321-1111-1a2b3c4d5e6f',
        'com.readdle.MyBundle',
        'ABC1234DEF',
        "-----BEGIN PRIVATE KEY-----\n<base64-encoded private key goes here>\n-----END PRIVATE KEY-----"
    );
} catch (\Readdle\AppStoreServerAPI\Exception\WrongEnvironmentException $e) {
    exit($e->getMessage());
}
```

Performing API call:

```
try {
    $transactionHistory = $api->getTransactionHistory($transactionId, ['sort' => GetTransactionHistoryQueryParams::SORT__DESCENDING]);
    $transactions = $transactionHistory->getTransactions();
} catch (\Readdle\AppStoreServerAPI\Exception\AppStoreServerAPIException $e) {
    exit($e->getMessage());
}
```

### App Store Server Notifications

```
try {
    $responseBodyV2 = \Readdle\AppStoreServerAPI\ResponseBodyV2::createFromRawNotification(
        '{"signedPayload":"..."}',
        \Readdle\AppStoreServerAPI\Util\Helper::toPEM(file_get_contents('https://www.apple.com/certificateauthority/AppleRootCA-G3.cer'))
    );
} catch (\Readdle\AppStoreServerAPI\Exception\AppStoreServerNotificationException $e) {
    exit('Server notification could not be processed: ' . $e->getMessage());
}
```

# Examples

In `examples/` directory you can find examples for all implemented endpoints. Initialization of the API client is separated into `client.php` and used in all examples.

In order to run examples you have to create `credentials.json` and/or `notifications.json` inside `examples/` directory.

`credentials.json` structure should be as follows:

```
{
  "env": "Production",
  "issuerId": "1a2b3c4d-1234-4321-1111-1a2b3c4d5e6f",
  "bundleId": "com.readdle.MyBundle",
  "keyId": "ABC1234DEF",
  "key": "-----BEGIN PRIVATE KEY-----\n<base64-encoded private key goes here>\n-----END PRIVATE KEY-----",
  "orderId": "ABC1234DEF",
  "transactionId": "123456789012345"
}
```

In most examples `transactionId` is used. Please, consider that `transactionId` is related to `environment`, so if you put `transactionId` from the sandbox the `environment` property should be `Sandbox` as well, otherwise you'll get `{"errorCode":4040010,"errorMessage":"Transaction id not found."}` error. 

For `Order ID lookup` you have to specify `orderId`. This endpoint (and, consequently, the example) is not available in the sandbox environment.

`notification.json` structure is the same as you receive it in your server-to-server notification endpoint:

```
{"signedPayload":"<JWT token goes here>"}
```
