<?php declare(strict_types=1);

namespace NtimYeboah\PhpSlack\BlockKit\Blocks;

use NtimYeboah\PhpSlack\BlockKit\Composites\Image as CompositesImage;
use NtimYeboah\PhpSlack\BlockKit\Composites\Text;

class Image extends CompositesImage
{
    /**
     * Set the title of the block.
     *
     * @param string $text
     * @var array
     */
    public function title(string $text): self
    {
        $text = (new Text)
            ->text($text)
            ->plain();

        $this->blocks['title'] = $text->render();

        return $this;
    }

    /**
     * Set the slack file url url for the block.
     *
     * @param string $url
     * @return self
     */
    public function slackFileUrl(string $url): self
    {
        $this->blocks['slack_file'] = [
            'url' => $url,
        ];

        return $this;
    }
}
