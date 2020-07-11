<style>
  #chartpie,
  #chartline {
    width: 100%;
    height: 500px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Statistik</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Statistik</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow shadow">
          <div class="inner">
            <h3>50</h3>
            <p>Aset Sekarang</p>
          </div>
          <div class="icon">
            <i class="fa fa-hourglass-start"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue shadow">
          <div class="inner">
            <h3>30</h3>
            <p>Aset Dipakai</p>
          </div>
          <div class="icon">
            <i class="fa fa-refresh"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green shadow">
          <div class="inner">
            <h3>70</h3>
            <p>Aset Tanah</p>
          </div>
          <div class="icon">
            <i class="fa fa-check-circle-o"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red shadow">
          <div class="inner">
            <h3>23</h3>
            <p>Aset Bersertifikat</p>
          </div>
          <div class="icon">
            <i class="fa fa-times-circle-o"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-8">
        <div class="box box-success shadow">
          <!-- /.box-header -->
          <div class="box-header">
            <div class="row">
              <div class="col-md-12">
                <h4>
                  Jumlah Perbandingan Aset Setiap Kecamatan
                </h4>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div id="chartline" style="height: 500px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <div class="box box-success shadow">
          <!-- /.box-header -->
          <div class="box-header">
            <div class="row">
              <div class="col-md-12">
                <h4>
                  Jumlah Perbandingan Aset saat ini
                </h4>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div id="chartpie" style="height: 500px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>

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

<script>
  am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    var chartline = am4core.create("chartline", am4charts.XYChart);

    chartline.data = [{
      "country": "USA",
      "visits": 2025
    }, {
      "country": "China",
      "visits": 1882
    }, {
      "country": "Japan",
      "visits": 1809
    }, {
      "country": "Germany",
      "visits": 1322
    }, {
      "country": "UK",
      "visits": 1122
    }, {
      "country": "France",
      "visits": 1114
    }, {
      "country": "India",
      "visits": 984
    }, {
      "country": "Spain",
      "visits": 711
    }, {
      "country": "Netherlands",
      "visits": 665
    }, {
      "country": "Russia",
      "visits": 580
    }, {
      "country": "South Korea",
      "visits": 443
    }, {
      "country": "Canada",
      "visits": 441
    }];

    chartline.padding(40, 40, 40, 40);

    var categoryAxis = chartline.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.minGridDistance = 60;
    categoryAxis.renderer.inversed = true;
    categoryAxis.renderer.grid.template.disabled = true;

    var valueAxis = chartline.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;
    valueAxis.extraMax = 0.1;
    //valueAxis.rangeChangeEasing = am4core.ease.linear;
    //valueAxis.rangeChangeDuration = 1500;

    var series = chartline.series.push(new am4charts.ColumnSeries());
    series.dataFields.categoryX = "country";
    series.dataFields.valueY = "visits";
    series.tooltipText = "{valueY.value}"
    series.columns.template.strokeOpacity = 0;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.cornerRadiusTopLeft = 10;
    //series.interpolationDuration = 1500;
    //series.interpolationEasing = am4core.ease.linear;
    var labelBullet = series.bullets.push(new am4charts.LabelBullet());
    labelBullet.label.verticalCenter = "bottom";
    labelBullet.label.dy = -10;
    labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.')}";

    chartline.zoomOutButton.disabled = true;

    // as by default columns of the same series are of the same color, we add adapter which takes colors from chartline.colors color set
    series.columns.template.adapter.add("fill", function(fill, target) {
      return chartline.colors.getIndex(target.dataItem.index);
    });

    setInterval(function() {
      am4core.array.each(chartline.data, function(item) {
        item.visits += Math.round(Math.random() * 200 - 100);
        item.visits = Math.abs(item.visits);
      })
      chartline.invalidateRawData();
    }, 2000)

    categoryAxis.sortBySeries = series;
    // end am4core.ready()

    var chartpie = am4core.create("chartpie", am4charts.PieChart3D);
    chartpie.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chartpie.data = [{
        country: "Lithuania",
        litres: 501.9
      },
      {
        country: "Czech Republic",
        litres: 301.9
      },
      {
        country: "Ireland",
        litres: 201.1
      },
      {
        country: "Germany",
        litres: 165.8
      },
      {
        country: "Australia",
        litres: 139.9
      },
      {
        country: "Austria",
        litres: 128.3
      }
    ];

    chartpie.innerRadius = am4core.percent(40);
    chartpie.depth = 120;

    chartpie.legend = new am4charts.Legend();

    var series = chartpie.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "litres";
    series.dataFields.depthValue = "litres";
    series.dataFields.category = "country";
    series.slices.template.cornerRadius = 5;
    series.colors.step = 3;
    series.labels.template.disabled = true;

  }); // end am4core.ready()
</script>