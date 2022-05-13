<div {!! $groupAttributes !!}>
    <label for="{{ $id }}" {!! $labelAttributes !!}>{{ $label }}</label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" {!! $attributes !!} />
</div>
