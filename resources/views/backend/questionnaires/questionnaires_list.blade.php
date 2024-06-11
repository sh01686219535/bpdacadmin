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
							<h2>Questionnaries Table</h2> </div>
                    </div>

						<div class="table-responsive">
                            <table  class="table table-hover table-borderd" id="example">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Name</th>
                                        <th>newcomer</th>
                                        <th>Bangladeshi Medical/Dental</th>
                                        <th>Medical College</th>
                                        <th>Year Of Graduation</th>
                                        <th>enrolledInResidency</th>
                                        <th>Practice Ready Pathway</th>
                                        <th>Completed Licensing Exams</th>
                                        <th>Allied Health</th>
                                        <th>Practicing Physician/Dentist</th>
                                        <th>Specify Industry</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach($questionnaires as $questionnairess)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $questionnairess->users->name ?? ' ' }}</td>
                                        <td>{{ $questionnairess->newcomer  }}</td>
                                        <td>{{ $questionnairess->Bangladeshi_medical  }}</td>
                                        <td>{{ $questionnairess->medical_college  }}</td>
                                        <td>{{ $questionnairess->year_of_graduation  }}</td>
                                        <td>{{ $questionnairess->enrolledInResidency  }}</td>
                                        <td>{{ $questionnairess->practiceReadyPathway  }}</td>
                                        <td>{{ $questionnairess->completedLicensingExams  }}</td>
                                        <td>{{ $questionnairess->allied_health  }}</td>
                                        <td>{{ $questionnairess->specify_industry  }}</td>
                                        <td>{{ $questionnairess->practice_ph_dn  }}</td>
                                        <td>
                                            <a href="{{ route('questionnairesDelete.list',$questionnairess->id) }}" title="Delete" class="btn btn-danger" id="delete" onclick="return confirm('Are You Sure!!')"><i class="fa-solid fa-trash"></i>
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
