<form action="{{ $action }}" method="{{ in_array($method, ['GET', 'POST']) ? $method : 'POST' }}" {{ $attributes }}>
    @if($method != 'GET')
    @csrf
    @endif

    @if (!in_array($method, ['GET', 'POST']))
    @method($method)
    @endif

    @if (isset($errors) && $errors->any())
    <div>{{ config('formulate.form_error_message') }}</div>
    @endif

    {{ $slot }}
</form>
