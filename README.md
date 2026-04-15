![SUNAPI Composer SDK](https://prestify.pe/blog/wp-content/uploads/2023/06/Que-es-el-RUC-en-Sunat-y-por-que-tu-negocio-lo-necesita-2.jpg)

# sunapi365/sdk

Official PHP Composer package for SUNAPI.

This package is intentionally separated from the npm SDK. JavaScript and TypeScript belong in the
npm package. PHP belongs in Composer. Keeping them separate avoids mixed release workflows, package
manager drift, and API examples that leak assumptions from one language ecosystem into another.

## Why this package exists

SUNAPI exposes operational resources and fiscal document flows that PHP backends may want to use
without building raw HTTP clients around every endpoint.

This package keeps that surface organized:

- one Composer package for PHP consumers
- PSR-4 autoloading
- resource classes grouped by domain
- one stable facade for teams that prefer a single entrypoint
- configurable API endpoint with a production-safe default

## Install

```bash
composer require sunapi365/sdk
```

## Quick start

```php
<?php

use SunApi365\Sdk\SunApiSdk;

$sdk = new SunApiSdk();

$tokens = $sdk->oauthClientCredentials('YOUR_CLIENT_ID', 'YOUR_CLIENT_SECRET');
$sdk->setAccessToken($tokens['accessToken']);

$companies = $sdk->listCompanies();
$products = $sdk->products()->list([
    'companyId' => 'YOUR_COMPANY_ID',
]);
```

## Package structure

```text
compose/
  composer.json
  src/
    SunApiSdk.php
    SunApiSdkError.php
    Http/
      SunApiHttpClient.php
    Resources/
      AuthResource.php
      CatalogsResource.php
      CompaniesResource.php
      BranchesResource.php
      CustomersResource.php
      ProductsResource.php
      CredentialsResource.php
      SettingsResource.php
      WebhooksResource.php
      DocumentsResource.php
```

## Design

- `SunApiHttpClient` owns base URL, access token, headers, and request execution
- `Resources/*` group behavior by domain instead of concentrating everything in one large class
- `SunApiSdk` stays as the stable public facade for consumers that want one entrypoint

## Endpoint strategy

The default endpoint is:

```text
https://api.sunapi.site
```

That is the right default for a public Composer package. The constructor still allows overriding the
base URL for local development, staging, reverse proxies, or internal routing.

## Authentication

The package supports the same public OAuth modes exposed by SUNAPI:

- `clientCredentials`
- `password`
- `refreshToken`

Server-to-server integrations should prefer `clientCredentials`.

```php
$tokens = $sdk->oauthClientCredentials('YOUR_CLIENT_ID', 'YOUR_CLIENT_SECRET');
$sdk->setAccessToken($tokens['accessToken']);
```

## Example: products

```php
$products = $sdk->products()->list([
    'companyId' => 'YOUR_COMPANY_ID',
]);

$created = $sdk->products()->create([
    'companyId' => 'YOUR_COMPANY_ID',
    'code' => 'PROD-001',
    'name' => 'Producto demo',
    'unit' => 'NIU',
    'unitPrice' => 100,
    'igvAffectationType' => '10',
]);
```

## Example: invoices

```php
$created = $sdk->documents()->createInvoice('sandbox', [
    'companyId' => 'YOUR_COMPANY_ID',
    'branchId' => 'YOUR_BRANCH_ID',
    'processingMode' => 'sync',
    'series' => 'F001',
    'issueDate' => '2026-04-15',
    'currency' => 'PEN',
    'paymentType' => 'cash',
    'paymentMethod' => 'transferencia',
    'client' => [
        'documentType' => '6',
        'documentNumber' => 'RUC_CLIENTE_DEMO',
        'legalName' => 'CLIENTE DEMO S.A.C.',
    ],
    'details' => [
        [
            'code' => 'PROD-001',
            'description' => 'Producto demo',
            'unit' => 'NIU',
            'quantity' => 1,
            'unitPrice' => 100,
            'igvPercent' => 18,
            'igvAffectationType' => '10',
        ],
    ],
]);

$sdk->documents()->sendInvoiceToSunat('sandbox', $created['data']['id'], 'sync');
```

## Publication readiness

The package is already prepared with:

- PSR-4 autoloading
- support metadata in `composer.json`
- resource-based internal structure
- a stable facade for consumer ergonomics
- a README ready for Packagist presentation
