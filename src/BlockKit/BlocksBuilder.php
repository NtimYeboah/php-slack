<?php declare(strict_types=1);

namespace App\BlockKit;

use App\Composite\Blocks\Base\Actions;
use App\Composite\Blocks\Base\Context;
use App\Composite\Blocks\Base\Divider;
use App\Composite\Blocks\Base\Header;
use App\Composite\Blocks\Base\Image;
use App\Composite\Blocks\Base\Input;
use App\Composite\Blocks\Base\RichText;
use App\Composite\Blocks\Base\Section;
use Closure;

class BlocksBuilder
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

    public function build()
    {
        return new Blocks($this->blocks);
    }
}
