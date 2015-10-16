<?php
namespace admin\controllers;

use services\Catalog\RepoInterface as Catalog;
use services\Product\RepoInterface as Product;

class ProductController extends \BaseController {
	protected $catalog;
	protected $product;

	public function __construct(Catalog $catalog, Product $product){
		$this->catalog = $catalog;
		$this->product = $product;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$product = $this->product->select_all(array('catalog'));
		return \View::make('admin::pages.product.index')->with(compact('product'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$list = $this->catalog->select_list('name', 'id');
		return \View::make('admin::pages.product.create')->with(compact('list'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

	public function removeall(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$data = \Input::get('arr');
			if(!$data){
				return \Response::json(array('msg'=>'error'));
			}else{
				$this->product->delete($data);
				return \Response::json(array('msg'=>'success'));
			}
		}
	}

	public function removeitem($id){
		$this->product->delete($id);
		\Notification::success('Deleted !');
		return \Redirect::back();
	}

	public function status(){
		if(!\Request::ajax()){
			return \View::make('404');
		}else{
			$id = \Input::get('id');
			$val = \Input::get('value');
			$data = array('status'=>$val);
			$this->product->update($id,$data);

		}
	}

}
