<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        #box-charts__complete-forms {
            font-family: Helvi, Arial, sans-serif;
        }
    </style>
</head>
<body>

<div id="box-charts__complete-forms"></div>

<script>

    async function getData() {
        return await fetch("http://localhost/mini_forms/request/?req=charting").then(data => data.json());
        //return await fetch("https://miniforms.herokuapp.com/request/?req=charting").then(data => data.json());
    }

    let dataJson = {};
    let dataClean = [];

    document.addEventListener('DOMContentLoaded', async () => {
        let dataCrude = await getData();
        let amountComplete = [];
        let titles = [];
        for (let i = 0; i < dataCrude.length; i++) {
            amountComplete.push(dataCrude[i][1]);
            titles.push([dataCrude[i][0]]);
        }
        render(titles, amountComplete);
    });

    function render(titles, amount) {
        let options = {
            series: [{
                // data: [21, 22, 10, 28, 16, 21, 13, 30]
                data: amount
            }],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                    }
                }
            },
            colors: ['#218380', '#8f2d56', '#ffbc42', '#d81159', '#6a4c93', '#8ac926', '#ff90b3', '#EF7A85'],
            plotOptions: {
                bar: {
                    columnWidth: '50%',
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
                categories: titles,
                labels: {
                    style: {
                        colors: ['#000'],
                        fontSize: '16px'
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#box-charts__complete-forms"), options);
        chart.render();
    }
</script>

</body>
</html>
