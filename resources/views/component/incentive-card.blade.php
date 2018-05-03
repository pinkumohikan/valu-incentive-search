<a class="item text-center" href="/incentives/{{ $incentive->id }}" data-page="{{ $title }}" data-title="{{ $incentive->name }}" data-content="提供:{{ $incentive->valuOwner->name }}/説明:{{ str_limit($incentive->description, 400) }}">
    <div class="image-container"><img class="mx-auto" src="{{ $incentive->getImageUrl() }}" alt="{{ $incentive->name }}"></div>
    <div class="description">{{ $incentive->name }}</div>
</a>
