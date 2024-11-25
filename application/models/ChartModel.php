<?php 
class ChartModel extends CI_Model {

    public function getChartData() {
      $a = $this->db->query("SELECT Year, SUM(Profit) AS TotalProfit FROM excel_data GROUP BY Year");
      $res = $a->result_array();
      //$a = $this->get_total_profit_by_year();
      
      //print_r($this->get_total_profit_by_year());die;
        $chart_data = $this->convert_to_chart_data($res);

        return $chart_data;
    }

    public function get_total_profit_by_year() {
        $this->db->select('Year, SUM(Profit) AS TotalProfit');
        $this->db->from('excel_data');
        $this->db->group_by('Year');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCountrywise($year){
      $a= $this->db->query("SELECT Country, SUM(Profit) AS TotalProfit FROM excel_data WHERE Year = '$year' GROUP BY Country");
      $res = $a->result_array();
      $chart_data = [];

    foreach ($res as $row) {
        $chart_data[] = [
            'Country' => $row['Country'],
            'TotalProfit' => $row['TotalProfit']
        ];
    }


         return $chart_data;
    }

    function convert_to_chart_data($input_array) {
    $chart_data = [];

    foreach ($input_array as $row) {
        $chart_data[] = [
            'Year' => $row['Year'],
            'TotalProfit' => $row['TotalProfit']
        ];
    }

    return $chart_data;
  }
}