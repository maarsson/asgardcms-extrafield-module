<?php

namespace Modules\Extrafield\Entities;

use Illuminate\Database\Eloquent\Model;

class ExtrafieldTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['translatable_name', 'translatable_value'];
    protected $table = 'extrafield__extrafield_translations';
}
