@php
    $fields = collect(config('asgard.extrafield.config.block_template_fields'))
        ->only($block->template)
        ->first();
@endphp

@if(!empty($fields['translatable']))
    @foreach($fields['translatable'] as $name => $type)
        @php
        $extrafield = $blockExtension->where('name', $name)->first();
        @endphp

        @include('extrafield::admin.fields.partials.' . $type . '-translatable')
    @endforeach
@endif


