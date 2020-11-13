# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]


## [2.2.0] - 2020-11-13
### Added
- Add support for new tarteaucitron.js settings: `privacyUrl`, `cookieName`,
  `showIcon`, `iconPosition`, `DenyAllCta`, `moreInfoLink`, `readmoreLink`,
  & `mandatory`
- Force tarteaucitron.js to use the same language as Craft by default
  (may be disabled to get the old behavior)

### Changed
- Updated tarteaucitron.js
- Merge dependabot PRs

### Fixed
- A bug that prevented forcing tarteaucitron.js language


## [2.1.1] - 2020-09-07
### Changed
- Merge dependabot PRs


## [2.1.0] - 2020-09-07
### Added
- Support Youtube Js API tarteaucitron.js service

### Changed
- Updated tarteaucitron.js

### Fixed
- Typo in french translation


## [2.0.2] - 2020-06-24
### Changed
- Updated tarteaucitron.js
- Fix a composer deprecation notice (due to a filename classname case mismatch)


## [2.0.1] - 2020-03-19
### Changed
Updated tarteaucitron.js (we're currently using the
[nstCactus/tarteaucitron.js] fork until the following PRs are merged:
  - [#421](https://github.com/AmauriC/tarteaucitron.js/pull/421)
  - [#422](https://github.com/AmauriC/tarteaucitron.js/pull/422)
  - [#423](https://github.com/AmauriC/tarteaucitron.js/pull/423)


## [2.0.0] - 2020-31-01
First public release

[Unreleased]: https://github.com/la-haute-societe/craft-tarteaucitron/compare/2.2.0...HEAD
[2.2.0]: https://github.com/la-haute-societe/craft-tarteaucitron/compare/2.1.0...2.2.0
[2.1.0]: https://github.com/la-haute-societe/craft-tarteaucitron/compare/2.0.2...2.1.0
[2.0.2]: https://github.com/la-haute-societe/craft-tarteaucitron/compare/2.0.1...2.0.2
[2.0.1]: https://github.com/la-haute-societe/craft-tarteaucitron/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/la-haute-societe/craft-tarteaucitron/releases/tag/2.0.0
[nstCactus/tarteaucitron.js]: https://github.com/nstCactus/tarteaucitron.js
