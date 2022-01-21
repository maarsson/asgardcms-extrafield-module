<?php

namespace Modules\Extrafield\Events\Handlers;

use Modules\Extrafield\Repositories\ExtrafieldRepository;
use Modules\Block\Events\BlockWasCreated;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateExtrafieldData
{
    protected $event;
    protected $fields;
    protected $extrafieldRepository;

    public function __construct(ExtrafieldRepository $extrafieldRepository)
    {
        $this->extrafieldRepository = $extrafieldRepository;
    }

    public function handle(BlockWasCreated $event)
    {
        $this->event = $event;
        $this->fields = collect(config('asgard.extrafield.config.block_template_fields'))
            ->only($this->event->block->template)
            ->first();

        $this->createNonTranslatableFields();
        $this->createTranslatableFields();
    }

    protected function createNonTranslatableFields()
    {
        if (empty($this->fields['normal'])) {
            return $this;
        }

        foreach ($this->fields['normal'] as $field) {
            $data = [];
            $data['name'] = $field;
            $data['value'] = '';

            $this->create($data);
        }
    }

    protected function createTranslatableFields()
    {
        if (empty($this->fields['translatable'])) {
            return $this;
        }

        foreach ($this->fields['translatable'] as $field) {
            foreach (LaravelLocalization::getSupportedLocales() as $locale => $language) {
                $data = [];
                $data['name'] = $field;
                $data[$locale]['translatable_name'] = $field;
                $data[$locale]['translatable_value'] = '';

                $this->create($data);
            }
        }
    }

    protected function create($data)
    {
        $extrafield = $this->extrafieldRepository
            ->findForBlock($this->event->block->id)
            ->where('name', $data['name']);

        if ($extrafield->count()) {
            return false;
        }

        $data['block_id'] = $this->event->block->id;
        $this->extrafieldRepository->create($data);
    }
}
