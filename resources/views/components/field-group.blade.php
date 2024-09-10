@if ($multiple)
    <x-appkit::fieldset legend="{{ Illuminate\Support\Str::plural($label) }}" class="space-y-2">
        <x-appkit::repeating-group source="form.{{ $name }}" add-another="true" x-data="{draggable: false, draggingIndex: null, droppingIndex: null}">
            <x-appkit::field-group :$label :$name>
                <x-formulate::repeating-field :$name :$orderable source="form.{{ $name }}">
                    {{ $slot }}
                </x-formulate::repeating-field>
            </x-appkit::field-group>
        </x-appkit::repeating-group>
    </x-appkit::fieldset>
@else
    <x-appkit::field-group :$label :$name>
        {{ $slot }}
    </x-appkit::field-group>
@endif
