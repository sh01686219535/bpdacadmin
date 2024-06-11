@extends('backend.partials.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">USER Create</h5>

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

                                      <form action="{{ route('add.user') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Name</label>
                                                <input type="text" class="form-control" name="name" id="basic-default-name" placeholder="Enter Event Name" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Email</label>
                                                <input type="email" class="form-control" name="email" id="basic-default-name" placeholder="Enter Email" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Phone</label>
                                                <input type="number" class="form-control" name="phone" id="basic-default-name" placeholder="Enter Phone Number" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Specialist</label>
                                                <input type="text" class="form-control" name="specialist" id="basic-default-name" placeholder="Enter Specialist At" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Working Place</label>
                                                <input type="text" class="form-control" name="working_place" id="basic-default-name" placeholder="Enter Working Place" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Address</label>
                                                <input type="text" class="form-control" name="address" id="basic-default-name" placeholder="Enter Address" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Password</label>
                                                <input type="password" class="form-control" name="password" id="basic-default-name" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">Comfirm Password</label>
                                                <input type="password" class="form-control" name="confirm_password" id="basic-default-name" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label my-2" for="basic-default-name">USER Image</label>
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
