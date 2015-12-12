<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Manager;

use Scribe\CacheBundle\Component\Manager\CacheManagerInterface;

/**
 * Interface ManagerInterface.
 */
interface ManagerInterface
{
    /**
     * @var string
     */
    const ERR_ST_EXC = 'throw_exception';

    /**
     * @var string
     */
    const ERR_ST_NULL = 'null_return';

    /**
     * @var string
     */
    const ERR_ST_BOOL = 'boolean_return';

    /**
     * @param mixed   $subject
     * @param mixed[] $ops
     *
     * @return string|null|false
     */
    public function render($subject, array $ops = []);

    /**
     * @return bool
     */
    public function isLastResponseFromCache();

    /**
     * @param \Twig_Environment $environment
     *
     * @return $this
     */
    public function registerTwigEnvironment(\Twig_Environment $environment);

    /**
     * @param CacheManagerInterface|null $manager
     * @param bool|false                 $enabled
     * @param int                        $ttl
     *
     * @return $this
     */
    public function registerCacheManager(CacheManagerInterface $manager = null, $enabled = false, $ttl = 0);

    /**
     * @param string|null $strategy
     *
     * @return $this
     */
    public function registerErrorStrategy($strategy = null);
}

/* EOF */
