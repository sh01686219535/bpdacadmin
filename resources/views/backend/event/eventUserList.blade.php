@extends('backend.partials.app')
@section('content')
@push('css')
<style>
    .customer-card{
        display: flex;
        justify-content: space-between;
    }
    .customer-container{
        margin: 0 0 310px 0 ;
    }
</style>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container">
	<div class="row">
		<div class="col-lg-12">

			<div class="card">
				<div class="card-body">
					<div class="customer-card mb-3 mt-4" style="margin-top:-10px;">
						<div class="area-h3" >
							<div>
							<select name="" id="event" class="form-select">
								<option value="">Select Event</option>
								@foreach($event as $events)
								<option value="{{$events->id}}">{{$events->title}}</option>
								@endforeach
							</select>
							</div>

						</div>
						<div>
						<h2 class="text-right">User Event List</h2>
						</div>
                    </div>
					<div class="table-responsive">
					<table class="table table-hover table-borderd" id="example">
							<thead>
								<tr>
									<th>SI</th>
									<th>User Name</th>
									<th>Event Name</th>
									<th>Adult</th>
									<th>Mid Age</th>
									<th>Child</th>
									<th>Transport</th>
									<th>Total Amount</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody id="t-body">
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
                                    <td></td>
								</tr>
                            </tbody>

						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!--/ Hoverable Table rows -->

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
new DataTable('#example', {
	select: true
});
</script>
<script>
	$(document).ready(function(){
		$('#event').on('change',function(){
			var event_id = $(this).val();
			$.ajax({
				url:'/getevent',
				type:'post',
				data: { event_id: event_id },
				dataType: 'json',
				success: function(data){
                var tableBody = $('#t-body');
                tableBody.empty();

                $.each(data, function(index, row){
                    var deleteButton = '<a href="' + row.delete_route + '" title="Delete" class="btn btn-danger" onclick="return confirm(\'Are You Sure!!\')"><i class="fa-solid fa-trash"></i></a>';

                    var rowData = '<tr>' +
                        '<td>' + row.id + '</td>' +
                        '<td>' + (row.user && row.user.name ? row.user.name : 'N/A') + '</td>' +
                        '<td>' + (row.event && row.event.title ? row.event.title : 'N/A') + '</td>' +
                        '<td>' + row.adult + '</td>' +
                        '<td>' + row.midAge + '</td>' +
                        '<td>' + row.child + '</td>' +
                        '<td>' + row.transport + '</td>' +
                        '<td>' + row.total_Amount + '</td>' +
                        '<td>' + deleteButton + '</td>' +
                        '</tr>';
                    tableBody.append(rowData);
                });
            },
				error:function(error,xhr,status){
                        console.error(xhr.responseText);
                },
			});
		});
	});
</script>
@endpush
