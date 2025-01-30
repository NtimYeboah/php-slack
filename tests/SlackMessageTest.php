<?php

namespace Tests;

use App\BlockKit\Blocks;
use App\BlockKit\Blocks\Context;
use App\BlockKit\Blocks\Header;
use App\BlockKit\Blocks\RichText;
use App\BlockKit\Blocks\Section;
use App\SlackMessage;
use PHPUnit\Framework\TestCase;

class SlackMessageTest extends TestCase
{
    public function test_can_build_richtext()
    {
        $blocks = (new SlackMessage)
            ->richText(function (RichText $block) {
                $block->text('This is a text');
                $block->text('This is a bold text')->bold();
                $block->text('This is an italic text')->italic();
                $block->text('This is a strikethrough text')->strike();
                $block->emoji('basketball');
            });

        $expected = [
            [
                'type' => 'rich_text',
                'elements' => [
                    [
                        'type' => 'rich_text_section',
                        'elements' => [
                            [
                                'type' => 'text',
                                'text' => 'This is a text',
                            ],
                            [
                                'type' => 'text',
                                'text' => 'This is a bold text',
                                'style' => [
                                    'bold' => true,
                                ],
                            ],
                            [
                                'type' => 'text',
                                'text' => 'This is an italic text',
                                'style' => [
                                    'italic' => true,
                                ],
                            ],
                            [
                                'type' => 'text',
                                'text' => 'This is a strikethrough text',
                                'style' => [
                                    'strike' => true,
                                ],
                            ],
                            [
                                'type' => 'emoji',
                                'name' => 'basketball',
                            ],
                        ]
                    ]
                ]
            ]
        ];
        
        $this->assertEquals($expected, $blocks->toArray());
    }

    public function test_can_build_a_header()
    {
        $blocks = (new SlackMessage)
            ->header(function (Header $block) {
                $block->text('This is a header text');
            });

        $expected = [
            [
                'type' => 'header',
                'text' => [
                    'type' => 'plain_text',
                    'text' => 'This is a header text',
                ],
            ]
        ];

        $this->assertEquals($expected, $blocks->toArray());
    }

    public function test_can_build_a_context()
    {
        $blocks = (new SlackMessage)
            ->context(function (Context $block) {
                $block->text("*This* is :smile markdown")->markdown();
                $block->image('http://path/to/image.jpg')->altText('cute cat');
                $block->text('This is a plain text');
            });

        $expected = [
            [
                'type' => 'context',
                'elements' => [
                    [
                        'type' => 'mrkdwn',
                        'text' => "*This* is :smile markdown",
                    ],
                    [
                        'type' => 'image',
                        'image_url' => 'http://path/to/image.jpg',
                        'alt_text' => 'cute cat',
                    ],
                    [
                        'type' => 'plain_text',
                        'text' => 'This is a plain text',
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $blocks->toArray());
    }

    public function test_can_build_a_section()
    {
        $blocks = (new SlackMessage)
            ->section(function (Section $section) {
                $section->field('This is a field')->markdown();
                $section->field('This is another field');
            });
        
        $expected = [
            [
                'type' => 'section',
                'fields' => [
                    [
                        'type' => 'mrkdwn',
                        'text' => 'This is a field',
                    ],
                    [
                        'type' => 'plain_text',
                        'text' => 'This is another field',
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $blocks->toArray());
    }

    public function test_can_build_a_divider()
    {
        $blocks = (new SlackMessage)->divider();

        $expected = [
            [
                'type' => 'divider',
            ]
        ];

        $this->assertEquals($expected, $blocks->toArray());
    }
}
