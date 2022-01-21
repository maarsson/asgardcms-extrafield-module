<?php

namespace Modules\Extrafield\Events\Handlers;

use Modules\Block\Events\BlockWasUpdated;
use Modules\Extrafield\Events\ExtrafieldImageWasUpdated;
use Modules\Extrafield\Repositories\ExtrafieldRepository;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UpdateExtrafieldData
{
    protected $event;

    protected $fields;

    protected $extrafieldRepository;

    public function __construct(ExtrafieldRepository $extrafieldRepository)
    {
        $this->extrafieldRepository = $extrafieldRepository;
    }

    public function handle(BlockWasUpdated $event)
    {
        $this->event = $event;
        $this->fields = collect(config('asgard.extrafield.config.block_template_fields'))
            ->only($this->event->block->template)
            ->first();

        $this->updateNonTranslatableFields();
        $this->updateTranslatableFields();
        $this->updateNonTranslatableImageFields();
    }

    protected function updateNonTranslatableFields()
    {
        if (empty($this->fields['normal'])) {
            return $this;
        }

        foreach ($this->fields['normal'] as $name => $type) {

            if (! isset($this->event->data[$name])) {
                continue;
            }

            $data = [];
            $data['name'] = $name;
            $data['value'] = $this->event->data[$name] ?? '';

            $this->update($data);
        }
    }

    protected function updateTranslatableFields()
    {
        if (empty($this->fields['translatable'])) {
            return $this;
        }

        foreach ($this->fields['translatable'] as $name => $type) {
            foreach (LaravelLocalization::getSupportedLocales() as $locale => $language) {

                if (! isset($this->event->data[$locale][$name])) {
                    continue;
                }

                $data = [];
                $data['name'] = $name;
                $data[$locale]['translatable_name'] = $name;
                $data[$locale]['translatable_value'] = $this->event->data[$locale][$name] ?? '';

                $this->update($data);
            }
        }
    }

    protected function updateNonTranslatableImageFields()
    {
        if (empty($this->event->data['medias_single'])) {
            return $this;
        }

        foreach ($this->event->data['medias_single'] as $name => $value) {
            $normalisedValue = [
                'medias_single' => [
                    $name => $value
                ]
            ];

            $data = [];
            $data['name'] = $name;
            $data['value'] = json_encode($normalisedValue);

            $this->update($data);

            $extrafield = $this->extrafieldRepository
                ->findForBlock($this->event->block->id)
                ->where('name', $data['name']);

            event(new ExtrafieldImageWasUpdated($extrafield->first(), $normalisedValue));
        }
    }

    protected function update($data)
    {
        $extrafield = $this->extrafieldRepository
            ->findForBlock($this->event->block->id)
            ->where('name', $data['name']);

        if ($extrafield->count()) {
            $this->extrafieldRepository->update($extrafield->first(), $data);
        } else {
            $data['block_id'] = $this->event->block->id;
            $this->extrafieldRepository->create($data);
        }
    }
}
