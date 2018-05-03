<?php

namespace ValuRich\Valu\Parser;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;
use ValuRich\ValuIncentive\ValuIncentive;

class ValuIncentiveParser
{
    public function parse(Crawler $dom, int $valuOwnerId): array
    {
        $incentiveData = $dom->filter('.complimentary_box');
        if (!$incentiveData) {
            return [];
        }

        $incentives = $incentiveData->each(function ($dom) use ($valuOwnerId) {
            $targetVa = $dom->filter('.complimentary_info_inner li')->eq(0)->text();
            $matches = [];
            preg_match('/VALUers\(([0-9]+) ~ ([0-9]+)\)/', $targetVa, $matches);
            $targetVaLower = $matches[1] ?? null;
            $targetVaUpper = $matches[2] ?? null;

            $period = $dom->filter('.complimentary_info_inner li')->eq(1)->text();
            $matches = [];
            preg_match('/期間：([0-9\/]+)~([0-9\/]+)/', $period, $matches);
            $periodStart = Carbon::parse($matches[1]);
            $periodEnd = Carbon::parse($matches[2]);

            $registeredString = $dom->filter('.complimentary_info_inner li')->eq(2)->text();
            $registeredAt = Carbon::parse(str_replace('登録日：', '', $registeredString));

            $imageUrlString = $dom->filter('.complimentary_pic_img')->attr('style');
            $matches = [];
            preg_match('/ url\((.*)\)/', $imageUrlString, $matches);
            $imageUrl = $matches[1];

            return new ValuIncentive([
                'valu_owner_id'     => $valuOwnerId,
                'name'              => $dom->filter('.complimentary_title')->text(),
                'description'       => $dom->filter('.complimentary_info_inner strong')->text(),
                'target_va_lower'   => $targetVaLower,
                'target_va_upper'   => $targetVaUpper,
                'period_start_at'   => $periodStart,
                'period_end_at'     => $periodEnd,
                'registered_at'     => $registeredAt,
                'image_url'         => $imageUrl,
            ]);
        });

        return $incentives;
    }
}