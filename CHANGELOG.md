# Amazon SES Changelog

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
