            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li class="active">
                            <a href="#"><i class="fa fa-user fa-fw"></i> People<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a data-toggle="modal" href="/contacts/create" data-target="#myModal">New Contact</a>
                                </li>                              
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li class="inactive">
                            <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Classes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ route('students.index') }}">Students</a></li>
                                <li><a href="{{route('inquiries')}}">Inquiries</a></li>
                                <li>
                                    <a data-toggle="modal" href="{{route('inquiry.create')}}" data-target="#myModal">New Inquiry</a>
                                </li> 
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-space-shuttle fa-fw"></i> Charters</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Brokerage<span class="fa arrow"></span></a>
                        </li>
  
                        <li>
                            <a href="#"><i class="fa fa-anchor fa-fw"></i> Boats<span class="fa arrow"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
           
