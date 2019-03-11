'use strict';

    var chartType          = document.getElementById('type'),
	    smoothLines        = document.getElementById('smoothLines'),
        smoothLineSlider   = document.getElementById('smoothLineSlider'),
        pointRadiusSlider  = document.getElementById('pointRadiusSlider'),
		fillSpace		   = document.getElementById('fillSpace'),
        startDatePicker    = document.getElementById('startDate'),
        endDatePicker      = document.getElementById('endDate');


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


var canvas = document.getElementById('canvas'),
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
            type: 'line',
            pointRadius: 5,
            fill: false,
            lineTension: 0.2,
            borderWidth: 2
        },
            {
                label: 'Overtime',
                backgroundColor: color(window.chartColors.yellow).alpha(0.4).rgbString(),
                borderColor: window.chartColors.yellow,
                data: overtimeData,
                type: 'line',
                pointRadius: 5,
                fill: true,
                lineTension: 0.2,
                borderWidth: 2
            },
            {
                label: 'Holidays',
                backgroundColor: color(window.chartColors.purple).alpha(0.4).rgbString(),
                borderColor: window.chartColors.purple,
                data: holidayData,
                type: 'line',
                pointRadius: 5,
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
                    labelString: 'Total Hours'
                }
            }]
        }
    }
};
var chart = new Chart(context, cfg);

document.addEventListener("DOMContentLoaded", function(){

    var currentDate = new Date();
    // startDatePicker.valueAsDate = currentDate.setDate(currentDate.getDate()-7);
    endDatePicker.valueAsDate   = currentDate;

});

chartType.addEventListener('change', function () {
	hideConfigElements(chartType, smoothLines, pointRadius, fillSpace);

});

smoothLineSlider.addEventListener('change', function () {
    //change each dataset
    chart.config.data.datasets.forEach(function(entry) {
        updateSlider(entry, smoothLineSlider, pointRadiusSlider);
    });
});

pointRadiusSlider.addEventListener('change', function () {
    //change each dataset
    chart.config.data.datasets.forEach(function(entry) {
        updateSlider(entry, smoothLineSlider, pointRadiusSlider);
    });
});

document.getElementById('reportUpdate').addEventListener('click', function () {
		
    var stackRadioBoolean  = document.getElementById('stackTrue').checked,
		fillLinesBoolean   = document.getElementById('fillTrue').checked,
		highContrastMode   = document.getElementById('highContrastTrue').checked,
		type 			   = chartType.value;

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
	   entry.fill = fillLinesBoolean;
	   entry.backgroundColor = "rgba("+rgba+")";

        updateSlider(entry, smoothLineSlider, pointRadiusSlider);

    });

    chart.update();
});

document.getElementById('reportConfigContainer').addEventListener('click', function () {

    setHighContrastMode(document.getElementById('highContrastTrue').checked, chartType.value);

});

function setHighContrastMode(radioChecked, type){

    var stackRadio = document.getElementById('stackRadio');

    if(radioChecked && type !== "bar"){
        document.getElementById('stackTrue').checked = true;
        document.getElementById('stackFalse').checked = false;
        stackRadio.hidden = true;
    }
    else{
        stackRadio.hidden = false;
    }
}

function updateSlider(entry, sliderLineTension, sliderPointRadius){
    if (entry.lineTension === 1 - sliderLineTension.value &&
        entry.pointRadius === sliderPointRadius.value){
        return;
    }
    entry.lineTension = 1 - sliderLineTension.value;
    entry.pointRadius = sliderPointRadius.value;
    chart.update();
}

//hides line stiffness and point radius
function hideConfigElements(chartType, smoothLines, pointRadius, fillSpace){
	smoothLines.hidden = chartType.value === "bar";
	pointRadius.hidden = chartType.value === "bar";
	fillSpace.hidden   = chartType.value === "bar";
}