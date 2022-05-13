<div {!! $field->groupAttributes !!}>
    <x-label :field="$field" />

    {{ $slot }}

    <x-field-errors :field="$field" />
</div>
