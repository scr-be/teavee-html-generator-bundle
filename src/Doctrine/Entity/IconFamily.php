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
 * Class IconFamily.
 */
class IconFamily extends SlugEntity
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $aliases;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var array
     */
    protected $requiredClasses;

    /**
     * @var array
     */
    protected $optionalClasses;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var Icon[]
     */
    protected $icons;

    /**
     * @var IconTemplate[]
     */
    protected $templates;

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
    public function initializeRequiredClasses()
    {
        $this->requiredClasses = [];

        return $this;
    }

    /**
     * @return $this
     */
    public function initializeOptionalClasses()
    {
        $this->optionalClasses = [];

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
     * @return $this
     */
    public function initializeIcons()
    {
        $this->icons = new ArrayCollection();

        return $this;
    }

    /**
     * @return $this
     */
    public function initializeTemplates()
    {
        $this->templates = new ArrayCollection();

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
     * @param string|null $version the version integer value
     *
     * @return $this
     */
    public function setVersion($version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVersion()
    {
        return $this->version;
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
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @param array
     *
     * @return $this
     */
    public function setRequiredClasses($requiredClasses = null)
    {
        $this->requiredClasses = $requiredClasses;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredClasses()
    {
        return $this->requiredClasses;
    }

    /**
     * @param array
     *
     * @return $this
     */
    public function setOptionalClasses($optionalClasses = null)
    {
        $this->optionalClasses = $optionalClasses;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptionalClasses()
    {
        return $this->optionalClasses;
    }

    /**
     * @param ArrayCollection $templates
     *
     * @return $this
     */
    public function setTemplates(ArrayCollection $templates = null)
    {
        $this->templates = $templates;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * @param ArrayCollection $icons
     *
     * @return $this
     */
    public function setIcons(ArrayCollection $icons = null)
    {
        $this->icons = $icons;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getIcons()
    {
        return $this->icons;
    }
}

/* EOF */
