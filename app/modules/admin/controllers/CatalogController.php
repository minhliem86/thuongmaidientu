<?php
namespace admin\controllers;

use services\Catalog\RepoInterface as Catalog;

use validations\CatalogForm;
use validations\CustomException\FormValidationException;

class CatalogController extends \BaseController {

	protected $catalog;
	protected $validation;

	public function __construct(Catalog $catalog, CatalogForm $form){
		$this->catalog = $catalog;
		$this->validation = $form;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$catalog = $this->catalog->select_all();
		$list = $this->catalog->select_list('name','id');
		return \View::make("admin::pages.catalog.index")->with(compact('catalog','list'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::all();
		try{
			$this->validation->validate($input);
		}catch(FormValidationException $e){
			return \Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		$sort = $this->catalog->OrderFirst('id','DESC');
		if(isset($sort)){
			$current = $sort->sort + 1;
		}else{
			$current = 1;
		}

		if(!\Input::has('parent_id')){
			$data = array(
				'name'=>\Input::get('name'),
				'status'=>1,
				'slug'=> \Unicode::make(\Input::get('name')),
				'sort'=>$current,
			);
		}else{
			$data = array(
				'name'=>\Input::get('name'),
				'parent_id' => \Input::get('parent_id'),
				'parent_name' => $this->catalog->find(\Input::get('parent_id'))->slug,
				'slug'=> \Unicode::make(\Input::get('name')),
				'status'=>1,
				'sort'=>$current,
			);
		}
		$this->catalog->create($data);

		\Notification::success('CREATED !');
		return \Redirect::back();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$catalog = $this->catalog->find($id);
		$list = $this->catalog->select_list('name','id');

		return \View::make('admin::pages.catalog.edit')->with(compact('catalog', 'list'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::all();
		try{
			$this->validation->validate($input);
		}
		catch(FormValidationException $e){
			return \Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		if(\Input::get('parent_id') != 0 ){
			$data = array(
				'name'=>\Input::get('name'),
				'slug'=> \Unicode::make(\Input::get('name')),
				'parent_id' => \Input::get('parent_id'),
				'parent_name' => $this->catalog->find(\Input::get('parent_id'))->slug,
				'status'=>\Input::get('status'),
				'sort'=>\Input::get('sort'),
			);
		}else{
			$data = array(
				'name'=>\Input::get('name'),
				'slug'=> \Unicode::make(\Input::get('name')),
				'status'=>\Input::get('status'),
				'sort'=>\Input::get('sort'),
			);
		}
		
		$this->catalog->update($id, $data);
		
		\Notification::success('UPDATED !');
		return \Redirect::route('admin.catalog.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function delete($id){
		$this->catalog->delete($id);

		\Notification::success('DELETED !');
		return \Redirect::back();
	}

	public function status(){
		if(!\Request::Ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$data = array(
				'status' => $val,
			);
			$this->catalog->update($id, $data);
			// return \Respone::json(array('status'=>''))
		}
	}


}
