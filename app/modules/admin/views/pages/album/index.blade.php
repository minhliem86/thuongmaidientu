@extends('admin::layouts.default')
@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="wrap-btn">
				<a href="{{route('admin.album.create')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add New</a>		
				<button class="btn btn-danger" data-method="remove" id="btn-remove">Remove</button>
			</div>

			@if($album->count() != 0)
			<div id="content-ajax">
				<table data-classes="table table-no-bordered" cellspacing="10" id="table-post" width="100%" data-striped="true" data-page-number="1" data-page-size="5" data-pagination="true" data-page-list="[5,10,15,20]" data-show-toggle="true" data-click-to-select="true" data-select-item-name="id_field[]" data-toggle="table">
					<thead>
						<tr>
							<th data-checkbox="true"></th>
							<th data-field="id">ID</th>
							<th data-field="title">Album name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($album as $item)
						<tr>
							<td></td>
							<td>{{$item->id}}</td>
							<td><b>{{$item->title}}</b></td>
							<td > 
							<button style="display:none" class="btn btn-warning loading"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
							{{Form::select('show', array('0'=>'hide', '1'=>'show'), $item->show, array('class'=>'form-control', 'id'=>$item->id ) )}}</td>
							<td><a href="{{route('admin.album.edit', array($item->id) )}}" class="btn btn-info"> Edit </a> <button class="btn  btn-danger" onclick="confirm_remove(this)"  href="{{route('admin.album.delete', array($item->id) )}}" > Remove </button></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>	<!-- end ajax-table-->
			@else
			<h4> No data</h4>
			@endif

		</div>
	</div>
</div>
@stop

@section('script')
	<!-- SCRIPT -->
	{{HTML::script('public/backend/assets/js/table-bootstrap/bootstrap-table.js')}}
	{{HTML::style('public/backend/assets/js/table-bootstrap/bootstrap-table.css')}}

	<script type="text/javascript">
		$(document).ready(function(){
			{{Notification::showSuccess('alertify.success(":message");') }}
			{{Notification::showError('alertify.error(":message");') }}
			
			// SHOW/HIDE
			$('.loading').hide();
			$('select[name="show"]').change(function(){
				var id = $(this).attr('id');
				var val = $(this).val();
				var a = $(this);
				$.ajax({
					'url' : "{{route('admin.album.status')}}",
					'type' : 'POST',
					'data' : {id:id,value:val},
					'beforeSend':function(){
						a.prev().fadeIn();
						a.hide();
					},
					'success': function(data){
						a.prev().fadeOut('fast');
						a.fadeIn('slow');
						alertify.success('Status has changed !');
					},
				});
			});

			// REMOVE ALL
			$('#btn-remove').click(function(){
				var select = $("#table-post").bootstrapTable('getSelections');
				var id = $.map(select,function(row){
					return row.id;
				});

				alertify.confirm("You can not undo this action. Are you sure ?", function(e){
					if(e){
						$.ajax({
							url:"{{route('admin.album.deleteAll')}}",
							type:"POST",
							data: {arr : id},
							success:function(data){
								if(data.msg == 'error'){
									alertify.error("Please check items selected !");	
								}else{
									alertify.success("Deleted !");
									$('#table-post').bootstrapTable('remove',{
										field: 'id',
										values: id
									});
								}
								
							}
						})
						
					}
				});
				
			});
		})

		function confirm_remove(val){
			alertify.confirm('You can not undo this action. Are you sure ?', function(e){
				if(e){
					var a = val.getAttribute('href');
					window.location.href= a;
				}
			});
		}
	</script>

@stop