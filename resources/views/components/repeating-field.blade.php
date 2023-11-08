<fieldset x-ref="{{ $repeaterId }}">
    <legend {!! $repeaterLabelAttributes !!}>{{ $label }}</legend>

    <x-formulate-reorderable-list>

        <template x-for="(_, index) in form.{{ $field->name }}" :key='index'>

            <x-formulate-reorderable-item source="form.{{ $field->name }}">

                    <x-formulate-reorderable-handle />

                    <div class="items-center flex-auto">
                        {{ $slot }}
                    </div>

                    <div class="flex items-center">
                        <x-formulate-reorderable-buttons source="form.{{ $field->name }}" />

                        <x-formulate-repeating-field-remove-button :field="$field" />
                    </div>

            </x-formulate-reorderable-item>

        </template>

    </x-formulate-reorderable-list>

    <x-formulate-repeating-field-add-button :field="$field" :repeaterId="$repeaterId" />
</fieldset>
