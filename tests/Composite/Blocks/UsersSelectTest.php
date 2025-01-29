<?php

namespace Tests\Composite\Blocks;

use App\Blocks\Blocks;
use App\Blocks\BlocksBuilder;
use App\Composite\Blocks\Placeholder;
use App\Composite\Blocks\PlainText;
use App\Composite\Blocks\Section;
use App\Composite\Blocks\UsersSelect;
use PHPUnit\Framework\TestCase;

class UsersSelectTest extends TestCase
{
    public function test_can_render_users_select_blocks()
    {
        $rendered = (new UsersSelect)->render();

        $blocks = [
            'type' => 'section',
            'text' => [],
            'accessory' => [
                'type' => 'users_select',
                'action_id' => 'users_select-action',
            ],
        ];

        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($blocks, $rendered, ['type', 'text', 'accessory']);
    }

    public function test_can_build_users_select()
    {
        $usersSelectBlocks = (new BlocksBuilder)
            ->section(function (Section $section) {
                return $section
                    /* ->addField(new PlainText([
                        'text' => 'This is a header with a plain text'
                    ])) */
                    ->addField(
                        (new UsersSelect)
                            
                            ->placeholder(new Placeholder([
                                'text' => 'This is a placeholder for user slect',
                            ]
                        ))
                    );
            })
            ->build();

        print_r($usersSelectBlocks);

        //$this->assertInstanceOf(Blocks::class, $usersSelectBlocks);
    }
}
