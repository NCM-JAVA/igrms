@extends('layouts.master');
@section('content')


<div class="section-body">            <!-- end topbar -->
               
            <!-- Main Content -->
               



<div class="row dashborad_cards">
        <div class="col-md-3">
            <div class="card_box">
                <a href="http://125.20.102.85/igrms/admin/user">
                    Manage User
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="http://125.20.102.85/igrms/admin/menu">
                    Manage Menu
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="http://125.20.102.85/igrms/admin/tender">
                    Manage Tenders
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="http://125.20.102.85/igrms/admin/event-news">
                    Manage Events
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card_box">
                <a href="http://125.20.102.85/igrms/admin/socialMedia">
                    Manage Social Media
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="http://125.20.102.85/igrms/admin/gallery">
                    Manage Gallery
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="http://125.20.102.85/igrms/admin/videogallery">
                    Manage Video Gallery
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="http://125.20.102.85/igrms/admin/feedback">
                    Manage Feedback
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        
        
    </div>

    <div class="dash_table_area">
        <h1 class="table_heading">Last 4 Activity</h1>
        <div class="row dashboard_table">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                                        
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Title Name</th>
                                        <th>Module Name</th>
                                        <th>Page Action</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                                                                                                                                            <tr>
                                                <td>1</td>
                                                <td>Admin</td>
                                                <td>Calling quotations for the printing of Annual Report 2024-2025.</td>
                                                <td>Tender Model</td>
                                                <td>update</td>
                                                <td>2025-02-21 11:34:10</td>
                                            </tr>
                                                                                    <tr>
                                                <td>2</td>
                                                <td>Admin</td>
                                                <td>test</td>
                                                <td>menu Model</td>
                                                <td>delete</td>
                                                <td>2025-02-20 09:47:02</td>
                                            </tr>
                                                                                    <tr>
                                                <td>3</td>
                                                <td>Admin</td>
                                                <td>test</td>
                                                <td>logo Model</td>
                                                <td>delete</td>
                                                <td>2025-02-20 05:27:11</td>
                                            </tr>
                                                                                    <tr>
                                                <td>4</td>
                                                <td>Admin</td>
                                                <td>test</td>
                                                <td>Logo Model</td>
                                                <td>Insert</td>
                                                <td>2025-02-20 05:25:39</td>
                                            </tr>
                                                                                    <tr>
                                                <td>5</td>
                                                <td>Admin</td>
                                                <td>testing</td>
                                                <td>tender Model</td>
                                                <td>delete</td>
                                                <td>2025-02-19 12:44:48</td>
                                            </tr>
                                                                            
                                </tbody>
                            </table>
                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
            </div>
@endsection;