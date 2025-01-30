<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Composites\Emoji;
use NtimYeboah\PhpSlack\BlockKit\Composites\Text;
use NtimYeboah\PhpSlack\BlockKit\Block;

class RichText extends Block
{
    private array $elements = [];

    protected array $blocks = [
        'type' => 'rich_text',
    ];

    public function render(): array
    {
        if (count($this->elements) > 0) {
            $this->blocks['elements'] = $this->elements();
        }

        return $this->blocks();
    }

    protected function blocks(): array
    {
        return $this->blocks;
    }

    public function text(string $text)
    {
        $text = (new Text)->text($text);

        $this->elements[] = $text;

        return $this;
    }

    public function bold()
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->bold();
       
        return $this;
    }

    public function italic()
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->italic();
       
        return $this;
    }

    public function strike()
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->strike();
       
        return $this;
    }

    public function emoji(string $name)
    {
        $text = (new Emoji)->name($name);

        $this->elements[] = $text;

        return $this;
    }

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
