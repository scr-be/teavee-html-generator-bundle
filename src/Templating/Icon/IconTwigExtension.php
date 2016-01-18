<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Templating\Icon;

use Scribe\Teavee\HtmlGeneratorBundle\Manager\Icon\IconManagerInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Templating\AbstractTwigExtension;

/**
 * Class IconTwigExtension.
 */
class IconTwigExtension extends AbstractTwigExtension
{
    /**
     * @param IconManagerInterface $manager
     */
    public function __construct(IconManagerInterface $manager)
    {
        parent::__construct($manager);

        $this->addFunction('icon', [$this, 'renderIcon']);
    }

    /**
     * @param \Twig_Environment $environment
     * @param string            $what
     * @param array[]           $ops
     *
     * @return string
     */
    public function renderIcon(\Twig_Environment $environment, $what, array $ops = [])
    {
        return (string) $this
            ->registerTwigEnvironment($environment)
            ->render($what, $ops);
    }
}

/* EOF */
