@props([
  'title' => '',
  'rightButtonHref' => '#',
  'rightButtonText' => '',
  'class' => '',
  'style' => ''
])

<div class="card {{ $class }}" style="{{ $style }}">
  @if($title !== '')
  <div class="card-header">    
      <h4>{{ $title }}</h4>    
    @if($rightButtonHref !== '#')
      <div class="card-header-form">
        <a href="{{ $rightButtonHref }}" class="btn btn-primary">{{ $rightButtonText }}</a>
      </div>
    @endif
  </div>
  @endif
  <div class="card-body">    
    {{ $slot }}
  </div>  
</div>