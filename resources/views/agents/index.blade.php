<x-dashboard>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="title-header option-title">
                        <h5>All Agents</h5>
                        <form class="d-inline-flex">
                            <a href="{{ route('agents.create') }}" class="align-items-center btn btn-theme d-flex">
                                <i data-feather="plus"></i>Add New
                            </a>
                        </form>
                    </div>

                    <div class="table-responsive table-product">
                        <table class="table all-package theme-table" id="table_id">
                            <thead>
                            <tr>
                                <th>Agent Logo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Cell Phone</th>
                                <th>Address</th>
                                <th>Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($agents as $agent)
                                <tr>
                                    <td>
                                        <div class="table-image">
                                            <img
                                                src="{{ $agent->photo? asset('storage/'.$agent->photo): asset('no-media.png') }}"
                                                class="img-fluid"
                                                alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-name">
                                            <span>{{ $agent->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ $agent->tel }}</td>
                                    <td>{{ $agent->cell }}</td>
                                    <td>{{ $agent->agent_address }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a href="{{route('agents.edit' ,[$agent->id ])}}">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#exampleModalToggle{{ $agent->id }}">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>


                                <!-- Delete Modal Box Start -->
                                <div class="modal fade theme-modal remove-coupon"
                                     id="exampleModalToggle{{ $agent->id }}" aria-hidden="true" tabindex="-1">
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
                                                        data-bs-dismiss="modal">No
                                                </button>
                                                <a type="a" class="btn btn-animation btn-md fw-bold"
                                                   href="{{ route('agents.delete',[$agent->id]) }}">Yes</a>
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
