<x-dashboard>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-8 m-auto">
                    <div class="card">
                        <form action="{{ route('manufacturers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Add New Manufacturer</h5>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                        <div class="theme-form theme-form-2 mega-form">
                                            <div class="row">
                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                        class="form-label-title col-lg-2 col-md-3 mb-0">
                                                        Name</label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <input class="form-control" name="name" type="text" required>
                                                        @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                        class="col-lg-2 col-md-3 col-form-label form-label-title">Email
                                                    </label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <input class="form-control" name="email" type="email" required>
                                                        @error('email')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                        class="col-lg-2 col-md-3 col-form-label form-label-title"> Logo
                                                    </label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <input class="form-control" name="photo" type="file" required>
                                                        @error('photo')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                        class="col-lg-2 col-md-3 col-form-label form-label-title"> Licence
                                                    </label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <input class="form-control" name="licence" type="file" required>
                                                        @error('photo')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                        class="col-lg-2 col-md-3 col-form-label form-label-title">Address</label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <input class="form-control" name="address" required>
                                                        @error('address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center">
                                                    <div class="row align-items-center">
                                                        <label
                                                            class="col-lg-2 col-md-3 col-form-label form-label-title">Phone
                                                        </label>
                                                        <div class="col-md-9 col-lg-10">
                                                            <input class="form-control" name="tel" required>
                                                            @error('tel')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 row align-items-center">
                                                    <div class="col-md-9 col-lg-10">
                                                        <div class="col-md-6"></div>
                                                        <input type="submit" class="btn btn-primary" value="Create">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
