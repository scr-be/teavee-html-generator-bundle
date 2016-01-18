<?php

/*
 * This file is part of the Teavee HTML Generator Bundle.
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Tests\Doctrine\Entity;

use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity\Button;
use Scribe\Wonka\Utility\UnitTest\WonkaTestCase;

/**
 * Class IconTest.
 */
class ButtonTest extends WonkaTestCase
{
    use EntityAutomationTrait;

    public function test_mutators()
    {
        $this->runEntityTests(new Button(), [
            'slug' => [null,
                ['a', 'b', 'c']
            ],
            'description' => [null,
                ['ee', 'ff', 'gg']
            ],
            'template' => [null,
                ['d', 'e', 'f']
            ],
        ]);

        $button = new Button();
        $button->setSlug('test');
        static::assertEquals('test', (string) $button);
    }
}

/* EOF */
