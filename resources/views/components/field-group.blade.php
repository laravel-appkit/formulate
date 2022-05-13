<div {!! $field->groupAttributes !!}>
    <label for="{{ $field->id }}" {!! $field->labelAttributes !!}>{{ $field->label }}</label>

    {{ $slot }}

    @if (isset($errors) && $errors->has($field->name))
    <div>{{ $errors->first($field->name) }}</div>
    @endif
</div>
