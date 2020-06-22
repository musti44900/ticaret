<?php
require_once 'ayarlar/baglanti.php';
require_once 'ayarlar/function.php';
require_once 'inc/header.php';
?>

    <!-- start: page -->
    <header class="page-header">
        <h2>Kontrol Paneli</h2>

    </header>

    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-6">
            <section class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="chart-data-selector" id="salesSelectorWrapper">
                                <h2>
                                    Sales:
                                    <strong>
                                        <select class="form-control" id="salesSelector">
                                            <option value="Porto Admin" selected>Porto Admin</option>
                                            <option value="Porto Drupal">Porto Drupal</option>
                                            <option value="Porto Wordpress">Porto Wordpress</option>
                                        </select>
                                    </strong>
                                </h2>

                                <div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                    <!-- Flot: Sales Porto Admin -->
                                    <div class="chart chart-sm" data-sales-rel="Porto Admin" id="flotDashSales1"
                                         class="chart-active"></div>
                                    <script>

                                        var flotDashSales1Data = [{
                                            data: [
                                                ["Jan", 140],
                                                ["Feb", 240],
                                                ["Mar", 190],
                                                ["Apr", 140],
                                                ["May", 180],
                                                ["Jun", 320],
                                                ["Jul", 270],
                                                ["Aug", 180]
                                            ],
                                            color: "#0088cc"
                                        }];

                                        // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                    </script>

                                    <!-- Flot: Sales Porto Drupal -->
                                    <div class="chart chart-sm" data-sales-rel="Porto Drupal" id="flotDashSales2"
                                         class="chart-hidden"></div>
                                    <script>

                                        var flotDashSales2Data = [{
                                            data: [
                                                ["Jan", 240],
                                                ["Feb", 240],
                                                ["Mar", 290],
                                                ["Apr", 540],
                                                ["May", 480],
                                                ["Jun", 220],
                                                ["Jul", 170],
                                                ["Aug", 190]
                                            ],
                                            color: "#2baab1"
                                        }];

                                        // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                    </script>

                                    <!-- Flot: Sales Porto Wordpress -->
                                    <div class="chart chart-sm" data-sales-rel="Porto Wordpress" id="flotDashSales3"
                                         class="chart-hidden"></div>
                                    <script>

                                        var flotDashSales3Data = [{
                                            data: [
                                                ["Jan", 840],
                                                ["Feb", 740],
                                                ["Mar", 690],
                                                ["Apr", 940],
                                                ["May", 1180],
                                                ["Jun", 820],
                                                ["Jul", 570],
                                                ["Aug", 780]
                                            ],
                                            color: "#734ba9"
                                        }];

                                        // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                    </script>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <h2 class="panel-title mt-md">Sales Goal</h2>
                            <div class="liquid-meter-wrapper liquid-meter-sm mt-lg">
                                <div class="liquid-meter">
                                    <meter min="0" max="100" value="35" id="meterSales"></meter>
                                </div>
                                <div class="liquid-meter-selector" id="meterSalesSel">
                                    <a href="#" data-val="35" class="active">Monthly Goal</a>
                                    <a href="#" data-val="28">Annual Goal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6 col-lg-12 col-xl-6">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-primary">
                                        <i class="fa fa-product-hunt"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Ürün Sayısı</h4>
                                        <div class="info">
                                            <strong class="amount"><?
                                                $urun_say= $db->prepare("SELECT COUNT(*) FROM urunler");
                                                $urun_say ->execute();
                                                $urunsayisi= $urun_say->fetchColumn();
                                                echo $urunsayisi;
                                            ?>
                                            </strong>
                                            <span class="text-primary">
                                                <?
                                                $tarih= date("d.m.Y");
                                                $urun_say= $db->prepare("SELECT COUNT(*) FROM urunler WHERE urun_eklemetarih='$tarih' ");
                                                $urun_say ->execute();
                                                $urunsayisi= $urun_say->fetchColumn();
                                                echo "( Günün Ürünleri : ".$urunsayisi." )";
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-secondary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-secondary">
                                        <i class="fa fa-turkish-lira"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Ürünlerin Toplam Tutarları <br>(Günlük)</h4>
                                        <div class="info">
                                            <strong class="amount"><?
                                                $tarih= date("Y-m-d");
                                                $hesapla= $db->prepare("SELECT SUM(urun_fiyat) FROM urunler WHERE urun_eklemetarih LIKE '$tarih%'"); /* sorgu kısmına "where urun_eklemetarih = $tarih"  ile sorgulama yap! */
                                                $hesapla->execute();
                                                $tutar = $hesapla->fetchColumn();
                                                echo parayaz($tutar);
                                                ?>
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase">(withdraw)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-tertiary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-tertiary">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Today's Orders (Günlük sepet sayısı ekle)</h4>
                                        <div class="info">
                                            <strong class="amount">38</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase">(statement)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-quaternary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-quaternary">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Today's Visitors (günlük ziyaretçi sayısı ekle)</h4>
                                        <div class="info">
                                            <strong class="amount">3765</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase">(report)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <section class="panel">
                <header class="panel-heading panel-heading-transparent">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>

                    <h2 class="panel-title">Projects Stats</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-none">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Progress</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Porto - Responsive HTML5 Template</td>
                                <td><span class="label label-success">Success</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 100%;">
                                            100%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Porto - Responsive Drupal 7 Theme</td>
                                <td><span class="label label-success">Success</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 100%;">
                                            100%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Tucson - Responsive HTML5 Template</td>
                                <td><span class="label label-warning">Warning</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 60%;">
                                            60%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Tucson - Responsive Business WordPress Theme</td>
                                <td><span class="label label-success">Success</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 90%;">
                                            90%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Porto - Responsive Admin HTML5 Template</td>
                                <td><span class="label label-warning">Warning</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 45%;">
                                            45%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Porto - Responsive HTML5 Template</td>
                                <td><span class="label label-danger">Danger</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 40%;">
                                            40%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Porto - Responsive Drupal 7 Theme</td>
                                <td><span class="label label-success">Success</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 95%;">
                                            95%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-6 col-md-12">
            <section class="panel">
                <header class="panel-heading panel-heading-transparent">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>

                    <h2 class="panel-title">Projects Stats</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-none">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Progress</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Porto - Responsive HTML5 Template</td>
                                <td><span class="label label-success">Success</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 100%;">
                                            100%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Porto - Responsive Drupal 7 Theme</td>
                                <td><span class="label label-success">Success</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 100%;">
                                            100%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Tucson - Responsive HTML5 Template</td>
                                <td><span class="label label-warning">Warning</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 60%;">
                                            60%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Tucson - Responsive Business WordPress Theme</td>
                                <td><span class="label label-success">Success</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 90%;">
                                            90%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Porto - Responsive Admin HTML5 Template</td>
                                <td><span class="label label-warning">Warning</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 45%;">
                                            45%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Porto - Responsive HTML5 Template</td>
                                <td><span class="label label-danger">Danger</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded m-none mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 40%;">
                                            40%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Porto - Responsive Drupal 7 Theme</td>
                                <td><span class="label label-success">Success</span></td>
                                <td>
                                    <div class="progress progress-sm progress-half-rounded mt-xs light">
                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 95%;">
                                            95%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php
include 'inc/footer.php';
?>