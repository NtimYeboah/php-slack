<?php declare(strict_types=1);

namespace App\BlockKit\Composite;

abstract class CompoundBlock extends Block
{
    protected array $fields = [];

    public function addField(Block $block)
    {
        $this->fields[] = $block->render();

        return $this;
    }

    public function fields(): array
    {
        return $this->fields;
    }
}
