<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\Context;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ContextTest extends TestCase
{
    public function test_can_render_a_context()
    {
        $rendered = (new Context)->render();

        $blocks = [
            'type' => 'context',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_context_text()
    {
        $rendered = (new Context)
            ->text('This is a context text')
            ->render();

        $blocks = [
            'type' => 'context',
            'elements' => [
                [
                    'type' => 'plain_text',
                    'text' => 'This is a context text',
                ],
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_context_markdown()
    {
        $rendered = (new Context)
            ->text('This is a markdown text')
            ->markdown()
            ->render();

        $blocks = [
            'type' => 'context',
            'elements' => [
                [
                    'type' => 'mrkdwn',
                    'text' => 'This is a markdown text',
                ],
            ]
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_context_image()
    {
        $rendered = (new Context)
            ->image('http://path/to/image.jpg')
            ->altText('most beautiful image in the world')
            ->render();

        $blocks = [
            'type' => 'context',
            'elements' => [
                [
                    'type' => 'image',
                    'image_url' => 'http://path/to/image.jpg',
                    'alt_text' => 'most beautiful image in the world',
                ],
            ],
        ];

        $this->assertEquals($rendered, $blocks);
    }


    public function test_cannot_render_alt_text_on_non_image_block()
    {
        $this->expectException(RuntimeException::class);
        
        (new Context)
            ->text('This is a non image block')
            ->altText('most beautiful image in the world')
            ->render();
    }
}
