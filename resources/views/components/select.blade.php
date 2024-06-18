<x-formulate-field-group :$field>
    <x-appkit::select name="{{ $name }}" id="{{ $id }}" {{ $attributes }}>
        @if (!empty($options))
            @foreach ($options as $value => $title)
            <x-formulate-option :$value>{{ $title }}</x-formulate-option>
            @endforeach
        @else
        {{ $slot }}
        @endif
    </x-appkit::select>
</x-formulate-field-group>
