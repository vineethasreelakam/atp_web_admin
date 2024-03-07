
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
                                    <div class="row">
                                        @if (session('message') || session('deleteMessage'))
                                            <div class="{{session('message') ? 'alert alert-success' : (session('deleteMessage') ? 'alert alert-danger' : '')}}">{{ session('message') ? session('message') : session('deleteMessage')}}</div>
                                        @endif
                                    </div>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-1"style="float:right;">
                    <a href="{{route('role.create')}}">
                        <button class="dt-button btn btn-primary btn-add-record ml-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" style="float:right;">
                            <span><i data-feather="plus-square"></i> Add New</span>
                        </button> 
                    </a>
                </div>
            </div>
         
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Assign precise privileges for each role, specifying permissions like read, write, or custom actions. Implement form access controls, dictating which roles have permission to interact with specific interfaces or forms.
                                </p>
                            </div>
                            <form id="frm_delete" method="POST" action="">
                                {!! csrf_field() !!}
                                <input name="_method" type="hidden" value="delete">
                            </form>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Privilleges</th>
                                            <th>Forms</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if(isset($listData))
                                            @foreach($listData as $key=>$row)
                                            
                                                <tr>
                                                    <td>{{(($listData->currentPage()-1)*$listData->perPage())+$key+1 }}</td>
                                                    <td>{{$row->title}}</td>
                                                    
                                                    <td>
                                                        <span class="badge badge-pill badge-light-primary mr-1">
                                                            @php
                                                                if(isset($row->Privilleges)){
                                                                    //$privillegeArray=json_decode($row->privilleges);
                                                                    $privillegeCount=count($row->Privilleges);
                                                                    foreach($row->Privilleges as $key=>$privillege){
                                                                        $privillegeMaster=DB::table('privillege_master')->where('id',$privillege->privillege_id)->first();
                                                                        $coma=$key<=$privillegeCount-2 ? ',' :'';
                                                                        echo $privillegeMaster->title.$coma;
                                                                    }  
                                                                }    
                                                            @endphp
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-pill badge-light-success mr-1">
                                                            @php
                                                                if(isset($row->Forms)){
                                                                    $formsCount=count($row->Forms);
                                                                    foreach($row->Forms as $key=>$form){
                                                                        $formMaster=DB::table('form_master')->where('id',$form->form_id)->first();
                                                                        $coma=$key<=$formsCount-2 ? ',' :'';
                                                                        echo $formMaster->title.$coma;
                                                                    }  
                                                                }         
                                                            @endphp
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{route('role.create',['id'=>$row->id])}}">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item btn_delete" href="javascript:void(0);" data-url="{{route('role.delete',$row->id)}}">
                                                                    <i data-feather="trash" class="mr-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach                         
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->
                @include('pagination')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    
@endsection

@section('javascript')
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script>
        $(document).ready(function(){
            $(".btn_delete").click(function(){
                var url=$(this).attr('data-url');

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $('#frm_delete').attr('action', url);
                        $('#frm_delete').submit();
                    }
                })
                
            });
        });
    </script>    
@stop

