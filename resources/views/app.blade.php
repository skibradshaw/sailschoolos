<!DOCTYPE html>
<html lang="en">

@include('inc.head')

<body>

<!-- /.modal -->
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
                        <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{Session::get('error')}}</div>
                    @endif      
                    @if(Session::has('status'))
                        <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>{{Session::get('status')}}</h4></div>
                    @endif
                    <div class="col-lg-12">
                        @yield('header')    
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                @yield('content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<!-- Universal Modals -->
<!-- Add Contact Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- scripts -->     

<script src="{{ asset('/js/all.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
@yield('scripts')
<script type="text/javascript">

// Clear Model Window when closed
$(document).ready(function(){
    
    $(".modal").on("hidden.bs.modal", function(){
        $(this).removeData('bs.modal');
    });      

});    

</script>

</body>
</html>