<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Composites;

use NtimYeboah\PhpSlack\BlockKit\Block;

class Emoji extends Block
{
    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks = [
        'type' => 'emoji',
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
     * Return the blocks to be rendered.
     *
     * @return array
     */
    protected function blocks(): array
    {
        return $this->blocks;
    }

    /**
     * Set the name of the emoji.
     *
     * @param string $name
     * @return self
     */
    public function name(string $name): self
    {
        $this->blocks['name'] = $name;

        return $this;
    }
}
