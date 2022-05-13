<div {!! $groupAttributes !!}>
    <label for="{{ $id }}" {!! $labelAttributes !!}>{{ $label }}</label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" {!! $attributes !!} />

    @if (isset($errors) && $errors->has($name))
    <div>{{ $errors->first($name) }}</div>
    @endif
</div>
