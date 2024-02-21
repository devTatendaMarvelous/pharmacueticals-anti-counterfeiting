<x-dashboard>
     <div class="row">
          <div class="col-12">
               <div class="row">
                    <div class="col-sm-8 m-auto">
                         <div class="card">
                              <form action="{{ route('agents.update',[$agent->id]) }}" method="POST">
                                   @csrf
                                   <div class="card-body">
                                        <div class="title-header option-title">
                                             <h5>Edit Pharmacy</h5>
                                        </div>
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                             <li class="nav-item" role="presentation">
                                                  <button class="nav-link active" id="pills-home-tab"
                                                       data-bs-toggle="pill" data-bs-target="#pills-home"
                                                       type="button">Account</button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                  <button class="nav-link" id="pills-profile-tab"
                                                       data-bs-toggle="pill" data-bs-target="#pills-profile"
                                                       type="button">Agent Details</button>
                                             </li>
                                        </ul>

                                        <div class="tab-content" id="pills-tabContent">
                                             <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                                  <div class="theme-form theme-form-2 mega-form">
                                                       <div class="card-header-1">
                                                       <h5>Pharmacy Account</h5>
                                                       </div>

                                                       <div class="row">
                                                       <div class="mb-4 row align-items-center">
                                                            <label
                                                                 class="form-label-title col-lg-2 col-md-3 mb-0">
                                                                 Name</label>
                                                            <div class="col-md-9 col-lg-10">
                                                                 <input class="form-control" name="name" value="{{ $agent->name }}"type="text" required>
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
                                                                 <input class="form-control" name="email" value="{{ $agent->email }}" type="email" required>
                                                                 @error('email')
                                                                 <p class="text-danger">{{ $message }}</p>
                                                                 @enderror
                                                            </div>
                                                       </div>
                                                       </div>

                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                                                  <div class="card-header-1">
                                                       <h5>Pharmacy Details</h5>
                                                  </div>
                                                  <div class="row align-items-center">
                                                       <label
                                                            class="col-lg-2 col-md-3 col-form-label form-label-title">Telephone Number</label>
                                                       <div class="col-md-9 col-lg-10">
                                                            <input class="form-control" name="tel" type="number" min="10" value="{{ $agent->tel }}"required>
                                                       </div>
                                                  </div>
                                                  <div class="mb-4 row align-items-center">
                                                       <label
                                                            class="col-lg-2 col-md-3 col-form-label form-label-title">Cell Phone</label>
                                                       <div class="col-md-9 col-lg-10">
                                                            <input class="form-control" name="cell" type="number" min="10" value="{{ $agent->cell }}" required>
                                                       </div>
                                                  </div>

                                                  <div class="mb-4 row align-items-center">
                                                       <label
                                                            class="col-lg-2 col-md-3 col-form-label form-label-title">Address</label>
                                                       <div class="col-md-9 col-lg-10">
                                                            <textarea name="agent_address" id="" cols="30" rows="4" class="form-control">{{ $agent->agent_address }}
                                                            </textarea>
                                                            @error('agent_address')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                       </div>
                                                  </div>
                                                  <div class="mb-4 row align-items-center">
                                                       <label
                                                            class="col-lg-2 col-md-3 col-form-label form-label-title">Description</label>
                                                       <div class="col-md-9 col-lg-10">
                                                            <textarea name="agent_description" id="" cols="30" rows="4" class="form-control">{{ $agent->agent_description }}</textarea>
                                                            @error('agent_description')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                       </div>
                                                  </div>
                                                 <div class="mb-4 row align-items-center">
                                                     <label
                                                         class="col-lg-2 col-md-3 col-form-label form-label-title">Blockchain Address</label>
                                                     <div class="col-md-9 col-lg-10">
                                                         <input name="blockchain_address" id=""  class="form-control" value="{{ $agent->blockchain_address }}"/>
                                                         @error('blockchain_address')
                                                         <p class="text-danger">{{ $message }}</p>
                                                         @enderror
                                                     </div>
                                                 </div>
                                                 <div class="mb-4 row align-items-center">
                                                     <label
                                                         class="col-lg-2 col-md-3 col-form-label form-label-title">Blockchain Private Key</label>
                                                     <div class="col-md-9 col-lg-10">
                                                         <input name="blockchain_private_key"  class="form-control" value="{{ $agent->blockchain_private_key }}"/>
                                                         @error('blockchain_private_key')
                                                         <p class="text-danger">{{ $message }}</p>
                                                         @enderror
                                                     </div>
                                                 </div>
                                                  <div class="mb-4 row align-items-center">
                                                       <div class="col-md-9 col-lg-10">
                                                            <div class="col-md-6"></div>
                                                            <input type="submit" class="btn btn-primary" value="Update Agent">
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
