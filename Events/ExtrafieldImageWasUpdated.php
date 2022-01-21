<?php

namespace Modules\Extrafield\Events;

use Modules\Media\Contracts\StoringMedia;

use Modules\Extrafield\Entities\Extrafield;

class ExtrafieldImageWasUpdated implements StoringMedia
{
    /**
     * @var Extrfield
     */
    public $extrafield;

    /**
     * @var array
     */
    public $data;

    public function __construct(Extrafield $extrafield, $data)
    {
        $this->extrafield = $extrafield;
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function getEntity()
    {
        return $this->extrafield;
    }

    /**
     * @inheritDoc
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
