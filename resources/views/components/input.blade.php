<x-field-group :field="$field">
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" {!! (($type == 'checkbox' || $type == 'radio') && $checked) ? 'checked="checked"' : '' !!} {!! $attributes !!} />
</x-field-group>
