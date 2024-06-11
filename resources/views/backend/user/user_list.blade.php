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
		<div class="col-lg-12 col-xl-12 col-md-12 col-12">
			<div class="card">
				<div class="card-body">
					<div class="customer-card mb-3" style="margin-top:-10px;">
						<div class="area-h3">
							<h2>User Table</h2> </div>
						{{-- <div class="print">
                            <a href="" class="btn btn-primary pdf">CSV</a>
                            <a href="" class="btn btn-primary pdf">Excel</a>
                             <a class="btn btn-primary pdf" href="">PDF</a>
                             <a class="btn btn-primary pdf btnprn" href="" onclick="print()">Print</a>
                            </div> --}}
						<div class="btn-customer" style="margin-top:10px;">
                        <a href="" class="btn btn-primary" title="Add Category" data-bs-toggle="modal" data-bs-target="#categoryModal"><i class="fa-solid fa-plus"></i> Add Category</a> </div>
                    </div>
                    <div class="table-responsive">
						<table class="table table-hover table-borderd table-responsive" id="example">
							<thead>
								<tr>
									<th>SI</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Image</th>
									<th>Address</th>
									<th>Status</th>
									<th>User Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody> @php $i = 1 @endphp @foreach($user as $users)
								<tr>
									<td>{{$i++}}</td>
									<td>{{$users->name}}</td>
									<td>{{$users->email}}</td>
									<td>{{$users->phone}}</td>
									<td>

                                        <img height="60px" width="60px" src="{{ asset($users->image) }}" alt="">
                                    </td>
									<td>{{$users->address}}</td>
									<td>
                                        @if($users->status == 'pending')
                                        <span class="btn btn-danger">Pending</span>
                                        @else
                                        <span class="btn btn-success">Approved</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($users->user_status == 'userDisable')
                                        <form action="{{ route('user.disable',$users->id) }}" method="post">
                                            @csrf
                                            <input type="submit" class="btn btn-danger" value="Disable" />
                                        </form>
                                        @else
                                        <form action="{{ route('user.enable',$users->id) }}" method="post">
                                            @csrf
                                            <input type="submit" class="btn btn-success" value="Enable" />
                                        </form>
                                        @endif
                                    </td>
									<td>
                                        <a href="{{ route('user_edit',$users->id) }}" title="Edit" class="btn btn-primary" id="Edit"><i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('user_delete',$users->id) }}" title="Delete" class="btn btn-danger" id="delete"><i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
								</tr>
                                @endforeach
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
@endpush
