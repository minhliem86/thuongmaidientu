<?php
namespace admin\controllers;

use services\Contact\RepoInterface as Contact;

class ContactController extends \BaseController{
	protected $contact;

	public function __construct(Contact $contact){
		$this->contact = $contact;
	}

	public function index(){
		$contact = $this->contact->first();
		return \View::make('admin::pages.contact.index')->with(compact('contact'));		
	}

	public function post(){
		$contact = $this->contact->first();
		if(!is_null($contact)){
			$id = $contact->id;
			$data = array(
				'phone'=> \Input::get('phone'),
				'email'=> \Input::get('email'),
				'address'=> \Input::get('address'),
				'fax'=> \Input::get('fax'),
				'map'=> \Input::get('map'),
				'show'=> 1
			);
			$this->contact->update($id,$data);
		}else{
			$data = array(
				'phone'=> \Input::get('phone'),
				'email'=> \Input::get('email'),
				'address'=> \Input::get('address'),
				'fax'=> \Input::get('fax'),
				'map'=> \Input::get('map'),
				'show'=> 1
			);
			$this->contact->create($data);
		}
		\Notification::success('Done !');
		return \Redirect::back();
	}
}