<x-dynamic-component component="{{ Formulate::getDynamicComponentName('field-group') }}" :field="$field">
    <textarea name="{{ $name }}" id="{{ $id }}" {!! $attributes !!}>{{ $value }}</textarea>
</x-dynamic-component>
