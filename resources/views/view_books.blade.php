@extends('layouts.master')
@section('content')
@if(session('message'))
<div role="alert" id ="mess" class="alert {{ session('class') }} alert-dismissible" style="text-align:center">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button">
        <span aria-hidden="true">×</span>
    </button>
    {{ session('message') }}
</div>
@endif

<?php
$timezone = 'Asia/Kolkata';
?>

<div class="row col-md-12 wrapper border-bottom white-bg page-heading" style="padding-left : 0px !important!;">
    <div class="col-md-12 panel-body">
        <form method="post" action="{{URL::to('/books')}}" enctype="multipart/form-data">
        @csrf
        <?php for($i=0;$i<=2;$i++) { ?>
        <div class="row col-md-12" id="filter_{{$i}}" @if($i!=0) style="display:none;" @endif>
            <div class="col-md-2 form-group " style="width: 100%;">
                <label for="search_in">Search In</label>
                <select name="search_in[{{$i}}]" id="search_in_{{$i}}" data-id="{{$i}}" class="search_in js-states form-control select2-selection__rendered" tabindex="-1" style="width: 100%">
                <option style="cursor:pointer;" value="title" @if(isset($inputValue) && ($inputValue['search_in'][$i] == 'title')){{{ "selected" }}} @endif >Title</option>
                <option style="cursor:pointer;" value="author" @if(isset($inputValue) && ($inputValue['search_in'][$i] == 'author')){{{ "selected" }}} @endif >Author</option>
                <option style="cursor:pointer;" value="isbn" @if(isset($inputValue) && ($inputValue['search_in'][$i] == 'isbn')){{{ "selected" }}} @endif >ISBN</option>
                <option style="cursor:pointer;" value="genre" @if(isset($inputValue) && ($inputValue['search_in'][$i] == 'genre')){{{ "selected" }}} @endif >Genre </option>
                <option style="cursor:pointer;" value="published" @if(isset($inputValue) && ($inputValue['search_in'][$i] == 'published')){{{ "selected" }}} @endif >Publication Date</option>
                <option style="cursor:pointer;" value="created_at" @if(isset($inputValue) && ($inputValue['search_in'][$i] == 'created_at')){{{ "selected" }}} @endif >Created At</option>
                </select>
            </div>
            <div class="col-md-2 form-group form-group-search searchTypeDiv">
                <label for="search_type">Search Type</label>
                <select name="search_type[{{$i}}]" id="search_type_{{$i}}" class="js-states form-control select2-selection__rendered" tabindex="-1" style="width: 100%" >
                <option value="contains" @if(isset($inputValue) && ($searchType[$i] == 'contains')){{{ "selected" }}} @endif >Contains</option>
                <option value="begins_with" @if(isset($inputValue) && ($searchType[$i] == 'begins_with')){{{ "selected" }}} @endif >Begins With</option>
                <option value="ends_with" @if(isset($inputValue) && ($searchType[$i] == 'ends_with')){{{ "selected" }}} @endif >Ends With</option>
                <option value="exact_match" @if(isset($inputValue) && ($searchType[$i] == 'exact_match')){{{ "selected" }}} @endif >Exact Match</option>
                </select>
            </div>
            <div class="col-md-3 form-group form-group-search">
                <span id="suggestion_text_span_{{$i}}">
                <label for="suggestion_text">Enter Text</label>
                <input type="text" name="suggestion_text[{{$i}}]" value="<?php if(isset($inputValue)) { echo $inputValue['suggestion_text'][$i]; } ?>" class='form-control suggestion_text{{$i}}' id='suggestion_venue' onblur='trim(this)' maxlength='255' autocomplete='off'>
                <span id="display_suggestion_venue_list" style="position:absolute;margin-top:-1px;display:none;overflow:hidden;background-color:white; z-index:9; width:97%"></span>
                </span>

                <span id="date_range_span_{{$i}}" style="display: none; width: 100%;">
                <label for="date_range">Date Range (d-m-Y)</label>
                <input type="text" class="form-control date-range-piker-field date_range{{$i}}" name="datefilter[{{$i}}]" value="<?php if(isset($inputValue)){echo $inputValue['datefilter'][$i];}?>">
                </span>
            </div>
            <div class="col-md-2 form-group form-group-search c1">
                @if($i == 0)
                    <button type="button" class="btn btn-info btn-addon col-md-4 col-xs-12 add-filter" id="{{$i}}"  style="margin-top: 25px; min-width: 90px;"><i class="fa fa-plus fa-lg" style="font-weight: bold; margin-right: 4px;"></i>Criteria</button>
                @else
                    <button type="button" class="btn btn-danger  col-md-4 col-xs-12 remove-filter" id="{{$i}}" style="margin-top: 28px;  min-width: 90px;"><i class="fa fa-times fa-lg" style="font-weight: bold; margin-right: 4px;"></i>Criteria</button>
                @endif
            </div>
            @if($i==0)
                <div class="col-md-1 form-group form-group-search c1" style="padding: 0;">
                <label for="limit">Limit</label>
                <select name="limit_flag" id="limit_flag" class="js-states form-control" tabindex="-1">
                <option value="50" @if(isset($inputValue) && ($inputValue['limit_flag'] == 50) || isset($default_limit)){{{ "selected" }}} @endif >50</option>
                <option value="100" @if(isset($inputValue) && ($inputValue['limit_flag'] == 100)){{{ "selected" }}} @endif >100</option>
                <option value="200" @if(isset($inputValue) && ($inputValue['limit_flag'] == 200)){{{ "selected" }}} @endif >200</option>
                <option value="500" @if(isset($inputValue) && ($inputValue['limit_flag'] == 500)){{{ "selected" }}} @endif >500</option>
                </select>
            </div>
            <div class="col-md-2 col-md-offset-0 col-sm-6 col-sm-offset-2 col-xs-12 form-group form-group-search" style="text-align: right;">
                <button type="submit" class="btn btn-info btn-addon m-y-sm col-md-9 col-md-offset-3 col-xs-12 col-sm-offset-0" style="margin-top: 28px; min-width: 120px;"><i class="fa fa-search" style="margin-right: 4px;"></i>Filter/Apply</button>
            </div>
            @endif
        </div>
        <?php } ?>
        <input type="hidden" name="divToShow" id="divToShow" value="{{ $divToShow }}">
        <input type="hidden" name="formCount" id="formCount" value="{{ $formCount }}">
        </form>
    </div>
</div>

<div class="wrapper wrapper-content  fadeInRight">
    <div class="row">
        <div class="col-lg-12-fluid">
            <div class="ibox ">
                <div class="ibox-title" style="padding: 15px 25px 8px 15px !important;">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2 style="font-weight: 500;">Books<span style="color: #2f2c3d; font-size: 17px;"> @if($countBookRequests > 0)({!!$countBookRequests!!})@endif</span></h2>
                            </div>
                            <div class="col-lg-4" style="text-align:right;">
                            <a data-target="#addBookModal" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-info btn-addon rightButton" style="height: 35px;"><i class="fa fa-plus fa-lg"></i> &nbsp; Book</a> &nbsp; 
                            <a class="btn btn-info btn-addon rightButton addFakeBooks" style="height: 35px;"><i class="fa fa-plus fa-lg"></i> &nbsp; Fake Books</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive" style="min-height: 400px;">
                        <table class="table table-striped table-bordered table-hover dataTables-books">
                            <thead>
                                <tr>
                                    <th class="text-center" style="background-color:transparent;"></th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Author</th>
                                    <th class="text-center">Genre</th>
                                    <th class="text-center">ISBN</th>                                    
                                    <th class="text-center">Publication Date(d/m/Y)</th>
                                    <th class="text-center">Created At (d/m/Y)</th>
                                    <th class="text-center">Updated At (d/m/Y)</th>
                                    <th class="text-center" style="background:transparent;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookDetails as $bookDetail)
                                <tr>
                                    <td>
                                    <?php
                                        if($bookDetail->image != '' || $bookDetail->image != null){
                                        $coverImage = url($bookDetail->image);
                                    ?>
                                        <a id="book_{{$bookDetail->id}}" class="viewBookDetail" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-name="{{$bookDetail->title}}"><img class="img-circle avatar" src="{{$coverImage}}" onerror="this.src='{{ url("/assets/images/book_thumbnail_small.png") }}'" style="width:40px; height:40px; margin: auto;" alt="Cover Image"></a>
                                    <?php
                                    }else{
                                    ?>
                                        <a id="book_{{$bookDetail->id}}" class="viewBookDetail" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-name="{{$bookDetail->title}}"><img class="img-circle avatar" src="{{url('/assets/images/book_thumbnail_small.png')}}" style="width:40px; height:40px; margin: auto;" alt="Cover Image"></a>
                                    <?php
                                    }
                                    ?>
                                    </td>
                                    <td>
                                        <a id="book_{{$bookDetail->id}}" class="viewBookDetail" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-name="{{$bookDetail->title}}" style="color:#0062cc!important;">{{$bookDetail->title}}</a>
                                    </td>
                                    <td>
                                        {{$bookDetail->author}}
                                    </td>
                                    <td>
                                        {{$bookDetail->genre}}
                                    </td>
                                    <td>
                                        {{$bookDetail->isbn}}
                                    </td>
                                    <td>
                                        <?php
                                        $datePublished = \BookHelper::ConvertGMTToLocalTimezone($bookDetail->published, $timezone);
                                        $publishedAt = $datePublished->format("d/m/Y");
                                        echo $publishedAt;
                                        ?>
                                    </td>
                                    
                                    
                                    <td>
                                        <?php
                                        $dateCreated = \BookHelper::ConvertGMTToLocalTimezone($bookDetail->created_at, $timezone);
                                        $createdAt = $dateCreated->format("d/m/Y h:i A");
                                        echo $createdAt;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $dateUpdated = \BookHelper::ConvertGMTToLocalTimezone($bookDetail->updated_at, $timezone);
                                        $updatedAt = $dateUpdated->format("d/m/Y h:i A");
                                        echo $updatedAt;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" id="dropdown_{{$bookDetail->id}}">
                                            <i class="fa fa-ellipsis-v grab dropdown-toggle" data-toggle="dropdown"></i>

                                           <ul id="dropdown_content_{{$bookDetail->id}}" class="dropdown-menu" data-id="not-visible">
                                            <li>
                                               <a id="profile_{{$bookDetail->id}}" class="dropdown-item viewBookDetail" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-name="{{$bookDetail->title}}"><i class="fa fa-eye ml-2 mr-2 text-block" aria-hidden="true"></i><span class="mr-2">View Book Detail</span></a>
                                            </li>
                                            <li>
                                               <a id="edit_{{$bookDetail->id}}" class="dropdown-item editBookToggle" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-name="{{$bookDetail->title}}"><i class="fa fa-edit ml-2 mr-2 text-block" aria-hidden="true"></i><span class="mr-2">Edit Book Detail</span></a>
                                            </li>
                                            <li>
                                                <a href="#" id="delete_{{$bookDetail->id}}" data-target="#confirm-modal" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="dropdown-item deleteToggle" data_user="delete_{{$bookDetail->id}}"><i class="fa fa-trash ml-2 mr-2 text-block" aria-hidden="true"></i>Delete this Book</a>
                                            </li>
                                           </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--View Book Modal Starts-->
<div class="modal" id="viewBookDetailModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">View Book Detail</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body gray-bg" style="max-height: 550px !important;overflow-y: scroll;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--View Book Modal Ends-->
@endsection
@section('javascript')
<script>
$(document).ready(function () {
    $('.dataTables-books').DataTable({
        pageLength: 10,
        responsive: true,
        searching: true,
        aaSorting:[],
        "columnDefs": [{ 'orderable': false, 'targets': [0,8] }],  
    });

});

$(function() {
    for(i=0;i<=4;i++) {
        $('.date_range'+i).daterangepicker({
            autoUpdateInput: false,
            locale: {
            cancelLabel: 'Clear',
            format: 'DD-MM-YYYY'
            }
        });
        $('.date_range'+i).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' ~ ' + picker.endDate.format('DD-MM-YYYY'));
        });

        $('.date_range'+i).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    }
});            

var divsToShow = $('#divToShow').val().split(',');
for(i=0;i<=divsToShow.length;i++) {
    $('#filter_'+divsToShow[i]).show();
}

$(document).on('change', '.search_in', function(){
    var id = $(this).attr('data-id');
    var search_in = $('#search_in_'+id).val();
    showHideSpan(search_in,id);
});

var formCount = $('#formCount').val();
for(i=0;i<=2;i++) {
    var search_in = $('#search_in_'+i).val();
    if (search_in != 'title' && search_in != 'author' && search_in != 'genre' && search_in != 'isbn') {
        showHideSpan(search_in,i);
    }
}
if(formCount == 2 || formCount == 3) {
    $('.add-filter').attr('disabled','true');
}
$(document).on('click', '.add-filter', function() {
    var formCount = $('#formCount').val();
    if(formCount < 3) {
        formCount++;
        $('#formCount').val(formCount);
        if(formCount == 2 || formCount == 3) {
            $('.add-filter').attr('disabled','true');
        }
        var divToShow = $('#divToShow').val();
        var divArrayToShow = divToShow.split(',');
        for(i=0;i<=2;i++) {
            if($('#filter_'+i).is(":visible")) {
        } else {
            $('#filter_'+i).show();
            if(jQuery.inArray(i,divArrayToShow) == -1) {
                if(divToShow != '' ) {
                    $('#divToShow').val(divToShow+','+i);
                }
                else {
                    $('#divToShow').val(i);
                }
            }
                return false;
            }
        }
    }
});
$(document).on('click', '.remove-filter', function() {
    var index = $(this).attr('id');
    $('#filter_'+index).hide();
    var formCount = $('#formCount').val();
    formCount--;
    var divString = $('#divToShow').val();
    var divArrayToHide = divString.split(',');
    var divArrayToHide = jQuery.grep(divArrayToHide, function(value) {
        return value != index;
    });
    var divStringToHide = divArrayToHide.toString();
    $('#divToShow').val(divStringToHide);
    $('#formCount').val(formCount);
    $('.add-filter').removeAttr('disabled');
    $('#user_type_'+i).val('Any').change();
    $('#block_flag_'+i).val('Any').change();
    $('#department_flag'+i).val('Any').change();
    $('#device_type_'+i).val('Any').change();
    $('.date_range'+index).val('');
    $('.suggestion_text'+index).val('');
});

function showHideSpan(search_in,i){
    if(search_in == 'title' ||  search_in == 'author' || search_in == 'isbn' || search_in == 'genre'){
        $('.searchTypeDiv').css('display', 'block');
        $('#search_type_'+i).val('contains').change();
        $('#search_type_'+i).prop('disabled', false);
        $('#suggestion_text_span_'+i).css('display', 'block');
        $('.suggestion_text_'+i).removeAttr( "onkeyup","checkInput(this)");
        $('#date_range_span_'+i).css('display', 'none');
        $('.date_range'+i).val('');
    }
    else if(search_in == 'created_at' || search_in == 'published'){
        $('.searchTypeDiv').css('display', 'block');
        $('#search_type_'+i).attr('disabled', 'disabled');
        $('#search_type_'+i).val('exact_match').change();
        $('#date_range_span_'+i).css('display', 'block');        
        $('.suggestion_text'+i).removeAttr( "onkeyup", "checkInput(this)");   
        $('#suggestion_text_span_'+i).css('display', 'none');
    }
}

$(document).on('click', '.addFakeBooks', function(){
    $(".addFakeBooks").addClass('disabled');
    $.ajax({
        type: 'GET',
        url: "{{url('/add-fake-books')}}",
        success: function (data) {
            toastr.success('50 fake book created.','Success!');
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        },
        error: function(){
            $('#algo-alert').addClass('alert-danger');
            $('#algo-alert strong').text('Error !');
            $('#algo-alert span').text('Network error!!');
            $('#algo-alert').show();
            setTimeout(function() {
                $('#algo-alert').hide();
            }, 2000);
        }
    });
});

$(document).on('click', '.viewBookDetail',function(){
    var $this = $(this);
    var active_status=$(this).attr('data-value');
    var row_id = $(this).attr('id').split('_');
    var id = row_id[1];
    var title = $(this).attr('data-name').trim();
    $.ajax({
        type: 'GET',
        data: {'id' : id},
        url: "{{url('/view-book-detail')}}"+"/"+id,
        success: function (data) {
            $('#viewBookDetailModal').modal({backdrop: 'static', keyboard: false});
            $('#viewBookDetailModal .modal-title').html('View Book Detail - '+title);
            $('#viewBookDetailModal .modal-body').html(data);
        },
        error: function(){
            $('#algo-alert').addClass('alert-danger');
            $('#algo-alert strong').text('Error !');
            $('#algo-alert span').text('Network error!!');
            $('#algo-alert').show();
            setTimeout(function() {
                $('#algo-alert').hide();
            }, 2000);
        }
    });
});

$(document).on('click', '.editBookToggle',function(){
    var $this = $(this);
    var active_status=$(this).attr('data-value');
    var row_id = $(this).attr('id').split('_');
    var id = row_id[1];
    var title = $(this).attr('data-name').trim();
    $.ajax({
        type: 'GET',
        data: {'id' : id},
        url: "{{url('/edit-book')}}"+"/"+id,
        success: function (data) {
            $('#editBookModal').modal({backdrop: 'static', keyboard: false});
            $('#editBookModal .modal-title').html('Edit Book - '+title);
            $('#editBookModal .modal-body').html(data);
        },
        error: function(){
            $('#algo-alert').addClass('alert-danger');
            $('#algo-alert strong').text('Error !');
            $('#algo-alert span').text('Network error!!');
            $('#algo-alert').show();
            setTimeout(function() {
                $('#algo-alert').hide();
            }, 2000);
        }
    });
});

$(document).on('click', '.deleteToggle',function(){
    var row_id = $(this).attr('id').split('_');
    $("#hidden_id").val(row_id[1]);
    var delete_title = $('#title__'+row_id[1]).text();
    $('#confirm-message').html('delete this book?');
    $('#hidden_id').val(row_id[1]);
    $('#confirm-handler').attr('data_call', 'delete');
    $('.bold').html('delete');
    $("#dropdown_"+row_id[1]).attr('data-id','not-visible');
});

$(document).on('click','#confirm-handler', function(){
    if($(this).attr('data_call') == 'delete') {
        var id = $('#hidden_id').val();
        $.ajax({
            type: 'GET',
            data: {'id' : id },
            url: "{{url('/delete-book')}}",
            success: function (data) {
                if(data == 1){
                    $('#confirm-modal').modal('hide');
                    toastr.success('Book is deleted.','Success!');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function () {
                $('#algo-alert').addClass('alert-danger');
                $('#algo-alert strong').text('Error !');
                $('#algo-alert span').text('Network error!!');
                $('#algo-alert').show();
                setTimeout(function() {
                    $('#algo-alert').hide();
                }, 2000);
            }
        });
    }


});

    $(document).on('blur','#title', function() {
    var title = $(this).val();
    isExistBookTitle(title);           
    });

     function isExistBookTitle(title){
        if(title != ''){
                $.ajax({
                    type: "GET",
                    data: "title="+title,
                    url: "{{url('/is-exist-book-title')}}",
                    success: function (data) {
                        if(data == 1){
                           $('#titileError').html('This title is already in use.'); 
                           $('#title').focus();
                           $('#saveBook').attr("disabled", true);
                        }else if(data == 0){
                            if($('.form-group #titileError').text() == ''){
                            $('#saveBook').removeAttr('disabled');
                            $('#titileError').html(''); 

                            //Open Title Verification Modal Here
                            localStorage.setItem('title', title);
                            $('#title_verify_modal').modal({backdrop: 'static', keyboard: false});

                          }else{
                            $('#saveBook').attr('disabled');
                            $('#titileError').html(''); 
                          }
                        }else if(data == 3){
                            $('#titileError').html('Please enter correct title.'); 
                            $('#saveBook').attr("disabled", true);
                            $('#title').focus();
                        }
                    }
                },1000);
            }else{
                $('#saveBook').removeAttr('disabled');
                $('#titileError').html('');
            }
    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
@endsection