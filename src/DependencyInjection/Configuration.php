<?php

/*
 * This file is part of the Teavee HTML Generator Bundle.
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\DependencyInjection;

use Scribe\WonkaBundle\Component\DependencyInjection\AbstractConfiguration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;

/**
 * Class Configuration.
 */
class Configuration extends AbstractConfiguration
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $this
            ->getBuilderRoot()
            ->getNodeDefinition()
            ->info('Configuration for scr-be/teavee-html-generator-bundle')
            ->canBeEnabled()
            ->children()
                ->append($this->getCacheNode())
            ->end();

        return $this
            ->getBuilderRoot()
            ->getTreeBuilder();
    }

    /**
     * @return NodeDefinition
     */
    protected function getCacheNode()
    {
        return $this
            ->getBuilder('cache')
            ->getNodeDefinition()
            ->addDefaultsIfNotSet()
            ->info('The optional generator cache component.')
            ->children()
                ->integerNode('ttl')
                    ->info('The TTL (time-to-live) for cache entries.')
                    ->defaultValue(3600)
                    ->treatNullLike(3600)
                    ->treatFalseLike(0)
                    ->treatTrueLike(3600)
                ->end()
                ->booleanNode('enabled')
                    ->defaultFalse()
                    ->info('Should the cache component be used?')
                    ->treatNullLike(false)
                ->end()
            ->end();
    }
}

/* EOF */
