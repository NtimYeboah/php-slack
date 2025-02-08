<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Composites;

use NtimYeboah\PhpSlack\BlockKit\Block;

class Text extends Block
{
    /**
     * The block types.
     */
    protected const TEXT = 'text';
    protected const MARKDOWN = 'mrkdwn';
    protected const PLAIN_TEXT = 'plain_text';

    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks = [
        'type' => self::TEXT,
    ];

    /**
     * Render the block.
     *
     * @return array
     */
    public function render(): array
    {
        return $this->blocks();
    }

    /**
     * Get the blocks to be rendered.
     *
     * @return array
     */
    protected function blocks(): array
    {
        return $this->blocks;
    }

    /**
     * Set the text for the block.
     *
     * @param string $text
     * @return self
     */
    public function text(String $text): self
    {
        $this->blocks['text'] = $text;

        return $this;
    }

    /**
     * Set the type of the block to markdown.
     *
     * @return self
     */
    public function markdown(): self
    {
        $this->blocks['type'] = self::MARKDOWN;

        return $this;
    }

    /**
     * Set the type of the block to plain text.
     *
     * @return self
     */
    public function plain(): self
    {
        $this->blocks['type'] = self::PLAIN_TEXT;

        return $this;
    }

    /**
     * Set the emoji flag for the block.
     *
     * @return self
     */
    public function emoji(): self
    {
        $this->blocks['emoji'] = true;

        return $this;
    }

    /**
     * Set the bold style flag for the block.
     *
     * @return self
     */
    public function bold(): self
    {
        $bold = (new TextStyle)
            ->bold()
            ->render();

        $this->blocks['style'] = $bold['style'];

        return $this;
    }

    /**
     * Set the italic flag for the block.
     *
     * @return self
     */
    public function italic(): self
    {
        $italic = (new TextStyle)
            ->italic()
            ->render();

        $this->blocks['style'] = $italic['style'];

        return $this;
    }

    /**
     * Set the strike-through flag for the block.
     *
     * @return self
     */
    public function strike(): self
    {
        $strike = (new TextStyle)
            ->strike()
            ->render();

        $this->blocks['style'] = $strike['style'];

        return $this;
    }

    /**
     * Set the placeholder text for the block.
     *
     * @return self
     */
    public function placeholder(string $text): self
    {
        return $this->text($text)
            ->plain();
    }
}
