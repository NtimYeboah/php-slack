<?php

namespace App;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Requests
{
    public function __construct(private array $payload)
    {
        
    }

    /**
     * Send request to Slack.
     *
     * @param array $payload
     * @return ResponseInterface
     */
    public static function send(array $payload): ResponseInterface
    {
        $self = new static($payload);

        return $self->request();
    }

    /**
     * Make request to Slack.
     *
     * @return ResponseInterface
     */
    private function request(): ResponseInterface
    {
        $token = $this->payload['token'];
        unset($this->payload['token']);

        $client = new Client();

        return $client->post(
            'https://slack.com/api/chat.postMessage', [
                'json' => $this->payload,
                'headers' => [
                    // make a class that will instantiated by a method in SlackMessge class,
                    // then give the token to this class when sending the request.
                    // check if channel and toke are set
                    'Authorization' => 'Bearer '. $token, 
                    'Content-type' => 'application/json'
                ]
            ]
        );
    }
}
