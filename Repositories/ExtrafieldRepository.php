<?php

namespace Modules\Extrafield\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ExtrafieldRepository extends BaseRepository
{
    public function findForBlock($blockId);
}
