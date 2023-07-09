<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Menu;
use App\Models\Option;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        // view()->composer(
        //     'layouts.inc.frontend.header',
        //     function ($view) {
        //         $view->with('headers', Slider::where('type', 1)->get());
        //     }
        // );

        view()->composer('*', function ($view) {
            $locale = app()->currentLocale();
            $view
                ->with('headers', Slider::where('type', 1)->get())
                ->with('menu_nav', Menu::with(['menuTranslations' => function ($query) use ($locale) {
                    $query->where('locale', $locale);
                }])->orderBy('position', 'asc')->get())
                ->with('product_nav', Product::with(['productTranslations' => function ($query) use ($locale) {
                    $query->where('locale', $locale);
                }])->orderBy('id', 'asc')->get())
                ->with('option_nav', Option::first())
                ->with('about_nav', About::with(['aboutTranslations' => function ($query) use ($locale) {
                    $query->where('locale', $locale);
                }])->first());
        });
        Paginator::useBootstrapFive();
    }
}
