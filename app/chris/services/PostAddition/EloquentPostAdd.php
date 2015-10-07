<?php 
namespace services\PostAddition;

use Addition;
use services\AbstractEloquent;

class EloquentPostAdd extends AbstractEloquent implements RepoInterface{
	protected $model;

	public function __construct(Addition $postadd){
		$this->model = $postadd;
	}

	public function delete_where($column,$var){
		$this->model->where($column,$var)->delete();
	}


}