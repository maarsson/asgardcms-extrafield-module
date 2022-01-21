<?php

namespace Modules\Extrafield\Repositories\Cache;

use Modules\Extrafield\Repositories\ExtrafieldRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheExtrafieldDecorator extends BaseCacheDecorator implements ExtrafieldRepository
{
    public function __construct(ExtrafieldRepository $extrafield)
    {
        parent::__construct();
        $this->entityName = 'extrafield.extrafields';
        $this->repository = $extrafield;
    }

    public function findForBlock($blockId)
    {
        return $this->repository->findForBlock($blockId);
    }
}
