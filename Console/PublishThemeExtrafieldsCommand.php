<?php

namespace Modules\Extrafield\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputArgument;

class PublishThemeExtrafieldsCommand extends Command
{
    protected $name = 'asgard:publish:theme-extrafields';
    protected $description = 'Publish theme extrafields configuration';

    public function handle()
    {
        $theme = $this->argument('theme', null);
        $themeConfigPath = base_path('Themes' . '/' . $theme . '/config/extrafields.php');
        $moduleConfigPath = base_path('config/asgard/extrafield/config.php');

        if (!File::exists($themeConfigPath)) {
            return $this->error('There is nothing to be published');
        }

        File::put($moduleConfigPath, File::get($themeConfigPath));

        return $this->info('File `' . $moduleConfigPath . '` was created.');

    }

    protected function getArguments()
    {
        return [
            ['theme', InputArgument::OPTIONAL, 'Name of the theme you wish to publish'],
        ];
    }
}
