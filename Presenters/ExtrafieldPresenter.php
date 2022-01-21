<?php

namespace Modules\Extrafield\Presenters;

use Illuminate\Support\Facades\App;
use Laracasts\Presenter\Presenter;
use Modules\Block\Repositories\BlockRepository;

class ExtrafieldPresenter extends Presenter
{
    public function __construct($entity)
    {
        parent::__construct($entity);
    }

    public function value()
    {
        $extrafield = $this->entity
            ->present()
            ->entity;

        if (! $extrafield) {
            return '';
        }

        if($extrafield->isMedia()) {
            if ($media = $extrafield->files()->first()) {
                return $media->path;
            }

            return null;
        }

        if ($extrafield->hasTranslation()) {
            return $extrafield->translate(App::getLocale())->translatable_value;
        }

        return $extrafield->value;
    }
}
