@php
if ($extrafield) {
    $extrafield->plainValue = $extrafield->value;
}
@endphp

@mediaSingle(
    $name,
    $extrafield,
    null,
    trans('extrafield::fields.' . $block->template . '.' . $name),
)
