<?php
namespace services\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider{
	public function register(){
		$this->app->bind('services\Contact\RepoInterface','services\Contact\Eloquent');
		$this->app->bind('services\Customer\RepoInterface','services\Customer\Eloquent');
		$this->app->bind('services\User\RepoInterface','services\User\Eloquent');
		$this->app->bind('services\Album\RepoInterface','services\Album\Eloquent');
		$this->app->bind('services\Image\RepoInterface','services\Image\Eloquent');
		$this->app->bind('services\Group\RepoInterface','services\Group\Eloquent');
		$this->app->bind('services\Categories\RepoInterface','services\Categories\Eloquent');
		$this->app->bind('services\Post\RepoInterface','services\Post\Eloquent');
		$this->app->bind('services\PostAddition\RepoInterface','services\PostAddition\Eloquent');
		$this->app->bind('services\Role\RepoInterface','services\Role\Eloquent');
		$this->app->bind('services\Permission\RepoInterface','services\Permission\Eloquent');
	}
}