<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\RichText;
use PHPUnit\Framework\TestCase;

class RichTextTest extends TestCase
{
    public function test_can_render_a_rich_text()
    {
        $rendered = (new RichText)->render();

        $blocks = [
            'type' => 'rich_text',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_basic_text()
    {
        $rendered = (new RichText)
            ->text('This is a basic text')
            ->render();

        $blocks = [
            'type' => 'rich_text',
            'elements' => [
                [
                    'type' => 'rich_text_section',
                    'elements' => [
                        [
                            'type' => 'text',
                            'text' => 'This is a basic text',
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_bold_rich_text()
    {
        $rendered = (new RichText)
            ->text('This is a bold text')
            ->bold()
            ->render();

        $blocks = [
            'type' => 'rich_text',
            'elements' => [
                [
                    'type' => 'rich_text_section',
                    'elements' => [
                        [
                            'type' => 'text',
                            'text' => 'This is a bold text',
                            'style' => [
                                'bold' => true,
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_an_italic_rich_text()
    {
        $rendered = (new RichText)
            ->text('This is an italics')
            ->italic()
            ->render();

        $blocks = [
            'type' => 'rich_text',
            'elements' => [
                [
                    'type' => 'rich_text_section',
                    'elements' => [
                        [
                            'type' => 'text',
                            'text' => 'This is an italics',
                            'style' => [
                                'italic' => true,
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_strikethrough_rich_text()
    {
        $rendered = (new RichText)
            ->text('This is a strikethrough text')
            ->strike()
            ->render();

        $blocks = [
            'type' => 'rich_text',
            'elements' => [
                [
                    'type' => 'rich_text_section',
                    'elements' => [
                        [
                            'type' => 'text',
                            'text' => 'This is a strikethrough text',
                            'style' => [
                                'strike' => true,
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_an_emoji_rich_text()
    {
        $rendered = (new RichText)
            ->emoji('basketball')
            ->render();

        $blocks = [
            'type' => 'rich_text',
            'elements' => [
                [
                    'type' => 'rich_text_section',
                    'elements' => [
                        [
                            'type' => 'emoji',
                            'name' => 'basketball',
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
