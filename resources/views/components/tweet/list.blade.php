{{-- 初期値の設定 --}}
@props([
    'tweets'=>[],
])
<div class=" bg-white shadow-lg rounded-md mt-5 mb-5">
    <ul>
    @foreach ($tweets as $tweet)

            <li class="border-b last:border-b-0 border-gray-200 flex items-start justify-between p-4">
                <div>
                    <span class=" inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">{{ $tweet->user->name }}</span>
                    <p class=" text-gray-600">{!! nl2br(e($tweet->content)) !!} </p>
                    {{-- @dump($tweet->images) --}}
                    <x-tweet.images :images="$tweet->images"></x-tweet.images>
                </div>
                <div>
                    <x-tweet.options :tweetId="$tweet->id" :userId="$tweet->user_id"></x-tweet.options>
                </div>
            </li>
    @endforeach
    </ul>
</div>
