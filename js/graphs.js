'use strict';

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
            backgroundColor: color(window.chartColors.red).alpha(0.4).rgbString(),
            borderColor: window.chartColors.red,
            data: hoursData,
            type: 'bar',
            pointRadius: 0,
            fill: false,
            lineTension: 0.2,
            borderWidth: 2
        },
            {
                label: 'Overtime',
                backgroundColor: color(window.chartColors.yellow).alpha(0.4).rgbString(),
                borderColor: window.chartColors.yellow,
                data: overtimeData,
                type: 'bar',
                pointRadius: 0,
                fill: true,
                lineTension: 0.2,
                borderWidth: 2
            },
            {
                label: 'Holidays',
                backgroundColor: color(window.chartColors.purple).alpha(0.4).rgbString(),
                borderColor: window.chartColors.purple,
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

document.getElementById('reportUpdate').addEventListener('click', function () {

    var type = document.getElementById('type').value,
        stackRadioBoolean = document.getElementById('stackTrue').checked,
        smoothRadioBoolean = document.getElementById('smoothTrue').checked,
		fillLinesBoolean = document.getElementById('fillTrue').checked,
		highContrastMode = document.getElementById('highContrastTrue').checked;

    //Update the graph config from input values
    cfg.type = type;
    cfg.options.scales.xAxes[0].stacked = stackRadioBoolean;
    cfg.options.scales.yAxes[0].stacked = stackRadioBoolean;

    //change each dataset
    chart.config.data.datasets.forEach(function(entry) {

        var rgba = entry.backgroundColor.substring(entry.backgroundColor.indexOf('(') + 1, entry.backgroundColor.lastIndexOf(')')).split(/,\s*/);
            //set the alpha of the rgb depending on highContrastMode value
            rgba[3] = highContrastMode ? "1" : "0.4";

       entry.type = type;
       entry.lineTension = smoothRadioBoolean ? 0.4 : 0.000001;
	   entry.fill = fillLinesBoolean;
	   entry.backgroundColor = "rgba("+rgba+")";
    });

    chart.update();
});

