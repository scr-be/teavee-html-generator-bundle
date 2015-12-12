<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Templating;

use Scribe\Teavee\HtmlGeneratorBundle\Manager\ManagerInterface;
use Scribe\WonkaBundle\Component\Templating\AbstractTwigExtension as BaseAbstractTwigExtension;

/**
 * Class AbstractTwigExtension.
 */
abstract class AbstractTwigExtension extends BaseAbstractTwigExtension
{
    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        parent::__construct();

        $this
            ->setManager($manager)
            ->enableOptionHtmlSafe()
            ->enableOptionNeedsEnv();
    }

    /**
     * @param ManagerInterface $manager
     *
     * @return $this
     */
    protected function setManager(ManagerInterface $manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return ManagerInterface
     */
    protected function getManager()
    {
        return $this->manager;
    }

    /**
     * @param \Twig_Environment $engine
     *
     * @return $this
     */
    protected function registerTwigEnvironment(\Twig_Environment $engine)
    {
        $this
            ->getManager()
            ->registerTwigEnvironment($engine);

        return $this;
    }
}

/* EOF */
