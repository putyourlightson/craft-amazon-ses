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

    // Properties
    // =========================================================================

    /**
     * @var string The domain
     */
    public $domain;

    /**
     * @var string The API key that should be used
     */
    public $apiKey;

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
            [['apiKey', 'domain'], 'required'],
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
