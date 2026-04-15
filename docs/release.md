# Composer SDK Release Rules

## Status

Active. This file defines packaging and publication expectations.

## Release expectations

- Public method changes must be intentional.
- Composer metadata changes are contract changes.
- Autoload paths must remain aligned with repository layout.
- Example code must stay aligned with the real public API.

## Review triggers

Review this file whenever any of the following changes:

- package name
- PHP version support
- namespace or PSR-4 autoload mapping
- public facade structure
- resource method naming
- support/source/docs links

## Composer / Packagist publication flow

This package is released through Git tags and then refreshed in Packagist.

Recommended flow:

```bash
git status
git add .
git commit -m "Describe the release"
git push origin main
git tag v<version>
git push origin v<version>
```

After the Git tag is available remotely:

1. open the package page in Packagist
2. click `Update`
3. verify the new tag appears as an available package version

Operational notes:

- Packagist commonly tracks Composer package versions from Git tags, not from a manual `version` field in `composer.json`.
- If Packagist shows `This package is not auto-updated`, the maintainer must either click `Update` manually after each release or configure the GitHub webhook for automatic refresh.
- The package name `sunapi365/sdk` must remain aligned with the Packagist entry.

## Versioning rules for Composer releases

- `vX.Y.Z` patch release → small fix release
- `vX.Y.0` minor release → new backward-compatible functionality
- `vX.0.0` major release → breaking compatibility changes

## Do not do this

- Do not change package metadata casually.
- Do not ship undocumented breaking surface changes.
- Do not let release notes focus only on implementation details while ignoring contract impact.
