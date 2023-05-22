<div class="{{ config('formulate.classes.field_error') }}">
    @if (isset($errors))
        {{ $errors->first($field->name) }}
    @endif
</div>
