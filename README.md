# SUNAPI Composer SDK

Private proprietary PHP Composer SDK for SUNAPI.

## Executive summary

This repository packages the SUNAPI integration surface for PHP teams through a lightweight Composer library. It mirrors the real backend contracts and exposes explicit PHP helpers without moving business logic out of the backend.

## What this repository owns

- PHP SDK facade
- SUNAPI HTTP client wiring for PHP consumers
- resource-oriented PHP wrappers
- Composer package metadata and release surface

## Stack

- PHP 8.1+
- Composer
- PSR-4 autoloading

## Why this package exists separately

This Composer package is designed to live in its own private repository because it has its own language ecosystem, package registry workflow, release semantics, and consumer expectations distinct from the JavaScript SDK and the backend runtime.

## Package structure

```text
compose/
├── composer.json
├── src/
│   ├── Http/
│   ├── Resources/
│   ├── SunApiSdk.php
│   └── SunApiSdkError.php
├── README.md
└── LICENSE.md
```

## Install (private/internal use)

```bash
composer install
```

## Publishing to Packagist

The detailed release rules live in `compose/docs/release.md`.

Minimal publication flow:

```bash
git push origin main
git tag v<version>
git push origin v<version>
```

Then refresh the package in Packagist with the `Update` button, unless the repository webhook is already configured for automatic updates.

## Operating rule

This package must mirror backend behavior faithfully. It should provide explicit PHP ergonomics, but it must not hide environment-sensitive fiscal behavior or invent package-only lifecycle shortcuts.

## License

This repository is private and proprietary. See [`LICENSE.md`](./LICENSE.md).
