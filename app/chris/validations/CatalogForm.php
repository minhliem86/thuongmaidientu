<?php
namespace validations;

use validations\Baseform\Validator;

class CatalogForm extends Validator{
	public function rules(){
		return array(
			'name'=>'required'
		);
	}
} 