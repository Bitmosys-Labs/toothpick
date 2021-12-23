<?php 

namespace App\Modules;
class ModuleServiceProvider extends  \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $modules = config("module.modules");
        foreach($modules as $module){
        // while (list(,$module) = each($modules)) {
            if(file_exists(__DIR__.'/'.$module.'/routes/web.php')) {
                include __DIR__.'/'.$module.'/routes/web.php';
            }
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }
        }
    }
    public function register(){}
}