<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Templating\Button;

use Scribe\Teavee\HtmlGeneratorBundle\Manager\Button\ButtonManagerInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Templating\AbstractTwigExtension;

/**
 * Class ButtonTwigExtension.
 */
class ButtonTwigExtension extends AbstractTwigExtension
{
    /**
     * @param ButtonManagerInterface $manager
     */
    public function __construct(ButtonManagerInterface $manager)
    {
        parent::__construct($manager);

        $this->addFunction('text_button', [$this, 'renderTextButton']);
        $this->addFunction('icon_button', [$this, 'renderIconButton']);
    }

    /**
     * @param \Twig_Environment $environment
     * @param string            $what
     * @param array[]           $opts
     *
     * @return string
     */
    public function renderTextButton(\Twig_Environment $environment, $what, array $opts = [])
    {
        return (string) $this
            ->registerTwigEnvironment($environment)
            ->render($what, $opts);
    }

    /**
     * @param \Twig_Environment $environment
     * @param string            $what
     * @param array[]           $opts
     *
     * @return string
     */
    public function renderIconButton(\Twig_Environment $environment, $what, array $opts = [])
    {
        return (string) $this
            ->registerTwigEnvironment($environment)
            ->render('', array_merge(['icon' => $what], $opts));
    }
}

/* EOF */
