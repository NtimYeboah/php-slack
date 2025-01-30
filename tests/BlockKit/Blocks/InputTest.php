<?php

namespace Tests\BlockKit\Blocks;

use App\BlockKit\Blocks\Input;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    public function test_can_render_an_input()
    {
        $rendered = (new Input)->render();

        $blocks = [
            'type' => 'input',
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
