<x-formulate-button type="button" label="Remove" class="ml-2"
    @click.prevent="form.{{ $field->name }}.length > 1 && form.{{ $field->name }}.splice(index, 1);"
    ::disabled="form.{{ $field->name }}.length == 1"
/>
