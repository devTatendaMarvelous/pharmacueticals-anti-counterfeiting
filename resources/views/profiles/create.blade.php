<x-dashboard>

     <div class="row">
          <div class="col-12">
               <div class="row">
                    <div class="col-sm-12">
                         <!-- Details Start -->
                         <div class="card">
                         <div class="card-body">
                              <div class="title-header option-title">
                                   <h5>Create Client Profile </h5>
                              </div>
                              <form class="theme-form theme-form-2 mega-form" action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
                                   <div class="row">
                                        @csrf
                                        
                                        <div class="mb-4 row align-items-center">
                                             <label class="form-label-title col-sm-2 mb-0" >Your Phone
                                             Number</label>
                                             <div class="col-sm-10">
                                             <input class="form-control" name="client_phone" type="number"
                                                  placeholder="Enter Your Number">
                                             </div>
                                        </div>

                                        

                                        <div class="mb-4 row align-items-center">
                                             <label
                                             class="col-sm-2 col-form-label form-label-title">Photo  (Optional)</label>
                                             <div class="col-sm-10">
                                                  <input class="form-control form-choose" name="photo" type="file"
                                                  id="formFileMultiple" >
                                             </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                             <label
                                             class="col-sm-2 col-form-label form-label-title">Home Address</label>
                                             <div class="col-sm-10">
                                             <textarea name="home_address" id="" cols="30" rows="5" class="form-control"></textarea>
                                             </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                             <label
                                             class="col-sm-2 col-form-label form-label-title">Offce Address</label>
                                             <div class="col-sm-10">
                                             <textarea name="office_address" id="" cols="30" rows="5" class="form-control"></textarea>
                                             </div>
                                        </div>
                                        <div class="mb-4 row align-items-center">
                                             <label
                                             class="col-sm-2 col-form-label form-label-title"></label>
                                             <div class="col-sm-10">
                                             <input type="submit" value="Create" class="btn btn-primary col-8">
                                             </div>
                                        </div>

                                       
                                   </div>
                              </form>
                         </div>
                         </div>
                         <!-- Details End -->

                         
                    </div>
               </div>
          </div>
     </div>
     <!-- Settings Section End -->
</x-dashboard>