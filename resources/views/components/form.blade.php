<form method="{{ in_array($method, ['GET', 'POST']) ? $method : 'POST' }}" {{ $attributes }}>
    @if($method != 'GET')
    @csrf
    @endif

    @if (!in_array($method, ['GET', 'POST']))
    @method($method)
    @endif

    {{ $slot }}
</form>
