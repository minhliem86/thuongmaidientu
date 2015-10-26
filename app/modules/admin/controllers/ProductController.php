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
		$sort = $this->product->OrderFirst('id','DESC');
		count($sort) == 0 ?  $current = 1 :  $current = $sort->sort +1 ;
		if(!\Input::has('file')){
			$path_img = '/public/backend/assets/img/image_thumbnail.gif';
			$arr_img = explode("/", $path_img);
			$last_item = end($arr_img);
			$arr_name_img = explode(".", $last_item);
			$alt_name = current($arr_name_img);
		}else{
			$ha = \Input::get('file');
			$img = str_replace('/tmdt/', '', $ha);
			$arr_img = explode("/", $img);
			$name_img = time().'_'.end($arr_img);

			$arr_name_img = explode(".", $name_img);
			$alt_name = current($arr_name_img);
			$path = 'public/upload/images/product';

			$rz = \Images::make($img)->resize(100,130)->save($path.'/'.$name_img, 95);

			$path_img = $path.'/'.$name_img;

		}

		$data = array(
			'name'=> \Input::get('name'),
			'slug' => \Unicode::make(\Input::get('name')),
			'price' => \Input::get('price'),
			'content'=> \Input::get('content'),
			'catalog_id' =>\Input::get('catalog_id'),
			'catalog_name' =>$this->catalog->find(\Input::get('catalog_id'))->slug,
			'image_path' => $path_img,
			'alt_img' => $alt_name,
			'inventory' => \Input::get('inventory'),
			'status'=> 1,
			'hot'=> \Input::has('hot') ? \Input::get('hot') : 0,
			'sort' => $current,
			'discount_amount'=>\Input::get('amount_value'),
			'discount_percent'=>\Input::get('percent_value')
		);

		$this->product->create($data);
		\Notification::success('CREATED !');
		return \Redirect::route('admin.product.index');
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
		$product = $this->product->find($id);
		$list = $this->catalog->select_list('name', 'id');
		return \View::make('admin::pages.product.edit')->with(compact('list','product'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!\Input::has('file')){
			$path_img = \Input::get('img-bk');

			$arr_img = explode("/", $path_img);
			$last_item = end($arr_img);
			$arr_name_img = explode(".", $last_item);

			$alt_name = current($arr_name_img);
		}else{
			$ha = \Input::get('file');
			$img = str_replace('/tmdt/', '', $ha);
			$arr_img = explode("/", $img);
			$name_img = time().'_'.end($arr_img);
			$path = 'public/upload/images/product';
			$rz = \Images::make($img)->resize(100,130)->save($path.'/'.$name_img, 95);

			$path_img = $path.'/'.$name_img;

			$arr_name_img = explode(".", $name_img);
			$alt_name = current($arr_name_img);

		}

		$data = array(
			'name'=> \Input::get('name'),
			'slug' => \Unicode::make(\Input::get('name')),
			'price' => \Input::get('price'),
			'content'=> \Input::get('content'),
			'catalog_id' =>\Input::get('catalog_id'),
			'catalog_name' =>$this->catalog->find(\Input::get('catalog_id'))->slug,
			'image_path' => $path_img,
			'alt_img' => $alt_name,
			'inventory' => \Input::get('inventory'),
			'status'=> \Input::get('status'),
			'hot'=> \Input::has('hot') ? \Input::get('hot') : 0,
			'sort' => \Input::get('sort'),
			'discount_amount'=>\Input::get('discount_amount'),
			'discount_percent' => \Input::get('discount_percent')
		);

		$this->product->update($id, $data);

		\Notification::success('UPDATED !');
		return \Redirect::route('admin.product.index');
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
