@extends('backend.partials.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Create Our Team</h5>

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
                                        @include('error')
                                      <form method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Title</label>
                                                <input type="text" class="form-control" name="title" id="basic-default-name" placeholder="Enter Title" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Name</label>
                                                <input type="text" class="form-control" name="name" id="basic-default-name" placeholder="Enter Event Name" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Designation</label>
                                                <input type="text" class="form-control" name="designation" id="basic-default-name" placeholder="Enter Designation" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Sub Designation</label>
                                                <input type="text" class="form-control" name="sub_designation" id="basic-default-name" placeholder="Enter Sub Designation" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Image</label>
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
