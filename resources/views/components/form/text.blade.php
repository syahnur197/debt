<div class="form-group my-1">
  {{ Form::label($label, null, ['class' => 'control-label']) }} 
  {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
</div>