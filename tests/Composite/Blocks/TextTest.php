<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Text;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function test_can_render_a_text()
    {
        $rendered = (new Text)
            ->text('This is a text')
            ->render();

        $blocks = [
            'type' => 'text',
            'text' => 'This is a text',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_markdown_text()
    {
        $rendered = (new Text)
            ->text('This will be rendered as a markdown text')
            ->markdown()
            ->render();

        $blocks = [
            'type' => 'mrkdwn',
            'text' => 'This will be rendered as a markdown text',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_plain_text()
    {
        $rendered = (new Text)
            ->text('This is a plain text')
            ->plain()
            ->render();

        $blocks = [
            'type' => 'plain_text',
            'text' => 'This is a plain text',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_bold_text()
    {
        $rendered = (new Text)
            ->text('This is a bold text')
            ->bold()
            ->render();

        $blocks = [
            'type' => 'text',
            'text' => 'This is a bold text',
            'style' => [
                'bold' => true,
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_an_italic_text()
    {
        $rendered = (new Text)
            ->text('This is an italic text')
            ->italic()
            ->render();

        $blocks = [
            'type' => 'text',
            'text' => 'This is an italic text',
            'style' => [
                'italic' => true,
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_strike_text()
    {
        $rendered = (new Text)
            ->text('This is a strikethrough text')
            ->strike()
            ->render();

        $blocks = [
            'type' => 'text',
            'text' => 'This is a strikethrough text',
            'style' => [
                'strike' => true,
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
