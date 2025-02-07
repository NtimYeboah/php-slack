<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Block;
use NtimYeboah\PhpSlack\BlockKit\Composites\Text;

class Header extends Block
{
    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks = [
        'type' => 'header',
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
    public function blocks(): array
    {
        return $this->blocks;
    }

    /**
     * Add a text element to the block.
     *
     * @param string $text
     * @return self
     */
    public function text(string $text): self
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->blocks['text'] = $text->render();
       
        return $this;
    }
}
