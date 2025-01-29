<?php declare(strict_types=1);

namespace App\BlockKit\Blocks;

use App\Composite\Blocks\Text;
use App\Composite\CompoundBlock;
use Closure;

class Section extends CompoundBlock
{
    protected array $block = [
        'type' => 'section',
    ];

    protected array $fields = [];

    protected array $accessory = [];

    public function render(): array
    {
        if (count($this->getFields())) {
            $this->block['fields'] = $this->getFields();
        }
        
        if (count($this->getAccessories())) {
            $this->block['accessory'] = $this->getAccessories();
        }
        
        return $this->block();
    }

    public function block(): array
    {
        return $this->block;
    }

    public function text($text = null)
    {
        if ($text === null) {
            return $this;
        }

        $text = (new Text)
            ->text($text)
            ->plain();

        $this->block['text'] = $text->render();

        return $this;
    }

    public function markdown($text = null)
    {
        if ($text === null) {
            $last = $this->fields[count($this->fields) - 1];
            $last->markdown();

            return $this;
        }

        $text = (new Text)
            ->text($text)
            ->markdown();

        $this->block['text'] = $text->render();

        return $this;
    }

    public function usersSelect(Closure $callable)
    {
        $block = $text = (new Text);

        $callable($text);

        $this->accessory['placeholder'] = $block->render();
        $this->accessory['action_id'] = 'users_select-action';
        $this->accessory['type'] = 'users_select';

        return $this;
    }

   /*  public function staticSelect(Closure $callable)
    {
        $block = $text = (new Text);

        $callable($text);

        $this->accessory['options'] = $block->render();
        $this->accessory['action_id'] = 'static_select-action';
        $this->accessory['type'] = 'static_select';

        return $this;
    } */

    public function field(string $text)
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->fields[] = $text;

        return $this;
    }

    public function getFields()
    {
        $fields = [];

        foreach ($this->fields as $item) {
            $fields[] = $item->render();
        }

        return $fields;
    }

    public function getAccessories()
    {
        return $this->accessory;
    }
}
