<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Composites\Image as CompositesImage;
use NtimYeboah\PhpSlack\BlockKit\Composites\Text;

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
