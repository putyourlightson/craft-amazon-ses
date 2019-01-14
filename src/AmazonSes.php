<?php
/**
 * @link      https://github.com/putyourlightson/craft-amazon-ses
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses;

use putyourlightson\amazonses\mail\AmazonSesAdapter;

use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\helpers\MailerHelper;
use yii\base\Event;

/**
 * Amazon SES plugin
 *
 * @author    PutYourLightsOn
 * @package   Amazon SES
 * @since     1.0.0
 */
class AmazonSes extends Plugin
{
    /**
     * @var AmazonSes
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        Event::on(MailerHelper::class, MailerHelper::EVENT_REGISTER_MAILER_TRANSPORT_TYPES,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = AmazonSesAdapter::class;
            }
        );
    }
}
