<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Entity;

use Scribe\Doctrine\ORM\Mapping\SlugEntity;

/**
 * Class IconTemplate.
 */
class IconTemplate extends SlugEntity
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $variables;

    /**
     * @var int
     */
    protected $priority;

    /**
     * @var string
     */
    protected $engine;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var IconFamily
     */
    protected $family;

    /**
     * Support for casting from object type to string type.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getIdentity();
    }

    /**
     * @return $this
     */
    public function initializeVariables()
    {
        $this->variables = [];

        return $this;
    }

    /**
     * @param string|null $name the name string
     *
     * @return $this
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $description
     *
     * @return $this
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int
     *
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param array
     *
     * @return $this
     */
    public function setVariables($variables = null)
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setEngine($engine = null)
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setTemplate($template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param IconFamily
     *
     * @return $this
     */
    public function setFamily(IconFamily $family = null)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * @return IconFamily
     */
    public function getFamily()
    {
        return $this->family;
    }
}

/* EOF */
