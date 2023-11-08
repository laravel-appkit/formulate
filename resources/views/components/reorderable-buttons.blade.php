<x-formulate-button type="button" label="Move Up" class="ml-2"
    @click.prevent="{{ $source }}.splice(index - 1, 0, {{ $source }}.splice(index, 1)[0]);"
    ::disabled="index == 0"
/>

<x-formulate-button type="button" label="Move Down" class="ml-2"
    @click.prevent="{{ $source }}.splice(index + 1, 0, {{ $source }}.splice(index, 1)[0]);"
    ::disabled="index == {{ $source }}.length - 1"
/>
