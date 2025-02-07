<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Request
{
    private Credentials $credentials;

    private array $payload;

    public function __construct(Credentials $credentials, array $payload)
    {
        $this->credentials = $credentials;
        $this->payload = $payload;
    }

    /**
     * Send request to Slack.
     *
     * @param array $payload
     * @return ResponseInterface
     */
    public static function send(Credentials $credentials, array $payload): ResponseInterface
    {
        $self = new static($credentials, $payload);

        return $self->make();
    }

    /**
     * Make request to Slack.
     *
     * @return ResponseInterface
     */
    private function make(): ResponseInterface
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
