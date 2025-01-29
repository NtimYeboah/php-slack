<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\Header;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase
{
    public function test_can_render_a_header()
    {
        $rendered = (new Header)->render();

        $blocks = [
            'type' => 'header',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_header_text()
    {
        $rendered = (new Header)
            ->text('This is a header text')
            ->render();

        $blocks = [
            'type' => 'header',
            'text' => [
                'type' => 'plain_text',
                'text' => 'This is a header text',
            ],
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
