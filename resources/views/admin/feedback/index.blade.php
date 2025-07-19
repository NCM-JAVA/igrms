@extends('layouts.master') @section('content') @section('title', 'Manage Feedback')

<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
               
                
            </div>
            
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="search-from">

                                <form action="{{ route('feedback.index') }}" class="search_inbox" name="form1" id="form1" method="GET" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group ">
                                            <label for="name">Name: </label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" type="text" name="name" placeholder="Search name..." value="{{ request('name') }}">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="email">Email: </label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input class="form-control" type="text" name="email" placeholder="Search email..." value="{{ request('email') }}">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <input class="form-control btn btn-success" type="submit" name="search" value="Search">
                                        </div>
                                    </div> 
                                </form>

                            </div>
                        </div>

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Review Comment</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($list) > 0)
                                            <?php
                                                $count = 1;
                                                foreach($list as $row):
                                            ?>
                                            <tr>
                                                
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row->name; ?></td>
                                                <td><?php echo $row->email; ?></td>
                                                <td><?php echo $row->message; ?></td>
                                                <td><?php echo $row->review_comment; ?></td>
                                                <td>
                                                    <a class="btn btn-primary" href="{{ route('feedback.edit',$row->id) }}">Reply</a>
                                                </td>  
                                            </tr>
                                            <?php
                                                endforeach;
                                            ?>
                                        @else
                                            <tr>
                                                <td colspan="6"> No data found... </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                              
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-12 col-md-12 col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.row -->
</div>

@endsection;
