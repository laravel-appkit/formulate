<div role="group" aria-labelledby="{{ $name }}_group_title">
    <span id="{{ $name }}_group_title" class="block font-medium text-sm text-gray-700 mb-2">{{ $label }}</span>

    @foreach ($options as $value => $title)
    <x-dynamic-component component="{{ Formulate::getDynamicComponentName('input') }}" type="{{ $type }}" name="{{ $name }}{{ $type == 'checkbox' ? '[]' : '' }}" :label="$title" :value="$value" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
    @endforeach

    @if (isset($errors) && $errors->has($name))
    <div class="{{ config('formulate.classes.field_error') }}">{{ $errors->first($name) }}</div>
    @endif
</div>
