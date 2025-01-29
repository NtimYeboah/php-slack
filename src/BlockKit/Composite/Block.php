<?php declare(strict_types=1);

namespace App\BlockKit\Composite;

abstract class Block
{
    protected array $block;

    protected abstract function block(): array;

    public abstract function render(): array;
}
