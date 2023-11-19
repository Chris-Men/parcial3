<div>
    <div id="container" style="width:100%; height:400px;"></div>
    <div id="containercategorie" style="width:100%; height:400px;"></div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {

        const ProductCount = {{ $var['productos'] }};
        const chart = Highcharts.chart('container', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Productos en sistema',
                align: 'left'
            },
            xAxis: {
                categories: ['Total de productos'],
                title: {
                    text: null
                },
                gridLineWidth: 1,
                lineWidth: 0
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Cantidad',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                },
                gridLineWidth: 0
            },
            plotOptions: {
                bar: {
                    borderRadius: '10%',
                    dataLabels: {
                        enabled: true
                    },
                    groupPadding: 0.15
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Productos',
                data: [ProductCount] // Usa el valor de pacientes en el gráfico
            }]
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const CategoriaCount = {{ $var['categories'] }};
        const chart = Highcharts.chart('containercategorie', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Categorias en sistema',
                align: 'left'
            },
            xAxis: {
                categories: ['Total de categorias'],
                title: {
                    text: null
                },
                gridLineWidth: 1,
                lineWidth: 0
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Cantidad',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                },
                gridLineWidth: 0
            },
            plotOptions: {
                bar: {
                    borderRadius: '50%',
                    dataLabels: {
                        enabled: true
                    },
                    groupPadding: 0.1
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Categorias',
                data: [CategoriaCount]
            }]
        });
    });
</script>
