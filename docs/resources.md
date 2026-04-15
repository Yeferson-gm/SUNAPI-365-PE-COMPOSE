# Composer SDK Resources

## Status

Active. This file defines how PHP resource wrappers should be grouped and named.

## Current resource families

- auth
- catalogs
- companies
- branches
- customers
- products
- credentials
- settings
- webhooks
- documents
- tickets

## Resource rules

- Group wrappers by domain-facing resource.
- Keep document and ticket lifecycle semantics explicit.
- Preserve neutral versus environment-bound distinctions.
- Use method names that reveal whether an action reads, creates, updates, submits, downloads, or delivers.
- When a resource class grows too large, split its internal implementation by lifecycle responsibility under a domain subfolder while preserving the same public class.

## Lifecycle rules

When applicable, keep these phases distinct:

- create locally
- submit to SUNAT
- inspect status/history
- generate or download files
- perform delivery actions
- formalize tickets or batches

## Contract alignment

- If backend route or payload semantics change, update PHP methods, examples, and docs together.
- If a capability is intentionally unavailable in the PHP SDK, do not imply otherwise in docs.
- Composite helpers should document stable result keys such as `created`, `sentToSunat`, `formalized`, and `whatsapp`.

## Do not do this

- Do not merge unrelated domains into generic helpers.
- Do not hide destructive behavior behind vague method names.
- Do not add PHP sugar that makes `sandbox` and `production` behavior ambiguous.
