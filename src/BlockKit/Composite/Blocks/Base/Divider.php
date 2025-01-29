<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Block;

class Divider extends Block
{
    protected array $block = [
        'type' => 'divider'
    ];

    public function render(): array
    {
        return $this->block();
    }

    public function block(): array
    {
        return $this->block;
    }
}
