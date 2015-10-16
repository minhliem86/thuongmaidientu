<?php
class Catalog extends Eloquent{
	protected $table = "catalog";

	protected $fillable = array('name','parent_id','slug','sort','show');

	public function product(){
		return $this->haveMany('Product','catalog_id');
	}
}