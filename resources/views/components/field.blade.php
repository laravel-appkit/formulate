<x-appkit::input :$type :$id :$name :$multiple :$checked :$required value="{{ is_string($value) ? $value : '' }}" {{ $attributes }} />
