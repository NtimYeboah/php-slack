<?php declare(strict_types=1);

namespace App\Composite\Blocks;

use App\Composite\Block;

class TextStyle extends Block
{
    protected const BOLD = 'bold';
    protected const ITALIC = 'italic';
    protected const STRIKE = 'strike';

    protected array $block = [
        'style' => [],
    ];

    public function render(): array
    {
        return $this->block();
    }

    protected function block(): array
    {
        return $this->block;
    }

    public function bold()
    {
        $this->block['style'] = [self::BOLD => true];

        return $this;
    }

    public function italic()
    {
        $this->block['style'] = [self::ITALIC => true];

        return $this;
    }

    public function strike()
    {
        $this->block['style'] = [self::STRIKE => true];

        return $this;
    }
}
