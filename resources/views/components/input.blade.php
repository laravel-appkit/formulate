<x-dynamic-component component="{{ !$field->ignoreFieldGroup ? 'formulate-field-group' : 'formulate-blank' }}" :$field>
    {{-- <input type="{{ $type }}" name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ $id }}" value="{{ is_string($value) ? $value: '' }}" {!! (($type == 'checkbox' || $type == 'radio') && $checked) ? 'checked="checked"' : '' !!} {!! ($required) ? 'required="required"' : '' !!} {!! $attributes !!} /> --}}

    <x-appkit::input type="{{ $type }}" name="{{ $name }}" value="{{ is_string($value) ? $value: '' }}" {{ $attributes }} />
</x-dynamic-component>
