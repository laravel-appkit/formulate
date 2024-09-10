<x-appkit::input :$type :$name :$multiple value="{{ is_string($value) ? $value : '' }}" {{ $attributes }} />
