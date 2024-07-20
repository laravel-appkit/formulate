<x-appkit::input :$type :$name value="{{ is_string($value) ? $value : '' }}" {{ $attributes }} x-model="form.{{ $name }}" @change="form.validate('{{ $name }}')" />
