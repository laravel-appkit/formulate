<fieldset x-ref="{{ $repeaterId }}">
    <legend class="{!! $labelAttributes !!}">{{ $label }}</legend>

    <x-dynamic-component component="{{ $field->orderable ? 'formulate-reorderable-list' : 'formulate-blank' }}" source="form.{{ $field->name }}" key="index">

        <template x-for="(_, index) in form.{{ $field->name }}" :key='index'>

            <x-dynamic-component component="{{ $field->orderable ? 'formulate-reorderable-item' : 'formulate-blank' }}" source="form.{{ $field->name }}">

                {{ $slot }}

            </x-dynamic-component>

        </template>

    </x-dynamic-component>

    <x-formulate-repeating-field-add-button :$field :$repeaterId />
</fieldset>
