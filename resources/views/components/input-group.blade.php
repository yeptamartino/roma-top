@props([
  'type' => 'text',
  'name' => '',
  'label' => '',
  'autofocus' => false,
  'required' => false,
  'value' => '',
  'error' => null,
  'placeholder' => '',
  'accept' => '*',
  'disabled' => false,
  'model' => null,
  'actionHref' => '#',
  'actionText' => 'Go!',
])

<div class="input-group @error($name) has-error @enderror">  
  <input @if($model) v-model="{{ $model }}" @endif placeholder="{{ $placeholder }}" id="{{ $name }}" @if($type === 'file') accept="image/*" @endif @if(strlen($value) > 0 || old($name)) value="{{ old($name) ?? $value }}" @endif type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" @if($autofocus) autofocus @endif @if($required) required @endif @if($disabled) disabled @endif>
  <span class="input-group-btn">
    <a class="btn btn-primary" href="{{ $actionHref }}">{{ $actionText }}</a>
  </span>
  @error($name)
    <span class="help-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>