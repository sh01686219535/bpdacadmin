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
					<div class="customer-card mb-3" style="margin-top:-10px;">
						<div class="area-h3">
							<h2>User Approve Table</h2> </div>
						{{-- <div class="print">
                            <a href="" class="btn btn-primary pdf">CSV</a>
                            <a href="" class="btn btn-primary pdf">Excel</a>
                             <a class="btn btn-primary pdf" href="">PDF</a>
                             <a class="btn btn-primary pdf btnprn" href="" onclick="print()">Print</a>
                            </div> --}}

                    </div>
						<table class="table table-hover table-borderd" id="example">
							<thead>
								<tr>
									<th>SI</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Address</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody> @php $i = 1 @endphp @foreach($user as $users)
								<tr>
									<td>{{$i++}}</td>
									<td>{{$users->name}}</td>
									<td>{{$users->email}}</td>
									<td>{{$users->phone}}</td>
									<td>{{$users->address}}</td>
									<td>
                                    <a href="{{ route('user_approve_details',$users->id) }}" title="Delete" class="btn btn-info" id="delete"><span class="btn btn-info">Approve</span></a> </td>
								</tr> @endforeach </tbody>
						</table>

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
@endpush
