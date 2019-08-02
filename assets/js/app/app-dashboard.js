define([
    "jQuery",
    "jQueryUI",
    "sidebar",
	"bootstrap",   
    "datatables",  
    "datatablesBootstrap", 
    "treeview",
    "highchart",
    "moment"
	], function (
    $,
    jQueryUI,
	bootstrap,
     datatables,
    datatablesBootstrap,  
    sidebar, 
    treeview,
    highchart,
    moment
	) {
    return {  
        table:null,
        init: function () { 
        	App.initFunc();
            App.initEvent();  
            console.log("LOADED");
            App.initChart();
            $(".loadingpage").hide();
		}, 
        initEvent : function(){   
            App.table = $('#table-dashboard').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"dashboard/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "order_date" },
                    { "data": "order_type" },
                    { "data": "workshop_name" },
                    { "data": "driver_name" }, 
                    { "data": "no_police" },
                    { "data": "unit_merk" },
                    { "data": "unit_model" }, 
                    { "data": "total" }, 
                    { "data": "status" ,"orderable": false}
                ]      
            }); 
        },
        initChart:function(){  

            var weekNumber = moment().week();
            console.log(weekNumber);

            var beginningOfWeek = moment().week(weekNumber).startOf('week');
            var endOfWeek = moment().week(weekNumber).startOf('week').add(6, 'days');
             
            var startWeek = parseInt(beginningOfWeek.format('D'))+1;
            var endWeek = parseInt(endOfWeek.format('D'))+1;
            var date = [];
            var number = 0;
            for (var i = startWeek; i <= endWeek; i++) {
                 
                date.push(i+" "+moment().format("MMMM"));
            }
            console.log(date);
            $.ajax({
              method: "GET",
              url: App.baseUrl+"report/getReportOrderByMonth"
            }).done(function( msg ) { 
                console.log(msg);
                var response = JSON.parse(msg);
                Highcharts.chart('monthly', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Pelayanan PAR Per Bulan'
                    }, 
                    xAxis: {
                        categories: [
                            'Jan',
                            'Feb',
                            'Mar',
                            'Apr',
                            'May',
                            'Jun',
                            'Jul',
                            'Aug',
                            'Sep',
                            'Oct',
                            'Nov',
                            'Dec'
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Order'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    credits:false,
                    series: [{
                        name: 'Perawatan',
                        data: response.data.perawatan

                    }, {
                        name: 'Perbaikan',
                        data: response.data.perbaikan

                    }, {
                        name: 'Darurat',
                        data: response.data.darurat

                    }]
                }); 
            });
            $.ajax({
              method: "GET",
              url: App.baseUrl+"report/getReportOrderByWeek"
            }).done(function( msg ) { 
                console.log(msg);
                var response = JSON.parse(msg);
                Highcharts.chart('week', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Pelayanan PAR Per Minggu'
                    }, 
                    xAxis: {
                        categories:date,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Order'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    credits:false,
                    series: [{
                        name: 'Perawatan',
                        data: response.data.perawatan

                    }, {
                        name: 'Perbaikan',
                        data: response.data.perbaikan

                    }, {
                        name: 'Darurat',
                        data: response.data.darurat

                    }]
                });
            });
            $.ajax({
              method: "GET",
              url: App.baseUrl+"report/getReportOrderByToday"
            }).done(function( msg ) { 
                console.log(msg);
                var response = JSON.parse(msg);
                Highcharts.chart('today', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Pelayanan PAR Hari Ini'
                    }, 
                    xAxis: {
                        categories: [ 
                           moment().format("D")+" "+moment().format("MMMM")
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Order'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    credits:false,
                    series: [{
                        name: 'Waiting Approval',
                        data: [response.data.waiting]

                    }, {
                        name: 'Dalam Perbaikan',
                        data: [response.data.onprogress]

                    }, {
                        name: 'Selesai Perbaikan',
                        data: [response.data.done]

                    }]
                });
            });
        }
	}
});