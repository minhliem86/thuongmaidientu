@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			{{Form::open(array('route'=>'admin.album.store','class'=>'formAdmin form-horizontal','files'=>true))}}
					<div class="form-group">
						<label for="" class="col-sm-2">Title</label>
						<div class="col-sm-10">
							{{Form::text('title',Input::old('title'),array('class'=>'form-control'))}}
						</div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-sm-2">Show</label>
						<div class="col-sm-10">
							{{Form::checkbox('show','1',true)}}
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
							<a href="{{URL::previous()}}" class="btn btn-primary">Back</a>
						</div>
					</div>
			{{Form::close()}}
		</div>
	</div>
</div>

@stop

@section('data_code')
<script>
	
</script>
@stop