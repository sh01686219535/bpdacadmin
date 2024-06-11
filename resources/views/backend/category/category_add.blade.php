@extends('backend.partials.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Category Add</h5>

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
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Category Name</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" name="category_name" id="basic-default-name" placeholder="Cow spilit Leather" />
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Category Photo</label>
                                          <div class="col-sm-10">

                                            <input type="file" class="form-control my-2" name="photo" id="image"/>
                                            <img style="width:200px;height:200px" id="showImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                                        </div>
                                        </div>


                                        <div class="row mb-3">
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
                                          </div>
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
