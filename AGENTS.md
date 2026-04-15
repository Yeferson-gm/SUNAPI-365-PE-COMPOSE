# SUNAPI Composer SDK — Agent Guide

> Read `../MAP.md` first, then `../AGENTS.md`, then this file.

## Scope

`compose/` is the public PHP Composer SDK for SUNAPI. It owns:

- the PHP SDK facade
- HTTP client wiring for PHP consumers
- resource-oriented PHP wrappers
- public package metadata for Composer distribution

It does **not** own business-rule reinterpretation or SDK-only fiscal behavior.

## Stack

- PHP 8.1+
- Composer
- PSR-4 autoloading

## Package layout

```text
compose/
├── AGENTS.md
├── docs/
├── src/
│   ├── Http/
│   ├── Resources/
│   ├── SunApiSdk.php
│   └── SunApiSdkError.php
└── composer.json
```

## Mandatory rules

- Mirror backend behavior; do not redefine fiscal rules in PHP helpers.
- Keep the package lightweight and predictable for Composer consumers.
- Preserve the distinction between neutral resources and environment-bound fiscal resources.
- Keep public method names explicit about lifecycle intent.
- Update examples and docs whenever public methods or package metadata change.

## Read next depending on the task

- structure and public surface boundaries → `compose/docs/architecture.md`
- resource grouping and lifecycle expectations → `compose/docs/resources.md`
- release and package metadata expectations → `compose/docs/release.md`

## Validation

At minimum, validate:

- `composer.json` consistency
- PSR-4 path assumptions
- public docs/examples alignment

If PHP runtime validation is available later, add it, but do not invent success without running it.

## Do not do this

- Do not hide SUNAT or environment-sensitive behavior behind vague PHP helpers.
- Do not expose undocumented internal backend flows.
- Do not let examples drift from the real public API.
- Do not expand the root facade without documenting the contract impact.

## When uncertain

If a convenience helper would obscure important backend behavior, prefer a more explicit method or document the tradeoff before adding it.
