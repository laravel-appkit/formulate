<div class="{{ config('formulate.classes.field_error') }}" {{ $attributes }}>
    @if (isset($errors))
        {{ $errors->first($field->name) }}
    @endif
</div>
