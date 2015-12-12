<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Generator;

use Scribe\Teavee\HtmlGeneratorBundle\Component\DependencyInjection\Aware\TwigRenderingAwareTrait;

/**
 * Class AbstractTwigGenerator.
 */
abstract class AbstractTwigGenerator
{
    use TwigRenderingAwareTrait;
}

/* EOF */
