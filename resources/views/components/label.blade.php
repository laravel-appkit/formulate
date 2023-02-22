<label for="{{ $field->id }}" {!! $field->labelAttributes !!}>
    {{ $field->label }}

    @if ($field->required)
    <span class="{{ config('formulate.classes.required') }}">*</span>
    @endif
</label>
