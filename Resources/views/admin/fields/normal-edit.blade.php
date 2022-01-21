@php
    $fields = collect(config('asgard.extrafield.config.block_template_fields'))
        ->only($block->template)
        ->first();
@endphp

@if(!empty($fields['normal']))
    @foreach($fields['normal'] as $name => $type)
        @php
        $extrafield = $blockExtension->where('name', $name)->first();
        @endphp

        @include('extrafield::admin.fields.partials.' . $type)
    @endforeach
@endif
