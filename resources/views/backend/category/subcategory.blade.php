@extends('backend.partials.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">

                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <div style="display:flex; justify-content:space-between">
                                    <h5 class="card-title text-primary" style="text-transform: uppercase">Sub Category List</h5>
                                    @if (session('success'))
                                        <div class="text-success timeout mt-1">{{ session('success') }}</div>
                                    @elseif(session('error'))
                                        <div class="text-danger timeout mt-1">{{ session('error') }}</div>
                                    @endif
                                    <div class="mt-3">
                                        <div id="success" class="text-success "></div>
                                        <div id="failed" class="text-danger "></div>
                                    </div>
                                    <a type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                                        data-bs-target="#basicModal">

                                        Add
                                    </a>
                                </div>


                                <div class="table-responsive text-nowrap">
                                    <table class="table" id="data_table">
                                        <thead>
                                            <tr>
                                                <th>Sub Category Name</th>
                                                <th>Category Name</th>
                                                <th>Priority</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($data['subcategory_list'] as $single_subcategory)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $single_subcategory->name }}
                                                        </strong></td>
                                                    <td>{{ $single_subcategory->category_name }}</td>

                                                    <td><span class="badge bg-label-primary me-1">{{ $single_subcategory->priority }}</span></td>
                                                    <td>

                                                                <a class="btn btn-primary text-white" id="edit_subcategory" data-id="{{$single_subcategory->id }}" data-name="{{ $single_subcategory->name }}" data-category_id="{{ $single_subcategory->category_id }}" data-priority="{{ $single_subcategory->priority }}" data-bs-toggle="modal" data-bs-target="#editModal"><i
                                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                <a class="btn btn-primary text-white" id="delete"  data-id="{{ $single_subcategory->id }}"><i
                                                                        class="bx bx-trash me-1"></i> Delete</a>
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

        </div>
    </div>
    {{-- // modal start  --}}
    <!-- Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.subcategory.add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Category</label>
                                <select name="category_id" id="defaultSelect" class="form-select">
                                    <option>Select Category</option>
                                    @foreach ($data['category_list'] as $single_category)
                                        <option  value="{{ $single_category->id }}">{{ $single_category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailBasic" class="form-label">Name</label>
                                <input type="text" name="name"  class="form-control"
                                    placeholder="Enter SubCategory Name" />
                            </div>
                            <div class="col mb-0">
                                <label for="dobBasic" class="form-label">Priority <small>(Max Are Top)</small></label>
                                <input type="number" name="priority"  class="form-control"
                                    placeholder="Enter A Number" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Update Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.subcategory.edit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" id="id" name="id">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Category</label>
                                <select id="category_id" name="category_id" id="defaultSelect" class="form-select">
                                    <option>Select Category</option>
                                    @foreach ($data['category_list'] as $single_category)
                                        <option   value="{{ $single_category->id }}">{{ $single_category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailBasic" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter SubCategory Name" />
                            </div>
                            <div class="col mb-0">
                                <label for="dobBasic" class="form-label">Priority <small>(Max Are Top)</small></label>
                                <input type="number" name="priority" id="priority" class="form-control"
                                    placeholder="Enter A Number" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).on('click','#edit_subcategory',function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var category_id = $(this).data('category_id');
        var category_id = $(this).data('category_id');
        var priority = $(this).data('priority');

         $('#id').val(id);
         $('#name').val(name);
         $('#category_id').val(category_id);
         $('#priority').val(priority);
    })
</script>
<script>
    setTimeout(() => {
            $('.timeout').fadeOut('slow');
    }, 300);
</script>
<script>
    $(document).on('click', '#delete', function() {
        if (confirm('Are You Sure ?')) {
            let id = $(this).data('id');
            let row = $(this).closest('tr');
            $.ajax({
                url: '/admin/subcategory/delete/' + id,
                success: function(data) {
                    var data_object = JSON.parse(data);
                    if (data_object.status == 'SUCCESS') {
                        row.remove();
                        $('#data_table tbody tr').each(function(index){
                            $(this).find('td:first').text(index + 1);
                        });

                        $('#success').html(data_object.message);
                        setTimeout(() => {
                           $('#success').fadeOut('slow')
                        }, 3000);

                    } else {
                        $('#failed').html(data_object.message);
                        setTimeout(() => {
                           $('#failed').fadeOut('slow')
                        }, 3000);
                    }
                }
            });
        }
    });
</script>

@endpush
