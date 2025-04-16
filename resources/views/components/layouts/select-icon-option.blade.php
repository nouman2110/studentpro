@props(['value', 'label'])

<div class="flex items-center space-x-2">
    <img src="{{ asset('images/' . $value . '.svg') }}"  width="24" height="24">
    {{-- <span>{{ $label }}</span> --}}
</div>
