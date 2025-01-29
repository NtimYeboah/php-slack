<?php

namespace Tests\Composite\Blocks;

use App\Composite\Blocks\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function test_can_render_an_image()
    {
        $rendered = (new Image)->render();

        $blocks = [
            'type' => 'image',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_an_image_and_url()
    {
        $rendered = (new Image)
            ->url('http://path/to/image.jpg')
            ->altText('most beautiful image on the planet')
            ->render();

        $blocks = [
            'type' => 'image',
            'image_url' => 'http://path/to/image.jpg',
            'alt_text' => 'most beautiful image on the planet'
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
