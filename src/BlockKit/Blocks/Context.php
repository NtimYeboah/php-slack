<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Block;
use NtimYeboah\PhpSlack\BlockKit\Composites\Text;
use NtimYeboah\PhpSlack\BlockKit\Composites\Image;
use RuntimeException;

class Context extends Block
{
    private array $elements = [];

    protected array $blocks = [
        'type' => 'context',
    ];

    protected function blocks(): array
    {
        return $this->blocks;
    }

    public function render(): array
    {
        if (count($this->elements) > 0) {
            $this->blocks['elements'] = $this->elements();
        }

        return $this->blocks();
    }

    public function text(string $text): self
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->elements[] = $text;

        return $this;
    }

    public function image(string $url)
    {
        $image = (new Image)->url($url);

        $this->elements[] = $image;

        return $this;
    }

    public function altText(string $text)
    {
        $last = $this->elements[count($this->elements) - 1];

        if (!($last instanceof Image)) {
            throw new RuntimeException('Specified block cannot have an alt text');
        }

        $last->altText($text);

        return $this;
    }

    public function markdown()
    {
        $last = $this->elements[count($this->elements) - 1];

        $last->markdown();
       
        return $this;
    }

    protected function elements(): array
    {
        $blocks = [];

        foreach ($this->elements as $element) {
            $blocks[] = $element->render();
        }

        return $blocks;
    }
}
