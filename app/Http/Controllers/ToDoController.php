<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}




   <table class="table table-bordered">
        <tr>
            <th>No.</th>
            <th>Item</th>
            <th>Status</th>
            <th style="width:280px">Action</th>
        </tr> 
 
        @foreach($ToDo as $item)
            <tr>
                <td>{{ ++$i }}</td>
                @if ($item->status == 'inactive')
                    <td><del>{{ $item->text }}</del></td>
                    <td>Finished</td>
                @else
                    <td>{{ $item->text }}</td>
                    <td>Active
                @endif               
 
                <td>
                    <form action="{{ route('ToDo.destroy', $item->id) }}" method="POST">
                        <a class="btn btn-info"
                            href="{{ route('ToDo.show', $item->id) }}">
                            Show
                        </a> 
 
                        <a class="btn btn-primary"
                            href="{{ route('ToDo.edit', $item->id) }}">
                            Edit
                        </a> 
 
                        {{-- @csrf
                        @method('DELETE')
                        --}} 
 
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }} 
 
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button> 
 
                    </form>
                </td>
            </tr>
        @endforeach
    </table>