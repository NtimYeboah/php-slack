<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Composites\Text;
use NtimYeboah\PhpSlack\BlockKit\Block;
use Closure;
use RuntimeException;

class Section extends Block
{
    /**
     * The blocks to be rendered.
     *
     * @var array
     */
    protected array $blocks = [
        'type' => 'section',
    ];

    /**
     * The fields key of the block.
     *
     * @var array
     */
    protected array $fields = [];

    /**
     * The accessories key of the block.
     *
     * @var array
     */
    protected array $accessories = [];

    /**
     * Render the block.
     *
     * @return array
     */
    public function render(): array
    {
        if (count($this->getFields())) {
            $this->blocks['fields'] = $this->getFields();
        }
        
        if (count($this->getAccessories())) {
            $this->blocks['accessories'] = $this->getAccessories();
        }
        
        return $this->blocks();
    }

    /**
     * Get the blocks to be rendered.
     *
     * @return array
     */
    public function blocks(): array
    {
        return $this->blocks;
    }

    /**
     * Set the type of the block to a text.
     *
     * @param string $text
     * @return self
     */
    public function text($text = null): self
    {
        if ($text === null) {
            $last = $this->fields[count($this->fields) - 1];

            if (!($last instanceof Text)) {
                throw new RuntimeException('Cannot call method on non Text');
            }

            $last->emoji();

            return $this;
        }

        $text = (new Text)
            ->text($text)
            ->plain();

        $this->blocks['text'] = $text->render();
        $this->blocks['text']['emoji'] = true;

        return $this;
    }

    /**
     * Set the type of the block to markdown.
     *
     * @param string|null $text
     * @return self
     */
    public function markdown($text = null): self
    {
        if ($text === null) {
            $last = $this->fields[count($this->fields) - 1];

            if (!($last instanceof Text)) {
                throw new RuntimeException('Cannot call method on non-Text');
            }

            $last->markdown();

            return $this;
        }

        $text = (new Text)
            ->text($text)
            ->markdown();

        $this->blocks['text'] = $text->render();

        return $this;
    }

    /**
     * Add a user select field the block.
     *
     * @param Closure $callable
     * @return self
     */
    public function usersSelect(Closure $callable): self
    {
        $block = $text = (new Text);

        $callable($text);

        $this->accessories['placeholder'] = $block->render();
        $this->accessories['action_id'] = 'users_select-action';
        $this->accessories['type'] = 'users_select';

        return $this;
    }

    /**
     * Add a field to the block.
     *
     * @param string $text
     * @return self
     */
    public function field(string $text): self
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->fields[] = $text;

        return $this;
    }

    /**
     * Get the fields to be rendered.
     *
     * @return array
     */
    public function getFields(): array
    {
        $fields = [];

        foreach ($this->fields as $item) {
            $fields[] = $item->render();
        }

        return $fields;
    }

    /**
     * Get the accessories key of the block.
     *
     * @return array
     */
    public function getAccessories(): array
    {
        return $this->accessories;
    }
}
