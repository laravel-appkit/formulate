<div {!! $groupAttributes !!}>
    <label for="{{ $id }}" {!! $labelAttributes !!}>{{ $label }}</label>

    <textarea name="{{ $name }}" id="{{ $id }}" {!! $attributes !!}>{{ $value }}</textarea>

    @if (isset($errors) && $errors->has($name))
    <div>{{ $errors->first($name) }}</div>
    @endif
</div>
