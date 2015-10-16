@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<h4 class="page-head-line">Add New</h4>
		</div>
		<div class="row">
			{{Form::open(array('route'=>'admin.product.store')) }}
				<div class="col-sm-8">
					<div class="form-group">
						<label for="title">Name Product</label>
						{{Form::text('name',Input::old('name'), array('class' => 'form-control') )}}
					</div>
					<div class="form-group">
						<label for="content">Summary Product</label>
						{{Form::textarea('content',Input::old('content'), array('class' => 'form-control ckeditor') )}}
					</div>
					<div class="form-group">
						<label for="title">Price product</label>
						{{Form::text('price',Input::old('price'), array('class' => 'form-control') )}}
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<div class="inline">
									<label for=""><input type="radio" name="check" /> Discount Amout  </label>
									{{Form::text('amont_value',\Input::old('discount_amount'), array('class'=>'form-control', 'disabled'))}}
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for=""><input type="radio" name="check" /> Discount Percent  </label>
									{{Form::text('amont_value',\Input::old('discount_amount'), array('class'=>'form-control','disabled'))}}
								</div>
								<div><button class="btn btn-sm pull-right btn-warning"><small>Reset discount</small></button></div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="inventory">Inventory</label>
						{{Form::text('inventory',\Input::get('inventory'), array('class'=>'form-control'))}}
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<label for="title">Categrory</label>
						{{Form::select('cate_id',$list,0,array('class'=> 'form-control') )}}

					</div>
					<div class="form-group">
						<label for="img">Featured Image</label>
						<button type="button" id="open_img" class="btn btn-primary" onclick="openKCFinder()">Choose images</button>
						<div id="preview_img"></div>
					</div>
					<div class="form-group form-submit">
						{{Form::submit('Create', array('class' => 'btn btn-primary pull-right'))}}

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
		$(document).ready( function(){
			$(".cb-enable").click(function(){
			    var parent = $(this).parents('.switch');
			    $('.cb-disable',parent).removeClass('selected');
			    $(this).addClass('selected');
			    $('.checkbox',parent).attr('checked', true);
			});
			$(".cb-disable").click(function(){
			    var parent = $(this).parents('.switch');
			    $('.cb-enable',parent).removeClass('selected');
			    $(this).addClass('selected');
			    $('.checkbox',parent).attr('checked', false);
			});

			$('.probeProbe').bootstrapSwitch('state', false);
			$('.probeProbe').on('switchChange.bootstrapSwitch', function (event, state) {
			        if(state == true){
			            $(".wrap-area").fadeIn();
			            $('input.probeProbe').val('1');
			        }else{
			        	$('input.probeProbe').val('0');
			            $(".wrap-area").slideUp();
			            $(".attr").val('');
			            $(".val_attr").val('');
			        }
			});
		});

		function addRow(){
			var area = document.getElementById('area');

			var div1 = document.createElement('div');
			div1.className="form-group form-addition";

			var div2 = document.createElement('div');
			div2.className="row";

			var div3 = document.createElement('div');
			div3.className="col-sm-5";

			var div4 = document.createElement('div');
			div4.className="col-sm-5";

			var div5 = document.createElement('div');
			div5.className="col-sm-2";

			var label1 = document.createElement('label');
			var text_label1 = document.createTextNode('Attribute');
			label1.appendChild(text_label1);

			var input1 = document.createElement('input');
			input1.setAttribute('type','text');
			input1.setAttribute('name','attr[]');
			input1.setAttribute('class','form-control');

			var label2 = document.createElement('label');
			var text_label2 = document.createTextNode('Value');
			label2.appendChild(text_label2);

			var input2 = document.createElement('input');
			input2.setAttribute('type','text');
			input2.setAttribute('name','value_attr[]');
			input2.setAttribute('class','form-control');

			var label3 = document.createElement('label');
			label3.setAttribute('style','opacity:0');
			var text_label3 = document.createTextNode('Remove');
			label3.appendChild(text_label3);
			var btn_remove = document.createElement('button');
			btn_remove.setAttribute('class', 'btn btn-danger pull-right');
			btn_remove.setAttribute('type', 'button');
			btn_remove.setAttribute('onclick', 'remove_btn(this)');
			var remove_text = document.createTextNode('Remove');
			btn_remove.appendChild(remove_text);



			div3.appendChild(label1);
			div3.appendChild(input1);

			div4.appendChild(label2);
			div4.appendChild(input2);

			div5.appendChild(label3);
			div5.appendChild(btn_remove);

			div2.appendChild(div3);
			div2.appendChild(div4);
			div2.appendChild(div5);

			div1.appendChild(div2);

			area.appendChild(div1);
		}

		function remove_btn(val){
			val.parentNode.parentNode.parentNode.remove();

		}

		function openKCFinder() {
		    window.KCFinder = {
		        callBack: function(url) {
		            window.KCFinder = null;
		            var div = document.getElementById("preview_img");
		            div.innerHTML = '<div style="margin:5px">Loading...</div>';
		            var img = new Image();
		            img.src = url;
		            img.onload = function() {
		                div.innerHTML = '<img id="img" width="320" src="' + url + '" />' + '<input type="hidden" name="file" value="' + url+ '" />';
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