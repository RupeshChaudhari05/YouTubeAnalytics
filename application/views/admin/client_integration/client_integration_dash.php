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
                  Data cleaning process
               </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
               <div class="btn-list">
                  <lable style='color:red;'>  Is Comapny Selected : <?php if(isset($this->session->userdata()['COM_ID'])){ echo 'Yes '.$this->session->userdata()['COM_ID']; }else{echo "false";} ?></lable>
               </div>
            </div>
         </div>
      </div>
   </div>


<div class="page-body">
      <div class="container-xl">
         <div class="row row-deck row-cards">
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-body">
                     <h3 class="card-title"></h3>

 <div class="box-body table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Process Name</th>
                           <th>Status</th>
                           <th>DateRange</th>
                           <th>Setting</th>
                           <th>-</th>
                        </tr>
                     </thead>
                     <?php 
                        $arrayName = array(
                         "Upload Excel",
                         "Cleansing" ,
                         "Out of Range",
                         "All Field Duplicates",
                         "Invoice Amount",
                        "Date Normalization",
                         "Spend Normalization"
                        );
                        
                        foreach ($arrayName as $key => $value) {  ?>
                     <tr>
                        <td><?php echo $value; ?></td>
                        <td>Not Completed</td>
                        <td>
                            <?php if($value=="Upload Excel"){ ?>
                            <form method="post" action="<?= base_url('DataProcess/uploadMasterFile') ?>" enctype="multipart/form-data">   
                           <div class="form-group">
                           
                           
                  <label class="form-label">From Date</label>
                            <div class="input-icon mb-2">
                              <input class="form-control " placeholder="Select a date" id="datepicker-icon" name='start' value="<?php echo date('Y-m-d'); ?>"/>
                              <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                              </span>
                            </div>
                          
                  <label class="form-label">To Date</label>
                            <div class="input-icon mb-2">
                              <input class="form-control " placeholder="Select a date" id="datepicker-icon1"  name='end'  value="<?php echo date('Y-m-d'); ?>"/>
                              <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                              </span>
                            </div>

                        
                        </div>
                           <?php } ?>
                        </td>
                        <td><span cass=""><i class="fa fa-cog" aria-hidden="true"></i></i></span></td>
                        <td>
                           <?php if($value=="Upload Excel"){ ?>

                         <div class="mb-3">
                            <div class="form-label">Custom File Input</div>
                            <input type="file" class="form-control" name="excel_file" required>
                          </div>
<!--                           
                              <div class="form-group">
                                 <label for="excel_file">Choose Excel File:</label>
                                 <input type="file" name="excel_file" class="form-control" required>
                              </div> -->
                              <button type="submit" class="btn btn-primary">Upload and Save</button>
                           </form>
                           <?php } ?>
                        </td>
                     </tr>
                     <?php    }  ?>
                  </table>
               </div>





</div>
</div>
</div>
</div>
</div>
</div>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('datepicker-icon'),
    		buttonText: {
    			previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
    			nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
    		},
    	}));

      window.Litepicker && (new Litepicker({
    		element: document.getElementById('datepicker-icon1'),
    		buttonText: {
    			previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
    			nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
    		},
    	}));



    });
    // @formatter:on
  </script>