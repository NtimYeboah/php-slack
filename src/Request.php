<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Request
{
    /**
     * The Slack API credentials.
     *
     * @var Credentials
     */
    private Credentials $credentials;

    /**
     * The payload to be sent to Slack API.
     *
     * @var array
     */
    private array $payload;

    public function __construct(Credentials $credentials, array $payload)
    {
        $this->credentials = $credentials;
        $this->payload = $payload;
    }

    /**
     * Send the request to the Slack API.
     *
     * @return ResponseInterface
     */
    public function send(): ResponseInterface
    {
        $payload = array_merge(
            $this->payload, 
            [
                'channel' => $this->credentials->channel
            ]
        );

        return (new Client())->post(
            'https://slack.com/api/chat.postMessage', [
                'json' => $payload,
                'headers' => [
                    'Authorization' => 'Bearer '. $this->credentials->token, 
                    'Content-type' => 'application/json'
                ]
            ]
        );
    }
}
