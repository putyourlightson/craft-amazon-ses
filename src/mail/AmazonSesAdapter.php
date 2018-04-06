<?php
/**
 * @link      https://craftcampaign.com
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses\mail;

use Craft;
use craft\mail\transportadapters\BaseTransportAdapter;
use Http\Adapter\Guzzle6\Client;
use putyourlightson\amazonses\AmazonSes;
use Swift_Events_SimpleEventDispatcher;

/**
 * Amazon SES Adapter
 *
 * @author    PutYourLightsOn
 * @package   Amazon SES
 * @since     1.0.0
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
     * @var int The send rate to use
     */
    public $sendRate = 1;

    /**
     * @var int The timeout duration (in seconds)
     */
    public $timeout = 10;

    /**
     * @var string The SES API version to use
     */
    private $_version = 'latest';

    /**
     * @var bool Debug mode
     */
    private $_debug = false;

    /**
     * @var SesClient|null
     */
    private $_client;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'apiKey' => Craft::t('mailgun', 'API Key'),
            'domain' => Craft::t('mailgun', 'Domain'),
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
            [['sendRate', 'timeout'], 'number', 'integerOnly' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('amazonses/settings', [
            'adapter' => $this
        ]);
    }

    /**
     * @inheritdoc
     */
    public function defineTransport()
    {
        $guzzleClient = Craft::createGuzzleClient();
        $client = new Client($guzzleClient);
        $httpClientConfigurator = (new HttpClientConfigurator())
            ->setHttpClient($client)
            ->setApiKey($this->apiKey);

        return [
            'class' => AmazonSesTransport::class,
            'constructArgs' => [
                [
                    'class' => Swift_Events_SimpleEventDispatcher::class
                ],
                AmazonSes::configure($httpClientConfigurator),
                $this->domain,
            ],
        ];
    }
}
