<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Block;
use NtimYeboah\PhpSlack\BlockKit\Composites\Text;

class Header extends Block
{
    protected array $blocks = [
        'type' => 'header',
    ];

    public function render(): array
    {
        return $this->blocks();
    }

    public function blocks(): array
    {
        return $this->blocks;
    }

    public function text(string $text)
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->blocks['text'] = $text->render();
       
        return $this;
    }
}
