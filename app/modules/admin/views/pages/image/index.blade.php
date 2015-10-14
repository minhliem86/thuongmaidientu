@extends('admin::layouts.default')
@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			{{Form::open(array('route'=>'admin.image.deleteall', 'class'=>'form-deleteall'))}}
			<div class="wrap-btn">
				<a href="{{route('admin.image.create')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add New</a>		
				<button class="btn btn-danger" type="button"  id="btn-remove" onclick="confirm()">Remove Seleted</button>
				
				{{Form::select('album_id',array('0' => '---')+$album,'0',array('class'=>'select-album pull-right') )}}
			</div>
			@if($image->count() != 0)
			<div id="content-ajax">
				<ul class="list-img">
					@foreach($image as $item)
					<li>
						<div class="each-img">
							<img src="{{asset($item->path_img)}}" data-source="{{asset($item->path_img)}}"  data-toggle="modal" data-target="#myModal" data-id="{{$item->id}}" data-alt="{{$item->alt_text}}" data-sort="{{$item->sort}}" data-show="{{$item->show}}"/>
							<p><b>Status:</b> {{$item->show == 1 ? 'show' : 'hide' }}</p>
							<p>{{Form::text('sort',$item->sort,array('class'=>'class-form') )}}</p>
							<p><input type="checkbox" class="check" name="check[]" value="{{$item->id}}" /></p>
							<button type="button" class="btn btn-danger" href="{{route('admin.image.delete', $item->id)}}" onclick="confirm_remove(this)">Remove</button>
							<button type="button" class="btn btn-info sort-btn" data-id="{{$item->id}}" >Sort</button>
						</div>	<!-- end each-img -->
					</li>
					@endforeach
				</ul>
			</div>	<!-- end ajax-table-->
			{{Form::close()}}
			@else
			<h4> No data</h4>
			@endif
		</div>
	</div>
</div>

<div class="modal fade"  id="myModal" tabindex="1" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">
			{{Form::open(array('url'=>array('google'),'class'=>'form-update-img', 'method'=>'PUT', 'files'=>true ))}}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update </h4>
			</div>
			<div class="modal-body">
				<img src="" class="show_img_bk img-responsive"  style="margin:auto" />
				{{Form::hidden('img_bk','')}}
				<div class="group-img">
					<span class="img_replace">Change Image</span>
					{{Form::file('img', array('class'=>'btn-img') )}}
					
				</div>
				<div class="group">
					<label for="">Alt text</label>
					{{Form::text('alt_text','',array('class'=>'form-control'))}}
				</div>
				<div class="group">
					<label for="">Status</label>
					{{Form::select('show',array('0'=>'hide', '1'=>'show'),'',array('class'=>'form-control'))}}
				</div>
				<div class="group">
					<label for="">Sort</label>
					{{Form::text('sort','',array('class'=>'form-control'))}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{{Form::submit('Save Changes',array('class'=> ' btn btn-primary'))}}
			</div>
			{{Form::close()}}
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('script')
	<!-- SCRIPT -->

	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.success(":message");') }}
			{{Notification::showError('alertify.error(":message");') }}
			
			// MODAL
			$('#myModal').on('show.bs.modal',function(event){
				var button = $(event.relatedTarget);
				
				var id = button.data('id');
				var url = "{{route('admin.image.update',array(':id'))}}"
				url = url.replace(':id',id);

				var path = button.data('source');
				var alt = button.data('alt');
				var sort = button.data('sort');
				var show = button.data('show');

				var modal = $(this);
				modal.find(".form-update-img").attr('action',url);
				modal.find('.modal-body input[name="alt_text"]').val(alt);
				modal.find('.modal-body select[name="show"]').val(show);
				modal.find('.modal-body input[name="sort"]').val(sort);
				modal.find('.modal-body input[name="img_bk"]').val(path);
				modal.find('.modal-body .show_img_bk').attr('src',path);

			});

			$('.sort-btn').click(function(){
				var id = $(this).attr('data-id');
				var sort = $(this).parent().find('input[name="sort"]').val();
				
				$.ajax({
					url: '{{route("admin.image.sort")}}',
					type:'POST',
					data:{id:id, sort:sort},
					beforeSend:function(){
						$(this).parent().find('input[name="sort"]').val('Loading ...')
					},
					success:function(data){
						alertify.success('UPDATED !');
						$(this).parent().find('input[name="sort"]').val(data.kq);
						
					}
				})
			})
		})

		function confirm_remove(val){
			alertify.confirm('You can not undo this action. Are you sure ?', function(e){
				if(e){
					var a = val.getAttribute('href');
					window.location.href= a;
				}
			});
		}
		function confirm(){
			alertify.confirm('You can not undo this action. Are you sure ?', function(e){
				if(e){
					$('.form-deleteall').submit();
				}
			})
		}

	</script>

@stop