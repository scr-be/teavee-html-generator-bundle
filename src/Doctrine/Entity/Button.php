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
 * Class Button.
 */
class Button extends SlugEntity
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
     * @var string
     */
    protected $template;

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
}

/* EOF */
