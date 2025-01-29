<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\Actions;
use PHPUnit\Framework\TestCase;

class ActionsTest extends TestCase
{
    public function test_can_render_an_action()
    {
        $rendered = (new Actions)->render();

        $blocks = [
            'type' => 'actions',
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
