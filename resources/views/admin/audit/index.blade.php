@extends('layouts.master');
@section('content')
@section('title', 'Manage Recruitment')
<div class="card">
    <div class="card-body"> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
        </div>
        <!-- /.col-12 col-md-12 col-lg-12 -->
       

  
  
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="search-from">
              
                   
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
                            <th>User Name</th>
                            <th>Page Name</th>
                            <th>Page Action</th>
                            <th>UserType</th>
							<th>Date</th>
                        </tr>
						</thead>
						
						<tbody id="list">
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
                                            <td><?php echo ucwords( get_username($row->user_login_id)); ?></td>
                                            
                                            <td><?php echo $row->page_name; ?></td>
                                            <td><?php echo $row->page_action; ?></td>
                                            <td><?php echo $row->usertype; ?></td>
											<td><?php echo $row->created_at; ?></td>
                                        </tr>
									<?php
										endforeach;
									?>
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