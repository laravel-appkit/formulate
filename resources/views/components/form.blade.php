<x-appkit::form action="{{ $action }}" method="{{ in_array($method, ['GET', 'POST']) ? $method : 'POST' }}" {{ $attributes }}>
    {{ $slot }}

    @if($method != 'GET')
    @csrf
    @endif

    @if (!in_array($method, ['GET', 'POST']))
    @method($method)
    @endif
</x-appkit::form>
