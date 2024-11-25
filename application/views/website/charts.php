<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        /* CSS to adjust card size */
        .fullscreen-card {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1050;
            overflow: auto;
        }
        .card.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1050;
        }
    </style>

  <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Charts
                </h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div id="reportrange" style=" cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M15 19l2 2l4 -4" /></svg>
                        &nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                <!-- <input type="text" name="daterange" class='form-control' value="01/01/2018 - 01/15/2018" /> -->
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex">
                      <h3 class="card-title">Total Invoice Amount By Supplier Number</h3>
                      <div class="ms-auto">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item active" href="#">Last 7 days</a>
                            <a class="dropdown-item" href="#">Last 30 days</a>
                            <a class="dropdown-item" href="#">Last 3 months</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class='row'>
                      <div id="chart_company"></div>
                    </div>
                    
                  </div>
                </div>
              </div>
              
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex">
                      <h3 class="card-title">Total Invoice Amount By Supplier</h3>
                      <div class="ms-auto">
                        <div class="dropdown">
                          <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item active" href="#">Last 7 days</a>
                            <a class="dropdown-item" href="#">Last 30 days</a>
                            <a class="dropdown-item" href="#">Last 3 months</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class='row'>
                      <div id="chart_supplier"></div>
                    </div>
                    
                  </div>
                </div>
              </div>



              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Invoice Posting Date</h3>
                    <div class="card-actions btn-actions">
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/refresh -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                      </a>
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                      </a>
                      <span class="btn-action" id='expand-btn'>
                      <svg class='close-expand' xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-minimize" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 9l4 0l0 -4" /><path d="M3 3l6 6" /><path d="M5 15l4 0l0 4" /><path d="M3 21l6 -6" /><path d="M19 9l-4 0l0 -4" /><path d="M15 9l6 -6" /><path d="M19 15l-4 0l0 4" /><path d="M15 15l6 6" /></svg>  
                      <svg class='open-expand' xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-maximize" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 4l4 0l0 4" /><path d="M14 10l6 -6" /><path d="M8 20l-4 0l0 -4" /><path d="M4 20l6 -6" /><path d="M16 20l4 0l0 -4" /><path d="M14 14l6 6" /><path d="M8 4l-4 0l0 4" /><path d="M4 4l6 6" /></svg>
                      </span>
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                      </a>
                    
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="chart-invice-data"></div>
                  </div>
                </div>
              </div>




              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-tasks-overview"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Card actions</h3>
                    <div class="card-actions btn-actions">
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/refresh -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                      </a>
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                      </a>
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                      </a>
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                      </a>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-100" preserveAspectRatio="none" width="400" height="200" viewBox="0 0 400 200" fill="transparent" stroke="var(--tblr-border-color, #b8cef1)">
                      <line x1="0" y1="0" x2="400" y2="200"></line>
                      <line x1="0" y1="200" x2="400" y2="0"></line>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Card actions</h3>
                    <div class="card-actions btn-actions">
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/refresh -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                      </a>
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                      </a>
                      <a href="#" class="btn-action" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-maximize" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 4l4 0l0 4" /><path d="M14 10l6 -6" /><path d="M8 20l-4 0l0 -4" /><path d="M4 20l6 -6" /><path d="M16 20l4 0l0 -4" /><path d="M14 14l6 6" /><path d="M8 4l-4 0l0 4" /><path d="M4 4l6 6" /></svg>
                      </a>
                      <a href="#" class="btn-action" ><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                      </a>
                      <!-- 
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                      </a> -->
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-100" preserveAspectRatio="none" width="400" height="200" viewBox="0 0 400 200" fill="transparent" stroke="var(--tblr-border-color, #b8cef1)">
                      <line x1="0" y1="0" x2="400" y2="200"></line>
                      <line x1="0" y1="200" x2="400" y2="0"></line>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-2"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-3"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-4"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-5"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-6"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-7"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-8"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-9"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-10"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-completion-tasks-11"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-tasks"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-line-stroke"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-stepline"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-temperature"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-area"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-area-spline"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-area-spline-stacked"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-spline"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-scatter"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-xl-4">
                <div class="card">
                  <div class="card-body">
                    <div id="chart-combination"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
    $(document).ready(function() {
        $(".close-expand").hide();
        
        $('#expand-btn').click(function() {
            var card = $(this).closest('.card');

            if (!card.hasClass('fullscreen')) {
                card.addClass('fullscreen');
                $('body').addClass('fullscreen-card');
                $(".close-expand").show();
                $(".open-expand").hide();
            } else {
                card.removeClass('fullscreen');
                $('body').removeClass('fullscreen-card');
                $(".close-expand").hide();
                $(".open-expand").show();
            }
        });
    });
    </script>
    <script>
     


        // Extract PHP data to JavaScript
        var supplier = <?php echo json_encode($supplier); ?>;

        // Prepare data for chart
        var supplierNames = [];
        var totalInvoiceAmounts = [];

        supplier.forEach(function(invoice) {
            supplierNames.push(invoice.SUPPLIER_NAME);
            totalInvoiceAmounts.push(parseFloat(invoice.Total_Invoice_Amount));
        });

        // Create ApexCharts
       var options1 = {
    chart: {
        type: 'bar',
        height: 313,
        toolbar: {
            show: false // Hide toolbar
        },
        foreColor: '#333' // Color for text elements
    },
    series: [{
        name: 'Total Invoice Amount',
        data: totalInvoiceAmounts,
        colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800'] // Custom colors for bars
    }],
    xaxis: {
        categories: supplierNames,
        labels: {
            style: {
                colors: '#333' // Color for x-axis labels
            }
        }
    },
    yaxis: {
        title: {
            text: 'Amount',
            style: {
                color: '#333' // Color for y-axis title
            }
        }
    },
    plotOptions: {
        bar: {
            horizontal: false, // Set to true for horizontal bars
            columnWidth: '50%', // Adjust width of bars
            endingShape: 'rounded' // Shape of bar ends
        }
    },
    dataLabels: {
        enabled: true,// Disable data labels
    },
    grid: {
        borderColor: '#f1f1f1' // Color of grid lines
    },
    legend: {
        show: true, // Show legend
        position: 'top', // Position of legend
        horizontalAlign: 'right', // Alignment of legend
        fontSize: '14px',
        offsetY: 0,
        labels: {
            colors: '#333' // Color for legend labels
        },
        markers: {
            width: 12,
            height: 12,
            strokeWidth: 0,
            strokeColor: '#fff',
            fillColors: undefined,
            radius: 12,
            offsetX: 0,
            offsetY: 0
        },
        itemMargin: {
            horizontal: 10,
            vertical: 0
        }
    },
    tooltip: {
        theme: 'light', // Tooltip theme
        x: {
            show: true // Show x-axis tooltip
        }
    }
};

 document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart_supplier'), options1)).render();
       
     });

    </script>

  <script>
        // Extract PHP data to JavaScript
        var company = <?php echo json_encode($company); ?>;

        // Prepare data for chart
        var companyNames = [];
        var totalInvoiceAmounts = [];

        company.forEach(function(invoice) {
            companyNames.push(invoice.SUPPLIER_NUMBER);
            totalInvoiceAmounts.push(parseFloat(invoice.Total_Invoice_Amount));
        });

        // Create ApexCharts
        var options = {
            chart: {
                type: 'bar',
                height: 313,
            parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			}},
            series: [{
                name: 'Total Invoice Amount',
                data: totalInvoiceAmounts
            }],
            xaxis: {
                categories: companyNames
            }
        };

document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart_company'), options)).render();
       
     });
    </script>



 <script>
        // Data passed from controller
        var invoiceData = <?php echo json_encode($invoice_data); ?>;

        // Extracting dates and amounts from the data
        var dates = invoiceData.map(item => item.INVOICE_POSTING_DATE);
        var amounts = invoiceData.map(item => item.Total_Invoice_Amount);

        // Creating a line chart with ApexCharts
        var options3 = {
            chart: {
                type: 'line',
                height: 400
            },
            series: [{
                name: 'Total Invoice Amount',
                data: amounts
            }],
            xaxis: {
                categories: dates,
                labels: {
                    rotate: -45, // Rotate x-axis labels for better readability
                    rotateAlways: true,
                    formatter: function (val, timestamp) {
                        return new Date(val).toLocaleDateString(); // Format dates
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Total Invoice Amount'
                }
            },
            title: {
                text: 'Total Invoice Amount Over Time',
                align: 'center'
            },
            dataLabels: {
                enabled: false // Disable data labels
            }
        };

        document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart-invice-data'), options3)).render();
       
     });

    </script>






<!-- <script>
    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });
</script> -->
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>