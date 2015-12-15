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

use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity\IconFamily;
use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity\IconTemplate;
use Scribe\Wonka\Utility\UnitTest\WonkaTestCase;

/**
 * Class IconTemplateTest.
 */
class IconTemplateTest extends WonkaTestCase
{
    use EntityAutomationTrait;

    public function test_mutators()
    {
        $this->runEntityTests(new IconTemplate(), [
            'slug' => [null,
                ['a', 'b', 'c']
            ],
            'description' => [null,
                ['ee', 'ff', 'gg']
            ],
            'priority' => [null,
                [3, 4, 5]
            ],
            'template' => [null,
                ['d', 'e', 'f']
            ],
            'family' => [null,
                [new IconFamily(), new IconFamily(), new IconFamily()]
            ],
        ]);

        $icon = new IconTemplate();
        $icon->setSlug('test');
        static::assertEquals('test', (string) $icon);
    }
}

/* EOF */
