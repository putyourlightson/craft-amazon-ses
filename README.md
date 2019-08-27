<p align="center"><img width="200" src="src/icon.svg"></p>

# Amazon SES Plugin for Craft CMS 3

The Amazon SES plugin provides an [Amazon SES](https://aws.amazon.com/ses/) (Simple Email Service) mailer adapter for [Craft CMS](https://craftcms.com/).

## Requirements

Craft CMS 3.1.0 or later.


## Installation

To install the plugin, search for “Amazon SES” in the Craft Plugin Store, or install manually using composer.

    composer require putyourlightson/craft-amazon-ses

## Usage

Once installed, go to Settings → Email, and change the “Transport Type” setting to “Amazon SES”. Enter your region and credentials (which you can get from your [AWS Developer Console](https://console.aws.amazon.com/) page). 

You can leave the API key and secret blank to use the default credential provider chain ([docs](https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_credentials.html)). 

You can optionally specify a configuration set to be notified when an email bounces or some other action happens ([docs](https://docs.aws.amazon.com/ses/latest/DeveloperGuide/using-configuration-sets.html)).

## License

This plugin is licensed for free under the MIT License.

<small>Created by [PutYourLightsOn](https://putyourlightson.com/).</small>
