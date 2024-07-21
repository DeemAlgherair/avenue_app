<div>
    @props(['messages'])

    @if ($messages)
        <ul {{ $attributes->merge(['class' => 'text-red-600 text-sm mt-2']) }}>
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif
    </div>