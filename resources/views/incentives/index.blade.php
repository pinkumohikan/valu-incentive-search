@extends('layout')

@section('title', $incentive->name . ' | ')
@section('ogp_image_url', $incentive->image_url)
@section('description', str_limit($incentive->description, 200))

@php
$title = $incentive->name;
@endphp

@section('main-content')
    <div class="incentive-detail">
        <h2 class="content-title">{{ $incentive->name }}</h2>

        <div class="row">
            <div class="col-sm-4 thumbnail">
                <img src="{{ $incentive->image_url }}" alt="{{ $incentive->name }}">
            </div>

            <div class="col-sm-8 description">
                <h3>説明</h3>
                <p class="item">{{ $incentive->description }}</p>

                <h3>行使条件</h3>
                <ul>
                    <li>
                        必要VA数:
                        @if ($incentive->target_va_lower)
                            {{ $incentive->target_va_lower }}VA ~ {{ $incentive->target_va_upper }}VA
                        @else
                            1VA ~
                        @endif
                    </li>
                    <li>
                        提供終了日: {{ $incentive->period_end_at }}
                    </li>
                </ul>
            </div><!-- /.description -->
        </div>

        <div class="owner mx-auto container">
            <div class="row">
                <div class="col-sm-3">
                    <img class="thumbnail" src="/img/user-thumbnail-not-found.jpg" alt="{{ $incentive->valuOwner->name }}">
                </div>
                <div class="col-sm-9">
                    <div class="column metadata">
                        <ul>
                            <li>
                                <strong>{{ $incentive->valuOwner->name }}</strong>
                            </li>
                            <li>
                                職業: {{ $incentive->valuOwner->job }}
                            </li>
                            <li>
                                ウォッチ登録: {{ $incentive->valuOwner->watcher_count }}人
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.row -->

            <div class="introduction">
                自己紹介:<br>
                {{ str_limit($incentive->valuOwner->self_introduction, 300) }}
            </div>

            <div class="to-valu text-center container">
                <div class="row">
                    <div class="item col-sm-4">
                        <a class="btn btn-primary" href="https://valu.is/{{ $incentive->valuOwner->valu_user_id }}/" target="_blank"
                           onclick="ga('send', 'event', '優待詳細ページ', 'VALUホームへクリック', 'https://valu.is/{{ $incentive->valuOwner->valu_user_id }}/', 1, {'nonInteraction': 1});">「ホーム」へ</a>
                    </div>
                    <div class="item col-sm-4">
                        <a class="btn btn-primary" href="https://valu.is/{{ $incentive->valuOwner->valu_user_id }}/data" target="_blank"
                           onclick="ga('send', 'event', '優待詳細ページ', 'VALUデータへクリック', 'https://valu.is/{{ $incentive->valuOwner->valu_user_id }}/', 1, {'nonInteraction': 1});">「データ」へ</a>
                    </div>
                    <div class="item col-sm-4">
                        <a class="btn btn-primary" href="https://valu.is/{{ $incentive->valuOwner->valu_user_id }}/incentives" target="_blank"
                           onclick="ga('send', 'event', '優待詳細ページ', 'VALU優待へクリック', 'https://valu.is/{{ $incentive->valuOwner->valu_user_id }}/', 1, {'nonInteraction': 1});">「優待」へ</a>
                    </div>
                </div>
            </div><!-- /.to-valu -->
        </div>


        <style scoped>
            .incentive-detail .thumbnail img {
                padding: 10px;
                width: 100%;
                overflow: hidden;
            }
            .incentive-detail .title {
                font-weight: bold;
            }
            .incentive-detail .description {
                padding: 10px 50px;
            }
            .incentive-detail .description .item {
                padding: 10px;
            }
            .incentive-detail .owner {
                max-width: 700px;
                background: #fff;
                border-radius: 0.75em;
                padding: 20px;
                color: #000;
            }
            .incentive-detail .owner .thumbnail {
                width: 100%;
            }
            .incentive-detail .owner .metadata {
                vertical-align: middle;
                font-size: 20px;
            }
            .incentive-detail .owner .introduction {
                margin: 10px 0;
                height: 150px;
                overflow: hidden;
            }
            .incentive-detail .owner .to-valu .item {
                padding: 10px 0;
            }
        </style>
    </div>
@endsection
