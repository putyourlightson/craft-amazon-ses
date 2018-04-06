<?php
/**
 * @link      https://github.com/putyourlightson/craft-amazon-ses
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses\mail;

use Aws\Ses\SesClient;
use yii\mail\BaseMessage;

/**
 * Amazon SES Transport
 *
 * @author    PutYourLightsOn
 * @package   Amazon SES
 * @since     1.0.0
 */

class AmazonSesTransport extends Transport
{
    // Properties
    // =========================================================================

    /**
     * @var SesClient
     */
    private $_client;

    // Public Methods
    // =========================================================================

    /**
     * Constructor
     *
     * @param SesClient $client
     */
    public function __construct(SesClient $client)
    {
        $this->_client = $client;
    }

    /**
     * @inheritdoc
     */
    public function send(\Swift_Mime_SimpleMessage $message, &$failedRecipients = null): int
    {
        $data = $this->_formatMessage($message);

        try {
            $this->_client->sendEmail($data);
        }
        catch (AwsException $e) {
            return 0;
        }

        return count($message->getTo());
    }

    // Private Methods
    // =========================================================================

    /**
     * @param \Swift_Mime_SimpleMessage $message
     * @return array
     */
    private function _formatMessage(\Swift_Mime_SimpleMessage $message): array
    {
        // Get from as string
        $from = is_array($message->getFrom()) ? key($message->getFrom()) : $message->getFrom();

        // Get charset as string
        $charset = $message->getCharset() ?? '';

        // Get html and text body
        $htmlBody = '';
        $textBody = '';

        foreach ($message->getChildren() as $entity) {
            if ($entity->getContentType() == 'text/html') {
                $htmlBody = $entity->getBody();
            }
            if ($entity->getContentType() == 'text/plain') {
                $textBody = $entity->getBody();
            }
        }

        $data = [
            'Source' => $from,
            'ReturnPath' => $from,
            'Destination' => ['ToAddresses' => array_keys($message->getTo())],
            'Message' =>
                ['Body' => [
                    'Html' => [
                        'Charset' => $charset,
                        'Data' => $htmlBody,
                    ],
                    'Text' => [
                        'Charset' => $charset,
                        'Data' => $textBody,
                    ],
                ],
                    'Subject' => [
                        'Charset' => $charset,
                        'Data' => $message->getSubject(),
                    ],
                ],
        ];

        return $data;
    }
}
