<?php
class Image extends Eloquent{
	public $table = "images";

	protected $fillable = array('alt_text', 'slug', 'album_id','album_name', 'sort', 'show');

	public function album(){
		return $this->belongsTo('album');
	}
}