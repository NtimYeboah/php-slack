<?php declare(strict_types=1);

namespace App\BlockKit\Composites;

use App\BlockKit\Block;

class Image extends Block
{
    protected array $block = [
        'type' => 'image',
    ];

    public function render(): array
    {
        return $this->block();
    }

    protected function block(): array
    {
        return $this->block;
    }

    public function url(string $url)
    {
        $this->block['image_url'] = $url;

        return $this;
    }

    public function altText(string $text)
    {
        $this->block['alt_text'] = $text;

        return $this;
    }
}
