<?php declare(strict_types=1);

namespace App\BlockKit\Blocks;

use App\BlockKit\Block;

class Divider extends Block
{
    protected array $blocks = [
        'type' => 'divider'
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
