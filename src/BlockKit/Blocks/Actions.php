<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\CompoundBlock;

class Actions extends CompoundBlock
{
    protected array $block = [];

    public function render(): array
    {
        return [];
    }

    public function block(): array
    {
        return [];
    }
}
