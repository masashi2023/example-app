@auth
    <div class=" p-4">
        {{-- 投稿フォーム --}}
        <form action="{{ route('tweet.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class=" mt-1">
                <textarea rows="3" class=" focus:ring-blue-400 focus:border-blue-400 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" name="tweet" type="text" id="tweet-content" placeholder="つぶやきを入力"></textarea>
            </div>
            <p class="mt-2 text-sm text-gray-500">140文字まで</p>
            <x-tweet.form.images></x-tweet.form.images>
            {{-- エラーメッセージ --}}
            @error('tweet')
                <x-alert.error>{{ $message }}</x-alert.error>
            @enderror

            {{-- ボタン --}}
            <div class="flex flex-wrap justify-end">
                <x-element.button>投稿</x-element.button>
            </div>
        </form>
    </div>
@endauth
@guest
    <div class="flex flex-wrap justify-center">
        <div class=" w-1/2 p-4 flex-wrap justify-evenly flex">
            {{-- propsは変数を渡すなら属性に:を付ける文字だったら付けない --}}
            <x-element.button-a :href="route('login')">ログイン</x-element.button-a>
            <x-element.button-a :href="route('register')" theme="secondary">会員登録</x-element.button-a>
        </div>
    </div>
@endguest
