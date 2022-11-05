<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\UserService;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\QuestionService;
use App\Services\AnswerService;
use App\Services\ReviewService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserService::class, function ($app) {
            return new UserService();
        });

        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService();
        });

        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService();
        });

        $this->app->bind(QuestionService::class, function ($app) {
            return new QuestionService();
        });

        $this->app->bind(AnswerService::class, function ($app) {
            return new AnswerService();
        });

        $this->app->bind(ReviewService::class, function ($app) {
            return new ReviewService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
