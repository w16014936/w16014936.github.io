'use strict';

    var chartType          = document.getElementById('type'),
	    smoothLines        = document.getElementById('smoothLines'),
        smoothLineSlider   = document.getElementById('smoothLineSlider'),
        pointRadius        = document.getElementById('pointRadius'),
        pointRadiusSlider  = document.getElementById('pointRadiusSlider'),
		fillSpace		   = document.getElementById('fillSpace'),
        startDatePicker    = document.getElementById('startDate'),
        endDatePicker      = document.getElementById('endDate');


    const jsonfile =
        [
            {
                name: "Carole Sheppard",
                normal: 33,
                overtime: 2,
                holiday: 6
            },
            {
                name: "Toni Case",
                normal: 30,
                overtime: 6,
                holiday: 13
            },
            {
                name: "Hernandez Cameron",
                normal: 30,
                overtime: 7,
                holiday: 20
            },
            {
                name: "Sonja Gutierrez",
                normal: 37,
                overtime: 2,
                holiday: 18
            },
            {
                name: "Anna Burch",
                normal: 38,
                overtime: 7,
                holiday: 19
            },
            {
                name: "Clemons Mccarty",
                normal: 30,
                overtime: 4,
                holiday: 12
            },
            {
                name: "Kathie Nash",
                normal: 39,
                overtime: 5,
                holiday: 0
            },
            {
                name: "Foster Graham",
                normal: 33,
                overtime: 5,
                holiday: 10
            },
            {
                name: "Yolanda Riddle",
                normal: 32,
                overtime: 3,
                holiday: 15
            },
            {
                name: "Duncan Mays",
                normal: 33,
                overtime: 10,
                holiday: 2
            },
            {
                name: "Sherri Mullins",
                normal: 31,
                overtime: 2,
                holiday: 4
            },
            {
                name: "Berry Brown",
                normal: 38,
                overtime: 6,
                holiday: 3
            },
            {
                name: "Zimmerman Jacobs",
                normal: 38,
                overtime: 3,
                holiday: 7
            },
            {
                name: "Sharpe Le",
                normal: 38,
                overtime: 4,
                holiday: 13
            },
            {
                name: "Nell Justice",
                normal: 34,
                overtime: 5,
                holiday: 17
            },
            {
                name: "Petersen Bonner",
                normal: 38,
                overtime: 4,
                holiday: 12
            },
            {
                name: "Dillard Allison",
                normal: 30,
                overtime: 2,
                holiday: 13
            },
            {
                name: "Katherine Dawson",
                normal: 30,
                overtime: 8,
                holiday: 5
            },
            {
                name: "Karin Bernard",
                normal: 30,
                overtime: 1,
                holiday: 4
            },
            {
                name: "Lorie Harding",
                normal: 30,
                overtime: 0,
                holiday: 12
            },
            {
                name: "Callahan Benton",
                normal: 30,
                overtime: 8,
                holiday: 6
            },
            {
                name: "Vanessa Kent",
                normal: 36,
                overtime: 3,
                holiday: 11,
            },
            {
                name: "Hays Clay",
                normal: 31,
                overtime: 10,
                holiday: 6
            },
            {
                name: "Nicole Figueroa",
                normal: 31,
                overtime: 5,
                holiday: 0
            },
            {
                name: "Petersen Bonner",
                normal: 38,
                overtime: 4,
                holiday: 12
            },
            {
                name: "Dillard Allison",
                normal: 30,
                overtime: 2,
                holiday: 13
            },
            {
                name: "Katherine Dawson",
                normal: 30,
                overtime: 8,
                holiday: 5
            },
            {
                name: "Karin Bernard",
                normal: 30,
                overtime: 1,
                holiday: 4
            },
            {
                name: "Lorie Harding",
                normal: 30,
                overtime: 0,
                holiday: 12
            },
            {
                name: "Callahan Benton",
                normal: 30,
                overtime: 8,
                holiday: 6
            },
            {
                name: "Vanessa Kent",
                normal: 36,
                overtime: 3,
                holiday: 11,
            },
            {
                name: "Hays Clay",
                normal: 31,
                overtime: 10,
                holiday: 6
            },
            {
                name: "Nicole Figueroa",
                normal: 31,
                overtime: 5,
                holiday: 0
            },
            {
                name: "Petersen Bonner",
                normal: 38,
                overtime: 4,
                holiday: 12
            },
            {
                name: "Dillard Allison",
                normal: 30,
                overtime: 2,
                holiday: 13
            },
            {
                name: "Katherine Dawson",
                normal: 30,
                overtime: 8,
                holiday: 5
            },
            {
                name: "Karin Bernard",
                normal: 30,
                overtime: 1,
                holiday: 4
            },
            {
                name: "Lorie Harding",
                normal: 30,
                overtime: 0,
                holiday: 12
            },
            {
                name: "Callahan Benton",
                normal: 30,
                overtime: 8,
                holiday: 6
            },
            {
                name: "Vanessa Kent",
                normal: 36,
                overtime: 3,
                holiday: 11,
            },
            {
                name: "Hays Clay",
                normal: 31,
                overtime: 10,
                holiday: 6
            },
            {
                name: "Nicole Figueroa",
                normal: 31,
                overtime: 5,
                holiday: 0
            },
            {
                name: "Petersen Bonner",
                normal: 38,
                overtime: 4,
                holiday: 12
            },
            {
                name: "Dillard Allison",
                normal: 30,
                overtime: 2,
                holiday: 13
            },
            {
                name: "Katherine Dawson",
                normal: 30,
                overtime: 8,
                holiday: 5
            },
            {
                name: "Karin Bernard",
                normal: 30,
                overtime: 1,
                holiday: 4
            },
            {
                name: "Lorie Harding",
                normal: 30,
                overtime: 0,
                holiday: 12
            },
            {
                name: "Callahan Benton",
                normal: 30,
                overtime: 8,
                holiday: 6
            },
            {
                name: "Vanessa Kent",
                normal: 36,
                overtime: 3,
                holiday: 11,
            },
            {
                name: "Hays Clay",
                normal: 31,
                overtime: 10,
                holiday: 6
            },
            {
                name: "Nicole Figueroa",
                normal: 31,
                overtime: 5,
                holiday: 0
            },
            {
                name: "Brady Wolfe",
                normal: 34,
                overtime: 9,
                holiday: 8
            }
        ];



var labels = jsonfile.map(function (e) {
    return e.name;
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
        datasets: createDataSets(jsonfile),
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

window.addEventListener("load", function(){

    var currentDate = new Date();
    // startDatePicker.valueAsDate = currentDate.setDate(currentDate.getDate()-7);
    endDatePicker.valueAsDate   = currentDate;
    hideConfigElements(chartType, smoothLines, pointRadius, fillSpace);
    chart.config.data.datasets.forEach(function(entry) {
        updateSlider(entry, smoothLineSlider, pointRadiusSlider);
    });

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

function createDataSets(json){

    var dataSets = [];

    //todo remove hard-coded
    var hoursData = json.map(function (e) {
        return e.normal;
    });
    var overtimeData = json.map(function (e) {
        return e.overtime;
    });
    var holidayData = json.map(function (e) {
        return e.holiday;
    });

    var objects = [];
    objects.push(hoursData);
    objects.push(overtimeData);
    objects.push(holidayData);


    var keys = [];

    //get chart labels using keys from the json file
    Object.keys(json[0]).forEach(function(key){
        if (key !== "name")
            keys.push(key.charAt(0).toUpperCase() + key.slice(1));
    });

    var i = 0;

    //creates each dataset
   objects.forEach(function(data){
       var dataSet = {
        label: keys[i],
        backgroundColor:  window.chartColors[Object.keys(window.chartColors)[i]],
        borderColor: window.chartColors[Object.keys(window.chartColors)[i]],
        data: Object.values(data),
        type: 'line',
        pointRadius: 5,
        fill: false,
        lineTension: 0.2,
        borderWidth: 2
    };

    i++;
    dataSets.push(dataSet);
   });

    return dataSets;
}