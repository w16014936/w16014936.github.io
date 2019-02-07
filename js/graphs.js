var jsonfile = {
    "jsonarray": [{
        "name": "Matthew",
        "hours": 20,
        "overtime": 16,
        "holiday": 2
    }, {
        "name": "Tom",
        "hours": 45,
        "overtime": 10,
        "holiday": 0
    }, {
        "name": "Elliott",
        "hours": 12,
        "overtime": 3,
        "holiday": 20
    }, {
        "name": "Chris",
        "hours": 4,
        "overtime": 5,
        "holiday": 38
    }]
};

var labels = jsonfile.jsonarray.map(function (e) {
    return e.name;
});
var hoursData = jsonfile.jsonarray.map(function (e) {
    return e.hours;
});
var overtimeData = jsonfile.jsonarray.map(function (e) {
    return e.overtime;
});
var holidayData = jsonfile.jsonarray.map(function (e) {
    return e.holiday;
});

let canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

var color = Chart.helpers.color;
var cfg = {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Normal Hours',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            data: hoursData,
            type: 'bar',
            pointRadius: 0,
            fill: true,
            lineTension: 0.2,
            borderWidth: 2
        },
            {
                label: 'Overtime',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                data: overtimeData,
                type: 'bar',
                pointRadius: 0,
                fill: true,
                lineTension: 0.2,
                borderWidth: 2
            },
            {
                label: 'Holidays',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.green,
                data: holidayData,
                type: 'bar',
                pointRadius: 0,
                fill: true,
                lineTension: 0.2,
                borderWidth: 2
            }]
    },
    options: {
        scales: {
            xAxes: [{
                stacked: true,
                type: 'category',
                labels: labels,

            }],
            yAxes: [{
                stacked: true,
                ticks: {
                    beginAtZero: true
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Total Hours',
                }
            }]
        }
    }
};
var chart = new Chart(context, cfg);
document.getElementById('update').addEventListener('click', function () {
    var type = document.getElementById('type').value;
    chart.config.data.datasets[0].type = type;
    chart.config.data.datasets[1].type = type;
    chart.config.data.datasets[2].type = type;


    chart.update();
});