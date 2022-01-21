{!! Form::normalInput(
    $name,
    trans('extrafield::fields.' . $block->template . '.' . $name),
    $errors,
    $extrafield,
    ['propertyName' => 'value']
) !!}
