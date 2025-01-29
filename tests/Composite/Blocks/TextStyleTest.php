<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\TextStyle;
use PHPUnit\Framework\TestCase;

class TextStyleTest extends TestCase
{
    public function test_can_render_bold()
    {
        $rendered = (new TextStyle)
            ->bold()
            ->render();

        $blocks = [
            'style' => [
                'bold' => true,
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_italic()
    {
        $rendered = (new TextStyle)
            ->italic()
            ->render();

        $blocks = [
            'style' => [
                'italic' => true,
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_strike()
    {
        $rendered = (new TextStyle)
            ->strike()
            ->render();

        $blocks = [
            'style' => [
                'strike' => true,
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
