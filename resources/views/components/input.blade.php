<x-formulate::field-group :$name :$label :$help :$error :$multiple :$orderable :$required :attributes="$groupAttributes">
    <x-formulate::field :$name :$id :$required :$multiple :$orderable {{ $attributes }} />
</x-formulate::field-group>
