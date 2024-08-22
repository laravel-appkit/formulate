<x-appkit::select :$name :$id {{ $attributes }}>
    @if (!empty($options))
        @foreach ($options as $value => $title)
        <x-formulate::option :$value>{{ $title }}</x-formulate::option>
        @endforeach
    @else
    {{ $slot }}
    @endif
</x-appkit::select>
