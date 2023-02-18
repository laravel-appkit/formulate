<div {!! $field->groupAttributes !!}>
    <x-dynamic-component component="{{ Formulate::getDynamicComponentName('label') }}" :field="$field" />

    {{ $slot }}

    <x-dynamic-component component="{{ Formulate::getDynamicComponentName('field-errors') }}" :field="$field" />
</div>
