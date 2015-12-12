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

use Doctrine\Common\Collections\ArrayCollection;
use Scribe\Doctrine\ORM\Mapping\SlugEntity;

/**
 * Class Icon.
 */
class Icon extends SlugEntity
{
    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $aliases;

    /**
     * @var array
     */
    protected $categories;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $unicode;

    /**
     * @var IconFamily
     */
    protected $family;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getIdentity();
    }

    /**
     * @return $this
     */
    public function initializeAliases()
    {
        $this->aliases = [];

        return $this;
    }

    /**
     * @return $this
     */
    public function initializeCategories()
    {
        $this->categories = [];

        return $this;
    }

    /**
     * @return $this
     */
    public function initializeAttributes()
    {
        $this->attributes = [];

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
     * @param array|null $aliases
     *
     * @return $this
     */
    public function setAliases(array $aliases = null)
    {
        $this->aliases = $aliases;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * @param array|null $categories
     *
     * @return $this
     */
    public function setCategories(array $categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array|null $attributes array of attributes
     *
     * @return $this
     */
    public function setAttributes(array $attributes = null)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAttributes()
    {
        return $this->attributes;
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
     * @param string
     *
     * @return $this
     */
    public function setUnicode($unicode = null)
    {
        $this->unicode = $unicode;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnicode()
    {
        return $this->unicode;
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
