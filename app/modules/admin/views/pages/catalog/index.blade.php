@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<h4 class="page-head-line">Add New</h4>
				{{Form::open(array('route'=>'admin.catalog.store', 'class'=>'formAddCate') )}}
					<div class="form-group">
						<label for="title">Catalog</label>
						{{Form::text('name',Input::old('name'),array('class'=>'form-control') )}}
						<span class="error">{{$errors->first('name')}}</span>
					</div>
					@if($list != null)
					<div class="form-group">
						<label for="title">Parent</label>
						{{Form::select('parent_id', array(" "=> 'select parent') + $list, '0', array('class'=>'form-control') )}}
					</div>
					@endif
					<div class="form-group form-submit">
						<input type="submit" value="Apply" class="btn btn-primary pull-right">
					</div>
					
				{{Form::close()}}
			</div>
			<div class="col-sm-7">
				<h4 class="page-head-line">List Catalog</h4>
				@if($catalog != null )
				
					<table class="table table-striped  table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Status</th>
								<th>Parent</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($catalog as $item)
							<tr>
								<td></td>
								<td>{{$item->name}}</td>
								<td width="120px">
								<button class="btn btn-warning loading"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
								{{Form::select('status', array('0'=>'hide', '1'=>'show'), $item->status, array('class'=>'form-control', 'id'=>$item->id ) )}}</td>
								<td> {{ ($item->parent_id != null ? Catalog::find($item->parent_id)->name : "--" )}}</td>
								<td><a href="{{URL::route('admin.catalog.edit',$item->id)}}" class="btn btn-info"> Edit </a>  <a href="{{URL::route('admin.catalog.delete',$item->id)}}" class="btn btn-danger"> Remove </a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				
				@else
				<h4>No Data</h4>
				@endif

			</div>
		</div>
	</div>
</div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.success(":message");') }}

			// SHOW/HIDE
			$('.loading').hide();
			$('select[name="show"]').change(function(){
				var id = $(this).attr('id');
				var val = $(this).val();
				var a = $(this);
				$.ajax({
					'url' : "{{route('admin.catalog.status')}}",
					'type' : 'POST',
					'data' : {id:id, value : val},
					'beforeSend':function(){
						// a.prev().fadeIn();
						// a.hide();
					},
					'success': function(){
						a.prev().fadeOut('fast');
						a.fadeIn('slow');
					},

				})

			})
		});


	</script>
@stop