<x-formulate-button
    type="button"
    class="mb-4"
    label="Add Another {{ $field->label }}"
    @click="form.{{ $field->name }}.push(''); $nextTick(() => { $refs.{{ $repeaterId }}.querySelector('#link_' + (form.{{ $field->name }}.length - 1)).focus(); });"
/>
