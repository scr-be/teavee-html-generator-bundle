<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Repository;

use Doctrine\ORM\Query;
use Scribe\Doctrine\Exception\ORMException;
use Scribe\Doctrine\ORM\Repository\EntityRepository;

/**
 * Class ButtonRepository.
 */
class ButtonRepository extends EntityRepository
{
    /**
     * @param string $button
     *
     * @throws ORMException
     *
     * @return array
     */
    public function findOneBySlugAsArray($button)
    {
        $query = $this
            ->createQueryBuilder('i')
            ->where('i.slug = :slug')
            ->setParameter('slug', $button)
            ->getQuery();

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Exception $e) {
            throw new ORMException('Button repository query failed for "%s" button.', null, $e, $button);
        }
    }
}

/* EOF */
