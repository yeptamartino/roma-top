@props([
  'name' => '',
  'label' => '',
  'autofocus' => false,
  'required' => false,
  'value' => '',
  'error' => null,
  'placeholder' => ''
])

<div class="form-group">
  <label for="{{ $name }}">{{ $label }}</label>
  <input accept="image/*" placeholder="{{ $placeholder }}" id="{{ $name }}" @if(strlen($value) > 0 || old($name)) value="{{ old($name) ?? $value }}" @endif type="file" multiple class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" @if($autofocus) autofocus @endif @if($required) required @endif>
  @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>