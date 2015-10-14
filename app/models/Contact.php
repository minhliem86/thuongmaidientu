<?php

class Contact extends Eloquent{
	protected $table = "contact";

	protected $fillable = array('phone', 'address', 'email', 'fax', 'map', 'sort','show');
}