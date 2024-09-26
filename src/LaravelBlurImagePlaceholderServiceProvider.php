<?php

namespace HypernosTechnology\LaravelBlurImagePlaceholder;

use HypernosTechnology\LaravelBlurImagePlaceholder\Views\Components\Image;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelBlurImagePlaceholderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerBladeDirectives();
        $this->registerViewComponents();

        if ($this->app->runningInConsole()) {
            // Publish assets
            $this->publishes([
                __DIR__ . '/../stubs/assets' => public_path('vendor/blur-image-placeholder'),
            ], 'assets');
        }
    }

    private function registerBladeDirectives()
    {
        Blade::directive('blurPlaceholderStyles', function () {
            return '<link rel="stylesheet" href="' . asset('/vendor/blur-image-placeholder/blur-image-placeholder.css') . '"/>';
        });

        Blade::directive('blurPlaceholderScripts', function () {
            return '<script type="module" src="' . asset('/vendor/blur-image-placeholder/blur-image-placeholder.js') . '"></script>';
        });
    }

    private function registerViewComponents()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blurplaceholder');

        $this->loadViewComponentsAs('blurplaceholder', [
            Image::class,
        ]);
    }
}
