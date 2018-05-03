<div class="valu-list">
    <h2 class="content-title">{{ $title }}</h2>
    <div class="loading"><img src="/img/loading.gif" alt="読み込み中..."></div>
    <ul class="slick incentive-card-container loading-content">
        @foreach ($incentives as $incentive)
            <li class="incentive-card">
                @include('component.incentive-card', ['incentive' => $incentive, 'title' => $title])
            </li>
        @endforeach
    </ul>
</div>
