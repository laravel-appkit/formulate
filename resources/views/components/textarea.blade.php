<x-formulate::field-group :$name :$label :$help :$error :$multiple :$orderable :attributes="$groupAttributes">
    <x-formulate::textarea-field :$id :$name {{ $attributes }} />
</x-formulate::field-group>
