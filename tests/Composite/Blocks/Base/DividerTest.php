<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\Divider;
use PHPUnit\Framework\TestCase;

class DividerTest extends TestCase
{
    public function test_can_render_a_divider()
    {
        $rendered = (new Divider)->render();

        $blocks = [
            'type' => 'divider',
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
