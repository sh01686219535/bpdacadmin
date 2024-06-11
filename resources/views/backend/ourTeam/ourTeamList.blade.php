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

    /* table {
    width: 100%;
    display:block;
    }
    thead {
        display: block;
        width: 100%;
        height: 38px;
    }
    tbody {
        height: 500px;
        display: block;
        width: 100%;
        overflow: auto;
    } */
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

                    </div>
                    {{-- <div class="col-lg-12 col-xl-12 col-md-12 c"> --}}
						<table class="table table-hover table-borderd table-responsive" id="example">
							<thead>
								<tr>
									<th>SI</th>
									<th>Title</th>
									<th>Name</th>
									<th>Designation</th>
									<th>Sub Designation</th>
									{{-- <th>Image</th> --}}
									<th>Action</th>

								</tr>
							</thead>
							<tbody> @php $i = 1 @endphp @foreach($ourTeam as $ourTeams)
								<tr>
									<td>{{$i++}}</td>
									<td>{{$ourTeams->title}}</td>
									<td>{{$ourTeams->name}}</td>
									<td>{{$ourTeams->designation}}</td>
									<td>{{$ourTeams->sub_designation}}</td>

									{{-- <td>

                                        <img height="60px" width="60px" src="{{ $ourTeams->image }}" alt="">
                                    </td> --}}

									<td>
                                        <a href="{{ route('ourTeam_edit',$ourTeams->id) }}" title="Edit" class="btn btn-primary" id="Edit"><i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('ourTeam_delete',$ourTeams->id) }}" title="Delete" class="btn btn-danger" id="delete"><i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
								</tr>
                                @endforeach
                            </tbody>
						</table>
                    {{-- </div> --}}
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
