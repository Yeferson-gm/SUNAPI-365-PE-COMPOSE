# Composer SDK Architecture

## Status

Active. This package is the PHP public client surface and should stay thin, explicit, and easy to scale.

## Purpose

The Composer SDK gives PHP consumers a stable way to call SUNAPI without reimplementing business rules.

## Real structure

```text
compose/
├── composer.json
└── src/
    ├── Concerns/
    ├── Http/
    ├── Resources/
    │   ├── Documents/
    │   ├── Tickets/
    │   └── ...
    ├── SunApiSdk.php
    └── SunApiSdkError.php
```

## Ownership

### `src/Http/`
Owns low-level request transport behavior.

### `src/Resources/`
Owns resource-oriented wrappers over backend public endpoints. Shared path and constrained-value helpers should stay centralized here instead of being reimplemented in each resource.

### `src/Resources/Documents/` and `src/Resources/Tickets/`
Own internal domain-specific traits used to keep large resource classes split by lifecycle responsibility while preserving the same public resource classes.

### `src/Concerns/`
Owns grouped facade behavior by domain so the public SDK surface can grow without collapsing into a monolithic class file.

### `src/SunApiSdk.php`
Owns the main public facade, resource access composition, and stable entry surface.

### `src/SunApiSdkError.php`
Owns package-specific error representation.

## Boundary rules

- The Composer SDK adapts backend contracts; it does not reinterpret them.
- Resource classes should stay close to API semantics.
- Traits under `Concerns/` group public facade methods by domain, but they must not become a second resource layer.
- Concern files should remain readable as the facade grows; internal formatting and grouping are part of maintainability, not cosmetic churn.
- The public facade should remain curated, not a dumping ground for unrelated helper logic.
- Package metadata and autoload paths are part of the public contract.

## Scaling rule

When the facade grows, prefer splitting by domain concern instead of keeping hundreds of public methods in one file. Preserve the same public API while improving maintainability internally.

## Typing and safety rules

- Prefer explicit PHP method signatures and documented array shapes where possible.
- Avoid magical argument conventions that hide environment or lifecycle behavior.
- Keep error translation predictable and package-local.
- Validate known constrained values such as environments and file types before building requests.

## Do not do this

- Do not create PHP-only lifecycle shortcuts that change backend meaning.
- Do not collapse neutral and environment-bound resources into one ambiguous method family.
- Do not let transport concerns leak everywhere instead of staying in the HTTP layer.
- Do not re-grow `SunApiSdk.php` into a monolithic facade when a concern split is more maintainable.
