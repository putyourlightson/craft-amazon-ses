<?php
/**
 * @link      https://github.com/putyourlightson/craft-amazon-ses
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses\mail;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
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
    const REGIONS = [
        'us-east-1',
        'us-west-2',
        'eu-west-1',
    ];
    
    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return 'Amazon SES';
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
            'apiKey' => Craft::t('amazon-ses', 'API Key'),
            'apiSecret' => Craft::t('amazon-ses', 'API Secret'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'parser' => [
                'class' => EnvAttributeParserBehavior::class,
                'attributes' => ['region', 'apiKey', 'apiSecret'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['region'], 'required'],
            [['region'], 'in', 'range' => self::REGIONS, 'message' => Craft::t('amazon-ses',
                'The region provided is not a valid AWS region.'
            )],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('amazon-ses/_settings', [
            'adapter' => $this,
            'regions' => self::REGIONS,
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
            'region'  => Craft::parseEnv($this->region),
            'credentials' => [
                'key' => Craft::parseEnv($this->apiKey),
                'secret' => Craft::parseEnv($this->apiSecret),
            ],
        ]);

        return new AmazonSesTransport($client);
    }
}
