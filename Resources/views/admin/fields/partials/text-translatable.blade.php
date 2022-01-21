{!! Form::i18nInput(
    $name,
    trans('extrafield::fields.' . $block->template . '.' . $name),
    $errors,
    $lang,
    $extrafield,
    ['propertyName' => 'translatable_value']
) !!}
