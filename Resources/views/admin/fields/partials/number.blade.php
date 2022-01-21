{!! Form::normalInputOfType(
    'number',
    $name,
    trans('extrafield::fields.' . $block->template . '.' . $name),
    $errors,
    $extrafield,
    ['propertyName' => 'value']
) !!}
