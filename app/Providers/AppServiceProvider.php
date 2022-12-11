<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\UserService;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\QuestionService;
use App\Services\AnswerService;
use App\Services\OrderService;
use App\Services\CartService;
use App\Services\ReviewService;
use App\Services\PaymentService;

use Laravel\Cashier\Cashier;
use App\Models\User;

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

        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService();
        });

        $this->app->bind(CartService::class, function ($app) {
            return new CartService();
        });

        $this->app->bind(ReviewService::class, function ($app) {
            return new ReviewService();
        });

        $this->app->bind(PaymentService::class, function ($app) {
            return new PaymentService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Cashier::useCustomerModel(User::class);
    }
}
