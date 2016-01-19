<?php

/*
 * This file is part of the Teavee HTML Generator Bundle.
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Tests\Templating\Button;

use Scribe\Teavee\HtmlGeneratorBundle\Templating\Button\ButtonTwigExtension;
use Scribe\WonkaBundle\Utility\TestCase\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ButtonGeneratorTest.
 */
class ButtonExtensionTest extends KernelTestCase
{
    /**
     * @return ButtonTwigExtension
     */
    protected function getButtonExtension()
    {
        return self::$staticContainer->get('s.teavee_html_generator.button_extension');
    }

    /**
     * @return \Twig_Environment
     */
    protected function getTwig()
    {
        return self::$staticContainer->get('twig');
    }

    public function test_extension_render_text_btn()
    {
        $e = $this->getButtonExtension();
        $expected =
<<<EOF
<a class="btn  " href="#">
        Button Test
</a>
EOF;

        $result = $e->renderTextButton($this->getTwig(), 'Button Test');
        static::assertNotEmpty($result);
        static::assertXmlStringEqualsXmlString($expected, $result);
    }

    public function test_extension_render_icon_btn()
    {
        $e = $this->getButtonExtension();
        $expected =
<<<EOF
<a class="btn btn-primary btn-tooltip" data-delay="1000" data-foo="bar" data-position="bottom" data-tooltip="A test tooltip!" href="/teavee/html/generator/test/path/1/button-test"><span aria-label="Star (Categories: Web Application Icons)" class="fa  fa-fa_star" role="presentation">
</span>
</a>
EOF;

        $result = $e->renderIconButton($this->getTwig(), 'fa:star', [
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
            'classes' => [
                'btn-primary'
            ],
            'type' => 'GENERAL',
        ]);

        static::assertNotEmpty($result);
        static::assertXmlStringEqualsXmlString($expected, $result);
    }
}

/* EOF */
