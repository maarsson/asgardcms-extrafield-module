<?php

namespace Modules\Extrafield\Composers;

use Illuminate\Contracts\View\View;
use Modules\Extrafield\Repositories\ExtrafieldRepository;

class ExtrafieldComposer
{
    public function __construct(ExtrafieldRepository $extrafieldRepository)
    {
        $this->extrafieldRepository = $extrafieldRepository;
    }

    public function compose(View $view)
    {
        $blockExtension = $this->extrafieldRepository
            ->findForBlock(
                request()->route('block')->id
            );

        $view->with('blockExtension', $blockExtension);
    }
}
