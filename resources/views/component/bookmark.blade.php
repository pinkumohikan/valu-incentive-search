<div class="bookmark text-center mx-auto">
    <div class="loading"><img src="/img/loading.gif" alt="読み込み中..."></div>

    <div class="loading-contnet">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.10&appId=1459357294100483";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like item" data-href="{{ $url }}" data-layout="box_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>

        <div class="item">
            <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=@php echo rawurlencode("\n\n> \"".$title.'\" #VALU優待検索 #VALU優待'); @endphp">Tweet</a>
        </div>

        <div class="item">
            <a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="vertical-normal" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
        </div>
    </div>
</div> <!-- ./bookmark -->
