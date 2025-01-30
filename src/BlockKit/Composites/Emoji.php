<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Composites;

use NtimYeboah\PhpSlack\BlockKit\Block;

class Emoji extends Block
{
    protected array $blocks = [
        'type' => 'emoji',
    ];

    public function render(): array
    {
        return $this->blocks();
    }

    protected function blocks(): array
    {
        return $this->blocks;
    }

    public function name(string $name)
    {
        $this->blocks['name'] = $name;

        return $this;
    }
}
