<!DOCTYPE html>
<html lang="en">

@include('inc.head')

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('inc.top')
        @include('inc.sidebar')
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">

                @if(Session::has('error'))
                    <div data-alert class="alert-box warning radius">{{Session::get('error')}}</div>
                @endif      
                @if(Session::has('status'))
                    <div data-alert class="alert-box success radius">{{Session::get('status')}}</div>
                @endif
                    <div class="col-lg-12">
                        @yield('header')    
                        @yield('content')
                        

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<script src="{{ asset('/js/all.js') }}"></script>
</body>
</html>