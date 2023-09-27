<fieldset>
    <legend {!! $labelAttributes !!}>{{ $label }}</legend>

    <template x-for="(_, index) in form.{{ $field->name }}" :key='index'>
        <div>
            {{ $slot }}
        </div>
    </template>

    <button type="button" @click="form.{{ $field->name }}.push(''); console.log((form.link.length - 1)); console.log('#link_' + (form.{{ $field->name }}.length - 1)); console.log($refs.repeater); $nextTick(() => { $refs.repeater.querySelector('#link_' + (form.{{ $field->name }}.length - 1)).focus(); });" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Add Another {{ $field->label }}</button>
</fieldset>
