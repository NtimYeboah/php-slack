<?php declare(strict_types=1);

namespace App\BlockKit\Blocks;

use App\Composite\CompoundBlock;

class Input extends CompoundBlock
{
    protected array $block = [
        'type' => 'input'
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
