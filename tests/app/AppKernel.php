<?php

/*
 * This file is part of the Teavee HTML Generator Bundle.
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * Class AppKernel.
 */
class AppKernel extends \Scribe\WonkaBundle\Component\HttpKernel\Kernel
{
    /**
     * {@inherit-doc}
     */
    public function setup()
    {
        $this
            ->addBundle('\Symfony\Bundle\MonologBundle\MonologBundle')
            ->addBundle('\Symfony\Bundle\FrameworkBundle\FrameworkBundle')
            ->addBundle('\Symfony\Bundle\SecurityBundle\SecurityBundle')
            ->addBundle('\Symfony\Bundle\TwigBundle\TwigBundle')
            ->addBundle('\Doctrine\Bundle\DoctrineBundle\DoctrineBundle')
            ->addBundle('\Scribe\WonkaBundle\ScribeWonkaBundle')
            ->addBundle('\Scribe\CacheBundle\ScribeCacheBundle')
            ->addBundle('\Scribe\Teavee\HtmlGeneratorBundle\ScribeTeaveeHtmlGeneratorBundle')
            ->addBundle('\Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle', 'dev', 'test')
            ->addBundle('\Symfony\Bundle\DebugBundle\DebugBundle', 'dev', 'test');
    }
}

/* EOF */
