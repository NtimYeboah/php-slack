<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack;

use InvalidArgumentException;

class Credentials
{
    /**
     * The Slack channel to send the message to.
     *
     * @var string
     */
    public string $channel;

    /**
     * The Slack API token.
     *
     * @var string
     */
    public string $token;

    public function __construct(string $channel, string $token)
    {
        $this->channel = $channel;
        $this->token = $token;
    }
    
    /**
     * Create a new instance of the class.
     *
     * @param string $channel
     * @param string $token
     * @return static
     */
    public static function make(string $channel, string $token): self
    {
        if (! $channel) {
            throw new InvalidArgumentException('Slack channel is not set.');
        }

        if (! $token) {
            throw new InvalidArgumentException('Slack token is not set.');
        }

        return new static($channel, $token);
    }
}
