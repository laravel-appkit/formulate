<x-dynamic-component component="{{ Formulate::getDynamicComponentName('field-group') }}" :field="$field">
    <input type="{{ $type }}" name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ $id }}" value="{{ is_string($value) ? $value: '' }}" {!! (($type == 'checkbox' || $type == 'radio') && $checked) ? 'checked="checked"' : '' !!} {!! ($required) ? 'required="required"' : '' !!} {!! $attributes !!} />
</x-dynamic-component>
