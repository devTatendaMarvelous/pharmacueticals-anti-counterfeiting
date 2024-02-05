<x-dashboard>
     <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-8 m-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header-2">
                                                <h5>Category Information</h5>
                                            </div>

                                            <form class="theme-form theme-form-2 mega-form" action="{{ route('notifications.store') }}" method="POST">
                                                  @csrf
                                                
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-3 mb-0">Notification</label>
                                                    <div class="col-sm-9">
                                                       <textarea name="notification" class="form-control" type="text"
                                                            placeholder="Category Description" id="" cols="30" rows="10"></textarea>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Create" class="btn btn-primary">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                         function updatIcon(icon){
                              
                              const iconInput=document.querySelector('#icon'),
                              btnIcon=document.querySelector('#dropdownMenuButton1')
                              btnIcon.innerHTML=icon
                              iconInput.value=icon
                              console.log(btnIcon);
                         }
                    </script>
</x-dashboard>