{!! Form::i18nInputOfType(
    'number',
    $name,
    trans('extrafield::fields.' . $block->template . '.' . $name),
    $errors,
    $lang,
    $extrafield,
    ['propertyName' => 'translatable_value']
) !!}
