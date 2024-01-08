<x-dynamic-component component="{{ !$field->ignoreFieldGroup ? 'formulate-field-group' : 'formulate-blank' }}" :$field>
    <input type="{{ $type }}" name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ $id }}" value="{{ is_string($value) ? $value: '' }}" {!! (($type == 'checkbox' || $type == 'radio') && $checked) ? 'checked="checked"' : '' !!} {!! ($required) ? 'required="required"' : '' !!} {!! $attributes !!} />
</x-dynamic-component>
