<?php declare(strict_types=1);

namespace App\BlockKit;

class Blocks
{
    public function __construct(
        private array $blocks
    ) {}

    /**
     * Get array representation of blocks
     *
     * @return array
     */
    public function toArray()
    {
        return $this->blocks;
    }

    /**
     * Get json representation of blocks.
     *
     * @return string|false
     */
    public function toString()
    {
        return json_encode($this->blocks);
    }
}
