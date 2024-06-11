@extends('backend.partials.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Event Create</h5>

                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                  <div class="card mb-4">

                                    <div class="card-body">
                                        @if (session('success'))
                                        <div class="alert slert-success timeout" style="color: green" >{{ session('success') }}</div>
                                        @elseif (session('error'))
                                        <div class="alert slert-danger timeout">{{ session('error') }}</div>

                                        @endif

                                      <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Title</label>
                                                <input type="text" class="form-control" name="title" id="basic-default-name" placeholder="Enter Event Title" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Description</label>
                                                <input type="text" class="form-control" name="description" id="basic-default-name" placeholder="Enter Event Description" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Cost</label>
                                                <input type="text" class="form-control" name="cost" id="basic-default-name" placeholder="Enter Event Cost(Per Person)" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Start Date</label>
                                                <input type="date" class="form-control" name="start_date" id="basic-default-name" placeholder="Enter Start Date" />
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Venue</label>
                                                <input type="text" class="form-control" name="venue" id="basic-default-name" placeholder="Enter Event Venue" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-phone">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>

                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="basic-default-name">Event Image</label>
                                                <input type="file" class="form-control my-2" name="image" id="image"/>
                                                <img style="width:200px;height:200px" id="showImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                                            </div>

                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </div>
                                    </form>

                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@push('js')
<script>
    $(document).ready(function(){
        $('#image').change('click',function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
<script>
    setTimeout(() => {
     $('.timeout').fadeOut('slow')
    }, 3000);
</script>

@endpush
