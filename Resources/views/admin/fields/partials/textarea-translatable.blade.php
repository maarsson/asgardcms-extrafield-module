{!! Form::i18nTextarea(
    $name,
    trans('extrafield::fields.' . $block->template . '.' . $name),
    $errors,
    $lang,
    $extrafield,
    ['propertyName' => 'translatable_value']
) !!}
