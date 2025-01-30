<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit;

abstract class Block
{
    protected array $blocks;

    protected abstract function blocks(): array;

    public abstract function render(): array;
}
