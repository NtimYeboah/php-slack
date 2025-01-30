<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Composites;

use NtimYeboah\PhpSlack\BlockKit\Block;

class Text extends Block
{
    protected const TEXT = 'text';
    protected const MARKDOWN = 'mrkdwn';
    protected const PLAIN_TEXT = 'plain_text';

    protected array $blocks = [
        'type' => self::TEXT,
    ];

    public function render(): array
    {
        return $this->blocks();
    }

    protected function blocks(): array
    {
        return $this->blocks;
    }

    public function text(String $text)
    {
        $this->blocks['text'] = $text;

        return $this;
    }

    public function markdown()
    {
        $this->blocks['type'] = self::MARKDOWN;

        return $this;
    }

    public function plain()
    {
        $this->blocks['type'] = self::PLAIN_TEXT;

        return $this;
    }

    public function emoji()
    {
        $this->blocks['emoji'] = true;

        return $this;
    }

    public function bold()
    {
        $bold = (new TextStyle)
            ->bold()
            ->render();

        $this->blocks['style'] = $bold['style'];

        return $this;
    }

    public function italic()
    {
        $italic = (new TextStyle)
            ->italic()
            ->render();

        $this->blocks['style'] = $italic['style'];

        return $this;
    }

    public function strike()
    {
        $strike = (new TextStyle)
            ->strike()
            ->render();

        $this->blocks['style'] = $strike['style'];

        return $this;
    }

    public function placeholder(string $text)
    {
        return $this->text($text)
            ->plain();
    }
}
