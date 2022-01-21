<?php

namespace Modules\Extrafield\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Media\Support\Traits\MediaRelation;

class Extrafield extends Model
{
    use MediaRelation, Translatable, PresentableTrait;

    protected $presenter = 'Modules\Extrafield\Presenters\ExtrafieldPresenter';

    protected $table = 'extrafield__extrafields';
    public $translatedAttributes = ['translatable_name'];
    protected $fillable = ['block_id', 'name', 'value', 'translatable_name'];

    public function isMedia(): bool
    {
        $value = json_decode($this->value, true);
        return is_array($value) && isset($value['medias_single']);
    }
}
