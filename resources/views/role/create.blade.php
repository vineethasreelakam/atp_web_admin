
@extends('layouts.app-master')

@section('content')




    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Role</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-1"style="float:right;">
                    <a href="{{route('role')}}">
                        <button class="dt-button btn btn-primary btn-add-record ml-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" style="float:right;">
                            <span><i data-feather="list"></i> List All</span>
                        </button> 
                    </a>
                </div>
            </div>
         
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card ">

                            <div class="card-header">
                            </div>

                            <div class="card-body">
                                
                                <form id="admin_form" class="form-validate" method="POST" action="{{route('role.store')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="{{$formData->id}}">

                                    @csrf    
                                    <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" placeholder="Title" value="{{$formData->title}}" name="title" id="title" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="table-responsive border rounded mt-1">
                                                    <!-- <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                        <span class="align-middle">Permission</span>
                                                    </h6> -->
                                                    <table class="table table-striped table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Permissions</th>
                                                                <th>Allow</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                if(isset($formData->Privilleges)){
                                                                    $privillegeArray=[];
                                                                    foreach($formData->Privilleges as $val){
                                                                        $privillegeArray[]=$val->privillege_id;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if(isset($privilleges))
                                                                @foreach($privilleges as $val)
                                                                    <tr>
                                                                        <td>{{$val->title}}</td>
                                                                        <td>
                                                                            <div>
                                                                                <input name="privilleges[]" type="checkbox" value="{{$val->id}}" <?php  echo isset($privillegeArray) && in_array($val->id,$privillegeArray) ? 'checked' : ''?>/>
                                                                                <label class="" for=""></label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="table-responsive border rounded mt-3">
                                                   <!--  <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                        <span class="align-middle">Permission</span>
                                                    </h6> -->
                                                    <table class="table table-striped table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Form Access</th>
                                                                <th>Allow</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                if(isset($formData->Forms)){
                                                                    $formsArray=[];
                                                                    foreach($formData->Forms as $val){
                                                                        $formsArray[]=$val->form_id;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if(isset($forms))
                                                                @foreach($forms as $val)
                                                                    <tr>
                                                                        <td>{{$val->title}}</td>
                                                                        <td>
                                                                            <div>
                                                                                <input name="forms[]" type="checkbox" value="{{$val->id}}" <?php  echo isset($formsArray) && in_array($val->id,$formsArray) ? 'checked' : ''?>/>
                                                                                <label class="" for=""></label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    
@endsection

@section('javascript')
        <script>
            $(document).ready(function(){
                $("#admin_form").validate({
                    
                    // In 'rules' user have to specify all the
                    // constraints for respective fields
                    rules: {
                        title:"required",
                    },
                    // In 'messages' user have to specify message as per rules
                    messages: {
                        title:"Please enter Title",
                    }
                });
            })
        </script>            
@endsection