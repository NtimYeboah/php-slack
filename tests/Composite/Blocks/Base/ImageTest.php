<?php

namespace Tests\Composite\Blocks\Base;

use App\Composite\Blocks\Base\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function test_can_render_an_image_with_title()
    {
        $rendered = (new Image)
            ->url('http://path/to/image.jpg')
            ->title('I love tacos')
            ->render();

        $blocks = [
            'type' => 'image',
            'title' => [
                'type' => 'plain_text',
                'text' => 'I love tacos'
            ],
            'image_url' => 'http://path/to/image.jpg',
        ];

        $this->assertEquals($rendered, $blocks);
    }

    public function test_can_render_a_slack_file()
    {
        $rendered = (new Image)
            ->slackFileUrl('http://path/to/image.jpg')
            ->altText('Inspiration')
            ->render();

        $blocks = [
            'type' => 'image',
            'slack_file' => [
                'url' => 'http://path/to/image.jpg',
            ],
            'alt_text' => 'Inspiration',
        ];

        $this->assertEquals($rendered, $blocks);
    }
}
