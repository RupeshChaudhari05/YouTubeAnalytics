<div class="page-wrapper">
<!-- Page header -->
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
               Overview
            </div>
            <h2 class="page-title">
               All Reports
            </h2>
         </div>
         <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
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
<!-- <div class="hr-text">See also</div> -->
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">New report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-13">
                  <div class="mb-3">
                     <label class="form-label">Youtube url</label>
                     <div class="input-group input-group-flat">
                        <span class="input-group-text">
                        </span>
                        <input type="text" class="form-control ps-0" id='vurl' value="" autocomplete="off" placeholder='https://www.youtube.com/watch?v=ubj4qsvxRo0&ab_channel=TotalGaming'>
                     </div>
                      <div id="url-help-text" class="form-text text-muted mt-2">
                        Please provide the URL of your YouTube video. We will compare it with your competitor's video and provide an analysis.
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id='submitButton'>
               <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M12 5l0 14" />
                  <path d="M5 12l14 0" />
               </svg>
               Create new report
            </a>
         </div>
      </div>
   </div>
</div>
<div class='page-body'>
   <div class='container-xl'>
      <div class='row row-cards'>

  <?php if (empty($projects)): ?>
    <!-- Display a message when no data is available -->
    <div class="col-12">
        <p class="text-center text-muted">No projects available at the moment.</p>
    </div>
  <?php else: ?>

         <?php foreach ($projects as $project): ?>
         <div class="col-sm-6 col-lg-4">
            <div class="card card-sm">
               <a href="<?php echo base_url('Website/analytics/'.$project['id']); ?>" class="d-block">
                  <!-- Display the project thumbnail image -->
                  <img src="<?php echo $project['project_thumb_maxres']; ?>" class="card-img-top" alt="Project Image">
               </a>
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <span class="avatar me-3 rounded" style="background-image: url(<?php echo $project['project_channel_logo']; ?>)"></span>
                     <div>
                        <div><?php echo $project['project_owner']; ?></div>
                        <div class="text-muted"><?php echo time_ago($project['created_at']); ?> ago</div>
                     </div>
                     <div class="ms-auto">
                        <a href="#" class="text-muted">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                              <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                           </svg>
                           <?php echo formatNumber($project['project_views']); ?>
                        </a>
                        <a href="#" class="ms-3 text-muted">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                           </svg>
                           <?php echo formatNumber($project['project_likes']); ?>
                        </a>
                        <a href="#" class="ms-3 text-muted">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M5.821 4.91c3.898 -2.765 9.469 -2.539 13.073 .536c3.667 3.127 4.168 8.238 1.152 11.897c-2.842 3.447 -7.965 4.583 -12.231 2.805l-.232 -.101l-4.375 .931l-.075 .013l-.11 .009l-.113 -.004l-.044 -.005l-.11 -.02l-.105 -.034l-.1 -.044l-.076 -.042l-.108 -.077l-.081 -.074l-.073 -.083l-.053 -.075l-.065 -.115l-.042 -.106l-.031 -.113l-.013 -.075l-.009 -.11l.004 -.113l.005 -.044l.02 -.11l.022 -.072l1.15 -3.451l-.022 -.036c-2.21 -3.747 -1.209 -8.392 2.411 -11.118l.23 -.168z" stroke-width="0" fill="currentColor" />
                           </svg>
                           <?php echo formatNumber($project['project_comments']); ?>
                        </a>
                     </div>
                  </div>
                  <!-- Display project details -->
                  <h5 class="card-title"><?php echo $project['project_name']; ?></h5>
                  <p class="card-text"><?php //echo $project['project_desc']; ?></p>
                  <small class="text-muted"><?php 
                     // Assuming $project['project_tags'] contains a comma-separated string of tags
                     $tags = explode(',', $project['project_tags']); // Split the string into an array
                     
                     // Loop through the array and display each tag
                     foreach ($tags as $tag) {
                     // Optionally, trim whitespace if there are extra spaces
                     $tag = trim($tag);
                     echo "<span class='badge badge-outline text-red'>$tag</span> "; // Wrap each tag in a <span> or any HTML element you prefer
                     }
                     
                     
                     ?></small>
               </div>
            </div>
         </div>
         <?php endforeach; ?>
         <?php endif; ?>
      </div>
   </div>
</div>




<script>
   $(document).ready(function() {
   $('#submitButton').on('click', function() {
       var reportUrl = $('#vurl').val(); // Get the URL entered by the user
       
       if (reportUrl) {
           $.ajax({
               url: '<?php echo base_url("Website/create_project_report"); ?>',  // URL to your controller method
               type: 'POST',
               data: { url: reportUrl },  // Send the URL to the server
               success: function(response) {
                   var data = JSON.parse(response);
                   if (data.status === 'success') {
                       alert('Project saved successfully');
                        window.location.href = '<?php echo base_url(); ?>'
                   } else {
                       alert('Error: ' + data.message);
                   }
               },
               error: function(xhr, status, error) {
                   alert('An error occurred: ' + error);
               }
           });
       } else {
           alert('Please enter a URL');
       }
   });
   });
   
</script>