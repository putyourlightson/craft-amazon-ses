<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses;

use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\helpers\MailerHelper;
use putyourlightson\amazonses\mail\AmazonSesAdapter;
use yii\base\Event;

class AmazonSes extends Plugin
{
    /**
     * @var AmazonSes
     */
    public static AmazonSes $plugin;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        Event::on(MailerHelper::class, MailerHelper::EVENT_REGISTER_MAILER_TRANSPORTS,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = AmazonSesAdapter::class;
            }
        );
    }
}
