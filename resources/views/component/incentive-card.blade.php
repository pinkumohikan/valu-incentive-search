<a class="item text-center" href="/incentives/{{ $incentive->id }}" data-page="{{ $title }}" data-title="{{ $incentive->name }}" data-content="提供:{{ $incentive->valuOwner->name }}/説明:{{ str_limit($incentive->description, 400) }}">
    @if ($incentive->target_va_lower)
        <div class="va-badge">{{ $incentive->target_va_lower }}VA~</div>
    @else
        <div class="va-badge">1VA~</div>
    @endif
    <div class="image-container"><img class="mx-auto" src="{{ $incentive->getImageUrl() }}" alt="{{ $incentive->name }}"></div>
    <div class="description">{{ $incentive->name }}</div>
</a>
