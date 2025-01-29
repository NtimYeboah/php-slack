<?php declare(strict_types=1);

namespace App;

require __DIR__ . '/vendor/autoload.php';

class SlackMessage
{
    protected array $blocks = [];

    public function section(Closure $callable)
    {
        $section = $block = new Section;

        $callable($section);

        $this->blocks[] = $block->render();

        return $this;
    }

    public function action(Closure $callable)
    {
        $action = $callable(new Actions);

        $this->blocks[] = $action->render();

        return $this;
    }

    public function divider()
    {
        $this->blocks[] = (new Divider)->render();

        return $this;
    }

    public function image(Closure $callable)
    {
        $image = $callable(new Image);

        $this->blocks[] = $image->render();

        return $this;
    }

    public function context(Closure $callable)
    {
        $context = $block = new Context;

        $callable($context);

        $this->blocks[] = $block->render();

        return $this;
    }

    public function input(Closure $callable)
    {
        $input = $callable(new Input);

        $this->blocks[] = $input->render();

        return $this;
    }

    public function header(Closure $callable)
    {
        $header = $block = new Header;

        $callable($header);

        $this->blocks[] = $block->render();

        return $this;
    }

    public function richText(Closure $callable)
    {
        $richText = $block = new RichText;

        $callable($richText);

        $this->blocks[] = $block->render();
        
        return $this;
    }

    /**
     * Get array representation of blocks
     *
     * @return array
     */
    public function toArray()
    {
        return $this->blocks;
    }

    /**
     * Get json representation of blocks.
     *
     * @return string|false
     */
    public function toString()
    {
        return json_encode($this->blocks);
    }
}
