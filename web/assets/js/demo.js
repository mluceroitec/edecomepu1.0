type = ['','info','success','warning','danger'];


demo = {
    initPickColor: function(){
        $('.pick-class-label').click(function(){
            var new_class = $(this).attr('new-class');
            var old_class = $('#display-buttons').attr('data-class');
            var display_div = $('#display-buttons');
            if(display_div.length) {
            var display_buttons = display_div.find('.btn');
            display_buttons.removeClass(old_class);
            display_buttons.addClass(new_class);
            display_div.attr('data-class', new_class);
            }
        });
    },

    initFormExtendedDatetimepickers: function(){
        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
         });
    },

    initDocumentationCharts: function(){
        /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */

        dataDailySalesChart = {
            labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
            series: [
                [12, 17, 7, 17, 23, 18, 318]
            ]
        };

        optionsDailySalesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: { top: 0, right: 5, bottom: 0, left: 0},
        };

        var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

        md.startAnimationForLineChart(dailySalesChart);
    },


    //-----------------------Grafico de fechas rango de fechas y problematicas

    initDashboardPageCharts: function(){
        var fecha=new Date();
        day=fecha.getDate();
        year=fecha.getFullYear();
        var meses = new Array();
        meses[1] = "Enero";
        meses[2] = "Febrero";
        meses[3] = "Marzo";
        meses[4] = "Abril";
        meses[5] = "Mayo";
        meses[6] = "Junio";
        meses[7] = "Julio";
        meses[8] = "Agosto";
        meses[9] = "Septiembre";
        meses[10] = "Octubre";
        meses[11] = "Noviembre";
        meses[12] = "Diciembre";
        var fechaatras="";
        var fechas= [];

        var month=fecha.getMonth();
        fechas[0]=meses[month];

        for (i = 1; i < 4; i++) {
            var month=fecha.getMonth()-i;
            fechas[i]=meses[month];

        }
        console.log(fechas);
        var month=meses[fecha.getMonth()+1];

        var hoy=month+" ";
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/sql_fecha",
            data: {optio:''}
        }).done(function (data) {
            var marcadores = JSON.stringify(data);
            var obj = $.parseJSON(marcadores);
            var max=6;
            var z;
            for (z in obj) {
                if (max <= obj[z].cantidad){
                    max= obj[z].cantidad;
                }
            }
            dataDailySalesChart = {
                labels: [fechas[3], fechas[2], fechas[1],fechas[0], hoy,"Año: "+year],
                series: [
                    [obj[3].cantidad,obj[2].cantidad,obj[1].cantidad, obj[0].cantidad,obj[4].cantidad]
                ]
            };
            optionsDailySalesChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: max, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: { top: 15, right: 5, bottom: 0, left: 0},
            };

            var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

            md.startAnimationForLineChart(dailySalesChart);



        });
        /* ----------==========     Daily Sales Chart initialization    ==========---------- */


        //-----------------------Grafico azul de problematicas resueltas.

        /* ----------==========     Completed Tasks Chart initialization    ==========---------- */
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/sql_grafico",
            data: {optio:''}
        }).done(function (data) {
            var marcadores = JSON.stringify(data);
            var obj = $.parseJSON(marcadores);
            console.log(obj[0].cantidad);
            // obj[0].cantidad, obj[1].cantidad, obj[2].cantidad, obj[3].cantidad, obj[4].cantidad, obj[5].cantidad
            dataCompletedTasksChart = {
                labels: [obj[0].nombre, obj[1].nombre, obj[2].nombre, obj[3].nombre, obj[4].nombre, obj[5].nombre],
                series: [
                    [obj[0].cantidad, obj[1].cantidad, obj[2].cantidad,obj[3].cantidad, obj[4].cantidad,obj[5].cantidad ]
                ]
            };
            var maxx=6;
            var o;
            for (o in obj) {
                if (maxx <= obj[o].cantidad){
                    maxx= obj[o].cantidad;
                }
            }
            optionsCompletedTasksChart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: maxx, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                chartPadding: { top: 20, right: 5, bottom: 0, left: 0},
            };

            var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

            // start animation for the Completed Tasks Chart - Line Chart
            md.startAnimationForLineChart(completedTasksChart);
        });



        //-----------------------Grafico  orange de problematicas cargadas
        /* ----------==========     Emails Subscription Chart initialization    ==========---------- */

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/graficos",
            data: {optio:''}
        }).done(function (data) {
            var marcadores= JSON.stringify(data);
            var obj = $.parseJSON(marcadores);
            var mayor=6;
            var x;
            for (x in obj) {
                if (mayor <= obj[x].cantidad){
                    mayor= obj[x].cantidad;
                }
            }
            var dataEmailsSubscriptionChart = {

                labels: [obj[0].nombre,"",obj[1].nombre,"", obj[2].nombre,"", obj[3].nombre,"",obj[4].nombre,"", obj[5].nombre],
                series: [
                    [obj[0].cantidad,"", obj[1].cantidad,"", obj[2].cantidad,"",obj[3].cantidad,"",obj[4].cantidad,"",obj[5].cantidad]

                ]

            };

            var optionsEmailsSubscriptionChart = {
                axisX: {
                    showGrid: false
                },
                low: 0,
                high: mayor,
                chartPadding: { top: 0, right: 5, bottom: 0, left: 0}
            };
            var responsiveOptions = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];
            var emailsSubscriptionChart = Chartist.Bar('#emailsSubscriptionChart', dataEmailsSubscriptionChart, optionsEmailsSubscriptionChart, responsiveOptions);


        });

        /* ----------==========     ESTE LO ESTOY INVENTANDO    ==========---------- */

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/sql_graficocalle",
            data: {optio:''}
        }).done(function (data) {
            var marcadores= JSON.stringify(data);
            var obj = $.parseJSON(marcadores);
            var mayor=6;
            var x;
            for (x in obj) {
                if (mayor <= obj[x].cantidad){
                    mayor= obj[x].cantidad;
                }
            }
            console.log(obj[0].calle);
            console.log(obj[0].cantidad);
            var dataEmailsSubscriptionChart = {

                labels: [obj[0].calle,obj[1].calle, obj[2].calle, obj[3].calle,obj[4].calle,obj[5].calle],
                series: [
                    [obj[0].cantidad,obj[1].cantidad,obj[2].cantidad,obj[3].cantidad,obj[4].cantidad,obj[5].cantidad]

                ]

            };

            var optionsEmailsSubscriptionChart = {
                axisX: {
                    showGrid: false
                },
                low: 0,
                high: mayor,
                chartPadding: { top:15, right: 5, bottom: 0, left: 0}
            };
            var responsiveOptions = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];
            var cuartografico = Chartist.Bar('#cuartografico', dataEmailsSubscriptionChart, optionsEmailsSubscriptionChart, responsiveOptions);


        });


    },


    initGoogleMaps: function(){
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
          zoom: 13,
          center: myLatlng,
          scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
          styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]

        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Hello World!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
    },

	showNotification: function(from, align){
    	color = Math.floor((Math.random() * 4) + 1);

    	$.notify({
        	icon: "notifications",
        	message: "Welcome to <b>Material Dashboard</b> - a beautiful freebie for every web developer."

        },{
            type: type[color],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
	}



};
