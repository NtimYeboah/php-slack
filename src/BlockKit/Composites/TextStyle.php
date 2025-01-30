<?php declare(strict_types=1);

namespace App\BlockKit\Composites;

use App\BlockKit\Block;

class TextStyle extends Block
{
    protected const BOLD = 'bold';
    protected const ITALIC = 'italic';
    protected const STRIKE = 'strike';

    protected array $blocks = [
        'style' => [],
    ];

    public function render(): array
    {
        return $this->blocks();
    }

    protected function blocks(): array
    {
        return $this->blocks;
    }

    public function bold()
    {
        $this->blocks['style'] = [self::BOLD => true];

        return $this;
    }

    public function italic()
    {
        $this->blocks['style'] = [self::ITALIC => true];

        return $this;
    }

    public function strike()
    {
        $this->blocks['style'] = [self::STRIKE => true];

        return $this;
    }
}
