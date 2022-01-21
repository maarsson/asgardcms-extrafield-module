<?php

namespace Modules\Extrafield\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as LaravelEventServiceProvider;
use Modules\Block\Events\BlockWasCreated;
use Modules\Block\Events\BlockWasUpdated;
use Modules\Extrafield\Events\Handlers\CreateExtrafieldData;
use Modules\Extrafield\Events\Handlers\UpdateExtrafieldData;

class EventServiceProvider extends LaravelEventServiceProvider
{
    protected $listen = [
        BlockWasCreated::class => [
            CreateExtrafieldData::class,
        ],
        BlockWasUpdated::class => [
            UpdateExtrafieldData::class,
        ],
    ];
}
