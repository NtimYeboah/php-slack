<?php

namespace Tests\BlockKit\Blocks;

use App\BlockKit\Blocks\Section;
use App\BlockKit\Composites\Text;
use PHPUnit\Framework\TestCase;

class SectionTest extends TestCase
{
    public function test_can_render_a_section()
    {
        $rendered = (new Section)->render();

        $blocks = [
            'type' => 'section',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_text_block()
    {
        $rendered = (new Section)
            ->text('This is a section block text')
            ->render();

        $blocks = [
            'type' => 'section',
            'text' => [
                'type' => 'plain_text',
                'text' => 'This is a section block text',
                'emoji' => true,
            ],
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_markdown_block()
    {
        $rendered = (new Section)
            ->markdown('This is a section block text')
            ->render();

        $blocks = [
            'type' => 'section',
            'text' => [
                'type' => 'mrkdwn',
                'text' => 'This is a section block text',
            ],
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_text_field()
    {
        $rendered = (new Section)
            ->field('This is a text field')->text()
            ->field('*This* is a markdown field')->markdown()
            ->render();

        $blocks = [
            'type' => 'section',
            'fields' => [
                [
                    'type' => 'plain_text',
                    'text' => 'This is a text field',
                    'emoji' => true,
                ],
                [
                    'type' => 'mrkdwn',
                    'text' => '*This* is a markdown field',
                ]
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    /*public function test_can_render_users_select_block()
    {
        $rendered = (new Section)
            ->markdown('Test block with users select')
            ->usersSelect(function (Text $block) {
                $block->placeholder('Select a user');
            })
            ->render();

        $blocks = [
            'type' => 'section',
            'text' => [
                'type' => 'mrkdwn',
                'text' => 'Test block with users select',
            ],
            'accessory' => [
                'type' => 'users_select',
                'placeholder' => [
                    'type' => 'plain_text',
                    'text' => 'Select a user',
                    'emoji' => true,
                ],
                'action_id' => 'users_select-action',
            ],
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_static_select_block()
    {
        $rendered = (new Section)
            ->markdown('Pick an item from the dropdown list')
            ->staticSelect(function (Text $block) {
                $block->placeholder('Select an item')
                    ->options(function (Section $block) {
                        $block->text('Option 1')
                            ->text('Option 2')
                            ->text('Option 3');
                    });
            })
            ->build();

        $blocks = [
            'type' => 'section',
            'text' => [
                'type' => 'mrkdwn',
                'text' => 'Pick an item from the dropdown list',
            ],
            'accessory' => [
                'type' => 'static_select',
                'placeholder' => [
                    'type' => 'plain_text',
                    'text' => 'Select an item',
                    'emoji' => true,
                ],
                'options' => [
                    [
                        'text' => [
                            'type' => 'plain_text',
                            'text' => 'Option 1',
                            'emoji' => true,
                        ],
                        'value' => 'value-0',
                    ],
                    [
                        'text' => [
                            'type' => 'plain_text',
                            'text' => 'Option 2',
                            'emoji' => true,
                        ],
                        'value' => 'value-1',
                    ],
                    [
                        'text' => [
                            'type' => 'plain_text',
                            'text' => 'Option 3',
                            'emoji' => true,
                        ],
                        'value' => 'value-3',
                    ]
                ],
                'action_id' => 'static_select-action',
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_multi_static_select_block()
    {
        $rendered = (new Section)
            ->markdown('Test block with multi static select')
            ->multiStaticSelect(function (Section $block) {
                $block->placeholder('Select options')
                    ->options(function (Section $block) {
                        $block->text('Option 1')
                            ->text('Option 2')
                            ->text('Option 3');
                    });
            })
            ->build();

        $blocks = [
            'type' => 'section',
            'text' => [
                'type' => 'mrkdwn',
                'text' => 'Test block with multi static select',
            ],
            'accessory' => [
                'type' => 'multi_static_select',
                'placeholder' => [
                    'type' => 'plain_text',
                    'text' => 'Select options',
                    'emoji' => true,
                ],
                'options' => [
                    [
                        'text' => [
                            'type' => 'plain_text',
                            'text' => '*plain_text option 0*',
                            'emoji' => true,
                        ],
                        'value' => 'value-0',
                    ],
                    [
                        'text' => [
                            'type' => 'plain_text',
                            'text' => '*plain_text option 1*',
                            'emoji' => true,
                        ],
                        'value' => 'value-1',
                    ],
                    [
                        'text' => [
                            'type' => 'plain_text',
                            'text' => '*plain_text option 2*',
                            'emoji' => true,
                        ],
                        'value' => 'value-2',
                    ],
                ],
                'action_id' => 'multi_static_select-action',
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_multi_converstions_select_block()
    {
        $rendered = (new Section)
            ->markdown('Test block with multi conversations select')
            ->multiConverstationsSelect(function (Section $block) {
                $block->placeholder('Select conversations');
            })
            ->build();

        $blocks = [
            'type' => 'section',
            'text' => [
                'type' => 'mrkdwn',
                'text' => 'Test block with multi conversations select',
            ],
            'accessory' => [
                'type' => 'multi_conversations_select',
                'placeholder' => [
                    'type' => 'plain_text',
                    'text' => 'Select conversations',
                    'emoji' => true,
                ],
                'action_id' => 'multi_conversations_select-action',
            ],
        ];

        $this->assertEquals($rendered, $blocks);
    } */
}
