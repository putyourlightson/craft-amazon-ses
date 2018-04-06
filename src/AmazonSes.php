<?php
/**
 * @link      https://craftcampaign.com
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
    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        Event::on(MailerHelper::class, MailerHelper::EVENT_REGISTER_MAILER_TRANSPORT_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = AmazonSesAdapter::class;
        });
    }
}
