<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Generator\Icon;

use Scribe\Teavee\HtmlGeneratorBundle\Generator\GeneratorInterface;
use Scribe\Teavee\HtmlGeneratorBundle\Generator\AbstractTwigGenerator;

/**
 * Class IconGenerator.
 */
class IconGenerator extends AbstractTwigGenerator implements GeneratorInterface
{
    /**
     * @var null|string
     */
    protected $icon;

    /**
     * @var null|string
     */
    protected $family;

    /**
     * @var null|string
     */
    protected $template;

    /**
     * @var string[]
     */
    protected $options;

    /**
     * @var string[]
     */
    protected $classes;

    /**
     * @var bool
     */
    protected $ariaHidden = true;

    /**
     * @var null|string
     */
    protected $ariaLabel = null;

    /**
     * @var string
     */
    protected $ariaRole = 'presentation';

    /**
     * @var array
     */
    protected static $validAriaRoles = [
        'img', 'link', 'button', 'presentation',
    ];

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

        list($this->icon, $this->family, $this->template)
            = $this->parseProvidedCollection($use);

        list($this->classes, $this->ariaRole, $this->ariaLabel, $this->ariaHidden, $this->options)
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

        foreach (['classes', 'ariaRole', 'ariaLabel', 'ariaHidden'] as $o) {
            $options[] = isset($ops[$o]) ? $this->parseOptionsValue($o, $ops) : $this->{$o};
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
        $filtered = call_user_func([$this, 'filterOption'.ucfirst($index)], $ops[$index]);
        unset($ops[$index]);

        return $filtered;
    }

    /**
     * @param mixed[] $classes
     *
     * @return string[]
     */
    protected function filterOptionClasses($classes)
    {
        if (!is_array($classes) || !isset($this->family['optionalClasses']) || count($this->family['optionalClasses']) === 0) {
            return [];
        }

        return array_filter($classes, function ($class) {
            return (bool) is_string($class) && in_array($class, $this->family['optionalClasses']);
        });
    }

    /**
     * @param mixed $role
     *
     * @return string
     */
    protected function filterOptionAriaRole($role)
    {
        if (!in_array($role, self::$validAriaRoles)) {
            return end(self::$validAriaRoles);
        }

        return $role;
    }

    /**
     * @param mixed $label
     *
     * @return null|string
     */
    protected function filterOptionAriaLabel($label)
    {
        if (!is_string($label) || strlen($label) === 0) {
            return;
        }

        return $label;
    }

    /**
     * @param mixed $hidden
     *
     * @return bool
     */
    protected function filterOptionAriaHidden($hidden)
    {
        return (bool) $hidden;
    }

    /**
     * @return $this
     */
    protected function resetState()
    {
        $this->icon = null;
        $this->family = null;
        $this->template = null;
        $this->options = [];
        $this->classes = [];
        $this->ariaRole = end(self::$validAriaRoles);
        $this->ariaHidden = false;
        $this->ariaLabel = null;

        return $this;
    }

    /**
     * @return mixed[]
     */
    protected function templateHelper()
    {
        return [
            'hasRole' => (bool) ($this->ariaRole !== null),
            'role' => (string) $this->ariaRole,
            'isHidden' => (bool) ($this->ariaHidden === true),
            'hasLabel' => (bool) ($this->ariaLabel !== null),
            'label' => (string) $this->ariaLabel,
        ];
    }

    /**
     * @return string
     */
    protected function generate()
    {
        return $this->getTwigRendering($this->template['template'],
            [
                'family' => $this->family,
                'icon' => $this->icon,
                'classes' => $this->classes,
                'options' => $this->options,
                'aria' => $this->templateHelper(),
            ]
        );
    }
}

/* EOF */
