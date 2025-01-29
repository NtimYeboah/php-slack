<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Blocks\Image;
use App\Composite\Blocks\Text;
use App\Composite\CompoundBlock;
use RuntimeException;

class Context extends CompoundBlock
{
    private array $elements = [];

    protected array $block = [
        'type' => 'context',
    ];

    protected function block(): array
    {
        return $this->block;
    }

    public function render(): array
    {
        if (count($this->elements) > 0) {
            $this->block['elements'] = $this->elements();
        }

        return $this->block();
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
