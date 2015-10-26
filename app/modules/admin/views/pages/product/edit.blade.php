@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<h4 class="page-head-line">Edit Product</h4>
		</div>
		<div class="row">
			{{Form::model($product ,array('route'=>array('admin.product.update',$product->id), 'method'=>'PUT' )) }}
				<div class="col-sm-8">
					<div class="form-group">
						<label for="title">Title</label>
						{{Form::text('name',Input::old('name'), array('class' => 'form-control') )}}
					</div>
					<div class="form-group">
						<label for="content">Content</label>
						{{Form::textarea('content',Input::old('content'), array('class' => 'form-control ckeditor') )}}
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-xs-8">
								<label for="title">Price</label>
								{{Form::text('price', Input::old('price'),array('class'=> 'form-control', 'id'=>'price'))}}
							</div>
							<div class="col-xs-4 ">
								<label for="title">Result</label>
								{{Form::text('preview-price','' ,array('class'=> 'form-control', 'id'=>'preview-price', 'disabled'))}}
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<div class="inline">
									<label for=""><input type="radio" name="check" value="amount" /> Discount Amout  </label>
									{{Form::text('discount_amount',\Input::old('discount_amount'), array('class'=>'form-control', 'disabled'))}}
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for=""><input type="radio" name="check" value="percent" /> Discount Percent  </label>
									{{Form::text('discount_percent',\Input::old('discount_percent'), array('class'=>'form-control','disabled'))}}
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="inventory">Inventory</label>
						{{Form::text('inventory',\Input::get('inventory'), array('class'=>'form-control'))}}
					</div>
					<div class="form-group">
						<label for="hot">Hot item</label>
						{{Form::checkbox('hot','1',Input::old('hot') )}}
					</div>
					<div class="form-group">
						<label for="title">Position</label>
						{{Form::text('sort',Input::old('sort'), array('class' => 'form-control') )}}
					</div>
					<div class="form-group">
						<label for="title">Status</label>
						{{Form::select('show',array('0' => 'hide', '1'=>'show'), Input::old('show'), array('class'=>'form-control') )}}
					</div>

				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<label for="title">Categrory</label>
						{{Form::select('catalog_id',$list,0,array('class'=> 'form-control') )}}

					</div>
					<div class="form-group">
						<label for="img">Featured Image</label>
						<button type="button" id="open_img" class="btn btn-primary" onclick="openKCFinder()">Choose images</button>
						<div id="preview_img"></div>
						<img src="{{asset($product->image_path)}}" id="pre" />
						{{Form::hidden('img-bk',$product->image_path, array('class'=>'form-control'))}}
					</div>
					<div class="form-group form-submit">
						{{Form::submit('Save Changes', array('class' => 'btn btn-primary pull-right'))}}

					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop

@section('script')
	{{HTML::script('public/backend/assets/js/radio/bootstrap-switch.min.js')}}
	{{HTML::style('public/backend/assets/js/radio/bootstrap-switch.css')}}
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("input[name='check']").change(function(){
				var thiss = $(this);
				var value =  thiss.val();
				if(value == 'amount'){
					$('input[name="discount_amount"]').prop('disabled',false);
					$('input[name="discount_percent"]').prop('disabled',true);
					$('input[name="discount_percent"]').val('0');
				}
				if(value == 'percent'){
					$('input[name="discount_amount"]').prop('disabled',true);
					$('input[name="discount_percent"]').prop('disabled',false);
					$('input[name="discount_amount"]').val('0');
				}
			});
			var price = ({{$product->price}} + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
			$('#preview-price').val(price + ' VND');

			$("#price").blur(function(){
				var va = $(this).val();
				va = (va + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
				$('#preview-price').val(va+' VND');
			})

		})

		function remove_btn(val){
			val.parentNode.parentNode.remove();

		}

		function openKCFinder() {
		    window.KCFinder = {
		        callBack: function(url) {
		            window.KCFinder = null;
		            var div = document.getElementById("preview_img");
		            var pre =  document.getElementById("pre");
		            div.innerHTML = '<div style="margin:5px">Loading...</div>';
		            var img = new Image();
		            img.src = url;
		            img.onload = function() {
		                div.innerHTML = '<img id="img" width="320" src="' + url + '" />' + '<input type="hidden" name="file" value="' + url+ '" />';
		                pre.remove();
		                var img = document.getElementById('img');
		                var o_w = img.offsetWidth;
		                var o_h = img.offsetHeight;
		                var f_w = div.offsetWidth;
		                var f_h = div.offsetHeight;
		                if ((o_w > f_w) || (o_h > f_h)) {
		                    if ((f_w / f_h) > (o_w / o_h))
		                        f_w = parseInt((o_w * f_h) / o_h);
		                    else if ((f_w / f_h) < (o_w / o_h))
		                        f_h = parseInt((o_h * f_w) / o_w);
		                    img.style.width = f_w + "px";
		                    img.style.height = f_h + "px";
		                } else {
		                    f_w = o_w;
		                    f_h = o_h;
		                }
		                // img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
		                // img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
		                img.style.visibility = "visible";
		            }
		        }
		    };
		    window.open('{{asset("public")}}/backend/assets/js/kcfinder/browse.php?type=images&dir=images',
		        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
		        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
		    );
		}
	</script>
@stop