<?php

namespace NtimYeboah\PhpSlack\Tests;

use GuzzleHttp\Psr7\Response;
use NtimYeboah\PhpSlack\Credentials;
use NtimYeboah\PhpSlack\BlockKit\Blocks;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Context;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Header;
use NtimYeboah\PhpSlack\BlockKit\Blocks\RichText;
use NtimYeboah\PhpSlack\BlockKit\Blocks\Section;
use NtimYeboah\PhpSlack\SlackMessage;
use NtimYeboah\PhpSlack\Requests;
use PHPUnit\Framework\TestCase;

class SlackMessageTest extends TestCase
{
    public function test_can_build_richtext_message()
    {
        $payload = (new SlackMessage)
            ->richText(function (RichText $block) {
                $block->text('This is a text');
                $block->text('This is a bold text')->bold();
                $block->text('This is an italic text')->italic();
                $block->text('This is a strikethrough text')->strike();
                $block->emoji('basketball');
            })
            ->getPayload();

        $expected = [
            'blocks' => [
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
            ]
        ];
        
        $this->assertEquals($expected, $payload);
    }

    public function test_can_build_a_header_message()
    {
        $payload = (new SlackMessage)
            ->header(function (Header $block) {
                $block->text('This is a header text');
            })
            ->getPayload();

        $expected = [
            'blocks' => [
                [
                    'type' => 'header',
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'This is a header text',
                    ],
                ]
            ]
        ];

        $this->assertEquals($expected, $payload);
    }

    public function test_can_build_a_context_message()
    {
        $payload = (new SlackMessage)
            ->context(function (Context $block) {
                $block->text("*This* is :smile markdown")->markdown();
                $block->image('http://path/to/image.jpg')->altText('cute cat');
                $block->text('This is a plain text');
            })
            ->getPayload();

        $expected = [
            'blocks' => [
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
            ]
        ];

        $this->assertEquals($expected, $payload);
    }

    public function test_can_build_a_section_message()
    {
        $payload = (new SlackMessage)
            ->section(function (Section $section) {
                $section->field('This is a field')->markdown();
                $section->field('This is another field');
            })
            ->getPayload();
        
        $expected = [
            'blocks' => [
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
            ]
        ];

        $this->assertEquals($expected, $payload);
    }

    public function test_can_build_a_divider_message()
    {
        $payload = (new SlackMessage)
            ->divider()
            ->getPayload();

        $expected = [
            'blocks' => [
                [
                    'type' => 'divider',
                ]
            ]
        ];

        $this->assertEquals($expected, $payload);
    }

    public function test_can_get_payload()
    {
        $payload = (new SlackMessage)
            ->token('123')
            ->channel('general')
            ->header(function (Header $header) {
                $header->text("New event happened in your AWS Account");
            })
            ->context(function (Context $context) {
                $context->text("Action performed by: iamadmin");
            })
            ->section(function (Section $section) {
                $section->field("*Event Time:* 12:02:00")->markdown()
                    ->field("*Event Name:* StopInstances")->markdown();
            })
            ->section(function (Section $section) {
                $section->field("*IAM user:* iamadmin")->markdown()
                    ->field("*AWS Region:* us-east-1")->markdown();
            })
            ->divider()
            ->section(function (Section $section) {
                $section->text('Made with Love from Ntim.');
            })
            ->divider()
            ->getPayload();

        $expected = [
            'blocks' => [
                [
                    'type' => 'header',
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'New event happened in your AWS Account',
                    ]
                ],
                [
                    'type' => 'context',
                    'elements' => [
                        [
                            'type' => 'plain_text',
                            'text' => 'Action performed by: iamadmin',
                        ]
                    ]
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => '*Event Time:* 12:02:00',
                        ],
                        [
                            'type' => 'mrkdwn',
                            'text' => '*Event Name:* StopInstances',
                        ]
                    ]
                ],
                [
                    'type' => 'section',
                    'fields' => [
                        [
                            'type' => 'mrkdwn',
                            'text' => '*IAM user:* iamadmin',
                        ],
                        [
                            'type' => 'mrkdwn',
                            'text' => '*AWS Region:* us-east-1',
                        ]
                    ]
                ],
                [
                    'type' => 'divider',
                ],
                [
                    'type' => 'section',
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'Made with Love from Ntim.',
                        'emoji' => true,
                    ],
                ],
                [
                    'type' => 'divider',
                ],
            ],
        ];

        $this->assertEquals($expected, $payload);
    }

    public function test_can_send_a_message()
    {
        $message = $this->createPartialMock(SlackMessage::class, ['send']);

        $message->expects($this->once())
            ->method('send')
            ->willReturn(new Response(200));

        $response = $message->token('123')
            ->channel('general')
            ->text('Hello from Ntim')
            ->send();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_will_throw_when_channel_is_not_set()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new SlackMessage)
            ->token('123')
            ->channel('')
            ->text('Hello from Ntim')
            ->send();
    }

    public function test_will_throw_when_token_is_not_set()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new SlackMessage)
            ->token('')
            ->channel('general')
            ->text('Hello from Ntim')
            ->send();
    }
}
