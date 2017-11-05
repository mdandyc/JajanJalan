<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Owner Menu</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('css/skin-blue.min.css') }}">

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script src="https://use.fontawesome.com/75341ac20c.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Jajan</b>Jalan</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
           
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->userName }}</span>

            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
          @if (Auth::user()->picture)
                  <img src="\images\user\{{Auth::user()->picture}}" class="img-circle" alt="User Image"><br>
          @else
                  <img src="\images\default.jpg" class="img-circle" alt="User Image"><br>
          @endif
                <p>
                  {{ Auth::user()->userName }} - Owner
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/user/{{Auth::user()->userId}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>


                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          @if (Auth::user()->picture)
                  <img src="\images\user\{{Auth::user()->picture}}" class="img-circle" alt="User Image"><br>
          @else
                  <img src="\images\default.jpg" class="img-circle" alt="User Image"><br>
          @endif
        </div>
        <div class="pull-left info">
          <a href="\user\{{Auth::user()->userId}}"><h5>{{ Auth::user()->userName }}</h5></a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="/owner/branch/search" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="keyword" class="form-control" placeholder="Search Branch Name..." required>
          <span class="input-group-btn">
              <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="/owner/company"><i class="fa fa-building"></i> <span>Company</span>
        
              </a></li>
        <li class="active">
          <a href="/owner/branch"><i class="fa fa-cutlery"></i> <span>Branch</span>
          <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span></a>
        </li>
        <li class="">
          <a href="/owner/brand">
            <i class="fa fa-lemon-o"></i> <span>Brand</span>
          </a>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List Branch
        <small><a href="/owner/branch">Back</a></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <div class="row">
    @if(Auth::user()->userId == $branch->branchEnteredById)

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<?php 
    $companyselected = $branch->companyIdFK;
    $userselected = $branch->branchEnteredById;
    $brandselected = $branch->branchBrandId;
    $categoryselected = $branch->branchCategory;
?>

<div class="container">
    <div class="row">
    <div class="col-xs-6 col-md-4"></div>
        <div class="col-xs-6 col-md-4">
            <div style="margin-top: 20px;" class="thumbnail">
                <div class="caption">
                    <h3>Edit Branch</h3>
                    <form action="/owner/branch/{{$branch->branchId}}" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label>Branch Name</label>
                            <input class="form-control" type="text" name="branchName" value="{{$branch->branchName}}">
                        </div>

                        <div class="form-group">
                            <label>Branch Address</label>
                            <input class="form-control" type="text" name="branchAddress" value="{{$branch->branchAddress}}">
                        </div>

                        <div class="form-group">
                            <label>Branch Contact</label>
                            <input class="form-control" type="text" name="branchContactName" placeholder="Contact Name" value="{{$branch->branchContactName}}">
                            <input class="form-control" type="text" name="branchContactNo" placeholder="Phone" value="{{$branch->branchContactNo}}">
                        </div>

                        <div class="form-group">
                            <label>Branch Venue</label>
                            <select class="form-control" name="branchVenue" id="">
                <option value="Bandung"
                <?php 
                if($branch->branchVenue == 'Bandung'){
                  echo "selected";
                }
                ?>
                >Bandung</option>
                <option value="Jakarta"
                <?php 
                if($branch->branchVenue == 'Jakarta'){
                  echo "selected";
                }
                ?>
                >Jakarta</option>
                <option value="Surabaya"
                <?php 
                if($branch->branchVenue == 'Surabaya'){
                  echo "selected";
                }
                ?>
                >Surabaya</option>
              </select>
                        </div>

                        <div class="form-group">
                            <label>Branch Category</label>
                            <select class="form-control" name="branchCategory" id="">
                            @foreach ($category as $data4)
                                <option value="{{$data4->categoryId}}"

                            <?php 
                                if($categoryselected == $data4->categoryId){
                                    echo "selected";
                                }
                            ?>
                            >{{$data4->categoryType}}</option>
                            @endforeach
                            </select>
                        </div>
              
              <div class="form-group">
                <label>Brand Picture</label><br>
              @if ($branch->branchPicture)
                <img src="\images\branch\{{$branch->branchPicture}}" alt="" height="150px" width="150px"><br>
              @else
                <img src="{{URL::asset('images/default.jpg')}}" alt="" height="150px" width="150px"><br>
              @endif
              <input class="form-control" type="file" name="branchPicture">
              </div>

                        <div class="form-group">
                            <label>Open-Till</label>
                            <input class="form-control" type="text" name="branchTradingHours" placeholder="Open-Till" value="{{$branch->branchTradingHours}}">
                        </div>

                        <div class="form-group">
                            <label>News</label>
                            <textarea class="form-control" name="branchNews" rows="3">{{$branch->branchNews}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Tipe Masakan</label>
                <select class="form-control" name="branchPointRules" id="">
                <option value="Sarapan"
                <?php 
                if($branch->branchPointRules == 'Sarapan'){
                  echo "selected";
                }
                ?>
                >Sarapan</option>
                <option value="Makan Siang"
                <?php 
                if($branch->branchPointRules == 'Makan Siang'){
                  echo "selected";
                }
                ?>
                >Makan Siang</option>
                <option value="Makan Malam"
                <?php 
                if($branch->branchPointRules == 'Makan Malam'){
                  echo "selected";
                }
                ?>
                >Makan Malam</option>
                <option value="Kafe dan Deli"
                <?php 
                if($branch->branchPointRules == 'Kafe dan Deli'){
                  echo "selected";
                }
                ?>
                >Kafe dan Deli</option>
                <option value="Restoran Pesan Antar"
                <?php 
                if($branch->branchPointRules == 'Restoran Pesan Antar'){
                  echo "selected";
                }
                ?>
                >Restoran Pesan Antar</option>
                <option value="Bar dan Nightlife"
                <?php 
                if($branch->branchPointRules == 'Bar dan Nightlife'){
                  echo "selected";
                }
                ?>
                >Bar dan Nightlife</option>
                <option value="Dessert & Cakes"
                <?php 
                if($branch->branchPointRules == 'Dessert & Cakes'){
                  echo "selected";
                }
                ?>
                >Dessert & Cakes</option>
                <option value="Food Court"
                <?php 
                if($branch->branchPointRules == 'Food Court'){
                  echo "selected";
                }
                ?>
                >Food Court</option>
                </select>
                            
                        </div>

                        {{-- <div class="form-group">
                            <label>Voucher</label>
                            <input type="text" class="form-control" name="branchVoucher" placeholder="Branch Voucher" value="{{$branch->branchVoucher}}">
                        </div> --}}

                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" name="companyIdFK" id="">
                            @foreach ($company as $data1)
                                @if (Auth::user()->userId == $data1->companyEnteredById)
                                    <option value="{{$data1->companyId}}"
                            <?php 
                                if($companyselected == $data1->companyId){
                                    echo "selected";
                                }
                            ?>
                                >{{$data1->companyName}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="branchEnteredById" value="{{ Auth::user()->userId }}">

                    </fieldset>
                    
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="_method" value="put">
                    <input class="btn btn-primary" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4"></div>
    </div>
</div>
@else

        <style>

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
        </style>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    404 Not Found
                </div>
            </div>
        </div>


@endif
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>© Powered By<a href="http://karismatech.com/"> Karismatech </a>2017</strong> .
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('js/app.js') }}"></script>
<!-- ownerLTE App -->
<script src="{{ URL::asset('js/Adminlte.min.js') }}"></script>

</body>
</html>














