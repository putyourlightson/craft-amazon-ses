<?php
/**
 * @link      https://craftcampaign.com
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses\mail;

use Aws\Ses\SesClient;
use Swift_Mime_SimpleMessage;

/**
 * Amazon SES Transport
 *
 * @author    PutYourLightsOn
 * @package   Amazon SES
 * @since     1.0.0
 */

class AmazonSesTransport extends Transport
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null): int
    {
        $headers = $message->getHeaders();
        $headers->addTextHeader('X-SES-Message-ID', $this->ses->sendRawEmail([
            'Source' => key($message->getSender() ?: $message->getFrom()),
            'RawMessage' => [
                'Data' => $message->toString(),
            ],
        ])->get('MessageId'));

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }
}
