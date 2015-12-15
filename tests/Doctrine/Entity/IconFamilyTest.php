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

use Doctrine\Common\Collections\ArrayCollection;
use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity\Icon;
use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity\IconFamily;
use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity\IconTemplate;
use Scribe\Wonka\Utility\UnitTest\WonkaTestCase;

/**
 * Class IconFamilyTest.
 */
class IconFamilyTest extends WonkaTestCase
{
    use EntityAutomationTrait;

    public function test_mutators()
    {
        $this->runEntityTests(new IconFamily(), [
            'slug' => [null,
                ['a', 'b', 'c']
            ],
            'name' => [null,
                ['d', 'e', 'f']
            ],
            'version' => [null,
                [3, 4, 5]
            ],
            'url' => [null,
                ['d', 'e', 'f']
            ],
            'prefix' => [null,
                ['d', 'e', 'f']
            ],
            'requiredClasses' => [[],
                [['m', 'n', 'o'], ['p', 'q', 'r'], ['s', 't', 'u']]
            ],
            'optionalClasses' => [[],
                [['v', 'w', 'x'], ['y', 'q', 'aa'], ['bb', 'cc', 'dd']]
            ],
            'icons' => [null,
                [new ArrayCollection([new Icon(), new Icon(), new Icon()])]
            ],
            'templates' => [null,
                [new ArrayCollection([new IconTemplate(), new IconTemplate(), new IconTemplate()])]
            ],
        ]);

        $icon = new IconFamily();
        $icon->setSlug('test');
        static::assertEquals('test', (string) $icon);
    }
}

/* EOF */
