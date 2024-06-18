<x-formulate-field-group :field="$field">
    <x-appkit::select name="{{ $name }}" id="{{ $id }}" {{ $attributes }}>
        @if (!empty($options))
            @foreach ($options as $value => $title)
            <x-dynamic-component component="{{ Formulate::getDynamicComponentName('option') }}" :value="$value">{{ $title }}</x-dynamic-component>
            @endforeach
        @else
        {{ $slot }}
        @endif
    </x-appkit::select>
</x-formulate-field-group>
