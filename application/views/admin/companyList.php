<div class="page-wrapper">
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
               Overview
            </div>
            <h2 class="page-title">
               CompanyList
            </h2>
         </div>
         <!-- Page title actions -->
         <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
               <span class="d-none d-sm-inline">
               <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasEnd" role="button" aria-controls="offcanvasEnd">
               Toggle end offcanvas
               </a>
               <a href="#" class="btn">
               New view
               </a>
               </span>
               <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                     <path d="M12 5l0 14" />
                     <path d="M5 12l14 0" />
                  </svg>
                  Create new report
               </a>
               <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                     <path d="M12 5l0 14" />
                     <path d="M5 12l14 0" />
                  </svg>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page body -->
<div class="page-body">
   <div class="container-xl">
      <div class="row">
         <div class="col-md-12">
            <div class="card mb-3">
               <div class="card-body">
                  <div class="row">
                     <form action="<?php echo base_url()?>admin/updateCompany" method="POST" enctype="multipart/form-data" >
                        <div class="container-xl">
                           <h4 class='ps-10'>Ragister Comapany Details</h4>
                           <div class="row">
                              <!-- First Column -->
                              <div class="col-md-5 mb-3">
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <label class="col-sm-12 form-label">Comapny Name</label>
                                       <input name="company_name" class="form-control" type="text" value="<?php if(isset($companyDetail->CompanyName)){echo $companyDetail->CompanyName;} ?>">
                                    </div>
                                 </div>
                              </div>
                              <!-- Second Column -->
                              <div class="col-md-5 mb-3">
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <label class="col-sm-12 form-label">Ragister User Name</label>
                                       <input name="name" class="form-control" type="text" value="<?php if(isset($companyDetail->FirstName)){echo $companyDetail->FirstName;} ?>">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <!-- First Column -->
                              <div class="col-md-5 mb-3">
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <label class="col-sm-12 form-label">Email</label>
                                       <input name="email" class="form-control" type="email" value="<?php if(isset($companyDetail->Email)){echo $companyDetail->Email;} ?>">
                                    </div>
                                 </div>
                              </div>
                              <!-- Second Column -->
                              <div class="col-md-5 mb-3">
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <label class="col-sm-12 form-label">Ragistration Date</label>
                                       <input name="r_date" class="form-control" type="date" value="<?php if(isset($companyDetail->date_of_rag)){echo $companyDetail->date_of_rag;} ?>">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <!-- First Column -->
                              <div class="col-md-5 mb-3">
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <label class="col-sm-12 form-label">Comapny Logo</label>
                                       <input name="image" class="form-control" type="file">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-5 mb-3">
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <label class="col-sm-12 form-label">Logo</label>
                                       <img src='<?php if(isset($companyDetail->logo)){echo $companyDetail->logo;} ?>' width='100' height='100' />
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="col-md-2">
                              <div class="form-group"><button type="submit" class="btn btn-success pull-left" name="form1">Update</button></div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="card mb-3">
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example1" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                           <tr>
                              <th>SL</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Company Name</th>
                              <th>Logo</th>
                              <th>Date of Ragistation</th>
                              <!--   <th>Position</th> -->
                              <th width="140">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php  foreach ($list as $key => $value){ ?>
                           <tr>
                              <td><?php echo $value['ID']; ?></td>
                              <td><?php echo $value['FirstName']; ?></td>
                              <td><?php echo $value['Email']; ?></td>
                              <td><?php echo $value['CompanyName']; ?></td>
                              <td style="width:150px;"><img src="<?php echo $value['logo']; ?>" alt="Logo" style="width:140px;"></td>
                              <td><?php echo $value['date_of_rag']; ?></td>
                              <td>                    
                                 <a href="<?php echo base_url(); ?>admin/edit_slider/" class="btn btn-primary btn-xs">Edit</a>
                                 <a href="<?php echo base_url(); ?>admin/delete_slider/" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>
                              </td>
                           </tr>
                           <?php } ?>                            
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php 
   //print_r(getcwd());
   //print_r(__DIR__); ?>