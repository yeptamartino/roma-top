@props([
'value' => '',
'label' => '',
'name' => ''
])

<div class="form-group">
    <label>{{$label}}}</label>
<div class="box-body pad">
    <textarea name="{{ $name }}" class="textarea" placeholder="Place some text here"
              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$value}}</textarea>
</div>