<?php

namespace Peanut\Valu;

use Goutte\Client as GoutteClient;
use Peanut\ValuOwner\ValuOwner;
use Symfony\Component\DomCrawler\Crawler;

class OwnerLoader
{
    const SCRAPE_TARGET_URL_FORMAT = 'https://valu.is/%s';

    private $goutteClient;

    public function __construct(GoutteClient $client)
    {
        $this->goutteClient = $client;
    }

    public function load(string $valuUserId): ValuOwner
    {
        $url = sprintf(self::SCRAPE_TARGET_URL_FORMAT, $valuUserId);
        $dom = $this->goutteClient->request('GET', $url);
        if ($this->goutteClient->getInternalResponse()->getStatus() === 404) {
            throw new NotFoundException('not found valu.');
        }

        $valuOwner = $this->parse($dom, $valuUserId);
        $valuOwner->save();

        return $valuOwner;
    }

    /**
     * @param Crawler $dom
     * @param string $valuUserId
     * @return ValuOwner
     * @throws \LogicException parseに失敗した
     */
    private function parse(Crawler $dom, string $valuUserId): ValuOwner
    {
        try {
            $name = trim($dom->filter(".va-profile__title")->text());
            $watcherCount = trim($dom->filter(".va-profile__tags")->children()->eq(0)->text());
            $job = trim($dom->filter(".va-profile__tags")->children()->eq(1)->text());
            $selfIntroduction = $dom->filter(".summary")->text();
            $iconUrl = $this->extractIconUrl($dom->filter(".va-img-thumb-cropped__inner")->attr('style'));
        } catch (\InvalidArgumentException $e) {
            // 例外をLogicExceptionに統一するためwrapする
            throw new \LogicException('failed to dom parsing.', $e->getCode(), $e);
        }

        return new ValuOwner([
            'valu_user_id'      => $valuUserId,
            'name'              => $name,
            'watcher_count'     => $watcherCount,
            'job'               => $job,
            'self_introduction' => $selfIntroduction,
            'icon_url'          => $iconUrl,
        ]);
    }

    private function extractIconUrl(string $style): string
    {
        $matches = [];

        if (!preg_match("/'(https?:\/\/.+)'/", $style, $matches)) {
            throw new \LogicException('failed to extract icon url');
        }

        return $matches[0];
    }
}
