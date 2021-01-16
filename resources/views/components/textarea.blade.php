@props([
  'label' => '',
  'name' => '',
  'value' => '',
  'placeholder' => ''
])

<div class="form-group  @error($name) has-error @enderror">
  <label>{{ $label }}</label>
  <textarea id="{{ $name }}" placeholder="{{  $placeholder }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror">{{ old($name) ?? $value }}</textarea>
  @error($name)
    <div class="help-block">
      <strong>{{ $message }}</strong>
    </div>
  @enderror
</div>