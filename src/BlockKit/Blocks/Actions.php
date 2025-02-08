<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Block;

class Actions extends Block
{
    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks = [
        'type' => 'actions',
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
}
