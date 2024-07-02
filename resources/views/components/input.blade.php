<x-dynamic-component component="{{ !$field->ignoreFieldGroup ? 'formulate-field-group' : 'formulate-blank' }}" :$field>
    <x-appkit::input :$type :$name value="{{ is_string($value) ? $value : '' }}" {{ $attributes }} />
</x-dynamic-component>
