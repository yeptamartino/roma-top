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
  'inputClass' => '',
])

<div class="form-group @error($name) has-error @enderror">
  <label for="{{ $name }}">{{ $label }}</label>
  <input @if($model) v-model="{{ $model }}" @endif placeholder="{{ $placeholder }}" id="{{ $name }}" @if($type === 'file') accept="image/*" @endif @if(strlen($value) > 0 || old($name)) value="{{ old($name) ?? $value }}" @endif type="{{ $type }}" class="form-control @error($name) is-invalid @enderror {{ $inputClass }}" name="{{ $name }}" @if($autofocus) autofocus @endif @if($required) required @endif @if($disabled) disabled @endif>
  @error($name)
    <span class="help-block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>