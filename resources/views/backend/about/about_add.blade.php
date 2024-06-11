@extends('backend.partials.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">About Add</h5>

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
                                        <input type="hidden" name="about_id" value="{{ $about->id}}">
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{ $about->title }}" name="title" id="basic-default-name" placeholder="Enter title"/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-name">Description</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" value="{{ $about->description }}" name="description" id="basic-default-name" placeholder="Enter title"/>
                                            </div>
                                          </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
                                            <div class="col-sm-10">
                                              <input type="email" class="form-control" name="email" value="{{ $about->email }}" id="basic-default-name" placeholder="Enter Email"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-name">Address</label>
                                            <div class="col-sm-10">
                                              <input type="address" class="form-control" name="address" value="{{ $about->address }}" id="basic-default-name" placeholder="Enter Address"/>
                                        </div>
                                        <div class="row mb-3 my-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-name">Phone</label>
                                            <div class="col-sm-10">
                                              <input type="address" class="form-control" name="phone" value="{{ $about->phone }}" id="basic-default-name" placeholder="Enter Phone"/>
                                        </div>
                                          </div>
                                          <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-name">Website Link</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" name="web_link" value="{{ $about->web_link }}" id="basic-default-name" placeholder="Enter Website Link"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">About Image</label>
                                          <div class="col-sm-10">

                                            <input type="file" class="form-control my-2" name="image" id="image"/>
                                            <img style="width:200px;height:200px" id="showImage" src="{{ asset('backend/img/about/' . $about->image) }}" alt="" class="image-style mb-3">

                                        </div>


                                        {{-- <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label"  for="basic-default-phone">Priority</label>
                                          <div class="col-sm-10">
                                            <input
                                              type="text"
                                              name="priority"
                                              id="basic-default-phone"
                                              class="form-control phone-mask"
                                              placeholder="941"
                                              aria-label="941"
                                              aria-describedby="basic-default-phone"
                                            />
                                          </div> --}}
                                        </div>

                                        <div class="row justify-content-end">
                                          <div class="col-sm-10">
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
