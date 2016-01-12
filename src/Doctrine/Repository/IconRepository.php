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
 * Class IconRepository.
 */
class IconRepository extends EntityRepository
{
    /**
     * @param string $icon
     *
     * @throws ORMException
     *
     * @return array
     */
    public function findOneBySlugAsArray($icon)
    {
        $query = $this
            ->createQueryBuilder('i')
            ->where('i.slug = :slug')
            ->setParameter('slug', $icon)
            ->leftJoin('i.family', 'family')
            ->leftJoin('family.templates', 'templates')
            ->addSelect('family')
            ->addSelect('templates')
            ->getQuery();

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Exception $e) {
            throw new ORMException('Icon repository query failed for "%s" icon.', null, $e, $icon);
        }
    }

    /**
     * @param string $icon
     * @param string $family
     *
     * @throws ORMException
     *
     * @return array
     */
    public function findOneByNameAndFamilyAsArray($icon, $family)
    {
        $query = $this
            ->createQueryBuilder('i')
            ->where('i.name = :name')
            ->setParameters([
                'name'   => $icon,
                'family' => $family,
            ])
            ->leftJoin('i.family', 'family')
            ->leftJoin('family.templates', 'templates')
            ->addSelect('family')
            ->addSelect('templates')
            ->andWhere('family.slug = :family')
            ->getQuery();

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Exception $e) {
            throw new ORMException('Icon repository query failed for "%s" icon.', null, $e, $icon);
        }
    }

    /**
     * @param string $icon
     *
     * @throws ORMException
     *
     * @return array
     */
    public function findOneByUnicodeAsArray($icon)
    {
        $query = $this
            ->createQueryBuilder('i')
            ->where('i.unicode = :unicode')
            ->setParameter('unicode', $icon)
            ->leftJoin('i.family', 'family')
            ->leftJoin('family.templates', 'templates')
            ->addSelect('family')
            ->addSelect('templates')
            ->getQuery();

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Exception $e) {
            throw new ORMException('Icon repository query failed for "%s" icon.', null, $e, $icon);
        }
    }

    /**
     * @param string $icon
     *
     * @throws ORMException
     *
     * @return array
     */
    public function findOneByUnicodeAndFamilyAsArray($icon, $family)
    {
        $query = $this
            ->createQueryBuilder('i')
            ->where('i.unicode = :unicode')
            ->setParameters([
                'unicode' => $icon,
                'family' => $family,
            ])
            ->leftJoin('i.family', 'family')
            ->leftJoin('family.templates', 'templates')
            ->addSelect('family')
            ->addSelect('templates')
            ->andWhere('family.slug = :family')
            ->getQuery();

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Exception $e) {
            throw new ORMException('Icon repository query failed for "%s" icon.', null, $e, $icon);
        }
    }
}

/* EOF */
