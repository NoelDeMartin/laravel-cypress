# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v0.3.0](https://github.com/NoelDeMartin/laravel-cypress/releases/tag/v0.3.0) - 2020-10-04

### Changed

- Models namespace is `null` by default and it will be guessed looking at project folders. It is still possible to set an explicit namespace calling `Cypress::setModelsNamespace()`

## [v0.2.2](https://github.com/NoelDeMartin/laravel-cypress/releases/tag/v0.2.2) - 2020-10-03

### Fixed

- Missing import for Exception when model factories are not available.

## [v0.2.1](https://github.com/NoelDeMartin/laravel-cypress/releases/tag/v0.2.1) - 2020-09-27

### Added

- [#5](https://github.com/NoelDeMartin/laravel-cypress/issues/5) [#6](https://github.com/NoelDeMartin/laravel-cypress/issues/6) Support Laravel 8 factories.

## [v0.2.0](https://github.com/NoelDeMartin/laravel-cypress/releases/tag/v0.2.0) - 2020-08-30

### Added

- Helpers to [define custom commands](https://github.com/NoelDeMartin/cypress-laravel/tree/v0.2.0#define-your-own-commands).

## [v0.1.1](https://github.com/NoelDeMartin/laravel-cypress/releases/tag/v0.1.1) - 2020-05-30

### Fixed

- [#3](https://github.com/NoelDeMartin/laravel-cypress/issues/3) Removed App\ namespace usage.

## [v0.1.0](https://github.com/NoelDeMartin/laravel-cypress/releases/tag/v0.1.0) - 2020-05-09

### Changed

- The database is not migrated in the setup any longer. In order to continue migrating the database, use `useDatabaseMigrations()` from the [cypress-laravel](https://github.com/NoelDeMartin/cypress-laravel) package.

## [v0.0.4](https://github.com/NoelDeMartin/laravel-cypress/releases/tag/v0.0.4) - 2020-04-18

### Added

- First complete release: [Testing Laravel Applications Using Cypress](https://noeldemartin.com/blog/testing-laravel-applications-using-cypress).
