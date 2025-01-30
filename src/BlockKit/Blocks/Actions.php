<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Block;

class Actions extends Block
{
    protected array $blocks = [
        'type' => 'actions',
    ];

    public function render(): array
    {
        return $this->blocks();
    }

    public function blocks(): array
    {
        return $this->blocks;
    }
}
