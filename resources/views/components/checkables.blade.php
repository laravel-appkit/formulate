{{-- {{ $type == 'checkbox' ? '[]' : '' }} --}}

<fieldset>
    <legend class="font-medium text-gray-900 leading-6 dark:text-white">{{ $label }}</legend>

    <div class="space-y-2">
        @foreach ($options as $value => $label)
        @php
            app(\AppKit\Formulate\Id::class)->startBlock($label);
            $id = app(\AppKit\Formulate\Id::class)->get($label);
        @endphp
        <div class="flex items-center">
            <x-formulate-input :$type :$name :$id :$label :$value ignoreFieldGroup />
            <x-appkit::label :for="$id" :$label class="ml-2" />
        </div>
        @endforeach
        @php
            app(\AppKit\Formulate\Id::class)->endBlock();
        @endphp
    </div>

    @if (isset($errors) && $errors->has($name))
    <div class="{{ config('formulate.classes.field_error') }}">{{ $errors->first($name) }}</div>
    @endif
</fieldset>
