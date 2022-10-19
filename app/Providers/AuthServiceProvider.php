<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Policies\UserPolicy;

use App\Models\Post;
use App\Policies\PostPolicy;

use App\Models\Category;
use App\Policies\CategoryPolicy;

use App\Models\Question;
use App\Policies\QuestionPolicy;

use App\Models\Answer;
use App\Policies\AnswerPolicy;

use App\Models\Order;
use App\Policies\OrderPolicy;

use App\Models\Cart;
use App\Policies\CartPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        Question::class => QuestionPolicy::class,
        Answer::class => AnswerPolicy::class,
        Order::class => OrderPolicy::class,
        Cart::class => CartPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
