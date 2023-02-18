<x-field-group :field="$field">
    <select name="{{ $name }}" id="{{ $id }}" {!! $attributes !!}>
        @if (!empty($options))
            @foreach ($options as $value => $title)
            <x-dynamic-component component="{{ Formulate::getDynamicComponentName('option') }}" :value="$value">{{ $title }}</x-dynamic-component>
            @endforeach
        @else
        {{ $slot }}
        @endif
    </select>
</x-field-group>
