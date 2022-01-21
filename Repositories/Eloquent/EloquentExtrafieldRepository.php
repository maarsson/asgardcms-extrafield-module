<?php

namespace Modules\Extrafield\Repositories\Eloquent;

use Modules\Block\Repositories\BlockRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Extrafield\Presenters\ExtrafieldCollectionPresenter;
use Modules\Extrafield\Repositories\ExtrafieldRepository;

class EloquentExtrafieldRepository extends EloquentBaseRepository implements ExtrafieldRepository
{
    public function findForBlock($blockId)
    {
        return $this->model->whereBlockId($blockId)->get();
    }

    public function forTemplate($template)
    {
        $block = app(BlockRepository::class)->getByTemplate($template);

        return $this->model->whereBlockId($block->id ?? null)->get();
    }

    public function get($template, $name)
    {
        $extrafield = $this->forTemplate($template)->where('name', $name)->first();

        return $extrafield ? $extrafield->present()->value : null;
    }

    public function getAll($template)
    {
        $collection = new ExtrafieldCollectionPresenter;

        $collection->block = app(BlockRepository::class)->getByTemplate($template);

        foreach ($this->findForBlock($collection->block->id) as $extrafield) {
            $collection->push($extrafield);
        }

        return $collection;
    }
}
