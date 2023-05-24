# Kontomatik SDK

This repository provides the PHP SDK for Kontomatik.

## Installation

Via composer

```sh
composer require goosfraba/kontomatik-sdk
```

## Usage

### ApiFactory

In order to create the particular API, first you need the `ApiFactory` instance.

```php
<?php
use Goosfraba\Kontomatik\Common\ApiFactory;

$apiFactory = new ApiFactory(
    $logger = null // optionally, provide the logger to catch the raw responses from the API, it needs to work with level "Debug"
);

```

### ImportingApi
Get the `ImportingApi` instance

```php
<?php
use Goosfraba\Kontomatik\Common\Dsn;

$importingApi = $apiFactory->importingApi(
    Dsn::parse(
        "kontomatik://your-api-key@prod" // or "kontomatik://your-api-key@test"
    );
);

```

Supported methods:
 * defaultImport
 * getCommand
 * getData
 * removeData
 * signOut

### LendingApi
Get the `ImportingApi` instance

```php
<?php
use Goosfraba\Kontomatik\Common\Dsn;

$api = $apiFactory->lendingApi(
    Dsn::parse(
        "kontomatik://your-api-key@prod" // or "kontomatik://your-api-key@test"
    );
);
```

Supported methods:
* getScores

### Importing data use case / scoring

```php
use Goosfraba\Kontomatik\Importing\Session;

$commandReply = $importingApi->defaultImport(
    new Session("known-id", "known-signature"),
    date_create_immutable("now - 6 months") // import data for last 6 months
);

$commandId = $commandReply->getCommand()->getId();
$ownerExternalId = $commandReply->getOwnerExternalId();

do {
    /** @var \Goosfraba\Kontomatik\Importing\CommandReply $commandReply */
    $commandReply = $importingApi->getCommand($commandId));
} while(!$commandReply->getCommand()->isFinished() && sleep(5) === 0);

if ($commandReply->isSuccessful()) {
    $ownerScoreReply = $lendingApi->getScore($ownerExternalId);
}

```

## Contribution
Feel free to add unsupported endpoints or fix the bugs found.
