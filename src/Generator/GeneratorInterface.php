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

use Scribe\Wonka\Exception\ExceptionInterface;

/**
 * Interface GeneratorInterface.
 */
interface GeneratorInterface
{
    /**
     * @param mixed[]   $ops
     * @param mixed,... $use
     *
     * @return string
     */
    public function make(array $ops = [], ...$use);

    /**
     * @param \Twig_Environment|null $engineEnvironment
     *
     * @return $this
     */
    public function setTwigEnvironment(\Twig_Environment $engineEnvironment = null);
}

/* EOF */
