<label for="{{ $field->id }}" {!! $field->labelAttributes !!}>
    {{ $field->label }}

    @if ($field->required)
    <span>*</span>
    @endif
</label>
