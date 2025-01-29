<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

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
