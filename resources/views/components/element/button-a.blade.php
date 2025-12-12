{{-- propsの初期値 --}}
@props([
    'href'=>'',
    'theme'=>'primary'
])

@php
// ボタンの色を分けるためにclassに追加する内容を切り分ける
if(!function_exists('getThemeClassForButtonA')){
    function getThemeClassForButtonA($theme){
        return match($theme){
            'primary'=>'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500',
            'secondary'=>'bg-red-500 text-white hover:bg-red-600 focus:ring-red-500',
            'default'=>''
        };
    }
}
@endphp
<a href="{{ $href }}" class=" inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 {{ getThemeClassForButtonA($theme) }}">
    {{ $slot }}
</a>
