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
use Scribe\CacheBundle\DependencyInjection\Aware\CacheManagerAwareTrait;
use Scribe\Teavee\HtmlGeneratorBundle\Generator\GeneratorInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Provider\ProviderInterface;
use Scribe\Wonka\Exception\RuntimeException;

/**
 * Class AbstractManager.
 */
abstract class AbstractManager implements ManagerInterface
{
    use CacheManagerAwareTrait;

    /**
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * @var GeneratorInterface
     */
    protected $generator;

    /**
     * @var string
     */
    protected $errorStrategy;

    /**
     * @var bool
     */
    protected $lastResponseFromCache;

    /**
     * @var int
     */
    protected $ttlForResponseCache;

    /**
     * @param ProviderInterface  $provider
     * @param GeneratorInterface $generator
     */
    public function __construct(ProviderInterface $provider, GeneratorInterface $generator, $errorStrategy = null)
    {
        $this->provider = $provider;
        $this->generator = $generator;

        $this->registerErrorStrategy($errorStrategy);
    }

    /**
     * @param mixed   $subject
     * @param mixed[] $ops
     *
     * @return $this
     */
    public function render($subject, array $ops = [])
    {
        if (null === ($response = $this->getCacheResponse($subject, $ops))) {
            try {
                $provided = (array) $this->provider->find($ops, $subject);
                $response = (string) $this->generator->make($ops, ...$provided);
            } catch (\Exception $e) {
                return $this->renderError($e);
            }
        }

        return $this->setCacheResponse($response, $subject, $ops);
    }

    /**
     * @return bool
     */
    public function isLastResponseFromCache()
    {
        return (bool) ($this->lastResponseFromCache === true);
    }

    /**
     * @param \Twig_Environment $environment
     *
     * @return $this
     */
    public function registerTwigEnvironment(\Twig_Environment $environment = null)
    {
        if ($this->generator !== null) {
            $this->generator->setTwigEnvironment($environment);
        }

        return $this;
    }

    /**
     * @param CacheManagerInterface|null $manager
     * @param bool|false                 $enabled
     * @param int                        $ttl
     *
     * @return $this
     */
    public function registerCacheManager(CacheManagerInterface $manager = null, $enabled = false, $ttl = 0)
    {
        if ($enabled !== true) {
            $manager = null;
        }

        $this->setCacheManager($manager);
        $this->ttlForResponseCache = (int) $ttl;

        return $this;
    }

    /**
     * @param string|null $strategy
     *
     * @return $this
     */
    public function registerErrorStrategy($strategy = null)
    {
        $available = [self::ERR_ST_EXC, self::ERR_ST_NULL, self::ERR_ST_BOOL];
        $selection = current($available);

        array_walk($available, function ($s) use ($strategy, &$selection) {
            if ($strategy === $s) {
                $selection = $s;
            }
        });

        $this->errorStrategy = $selection;

        return $this;
    }

    /**
     * @param string    $response
     * @param mixed,... $for
     *
     * @return mixed
     */
    protected function setCacheResponse($response, ...$for)
    {
        if (true === $this->isCacheAvailable()) {
            $this
                ->getCache()
                ->setTtl($this->ttlForResponseCache)
                ->set($response, ...$for);

            $this->getCache()->resetTtl();
        }

        return $response;
    }

    /**
     * @param mixed,... $for
     *
     * @return mixed
     */
    protected function getCacheResponse(...$for)
    {
        $this->lastResponseFromCache = false;

        if (true === $this->isCacheAvailable() && null !== ($response = $this->getCache()->get(...$for))) {
            $this->lastResponseFromCache = true;

            return $response;
        }

        return;
    }

    /**
     * @param \Exception $e
     *
     * @throws RuntimeException
     *
     * @return bool|null
     */
    protected function renderError(\Exception $e)
    {
        switch ($this->errorStrategy) {
            case self::ERR_ST_BOOL:
                return false;

            case self::ERR_ST_NULL:
                return;
        }

        throw new RuntimeException('Could not render requested component.', null, $e);
    }
}

/* EOF */
