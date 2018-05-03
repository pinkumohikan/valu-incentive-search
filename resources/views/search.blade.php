@extends('layout')

@section('title', $keyword . 'の検索結果 | ')
@section('ogp_image_url', url('/').'/img/ogp-image.png')
@section('description', 'キーワード'.$keyword.'では'.count($foundIncentives).'件の優待が見つかりました')

@section('main-content')
    <span id="search-keyword" data-keyword="{{ $keyword }}"></span>
    <h2 class="content-title">{{ $keyword }}の検索結果: {{ count($foundIncentives) }}件</h2>

    <div class="valu-list .non-slider">
        <div class="loading"><img src="/img/loading.gif" alt="読み込み中..."></div>
        @if (count($foundIncentives) === 0)
            <div class="sorry mx-auto text-center">
                <div>
                    <img src="/img/dogeza_businessman.png" alt="検索結果無し">
                </div>
                ごめんなさい、指定されたキーワードでは優待情報が有りませんでした 😭<br>
                キーワードを変えて、再度検索をお願いします 🙏
            </div>
        @endif

        <div class="incentive-card-container list-inline loading-content">
            @foreach ($foundIncentives as $incentive)
                <div class="incentive-card list-inline-item mx-auto">
                    @include('component.incentive-card', ['incentive' => $incentive, 'title' => '検索結果ページ'])
                </div>
            @endforeach
        </div>
    </div>

    <style scoped>
        .non-slider {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            flex-flow: row wrap;
        }
        .valu-list .sorry {
            font-size: 15px;
        }
        .valu-list .sorry img {
            height: 150px;
        }
        .incentive-card-container {
            padding: 0 20px;
        }
        .incentive-card {
            padding: 4px;
        }
    </style>

    @push('optional_bottom')
        <script>
            $(function () {
                ga('send', 'event', '検索結果ページ', '検索結果表示', $('#search-keyword').data('keyword'), 1);
            });
            $(function () {
                $('.incentive-card a').on('click', function () {
                    ga('send', 'event', '検索結果ページ', '優待カードクリック', $(this).data('title'), 1);
                });
            });
        </script>
    @endpush
@endsection
