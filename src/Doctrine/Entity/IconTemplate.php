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
    const VERSION = '0.1.0';

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $priority;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var IconFamily
     */
    protected $family;

    /**
     * @return $this
     */
    public function initializeVariables()
    {
        $this->variables = [];

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->hasIdentity() ? $this->getIdentity() : spl_object_hash($this);
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
