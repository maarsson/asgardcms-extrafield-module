{!! Form::normalTextarea(
    $name,
    trans('extrafield::fields.' . $block->template . '.' . $name),
    $errors,
    $extrafield,
    ['propertyName' => 'value']
) !!}
