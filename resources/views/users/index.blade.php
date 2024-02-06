<x-dashboard>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>All Users</h5>
                                    </div>
                                    <div class="table-responsive table-product">
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th sty>Role</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @forelse ($users as $user)
                                                  <tr>
                                                    <td>
                                                        <div class="table-image">
                                                            <img src="{{ $user->photo? asset('storage/'.$user->photo): asset('no-media.png') }}" class="img-fluid"
                                                                alt="">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="user-name">
                                                            <span>{{ $user->name }}</span>
                                                        </div>
                                                    </td>

                                                    <td>{{ $user->email }}</td>

                                                    <td style="text-align:center;">{{ $user->type }}</td>


                                                </tr>

                                                <!-- Delete Modal Box Start -->
                                                  <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle{{ $user->id }}" aria-hidden="true" tabindex="-1">
                                                       <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content text-center">
                                                                 <div class="modal-header d-block text-center">
                                                                      <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                      <i class="fas fa-times"></i>
                                                                      </button>
                                                                 </div>

                                                                 <div class="modal-footer">
                                                                      <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                                                                      <a type="a" class="btn btn-animation btn-md fw-bold" href="">Yes</a>
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
