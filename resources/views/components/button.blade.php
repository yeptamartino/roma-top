@props([
  'type' => 'submit',
  'theme' => 'primary',
  'size' => 'md',
])

<button type="{{ $type }}" class="btn btn-{{ $theme }} btn-{{ $size }} btn-icon icon-right">
  {{ $slot }}
</button>