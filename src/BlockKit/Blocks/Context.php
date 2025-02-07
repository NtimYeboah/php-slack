<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Block;
use NtimYeboah\PhpSlack\BlockKit\Composites\Text;
use NtimYeboah\PhpSlack\BlockKit\Composites\Image;
use RuntimeException;

class Context extends Block
{
    /**
     * The element field for the block
     *
     * @var array
     */
    private array $elements = [];

    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks = [
        'type' => 'context',
    ];

    /**
     * Get the blocks to be rendered.
     *
     * @return array
     */
    protected function blocks(): array
    {
        return $this->blocks;
    }

    /**
     * Render the block.
     *
     * @return array
     */
    public function render(): array
    {
        if (count($this->elements) > 0) {
            $this->blocks['elements'] = $this->elements();
        }

        return $this->blocks();
    }

    /**
     * Add a text element to the block.
     *
     * @param string $text
     * @return self
     */
    public function text(string $text): self
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->elements[] = $text;

        return $this;
    }

    /**
     * Set the image url for the block.
     *
     * @param string $url
     * @return self
     */
    public function image(string $url): self
    {
        $image = (new Image)->url($url);

        $this->elements[] = $image;

        return $this;
    }

    /**
     * Set the alt text for the last image element.
     *
     * @param string $text
     * @return self
     */
    public function altText(string $text): self
    {
        $last = $this->elements[count($this->elements) - 1];

        if (!($last instanceof Image)) {
            throw new RuntimeException('Specified block cannot have an alt text');
        }

        $last->altText($text);

        return $this;
    }

    /**
     * Set the markdown flag for the last text element.
     *
     * @return self
     */
    public function markdown(): self
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->markdown();
       
        return $this;
    }

    /**
     * Render the element fields.
     *
     * @return array
     */
    protected function elements(): array
    {
        $blocks = [];

        foreach ($this->elements as $element) {
            $blocks[] = $element->render();
        }

        return $blocks;
    }
}
