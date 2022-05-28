@props(['on', 'time' => 3000])

<div x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, {{ $time }});  })"
    x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms
    style="display: none;"
    {{ $attributes->merge(['class' => 'fixed top-0 right-0 w-full max-w-[700px] rounded-[20px]  py-8 px-8 text-center md:py-[14px] md:px-[70px]']) }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
</div>