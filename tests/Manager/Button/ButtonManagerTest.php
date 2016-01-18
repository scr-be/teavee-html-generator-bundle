<?php

/*
 * This file is part of the Teavee HTML Generator Bundle.
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Tests\Manager\Button;

use Scribe\Teavee\HtmlGeneratorBundle\Generator\GeneratorInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Manager\Button\ButtonManager;
use Scribe\Teavee\HtmlGeneratorBundle\Manager\ManagerInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Provider\ProviderInterface;
use Scribe\WonkaBundle\Utility\TestCase\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ButtonManagerTest.
 */
class ButtonManagerTest extends KernelTestCase
{
    /**
     * @return ButtonManager
     */
    protected function getButtonGenerator()
    {
        return self::$staticContainer->get('s.teavee.button');
    }

    /**
     * @return CacheManager
     */
    protected function getCache()
    {
        return self::$staticContainer->get('s.cache');
    }

    /**
     * @return ButtonDoctrineProvider
     */
    protected function getProvider()
    {
        return self::$staticContainer->get('s.teavee_html_generator.button_provider');
    }

    /**
     * @return ButtonGenerator
     */
    protected function getGenerator()
    {
        return self::$staticContainer->get('s.teavee_html_generator.button_generator');
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
        static::assertTrue(self::$staticContainer->has('s.teavee.button'));
    }

    public function test_render_advanced()
    {
        $m = $this->getButtonGenerator();
        $expected =
<<<EOF
<a class="btn btn-primary btn-tooltip" data-delay="1000" data-foo="bar" data-position="bottom" data-tooltip="A test tooltip!" href="/teavee/html/generator/test/path/1/button-test"><span aria-label="Star (Categories: Web Application Icons)" class="fa  fa-fa_star" role="presentation">
</span>
    Button Test
</a>
EOF;

        static::assertNotEmpty($result = $m->render('Button Test', [
            'route' => ['teavee_html_generator_test_path_1' => [
                'a' => 'button-test'
            ]],
            'tooltip' => [
                'text' => 'A test tooltip!',
                'pos' => 'bottom',
                'delay' => 1000
            ],
            'data' => [
                'foo' => 'bar'
            ],
            'icon' => 'fa:star',
            'classes' => [
                'btn-primary'
            ],
            'type' => 'GENERAL',
        ]));
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_render_basic()
    {
        $m = $this->getButtonGenerator();
        $expected =
<<<EOF
<a class="btn  btn-tooltip" data-delay="30" data-position="top" data-tooltip="A test tooltip!" href="/teavee/html/generator/test/path/2">
        Button Test
</a>
EOF;

        static::assertNotEmpty($result = $m->render('Button Test', [
            'route' => 'teavee_html_generator_test_path_2',
            'tooltip' => 'A test tooltip!'
        ]));
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_render_route_nullable_args_omitted()
    {
        $m = $this->getButtonGenerator();
        $expected =
            <<<EOF
            <a class="btn  " href="/teavee/html/generator/test/path/3">
        Button Test
</a>
EOF;

        static::assertNotEmpty($result = $m->render('Button Test', [
            'route' => 'teavee_html_generator_test_path_3'
        ]));
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_render_route_nullable_args_provided()
    {
        $m = $this->getButtonGenerator();
        $expected =
            <<<EOF
            <a class="btn  " href="/teavee/html/generator/test/path/3/an-argument">
        Button Test
</a>
EOF;

        static::assertNotEmpty($result = $m->render('Button Test', [
            'route' => ['teavee_html_generator_test_path_3' => [
                'a' => 'an-argument'
            ]]
        ]));
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_render_minimal()
    {
        $m = $this->getButtonGenerator();
        $expected =
            <<<EOF
<a class="btn  " href="#">
        Button Test
</a>
EOF;

        static::assertNotEmpty($result = $m->render('Button Test'));
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_render_type_invalid()
    {
        $this->setExpectedException('Scribe\Wonka\Exception\RuntimeException');

        $m = $this->getButtonGenerator();
        $expected =
            <<<EOF
<a class="btn  " href="#">
        Button Test
</a>
EOF;

        static::assertNotEmpty($result = $m->render('Button Test', [
            'type' => 'invalid-type',
        ]));
        static::assertXmlStringEqualsXmlString($expected, $result);
    }
}

/* EOF */
