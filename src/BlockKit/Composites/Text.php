<?php declare(strict_types=1);

namespace App\BlockKit\Composites;

use App\BlockKit\Block;

class Text extends Block
{
    protected const TEXT = 'text';
    protected const MARKDOWN = 'mrkdwn';
    protected const PLAIN_TEXT = 'plain_text';

    protected array $block = [
        'type' => self::TEXT,
    ];

    public function render(): array
    {
        return $this->block();
    }

    protected function block(): array
    {
        return $this->block;
    }

    public function text(String $text)
    {
        $this->block['text'] = $text;

        return $this;
    }

    public function markdown()
    {
        $this->block['type'] = self::MARKDOWN;

        return $this;
    }

    public function plain()
    {
        $this->block['type'] = self::PLAIN_TEXT;

        return $this;
    }

    public function bold()
    {
        $bold = (new TextStyle)
            ->bold()
            ->render();

        $this->block['style'] = $bold['style'];

        return $this;
    }

    public function italic()
    {
        $italic = (new TextStyle)
            ->italic()
            ->render();

        $this->block['style'] = $italic['style'];

        return $this;
    }

    public function strike()
    {
        $strike = (new TextStyle)
            ->strike()
            ->render();

        $this->block['style'] = $strike['style'];

        return $this;
    }

    public function placeholder(string $text)
    {
        return $this->text($text)
            ->plain();
    }
}
