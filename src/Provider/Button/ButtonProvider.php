<?php

/*
 * This file is part of the scr-be/teavee-html-generator-bundle
 *
 * (c) Rob Frawley 2nd <rmf@build.fail>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\HtmlGeneratorBundle\Provider\Button;

use Scribe\Teavee\HtmlGeneratorBundle\Doctrine\Repository\ButtonRepository;
use Scribe\Teavee\HtmlGeneratorBundle\Provider\ProviderInterface;
use Scribe\Wonka\Exception\RuntimeException;

/**
 * Class ButtonProvider.
 */
class ButtonProvider implements ProviderInterface
{
    /**
     * @var ButtonRepository
     */
    protected $buttonRepo;

    /**
     * @param ButtonRepository $buttonRepo
     */
    public function __construct(ButtonRepository $buttonRepo)
    {
        $this->buttonRepo = $buttonRepo;
    }

    /**
     * @param mixed[]    $opts
     * @param null|mixed $subject
     *
     * @return mixed[]
     */
    public function find(array $opts = [], $subject = null)
    {
        $type = $this->parseOpts($opts);

        try {
            return $this->search($type);
        } catch (\Exception $e) {
            throw new RuntimeException('Provider failure for "%s:%s" button.', null, $e, $type, (string) $subject);
        }
    }

    /**
     * @param mixed[] $opts
     *
     * @return string
     */
    protected function parseOpts(array $opts)
    {
        return $this->canonicalizeOpt(
            array_key_exists('type', $opts) ? strtolower($opts['type']) : 'general'
        );
    }

    /**
     * @param string $type
     *
     * @return string
     */
    protected function canonicalizeOpt($type)
    {
        return strtoupper(preg_replace('{[^a-z0-9]}i', '', $type));
    }

    /**
     * @param string $search
     *
     * @return array
     */
    protected function search($search)
    {
        if (false !== ($result = $this->attemptSearches($search))) {
            return $result;
        }

        throw new RuntimeException('Search for button "%s" failed.', $search);
    }

    /**
     * @param string $button
     *
     * @return array|bool
     */
    protected function attemptSearches($button)
    {
        try {
            return $this->parseResult(
                $this->buttonRepo->findOneBySlugAsArray($button)
            );
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
        return [$result['template']];
    }
}

/* EOF */
