<?php 

    session_start();
    require_once 'connect_map.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ../index.php');
    }

?>



<!DOCTYPE html>
<html lang="en">
  <head>

      <link rel="icon" type="image/png" href="../ambulance.png">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

      <title> ระบบค้นหาเส้นทางสำหรับการเข้าถึงผู้ป่วยฉุกเฉิน </title>

      <!-- ส่วนของ jquery/bootstrap -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

      <script src="JsLocalSearch.js"></script>

      <!-- ส่วนของ css/js สำหรับรูปแบบ Navbar บนหน้าแผนที่ -->
      <!-- <link rel="stylesheet" href="public/css/ol.css" /> -->

      <!-- ส่วนของ Select ใน Navbar -->
      <link rel="stylesheet" href="public/css/bootstrap-select.min.css">
      <script src="public/js/bootstrap-select.min.js"></script>

      <!-- ส่วนเสริมของแผนที ่leaflet js/css -->
      <link rel="stylesheet" href="public/leaflet/leaflet.css">
      <script src="public/leaflet/leaflet.js"></script>
      <script src="public/leaflet/leaflet-providers.js"></script>


      <!-- Leaflet Locate Location -->
      <link rel ="stylesheet" href ="public/css/L.Control.Locate.css">
      <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <script src="public/js/L.Control.Locate.js"></script>

      <!-- Leaflet Minimap -->
      <link rel="stylesheet" href="public/css/Control.MiniMap.css" />
      <script src="public/js/Control.MiniMap.js"></script>

      <!-- Leaflet Drawing -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.css">
      <script src="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.min.js"></script>
      <script src="https://unpkg.com/geojson-vt@3.2.0/geojson-vt.js"></script>



      <style type="text/css">
            body {
                  overflow: hidden;
                  font-size: 15px;
                  font-family: 'Bai Jamjuree', sans-serif;
                  color: white;
            }

            .navbar-offset {
                  margin-top: 60px;
            }
            #map {
                  position: absolute;
                  top: 50px;
                  bottom: 0px;
                  left: 0px;
                  right: 0px;
                  font-size: 15px;
                  font-family: 'Bai Jamjuree', sans-serif;
            }

            }
            #map .ol-zoom {
                  font-size: 15px;
                  font-family: 'Bai Jamjuree', sans-serif;

            }

            .zoom-top-opened-sidebar { margin-top: 5px; }
            .zoom-top-collapsed { margin-top: 45px; }

            .mini-submenu{
                  display:none;
                  background-color: rgba(255, 255, 255, 0.46);
                  border: 1px solid rgba(0, 0, 0, 0.9);
                  border-radius: 4px;
                  padding: 9px;
                  position: relative;
                  width: 42px;
                  text-align: center;
            }

            .mini-submenu-left {
                  position: absolute;
                  top: 60px;
                  left: .5em;
                  z-index: 40;
            }

            #map { z-index: 35; }
            .sidebar { z-index: 45; }
            .main-row { position: relative; top: 0; }
            .mini-submenu:hover{
              cursor: pointer;
            }

            .slide-submenu{
                  background: rgba(0, 0, 0, 0.45);
                  display: inline-block;
                  padding: 0 8px;
                  border-radius: 4px;
                  cursor: pointer;
            }
      </style>


  </head>
  <body>
    <div class="container">
          <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container-fluid">
              <!-- ส่วนของเพิ่ม Banner/Logo สำหรับเว็บ -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">ระบบเว็บแผนที่ฉุกเฉิน</a>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-right" name="search" method="POST" action="">
                  <div class="form-group">
                    ค้นหาสถานที่ :
                    <input type="text" id="gsearchsimple" name="gsearchsimple" class="form-control" value="<?php echo $_POST['gsearchsimple'];?>" placeholder="ค้นหาสถานที่"  autocomplete="off">
                  </div>
                  <button type="submit" class="btn btn-primary">ค้นหา</button>
                  <a href="dashboard/index.php"><img src="public/image/gear.png" width="25" height="25"></a> 
                  <a href="../logout.php "><img src="public/image/shutdown.png" width="25" height="25"></a> 



                  <!-- PHP สำหรับดึงค่าสถานที่ด้วยการพิมพ์ -->
                  <?php
                      // $geojson = '';
                      // $geojson3 = '';
                      // $geojson4 = '';
                      if(isset($_POST['gsearchsimple']) and $_POST['gsearchsimple'] != ''):
                      $gsearchsimple = $_POST['gsearchsimple'];
                      $key = "'$gsearchsimple'";
                      $sql1 = "SELECT *, st_AsGeoJSON(st_Transform(geom,4326)) as geojson from ambulance where name = '$gsearchsimple'";
                      $sql2 = "SELECT *, st_AsGeoJSON(st_Transform(geom,4326)) as geojson from health_care where name = '$gsearchsimple'";
                      $sql3 = "SELECT *, st_AsGeoJSON(st_Transform(geom,4326)) as geojson from point_salongnai where namet = '$gsearchsimple'";
                      $sql4 = "SELECT * , st_AsGeoJSON(st_Transform(geom,4326)) as geojson FROM point_salongnok WHERE namet = '$gsearchsimple'";
                      $sql5 = "SELECT * , st_AsGeoJSON(st_Transform(geom,4326)) as geojson FROM ban_salongnai WHERE address = '$gsearchsimple'";
                      $sql6 = "SELECT * , st_AsGeoJSON(st_Transform(geom,4326)) as geojson FROM ban_salong_nok WHERE house_id = '$gsearchsimple'";

                      // print_r ($_POST);
                      // exit;
                      $marker1 = pg_query($mgdb,$sql1);
                      $marker2 = pg_query($mgdb,$sql2);
                      $marker3 = pg_query($mgdb,$sql3);
                      $marker4 = pg_query($mgdb,$sql4);
                      $marker5 = pg_query($mgdb,$sql5);
                      $marker6 = pg_query($mgdb,$sql6);



                      $geojson = array(
                        'type'      => 'FeatureCollection',
                        'features'  => array()
                      );

                      //ทำการ Add Geojson
                      while ($mark2 = pg_fetch_assoc($marker2)){
                          $feature = array(
                              'type'=>'Feature',
                              'properties'=>array('code'=>'4326'),
                              'geometry'=>json_decode($mark2['geojson'],true),
                              'crs'=>array(
                                  'type'=>'EPSG',
                                  'properties'=>array('code'=>'4326')),
                                  'properties'=>array(
                                      'geom'=>$mark2['geom'],
                                      'id'=>$mark2['id'],
                                      'name'=>$mark2['name'],
                              )
                              );
                          array_push($geojson['features'],$feature);
                      }
                      $geojson = json_encode($geojson);

                      //ทำการ Add Geojson
                      $geojson3 = array(
                        'type'      => 'FeatureCollection',
                        'features'  => array()
                      );
                      //ทำการ Add Geojson
                      while ($mark3 = pg_fetch_assoc($marker3)){
                          $feature3 = array(
                              'type'=>'Feature',
                              'properties'=>array('code'=>'4326'),
                              'geometry'=>json_decode($mark3['geojson'],true),
                              'crs'=>array(
                                  'type'=>'EPSG',
                                  'properties'=>array('code'=>'4326')),
                                  'properties'=>array(
                                      'geom'=>$mark3['geom'],
                                      'gid'=>$mark3['gid'],
                                      'namet'=>$mark3['namet'],
                              )
                              );
                          array_push($geojson3['features'],$feature3);
                      }
                      $geojson3 = json_encode($geojson3);


                      //ทำการ Add Geojson
                      $geojson4 = array(
                        'type'      => 'FeatureCollection',
                        'features'  => array()
                      );

                      //ทำการ Add Geojson
                      while ($mark4 = pg_fetch_assoc($marker4)){
                          $feature4 = array(
                              'type'=>'Feature',
                              'properties'=>array('code'=>'4326'),
                              'geometry'=>json_decode($mark4['geojson'],true),
                              'crs'=>array(
                                  'type'=>'EPSG',
                                  'properties'=>array('code'=>'4326')),
                                  'properties'=>array(
                                      'geom'=>$mark4['geom'],
                                      'gid'=>$mark4['gid'],
                                      'namet'=>$mark4['namet'],
                              )
                              );
                          array_push($geojson4['features'],$feature4);
                      }
                      $geojson4 = json_encode($geojson4);


                      //ทำการ Add Geojson
                      $geojson5 = array(
                        'type'      => 'FeatureCollection',
                        'features'  => array()
                      );

                      //ทำการ Add Geojson
                      while ($mark5 = pg_fetch_assoc($marker5)){
                          $feature5 = array(
                              'type'=>'Feature',
                              'properties'=>array('code'=>'4326'),
                              'geometry'=>json_decode($mark5['geojson'],true),
                              'crs'=>array(
                                  'type'=>'EPSG',
                                  'properties'=>array('code'=>'4326')),
                                  'properties'=>array(
                                      'geom'=>$mark5['geom'],
                                      'gid'=>$mark5['gid'],
                                      'house_id'=>$mark5['house_id'],
                                      'title_name_owner'=>$mark5['title_name_owner'],
                                      'owner_name'=>$mark5['owner_name'],
                                      'owner_surname'=>$mark5['owner_surname'],
                                      'address'=>$mark5['address'],
                                      'lat'=>$mark5['lat'],
                                      'long'=>$mark5['long'],
                                      'mobile'=>$mark5['mobile'],

                              )
                              );
                          array_push($geojson5['features'],$feature5);
                      }
                      $geojson5 = json_encode($geojson5);


                       //ทำการ Add Geojson
                       $geojson6 = array(
                        'type'      => 'FeatureCollection',
                        'features'  => array()
                      );

                      //ทำการ Add Geojson
                      while ($mark6 = pg_fetch_assoc($marker6)){
                          $feature6 = array(
                              'type'=>'Feature',
                              'properties'=>array('code'=>'4326'),
                              'geometry'=>json_decode($mark6['geojson'],true),
                              'crs'=>array(
                                  'type'=>'EPSG',
                                  'properties'=>array('code'=>'4326')),
                                  'properties'=>array(
                                      'geom'=>$mark6['geom'],
                                      'gid'=>$mark6['gid'],
                                      'namet'=>$mark6['namet'],
                                      'house_id'=>$mark6['house_id'],

                              )
                              );
                          array_push($geojson6['features'],$feature6);
                      }
                      $geojson6 = json_encode($geojson6);
                      // print_r ($geojson6);
                      // exit;
                      endif;
                      ?>

                </form>
                <form class="navbar-form navbar-left" name="sub-search" method="POST" action="">

                  <!-- เลือกโซน -->
                  <div class="form-group">
                    เลือกพื้นที่ค้นหา :
                    <select name="salong" id="salong"  class="form-control" data-live-search="true" type="text">
                      <option value="#">เลือกพื้นที่</option>
                      <option value="1">พื้นที่สลองนอก-จุดสำคัญ</option>
                      <option value="2">พื้นที่สลองใน-จุดสำคัญ</option>
                      <option value="3">พื้นที่สลองใน-บ้าน/ที่พักอาศัย</option>
                      <option value="4">พื้นที่สลองนอก-บ้าน/ที่พักอาศัย</option>

                      <!-- <option value="3">จุดโรงพยาบาล</option> -->
                    </select>
                  </div>

                  <!-- เลือกหมู่ -->
                  <div class="form-group">
                      <select  name="moo" id="moo" class="form-control " data-live-search="true" type="text" value="<?php echo $_POST['moo'];?>">
                        <option value="<?php echo $_POST['moo'];?>">กรุณาเลือกหมู่</option>
                        <!-- <option value="#"></option> -->
                      </select>
                  </div>

                  <!-- เลือกจุดที่ต้องการ -->
                  <div class="form-group">
                      <select  name="keyword" id="keyword" class="form-control " data-live-search="true" type="text" value="<?php echo $_POST['keyword'];?>">
                        <option value="#">กรุณาเลือกสถานที่</option>
                        <!-- <option value="#"></option> -->
                      </select>
                  </div>

                  <button type="submit" class="btn btn-success">ค้นหาตำแหน่ง</button>

                  <!-- PHP ดึงค่าด้วยการค้นหาตาม Keyword ในส่วนของเลือก filter -->
                  <?php

                    // $geojson = '';
                    // $geojson3 = '';
                    // $geojson4 = '';

                  if(isset($_POST['keyword']) and $_POST['keyword'] != '' and $_POST['moo'] != '' ):
                    $moo = $_POST['moo'];
                    $keyword = $_POST['keyword'];
                    $key = "'$keyword'";
                    $sql1 = "SELECT *, st_AsGeoJSON(st_Transform(geom,4326)) as geojson from ambulance where name = '$keyword'";
                    $sql2 = "SELECT *, st_AsGeoJSON(st_Transform(geom,4326)) as geojson from health_care where name = '$keyword'";
                    $sql3 = "SELECT *, geom, st_AsGeoJSON(st_Transform(geom,4326)) as geojson from point_salongnai where namet = '$keyword'";
                    $sql4 = "SELECT *, st_AsGeoJSON(st_Transform(geom,4326)) as geojson FROM point_salongnok WHERE namet = '$keyword'";
                    $sql5 = "SELECT *, st_AsGeoJSON(st_Transform(geom,4326)) as geojson FROM ban_salongnai WHERE house_id ='$keyword' and moo='$moo'";
                    $sql6 = "SELECT *, st_AsGeoJSON(st_Transform(geom,4326)) as geojson FROM ban_salong_nok WHERE house_id ='$keyword' and moo='$moo'";

                    // print_r ($_POST);
                    // exit;

                    $marker1 = pg_query($mgdb,$sql1);
                    $marker2 = pg_query($mgdb,$sql2);
                    $marker3 = pg_query($mgdb,$sql3);
                    $marker4 = pg_query($mgdb,$sql4);
                    $marker5 = pg_query($mgdb,$sql5);
                    $marker6 = pg_query($mgdb,$sql6);


                    $geojson = array(
                       'type'      => 'FeatureCollection',
                       'features'  => array()
                    );

                    //ทำการ Add Geojson
                    while ($mark2 = pg_fetch_assoc($marker2)){
                        $feature = array(
                            'type'=>'Feature',
                            'properties'=>array('code'=>'4326'),
                            'geometry'=>json_decode($mark2['geojson'],true),
                            'crs'=>array(
                                'type'=>'EPSG',
                                'properties'=>array('code'=>'4326')),
                                 'properties'=>array(
                                     'geom'=>$mark2['geom'],
                                     'id'=>$mark2['id'],
                                     'name'=>$mark2['name'],
                             )
                             );
                         array_push($geojson['features'],$feature);
                    }
                    $geojson = json_encode($geojson);

                    //ทำการ Add Geojson
                    $geojson3 = array(
                       'type'      => 'FeatureCollection',
                       'features'  => array()
                    );


                    //ทำการ Add Geojson
                    while ($mark3 = pg_fetch_assoc($marker3)){
                        $feature3 = array(
                            'type'=>'Feature',
                            'properties'=>array('code'=>'4326'),
                            'geometry'=>json_decode($mark3['geojson'],true),
                            'crs'=>array(
                                'type'=>'EPSG',
                                'properties'=>array('code'=>'4326')),
                                 'properties'=>array(
                                     'geom'=>$mark3['geom'],
                                     'gid'=>$mark3['gid'],
                                     'namet'=>$mark3['namet'],
                             )
                             );
                         array_push($geojson3['features'],$feature3);
                    }
                    $geojson3 = json_encode($geojson3);

                    // print_r ($geojson3);


                    //ทำการ Add Geojson
                    $geojson4 = array(
                       'type'      => 'FeatureCollection',
                       'features'  => array()
                    );

                    //ทำการ Add Geojson
                    while ($mark4 = pg_fetch_assoc($marker4)){
                        $feature4 = array(
                            'type'=>'Feature',
                            'properties'=>array('code'=>'4326'),
                            'geometry'=>json_decode($mark4['geojson'],true),
                            'crs'=>array(
                                'type'=>'EPSG',
                                'properties'=>array('code'=>'4326')),
                                 'properties'=>array(
                                     'geom'=>$mark4['geom'],
                                     'gid'=>$mark4['gid'],
                                     'namet'=>$mark4['namet'],
                             )
                             );
                         array_push($geojson4['features'],$feature4);
                    }
                    $geojson4 = json_encode($geojson4);

                    //ทำการ Add Geojson
                    $geojson5 = array(
                       'type'      => 'FeatureCollection',
                       'features'  => array()
                    );

                    //ทำการ Add Geojson
                    while ($mark5 = pg_fetch_assoc($marker5)){
                        $feature5 = array(
                            'type'=>'Feature',
                            'properties'=>array('code'=>'4326'),
                            'geometry'=>json_decode($mark5['geojson'],true),
                            'crs'=>array(
                                'type'=>'EPSG',
                                'properties'=>array('code'=>'4326')),
                                 'properties'=>array(
                                    'geom'=>$mark5['geom'],
                                    'gid'=>$mark5['gid'],
                                    'house_id'=>$mark5['house_id'],
                                    'title_name_owner'=>$mark5['title_name_owner'],
                                    'owner_name'=>$mark5['owner_name'],
                                    'owner_surname'=>$mark5['owner_surname'],
                                    'address'=>$mark5['address'],
                                    'lat'=>$mark5['lat'],
                                    'long'=>$mark5['long'],
                                    'mobile'=>$mark5['mobile'],
                             )
                             );
                         array_push($geojson5['features'],$feature5);
                    }
                    $geojson5 = json_encode($geojson5);

                    //ทำการ Add Geojson
                    $geojson6 = array(
                      'type'      => 'FeatureCollection',
                      'features'  => array()
                   );

                   //ทำการ Add Geojson
                   while ($mark6 = pg_fetch_assoc($marker6)){
                       $feature6 = array(
                           'type'=>'Feature',
                           'properties'=>array('code'=>'4326'),
                           'geometry'=>json_decode($mark6['geojson'],true),
                           'crs'=>array(
                               'type'=>'EPSG',
                               'properties'=>array('code'=>'4326')),
                                'properties'=>array(
                                    'geom'=>$mark6['geom'],
                                    // 'gid'=>$mark6['gid'],
                                    'namet'=>$mark6['namet'],
                                    'house_id'=>$mark6['house_id'],
                                    'sick'=>$mark6['sick'],
                                    'pok'=>$mark6['pok'],
                            )
                            );
                        array_push($geojson6['features'],$feature6);
                   }
                   $geojson6 = json_encode($geojson6);


                    // print_r ($geojson4);
                    // exit;

                  endif;
                  ?>
                </form>
                </div>
                </div>
              </nav>
            </div>
          </nav>
          <div class="navbar-offset"></div>

          <!-- ส่วนของแทรกแผนที่ -->
          <div id="map"></div>
          <!-- /ส่วนของแทรกแผนที่ -->

          <!-- <div class="row main-row"> -->
            <div class="col-sm-4 col-md-3 sidebar sidebar-right pull-right">
              <div class="panel-group sidebar-body" id="accordion-right">

                <ul class="list-group"></ul>
                <div id="localSearchSimple"></div>
                <!-- <div class="panel panel-default">
                  <div id="layers" class="panel-collapse collapse in">
                    <div class="list-group"></div>
                  </div>
                </div> -->
                </div>
              </div>
            <!-- </div> -->


          <!-- <div class="row main-row">
            <div class="col-sm-4 col-md-3 sidebar sidebar-left pull-left">
              <div class="panel-group sidebar-body" id="accordion-left">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#layers">
                        <i class="fa fa-list-alt"></i>
                        เครื่องมือเพิ่มเติม (จุดเริ่มต้น-จุดสิ้นสุด)
                      </a>
                      <span class="pull-right slide-submenu">
                        <i class="fa fa-chevron-left"></i>
                      </span>
                    </h4>
                  </div>
                  <div id="layers" class="panel-collapse collapse in">
                    <div class="panel-body">
                      <form class="navbar-form navbar-left" role="search">
                        <img src="public/image/start.png" width="25" height="25">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="กำหนดจุดเริ่มต้น">
                        </div>
                        <br><br>
                        <img src="public/image/stop.png" width="25" height="25">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="กำหนดจุดสิ้นสุด">
                        </div>
                        <button type="submit" class="btn btn-success">คำนวณ</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#properties">
                        <i class="fa fa-list-alt"></i>
                        รายละเอียดเว็บไซต์
                      </a>
                    </h4>
                  </div>
                  <div id="properties" class="panel-collapse collapse in">
                    <div class="panel-body">
                      <p>
                    <b> เว็บไซต์แผนที่ฉุกเฉิน </b> แนะนำการใช้งานหน้าเว็บด้วยเครื่องมือที่อะนวยความสะดวกในการจัดการระบบแผนที่ ทดสอบระบบแผนที่ระพยาบาลฉุกเฉิน
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

          <!-- <div class="mini-submenu mini-submenu-left pull-left">
            <i class="fa fa-list-alt"></i>
          </div> -->
        </div>
  </body>

  <!-- script ส่วนของ Search ข้อมูลข้อความ่ -->
          <script>
          $(document).ready(function(){
           $('#gsearchsimple').keyup(function(){
            var query = $('#gsearchsimple').val();
            $('#detail').html('');
            $('.list-group').css('display', 'block');
            if(query.length == 2)
            {
             $.ajax({
              url:"search.php",
              method:"POST",
              data:{query:query},
              success:function(data)
              {
               $('.list-group').html(data);
              }
             })
            }
            if(query.length == 0)
            {
             $('.list-group').css('display', 'none');
            }
           });

           $('#localSearchSimple').jsLocalSearch({
            action:"Show",
            html_search:true,
            mark_text:"marktext"
           });

           $(document).on('click', '.gsearch', function(){
            var email = $(this).text();
            $('#gsearchsimple').val(email);
            $('.list-group').css('display', 'none');
            $.ajax({
             url:"search.php",
             method:"POST",
             data:{email:email},
             success:function(data)
             {
              $('#detail').html(data);
             }
            })
           });

          });
          </script>


    <!-- script ส่วนของจัดการแถบบาร์สำหรับแสดงข้อมูลหน้าเว็บแผนที่ -->
      <script type="text/javascript">
            function applyMargins() {
              var leftToggler = $(".mini-submenu-left");
              if (leftToggler.is(":visible")) {
                $("#map .ol-zoom")
                  .css("margin-left", 0)
                  .removeClass("zoom-top-opened-sidebar")
                  .addClass("zoom-top-collapsed");
              } else {
                $("#map .ol-zoom")
                  .css("margin-left", $(".sidebar-left").width())
                  .removeClass("zoom-top-opened-sidebar")
                  .removeClass("zoom-top-collapsed");
              }
            }

            function isConstrained() {
              return $(".sidebar").width() == $(window).width();
            }

            function applyInitialUIState() {
              if (isConstrained()) {
                $(".sidebar-left .sidebar-body").fadeOut('slide');
                $('.mini-submenu-left').fadeIn();
              }
            }

            $(function(){
              $('.sidebar-left .slide-submenu').on('click',function() {
                var thisEl = $(this);
                thisEl.closest('.sidebar-body').fadeOut('slide',function(){
                  $('.mini-submenu-left').fadeIn();
                  applyMargins();
                });
              });

              $('.mini-submenu-left').on('click',function() {
                var thisEl = $(this);
                $('.sidebar-left .sidebar-body').toggle('slide');
                thisEl.hide();
                applyMargins();
              });

              $(window).on("resize", applyMargins);

              var map = new ol.Map({
                target: "map",
                layers: [
                  new ol.layer.Tile({
                    source: new ol.source.OSM()
                  })
                ],
                view: new ol.View({
                  center: [0, 0],
                  zoom: 2
                })
              });
              applyInitialUIState();
              applyMargins();
            });
      </script>
    <!-- ./script ส่วนของจัดการแถบบาร์สำหรับแสดงข้อมูลหน้าเว็บแผนที่ -->

    <!-- ส่วนของการจัดการแผนที่ -->
      <script>


            // ตัวเลือกหมู่
            $('#salong').change(function(e){
              console.log('moo');
              $.ajax({
                dataType: "json",
                // url: "get_salong2.php",
                url: "get_salong2.php",
                method:'POST',
                data : {salong:$("#salong").val()},
                // data:{id:$(this).val()},
                // data: moo,
                success: function(data){
                  // var html = JSON.parse(data);
                  // console.log(data);return false;
                  $('#moo option').remove();
                  $('#moo').append(data);
                  // $('#Keyword').html(data);
                  $('#moo').selectpicker('refresh');
                  // console.log(moo);
                },
                error: function(err){
                  console.log(err)
                }
              });
            });


            // ตัวเลือกหมู่
            $('#moo').change(function(e){
              console.log('moo');
              $.ajax({
                dataType: "json",
                url: "get_salong3.php",
                method:'POST',
                data:{moo:$("#moo").val(), salong : $("#salong").val()},
                // data2:{salong:$("#salong").val()},
                success: function(data){
                  // var html = JSON.parse(data);
                  // console.log(data);return false;
                  $('#keyword option').remove();
                  $('#keyword').append(data);
                  // $('#Keyword').html(data);
                  $('#keyword').selectpicker('refresh');

                  // console.log(gid);
                },
                error: function(err){
                  console.log(err)
                }
              });
            });


          var map = L.map('map').setView([20.202670, 99.708615], 12);
         
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

          L.control.locate({
            position: 'topright'
          }).addTo(map);

          // Minimap
          var google_map = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 18,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
          });
          var miniMap = new L.Control.MiniMap(google_map, {
                    toggleDisplay: true,
                    minimized: false,
                    position: 'bottomleft'
           }).addTo(map);

           function clickZoom(e) {
             map.setView(e.target.getLatLng(), 17);
           }

           // แผนที่ Basemap
           var google_map = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
             maxZoom: 18,
             subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
           });
          //  var openstreetmap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          //    maxZoom: 18
          //  });
          //  var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
          //     maxZoom: 17,
          //     attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
          //   });
            var Esri_WorldStreetMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
              attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
            });
            var Esri_WorldTopoMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {
              attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community'
            });
            var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
              attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            });
            var Stamen_TerrainLabels = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/terrain-labels/{z}/{x}/{y}{r}.{ext}', {
              attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
              subdomains: 'abcd',
              minZoom: 0,
              maxZoom: 18,
              ext: 'png'
            });


           const watchId = navigator.geolocation.watchPosition((position) => {
           const { latitude, longitude } = position.coords;
          //  console.log('fffff');

          $.getJSON("health_care.php", function (data) {
               var ratIcon = L.icon({
                 iconUrl: "public/image/hospital.png",
                 iconSize: [40, 40],
               });
              L.geoJson(data, {
                 pointToLayer: function (feature, latlng) {
                   return L.marker(latlng, { icon: ratIcon });
                 },

                 onEachFeature: function(feature, layer) {
                   var popupText =
                   "<br><b> ชื่อโรงพยาบาล: </b> " + feature.properties.name
                  +"<br> ลองติจูด :" + feature.geometry.coordinates[0] +
                  "<br> ละจิจูด :" + feature.geometry.coordinates[1]  
                  + `<br> <br> <center><span><a href='https://www.google.co.th/maps/dir/${latitude},${longitude}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                   + "'>   <button type="submit" class="btn btn-danger"> เส้นทางไปโรงพยาบาล </button></a></span> </center>`;
                   layer.bindPopup(popupText); }

               }).addTo(map);
             });

             $.getJSON("ambulance.php", function (data) {
               var ratIcon = L.icon({
                 iconUrl: "public/image/ambulance_pin.png",
                 iconSize: [40, 40],
               });
              L.geoJson(data, {
                 pointToLayer: function (feature, latlng) {
                   return L.marker(latlng, { icon: ratIcon });
                 },

                 onEachFeature: function(feature, layer) {
                   var popupText =
                   "<br><b> รถฉุกเฉิน: </b> " + feature.properties.name
                   +"<br> ลองติจูด :" + feature.geometry.coordinates[0] +
                  "<br> ละจิจูด :" + feature.geometry.coordinates[1]  
                  + `<br> <br> <center><span><a href='https://www.google.co.th/maps/dir/${latitude},${longitude}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                   + "'>   <button type="submit" class="btn btn-danger"> ระยะทางรถฉุกเฉิน </button></a></span> </center>`;
                   layer.bindPopup(popupText); }

               }).addTo(map);
             });

           //Search GeoJson
           var marker2 = '<?php echo $geojson ?>';
          //  console.log(marker2);
          //  exit;
          marker2 = JSON.parse(marker2);
               var ratIcon = L.icon({
                 iconUrl: "public/image/hospital.png",
                 iconSize: [40, 40],
               });
               L.geoJSON(marker2,
                 {
                   pointToLayer: function (feature, latlng) {
                    console.log(latlng);
                     // map.flyTo(latlng,17);

                     return L.marker(latlng, { icon: ratIcon });
                   },
                    onEachFeature: function(feature, layer) {

                      var popupText =
                      "<br><b>ชื่อโรงพยาบาล: " + feature.properties.name +"</b>"
                      +"<br> ลองติจูด :" + feature.geometry.coordinates[0] +
                      "<br> ละจิจูด :" + feature.geometry.coordinates[1] +
                      "<br>"
                      + `<br><span><a href='https://www.google.co.th/maps/dir/${latitude},${longitude}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                      + "'>   <button type="submit" class="btn btn-success"> เส้นทางไปยังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button></a></span>`
                      + `<br><span><a href='https://www.google.co.th/maps/dir/${19.900597152640774},${99.82819346931923}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                      + "'>   <button type="submit" class="btn btn-warning"> ศูนย์สั่งการมายังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button> </a></span>`;
                      
                      // + `<br><span>
                      // <a href="http://localhost/maefaluang1/map.php"
                      // onclick=" javascript:window.open('http://localhost/mfl/ems/create_table_result.php?startpoint=${feature.geometry.coordinates[1]} ${feature.geometry.coordinates[0]}','_self');window.close() "
                      // return off;>
                      //     <center> <button type="submit" class="btn btn-primary">ดึงพิกัดตำแหน่ง</button></center> </a></span>`;
                      layer.bindPopup(popupText); }
               }).addTo(map);

              //  console.log(marker2);

               var marker3 = '<?php echo $geojson3 ?>';
                   marker3 = JSON.parse(marker3);
                   var ratIcon = L.icon({
                     iconUrl: "public/image/nai_pin.png",
                     iconSize: [40, 40],
                   });
                 

                   L.geoJSON(marker3,
                     {
                       pointToLayer: function (feature, latlng) {
                         console.log(latlng);
                         // map.flyTo(latlng,17);
                         return L.marker(latlng, { icon: ratIcon });
                       },
                        onEachFeature: function(feature, layer) {
                          var popupText =
                          "<br><b>ชื่อสถานที่: " + feature.properties.namet +"</b>"
                          +"<br> ลองติจูด :" + feature.geometry.coordinates[0] +
                          "<br> ละจิจูด :" + feature.geometry.coordinates[1] +
                          "<br>"
                          + `<br><span><a href='https://www.google.co.th/maps/dir/${latitude},${longitude}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                            + "'>   <button type="submit" class="btn btn-success"> เส้นทางไปยังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button></a></span>`
                            + `<br><span><a href='https://www.google.co.th/maps/dir/${19.900597152640774},${99.82819346931923}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                            + "'>   <button type="submit" class="btn btn-warning"> ศูนย์สั่งการมายังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button> </a></span>`
                            + `<br><span>
                            <a href='https://www.google.co.th/maps/dir/${20.274303351489998},${99.5916002292286}/${20.274303351489998},${99.5916002292286}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                            + "'> <button type="submit" class="btn btn-danger"> คำนวณเส้นทางไปยังโรงพยาบาล &nbsp;&nbsp;&nbsp;</button> </a></span>`;
                          // + `<br><span>
                          // <a href="http://localhost/maefaluang1/map.php"
                          // onclick=" javascript:window.open('http://localhost/mfl/ems/create_table_result.php?startpoint=${feature.geometry.coordinates[1]} ${feature.geometry.coordinates[0]}','_self');window.close() "
                          // return off;>
                          //     <center> <button type="submit" class="btn btn-primary">ดึงพิกัดตำแหน่ง</button></center> </a></span>`;
                          layer.bindPopup(popupText); }
                   }).addTo(map);
                //  console.log(marker3);

                 var marker4 = '<?php echo $geojson4 ?>';
                     marker4 = JSON.parse(marker4);
                     var ratIcon = L.icon({
                       iconUrl: "public/image/nok_pin.png",
                       iconSize: [40, 40],
                     });


                     L.geoJSON(marker4,
                       {
                         pointToLayer: function (feature, latlng) {
                          console.log(latlng);
                           // map.flyTo(latlng,17);
                           return L.marker(latlng, { icon: ratIcon });
                         },
                          onEachFeature: function(feature, layer) {

                            var popupText =
                            "<br><b>ชื่อสถานที่: " + feature.properties.namet +"</b>"
                            +"<br> ลองติจูด :" + feature.geometry.coordinates[0] +
                            "<br> ละจิจูด :" + feature.geometry.coordinates[1] +
                            "<br>"
                            + `<br><span><a href='https://www.google.co.th/maps/dir/${latitude},${longitude}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                            + "'>   <button type="submit" class="btn btn-success"> เส้นทางไปยังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button></a></span>`
                            + `<br><span><a href='https://www.google.co.th/maps/dir/${19.900597152640774},${99.82819346931923}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                            + "'>   <button type="submit" class="btn btn-warning"> ศูนย์สั่งการมายังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button> </a></span>`;
                            // + `<br><span>
                            // + `<br><span>
                            // <a href="http://localhost/maefaluang1/map.php"
                            // onclick=" javascript:
                            // window.open('http://localhost/mfl/ems/create_table_result.php?startpoint=${feature.geometry.coordinates[1]} ${feature.geometry.coordinates[0]}','_self');window.close() "
                            // return off;>
                            //     <center> <button type="submit" class="btn btn-primary">ดึงพิกัดตำแหน่ง</button></center> </a></span>`;
                            layer.bindPopup(popupText); }

                     }).addTo(map);

                     var marker5 = '<?php echo $geojson5 ?>';
                         marker5 = JSON.parse(marker5);
                         var ratIcon = L.icon({
                           iconUrl: "public/image/ban2.png",
                           iconSize: [40, 40],
                         });


                         L.geoJSON(marker5,
                           {
                             pointToLayer: function (feature, latlng) {
                              console.log(latlng);
                               // map.flyTo(latlng,17);
                               return L.marker(latlng, { icon: ratIcon });
                             },
                              onEachFeature: function(feature, layer) {

                                var popupText =
                                "<br><b>ชื่อเจ้าของบ้าน: "  + feature.properties.title_name_owner + "&nbsp;" + feature.properties.owner_name + "&nbsp;" + feature.properties.owner_surname+"</b>"
                                +"<br><b> ที่อยู่ :</b>" + "&nbsp;" + feature.properties.address 
                                +"<br><b> เบอร์ติดต่อ :</b>" + "&nbsp;" + feature.properties.mobile
                                +"<br><b> รายละเอียดส่วนตัว :</b>" + "&nbsp;" + "-" + "<br>"
                                +"<br> <b>ลองติจูด : </b>" + feature.geometry.coordinates[0] +
                                "<br> <b> ละจิจูด : </b>" + feature.geometry.coordinates[1] +
                                "<br>"
                                + `<br><span><a href='https://www.google.co.th/maps/dir/${latitude},${longitude}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                                + "'>   <button type="submit" class="btn btn-success"> เส้นทางไปยังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button></a></span>`
                                + `<br><span><a href='https://www.google.co.th/maps/dir/${19.900597152640774},${99.82819346931923}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                                + "'>   <button type="submit" class="btn btn-warning"> ศูนย์สั่งการมายังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button> </a></span>`;
                                
                                // + `<br><span>
                                // <a href="http://localhost/maefaluang1/map.php"
                                // onclick=" javascript:
                                // window.open('http://localhost/mfl/ems/create_table_result.php?startpoint=${feature.geometry.coordinates[1]} ${feature.geometry.coordinates[0]}','_self');window.close() "
                                // return off;>
                                //     <center> <button type="submit" class="btn btn-primary">ดึงพิกัดตำแหน่ง</button></center> </a></span>`;
                                layer.bindPopup(popupText); }

                         }).addTo(map);

                         var marker6 = '<?php echo $geojson6 ?>';
                         marker6 = JSON.parse(marker6);
                         var ratIcon = L.icon({
                           iconUrl: "public/image/ban1.png",
                           iconSize: [40, 40],
                         });


                         L.geoJSON(marker6,
                           {
                             pointToLayer: function (feature, latlng) {
                              console.log(latlng);
                               // map.flyTo(latlng,17);
                               return L.marker(latlng, { icon: ratIcon });
                             },
                              onEachFeature: function(feature, layer) {

                                var popupText =
                                "<br><b>ชื่อเจ้าของบ้าน: " + feature.properties.namet + "</b>"
                                +"<br><b> บ้านเลขที่ :</b>" + "&nbsp;" + feature.properties.house_id + "<br>"
                                +"<b> โรคประจำตัว :</b>" + "&nbsp;" + feature.properties.sick + "<br>"
                                +"<br> ลองติจูด :" + feature.geometry.coordinates[0] +
                                "<br> ละจิจูด :" + feature.geometry.coordinates[1] +
                                "<br>"
                                + `<br><span><a href='https://www.google.co.th/maps/dir/${latitude},${longitude}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                                + "'>   <button type="submit" class="btn btn-success"> เส้นทางไปยังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button></a></span>`
                                + `<br><span><a href='https://www.google.co.th/maps/dir/${19.900597152640774},${99.82819346931923}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
                                + "'>   <button type="submit" class="btn btn-warning"> ศูนย์สั่งการมายังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button> </a></span>`;
                              
                                // + `<br><span>
                                // <a href="http://localhost/maefaluang1/map.php"
                                // onclick=" javascript:
                                // window.open('http://localhost/mfl/ems/create_table_result.php?startpoint=${feature.geometry.coordinates[1]} ${feature.geometry.coordinates[0]}','_self');window.close() "
                                // return off;>
                                //     <center> <button type="submit" class="btn btn-primary">ดึงพิกัดตำแหน่ง</button></center> </a></span>`;
                                layer.bindPopup(popupText); }

                         }).addTo(map);


                      

             });

            var pin = L.icon({
              iconUrl: 'public/image/pin_1669.png',
              iconSize:     [40, 40], // size of the icon
              shadowSize:   [50, 64], // size of the shadow
              iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
              shadowAnchor: [4, 62],  // the same for the shadow
              popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
            });


            L.marker([19.900597152640774, 99.82819346931923],{icon: pin}).addTo(map)
            .bindPopup('<b> ศูนย์รับแจ้งเหตุและสั่งการ ด้านการแพทย์ฉุกเฉิน จังหวัดเชียงราย </b> <br> ที่อยู่:1039 ถนนสนามบิน<br> ตำบล รอบเวียง อำเภอ เมืองเชียงราย จังหวัดเชียงราย 57000 <br><br> <a href = "https://www.google.co.th/maps/dir/${latitude},${longitude}/19.900597152640774,99.82819346931923"> <center> <button type="submit" class="btn btn-info">เส้นทาง</button></center></a>');


        // ส่วนของดึงข้อมูลจาก database มาแสดงบนแผนที่เป็น Layers

        //ข้อมูลที่ใส่ลงบนแผนที่
        // var tumbon_th = new L.GeoJSON.AJAX(["public/data/thailand_tumbon.geojson"]);
        // var amphur_th = new L.GeoJSON.AJAX(["public/data/thailand_district.geojson"]);


        // $.getJSON("ambulance.php", function (data) {
        //        var ratIcon = L.icon({
        //          iconUrl: "public/image/ambulance_pin.png",
        //          iconSize: [40, 40],
        //        });
        //       L.geoJson(data, {
        //          pointToLayer: function (feature, latlng) {
        //            return L.marker(latlng, { icon: ratIcon });
        //          },

        //          onEachFeature: function(feature, layer) {
        //            var popupText =
        //            "<br> <b>รถฉุกเฉิน:</b><br> " + feature.properties.name;
        //            // console.log(feature);
        //            //+ "<br><a href='" + feature.properties.url + "'>More info</a>";
        //            layer.bindPopup(popupText); }

        //        }).addTo(map);
        //      });

        var sick = L.tileLayer.wms('http://localhost:8080/geoserver/maefaluang/wms?', {
                layers: 'maesalong:sick',
                format: 'image/png',
                transparent: true,
                zIndex: 5,
            });

        var road_salong = L.geoJSON(null);
             $.ajax({
               dataType: "json",
               url: "road_salong.php",
               success: function(data){
                 $(data.features).each(function(key, data){
                   road_salong.addData(data);
                 });
               },
               error: function(err){
                 console.log('error geojson')
               }
             });

             $.getJSON("point_salongnai.php", function (data) {
               var ratIcon = L.icon({
                 iconUrl: "public/image/nai_pin.png",
                 iconSize: [40, 40],
               });
              L.geoJson(data, {
                 pointToLayer: function (feature, latlng) {
                   return L.marker(latlng, { icon: ratIcon });
                 },

                 onEachFeature: function(feature, layer) {
                   var popupText =
                   "<br><b> ชื่อสถานที่: </b>" + feature.properties.namet;
                   // console.log(feature);
                   //+ "<br><a href='" + feature.properties.url + "'>More info</a>";
                   layer.bindPopup(popupText); }

               }).addTo(point_salongnai);
             });

             $.getJSON("point_salongnok.php", function (data) {
               var ratIcon = L.icon({
                 iconUrl: "public/image/nok_pin.png",
                 iconSize: [40, 40],
               });
              L.geoJson(data, {
                 pointToLayer: function (feature, latlng) {
                   return L.marker(latlng, { icon: ratIcon });
                 },

                 onEachFeature: function(feature, layer) {
                   var popupText =
                   "<br><b> ชื่อสถานที่: </b> " + feature.properties.namet;
                   // console.log(feature);
                   //+ "<br><a href='" + feature.properties.url + "'>More info</a>";
                   layer.bindPopup(popupText); }

               }).addTo(point_salongnok);
             });


            //  const watchId = navigator.geolocation.watchPosition((position) => {
            //  const { latitude, longitude } = position.coords;

            //  $.getJSON("health_care.php", function (data) {
            //    var ratIcon = L.icon({
            //      iconUrl: "public/image/hospital.png",
            //      iconSize: [40, 40],
            //    });
            //   L.geoJson(data, {
            //      pointToLayer: function (feature, latlng) {
            //        return L.marker(latlng, { icon: ratIcon });
            //      },

            //      onEachFeature: function(feature, layer) {
            //        var popupText =
            //        "<br><b> ชื่อโรงพยาบาล: </b> " + feature.properties.name
            //       +"<br> ลองติจูด :" + feature.geometry.coordinates[0] +
            //       "<br> ละจิจูด :" + feature.geometry.coordinates[1]  
            //       + `<br> <br> <center><span><a href='https://www.google.co.th/maps/dir/${19.900597152640774},${99.82819346931923}/${feature.geometry.coordinates[1]}, ${feature.geometry.coordinates[0]}' target='_blank'" + feature.properties.url
            //        + "'>   <button type="submit" class="btn btn-danger"> เส้นทางไปยังตำแหน่งผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button></a></span> </center>`;
            //        layer.bindPopup(popupText); }

            //    }).addTo(map);
            //  });
            // });
           

             $.getJSON("bansalongnai.php", function (data) {
               var ratIcon = L.icon({
                 iconUrl: "public/image/ban2.png",
                 iconSize: [40, 40],
               });
              L.geoJson(data, {
                 pointToLayer: function (feature, latlng) {
                   return L.marker(latlng, { icon: ratIcon });
                 },

                 onEachFeature: function(feature, layer) {
                   var popupText =
                   "<br><b>ชื่อเจ้าของบ้าน: " + feature.properties.title_name_owner + "&nbsp;" + feature.properties.owner_name + "&nbsp;" + feature.properties.owner_surname+"</b>" +
                   "<br> <b>บ้านเลขที่:</b> " + feature.properties.house_id +
                   "<br> <b>ที่อยู่:</b> " + feature.properties.address +
                   "<br> <b>เบอร์โทรติดต่อ:</b> " + feature.properties.mobile +
                   "<br> <b>รายละเอียดส่วนตัว:</b> " + "-";

                   // console.log(feature);
                   //+ "<br><a href='" + feature.properties.url + "'>More info</a>";
                   layer.bindPopup(popupText); }

               }).addTo(bannai);
             });

             $.getJSON("bansalongnok.php", function (data) {
               var ratIcon = L.icon({
                 iconUrl: "public/image/ban1.png",
                 iconSize: [40, 40],
               });
              L.geoJson(data, {
                 pointToLayer: function (feature, latlng) {
                   return L.marker(latlng, { icon: ratIcon });
                 },

                 onEachFeature: function(feature, layer) {
                   var popupText =
                   "<br> <b>ชื่อเจ้าของบ้าน:</b> " + feature.properties.namet+ 
                   "<br> <b>บ้านเลขที่:</b> " + feature.properties.house_id+ "&nbsp;" +"หมู่"+ "&nbsp;"+ feature.properties.moo +  "&nbsp;" +"ป็อก"+  "&nbsp;"+ feature.properties.pok + 
                   "<br> <b>รายละเอียดส่วนตัว:</b> " +"อาการป่วย"+ "&nbsp;"+ feature.properties.sick;


                   // console.log(feature);
                   //+ "<br><a href='" + feature.properties.url + "'>More info</a>";
                   layer.bindPopup(popupText); }

               }).addTo(bannok);
             });



             // $.getJSON("ambulance.php", function (data) {
             //   var ratIcon = L.icon({
             //     iconUrl: "public/image/ambulance_pin.png",
             //     iconSize: [40, 40],
             //   });
             //   L.geoJson(data, {
             //     pointToLayer: function (feature, latlng) {
             //       return L.marker(latlng, { icon: ratIcon }).bindPopup('รถฉุกเฉิน');
             //     },
             //   }).addTo(map);
             // });


             var point_salongnai = new L.LayerGroup();
             var point_salongnok = new L.LayerGroup();
             var bannai = new L.LayerGroup();
             var bannok = new L.LayerGroup();

        var baseLayers = {
          "Google Map": google_map,
          "WorldStreetMap": Esri_WorldStreetMap,
          "WorldTopoMap" :Esri_WorldTopoMap,
          "WorldImagery": Esri_WorldImagery,
          "TerrainLabels" :Stamen_TerrainLabels
        };

        var overlays = {
          "เส้นถนน": road_salong,
          "ตำแหน่งโรค": sick,
          "ตำแหน่งในพื้นที่สลองใน": point_salongnai,
          "บ้าน/ที่อยู่อาศัยพื้นที่สลองใน": bannai,
          "ตำแหน่งในพื้นที่สลองนอก": point_salongnok,
          "บ้าน/ที่อยู่อาศัยพื้นที่สลองนอก": bannok
        };
        


        L.control.layers(baseLayers,overlays).addTo(map);

      </script>
    <!-- /ส่วนของการจัดการแผนที่ -->

</html>