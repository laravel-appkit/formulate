<x-appkit::repeating-group.reorder-item>
    <div class="flex gap-2 items-center">
        @if ($orderable)
        <x-appkit::repeating-group.reorder-handle />
        @endif

        <div class="flex-1">{{ $slot }}</div>

        <x-appkit::repeating-group.remove-button />

        @if ($orderable)
        <x-appkit::repeating-group.reorder-buttons />
        @endif
    </div>
</x-appkit::repeating-group.reorder-item>
