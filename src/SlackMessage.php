<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack;

require __DIR__ . '/../vendor/autoload.php';

use NtimYeboah\PhpSlack\BlockKit\Blocks\Context;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Divider;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Header;
use NtimYeboah\PhpSlack\BlockKit\Blocks\RichText;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Section;
use Closure;


class SlackMessage
{
    protected array $blocks = [];

    protected array $payload;

    private string $channel;

    private string $token;

    public function section(Closure $callable)
    {
        $section = $block = new Section;

        $callable($section);

        $this->blocks[] = $block->render();

        return $this;
    }

    public function action(Closure $callable)
    {
        $action = $callable(new Actions);

        $this->blocks[] = $action->render();

        return $this;
    }

    public function divider()
    {
        $divider = new Divider;

        $this->blocks[] = $divider->render();

        return $this;
    }

    public function image(Closure $callable)
    {
        $image = $callable(new Image);

        $this->blocks[] = $image->render();

        return $this;
    }

    public function context(Closure $callable)
    {
        $context = $block = new Context;

        $callable($context);

        $this->blocks[] = $block->render();

        return $this;
    }

    public function input(Closure $callable)
    {
        $input = $callable(new Input);

        $this->blocks[] = $input->render();

        return $this;
    }

    public function header(Closure $callable)
    {
        $header = $block = new Header;

        $callable($header);

        $this->blocks[] = $block->render();

        return $this;
    }

    public function richText(Closure $callable)
    {
        $richText = $block = (new RichText);

        $callable($richText);

        $this->blocks[] = $block->render();

        return $this;
    }

    /**
     * Get array representation of blocks
     *
     * @return array
     */
    public function toArray()
    {
        return $this->blocks;
    }

    /**
     * Get json representation of blocks.
     *
     * @return string|false
     */
    public function toString()
    {
        return json_encode($this->blocks);
    }

    public function channel(string $channel)
    {
        $this->channel = $channel;

        return $this;
    }

    public function token(string $token)
    {
        $this->token = $token;

        return $this;
    }

    public function getPayload()
    {
        return [
            'blocks' => $this->blocks,
            'channel' => $this->channel,
            'token' => $this->token,
        ];
    }

    /**
     * Send payload to Slack API.
     *
     * @return void
     */
    public function send()
    {
        return Requests::send($this->getPayload());
    }
}
