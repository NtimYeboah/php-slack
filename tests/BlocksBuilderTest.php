<?php

namespace Tests;

use App\Blocks\Blocks;
use App\Blocks\BlocksBuilder;
use App\Composite\Blocks\Base\Context;
use App\Composite\Blocks\Base\Header;
use App\Composite\Blocks\Base\RichText;
use App\Composite\Blocks\Base\Section;
use PHPUnit\Framework\TestCase;

class BlocksBuilderTest extends TestCase
{
    public function test_can_build_richtext()
    {
        $blocks = (new BlocksBuilder)
            ->richText(function (RichText $block) {
                $block->text('This is a text');
                $block->text('This is a bold text')->bold();
                $block->text('This is an italic text')->italic();
                $block->text('This is a strikethrough text')->strike();
                $block->emoji('basketball');
            })
            ->build();

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

        $this->assertInstanceOf(Blocks::class, $blocks);
        
        $this->assertEquals($expected, $blocks->toArray());
    }

    public function test_can_build_a_header()
    {
        $blocks = (new BlocksBuilder)
            ->header(function (Header $block) {
                $block->text('This is a header text');
            })
            ->build();

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
        $blocks = (new BlocksBuilder)
            ->context(function (Context $block) {
                $block->text("*This* is :smile markdown")->markdown();
                $block->image('http://path/to/image.jpg')->altText('cute cat');
                $block->text('This is a plain text');
            })
            ->build();

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
        $blocks = (new BlocksBuilder)
            ->section(function (Section $section) {
                $section->field('This is a field')->markdown();
                $section->field('This is another field');
            })
            ->build();
        
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

    public function test_can_build_divider()
    {
        $blocks = (new BlocksBuilder)
            ->divider()
            ->build();

        $expected = [
            [
                'type' => 'divider',
            ]
        ];

        $this->assertEquals($expected, $blocks->toArray());
    }
}
