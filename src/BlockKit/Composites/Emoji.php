<?php declare(strict_types=1);

namespace App\BlockKit\Composites;

use App\BlockKit\Block;

class Emoji extends Block
{
    protected array $block = [
        'type' => 'emoji',
    ];

    public function render(): array
    {
        return $this->block();
    }

    protected function block(): array
    {
        return $this->block;
    }

    public function name(string $name)
    {
        $this->block['name'] = $name;

        return $this;
    }
}
