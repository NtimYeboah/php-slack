<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Composites\Emoji;
use NtimYeboah\PhpSlack\BlockKit\Composites\Text;
use NtimYeboah\PhpSlack\BlockKit\Block;

class RichText extends Block
{
    /**
     * The elements field of the block.
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
        'type' => 'rich_text',
    ];

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
     * Get the blocks to be rendered.
     *
     * @return array
     */
    protected function blocks(): array
    {
        return $this->blocks;
    }

    /**
     * Add a text element to the block.
     *
     * @param string $text
     * @return self
     */
    public function text(string $text): self
    {
        $text = (new Text)->text($text);

        $this->elements[] = $text;

        return $this;
    }

    /**
     * Set the type of the last block to bold.
     *
     * @return self
     */
    public function bold(): self
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->bold();
       
        return $this;
    }

    /**
     * Set the type of the last block to italic.
     *
     * @return self
     */
    public function italic(): self
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->italic();
       
        return $this;
    }

    /**
     * Set the type of the last block to strikethrough.
     *
     * @return self
     */
    public function strike(): self
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->strike();
       
        return $this;
    }

    /**
     * Add an emoji element to the block.
     *
     * @param string $name
     * @return self
     */
    public function emoji(string $name): self
    {
        $text = (new Emoji)->name($name);

        $this->elements[] = $text;

        return $this;
    }

    /**
     * Get the elements to be rendered.
     *
     * @return array
     */
    protected function elements(): array
    {
        $texts = [];

        foreach ($this->elements as $element) {
            $texts[] = $element->render();
        }

        return [
            [
                'type' => 'rich_text_section',
                'elements' => $texts,
            ]
        ];
    }
}
