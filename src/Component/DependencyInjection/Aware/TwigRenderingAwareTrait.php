<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Component\DependencyInjection\Aware;

/**
 * Trait TwigRenderingAwareTrait.
 */
trait TwigRenderingAwareTrait
{
    use TwigEnvironmentAwareTrait;

    /**
     * @var \Twig_Template
     */
    protected $twigTemplate;

    /**
     * @param \Twig_Template $template
     *
     * @return $this
     */
    protected function setTwigTemplate(\Twig_Template $template)
    {
        $this->twigTemplate = $template;

        return $this;
    }

    /**
     * @return \Twig_Template
     */
    protected function getTwigTemplate()
    {
        return $this->twigTemplate;
    }

    /**
     * @param string $template
     * @param array  $arguments
     *
     * @throws \RuntimeException  When engineEnvironment has not been set
     * @throws \Twig_Error_Loader When the passed template cannot be found/loaded
     * @throws \Twig_Error_Syntax When the passed template contains a syntax error
     *
     * @return string
     */
    protected function getTwigRendering($template, $arguments)
    {
        $template = $this
            ->getTwigEnvironment()
            ->createTemplate($template);

        return $this
            ->setTwigTemplate($template)
            ->getTwigTemplate()
            ->render($arguments);
    }
}

/* EOF */
