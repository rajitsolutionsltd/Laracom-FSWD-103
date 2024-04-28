<div class="container" style="padding-top:150px;">
        <div class="row">
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row flex-nowrap">
                        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
                            <div
                                class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2">
                                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                                    id="menu">
                                    <li>
                                        <a href="{{route('my-orders')}}" class="nav-link px-0 align-middle">
                                            <i class="fs-4 bi-table"></i> 
                                            <span class="ms-1 d-none d-sm-inline">My Orders</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="nav-link px-0 align-middle">
                                            <i class="fs-4 bi-table"></i> 
                                            <span class="ms-1 d-none d-sm-inline">Account Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col py-3">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>