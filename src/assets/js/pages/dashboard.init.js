/*
 Template Name: Foxia - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Dashboard js
 */

 // get colors array from the string

function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        if (colors) {
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(
                        newValue
                    );
                    if (color) return color;
                    else return newValue;
                } else {
                    var val = value.split(",");
                    if (val.length == 2) {
                        var rgbaColor = getComputedStyle(
                            document.documentElement
                        ).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        } else {
            console.warn('data-colors Attribute not found on:', chartId);
        }
    }
}

function ChartColorChange(chartupdate, chartId) {
    document.querySelectorAll(".theme-color").forEach(function (item) {
        item.addEventListener("click", function (event) {
            setTimeout(function () {
                var updatechartColors = getChartColorsArray(chartId);
                if (chartupdate.options) {
                    if (chartupdate.options["colors"]) {
                        chartupdate.options["colors"] = updatechartColors;
                    } else if (chartupdate.options["lineColors"]) {
                        chartupdate.options["lineColors"] = updatechartColors;
                    } else if (chartupdate.options["barColors"]) {
                        chartupdate.options["barColors"] = updatechartColors;
                    }
                    chartupdate.redraw();
                }
            }, 0);
        });
    });
}

!function ($) {
    "use strict";

    var Dashboard = function () {};
        
        //creates Stacked chart
        Dashboard.prototype.createStackedChart  = function(element, data, xkey, ykeys, labels, lineColors) {
            var barStackedChart = Morris.Bar({
                element: element,
                data: data,
                xkey: xkey,
                ykeys: ykeys,
                stacked: true,
                labels: labels,
                hideHover: 'auto',
                resize: true, //defaulted to true
                gridLineColor: 'rgba(108, 120, 151, 0.1)',
                barColors: lineColors
            });
        ChartColorChange(barStackedChart, 'morris-bar-stacked');
        },

        //creates Donut chart
        Dashboard.prototype.createDonutChart = function (element, data, colors) {
            var donutChart = Morris.Donut({
                element: element,
                data: data,
                resize: true,
                colors: colors
            });
            ChartColorChange(donutChart, 'morris-donut-example');
        },

        // pie
        $('.peity-pie').each(function () {
            $(this).peity("pie", $(this).data());
        });

        //donut
        $('.peity-donut').each(function () {
            $(this).peity("donut", $(this).data());
        });

        // line
        $('.peity-line').each(function () {
            $(this).peity("line", $(this).data());
        });


        Dashboard.prototype.init = function () {

            //creating Stacked chart
        var barStackedChartColors = getChartColorsArray("morris-bar-stacked");
        if (barStackedChartColors) {
            var $stckedData  = [
                { y: '2008', a: 45, b: 180, c: 100 },
                { y: '2009', a: 75,  b: 65, c: 80 },
                { y: '2010', a: 100, b: 90, c: 56 },
                { y: '2011', a: 75,  b: 65, c: 89 },
                { y: '2012', a: 100, b: 90, c: 120 },
                { y: '2013', a: 75,  b: 65, c: 110 },
                { y: '2014', a: 50,  b: 40, c: 85 },
                { y: '2015', a: 75,  b: 65, c: 52 },
                { y: '2016', a: 50,  b: 40, c: 77 },
                { y: '2017', a: 75,  b: 65, c: 90 },
                { y: '2018', a: 100, b: 90, c: 130 }
            ];
            this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a', 'b', 'c'], ['Desktops', 'Tablets', 'Mobiles'], barStackedChartColors);
        }



            //creating donut chart
            var donutChartColors = getChartColorsArray("morris-donut-example");
            if (donutChartColors) {
                var $donutData = [
                    {label: "Marketing", value: 12},
                    {label: "Online", value: 42},
                    {label: "Offline", value: 20}
                ];
                this.createDonutChart('morris-donut-example', $donutData, donutChartColors);
            }
        },
        //init
        $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

//initializing
    function ($) {
        "use strict";
        $.Dashboard.init();
    }(window.jQuery);