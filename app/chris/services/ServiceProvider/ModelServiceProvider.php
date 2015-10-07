<?php
namespace services\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider{
	public function register(){
		$this->app->bind('services\About\RepoInterface','services\About\EloquentAbout');
		$this->app->bind('services\Contact\RepoInterface','services\Contact\EloquentContact');
		$this->app->bind('services\Customer\RepoInterface','services\Customer\EloquentCustomer');
		$this->app->bind('services\Service\RepoInterface','services\Service\EloquentService');
		$this->app->bind('services\User\RepoInterface','services\User\EloquentUser');
		$this->app->bind('services\Album\RepoInterface','services\Album\EloquentAlbum');
		$this->app->bind('services\Image\RepoInterface','services\Image\EloquentImage');
		$this->app->bind('services\Group\RepoInterface','services\Group\EloquentGroup');
		$this->app->bind('services\Categories\RepoInterface','services\Categories\EloquentCate');
		$this->app->bind('services\Post\RepoInterface','services\Post\EloquentPost');
		$this->app->bind('services\PostAddition\RepoInterface','services\PostAddition\EloquentPostAdd');
		$this->app->bind('services\Role\RepoInterface','services\Role\EloquentRole');
		$this->app->bind('services\Permission\RepoInterface','services\Permission\EloquentPermission');
	}
}