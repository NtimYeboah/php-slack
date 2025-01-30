<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Composites;

use NtimYeboah\PhpSlack\BlockKit\Block;

class Image extends Block
{
    protected array $blocks = [
        'type' => 'image',
    ];

    public function render(): array
    {
        return $this->blocks();
    }

    protected function blocks(): array
    {
        return $this->blocks;
    }

    public function url(string $url)
    {
        $this->blocks['image_url'] = $url;

        return $this;
    }

    public function altText(string $text)
    {
        $this->blocks['alt_text'] = $text;

        return $this;
    }
}
