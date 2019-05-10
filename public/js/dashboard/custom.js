$(document).ready(function(){
    $.get("chart-value", function(dataChart){

        var ochart = $('#chart-sales-value');

        var salesChart = new Chart(ochart, {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return '$' + value + 'k';
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = item.yLabel;
                            var content = '';

                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }

                            content += '<span class="popover-body-value">$' + yLabel + 'k</span>';
                            return content;
                        }
                    }
                }
            },
            data: {
                labels: dataChart.label,
                datasets: [{
                    label: 'Performance',
                    data: dataChart.data
                }]
            }
        });

        ochart.data('chart', salesChart);
    });

    $.get("chart-orders", function(dataChart) {
        var OrdersChart = (function () {

            //
            // Variables
            //

            var $chart = $('#chart-orders-sales');
            var $ordersSelect = $('[name="ordersSelect"]');


            //
            // Methods
            //

            // Init chart
            function initChart($chart) {

                // Create chart
                var ordersChart = new Chart($chart, {
                    type: 'bar',
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    callback: function (value) {
                                        if (!(value % 10)) {
                                            //return '$' + value + 'k'
                                            return value
                                        }
                                    }
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function (item, data) {
                                    var label = data.datasets[item.datasetIndex].label || '';
                                    var yLabel = item.yLabel;
                                    var content = '';

                                    if (data.datasets.length > 1) {
                                        content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                    }

                                    content += '<span class="popover-body-value">' + yLabel + '</span>';

                                    return content;
                                }
                            }
                        }
                    },
                    data: {
                        labels: dataChart.label,
                        datasets: [{
                            label: 'Sales',
                            data: dataChart.data
                        }]
                    }
                });

                // Save to jQuery object
                $chart.data('chart', ordersChart);
            }


            // Init chart
            if ($chart.length) {
                initChart($chart);
            }

        })();
    });

});
