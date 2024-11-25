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
                  Comapny Ragister Stap 1
               </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
               <div class="btn-list">
                  <?php 
                     $url = $isTableCreate ? base_url('admin/midProcess') : '#';
                     ?>
                  <a href="<?php echo$url; ?>" class="btn btn-primary d-none d-sm-inline-block" <?php if($isTableCreate){ echo "";}else{echo"disabled";} ?>>
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-right-lines" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 9v-3.586a1 1 0 0 1 1.707 -.707l6.586 6.586a1 1 0 0 1 0 1.414l-6.586 6.586a1 1 0 0 1 -1.707 -.707v-3.586h-3v-6h3z" />
                        <path d="M3 9v6" />
                        <path d="M6 9v6" />
                     </svg>
                     Stap 2   
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
                        <?php
                        $visible = 'hidden';
                        if(isset($this->session->userdata()['COM_ID'])){
                           $visible = 'visible';
                        }
                        ?>
                     <style>
                        .showTheData{
                        visibility:<?php echo $visible; ?>
                        }
                     </style>
   <!-- Page body -->
   <div class="page-body">
      <div class="container-xl">
         <div class="row row-deck row-cards">
            <div class="col-sm-9 col-lg-9">
               <div class="card">
                  <div class="card-body">
                     <h3 class="card-title">Select comapny for process</h3>
                     <div class="mb-3 col-md-6 ">
                        <select type="text" class="form-select" id="selectedValue" value="">
                        <?php
                           if (empty($list)) {
                                 echo '<option value="">No records found</option>';
                              } else {
                              foreach ($list as $key => $value) {
                                  echo '<option value="' . $value['ID'] . '">' . $value['CompanyName'] . '</option>';//disabled
                              }
                           
                           }
                              ?>
                        </select>
                     </div>
                     <label class="form-label">Is Comapny Selected : <?php if(isset($this->session->userdata()['COM_ID'])){ echo 'Yes '.$this->session->userdata()['COM_ID']; }else{echo "false";} ?></label>
                     <div class="col-md-2">
                        <div class="form-group"><button type="button" id="setSessionButton" class="btn btn-success pull-left" name="form2">Update Session</button></div>
                     </div>

                     <div class="row showTheData container-xl">
                        <div class="hr-text">See also</div>
                        <div class="col-md-3">
                           <form action='<?php echo base_url(); ?>admin/uploadSampleFile' enctype="multipart/form-data" method='POST'>
                              <div class="row">
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <h4 class='ps-10'>Upload Sample File</h4>
                                       <input type='file' name='sample_file' />
                                    </div>
                                 </div>
                              </div>
                              <br>
                              <div class="col-md-12">
                                 <div class="form-group"><button type="submit" class="btn btn-success pull-left" name="form2">Upload</button></div>
                              </div>
                           </form>
                        </div>
                        <div class="col-md-9">
                           <div class="table-responsive">
                              <table class="table card-table table-vcenter text-nowrap datatable small-table-font-size" >
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>SetMasterTableColoumn</th>
                                       <th>MasterTable</th>
                                       <th>Client Headers</th>
                                       <th>DataType</th>
                                       <th>Set Main Date</th>
                                    </tr>
                                 </thead>
                                 <?php 
                                    if (is_array($mappedData) || is_object($mappedData)) {
                                       foreach ($mappedData as $key => $value) {  ?>
                                 <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <td><?php 
                                       if($value['mastertable']!="" || $value['mastertable']!=null) {echo $value['mastertable']; }else{ 
                                                   echo '
                                                      <select name="master_column" class="form-control select2">';
                                                   foreach ($mastercolumnlist as $key1 => $value1) {
                                                      echo '<option value="' . $value1 . '">' . $value1 . '</option>';
                                                   }
                                                   echo '
                                                      </select>';
                                       }
                                       
                                       ?></td>
                                    <td><?php echo $value['mastertable'];
                                       ?></td>
                                    <td><?php echo $value['Process_column']; ?></td>
                                    <td><?php echo $value['client_DataType']; ?></td>
                                    <td>
                                       <?php 
                                          if(strtoupper($value['client_DataType'])=="DATE"){
                                             if($value['useforDateFilter']=="YES"){
                                                echo"This key use for date process";
                                             }else{
                                             echo "<form action='".base_url()."admin/setDateType' method='POST'>
                                             <input type='hidden' name='value' value='".$value['id']."'/>
                                             <button type='submit' class='btn btn-success  btn-sm' >Set</button>
                                             </form>";
                                             }
                                          }
                                          ?>
                                    </td>
                                 </tr>
                                 <?php    } }else{ 
                                    echo '<tr><td colspan="3">No data found</td></tr>';
                                    } ?>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- section 2 -->
            </div>
            <div class="col-sm-6 col-lg-3">
               <div class="card">
                  <div class="card-body">
                     <h3 class="card-title">Steps To exicutes</h3>
                     <ul class="steps steps-vertical">
                        <li class="step-item">
                           <div class="h4 m-0">Step 1</div>
                           <div class="text-muted">Select Company and Update Excel Column and data type.</div>
                        </li>
                        <li class="step-item">
                           <div class="h4 m-0">Step 2</div>
                           <div class="text-muted">Mapp the Data with our Master Table Column</div>
                        </li>
                        <li class="step-item">
                           <div class="h4 m-0">Stap 3</div>
                           <div class="text-muted">Mapp the Data To mapping file</div>
                        </li>
                        <li class="step-item active">
                           <div class="h4 m-0">Step 4</div>
                           <div class="text-muted">Finalize step to create table we can to go back if ou created if need to go back delete the both table.</div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container-xl showTheData">
   <div class="hr-text">See also</div>
   <div class="card">
      <div class="card-body">
         <div class="row showTheData">
            <form action="<?php echo base_url()?>admin/updateColumn" method="POST" >
               <div class="container showTheData">
                  <h4 class='ps-10'>Map Your Master table with Excel</h4>
                  <br>
                  <div class="row">
                     <!-- First Column -->
                     <div class="col-md-5">
                        <div class="form-group">
                           <div class="col-sm-12">
                              <label class="col-sm-12 form-label">Master table</label>
                              <select name="master_column" class="form-select js-example-basic-single">
                              <?php
                                 if (empty($mastercolumnlist)) {
                                       echo '<option value="">No records found</option>';
                                    } else {
                                    foreach ($mastercolumnlist as $key => $value) {
                                        echo '<option value="' . $value . '">' . $value . '</option>';//disabled
                                    }
                                 
                                 }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- Second Column -->
                     <div class="col-md-5">
                        <div class="form-group">
                           <div class="col-sm-12">
                              <label class="col-sm-12 form-label">Excel Column</label>
                              <!-- <input name="excel_names" class="form-control" type="text"> -->
                              <select name="excel_names" class="form-select js-example-basic-single">
                              <?php
                                 if (empty($mappedData)) {
                                       echo '<option value="">No records found</option>';
                                    } else {
                                    foreach ($mappedData as $key2 => $value2) {
                                        echo '<option value="' . $value2['Process_column'] . '">' . $value2['excel_column'] . '</option>';//disabled
                                    }
                                 
                                 }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <br>
                  <div class="col-md-2">
                     <div class="form-group"><button type="submit" class="btn btn-success pull-left" name="form1"   <?php if($isTableCreate){ echo "disabled";} ?>>Update</button></div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="container-xl showTheData">
    <div class="hr-text">See also</div>
   <div class="card">
      <div class="card-body">
         <div class="row">
               <form action='<?php echo base_url(); ?>admin/uploadMappingFile' enctype="multipart/form-data" method='POST'>
                              <div class="row">
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <h4 class='ps-10'>Upload Mapping File</h4>
                                       <input type='file' name='mapping_file' />
                                    </div>
                                 </div>
                              </div>
                              <br>
                              <div class="col-md-12">
                                 <div class="form-group"><button type="submit" class="btn btn-success pull-left" name="form2">Upload</button></div>
                              </div>
                           </form>
         </div>
      </div>
   </div>
</div>

<div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Scrollable modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
          </div>
        </div>
      </div>
    </div>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-scrollable">
                    Scrollable modal
                  </a>
<!-- <div class="container-xl showTheData">
   <div class="hr-text">See also</div>
   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="showTheData">
               <div class='col-md-12'>
                  <table class="table small-table-font-size">
                     <thead>
                        <tr>
                           <th>Master Table</th>
                           <th>Excel Columns</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <?php 
                        if (empty($mappedData)) {
                              echo '<tr><td colspan="3">No mapped data found</td></tr>';
                           } else {
                        foreach ($mappedData as $key => $value) {  ?>
                     <tr>
                        <td><?php echo $value['mastertable']; ?></td>
                        <td><?php echo $value['excel_column']; ?></td>
                        <td> <?php if(!$isTableCreate){ ?><span cass="flot-right" onClick="deleteItem(<?php echo $value['id']; ?>)" ><i class="fa fa-trash" aria-hidden="true"></i></span><?php } ?></td>
                     </tr>
                     <?php    } } ?>
                  </table>
               </div>
            </div>
            <div class="showTheData">
               <div class="col-md-2">
                  <div class="form-group">
                     <?php if (!empty($mappedData)) { ?>
                     <button type="button" class="btn btn-success pull-left" id="process" name="form1new"  <?php if($isTableCreate){ echo "disabled";} ?>>Process Client table</button>
                     <?php } ?>
                  </div>
               </div>
               
               <br>
               <span style='color:red;'> <?php if($isTableCreate){ echo "Client Table was created so button disabled";} ?></span>
            </div>
         </div>
      </div>
   </div>
</div> -->
<script>
   // @formatter:off
   document.addEventListener("DOMContentLoaded", function () {
   	var el;
   	window.TomSelect && (new TomSelect(el = document.getElementById('select-users'), {
   		copyClassesToDropdown: false,
   		dropdownParent: 'body',
   		controlInput: '<input>',
   		render:{
   			item: function(data,escape) {
   				if( data.customProperties ){
   					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
   				}
   				return '<div>' + escape(data.text) + '</div>';
   			},
   			option: function(data,escape){
   				if( data.customProperties ){
   					return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
   				}
   				return '<div>' + escape(data.text) + '</div>';
   			},
   		},
   	}));
   });
   // @formatter:on
</script>
<script>
   $(document).ready(function(){
    
     // Add click event listener to the button with ID "process"
     $('#process').click(function(event){
       event.preventDefault(); // Prevent the default button click behavior
       // Call your API endpoint here
       $.ajax({
         url: '<?php echo base_url(); ?>admin/createNewTable', // Replace with your API endpoint URL
         method: 'GET', // Change the HTTP method if needed
         success: function(response){
           // Handle successful API call
           console.log('API call successful');
           console.log(response); // Log the API response
           alert('Table created successful'); // Show a success message
           location.reload();
         },
         error: function(xhr, status, error){
           // Handle API call errors
           console.error('API call failed');
           console.error(xhr.responseText); // Log the error response
           alert('API call failed. Please try again.'); // Show an error message
         }
       });
     });
   });
   
   
   function deleteItem(id) {
      // Make an AJAX call to the deleteMappingData endpoint
      $.ajax({
         url: '<?php echo base_url(); ?>admin/deleteMppingData', // Endpoint URL
         type: 'POST', // Use POST method
         data: { id: id }, // Send the ID as data
         success: function(response) {
               // Handle success response here
               console.log(response);
               // Reload the page or update the UI as needed
               location.reload(); // Example: reload the page after successful deletion
         },
         error: function(xhr, status, error) {
               // Handle error response here
               console.error(xhr.responseText);
         }
      });
   }
   
   
   $(document).ready(function() {
      $("#setSessionButton").click(function() {
         var selectedValue = $("#selectedValue").val();
         $.ajax({
               url: "<?php echo base_url('admin/set_session_data'); ?>",
               data: { selectedValue: selectedValue },
               method: "POST",
               success: function(data) {
                  alert(data); // Alert response message
                  location.reload(); 
               }
         });
      });
   });

   $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
   
</script>


