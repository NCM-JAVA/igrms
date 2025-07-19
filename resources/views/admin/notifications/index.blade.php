@extends('layouts.master');
@section('content')
@section('title', 'Manage Notifications')
<div class="card">
    <div class="card-body"> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <a  style="float: right;" href="{{URL::to('admin/notifications/create')}}" class="btn btn-primary pull-right"> Add Notifications </a>
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
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Language</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>                            
                            <tbody id="list">
                                @if(count($list) > 0)
                                    <?php
                                        $count = 1;
                                        $menutypeArray = array(
                                            '1' => "Page",
                                            '2' => "File",
                                            '3' => "Link"
                                        );
                                        foreach($list as $row):
                                    ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row->title; ?></td>
                                            <td><?php echo status($row->txtstatus); ?></td>
                                            <td><?php echo language($row->language); ?></td>
                                            <td>
                                                <form action="{{ route('notifications.destroy',$row->id) }}"  method="POST"> 
                                                    <a href="{{route('notifications.edit', $row->id)}}" class="btn btn-primary btn-xs">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
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
<!-- Button trigger modal -->
<script src="{{ URL::asset('/public/assets/modules/jquery.min.js')}}"></script>
<script>
     var linkurl = "{{ url('/admin/get_filter_menu')}}";
        //alert(linkurl);
        jQuery.ajax({
            url: linkurl,
            type: "POST",
            //headers: headers,
            data: {id: id ,get_filter_menu:'get_filter_menu'},
            cache: false,
            success: function (html) {
                var Obj = JSON.parse(html);
             
                jQuery("#loading").hide();

                //add the content retrieved from ajax and put it in the #content div
                jQuery("#list").html(Obj.html);

                //display the body with fadeIn transition
                jQuery("#list").fadeIn("slow");
            },
        });
</script>

@endsection;