<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack;

use Closure;
use InvalidArgumentException;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Context;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Divider;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Header;
use NtimYeboah\PhpSlack\BlockKit\Blocks\RichText;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Section;

class SlackMessage
{
    /**
     * Container for blocks to be sent in the message.
     *
     * @var array
     */
    protected array $blocks = [];

    /**
     * The payload to be sent to Slack API.
     *
     * @var array
     */
    protected array $payload;

    /**
     * The Slack API token.
     *
     * @var string
     */
    protected string $token;

    /**
     * The channel to send the message to.
     *
     * @var string|null
     */
    protected ?string $channel = null;

    /**
     * The text message to send.
     *
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * The user emoji icon for the message.
     *
     * @var string|null
     */
    protected ?string $icon = null;

    /**
     * The image icon for the message.
     *
     * @var string|null
     */
    protected ?string $imageIcon = null;

    /**
     * The credentials to use for sending the message.
     *
     * @var Credentials|null
     */
    protected ?Credentials $credentials = null;

    /**
     * Indicates if you want a preview of links inlined in the message.
     *
     * @var boolean|null
     */
    protected ?bool $unfurlLinks = null;

    /**
     * Indicates if you want a preview of media inlined in the message.
     *
     * @var boolean|null
     */
    protected ?bool $unfurlMedia = null;

    /**
     * The username to send the message as.
     *
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * The timestamp of the parent message.
     *
     * @var string|null
     */
    protected ?string $threadTs = null;

    /**
     * Indicates if the message should be broadcasted to the channel.
     *
     * @var boolean|null
     */
    protected ?bool $replyBroadcast = null;

    public function __construct(Credentials $credentials = null)
    {
        $this->credentials = $credentials;
    }

    /**
     * Set the channel to send the message to.
     *
     * @param string $channel
     * @return self
     */
    public function channel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Set the Slack API token.
     *
     * @param string $token
     * @return self
     */
    public function token(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Set the text message to send.
     *
     * @param string $text
     * @return self
     */
    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set the user emoji icon for the message.
     *
     * @param string $icon
     * @return self
     */
    public function icon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set the image icon for the message.
     *
     * @param string $imageIcon
     * @return self
     */
    public function imageIcon(string $imageIcon): self
    {
        $this->imageIcon = $imageIcon;

        return $this;
    }

    /**
     * Determine whether to preview links in the message.
     *
     * @param boolean $unfurlLinks
     * @return self
     */
    public function unfurlLinks(bool $unfurlLinks): self
    {
        $this->unfurlLinks = $unfurlLinks;

        return $this;
    }

    /**
     * Determine whether to preview media in the message.
     *
     * @param boolean $unfurlMedia
     * @return self
     */
    public function unfurlMedia(bool $unfurlMedia): self
    {
        $this->unfurlMedia = $unfurlMedia;

        return $this;
    }

    /**
     * Set the username to send the message as.
     *
     * @param string $username
     * @return self
     */
    public function username(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the timestamp of the parent message.
     *
     * @param string $threadTs
     * @return self
     */
    public function threadTs(string $threadTs): self
    {
        $this->threadTs = $threadTs;

        return $this;
    }

    /**
     * Determine whether to broadcast the message to the channel.
     *
     * @param boolean $replyBroadcast
     * @return self
     */
    public function replyBroadcast(bool $replyBroadcast): self
    {
        $this->replyBroadcast = $replyBroadcast;

        return $this;
    }

    /**
     * Add a section block to the message.
     *
     * @param Closure $callable
     * @return self
     */
    public function section(Closure $callable): self
    {
        $section = $block = new Section;

        $callable($section);

        $this->blocks[] = $block->render();

        return $this;
    }

    /**
     * Add an action block to the message.
     *
     * @param Closure $callable
     * @return self
     */
    public function action(Closure $callable): self
    {
        $action = $callable(new Actions);

        $this->blocks[] = $action->render();

        return $this;
    }

    /**
     * Add a divider block to the message.
     *
     * @return self
     */
    public function divider(): self
    {
        $divider = new Divider;

        $this->blocks[] = $divider->render();

        return $this;
    }

    /**
     * Add an image block to the message.
     *
     * @param Closure $callable
     * @return self
     */
    public function image(Closure $callable): self
    {
        $image = $callable(new Image);

        $this->blocks[] = $image->render();

        return $this;
    }

    /**
     * Add a context block to the message.
     *
     * @param Closure $callable
     * @return self
     */
    public function context(Closure $callable): self
    {
        $context = $block = new Context;

        $callable($context);

        $this->blocks[] = $block->render();

        return $this;
    }

    /**
     * Add an input block to the message.
     *
     * @param Closure $callable
     * @return self
     */
    public function input(Closure $callable): self
    {
        $input = $callable(new Input);

        $this->blocks[] = $input->render();

        return $this;
    }

    /**
     * Add a header block to the message.
     *
     * @param Closure $callable
     * @return self
     */
    public function header(Closure $callable): self
    {
        $header = $block = new Header;

        $callable($header);

        $this->blocks[] = $block->render();

        return $this;
    }

    /**
     * Add a rich text block to the message.
     *
     * @param Closure $callable
     * @return self
     */
    public function richText(Closure $callable): self
    {
        $richText = $block = (new RichText);

        $callable($richText);

        $this->blocks[] = $block->render();

        return $this;
    }

    /**
     * Get the payload to send to Slack API.
     *
     * @return array
     */
    public function getPayload(): array
    {
        if (empty($this->blocks) && is_null($this->text)) {
            throw new InvalidArgumentException('Slack messages must contain at least a text message or block.');
        }

        if (count($this->blocks) > 50) {
            throw new InvalidArgumentException('Slack messages can only contain up to 50 blocks.');
        }

        return array_filter(
            [
                'blocks' => empty($this->blocks) ? null : $this->blocks,
                'icon_emoji' => $this->icon,
                'icon_url' => $this->imageIcon,
                'reply_broadcast' => $this->replyBroadcast,
                'text' => $this->text,
                'thread_ts' => $this->threadTs,
                'unfurl_links' => $this->unfurlLinks,
                'unfurl_media' => $this->unfurlMedia,
                'username' => $this->username,
            ], function ($value) {
                return $value !== null;
            }
        );
    }

    /**
     * Send the message to Slack.
     *
     * @return ResponseInterface
     */
    public function send()
    {
        if (is_null($this->credentials)) {
            $this->credentials = Credentials::make($this->channel, $this->token);
        }

        $request = new Request($this->credentials, $this->getPayload());

        return $request->send();
    }
}
