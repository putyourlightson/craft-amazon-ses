# Amazon SES Changelog

## 2.0.0 - Unreleased
### Added
- Added compatibility with Craft 4.

## 1.3.4 - 2021-06-08
### Changed
- The send method now throws an exception so that the Craft mailer can catch and log the exception ([#13](https://github.com/putyourlightson/craft-amazon-ses/issues/13)). 

## 1.3.3 - 2021-02-17
### Fixed
- Fixed the configuration set value not being parsed for environment variables ([#12](https://github.com/putyourlightson/craft-amazon-ses/issues/12)). 

## 1.3.2 - 2020-10-28
### Added
- Added `us-east-2`, `us-west-1`, `ap-northeast-2`, `ap-southeast-1`, `ap-northeast-1`, `eu-west-3` and `eu-north-1` as valid [service endpoint regions](https://docs.aws.amazon.com/general/latest/gr/ses.html) ([#11](https://github.com/putyourlightson/craft-amazon-ses/issues/11)). 

## 1.3.1 - 2020-06-19
### Added
- Added `ca-central-1`, `eu-west-2`, `sa-east-1` and `us-gov-west-1` as valid [service endpoint regions](https://docs.aws.amazon.com/general/latest/gr/ses.html) ([#8](https://github.com/putyourlightson/craft-amazon-ses/issues/8)). 

## 1.3.0 - 2020-01-28
### Added
- Added `ap-south-1`, `ap-southeast-2` and `eu-central-1` as valid [service endpoint regions](https://docs.aws.amazon.com/general/latest/gr/ses.html) ([#7](https://github.com/putyourlightson/craft-amazon-ses/issues/7)). 

## 1.2.1 - 2019-09-19
### Fixed
- Fixed bug with empty configuration set value. 

## 1.2.0 - 2019-08-27
### Added
- Added a configuration set field to the plugin settings ([#5](https://github.com/putyourlightson/craft-amazon-ses/issues/5)).

### Fixed
- Fixed support for default credential chain handling when the API key and secret are left blank ([#6](https://github.com/putyourlightson/craft-amazon-ses/pull/6)).

## 1.1.0 - 2019-01-16
### Added
- Added support for environmental settings introduced in Craft 3.1 ([#4](https://github.com/putyourlightson/craft-amazon-ses/issues/4)).
- Added translatable fields in settings.

## 1.0.2 - 2018-10-31
### Changed
- Changed API key and API secret to not be required fields ([#3](https://github.com/putyourlightson/craft-amazon-ses/issues/3)).

## 1.0.1 - 2018-04-20
### Added
- Added reply to addresses and ability to send attachments (credit to Johan Strömqvist).

## 1.0.0 - 2018-04-06
- Initial release.
