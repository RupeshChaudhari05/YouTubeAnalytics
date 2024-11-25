<?php 

class ChartController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('chart_model'); # Load the model for data handling
    }

    public function index() {
        $data['chart_data'] = $this->chart_model->getChartData();
        $this->load->view('chart_view', $data);
    }

    public function get_chart_data() {
        $chart_data = $this->chart_model->getChartData();
        $this->output->set_content_type('application/json')->set_output(json_encode($chart_data));
    }
}