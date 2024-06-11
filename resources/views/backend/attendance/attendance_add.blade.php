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
            @if (session('success'))
            <div class="alert slert-success timeout" style="color: green" >{{ session('success') }}</div>
            @elseif (session('error'))
            <div class="alert slert-danger timeout">{{ session('error') }}</div>

            @endif
			<div class="card">
				<div class="card-body">
					<div class="customer-card mb-3" style="margin-top:-10px;">
						<div class="area-h3">
							<h2>Attendance</h2>
                        </div>
                    </div>
                   <form method="post" action="{{ route('store.attendance') }}">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="event_id" class="my-2"><strong>Event Name</strong></label>
                                <select class="form-control" name="event_id" id="event_id">
                                    <option value="">Choose An Event</option>
                                    @foreach ($event as $events)
                                    <option  value="{{ $events->id }}">{{ $events->title }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_id" class="my-2"><strong>Member Name</strong></label>
                                <select class="form-control" name="user_id" id="user_id">
                                    <option value=""></option>
                                </select>
                            </div>
                            <input type="submit" value="Submit" class="btn btn-success my-3">
                        </div>
                   </form>
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
        $('#event_id').on('change', function(){
            var event_id = $(this).val();
            $.ajax({
                url: '/user-get',
                type: 'post',
                dataType: 'json',
                data: {'event_id': event_id},
                success: function (data) {
                    $('#user_id').html(data);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endpush
