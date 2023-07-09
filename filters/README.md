# AbuseFilter Filters

This directory contains filters used with [Extension:AbuseFilter](https://mediawiki.org/wiki/Extension:AbuseFilter).

## Filters and Rules

### `block-uploads-missing-info`
Blocks file uploads that do not contain a category or a license.

Checks for the following license templates:
- {{license-rsi}}
- {{self}}
- {{cc-*}}

Uses the following message: `MediaWiki:abusefilter-missing-file-info`

### `warning-uploads-missing-gamebuild-category`
Warns a user that a Screenshot upload does not contain a game build category.

Uses the following message: `MediaWiki:abusefilter-missing-gamebuild-category`