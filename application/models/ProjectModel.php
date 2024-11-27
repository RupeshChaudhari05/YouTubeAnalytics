<?php 
class ProjectModel extends CI_Model {

   
   public function insert_project($data) {
        // Insert the data into the 'projects' table
        return $this->db->insert('projects', $data);
    }
       
   public function insert_searchData($data) {
        // Insert the data into the 'projects' table
        return $this->db->insert('searchdata', $data);
    }

      // Method to get all projects from the database
    public function get_all_projects() {
        $query = $this->db->get('projects');
        return $query->result_array(); // Return the results as an array
    }

    public function get_project_by_id($id){
        $this->db->where('id', $id);  // Assuming your project has an 'id' column
        $query = $this->db->get('projects'); // Replace 'projects' with your actual table name
        return $query->row();  // Returns a single row
    }

      public function get_SearchData_by_id($id){
        $this->db->where('project_id', $id);  // Assuming your project has an 'id' column
        $query = $this->db->get('searchData'); // Replace 'projects' with your actual table name
        return $query->result_array();  // Returns a single row
    }


       // Function to get project data by ID
    public function get_project_data($project_id) {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('id', $project_id);
        return $this->db->get()->row_array(); // Returns a single row (your project)
    }

    // Function to get competitor videos based on project_id
    public function get_competitor_data($project_id) {
        $this->db->select('*');
        $this->db->from('searchdata');
        $this->db->where('project_id', $project_id);
        return $this->db->get()->result_array(); // Returns multiple rows (competitors)
    }

    // Function to analyze gaps
    public function analyze_gaps1($project_id) {
        // Get your project data
        $project = $this->get_project_data($project_id);

        // Get competitors data
        $competitors = $this->get_competitor_data($project_id);

        $gaps = array();
        
        // Compare each field to identify gaps (for simplicity, let's just compare 'likes' and 'views' as an example)
        foreach ($competitors as $competitor) {
            $gap = array();

            // Compare likes
            if ($competitor['search_likes'] > $project['project_likes']) {
                $gap['likes'] = $competitor['search_likes'] - $project['project_likes'];
            }

            // Compare views
            if ($competitor['search_views'] > $project['project_views']) {
                $gap['views'] = $competitor['search_views'] - $project['project_views'];
            }

            // Compare description (optional)
            if (empty($project['project_desc']) && !empty($competitor['search_desc'])) {
                $gap['desc'] = 'Competitor has a description, but you do not';
            }

            // More comparisons can be added here...

            if (!empty($gap)) {
                $gaps[] = $gap;
            }
        }

        return $gaps;
    }



     public function analyze_gaps($project_id) {
        // Get project data
        $project = $this->get_project_data($project_id);
        // Get competitors data
        $competitors = $this->get_competitor_data($project_id);

        $gaps = array();
        $engagement_metrics = array(
            'likes_per_1000_views' => array(),
            'comments_per_1000_views' => array(),
            'engagement_ratio' => array()
        );

        foreach ($competitors as $competitor) {
            $gap = array();

            // Calculate Likes/Comments per 1000 views (Engagement metrics)
            if ($competitor['search_views'] > 0) {
                $likes_per_1000 = ($competitor['search_likes'] / $competitor['search_views']) * 1000;
                $comments_per_1000 = ($competitor['search_comments'] / $competitor['search_views']) * 1000;
                $engagement_ratio = ($competitor['search_likes'] + $competitor['search_comments']) / $competitor['search_views'];

                $engagement_metrics['likes_per_1000_views'][] = $likes_per_1000;
                $engagement_metrics['comments_per_1000_views'][] = $comments_per_1000;
                $engagement_metrics['engagement_ratio'][] = $engagement_ratio;

                if ($likes_per_1000 > $project['project_likes'] / $project['project_views'] * 1000) {
                    $gap['likes'] = "Competitor has better likes per 1000 views";
                }
            }

            // Content Optimization (Description, Tags)
            if (empty($project['project_desc']) && !empty($competitor['search_desc'])) {
                $gap['desc'] = "Competitor has a description";
            }

            // Add gap details to the result array
            if (!empty($gap)) {
                $gaps[] = $gap;
            }
        }

        // Returning a more sophisticated structure
        return array(
            'gaps' => $gaps,
            'engagement_metrics' => $engagement_metrics
        );
    }




     public function get_comparison_data_all($video_id) {
        // Fetch your video's data
        $your_video = $this->db->get_where('projects', array('id' => $video_id))->row_array();

        // Fetch competitor's data
        $competitor_data = $this->db->get('searchdata')->result_array(); // You can apply filters here if needed

        // Compare metrics and prepare data
        $comparison = [];
        foreach ($competitor_data as $competitor) {
            $comparison[] = [
                'competitor_name' => $competitor['search_name'],
                'your_likes' => $your_video['project_likes'],
                'competitor_likes' => $competitor['search_likes'],
                'your_views' => $your_video['project_views'],
                'competitor_views' => $competitor['search_views'],
                'your_comments' => $your_video['project_comments'],
                'competitor_comments' => $competitor['search_comments'],
                'your_engagement_rate' => ($your_video['project_likes'] + $your_video['project_comments']) / $your_video['project_views'],
                'competitor_engagement_rate' => ($competitor['search_likes'] + $competitor['search_comments']) / $competitor['search_views'],
            ];
        }

        return $comparison;
    }


  
    public function get_comparison_data_single($video_id, $competitor_id) {
        // Fetch your video's data
        $your_video = $this->db->get_where('projects', array('id' => $video_id))->row_array();

        // Fetch the selected competitor's data using the competitor_id
        $competitor_data = $this->db->get_where('searchdata', array('id' => $competitor_id))->row_array();

        // Check if the competitor data exists
        if ($competitor_data) {
            // Prepare comparison data
            $comparison = [
                'competitor_name' => $competitor_data['search_name'],
                'your_likes' => $your_video['project_likes'],
                'competitor_likes' => $competitor_data['search_likes'],
                'your_views' => $your_video['project_views'],
                'competitor_views' => $competitor_data['search_views'],
                'your_comments' => $your_video['project_comments'],
                'competitor_comments' => $competitor_data['search_comments'],
                'your_engagement_rate' => ($your_video['project_likes'] + $your_video['project_comments']) / $your_video['project_views'],
                'competitor_engagement_rate' => ($competitor_data['search_likes'] + $competitor_data['search_comments']) / $competitor_data['search_views'],
            ];

            return $comparison; // Return the comparison data for the selected competitor
        } else {
            // If no competitor data found, return an error or empty comparison
            return ['error' => 'Competitor not found'];
        }
    }


}