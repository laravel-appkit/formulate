<x-field-group :field="$field">
    <select name="{{ $name }}" id="{{ $id }}" {!! $attributes !!}>
        @if (!empty($options))
            @foreach ($options as $value => $title)
            <x-option value="{{ $value }}">{{ $title }}</x-option>
            @endforeach
        @else
        {{ $slot }}
        @endif
    </select>
</x-field-group>
