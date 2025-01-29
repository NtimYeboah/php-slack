<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Blocks\Text;
use App\Composite\CompoundBlock;

class Header extends CompoundBlock
{
    protected array $block = [
        'type' => 'header',
    ];

    public function render(): array
    {
        return $this->block();
    }

    public function block(): array
    {
        return $this->block;
    }

    public function text(string $text)
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->block['text'] = $text->render();
       
        return $this;
    }
}
