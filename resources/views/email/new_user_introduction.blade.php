@component('mail::message')
    # 新しいユーザーがついかされました
    {{ $toUser->name }}さんこんにちは！

@component('mail::panel')
    新しく{{ $newUser->name }}が参加しました
@endcomponent
@component('mail::button',['url'=>route('tweet.index')])
    つぶやきを見に行く
@endcomponent
@endcomponent
