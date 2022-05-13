<form action="{{ $action }}" method="{{ in_array($method, ['GET', 'POST']) ? $method : 'POST' }}" {{ $attributes }}>
    @if($method != 'GET')
    @csrf
    @endif

    @if (!in_array($method, ['GET', 'POST']))
    @method($method)
    @endif

    @if (!empty($errors))
    <div>Whoops! Something went wrong.</div>
    @endif

    {{ $slot }}
</form>
