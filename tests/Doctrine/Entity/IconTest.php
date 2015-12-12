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

use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity\Icon;
use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity\IconFamily;
use Scribe\Wonka\Utility\UnitTest\WonkaTestCase;

/**
 * Class IconTest.
 */
class IconTest extends WonkaTestCase
{
    use EntityAutomationTrait;

    public function test_mutators()
    {
        $this->runEntityTests(new Icon(), [
            'slug' => [null,
                ['a', 'b', 'c']
            ],
            'name' => [null,
                ['d', 'e', 'f']
            ],
            'aliases' => [[],
                [[0, 1, 2], ['g', 'h', 'i'], ['j', 'k', 'l']]
            ],
            'categories' => [[],
                [['m', 'n', 'o'], ['p', 'q', 'r'], ['s', 't', 'u']]
            ],
            'attributes' => [[],
                [['v', 'w', 'x'], ['y', 'q', 'aa'], ['bb', 'cc', 'dd']]
            ],
            'description' => [null,
                ['ee', 'ff', 'gg']
            ],
            'unicode' => [null,
                ['hh', 'ii', 'jj']
            ],
            'family' => [null,
                [new IconFamily(), new IconFamily(), new IconFamily()]
            ],
        ]);

        $icon = new Icon();
        $icon->setSlug('test');
        static::assertEquals('test', (string) $icon);
    }
}

/* EOF */
