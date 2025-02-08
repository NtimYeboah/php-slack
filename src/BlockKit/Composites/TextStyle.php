<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Composites;

use NtimYeboah\PhpSlack\BlockKit\Block;

class TextStyle extends Block
{
    /**
     * The block types.
     */
    protected const BOLD = 'bold';
    protected const ITALIC = 'italic';
    protected const STRIKE = 'strike';

    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks = [
        'style' => [],
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
     * Set the bold text style for the block.
     *
     * @param string $text
     * @return self
     */
    public function bold(): self
    {
        $this->blocks['style'] = [self::BOLD => true];

        return $this;
    }

    /**
     * Set the italic text style for the block.
     *
     * @param string $text
     * @return self
     */
    public function italic(): self
    {
        $this->blocks['style'] = [self::ITALIC => true];

        return $this;
    }

    /**
     * Set the strike-through text style for the block.
     *
     * @param string $text
     * @return self
     */
    public function strike(): self
    {
        $this->blocks['style'] = [self::STRIKE => true];

        return $this;
    }
}
