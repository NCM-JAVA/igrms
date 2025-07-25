@extends('layouts.master') @section('content') @section('title', 'Edit CommanSetting')
<div class="row">
    <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header"><h4>Comman Website Setting</h4></div>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif 
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('setting.update' , $websiteSetting->id) }}" method="POST">
                @csrf
                    @method('PUT')
                 
                            
                    <div class="form-group">
                    <label>Language:</label>
                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="1"  @if((!empty($websiteSetting->language)?$websiteSetting->language:old('language'))==1) checked @endif class="@error('language') is-invalid @enderror" />English &nbsp;
                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="2"  @if((!empty($websiteSetting->language)?$websiteSetting->language:old('language'))==2) checked @endif class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
                        @error('language')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                           
                    <div class="form-group">
                        <label> Name </label>
                        <input
                            type="text"
                            autocomplete="off"
							onkeypress="return onlyAlphabets(event,this);" 
                            value="{{ !empty($websiteSetting->website_name)?$websiteSetting->website_name:old('website_name') }}"
                            name="website_name"
                            id="website_name"
                            maxlength="120"
                            minlength="1"
                            placeholder="IGRMS"
                            class="form-control @error('website_name') is-invalid @enderror"
                        />
                        @error('website_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Short Name </label>
                        <input
                            type="text"
                            autocomplete="off"
							onkeypress="return onlyAlphabets(event,this);" 
                            value="{{ !empty($websiteSetting->website_short_name)?$websiteSetting->website_short_name:old('website_short_name') }}"
                            name="website_short_name"
                            placeholder="PM"
                            id="website_short_name"
                            maxlength="2"
                            minlength="2"
                            class="form-control @error('website_short_name') is-invalid @enderror"
                        />
                        @error('website_short_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Tags </label>
                        <input
                            type="text"
                            autocomplete="off"
                            value="{{ !empty($websiteSetting->website_tags_name)?$websiteSetting->website_tags_name:old('website_tags_name') }}"
                            name="website_tags_name"
                            id="website_tags_name"
                            maxlength="120"
                            minlength="2"
							onkeypress="return onlyAlphabets(event,this);" 
                            placeholder="Patna Metro is Govt. project"
                            class="form-control @error('website_tags_name') is-invalid @enderror"
                        />
                        @error('website_tags_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Logo </label>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <input type="file" name="logo" id="logo" onchange="checkfile('photograph',this.value);" maxlength="64" minlength="2" 
                                class="form-control " />
                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <input type="hidden" name="oldLogo"  accept="image/jpeg,image/gif,image/png,image/jpg" value="{{ !empty($websiteSetting->logo)?$websiteSetting->logo:'' }}" >
                                @if(!empty($websiteSetting->logo))
                                <img class="w-50 img-responsive" alt="image" id="logoimg" src="{{ URL::asset('public/upload/admin/setting/')}}/{{$websiteSetting->logo}}" class="rounded-circle mr-1" />
                                @else
                                    <img class="w-50 img-responsive " id="logoimg" alt="image" src="{{ URL::asset('public/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1" />
                                 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <label> Favicon </label>
                                <input  accept="image/jpeg,image/gif,image/png,image/jpg" type="file" onchange="checkfile('photograph',this.value);" name="favicon" id="favicon" maxlength="64" minlength="2" class="form-control" />
                                <input type="hidden" name="oldfav" value="{{!empty($websiteSetting->favicon)?$websiteSetting->favicon:'' }}" >
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                    @if(!empty($websiteSetting->favicon))
                                    <img class="w-25 img-responsive " id="fivimg"  alt="image" src="{{ URL::asset('public/upload/admin/setting/')}}/{{$websiteSetting->favicon}}" class="rounded-circle mr-1" />
                                    @else
                                    <img class="w-25 img-responsive "  id="fivimg" alt="image" src="{{ URL::asset('public/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1" />
                                 
                                    @endif
                                
                            </div>
                        </div>
                    </div>
                   
                   
                          <div class="form-group">
                          <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <label> Themes: </label>
                              
                                <select name="themes" class="input_class form-control @error('themes') is-invalid @enderror " id="themes" autocomplete="off">
                                    <option value=""> Select </option>
                                        <?php
                                        $statusArray = get_themestype();
                                        foreach($statusArray as $key=>$value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if((!empty($websiteSetting->themes)?$websiteSetting->themes:old('themes'))==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php  }?>
                                </select>
                                    @error('themes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            </div>
                    <div class="form-group">
                    <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <button class="btn btn-success ">Save</button>
                                <a href="{{URL::to('admin/setting/')}}" class="btn btn-primary" >back</a>
                               
                            </div>
                        </form>
                       
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkfile(name,id)
        {
           if(id != " "){
            if(name== "logo"){
          
             $("#texthide").css("display", "none");
            
                 const [file] = logo.files
                 //alert(file);
                if (file) {
                    logoimg.src = URL.createObjectURL(file)
                }
            }
            if(name== "favicon"){
                
                $("#sigtexthide").css("display", "none");
                const [file] = favicon.files
                if (file) {
                    fivimg.src = URL.createObjectURL(file)
                }

           }
          
        }
    }
    </script>
@endsection;
