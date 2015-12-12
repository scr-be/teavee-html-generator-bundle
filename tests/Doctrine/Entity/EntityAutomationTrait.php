<?php

/*
 * This file is part of the Teavee HTML Generator Bundle.
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Tests\Doctrine\Entity;

use Scribe\Doctrine\ORM\Mapping\Entity;

/**
 * Class EntityAutomationTrait.
 */
trait EntityAutomationTrait
{
    public function runEntityTests(Entity $entity, array $tests = [])
    {
        foreach ($tests as $name => $actions) {
            if ($actions[0] !== null) {
                $this->entityMethod($entity, $name, 'initialize');
                static::assertEquals($actions[0], $this->entityMethod($entity, $name, 'get'));
            }

            foreach ($actions[1] as $a) {
                $this->entityMethod($entity, $name, 'set', $a);
                static::assertEquals($a, $this->entityMethod($entity, $name, 'get'));
            }
        }
    }

    public function entityMethod(Entity $entity, $name, $type, $parameters = null)
    {
        $name = strtolower($type) . ucfirst($name);

        if ($parameters === null) {
            return call_user_func([$entity, $name]);
        } else {
            return call_user_func([$entity, $name], $parameters);
        }
    }
}

/* EOF */
