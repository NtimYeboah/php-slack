<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\Emoji;
use PHPUnit\Framework\TestCase;

class EmojiTest extends TestCase
{
    public function test_can_render_an_emoji()
    {
        $rendered = (new Emoji)
            ->name('basketball')
            ->render();

        $blocks = [
            'type' => 'emoji',
            'name' => 'basketball',
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
