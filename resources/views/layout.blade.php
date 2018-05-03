<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')VALU優待検索</title>
    <meta name="keywords" content="VALU,優待,仮想通貨,BTC,ビットコイン">
    <meta name="description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title')VALU優待検索">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:image" content="@yield('ogp_image_url')">
    <meta property="og:site_name" content="VALU優待検索">
    <meta property="og:locale" content="ja_JP">
    <meta property="fb:app_id" content="1459357294100483">
    <meta name="twitter:site" content="@valu_incesearch">
    <meta name="twitter:title" content="@yield('title')VALU優待検索">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="@yield('ogp_image_url')">
    <link rel="canonical" href="{{ url()->full() }}">

    <link rel="stylesheet" href="/css/bootstrap-4.0.0-beta.min.css">
    <link rel="stylesheet" href="/css/slick-1.6.0.css">
    <link rel="stylesheet" href="/css/slick-theme-1.6.0.css">
    <style>
        body {
            font-size: 15px;
            color: #fff;
            background-color: #f7ab00;
            background-size: cover;
            -moz-background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", "Yu Gothic", YuGothic, "ヒラギノ角ゴ ProN W3", Hiragino Kaku Gothic ProN, Arial, "メイリオ", Meiryo, sans-serif;
        }

        a,a:link,a:visited,a:hover,a:active {
            color: #fff;
        }

        #header .title {
            margin-top: 15px;
        }
        #header .developer {
            text-decoration: underline;
        }

        .content-title {
            font-size: 20px;
        }

        .valu-list {
            padding: 10px;
        }
        .valu-list .incentive-card-container {
            list-style: none;
            display: none;
        }
        .incentive-card a {
            position: relative;
            display: block;
            border: solid 3px #fff;
            border-radius: 0.75em;
            height: 200px;
            width: 250px;
            font-size: 12px;
            overflow: hidden;
        }
        .incentive-card a,a:link,a:visited,a:hover,a:active {
            color: #fff;
        }
        .incentive-card a:hover .description {
            max-height: 100px;
            font-size: 15px;
        }
        .incentive-card .image-container {
            height: 100%;
        }
        .incentive-card .image-container img {
            max-width: 100%;
            max-height: 100%;
        }
        .incentive-card .description {
            position: absolute;
            bottom: 0;
            width: 100%;
            max-height: 40px;
            background-color: #007bff;
            opacity: 0.7;
            padding: 5px;
            word-break: break-all;
            -ms-word-break: break-all;
        }
        .incentive-card .va-badge {
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            line-height: 1.75em;
            background-color: #007bff;
            border-radius: 0.75em;
            opacity: 0.8;
        }
        .popover-header {
            color: #000;
        }

        .search-box {
            margin: 20px auto;
            width: 345px;
        }
        .search-box .form-group {
            margin-bottom: 0;
        }
        .search-box input {
            width: 280px;
            border-radius: 0.75em;
        }
        .search-box button {
            border-radius: 0.75em;
        }

        .bookmark {
            width: fit-content;
            margin: 30px;
            padding: 10px;
            border-bottom: solid 5px #fff;
        }
        .bookmark .item {
            display: inline-block;
            width: 90px
        }

        #footer {
            width: 100%;
            background-color: #95a5a6;
            padding: 30px 0;
        }

        .twitter-container {
            width: 100%;
        }

        #about_display {
            color: #000;
        }
        #about_display .modal-content {
            background-color: #ecf0f1;
        }
        #about_display #display_permission_form {
            margin: 20px 0;
        }
        #about_display .notice {
            margin: 20px 0;
        }

        .loading-target {
            display: none;
        }
    </style>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5J4HPFS');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J4HPFS"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header id="header" class="container">
    <div class="row">
        <div class="col-sm-4">
            <a href="/"><h1 class="title">VALU優待検索</h1></a>
            <div class="developer text-right">by <a href="https://valu.is/pinkumohikan" target="_blank">@pinkumohikan</a></div>
        </div>
        <div class="col-sm-8">
            <div class="text-right">登録件数: {{ $registeredIncentiveCount }}件</div>
            <div class="text-right">
                <button class="btn btn-light" data-toggle="modal" data-target="#about_display"
                        onclick="ga('send', 'event', 'ページ共通', 'ボタンクリック', '優待の掲載', 1);">優待の掲載</button>
                <button class="btn btn-light"
                        onclick="ga('send', 'event', 'ページ共通', 'ボタンクリック', 'このサイトについて', 1);
                        $('body').animate({scrollTop:$('#about_us').offset().top});">このサイトについて</button>
            </div>
        </div>
    </div>
</header>

<main class="container">

    <div class="search-box">
        <form class="search-form form-inline" method="get" action="/incentives/search">
            <div class="form-group">
                <input type="search" class="form-control-plaintext" id="keyword" name="keyword" value="" placeholder="キーワード" autofocus required minlength="1" maxlength="50">
            </div>
            <button type="submit" class="btn btn-primary">探す</button>
        </form>
        <ul class="list-inline">
            <li class="list-inline-item">
                人気キーワード:
            </li>
            <li class="list-inline-item">
                @foreach ($suggestedKeywords as $keyword)
                    <a href="/incentives/search?keyword={{ $keyword }}"><u>{{ $keyword }}</u></a>
                @endforeach
            </li>
        </ul>
    </div>

    @yield('main-content')

    @include('component.bookmark', ['title' => $title ?? '', 'url' => url()->full()])

</main><!-- /.container -->

<footer id="footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div id="about_us" class="lead">このサイトについて</div>
                <div>
                    <ul>
                        <li>
                            当サイトは <b><a href="https://valu.is/pinkumohikan" target="_blank" rel="nofollow">@pinkumohikan</a></b> が個人的に運用しているものです。
                        </li>
                        <li>
                            VALU公式 / 公認のサイトではありませんので、お問い合わせ / ご要望は <b><a href="https://twitter.com/pinkumohikan" target="_blank" rel="nofollow">@pinkumohikan</a></b> 宛にTwitterでお願いします。
                        </li>
                    </ul>
                </div>

                <div class="lead">@pinkumohikanについて</div>
                <ul>
                    <li>
                        ただのVALU好きなWebエンジニア (プログラマ) です。VALU社とはなんの関わりもありません。
                    </li>
                    <li>
                        VALU保有者限定で、開発したWebアプリを先行提供したり限定機能を提供するので、そういうのが好きな人はVALU購入をご検討下さいvv
                        <ul>
                            <li>
                                <u><b><a href="https://valu.is/pinkumohikan" target="_blank" rel="nofollow">@pinkumohikanのVALUはコチラ</a></b></u>
                            </li>
                        </ul>
                    </li>
                    <li>
                        最近はTwitterでよくVALUのことをつぶやいています
                    </li>
                </ul>
                <div>
                    <a href="https://twitter.com/pinkumohikan" class="twitter-follow-button" data-show-count="true" data-size="large">@pinkumohikanをフォロー</a><script async src="//platform.twitter.com/widgets.js" charset="utf-7"></script>
                </div>

                <div>
                </div>

                <div class="lead">注意 / 免責事項</div>
                <div>
                    <ul>
                        <li>
                            VALUへ登録されている優待を紹介するだけのWebサイトです。VALUの購入、優待を受けることはすべて自己責任です。
                        </li>
                        <li>
                            VALUの値上がりやVALU発行者による優待の履行、優待の品質を保証するものではありません。
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 text-center">
                <div>
                    <a href="https://twitter.com/valu_incesearch" class="twitter-follow-button" data-show-count="true" data-size="large">@pinkumohikanをフォロー</a><script async src="//platform.twitter.com/widgets.js" charset="utf-7"></script>
                </div>

                <div class="twitter-container">
                    <a class="twitter-timeline" data-height="400" href="https://twitter.com/valu_incesearch">Tweets by pinkumohikan</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Modal -->
<div id="about_display" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">優待を掲載したい</h5>
            </div>
            <div class="modal-body">
                <div>
                    当サイトへ優待情報を掲載させて頂けるVALU主さんは、下記からMyVALU URLのご登録をお願いします。
                </div>
                <div>
                    <form id="display_permission_form" class="form-inline">
                        <div class="form-group">
                            <label for="user_id">https://valu.is/</label>
                            <input type="text" class="form-control-plaintext" name="user_id" value="" placeholder="pinkumohikan" required minlength="2">
                        </div>
                        <button type="submit" class="btn btn-primary">登録する</button>
                    </form>
                    <div class="message"></div>
                </div>

                <ul class="notice">
                    <li>
                       あなたが所有しているVALUのみのご登録をお願いします。他人のVALUを登録しないで下さい。
                    </li>
                    <li>
                        登録を行ってもあなたの個人情報が当サービスへ送信されたり、Twitter / Facebookなどと連携されることはありません。
                    </li>
                    <li>
                        登録完了後、優待情報が当サイトへ掲載されるまで時間が掛かる場合があります。
                    </li>
                    <li>
                        一度MyVALU URLをご登録ければ、優待情報は毎日自動で再取り込みされます。
                    </li>
                </ul>
            </div>

            <div class="modal-header">
                <h5 class="modal-title">優待の掲載をやめたい</h5>
            </div>
            <div class="modal-body">
                <div>
                    Twiterで @pinkumohikan 宛にその旨をご連絡下さい。
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f"></script>
<script src="/js/popper-1.11.0.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"></script>
<script src="/js/bootstrap-4.0.0-beta.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"></script>
<script src="/js/slick-1.6.0.min.js" integrity="sha384-ZULtytbCZdmL8PeKalcAKnseGOqrCiPBi3DiB7s4JJmS8gjSbfw0w8SPKpt9WemG"></script>
<script>
    $(function(){

        $('.valu-list .item').popover({
            trigger: 'hover',
            placement: 'bottom'
        });

        $('.slick').slick({
            dots: true,
            infinite: false,
            slidesToShow: 4,
            responsive: [
                {
                    breakpoint: 1320,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 1092,
                    settings: {
                        slidesToShow: 2,
                        dots: false
                    }
                },
                {
                    breakpoint: 845,
                    settings: {
                        slidesToShow: 1,
                        dots: false
                    }
                }
            ]
        });

        $('#display_permission_form').on('submit', function () {
            ga('send', 'event', 'ページ共通', 'フォーム送信', '掲載許可', 1);
            $message = $('#about_display .message');
            $submitBotton = $(this).find('button');
            $submitBotton.attr('disabled', true);

            $message.addClass('text-primary');
            $message.html('送信中…');

            $.ajax({
                type: 'post',
                url: '/api/display-permissions',
                data: {
                    user_id: $(this).find('input').val()
                }
            }).done(function () {
                $message.addClass('text-success');
                $message.html('優待情報の取込予約を行いました！<br>通常、10秒程度で掲載が始まりますが負荷状況により時間がかかる場合があります。');

            }).fail(function (xhr) {
                $submitBotton.attr('disabled', false);
                if (xhr.status === 404) {
                    $message.addClass('text-info');
                    $message.html('MyVALU URLが間違っているようです。<br>URLを修正して、もう一度登録ボタンを押して下さい。');
                    return;
                }
                $message.addClass('text-info');
                $message.html('想定外の問題により登録が出来ませんでした。管理人へエラー報告を行いましたので、対応まで今しばらくお待ち下さい。');
            }).always(function () {
                $message.removeClass('text-primary');
            });

            return false;
        });
    });

    $(window).on('load', function () {
        $('.loading').css('display', 'none');
        $('.loading-content').css('display', 'block');
    });
</script>
@stack('optional_bottom')
</body>
</html>
