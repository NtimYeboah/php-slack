<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Blocks\Emoji;
use App\Composite\Blocks\Text;
use App\Composite\CompoundBlock;

class RichText extends CompoundBlock
{
    private array $elements = [];

    protected array $block = [
        'type' => 'rich_text',
    ];

    public function render(): array
    {
        if (count($this->elements) > 0) {
            $this->block['elements'] = $this->elements();
        }

        return $this->block();
    }

    protected function block(): array
    {
        return $this->block;
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
