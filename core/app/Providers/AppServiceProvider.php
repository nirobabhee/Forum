<?php

namespace App\Providers;

use App\Models\AdminNotification;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Deposit;
use App\Models\Forum;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\Page;
use App\Models\Post;
use App\Models\SupportTicket;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['request']->server->set('HTTPS', true);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $activeTemplate = activeTemplate();
        $general = GeneralSetting::first();
        $viewShare['general'] = $general;
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['language'] = Language::all();
        $viewShare['pages'] = Page::where('tempname', $activeTemplate)->where('is_default', 0)->get();
        view()->share($viewShare);


        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'banned_users_count'           => User::banned()->count(),
                'email_unverified_users_count' => User::emailUnverified()->count(),
                'sms_unverified_users_count'   => User::smsUnverified()->count(),
                'pending_ticket_count'         => SupportTicket::whereIN('status', [0, 2])->count(),
                'pending_deposits_count'    => Deposit::pending()->count(),
                'pending_withdraw_count'    => Withdrawal::pending()->count(),
            ]);
        });

        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'adminNotifications' => AdminNotification::where('read_status', 0)->with('user')->orderBy('id', 'desc')->get(),
            ]);
        });

        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

        if ($general->force_ssl) {
            \URL::forceScheme('https');
        }

        // ---Start Frontend both Site---//
        view()->composer($activeTemplate . 'partials.left_aside', function ($view) {
            $view->with([
                'forums' => Forum::with('categories.posts')->WhereHas('categories', function ($categories) {
                    $categories->where('status', 1);
                })->whereHas('categories.posts', function ($posts) {
                    $posts->where('status', 1);
                })->orderBy('id', 'DESC')->where('status', 1)->limit(10)->get(),
            ]);
        });
        view()->composer($activeTemplate . 'partials.left_aside', function ($view) {
            $view->with([
                'categories' => Category::with('posts')->whereHas('posts', function ($posts) {
                    $posts->where('status', 1);
                })->orderBy('id', 'DESC')->where('status', 1)->limit(10)->get(),
            ]);
        });

        view()->composer($activeTemplate . 'partials.left_aside', function ($view) {
            $view->with([
                'disscussions' => Comment::selectRaw('post_id, count(*) as total')->with('user', 'post')
                    ->groupBy('post_id')->orderBy('total', 'DESC')->limit(10)->get(),
            ]);
        });

        //right-site-Statistics
        view()->composer($activeTemplate . 'partials.right_aside', function ($view) {
            $view->with([
                'posts' => Post::where('status', 1)->get(),
            ]);
        });
        view()->composer($activeTemplate . 'partials.right_aside', function ($view) {
            $view->with([
                'forums' => Forum::where('status', 1)->get(),
            ]);
        });
        view()->composer($activeTemplate . 'partials.right_aside', function ($view) {
            $view->with([
                'categories' => Category::where('status', 1)->get(),
            ]);
        });
        view()->composer($activeTemplate . 'partials.right_aside', function ($view) {
            $view->with([
                'users' => User::where('status', 1)->get(),
            ]);
        });

        // Top contributors
        view()->composer($activeTemplate . 'partials.right_aside', function ($view) {
            $view->with([
                'topContributors' => Comment::selectRaw('user_id, count(*) as total')->with('user')
                    ->groupBy('user_id')->orderBy('total', 'DESC')->limit(10)->get(),
            ]);
        });

        // un-Answered
        view()->composer($activeTemplate . 'partials.right_aside', function ($view) {
            $view->with([
                'unAnswered' => Post::latest()->with('comments', 'user')->orWhereDoesntHave('comments')->where('status', 1)->limit(10)->get(),
            ]);
        });

        //Hot-topics-Post
        view()->composer($activeTemplate . 'partials.right_aside', function ($view) {
            $view->with([
                'hotPosts' => Post::latest()->with('user')->where('status', 1)->take(5)->get(),
            ]);
        });
        Paginator::useBootstrap();
    }
}
