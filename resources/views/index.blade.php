@extends('layout')

@section('title', '')
@section('ogp_image_url', url('/').'/img/ogp-image.png')
@section('description', 'あなたにピッタリな『VALUの優待』が見つかります')

@section('main-content')
    @include('component.incentive-cards-slider', ['title' => '人気', 'incentives' => $popularIncentives])

    @include('component.incentive-cards-slider', ['title' => '新着', 'incentives' => $newlyIncentives])

    @include('component.incentive-cards-slider', ['title' => '終了間近', 'incentives' => $endNearlyIncentives])

    @push('optional_bottom')
        <script>
            $(function () {
                $('.incentive-card a').on('click', function () {
                    ga('send', 'event', 'トップページ-' + $(this).data('page'), '優待カードクリック', $(this).data('title'), 1);
                });
            });
        </script>
    @endpush
@endsection
