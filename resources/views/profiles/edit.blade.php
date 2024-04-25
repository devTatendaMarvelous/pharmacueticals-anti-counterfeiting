<x-dashboard>

     <div class="row">
          <div class="col-12">
               <div class="row">
                    <div class="col-sm-12">
                         <!-- Details Start -->
                         <div class="card">
                         <div class="card-body">
                              <div class="title-header option-title">
                                   <h5>Profile Setting</h5>
                              </div>
                              <form class="theme-form theme-form-2 mega-form">
                                   <div class="row">
                                        <div class="mb-4 row align-items-center">
                                             <label class="form-label-title col-sm-2 mb-0">Full Name</label>
                                             <div class="col-sm-10">
                                             <input class="form-control" type="text" name="name"
                                                  placeholder="Enter Your Full Name">
                                             </div>
                                        </div>


                                        <div class="mb-4 row align-items-center">
                                             <label class="form-label-title col-sm-2 mb-0" name="client_name">Your Phone
                                             Number</label>
                                             <div class="col-sm-10">
                                             <input class="form-control" type="number"
                                                  placeholder="Enter Your Number">
                                             </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                             <label class="form-label-title col-sm-2 mb-0">Enter Email
                                             Address</label>
                                             <div class="col-sm-10">
                                             <input class="form-control" type="email"
                                                  placeholder="Enter Your Email Address">
                                             </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                             <label
                                             class="col-sm-2 col-form-label form-label-title">Photo</label>
                                             <div class="col-sm-10">
                                             <input class="form-control form-choose" type="file"
                                                  id="formFileMultiple" multiple>
                                             </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                             <label class="form-label-title col-sm-2 mb-0">Password</label>
                                             <div class="col-sm-10">
                                             <input class="form-control" type="password"
                                                  placeholder="Enter Your Password" onkeyup="checkPass()"  id="passwordInput">
                                                 <p  id="passwordMessage" class="text-danger" style="display: none;" >Password must have a number, Uppercase and a special  character</p>
                                             </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                             <label class="form-label-title col-sm-2 mb-0">Confirm
                                             Password</label>
                                             <div class="col-sm-10">
                                             <input class="form-control" type="password"
                                                  placeholder="Enter Your Confirm Password" onkeyup="checkPass(2)"  id="passwordInput2">
                                                 <p  id="passwordMessage2" class="text-danger" style="display: none;" >Password must have a number, Uppercase and a special  character</p>
                                             </div>
                                        </div>
                                       <div class="mb-4 row align-items-center">
                                           <div class="col-md-9 col-lg-10">
                                               <div class="col-md-6"></div>
                                               <input type="submit"  id="btn-submit" class="btn btn-primary" value="Create" style="display: none;">
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
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script>

        function checkPass(num=''){

            let password = $(`#passwordInput${num}`).val();

            const isValid = validatePassword(password);

            if (isValid) {
                $(`#passwordMessage${num}`).hide();

                $(`#btn-submit`).show();
            } else {
                $(`#btn-submit`).hide();
                $(`#passwordMessage${num}`).show();
            }
        }

        function validatePassword(password) {
            console.log(password)
            let isValid = true;
            if (password.length < 8 ||
                !/[a-z]/.test(password) ||
                !/[A-Z]/.test(password) ||
                !/\d/.test(password) ||
                !/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password)) {
                isValid = false;

            }

            return isValid;
        }

    </script>
     <!-- Settings Section End -->
</x-dashboard>
