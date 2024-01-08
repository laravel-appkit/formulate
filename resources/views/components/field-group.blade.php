<x-dynamic-component component="{{ Formulate::getDynamicComponentName('repeating-field') }}" :$field>
    <div {!! $attributes !!}>
            <x-formulate-label :$field />

            <div class="flex w-full items-center">
                @if ($field->multiple && $field->orderable)
                <x-formulate-reorderable-handle class="flex-none" />
                @endif

                <div class="flex-auto">{{ $slot }}</div>

                @if ($field->multiple)
                <div class="flex-none flex">
                    @if ($field->orderable)
                    <x-formulate-reorderable-buttons source="form.{{ $field->name }}" />
                    @endif

                    <x-formulate-repeating-field-remove-button :$field />
                </div>
                @endif
            </div>

            <x-formulate-field-errors :$field />
    </div>
</x-dynamic-component>
