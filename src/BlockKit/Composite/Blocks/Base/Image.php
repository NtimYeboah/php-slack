<?php declare(strict_types=1);

namespace App\Composite\Blocks\Base;

use App\Composite\Blocks\Image as BlocksImage;
use App\Composite\Blocks\Text;

class Image extends BlocksImage
{
    public function title(string $text)
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->block['title'] = $text->render();

        return $this;
    }

    public function slackFileUrl(string $url)
    {
        $this->block['slack_file'] = [
            'url' => $url,
        ];

        return $this;
    }
}
