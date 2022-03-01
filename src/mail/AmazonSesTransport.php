<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\amazonses\mail;

use AsyncAws\Ses\Input\SendEmailRequest;
use AsyncAws\Ses\SesClient;
use Symfony\Component\Mailer\Bridge\Amazon\Transport\SesApiAsyncAwsTransport;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\Message;

class AmazonSesTransport extends SesApiAsyncAwsTransport
{
    /**
     * @var string The configuration set to use when sending.
     */
    private string $_configurationSet;

    /**
     * Override the method, so we can store the configuration set.
     */
    public function __construct(SesClient $client, string $configurationSet)
    {
        parent::__construct($client);

        $this->_configurationSet = $configurationSet;
    }

    /**
     * Override the method, so we can add the configuration set header.
     */
    protected function getRequest(SentMessage $message): SendEmailRequest
    {
        if ($this->_configurationSet) {
            $originalMessage = $message->getOriginalMessage();

            if ($originalMessage instanceof Message) {
                $originalMessage->getHeaders()->addTextHeader('X-SES-CONFIGURATION-SET', $this->_configurationSet);
            }
        }

        return parent::getRequest($message);
    }
}
