@extends('layouts.master'); @section('content') @section('title', 'Manage Gallery')
<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <a style="float: right;" href="{{URL::to('admin/photo-gallery/create')}}" class="btn btn-primary pull-right"> Add Photo Gallery</a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="search-from">

                                <form action="#" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group ">
                                            <label for="Title">Title: </label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input onchange="search(this);" class="form-control" type="text" name="title" value="{{Session::get('title')??''}}">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Status">Status: </label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <select onchange="search(this);" name="approve_status" id="approve_status" class="form-control">
                                            <option value=""> Select </option>
                                                <?php
                                                $statusArray = get_status();
                                                foreach($statusArray as $key=>$value) {
                                                    ?>
                                                    <option value="<?php echo $key; ?>" <?php if(Session::get('approve_status')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                                <?php  }?>    
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="language">Language: </label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <select  onchange="search(this);" name="language_id" id="language_id" class="form-control">
                                                <option value="1" @if(Session::get('language_id')==1) selected @endif  >English</option>
                                                <option value="2" @if(Session::get('language_id')==2) selected @endif  >Hindi</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <input onchange="search(this);" class="form-control btn btn-success" type="submit" name="search" value="Search">
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
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Language</th>
                                            <th>Status</th>
											<th width="10%">Image</th>
                                            <th width="15%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($list) > 0)
                                            <?php
                                                $count = 1;
                                                foreach($list as $row):
                                                    $image =  explode(",",$row->txtuplode);
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row->title; ?></td>
                                                <td title="{{$row->description}}">{{ strlen($row->description) > 90 ? substr($row->description, 0, 90) . '...' : $row->description }}</td>
                                                <td> {{ language($row->language) }} </td>
                                                <td> {{ status($row->txtstatus) }} </td>
                                                <td>
                                                    @if(!empty($row->txtuplode))
                                                        <img style="margin-bottom: 5%; aspect-ratio:6/3;" class="w-100 img-responsive" alt="image" id="logoimg" src="{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/')}}/{{$image[0]}}" class="rounded-circle mr-1" />
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('photo-gallery.destroy',$row->id) }}"  method="POST"> 
                                                        <a class="btn btn-primary" href="{{ route('photo-gallery.edit',$row->id) }}">Edit</a>
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                                endforeach;
                                            ?>
                                        @else
                                            <tr>
                                                <td colspan="7">No data found... </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {!! $list->withQueryString()->links('pagination::bootstrap-5') !!}
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
