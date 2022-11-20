import ApexCharts from './../Libs/apexcharts/dist/apexcharts';


let options = {
    series: [{
        data: [21, 22, 10, 28, 16, 21, 13, 30]
    }],
    chart: {
        height: 350,
        type: 'bar',
        events: {
            click: function(chart, w, e) {
                // console.log(chart, w, e)
            }
        }
    },
    colors: ['#000','#00F','#0F0','#F00','#0FF','#FF0','#F0F'],
    plotOptions: {
        bar: {
            columnWidth: '45%',
            distributed: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    legend: {
        show: false
    },
    xaxis: {
        categories: [
            ['John', 'Doe'],
            ['Joe', 'Smith'],
            ['Jake', 'Williams'],
            'Amber',
            ['Peter', 'Brown'],
            ['Mary', 'Evans'],
            ['David', 'Wilson'],
            ['Lily', 'Roberts'],
        ],
        labels: {
            style: {
                colors: ['#000','#00F','#0F0','#F00','#0FF','#FF0','#F0F'],
                fontSize: '12px'
            }
        }
    }
};

var chart = new ApexCharts(document.querySelector("#box-charts__complete-forms"), options);
chart.render();