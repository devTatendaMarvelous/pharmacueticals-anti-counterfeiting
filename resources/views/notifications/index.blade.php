<x-dashboard>
            
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>All notifications</h5>
                                        <form class="d-inline-flex">
                                            <a href="{{ route('notifications.create') }}" class="align-items-center btn btn-theme d-flex">
                                                <i data-feather="plus"></i>Add New
                                            </a>
                                        </form>
                                    </div>

                                    <div class="table-responsive table-notification">
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>Notification</th>
                                                 
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                             @forelse ($notifications as $notification)
                                                  <tr >
                                                    
                                                    <td >{{ $notification-> notification}}</td>

                                                    <td>
                                                        <ul>
                                                             @if( $notification->is_published===0 )
                                                                        
                                                                        <li>
                                                                            <a href="{{ route('notifications.publish',[$notification->id]) }}" class="btn btn-primary">
                                                                                Publish
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                     @if( $notification->is_published===1 )
                                                                        <li>
                                                                            <a href="{{ route('notifications.unpublish',[$notification->id]) }}" class="btn btn-secondary">
                                                                                UnPublish
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                            <li>
                                                                <a href="javascript:void(0)">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="javascript:void(0)">
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalToggle{{ $notification->id }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <!-- Delete Modal Box Start -->
                                                  <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle{{ $notification->id }}" aria-hidden="true" tabindex="-1">
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