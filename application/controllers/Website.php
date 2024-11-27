<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{

     public function __construct() {
        parent::__construct();
        $this->load->library('upload'); // Load the upload library
        $this->load->model('ProjectModel');
        
    }

    
    public function index()
    {

        $projects = $this->ProjectModel->get_all_projects();
        // Pass the project data to the view
        $data['projects'] = $projects;
        
        $this->load->view('include/header');
        $this->load->view('website/Home',$data);
        $this->load->view('include/footer');
    }

      public function analytics($id)
    {
        $project = $this->ProjectModel->get_project_by_id($id);
        $searchData = $this->ProjectModel->get_SearchData_by_id($id);
         $analysis = $this->ProjectModel->analyze_gaps($id);
         //$gaps = $this->ProjectModel->analyze_gaps1($id);
           $engagement_metrics = $analysis['engagement_metrics'];

        // Prepare data for the view
        $data['gaps'] = $analysis['gaps'];
        $data['likes_per_1000_views'] = json_encode($engagement_metrics['likes_per_1000_views']);
        $data['comments_per_1000_views'] = json_encode($engagement_metrics['comments_per_1000_views']);
        $data['engagement_ratio'] = json_encode($engagement_metrics['engagement_ratio']);
        // echo "<pre>";
        // print_r($data);die;
        // Prepare the data for the view
     
        $data['searchData']= $searchData;
        // Check if project data exists for the given ID
        if ($project) {
            // Pass the project data to the view
            $data['projectDetail'] = $project;
        } else {
            // Optionally handle the case where no project is found for the ID
            $data['error'] = 'Project not found.';
        } 
        $this->load->view('include/header');
        $this->load->view('website/Analytics',$data);
        $this->load->view('include/footer');
    }



    private function formatDate($date) {
        // Convert date to the desired format
        $formattedDate = date('Y-m-d', strtotime($date));

        return $formattedDate;
    }

   private function xyz() {
         $this->load->view('include/header');
        $this->load->view('website/Xyz');
        $this->load->view('include/footer');
    }



    public function profile()
    {

        $this
            ->load
            ->view('admin/profile');

    }

    public function dashboard()
    {
        $this
            ->load
            ->view('website/dashbord');
    }
    public function setting()
    {
        $this
            ->load
            ->view('admin/setting');

    }

    // This is the method to handle the AJAX request and process the project
    public function create_project_report() {
        // Check if the POST data is available
        if ($this->input->post('url')) {
            $url = $this->input->post('url');
            
            // Extract the YouTube video ID from the URL
            parse_str(parse_url($url, PHP_URL_QUERY), $urlParams);
            
            if (isset($urlParams['v'])) {
                $videoId = $urlParams['v'];
                
                // Fetch data from the YouTube API
                $apiKey = '';  // Replace with your API key
                $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id=$videoId&key=$apiKey&part=snippet,statistics";
                
                // Call the YouTube API and decode the response
                $response = file_get_contents($apiUrl);
                $data = json_decode($response, true);
                if (isset($data['items'][0])) {
                $video = $data['items'][0];
                $projectName = $video['snippet']['title'];
                $projectDesc = $video['snippet']['description'];
                $projectThumb = $video['snippet']['thumbnails']['high']['url'];  // High-quality thumbnail
                $projectTags = isset($video['snippet']['tags']) ? implode(',', $video['snippet']['tags']) : '';
                $projectOwner = $video['snippet']['channelTitle'];
                $projectLikes = isset($video['statistics']['likeCount']) ? $video['statistics']['likeCount'] : 0;
                $projectComments = isset($video['statistics']['commentCount']) ? $video['statistics']['commentCount'] : 0;
                $viewCount = isset($video['statistics']['viewCount']) ? $video['statistics']['viewCount'] : 0;
                $uploadDate = isset($video['snippet']['publishedAt']) ? $video['snippet']['publishedAt'] : '';
                $projectCategoryId = isset($video['snippet']['categoryId']) ? $video['snippet']['categoryId'] : '';
                $liveBroadcastContent = isset($video['snippet']['liveBroadcastContent']) ? $video['snippet']['liveBroadcastContent'] : '';
                $defaultAudioLanguage = isset($video['snippet']['defaultAudioLanguage']) ? $video['snippet']['defaultAudioLanguage'] : '';
                $standardThumb = isset($video['snippet']['thumbnails']['standard']['url']) ? $video['snippet']['thumbnails']['standard']['url'] : '';
                $maxresThumb = isset($video['snippet']['thumbnails']['maxres']['url']) ? $video['snippet']['thumbnails']['maxres']['url'] : '';

    

                // Fetch channel logo (profile image) using the channelId
                $channelId = $video['snippet']['channelId'];
                $channelApiUrl = "https://www.googleapis.com/youtube/v3/channels?part=snippet&id=$channelId&key=$apiKey";
                $channelResponse = file_get_contents($channelApiUrl);
                $channelData = json_decode($channelResponse, true);

                // Extract channel logo URL
                $channelLogo = isset($channelData['items'][0]['snippet']['thumbnails']['default']['url']) ? 
                            $channelData['items'][0]['snippet']['thumbnails']['default']['url'] : '';

                // Thumbnails (default, medium, high)
                $defaultThumb = isset($video['snippet']['thumbnails']['default']['url']) ? $video['snippet']['thumbnails']['default']['url'] : '';
                $mediumThumb = isset($video['snippet']['thumbnails']['medium']['url']) ? $video['snippet']['thumbnails']['medium']['url'] : '';
                $highThumb = $projectThumb;


                    // Prepare data for insertion
                    $dataToInsert = array(
                        'project_url' => $url,
                        'project_name' => $projectName,
                        'project_thumb' => $defaultThumb,
                        'project_thumb_medium' => $mediumThumb,     // Medium thumbnail URL
                        'project_thumb_high' => $highThumb,         // High thumbnail URL
                        'project_desc' => $projectDesc,
                        'project_tags' => $projectTags,
                        'project_owner' => $projectOwner,
                        'project_likes' => $projectLikes,
                        'project_comments' => $projectComments,
                        'project_views' => $viewCount,              // View count
                        'project_channel_logo' => $channelLogo, 
                        'row_json' => json_encode($video),
                        'created_at' => $uploadDate,
                        'project_category_id' => $projectCategoryId,
                        'project_live_broadcast_content' => $liveBroadcastContent,
                        'project_default_audio_language' => $defaultAudioLanguage,
                        'project_thumb_standard' => $standardThumb,   // Standard thumbnail URL
                        'project_thumb_maxres' => $maxresThumb,   
                        'status' => 'active' // You can set this to 'active' or 'inactive' based on your logic
                    );
                    
                    // Save the data to the database using the model
                    $this->ProjectModel->insert_project($dataToInsert);
                    
                    // Return success response
                    echo json_encode(['status' => 'success', 'message' => 'Project saved successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid YouTube video data']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid YouTube URL']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No URL provided']);
        }
    }



    public function search_project_report(){

         if ($this->input->post('keyword')) {
        $keyword = $this->input->post('keyword'); // Get the keyword
        $idd = $this->input->post('id');

        // Fetch data from the YouTube API
        $apiKey = '';  // Replace with your API key
        // $apiUrl = "https://www.googleapis.com/youtube/v3/search?q=" . urlencode($keyword) . "&key=$apiKey&part=snippet&type=video&maxResults=50";

        // // Call the YouTube API and decode the response
        // $response = file_get_contents($apiUrl);
        // $data = json_decode($response, true);

        // // Check if we got valid data from the API
        // if (isset($data['items']) && count($data['items']) > 0) {

        //     foreach ($data['items'] as $video) {
        //         // Extract video details
        //         $videoId = $video['id']['videoId'];
        //         $projectName = $video['snippet']['title'];
        //         $projectDesc = $video['snippet']['description'];
        //         $projectThumb = $video['snippet']['thumbnails']['high']['url'];  // High-quality thumbnail
        //         $projectTags = isset($video['snippet']['tags']) ? implode(',', $video['snippet']['tags']) : '';
        //         $projectOwner = $video['snippet']['channelTitle'];
        //         $uploadDate = isset($video['snippet']['publishedAt']) ? $video['snippet']['publishedAt'] : '';
        //         $projectCategoryId = isset($video['snippet']['categoryId']) ? $video['snippet']['categoryId'] : '';
        //         $liveBroadcastContent = isset($video['snippet']['liveBroadcastContent']) ? $video['snippet']['liveBroadcastContent'] : '';
        //         $defaultAudioLanguage = isset($video['snippet']['defaultAudioLanguage']) ? $video['snippet']['defaultAudioLanguage'] : '';
        //         $standardThumb = isset($video['snippet']['thumbnails']['standard']['url']) ? $video['snippet']['thumbnails']['standard']['url'] : '';
        //         $maxresThumb = isset($video['snippet']['thumbnails']['maxres']['url']) ? $video['snippet']['thumbnails']['maxres']['url'] : '';

        //         // Fetch video statistics (like count, views, comments)
        //         $videoStatsUrl = "https://www.googleapis.com/youtube/v3/videos?id=$videoId&key=$apiKey&part=statistics";
        //         $videoStatsResponse = file_get_contents($videoStatsUrl);
        //         $videoStatsData = json_decode($videoStatsResponse, true);

        //         if (isset($videoStatsData['items'][0])) {
        //             $stats = $videoStatsData['items'][0]['statistics'];
        //             $projectLikes = isset($stats['likeCount']) ? $stats['likeCount'] : 0;
        //             $projectComments = isset($stats['commentCount']) ? $stats['commentCount'] : 0;
        //             $viewCount = isset($stats['viewCount']) ? $stats['viewCount'] : 0;
        //         } else {
        //             $projectLikes = $projectComments = $viewCount = 0;
        //         }

        //         // Prepare data for insertion
        //         $dataToInsert = array(
        //             'search_url' => "https://www.youtube.com/watch?v=$videoId",
        //             'search_name' => $projectName,
        //             'project_id' => $idd,
        //             'search_thumb' => $projectThumb,
        //             'search_thumb_medium' => isset($video['snippet']['thumbnails']['medium']['url']) ? $video['snippet']['thumbnails']['medium']['url'] : '',
        //             'search_thumb_high' => $projectThumb, // High thumbnail URL
        //             'search_desc' => $projectDesc,
        //             'search_tags' => $projectTags,
        //             'search_owner' => $projectOwner,
        //             'search_likes' => $projectLikes,
        //             'search_comments' => $projectComments,
        //             'search_views' => $viewCount, // View count
        //             'search_channel_logo' => '', // Channel logo, you can fetch this if needed
        //             'row_json' => json_encode($video),
        //             'created_at' => $uploadDate,
        //             'search_category_id' => $projectCategoryId,
        //             'search_live_broadcast_content' => $liveBroadcastContent,
        //             'search_default_audio_language' => $defaultAudioLanguage,
        //             'search_thumb_standard' => $standardThumb, // Standard thumbnail URL
        //             'search_thumb_maxres' => $maxresThumb,   
        //             'status' => 'active' // You can set this to 'active' or 'inactive' based on your logic
        //         );

         $apiKey = '';  // Replace with your API key
        $apiUrl = "https://www.googleapis.com/youtube/v3/search?q=" . urlencode($keyword) . "&key=$apiKey&part=snippet&type=video&maxResults=50";

        // Call the YouTube API and decode the response
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        // Check if we got valid data from the API
        if (isset($data['items']) && count($data['items']) > 0) {
            $videoIds = [];

            // Collect the video IDs from the search results
            foreach ($data['items'] as $video) {
                $videoIds[] = $video['id']['videoId'];
            }

            // Fetch detailed data for the videos using the 'videos' endpoint
            $videoIdsString = implode(',', $videoIds);
            $videoDetailsUrl = "https://www.googleapis.com/youtube/v3/videos?id=$videoIdsString&key=$apiKey&part=snippet,statistics,contentDetails";
            $videoDetailsResponse = file_get_contents($videoDetailsUrl);
            $videoDetailsData = json_decode($videoDetailsResponse, true);

            // Process each video
            foreach ($videoDetailsData['items'] as $video) {
                // Extract video details
                $videoId = $video['id'];
                $projectName = $video['snippet']['title'];
                $projectDesc = $video['snippet']['description'];
                $projectThumb = $video['snippet']['thumbnails']['high']['url'];  // High-quality thumbnail
                $projectTags = isset($video['snippet']['tags']) ? implode(',', $video['snippet']['tags']) : '';
                $projectOwner = $video['snippet']['channelTitle'];
                $uploadDate = isset($video['snippet']['publishedAt']) ? $video['snippet']['publishedAt'] : '';
                $projectCategoryId = isset($video['snippet']['categoryId']) ? $video['snippet']['categoryId'] : '';
                $liveBroadcastContent = isset($video['snippet']['liveBroadcastContent']) ? $video['snippet']['liveBroadcastContent'] : '';
                $defaultAudioLanguage = isset($video['snippet']['defaultAudioLanguage']) ? $video['snippet']['defaultAudioLanguage'] : '';
                $standardThumb = isset($video['snippet']['thumbnails']['standard']['url']) ? $video['snippet']['thumbnails']['standard']['url'] : '';
                $maxresThumb = isset($video['snippet']['thumbnails']['maxres']['url']) ? $video['snippet']['thumbnails']['maxres']['url'] : '';

                // Get video statistics
                $projectLikes = isset($video['statistics']['likeCount']) ? $video['statistics']['likeCount'] : 0;
                $projectComments = isset($video['statistics']['commentCount']) ? $video['statistics']['commentCount'] : 0;
                $viewCount = isset($video['statistics']['viewCount']) ? $video['statistics']['viewCount'] : 0;

                // Prepare data for insertion
                $dataToInsert = array(
                    'search_url' => "https://www.youtube.com/watch?v=$videoId",
                    'search_name' => $projectName,
                    'project_id' => $idd,
                    'search_thumb' => $projectThumb,
                    'search_thumb_medium' => isset($video['snippet']['thumbnails']['medium']['url']) ? $video['snippet']['thumbnails']['medium']['url'] : '',
                    'search_thumb_high' => $projectThumb, // High thumbnail URL
                    'search_desc' => $projectDesc,
                    'search_tags' => $projectTags,
                    'search_owner' => $projectOwner,
                    'search_likes' => $projectLikes,
                    'search_comments' => $projectComments,
                    'search_views' => $viewCount, // View count
                    'search_channel_logo' => '', // Channel logo, you can fetch this if needed
                    'row_json' => json_encode($video),
                    'created_at' => $uploadDate,
                    'search_category_id' => $projectCategoryId,
                    'search_live_broadcast_content' => $liveBroadcastContent,
                    'search_default_audio_language' => $defaultAudioLanguage,
                    'search_thumb_standard' => $standardThumb, // Standard thumbnail URL
                    'search_thumb_maxres' => $maxresThumb,   
                    'status' => 'active' // You can set this to 'active' or 'inactive' based on your logic
                );

                // Save the data to the database using the model
                $this->ProjectModel->insert_searchData($dataToInsert);
            }

            // Return success response
            echo json_encode(['status' => 'success', 'message' => 'Projects saved successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No videos found for the given keyword']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No keyword provided']);
    }


        
        }



public function analyze($project_id) {
        // Get gaps by calling the model
        $gaps = $this->ProjectModel->analyze_gaps($project_id);

        // Prepare the data for the view
        $data['gaps'] = $gaps;

        echo "<pre>";
        print_r($data);die;

        // Load the view with the gaps data
        $this->load->view('video_analysis', $data);
    }




  public function get_comparison_data_single() {
        // Get the video_id and competitor_id from the POST request
        $video_id = $this->input->post('video_id'); // The ID of your video
        $competitor_id = $this->input->post('competitor_id'); // The ID of the selected competitor video
        
        // Fetch the comparison data from the model
        $comparison_data = $this->ProjectModel->get_comparison_data_single($video_id, $competitor_id);
        
        // Return the comparison data as JSON
        echo json_encode($comparison_data);
    }


     public function fetch_comparison_data_all() {
        $video_id = $this->input->post('video_id'); // Your video ID to compare with competitors
        $comparison_data = $this->ProjectModel->get_comparison_data($video_id);
        
        // Return data as JSON
        echo json_encode($comparison_data);
    }





    public function compare() {
        // Get the project IDs from the AJAX request
        $yourProjectId = $this->input->post('your_project_id');
        $competitorProjectId = $this->input->post('competitor_project_id');

        // Fetch your project and competitor's data from the database
        $yourVideo = $this->db->get_where('projects', ['id' => $yourProjectId])->row();
        $competitorVideo = $this->db->get_where('searchdata', ['id' => $competitorProjectId])->row();

        // Find missing tags and keywords
        $missingTags = $this->findMissingTags($yourVideo->project_tags, $competitorVideo->search_tags);
        $missingKeywords = $this->findMissingKeywords($yourVideo->project_desc, $competitorVideo->search_desc);
        //print_r($missingTags);die;
        // Return the missing tags and keywords as a response
       echo json_encode([
                'missingTags' => $missingTags,
                'missingKeywords' => array_values($missingKeywords) // Convert object to array
]);
    }

    // Function to compare and find missing tags
    private function findMissingTags($yourTags, $competitorTags) {
        $yourTagsArray = explode(',', $yourTags);
        $competitorTagsArray = explode(',', $competitorTags);
        
        return array_diff($competitorTagsArray, $yourTagsArray);
    }

   
    private function findMissingKeywords($yourDesc, $competitorDesc) {
    // Extract verbs from both descriptions
    $yourVerbs = $this->extractVerbs($yourDesc);
    $competitorVerbs = $this->extractVerbs($competitorDesc);

    // Compare verbs and find the ones missing from your description
    return array_diff($competitorVerbs, $yourVerbs);
    }

    private function extractVerbs($text) {
        // Basic approach: match words ending with common verb suffixes like "ing", "ed"
        // This is a simple regex-based method that identifies possible verbs
        $pattern = '/\b(\w+ing|\w+ed|\w+s)\b/';

        // Convert text to lowercase and find all matching verbs
        preg_match_all($pattern, strtolower($text), $matches);

        // Return unique verbs (you can refine the list further)
        return array_unique($matches[0]);
    }



}

