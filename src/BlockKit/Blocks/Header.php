<?php declare(strict_types=1);

namespace App\BlockKit\Blocks;

use App\BlockKit\Block;
use App\BlockKit\Composites\Text;

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
