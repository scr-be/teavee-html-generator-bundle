<?php

/*
 * This file is part of the Teavee HTML Generator Bundle.
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Tests\Templating\Icon;

use Scribe\Teavee\HtmlGeneratorBundle\Templating\Icon\IconExtension;
use Scribe\WonkaBundle\Utility\TestCase\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class IconGeneratorTest.
 */
class IconExtensionTest extends KernelTestCase
{
    /**
     * @return IconExtension
     */
    protected function getIconExtension()
    {
        return self::$staticContainer->get('s.teavee_html_generator.icon_extension');
    }

    /**
     * @return \Twig_Environment
     */
    protected function getTwig()
    {
        return self::$staticContainer->get('twig');
    }

    public function test_extension_render()
    {
        $e = $this->getIconExtension();
        $expected =
<<<EOF
<span
    class="fa fa-fw fa-dark fa-fa_glass"
    role="img"
    aria-hidden="true"
    aria-label="Glass half full? (Categories: Web Application Icons)">
</span>
EOF;

        $result = $e->renderIcon($this->getTwig(), 'fa-glass', [
            'classes' => ['fa-fw', 'fa-dark'],
            'ariaRole' => 'img',
            'ariaLabel' => 'Glass half full?',
            'ariaHidden' => true,
        ]);
        static::assertNotEmpty($result);
        static::assertXmlStringEqualsXmlString($expected, $result);
    }
}

/* EOF */
