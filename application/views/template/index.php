<!-- Content Wrapper. Contains page content -->
<style>
  #risalah_sidang,
  #kecelakaan {
    width: 100%;
    height: 500px;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard</h1>
  </section>

  <!-- Main content -->
  <section class="content">
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
<script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
<script type="text/javascript">
  var chart = AmCharts.makeChart("kt_amcharts_6", {
    "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled": true,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
      "id": "v1",
      "axisAlpha": 0,
      "position": "left",
      "ignoreAxisWidth": true
    }],
    "balloon": {
      "borderThickness": 1,
      "shadowAlpha": 0
    },
    "graphs": [{
      "id": "g1",
      "balloon": {
        "drop": true,
        "adjustBorderColor": false,
        "color": "#ffffff"
      },
      "bullet": "round",
      "bulletBorderAlpha": 1,
      "bulletColor": "#FFFFFF",
      "bulletSize": 5,
      "hideBulletsCount": 50,
      "lineThickness": 2,
      "title": "red line",
      "useLineColorForBulletBorder": true,
      "valueField": "value",
      "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
    }],
    "chartScrollbar": {
      "graph": "g1",
      "oppositeAxis": false,
      "offset": 30,
      "scrollbarHeight": 80,
      "backgroundAlpha": 0,
      "selectedBackgroundAlpha": 0.1,
      "selectedBackgroundColor": "#888888",
      "graphFillAlpha": 0,
      "graphLineAlpha": 0.5,
      "selectedGraphFillAlpha": 0,
      "selectedGraphLineAlpha": 1,
      "autoGridCount": true,
      "color": "#AAAAAA"
    },
    "chartCursor": {
      "pan": true,
      "valueLineEnabled": true,
      "valueLineBalloonEnabled": true,
      "cursorAlpha": 1,
      "cursorColor": "#258cbb",
      "limitToGraph": "g1",
      "valueLineAlpha": 0.2,
      "valueZoomable": true
    },
    "valueScrollbar": {
      "oppositeAxis": false,
      "offset": 50,
      "scrollbarHeight": 10
    },
    "categoryField": "date",
    "categoryAxis": {
      "parseDates": true,
      "dashLength": 1,
      "minorGridEnabled": true
    },
    "dataProvider": <?php echo json_encode($chart, JSON_NUMERIC_CHECK); ?>
  });

  chart.addListener("rendered", zoomChart);

  zoomChart();

  function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
  }

  am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("risalah_sidang", am4charts.XYChart3D);

    // Add data
    chart.data = <?php echo json_encode($chart_2, JSON_NUMERIC_CHECK); ?>;

    // Create axes
    let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "date";
    categoryAxis.renderer.labels.template.rotation = 270;
    categoryAxis.renderer.labels.template.hideOversized = false;
    categoryAxis.renderer.minGridDistance = 20;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.tooltip.label.rotation = 270;
    categoryAxis.tooltip.label.horizontalCenter = "right";
    categoryAxis.tooltip.label.verticalCenter = "middle";

    let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.title.text = "Values";
    valueAxis.title.fontWeight = "bold";

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries3D());
    series.dataFields.valueY = "value";
    series.dataFields.categoryX = "date";
    series.name = "Value";
    series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    series.columns.template.fillOpacity = .8;

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;
    columnTemplate.stroke = am4core.color("#FFFFFF");

    columnTemplate.adapter.add("fill", function(fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    })

    columnTemplate.adapter.add("stroke", function(stroke, target) {
      return chart.colors.getIndex(target.dataItem.index);
    })

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

  }); // end am4core.ready()

  am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    var chart = am4core.create('kecelakaan', am4charts.XYChart)
    chart.colors.step = 2;

    chart.legend = new am4charts.Legend()
    chart.legend.position = 'top'
    chart.legend.paddingBottom = 20
    chart.legend.labels.template.maxWidth = 95

    var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
    xAxis.dataFields.category = 'category'
    xAxis.renderer.cellStartLocation = 0.1
    xAxis.renderer.cellEndLocation = 0.9
    xAxis.renderer.grid.template.location = 0;

    var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
    yAxis.min = 0;

    function createSeries(value, name) {
      var series = chart.series.push(new am4charts.ColumnSeries())
      series.dataFields.valueY = value
      series.dataFields.categoryX = 'category'
      series.name = name

      series.events.on("hidden", arrangeColumns);
      series.events.on("shown", arrangeColumns);

      var bullet = series.bullets.push(new am4charts.LabelBullet())
      bullet.interactionsEnabled = false
      bullet.dy = 30;
      bullet.label.text = '{valueY}'
      bullet.label.fill = am4core.color('#ffffff')

      return series;
    }

    chart.data = <?php echo json_encode($chart_3, JSON_NUMERIC_CHECK); ?>;


    createSeries('first', 'Tempat Kerja');
    createSeries('second', 'Bukan Tempat Kerja');

    function arrangeColumns() {

      var series = chart.series.getIndex(0);

      var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
      if (series.dataItems.length > 1) {
        var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
        var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
        var delta = ((x1 - x0) / chart.series.length) * w;
        if (am4core.isNumber(delta)) {
          var middle = chart.series.length / 2;

          var newIndex = 0;
          chart.series.each(function(series) {
            if (!series.isHidden && !series.isHiding) {
              series.dummyData = newIndex;
              newIndex++;
            } else {
              series.dummyData = chart.series.indexOf(series);
            }
          })
          var visibleCount = newIndex;
          var newMiddle = visibleCount / 2;

          chart.series.each(function(series) {
            var trueIndex = chart.series.indexOf(series);
            var newIndex = series.dummyData;

            var dx = (newIndex - trueIndex + middle - newMiddle) * delta

            series.animate({
              property: "dx",
              to: dx
            }, series.interpolationDuration, series.interpolationEasing);
            series.bulletsContainer.animate({
              property: "dx",
              to: dx
            }, series.interpolationDuration, series.interpolationEasing);
          })
        }
      }
    }

  }); // end am4core.ready()
</script>