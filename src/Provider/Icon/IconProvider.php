<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Provider\Icon;

use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Repository\IconRepository;
use Scribe\Teavee\HtmlGeneratorBundle\Provider\ProviderInterface;
use Scribe\Wonka\Exception\RuntimeException;

/**
 * Class IconProvider.
 */
class IconProvider implements ProviderInterface
{
    /**
     * @var IconRepository
     */
    protected $iconRepo;

    /**
     * @param IconRepository $iconRepo
     */
    public function __construct(IconRepository $iconRepo)
    {
        $this->iconRepo = $iconRepo;
    }

    /**
     * @param mixed[]    $opts
     * @param null|mixed $subject
     *
     * @return mixed[]
     */
    public function find(array $opts = [], $subject = null)
    {
        try {
            return $this->search(
                $this->parseSubject((string) $subject)
            );
        } catch (\Exception $e) {
            throw new RuntimeException('Provider failure for "%s" icon.', null, $e, (string) $subject);
        }
    }

    /**
     * @param string $subject
     *
     * @return string[]
     */
    protected function parseSubject($subject)
    {
        $results[] = $this->newSubjectEntry($subject, null, false);
        $results[] = $this->newSubjectEntry($subject);

        foreach ([':', '_', '-'] as $separator) {
            if (false === ($position = strpos($subject, $separator))) {
                continue;
            }

            $results[] = $this->newSubjectEntry(
                substr($subject, $position + 1),
                substr($subject, 0, $position)
            );

            $results[] = $this->newSubjectEntry(
                substr($subject, $position + 1),
                substr($subject, 0, $position),
                false
            );

            $results[] = $this->newSubjectEntry(
                substr($subject, $position + 1),
                substr($subject, 0, $position),
                true,
                '_'
            );
        }

        return $results;
    }

    /**
     * @param string      $icon
     * @param string|null $family
     * @param bool|true   $canonical
     * @param string      $replacement
     *
     * @return string[]
     */
    protected function newSubjectEntry($icon, $family = null, $canonical = true, $replacement = '-')
    {
        return [
            $canonical ? $this->canonicalizedSubject($icon, $replacement)   : $icon,
            $canonical ? $this->canonicalizedSubject($family, $replacement) : $family,
        ];
    }

    /**
     * @param string $subject
     * @param string $replacement
     *
     * @return string|null
     */
    protected function canonicalizedSubject($subject, $replacement)
    {
        return preg_replace('{[^a-z0-9]}i', $replacement, $subject) ?: null;
    }

    /**
     * @param array $searches
     *
     * @return array
     */
    protected function search(array $searches = [])
    {
        for ($i = 0; $i < count($searches); ++$i) {
            if (false !== ($result = $this->attemptSearches(...$searches[$i]))) {
                return $result;
            }
        }

        throw new RuntimeException('Search for icon "%s" failed.', implode(',', current($searches)));
    }

    /**
     * @param string      $icon
     * @param string|null $family
     *
     * @return array|bool
     */
    protected function attemptSearches($icon, $family = null)
    {
        try {
            return $this->parseResult(
                $this->iconRepo->findOneBySlugAsArray($icon));
        } catch (\Exception $e) {
            // continue to next attempt
        }

        try {
            return $this->parseResult(
                $this->iconRepo->findOneByNameAndFamilyAsArray($icon, $family));
        } catch (\Exception $e) {
            // continue to next attempt
        }

        try {
            return $this->parseResult(
                $this->iconRepo->findOneByUnicodeAsArray($icon));
        } catch (\Exception $e) {
            // continue to next attempt
        }

        try {
            return $this->parseResult(
                $this->iconRepo->findOneByUnicodeAndFamilyAsArray($icon, $family));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param mixed $result
     *
     * @return array[]|bool
     */
    protected function parseResult($result)
    {
        $icon = $result;
        $family = $icon['family'];
        $template = array_shift($family['templates']);

        unset($icon['family']);
        unset($family['templates']);

        return [$icon, $family, $template];
    }
}

/* EOF */
