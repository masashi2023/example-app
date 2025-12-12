@props([
    'breadcrumbs' => [
        [
            'label' => 'TOP',
            'href' => '/',
        ]
    ]
])
{{-- @dd($breadcrumbs) --}}

<nav class="text-black mx-4 my-3" aria-label="Bredcrumb">
    <ol class="list-none p-0 inline-flex">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($loop->last)
                <a href="{{ $breadcrumb['href'] }}">
                    <li>{{ $breadcrumb['label'] }}</li>
                </a>
            @else
                <a href="{{ $breadcrumb['href'] }}">
                    <li class="flex items-center">{{ $breadcrumb['label'] }}</li>
                </a>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
