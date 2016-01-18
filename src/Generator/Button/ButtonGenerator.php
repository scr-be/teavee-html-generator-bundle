<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Generator\Button;

use Scribe\Teavee\HtmlGeneratorBundle\Generator\GeneratorInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Generator\AbstractTwigGenerator;

/**
 * Class ButtonGenerator.
 */
class ButtonGenerator extends AbstractTwigGenerator implements GeneratorInterface
{
    /**
     * @var mixed[]
     */
    protected $tooltip;

    /**
     * @var null|string
     */
    protected $template;

    /**
     * @var string[]
     */
    protected $classes;

    /**
     * @var mixed[]
     */
    protected $data;

    /**
     * @var mixed[]
     */
    protected $route;

    /**
     * @var mixed[]
     */
    protected $icon;

    /**
     * @var mixed
     */
    protected $subject;

    /**
     * @param mixed[]    $ops
     * @param mixed|null $subject
     * @param mixed,...  $use
     *
     * @return string
     */
    public function make(array $ops = [], $subject = null, ...$use)
    {
        $this->resetState();

        $this->subject = $subject;

        list($this->template)
            = $this->parseProvidedCollection($use);

        list($this->classes, $this->tooltip, $this->data, $this->icon, $this->route)
            = $this->parseOptionsCollection($ops);

        return $this->generate();
    }

    /**
     * @param mixed[] $provided
     *
     * @return mixed[]
     */
    protected function parseProvidedCollection(array $provided = [])
    {
        return $provided;
    }

    /**
     * @param string[] $ops
     *
     * @return mixed[]
     */
    protected function parseOptionsCollection(array $ops = [])
    {
        $options = [];

        foreach (['classes', 'tooltip', 'data', 'icon', 'route'] as $o) {
            $options[] = $this->parseOptionsValue($o, $ops);
        }

        $options[] = $ops;

        return $options;
    }

    /**
     * @param string[] $ops
     * @param string   $index
     *
     * @return mixed
     */
    protected function parseOptionsValue($index, array $ops = [])
    {
        $filtered = call_user_func([$this, 'filterOption'.ucfirst($index)], isset($ops[$index]) ? $ops[$index] : null);
        unset($ops[$index]);

        return $filtered;
    }

    /**
     * @param mixed $classes
     *
     * @return string[]
     */
    protected function filterOptionClasses($classes)
    {
        return (array) $classes;
    }

    /**
     * @param mixed $tooltip
     *
     * @return string
     */
    protected function filterOptionTooltip($tooltip)
    {
        $return = [];

        if (is_string($tooltip)) {
            $return['text'] = $tooltip;
        } else if (isset($tooltip['text'])) {
            $return['text'] = $tooltip['text'];
        }

        return array_merge($return, [
            'pos' => isset($tooltip['pos']) ? $tooltip['pos'] : 'top',
            'delay' => isset($tooltip['delay']) ? $tooltip['delay'] : 30,
            'enabled' => isset($return['text']),
        ]);
    }

    /**
     * @param mixed $data
     *
     * @return mixed[]
     */
    protected function filterOptionData($data)
    {
        return (array) $data;
    }

    /**
     * @param mixed $icon
     *
     * @return mixed[]
     */
    protected function filterOptionIcon($icon)
    {
        $return = [];

        if (is_string($icon) && strlen($icon) > 0) {
            $return['name'] = $icon;
        }

        return array_merge($return, [
            'enabled' => isset($return['name']),
        ]);
    }

    /**
     * @param mixed $route
     *
     * @return string|null
     */
    protected function filterOptionRoute($route)
    {
        $return = [];

        if (is_string($route) && strlen($route) > 0) {
            $return = [
                'name' => $route,
                'args' => []
            ];
        }

        if (is_array($route)) {
            $return = [
                'name' => key($route),
                'args' => is_array(current($route)) ? current($route) : []
            ];
        }

        return array_merge($return, [
            'enabled' => isset($return['name']),
        ]);
    }

    /**
     * @return $this
     */
    protected function resetState()
    {
        $this->classes = [];
        $this->data = [];
        $this->tooltip = [];
        $this->icon = [];
        $this->route = [];

        return $this;
    }

    /**
     * @return mixed[]
     */
    protected function templateHelper()
    {
        return [
            'btn' => [
                'classes' => $this->classes,
                'data' => $this->data,
                'text' => $this->subject,
            ],
            'tt' => $this->tooltip,
            'icon' => $this->icon,
            'route' => $this->route,
        ];
    }

    /**
     * @return string
     */
    protected function generate()
    {
        return $this->getTwigRendering($this->template, $this->templateHelper());
    }
}

/* EOF */
