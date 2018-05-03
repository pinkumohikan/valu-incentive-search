<?php

namespace Peanut\Valu;

use Carbon\Carbon;
use Goutte\Client as GoutteClient;
use Peanut\ValuIncentive\Thumbnail;
use Peanut\ValuIncentive\ValuIncentive;
use Peanut\ValuOwner\ValuOwner;
use Symfony\Component\DomCrawler\Crawler;

class IncentiveLoader
{
    const SCRAPE_TARGET_URL_FORMAT = 'https://valu.is/%s/incentives';

    private $goutteClient;

    public function __construct(GoutteClient $client)
    {
        $this->goutteClient = $client;
    }

    public function load(ValuOwner $owner)
    {
        $url = sprintf(self::SCRAPE_TARGET_URL_FORMAT, $owner->valu_user_id);
        $dom = $this->goutteClient->request('GET', $url);
        $incentives = $this->parse($dom, $owner->id);

        foreach ($incentives as $i) {
            assert($i instanceof ValuIncentive);

            $thumbnail = null;

            try {
                $thumbnail = Thumbnail::create($i)->toPng();
            } catch (\RuntimeException $e) {
                \Log::warning('IncentiveLoader: failed to create thumbnail.', [
                    'exception' => (string) $e,
                ]);
                // サムネイルが無くてもサービス提供は可能なので例外は投げない
            }

            $i->thumbnail = base64_encode($thumbnail);
            $i->store();
        }

        return $incentives;
    }

    private function parse(Crawler $dom, string $valuOwnerId): array
    {
        return $dom->filter(".va-incentive")->each(function (Crawler $d, int $i) use ($valuOwnerId) {
            $name = $d->filter(".va-incentive__title")->text();

            $description = $d->filter(".va-incentive__description")->text();

            $info = explode("\n", $d->filter(".va-incentive__sub-info")->text());
            $condition = $info[1];
            $matches = [];

            preg_match('/期間：([0-9\/]+)~([0-9\/]+)/', $info[3], $matches);
            $periodStart = Carbon::parse($matches[1]);
            $periodEnd = Carbon::parse($matches[2]);

            $registeredAt = Carbon::parse(str_replace('登録日：', '', $info[4]));

            $imageUrl = $this->extractImageUrl($d->filter(".va-incentive__thumb")->attr('style'));

            return new ValuIncentive([
                'valu_owner_id'   => $valuOwnerId,
                'name'            => trim($name),
                'description'     => trim($description),
                'condition'       => trim($condition),
                'registered_at'   => $registeredAt,
                'period_start_at' => $periodStart,
                'period_end_at'   => $periodEnd,
                'image_url'       => $imageUrl,
            ]);
        });
    }

    private function extractImageUrl(string $style): string
    {
        $matches = [];

        if (!preg_match("/'(https?:\/\/.+)'/", $style, $matches)) {
            throw new \LogicException('failed to extract url');
        }

        return $matches[1];
    }
}
