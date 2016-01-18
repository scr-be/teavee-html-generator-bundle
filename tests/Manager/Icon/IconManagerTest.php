<?php

/*
 * This file is part of the Teavee HTML Generator Bundle.
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Tests\Manager\Icon;

use Scribe\Teavee\HtmlGeneratorBundle\Generator\GeneratorInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Manager\ManagerInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Provider\ProviderInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Manager\Icon\IconManager;
use Scribe\Teavee\HtmlGeneratorBundle\Generator\Icon\IconGenerator;
use Scribe\Teavee\HtmlGeneratorBundle\Provider\Icon\IconDoctrineProvider;
use Scribe\WonkaBundle\Utility\TestCase\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class IconManagerTest.
 */
class IconManagerTest extends KernelTestCase
{
    /**
     * @return IconManager
     */
    protected function getIconGenerator()
    {
        return self::$staticContainer->get('s.teavee.icon');
    }

    /**
     * @return CacheManager
     */
    protected function getCache()
    {
        return self::$staticContainer->get('s.cache');
    }

    /**
     * @return IconDoctrineProvider
     */
    protected function getProvider()
    {
        return self::$staticContainer->get('s.teavee_html_generator.icon_provider');
    }

    /**
     * @return IconGenerator
     */
    protected function getGenerator()
    {
        return self::$staticContainer->get('s.teavee_html_generator.icon_generator');
    }

    /**
     * @return \Twig_Environment
     */
    protected function getTwig()
    {
        return self::$staticContainer->get('twig');
    }

    public function test_service_exists()
    {
        static::assertTrue(self::$staticContainer->has('s.teavee.icon'));
    }

    public function test_render_string_formats()
    {
        $m = $this->getIconGenerator();
        $expected =
<<<EOF
<span
    class="fa  fa-fa_glass"
    role="presentation"
    aria-label="Glass (Categories: Web Application Icons)">
</span>
EOF;

        static::assertNotEmpty($result = $m->render('fa-glass'));
        static::assertXmlStringEqualsXmlString($expected, $result);
        static::assertNotEmpty($result = $m->render('fa_glass'));
        static::assertXmlStringEqualsXmlString($expected, $result);
        static::assertNotEmpty($result = $m->render('fa:glass'));
        static::assertXmlStringEqualsXmlString($expected, $result);
        static::assertNotEmpty($result = $m->render('fa-f000'));
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_render_options()
    {
        $m = $this->getIconGenerator();
        $expected =
<<<EOF
<span
    class="fa fa-fw fa-dark fa-fa_glass"
    role="img"
    aria-hidden="true"
    aria-label="Glass half full? (Categories: Web Application Icons)">
</span>
EOF;

        $result = $m->render('fa-glass', [
            'classes' => ['fa-fw', 'fa-dark'],
            'ariaRole' => 'img',
            'ariaLabel' => 'Glass half full?',
            'ariaHidden' => true,
        ]);
        static::assertNotEmpty($result);
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_render_invalid_options()
    {
        $m = $this->getIconGenerator();
        $expected =
<<<EOF
<span
    class="fa fa-fw fa-dark fa-fa_glass"
    role="presentation"
    aria-hidden="true"
    aria-label="Glass (Categories: Web Application Icons)">
</span>
EOF;

        $result = $m->render('fa-glass', [
            'classes' => ['fa-fw', 'fa-dark', 'invalid-option'],
            'ariaRole' => 'invalid-role',
            'ariaLabel' => 100,
            'ariaHidden' => true,
        ]);
        static::assertNotEmpty($result);
        static::assertXmlStringEqualsXmlString($expected, $result);

        $expected =
<<<EOF
<span
    class="fa  fa-fa_glass"
    role="presentation"
    aria-hidden="true"
    aria-label="Glass (Categories: Web Application Icons)">
</span>
EOF;

        $result = $m->render('fa-glass', [
            'classes' => 4,
            'ariaRole' => 'invalid-role-second',
            'ariaLabel' => new \stdClass(),
            'ariaHidden' => 5,
        ]);
        static::assertNotEmpty($result);
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_building_manager()
    {
        $this->getCache()->getActive()->flush();

        $m = new IconManager($this->getProvider(), $this->getGenerator());
        $m->registerCacheManager($this->getCache(), true, 3600);
        $m->registerTwigEnvironment($this->getTwig());

        $expected =
            <<<EOF
            <span
    class="fa fa-fw fa-fa_glass"
    role="img"
    aria-hidden="true"
    aria-label="Glass half full? (Categories: Web Application Icons)">
</span>
EOF;

        foreach (range(5, 30) as $i) {

            if ($i % 5 === 0) {
                $this->getCache()->getActive()->flush();
            }

            $result = $m->render(
                'fa-glass',
                [
                    'classes' => ['fa-fw', 'fa-foo'],
                    'ariaRole' => 'img',
                    'ariaLabel' => 'Glass half full?',
                    'ariaHidden' => true,
                ]
            );
            static::assertNotEmpty($result);
            static::assertXmlStringEqualsXmlString($expected, $result);

            if ($i % 5 === 0) {
                static::assertFalse($m->isLastResponseFromCache());
            } else {
                static::assertTrue($m->isLastResponseFromCache());
            }

        }
    }

    public function test_error_strategies()
    {
        $m = new IconManager($this->getProvider(), $this->getGenerator());
        $m->registerTwigEnvironment($this->getTwig());

        $m->registerErrorStrategy(ManagerInterface::ERR_ST_NULL);
        static::assertNull($m->render('unknown-icon-identifier'));

        $m->registerErrorStrategy(ManagerInterface::ERR_ST_BOOL);
        static::assertFalse($m->render('unknown-icon-identifier'));

        $m->registerErrorStrategy(ManagerInterface::ERR_ST_EXC);
        $this->setExpectedException('Scribe\Wonka\Exception\RuntimeException');
        static::assertNotEmpty($result = $m->render('unknown-icon-identifier'));
    }
}

/* EOF */
