<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit;

abstract class Block
{
    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks;

    protected abstract function blocks(): array;

    public abstract function render(): array;
}
