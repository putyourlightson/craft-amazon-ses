<?php
/**
 * @link      https://craftcampaign.com
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses\mail;

use Swift_Events_EventListener;
use Swift_Mime_SimpleMessage;

/**
 * Transport
 *
 * @author    PutYourLightsOn
 * @package   Amazon SES
 * @since     1.0.0
 */

abstract class Transport implements \Swift_Transport
{
    /**
     * @inheritdoc
     */
    public function isStarted(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function start(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function stop(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function ping(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function registerPlugin(Swift_Events_EventListener $plugin) { }
}
