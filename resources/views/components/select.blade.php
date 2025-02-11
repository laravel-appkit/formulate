<x-formulate::field-group :$name :$label :$help :$error :attributes="$groupAttributes">
    <x-formulate::select-field :$id :$name {{ $attributes }}>
        {{ $slot }}
    </x-formulate::select-field>
</x-formulate::field-group>
