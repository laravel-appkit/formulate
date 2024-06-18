<fieldset class="mb-4">
    <legend class="{!! $labelAttributes !!}">{{ $label }}</legend>

    @foreach ($options as $value => $title)
    @php
        app(\AppKit\Formulate\Id::class)->startBlock($name);
    @endphp

    <div class="{{ $loop->last ? '' : 'mb-2 ' }}flex items-center">
        <x-formulate-input type="{{ $type }}" name="{{ $name }}{{ $type == 'checkbox' ? '[]' : '' }}" :label="$title" :value="$value" ignoreFieldGroup />
        <label for="" class="ml-2">{{ $title }}</label>
    </div>

    @endforeach
    @php
        app(\AppKit\Formulate\Id::class)->endBlock();
    @endphp

    @if (isset($errors) && $errors->has($name))
    <div class="{{ config('formulate.classes.field_error') }}">{{ $errors->first($name) }}</div>
    @endif
</fieldset>
