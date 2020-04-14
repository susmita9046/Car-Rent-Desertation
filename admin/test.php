<div id="mid-content">
    <div class="container">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="bike" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card" style="padding:20px;">
                        <div class="top">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link ser-link" href="adminaddcar.php"><i class="fas fas fa-car"></i>&nbsp; Add Car  </a>
                                </li>
                                <li>
                                    
                                </li>
                            </ul></div>
                            <br><br>
                            <!-- search  -->
                            <div class=" col-md-5 form-group ml-auto">
                 <input class="form-control" id="myInput" type="text" placeholder="Search..">
             </div>
                            <table class="table table-hover" data-ride="datatables" id="users-table">
                                <thead>
                                <tr class="text-info">
                                    <th>ID</th>
                                    <th>Brand</th>
                                    <th>plate no</th>
                                    <th>Model</th>
                                    <th>StartedDate</th>
                                    <th>EndDate</th>
                                    <th>Cost</th>
                                    <th>Status</th>
                                    <th>Rented BY</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                               
                                 <tbody id="myTable">

                                    
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                       
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="text-info not" data-toggle="modal" data-target="#edit_bike">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                         <a href="" class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="tab-pane fade show ">            

                        
                    </div>
                    <div class="tab-pane fade show ">
                        <div class="card" style="padding:20px;">
                            <div class="top">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link ser-link" href=""><i class="fas fa-newspaper"></i>&nbsp; Enquiry  </a>
                                    </li>
                                </ul>
                                </div>
                                <br><br>
                                <!--  <div class = " col-md-5 form-group ml-auto">
                 <input class="form-control" id="myInput" type="text" placeholder="Search..">
             </div> -->
                            <table class="table table-hover">
                                <thead>
                                <tr class="text-info">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr></tbody>
                            </table>
                            </div>
                        </div>

                          <div class="tab-pane  fade show " id="user" role="tabpanel" aria-labelledby="contact-tab">            

                        <div class="card" style="padding:40px;">

                             <div class="top">
                            <ul class="nav nav-tabs" id="" role="">
                                <li class="nav-item">
                                    <a class="nav-link" href="adduser.php"><i class="fas fas fa-car"></i>&nbsp; Add User  </a>
                                </li>
                                <li>
                                    
                                </li>
                            </ul></div>
                           
                            
                            <br><br>
                            <div class=" col-md-5 form-group ml-auto">
                 <input class="form-control" id="myInput" type="text" placeholder="Search..">
             </div>
                            <table class="table table-hover">
                                <tbody><tr class="text-info">
                                    <th>ID</th>
                                    <th>username</th>
                                    <th>email</th>
                                    <th>password</th>
                                    <th>type</th>
                                   
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                   
                                   
                                    <td>
                                       <a href="" cl="" ass="btn btn-sm btn-icon btn-danger"><i class="fa fa-edit"></i></a>
                                        <button class="text-danger not" data-toggle="modal" data-target="#del_bike">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                            </tbody></table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>