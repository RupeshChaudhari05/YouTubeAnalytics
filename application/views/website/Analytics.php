<!-- <script src="<?php //echo base_url(); ?>assets/dist/libs/tom-select/dist/js/tom-select.base.min.js?1684106062" defer></script> -->
<div class="page-wrapper">
<!-- Page header -->
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <h2 class="page-title">
               Identify Your Competitors
            </h2>
            <div class="text-muted mt-1">Please enter the main keyword you'd like to rank for, and we'll help you optimize your content for better visibility.</div>
         </div>
         <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
               <div class="row g-2">
                  <div class="col">
                     <input type="text" class="form-control" placeholder="Search for…" id='searchData'>
                  </div>
                  <div class="col-auto">
                     <a href="#" class="btn btn-icon" aria-label="Button" id='searchButton'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                           <path d="M21 21l-6 -6"></path>
                        </svg>
                     </a>
                  </div>
               </div>
               <div class="col">
                  <!-- <select type="text" class="form-select tomselected" placeholder="Select tags" id="select-tags" value="" multiple>
                     <option value="HTML">HTML</option>
                     <option value="JavaScript">JavaScript</option>
                     <option value="CSS">CSS</option>
                     <option value="jQuery">jQuery</option>
                     <option value="Bootstrap">Bootstrap</option>
                     <option value="Ruby">Ruby</option>
                     <option value="Python">Python</option>
                     </select> -->
               </div>
               <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasEnd" role="button" aria-controls="offcanvasEnd">
               Your video data
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page body -->
<div class="page-body">
   <div class="container-xl">
      <div class="row g-4 ">
         <div class="col-3 card p-3">
            <form action="./" method="get" autocomplete="off" novalidate>
               <div class="subheader mb-2">Category</div>
               <div class="subheader mb-2">Rating</div>
               <div class="subheader mb-2">Tags</div>
               <div class="subheader mb-2">Price</div>
               <div class="row g-2 align-items-center mb-3">
               </div>
               <div class="subheader mb-2">Shipping</div>
               <div>
               </div>
            </form>
         </div>
         <div class="col-9">
            <div class="row row-cards">
               <?php if (empty($searchData)): ?>
               <!-- Display a message when no data is available -->
               <div class="col-12">
                  <p class="text-center text-muted">No search data available at the moment.</p>
               </div>
               <?php else: ?>
               <div class="space-y">
                  <?php foreach ($searchData as $key => $project):  ?>
                  <!-- <div class="col-sm-6 col-lg-4">
                     <div class="card card-sm">
                           <img src="<?php echo $project['search_thumb']; ?>" class="card-img-top" alt="Project Image">
                     
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <span class="avatar me-3 rounded" style="background-image: url(<?php echo $project['search_channel_logo']; ?>)"></span>
                              <div>
                                 <div><?php echo $project['search_owner']; ?></div>
                                 <div class="text-muted"><?php echo time_ago($project['created_at']); ?> ago</div>
                              </div>
                              <div class="ms-auto">
                                 <a href="#" class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                       <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                    </svg>
                                    <?php echo formatNumber($project['search_views']); ?>
                                 </a>
                                 <a href="#" class="ms-3 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                                    </svg>
                                    <?php echo formatNumber($project['search_likes']); ?>
                                 </a>
                                 <a href="#" class="ms-3 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                       <path d="M5.821 4.91c3.898 -2.765 9.469 -2.539 13.073 .536c3.667 3.127 4.168 8.238 1.152 11.897c-2.842 3.447 -7.965 4.583 -12.231 2.805l-.232 -.101l-4.375 .931l-.075 .013l-.11 .009l-.113 -.004l-.044 -.005l-.11 -.02l-.105 -.034l-.1 -.044l-.076 -.042l-.108 -.077l-.081 -.074l-.073 -.083l-.053 -.075l-.065 -.115l-.042 -.106l-.031 -.113l-.013 -.075l-.009 -.11l.004 -.113l.005 -.044l.02 -.11l.022 -.072l1.15 -3.451l-.022 -.036c-2.21 -3.747 -1.209 -8.392 2.411 -11.118l.23 -.168z" stroke-width="0" fill="currentColor" />
                                    </svg>
                                    <?php echo formatNumber($project['search_comments']); ?>
                                 </a>
                              </div>
                           </div>
                         
                           <h5 class="card-title"><?php echo $project['search_name']; ?></h5>
                           <p class="card-text"><?php //echo $project['search_desc']; ?></p>
                           <small class="text-muted"><?php 
                        // Assuming $project['search_tags'] contains a comma-separated string of tags
                        $tags = explode(',', $project['search_tags']); // Split the string into an array
                        
                        // Loop through the array and display each tag
                        foreach ($tags as $tag) {
                        // Optionally, trim whitespace if there are extra spaces
                        $tag = trim($tag);
                        echo "<span class='badge badge-outline text-red'>$tag</span> "; // Wrap each tag in a <span> or any HTML element you prefer
                        }
                        
                        
                        ?></small>
                        </div>
                     </div>
                     </div> -->
                  <div class="card">
                     <div class="row g-0">
                        <div class="col-auto">
                           <div class="card-body1">
                              <div class="avatar avatar-md" style="background-image: url(<?php echo $project['search_thumb']; ?>); height: 200px;
                                 width: 200px;"></div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="card-body pl-2">
                              <div class="row">
                                 <div class="col">
                                    <h3 class="mb-0"><a href="#"><?php echo $project['search_name']; ?></a></h3>
                                    <small class="text-muted">.<?php echo time_ago($project['created_at']); ?> ago</small>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md">
                                    <div class="mt-3 list-inline list-inline-dots mb-0 text-muted d-sm-block d-none">
                                       <div class="list-inline-item">
                                          <a href="#" class="text-muted">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                             </svg>
                                             <?php echo formatNumber($project['search_views']); ?>    
                                          </a>
                                       </div>
                                       <div class="list-inline-item">
                                          <a href="#" class="ms-3 text-muted">
                                             <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"  class="icon">
                                                <path d="M8 10V20M8 10L4 9.99998V20L8 20M8 10L13.1956 3.93847C13.6886 3.3633 14.4642 3.11604 15.1992 3.29977L15.2467 3.31166C16.5885 3.64711 17.1929 5.21057 16.4258 6.36135L14 9.99998H18.5604C19.8225 9.99998 20.7691 11.1546 20.5216 12.3922L19.3216 18.3922C19.1346 19.3271 18.3138 20 17.3604 20L8 20" stroke="#667382" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                             </svg>
                                             <?php echo formatNumber($project['search_likes']); ?>
                                          </a>
                                       </div>
                                       <div class="list-inline-item">
                                          <a href="#" class="ms-3 text-muted">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M5.821 4.91c3.898 -2.765 9.469 -2.539 13.073 .536c3.667 3.127 4.168 8.238 1.152 11.897c-2.842 3.447 -7.965 4.583 -12.231 2.805l-.232 -.101l-4.375 .931l-.075 .013l-.11 .009l-.113 -.004l-.044 -.005l-.11 -.02l-.105 -.034l-.1 -.044l-.076 -.042l-.108 -.077l-.081 -.074l-.073 -.083l-.053 -.075l-.065 -.115l-.042 -.106l-.031 -.113l-.013 -.075l-.009 -.11l.004 -.113l.005 -.044l.02 -.11l.022 -.072l1.15 -3.451l-.022 -.036c-2.21 -3.747 -1.209 -8.392 2.411 -11.118l.23 -.168z" stroke-width="0" fill="currentColor" />
                                             </svg>
                                             <?php echo formatNumber($project['search_comments']); ?>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-auto">
                                    <div class="mt-3 badges">
                                       <small class="text-muted"><?php 
                                          $tags = explode(',', $project['search_tags']); 
                                          
                                          
                                          foreach ($tags as $tag) {
                                          
                                          $tag = trim($tag);
                                          echo "<span class='badge badge-outline text-red'>$tag</span> "; // Wrap each tag in a <span> or any HTML element you prefer
                                          }
                                          
                                          
                                          ?></small>
                                    </div>
                                 </div>
                                 <div class="btn-group w-100 pt-3" role="group">
                                    <input type="radio" class="btn-check" name="btn-radio-dropdown" id="btn-radio-dropdown-<?php echo $project['id']; ?>" autocomplete="off" checked="" data-bs-toggle="modal" data-bs-target="#modal-full-width">
                                    <label for="btn-radio-dropdown-<?php echo $project['id']; ?>" type="button" class="btn">
                                    <input type="hidden" value="<?php echo $project['id']; ?>" id="comp_id-<?php echo $project['id']; ?>"/>
                                    Start Comparison
                                    </label>
                                    <input type="radio" class="btn-check" name="btn-radio-dropdown" id="btn-radio-dropdown-2" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modal-report">
                                    <label for="btn-radio-dropdown-2" type="button" class="btn">Download Thumbnail</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                        <div class="col-auto fs-3 pl-10">
                           <?php echo $key+1; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
               <?php endif; ?>
               <!-- <div class="col-sm-6 col-lg-4">
                  <div class="card card-sm">
                    <a href="#" class="d-block"><img src="./static/photos/beautiful-blonde-woman-relaxing-with-a-can-of-coke-on-a-tree-stump-by-the-beach.jpg" class="card-img-top"></a>
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <span class="avatar me-3 rounded" style="background-image: url(./static/avatars/000m.jpg)"></span>
                        <div>
                          <div>Paweł Kuna</div>
                          <div class="text-muted">3 days ago</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div> -->
            </div>
         </div>
      </div>
   </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
   <div class="offcanvas-header">
      <h2 class="offcanvas-title" id="offcanvasEndLabel"><?php echo "#".$projectDetail->id; ?></h2>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
   </div>
   <div class="offcanvas-body">
      <div>
         <div class="hr-text">Title</div>
         <?php echo $projectDetail->project_name; ?>
         <div class="hr-text">Thumbnail</div>
         <img src="<?php echo $projectDetail->project_thumb_maxres; ?>" class="card-img-top" alt="Project Image">
         <div class="hr-text">Counts</div>
         <div class="ms-auto">
            <a href="#" class="text-muted">
               <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                  <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
               </svg>
               <?php echo formatNumber($projectDetail->project_views); ?>
            </a>
            <a href="#" class="ms-3 text-muted">
               <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
               </svg>
               <?php echo formatNumber($projectDetail->project_likes); ?>
            </a>
            <a href="#" class="ms-3 text-muted">
               <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M5.821 4.91c3.898 -2.765 9.469 -2.539 13.073 .536c3.667 3.127 4.168 8.238 1.152 11.897c-2.842 3.447 -7.965 4.583 -12.231 2.805l-.232 -.101l-4.375 .931l-.075 .013l-.11 .009l-.113 -.004l-.044 -.005l-.11 -.02l-.105 -.034l-.1 -.044l-.076 -.042l-.108 -.077l-.081 -.074l-.073 -.083l-.053 -.075l-.065 -.115l-.042 -.106l-.031 -.113l-.013 -.075l-.009 -.11l.004 -.113l.005 -.044l.02 -.11l.022 -.072l1.15 -3.451l-.022 -.036c-2.21 -3.747 -1.209 -8.392 2.411 -11.118l.23 -.168z" stroke-width="0" fill="currentColor" />
               </svg>
               <?php echo formatNumber($projectDetail->project_comments); ?>
            </a>
         </div>
         <div class="hr-text">Tags</div>
         <?php 
            // Assuming $project['project_tags'] contains a comma-separated string of tags
            $tags = explode(',', $projectDetail->project_tags); // Split the string into an array
            
            // Loop through the array and display each tag
            foreach ($tags as $tag) {
            // Optionally, trim whitespace if there are extra spaces
            $tag = trim($tag);
            echo "<span class='badge badge-outline text-red'>$tag</span> "; // Wrap each tag in a <span> or any HTML element you prefer
            }
            
            
            ?>
         <div class="hr-text">Description</div>
         <?php echo $projectDetail->project_desc; ?>
      </div>
      <div class="mt-3">
         <button class="btn btn-primary" type="button" data-bs-dismiss="offcanvas">
         Close
         </button>
      </div>
   </div>
</div>
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Download Thumbnail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <label class="form-label">Select Thumbnail Quality</label>
            <div class="form-selectgroup-boxes row mb-3">
               <!-- Normal Quality Option -->
               <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="normal" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                  <span class="me-3">
                  <span class="form-selectgroup-check"></span>
                  </span>
                  <span class="form-selectgroup-label-content">
                  <span class="form-selectgroup-title strong mb-1">Normal</span>
                  <span class="d-block text-muted">Download the standard resolution thumbnail (default size)</span>
                  </span>
                  </span>
                  </label>
               </div>
               <!-- HD Quality Option -->
               <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="hd" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                  <span class="me-3">
                  <span class="form-selectgroup-check"></span>
                  </span>
                  <span class="form-selectgroup-label-content">
                  <span class="form-selectgroup-title strong mb-1">HD</span>
                  <span class="d-block text-muted">Download a high-definition thumbnail for better image clarity</span>
                  </span>
                  </span>
                  </label>
               </div>
               <!-- HD+ Quality Option -->
               <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="hd_plus" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                  <span class="me-3">
                  <span class="form-selectgroup-check"></span>
                  </span>
                  <span class="form-selectgroup-label-content">
                  <span class="form-selectgroup-title strong mb-1">HD+</span>
                  <span class="d-block text-muted">Download a higher-quality thumbnail with improved resolution</span>
                  </span>
                  </span>
                  </label>
               </div>
               <!-- HD++ Quality Option -->
               <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="hd_double_plus" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                  <span class="me-3">
                  <span class="form-selectgroup-check"></span>
                  </span>
                  <span class="form-selectgroup-label-content">
                  <span class="form-selectgroup-title strong mb-1">HD++</span>
                  <span class="d-block text-muted">Download the highest quality thumbnail with exceptional detail</span>
                  </span>
                  </span>
                  </label>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
            Download
            </a>
         </div>
      </div>
   </div>
</div>
<div class="modal modal-blur fade" id="modal-full-width" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Track Competitor Metrics</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class='row'>
               <div class="col-lg-6">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="card-title">Likes and Views summary</h3>
                        <div id="sparkline-activity"></div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="card-title"></h3>
                      
                     </div>
                  </div>
               </div>
            </div>

              <div class='row'>
               <div class="col-lg-6">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="card-title">Missing Keywords</h3>
                        <div id="missingKeywords" class="badges-list"></div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="card-title">Missing Tags</h3>
                        <div id="missingTags" class="badges-list"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
         </div>
      </div>
   </div>
</div>
<script>
   document.addEventListener("DOMContentLoaded", function() {
   
   document.querySelectorAll('input[name="btn-radio-dropdown"]').forEach(function(radioButton) {
   radioButton.addEventListener('click', function() {
     // Get the video_id from the associated hidden input field
     var videoId = <?php echo $projectDetail->id; ?>; // Replace with your actual project video ID
     
     // Get the competitor's ID from the hidden input field within the clicked radio button's container
     var competitorId = document.getElementById('comp_id-' + this.id.split('-').pop()).value;
     
     // Log the selected competitor ID for debugging
     //alert('Competitor ID: ' + competitorId);
     
     // Make an AJAX call to fetch comparison data
     $.ajax({
         url: '<?php echo base_url("Website/get_comparison_data_single"); ?>',
         type: 'POST',
         data: {
             video_id: videoId,
             competitor_id: competitorId
         },
         success: function(data) {
             var comparisonData = JSON.parse(data);
             
             // Handle the response
             if (comparisonData.error) {
                 console.error('Error: ' + comparisonData.error);
                 alert('Competitor not found!');
             } else {
                 // Extract data for charting
                 var yourLikes = comparisonData.your_likes;
                 var competitorLikes = comparisonData.competitor_likes;
                 var yourViews = comparisonData.your_views;
                 var competitorViews = comparisonData.competitor_views;
                 var yourcomment = comparisonData.your_comments;
                 var competitorComment = comparisonData.competitor_comments;
                // clearChart();
                 // Create the chart with the fetched data
                 createBarChart(yourLikes, competitorLikes, yourViews, competitorViews,yourcomment,competitorComment);
                 compareVideos(videoId, competitorId);
             }
         },
         error: function() {
             console.error('Failed to fetch comparison data');
         }
     });
   
   
   
   function compareVideos(yourProjectId, competitorProjectId) {
   $.ajax({
     url: '<?php echo base_url("Website/compare"); ?>', // Your CodeIgniter controller URL
     type: 'POST',
     data: {
         your_project_id: yourProjectId,
         competitor_project_id: competitorProjectId
     },
     success: function(response) {
      var comparisonData1 = JSON.parse(response);
         // Process the response to extract missing tags/keywords
         var missingTags = comparisonData1.missingTags; // assuming the comparisonData1 contains this info
         var missingKeywords = comparisonData1.missingKeywords; // assuming the comparisonData1 contains this info
         //alert(missingKeywords)
         // Display missing tags and keywords in your model
        // $('#missingTags').html(missingTags.join(', '));
        // $('#missingKeywords').html(missingKeywords.join(', '));

            missingTags.forEach(function(tag) {
                    $('#missingTags').append('<span class="badge badge-outline text-azure">' + tag + '</span>');
                });
                
                // Append missing keywords to the #missingKeywords container with the class "keyword"
                missingKeywords.forEach(function(keyword) {
                    $('#missingKeywords').append('<span class="badge badge-outline text-azure">' + keyword + '</span>');
                });
     },
     error: function(xhr, status, error) {
         console.error("Error fetching comparison data: ", error);
     }
   });
   }
   
   
   });
   });
   
   function clearChart() {
   if (chartInstance) {
     chartInstance.destroy();  // Destroy the existing chart instance
     console.log('Chart cleared');
   }
   }
   
     function compareVideos(yourProjectId, competitorProjectId) {
   $.ajax({
     url: '<?php echo base_url("Website/compare"); ?>', // Your CodeIgniter controller URL
     type: 'POST',
     data: {
         your_project_id: yourProjectId,
         competitor_project_id: competitorProjectId
     },
     success: function(response) {
         // Process the response to extract missing tags/keywords
         var missingTags = response.missingTags; // assuming the response contains this info
         var missingKeywords = response.missingKeywords; // assuming the response contains this info
         // Display missing tags and keywords in your model
         $('#missingTags').html(missingTags.join(', '));
         $('#missingKeywords').html(missingKeywords.join(', '));
     },
     error: function(xhr, status, error) {
         console.error("Error fetching comparison data: ", error);
     }
   });
   }
   
   // Function to create the bar chart
   // function createBarChart(yourLikes, competitorLikes, yourViews, competitorViews) {
   //     var options = {
   //         chart: {
   //             type: 'bar',
   //             height: 350
   //         },
   //         series: [{
   //             name: 'Your Video Likes',
   //             data: [yourLikes]
   //         }, {
   //             name: 'Competitor Likes',
   //             data: [competitorLikes]
   //         }, {
   //             name: 'Your Video Views',
   //             data: [yourViews]
   //         }, {
   //             name: 'Competitor Views',
   //             data: [competitorViews]
   //         }],
   //         xaxis: {
   //             categories: ['Your Video', 'Competitor Video']
   //         }
   //     };
   
   //     var chart = new ApexCharts(document.getElementById('sparkline-activity'), options);
   //     chart.render();
   // }
   
   function createBarChart(yourLikes, competitorLikes, yourViews, competitorViews, yourComments, competitorComments) {
   var options = {
   chart: {
     type: 'bar',                        // Set chart type to bar
     fontFamily: 'inherit',               // Use inherited font family
     height: 350,                         // Set chart height to 350px
     parentHeightOffset: 0,               // Offset for parent height (optional)
     toolbar: {
         show: false,                     // Disable the toolbar
     },
     animations: {
         enabled: false,                  // Disable animations
     },
     stacked: false,                      // Set to false to display bars side by side
   },
   plotOptions: {
     bar: {
         columnWidth: '30%',               // Adjust the width of the bars
     }
   },
   dataLabels: {
     enabled: false,                      // Disable data labels on the bars
   },
   fill: {
     opacity: 1,                           // Set full opacity for the bars
   },
   series: [{
     name: 'Your Video Likes',
     data: [yourLikes]                      // Your video likes data
   }, {
     name: 'Competitor Likes',
     data: [competitorLikes]                // Competitor video likes data
   }, {
     name: 'Your Video Views',
     data: [yourViews]                      // Your video views data
   }, {
     name: 'Competitor Views',
     data: [competitorViews]                // Competitor video views data
   }, {
     name: 'Your Video Comments',
     data: [yourComments]                   // Your video comments data
   }, {
     name: 'Competitor Comments',
     data: [competitorComments]             // Competitor video comments data
   }],
   tooltip: {
     theme: 'dark',                        // Tooltip theme is dark
   },
   grid: {
     padding: {
         top: -20,                         // Padding for the grid
         right: 0,
         left: -4,
         bottom: -4
     },
     strokeDashArray: 4,                    // Make grid lines dashed
     xaxis: {
         lines: {
             show: true                   // Show X-axis grid lines
         }
     },
   },
   xaxis: {
     labels: {
         padding: 0,                        // Remove padding between labels on X-axis
     },
     tooltip: {
         enabled: false,                    // Disable tooltip on X-axis labels
     },
     axisBorder: {
         show: false,                       // Hide the X-axis border
     },
     categories: ['Your Video', 'Competitor Video'], // X-axis categories
   },
   yaxis: {
     labels: {
         padding: 4,                        // Padding for Y-axis labels
     },
   },
   colors: ['#FF5733', '#33FF57', '#3377FF', '#FF5733', '#FFD700', '#8A2BE2'], // Custom color for each series
   legend: {
     show: true,                          // Show legend for the chart
   },
   };
   
   var chart = new ApexCharts(document.getElementById('sparkline-activity'), options);
   chart.render();
   }
   
   
   
   
   });
   
   
   
</script>
<script>
   $(document).ready(function() {
   // When the search button is clicked
   $('#searchButton').on('click', function(event) {
   event.preventDefault(); // Prevent the default anchor behavior
   
   // Get the value from the input field
   var searchQuery = $('#searchData').val();
   
   // Check if the search field is empty
   if (searchQuery.trim() === '') {
   alert('Please enter a search query.');
   return;
   }
   
   var idd = <?php echo $projectDetail->id; ?>
   // Perform the AJAX request
   $.ajax({
   url: '<?php echo base_url("Website/search_project_report"); ?>', // Change this to the correct URL of your server endpoint
   method: 'POST', // Or POST if you're sending data via POST
   data: { keyword: searchQuery,id: idd},
   success: function(response) {
   var currentUrl = window.location.href;
   window.location.href = '<?php echo base_url(); ?>Website/analytics/'.idd
   console.log(response);
   // Example: Update a div with the search results
   $('#results').html(response);
   },
   error: function(xhr, status, error) {
   // Handle errors
   console.log('Error: ' + error);
   }
   });
   });
   
   // Optional: Trigger search when Enter key is pressed in the search field
   $('#searchData').on('keypress', function(event) {
   if (event.key === 'Enter') {
   $('#searchButton').click(); // Trigger the search button click
   }
   });
   });
   
</script>
<script></script>