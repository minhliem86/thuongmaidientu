<?php
class Product extends Eloquent{
	protected $table = "product";

	protected $fillable = array('catalog_id','catalog_name','name','slug','price','content','discount_amount','discount_percent', 'image_path', 'view','status', 'sort', 'inventory','hot','alt_img');

	public function catalog(){
		return $this->belongsTo('Catalog','catalog_id');
	}
}