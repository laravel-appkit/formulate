<label for="{{ $field->id }}" {!! $attributes->class(['sr-only' => $field->multiple]) !!}>
    {{ $field->label }}

    @if ($field->required && !config('formulate.highlight_optional_fields', false))
    <span class="{{ config('formulate.classes.required') }}">*</span>
    @endif

    @if (!$field->required && config('formulate.highlight_optional_fields', false))
    <span class="{{ config('formulate.classes.optional_label') }}">Optional</span>
    @endif
</label>
