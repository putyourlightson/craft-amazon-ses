<?php
/**
 * @link      https://github.com/putyourlightson/craft-amazon-ses
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses\mail;

use Craft;
use craft\mail\transportadapters\BaseTransportAdapter;
use Aws\Ses\SesClient;

/**
 * Amazon SES Adapter
 *
 * @author    PutYourLightsOn
 * @package   Amazon SES
 * @since     1.0.0
 *
 * @property mixed $settingsHtml
 */

class AmazonSesAdapter extends BaseTransportAdapter
{
    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return 'Amazon SES';
    }

    /**
     * Returns the region options
     *
     * @return array
     */
    public static function getRegionOptions(): array
    {
        return [
            'us-east-1' => 'US East (N. Virginia)',
            'us-west-2' => 'US West (Oregon)',
            'eu-west-1' => 'EU West (Ireland)',
        ];
    }

    // Properties
    // =========================================================================

    /**
     * @var string The AWS region to use
     */
    public $region;

    /**
     * @var string The API key
     */
    public $apiKey;

    /**
     * @var string The API secret
     */
    public $apiSecret;

    /**
     * @var string The SES API version to use
     */
    private $_version = 'latest';

    /**
     * @var bool Debug mode
     */
    private $_debug = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'apiKey' => 'API Key',
            'apiSecret' => 'API Secret',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['region', 'apiKey', 'apiSecret', 'sendRate', 'timeout'], 'required'],
            [['region'], 'in', 'range' => array_keys($this->getRegionOptions())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('amazon-ses/settings', [
            'adapter' => $this
        ]);
    }

    /**
     * @inheritdoc
     */
    public function defineTransport()
    {
        // Create new client
        $client = new SesClient([
            'version' => $this->_version,
            'debug' => $this->_debug,
            'region'  => $this->region,
            'credentials' => [
                'key' => $this->apiKey,
                'secret' => $this->apiSecret,
            ],
        ]);

        return new AmazonSesTransport($client);
    }
}
