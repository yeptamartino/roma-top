@props([
  'type' => 'submit',
  'theme' => 'primary',
  'size' => 'lg',
])

<button type="{{ $type }}" class="btn btn-{{ $theme }} btn-{{ $size }} btn-icon icon-right">
  {{ $slot }}
</button>