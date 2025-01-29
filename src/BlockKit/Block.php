<?php declare(strict_types=1);

namespace App\BlockKit;

abstract class Block
{
    protected array $blocks;

    protected abstract function blocks(): array;

    public abstract function render(): array;
}
