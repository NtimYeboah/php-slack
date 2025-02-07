<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Composites;

use NtimYeboah\PhpSlack\BlockKit\Block;

class Image extends Block
{
    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks = [
        'type' => 'image',
    ];

    /**
     * Render the block.
     *
     * @return array
     */
    public function render(): array
    {
        return $this->blocks();
    }

    /**
     * Return the blocks to be rendered.
     *
     * @return array
     */
    protected function blocks(): array
    {
        return $this->blocks;
    }

    /**
     * Set the URL of the image.
     *
     * @param string $url
     * @return self
     */
    public function url(string $url): self
    {
        $this->blocks['image_url'] = $url;

        return $this;
    }

    /**
     * Set the alt text of the image.
     *
     * @param string $text
     * @return self
     */
    public function altText(string $text): self
    {
        $this->blocks['alt_text'] = $text;

        return $this;
    }
}
