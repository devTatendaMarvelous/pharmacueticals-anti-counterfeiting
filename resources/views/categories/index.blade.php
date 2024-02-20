<x-dashboard>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>All Categories</h5>
                        <form class="d-inline-flex">
                            <a href="{{ route('categories.create') }}" class="align-items-center btn btn-theme d-flex">
                                <i data-feather="plus"></i>Add New
                            </a>
                        </form>
                    </div>

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" id="table_id">
                            <thead>
                                <tr class="text-left">

                                    <th>Created By</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                               {{ $category->name }}

                                        </td>

                                        <td>{{ $category->category_name }}</td>

                                        <td>{{ $category->category_description }}</td>

                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#editModalToggle{{ $category->id }}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalToggle{{ $category->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal Box Start -->
                                    <div class="modal fade theme-modal remove-coupon"
                                        id="editModalToggle{{ $category->id }}" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content text-center">
                                                <div class="modal-header d-block text-center">
                                                    <h5 class="modal-title w-100" id="exampleModalLabel22">Editing
                                                        Category</h5>

                                                    <form class="theme-form theme-form-2 mega-form"
                                                        action="{{ route('categories.update', [$category->id]) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-4 row align-items-center">
                                                            <label class="form-label-title col-sm-3 mb-0">
                                                                Name</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" type="text"
                                                                    value="{{ $category->category_name }}"
                                                                    name="category_name">
                                                            </div>
                                                        </div>
                                                        <div class="mb-4 row align-items-center">
                                                            <label class="form-label-title col-sm-3 mb-0">
                                                                Description</label>
                                                            <div class="col-sm-9">
                                                                <textarea name="category_description" class="form-control" type="text" placeholder="Category Description"
                                                                    id="" cols="30" rows="10">{{ $category->category_description }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-warning btn-md fw-bold"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <input class="btn btn-animation btn-md fw-bold"
                                                                type="submit" value="Update Category" />
                                                        </div>
                                                    </form>



                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Modal Box Start -->
                                    <div class="modal fade theme-modal remove-coupon"
                                        id="exampleModalToggle{{ $category->id }}" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content text-center">
                                                <div class="modal-header d-block text-center">
                                                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure
                                                        ?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-animation btn-md fw-bold"
                                                        data-bs-dismiss="modal">No</button>
                                                    <a type="a" class="btn btn-animation btn-md fw-bold"
                                                        href="{{ route('categories.delete', [$category->id]) }}">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center">No Users Available</p>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- All User Table Ends-->

</x-dashboard>
