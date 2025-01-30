<?php declare(strict_types=1);

namespace App\BlockKit\Blocks;

use App\BlockKit\Composites\Image as CompositesImage;
use App\BlockKit\Composites\Text;

class Image extends CompositesImage
{
    public function title(string $text)
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->blocks['title'] = $text->render();

        return $this;
    }

    public function slackFileUrl(string $url)
    {
        $this->blocks['slack_file'] = [
            'url' => $url,
        ];

        return $this;
    }
}
