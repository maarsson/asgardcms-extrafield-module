<?php

namespace Modules\Extrafield\Presenters;

use Illuminate\Support\Facades\App;
use Modules\Extrafield\Entities\Extrafield;

class ExtrafieldCollectionPresenter
{
    public $collection;

    public $block;

    public function __construct()
    {
        $this->collection = collect([]);
    }

    public function push(Extrafield $extrafield)
    {
        $this->collection->push([
            'name' => $extrafield->name,
            'value' => $extrafield->present()->value
        ]);
    }

    public function get(string $name)
    {
        return $this->collection->where('name', $name)->first()['value'];
    }

    public function blockContent()
    {
        return $this->block ? $this->block
            ->translate(App::getLocale())
            ->body : '';
    }
}
