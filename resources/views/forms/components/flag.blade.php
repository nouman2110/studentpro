<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <select x-model="state" class="form-select">
            <option value="" disabled>Select a Flag</option>
            @foreach ($flags as $id => $url)
                <option value="{{ $id }}">
                    <img src="{{ $url }}" alt="{{ strtoupper($id) }}" style="width: 20px; height: 20px;">
                    {{ strtoupper($id) }}
                </option>
            @endforeach
        </select>
    </div>
</x-dynamic-component>
