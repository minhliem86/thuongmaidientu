@extends('admin::layouts.default')

@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			@if(!is_null($contact))
			{{Form::model($contact,array('route'=>array('admin.contact.post')) )}}
				<div class="form-group">
					{{Form::label('Phone Number')}}
					{{Form::text('phone',Input::old('phone'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::label('Address')}}
					{{Form::text('address',Input::old('address'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::label('Email')}}
					{{Form::text('email',Input::old('email'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::label('Fax')}}
					{{Form::text('fax',Input::old('fax'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::label('Map')}}
					{{Form::text('map',Input::old('map'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::submit('Save Changes',array('class'=>'btn btn-primary'))}}
				</div>
			{{Form::close()}}
			@else
				{{Form::open(array('route'=>array('admin.contact.post')) )}}
				<div class="form-group">
					{{Form::label('Phone Number')}}
					{{Form::text('phone',Input::old('phone'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::label('Address')}}
					{{Form::text('address',Input::old('address'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::label('Email')}}
					{{Form::text('email',Input::old('email'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::label('Fax')}}
					{{Form::text('fax',Input::old('fax'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::label('Map')}}
					{{Form::text('map',Input::old('map'),array('class'=>'form-control') )}}
				</div>
				<div class="form-group">
					{{Form::submit('Save Changes',array('class'=>'btn btn-primary'))}}
				</div>
			{{Form::close()}}
			@endif

		</div>
	</div>
</div>

@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.success(":message");') }}
			{{Notification::showError('alertify.error(":message");') }}
		});
	</script>
@stop