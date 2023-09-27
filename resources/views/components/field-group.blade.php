<div {!! $attributes !!}>
    <x-dynamic-component component="{{ Formulate::getDynamicComponentName('repeating-field') }}" :field="$field">
        <x-dynamic-component component="{{ Formulate::getDynamicComponentName('label') }}" :field="$field" />

        {{ $slot }}

        <x-dynamic-component component="{{ Formulate::getDynamicComponentName('field-errors') }}" :field="$field" />
    </x-dynamic-component>
</div>
