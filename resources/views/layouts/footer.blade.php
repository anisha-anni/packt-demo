<div class="footer">
    <div>
        <strong>Copyright</strong> e2logy &copy; <?php echo date('Y')?>
    </div>
</div>
</div>
</div>

<!--Confirm Modal Starts-->
<div class="modal" tabindex="-1" id="confirm-modal" role="dialog" style="z-index: 3000 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Please Confirm</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="" value="" id="hidden_id" data-status="">
                <input type="hidden" value="" id="active-status" data-id="">
                <p>Are you sure that you want to <b><span id="confirm-message"><span></b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="confirm-handler">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--Confirm Modal Ends-->

<!--Edit Book Modal Starts-->
<div class="modal" id="editBookModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" id="editBookForm" action="{{url::to('/edit-book-info')}}" enctype="multipart/form-data" style="width:100%;">
            @csrf
            <div class="modal-header">
                <h3 class="modal-title">Edit Book Detail</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body gray-bg" style="max-height: 550px !important;overflow-y: scroll;">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" id="cancelEditBook" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" id="editBook" value="Save">
            </div>
            </form>
        </div>
    </div>
</div>
<!--Edit Book Modal Ends-->

<!--Add Book Modal Starts-->
<div class="modal" id="addBookModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" id="addBookForm" action="{{url::to('/add-book')}}" enctype="multipart/form-data" style="width:100%;">
            @csrf
            <div class="modal-header">
                <h3 class="modal-title">Add Book</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body gray-bg" style="max-height: 550px !important;overflow-y: scroll;">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="ibox">
                        <div class="ibox-title">
                            <h5>Basic Info</h5>
                        </div>
                        <div class="ibox-content" style="padding: 10px 0px 5px 0px;">
                            <div class="row">
                            <div class="col-sm-3">
                                <centre>
                                <div class="form-group">
                                <div class="image-upload" id="imageUpload" style="height: 110px; width: 110px;">
                                    <input type="file" name="cover_image" id="cover_image" accept="image/*">
                                    <img id="new_cover_image" class="img-circle rounded-circle img-fluid" src="{{url('assets/images/book_thumbnail.png')}}" onerror="this.src='{{ url("assets/images/book_thumbnail.png") }}'" style="width: 110px; height: 110px; object-fit: cover!important;">            
                                    <label for="img-circle" class="overlay-text">
                                    <i class="fas fa-camera"></i>
                                    <b>Upload Image</b>
                                    </label>
                                </div>
                                <p class="errorMsg" id="error_cover_image"></p>
                                </div>
                                </centre>
                            </div>
                            <div class="col-sm-9" style="padding:0px;">
                                <div class="row-fluid">
                                    <div class="col-sm-12-fluid mt-3">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Title<b><span class="text-danger">*</span></b></label>
                                            <div class="col-lg-8">
                                            <input type="text" name="title" id="title" class="form-control" onblur="trim(this)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12-fluid mt-2">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Author<b><span class="text-danger">*</span></b></label>
                                            <div class="col-lg-8">
                                                <input type="text" name="author" id="author" class="form-control" onblur="trim(this)">
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12-fluid mt-1">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Genre<b><span class="text-danger">*</span></b></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="genre" id="genre" class="form-control" onblur="trim(this)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12-fluid mt-1">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">ISBN<b><span class="text-danger">*</span></b></label>
                                        <div class="col-lg-9">
                                        <input type="text" name="isbn" id="edit_isbn" class="form-control" onkeypress="return isNumber(event)" maxlength="13" onblur="trim(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="ibox">
                        <div class="ibox-title">
                            <h5>Publication Info</h5>
                        </div>
                        <div class="ibox-content" style="padding: 20px 0px 0px 0px;">
                            <div class="row-fluid" style="min-height: 272px;">
                                <div class="col-sm-12-fluid mt-1">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Publisher</label>
                                        <div class="col-lg-8">
                                        <input type="text" class="form-control" name="publisher" id="publisher">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12-fluid">
                                    <div class="form-group row">
                                        <label class="col-lg-4 mt-1 col-form-label">Publication Date (d/m/Y)<b><span class="text-danger">*</span></b></label>
                                        <div class="col-lg-8 mt-1">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar" id="publication_calendar"></i></span>
                                                <input class="form-control" type="text" name="published" id="published">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12-fluid">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Description <b><span class="text-danger">*</span></b></label>
                                        <div class="col-lg-8">
                                            <textarea rows="4" name="description" id="description" class="form-control" onblur="trim(this)">
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" id="cancelSaveBook" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-primary" id="saveBook" value="Save">
            </div>
            </form>
        </div>
    </div>
</div>
<!--Add Book Modal Ends-->

<!--Confirm Modal Starts-->
<div class="modal" tabindex="-1" id="confirm-modal" role="dialog" style="z-index: 3000 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Please Confirm</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="" value="" id="hidden_id" data-status="">
                <input type="hidden" value="" id="active-status" data-id="">
                <p>Are you sure that you want to <b><span id="confirm-message"><span></b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="confirm-handler">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--Confirm Modal Ends-->

<!-- Mainly scripts -->
<script src="{{ url('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ url('assets/js/popper.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap.js') }}"></script>
<script src="{{ url('assets/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ url('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('assets/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ url('assets/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ URL::asset('assets/cropperjs/cropper.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ url('assets/js/inspinia.js') }}"></script>
<script src="{{ url('assets/js/toastr.min.js') }}"></script>
<script src="{{ URL::asset('assets/jquery_validation/jquery.validate.min.js') }}"></script>
<script>
$(document).ready(function(){
    $("#addBookForm").validate({
        rules: {
            title : {
                required: true,
                minlength: 5,
                maxlength: 255,
            },
            author : {
                required: true,
                minlength: 5,
                maxlength: 255,
            },
            genre : {
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            isbn : {
                required: true,
                number: true,
                maxlength: 13,
            },
            publisher : {
                required: true,
                minlength: 5,
                maxlength: 255,
            },
            published : {
                required: true
            },
            description : {
                required: true,
                minlength: 10
            }
        },
        messages: {
            title: {
                required: "Please enter book title",
                minlength: "Title must be at least 5 characters long",
                maxlength: "Title must be less than or equal to 255 characters",
            },
            author: {
                required: "Please enter author name",
                minlength: "Author name must be at least 5 characters long",
                maxlength: "Author name must be less than or equal to 255 characters",
            },
            genre: {
                required: "Please enter book genre",
                minlength: "Genre must be at least 3 characters long",
                maxlength: "Genre must be less than or equal to 255 characters",
            },
            isbn: {
                required: "Please enter isbn number",
                number: "Only numbers allowed",
                maxlength: "isbn number must be less than or equal to 13 characters",
            },
            publisher: {
                required: "Please enter publisher name",
                minlength: "Publisher name must be at least 5 characters long",
                maxlength: "Publisher name must be less than or equal to 255 characters",
            },
            published: {
                required: "Please enter date of publication"
            },
            description: {
                required: "Please enter description",
                minlength: "Description must be at least 10 characters long"
            }
        }
    });

    $("#editBookForm").validate({
        rules: {
            title : {
                required: true,
                minlength: 5,
                maxlength: 255,
            },
            author : {
                required: true,
                minlength: 5,
                maxlength: 255,
            },
            genre : {
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            isbn : {
                required: true,
                number: true,
                maxlength: 13,
            },
            publisher : {
                required: true,
                minlength: 5,
                maxlength: 255,
            },
            published : {
                required: true
            },
            description : {
                required: true,
                minlength: 10
            },
        },
        messages: {
            title: {
                required: "Please enter book title",
                minlength: "Title must be at least 5 characters long",
                maxlength: "Title must be less than or equal to 255 characters",
            },
            author: {
                required: "Please enter author name",
                minlength: "Author name must be at least 5 characters long",
                maxlength: "Author name must be less than or equal to 255 characters",
            },
            genre: {
                required: "Please enter book genre",
                minlength: "Genre must be at least 3 characters long",
                maxlength: "Genre must be less than or equal to 255 characters",
            },
            isbn: {
                required: "Please enter isbn number",
                number: "Only numbers allowed",
                maxlength: "isbn number must be less than or equal to 13 characters",
            },
            publisher: {
                required: "Please enter publisher name",
                minlength: "Publisher name must be at least 5 characters long",
                maxlength: "Publisher name must be less than or equal to 255 characters",
            },
            published: {
                required: "Please enter date of publication"
            },
            description: {
                required: "Please enter description",
                minlength: "Description must be at least 10 characters long"
            }
        }
    });
});

    $('#new_cover_image').click(function(){
        $('#cover_image').click();
    });

    $(function(){
      $("#cover_image").change(function(){
        var ext = $('#cover_image').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $('#cover_image').val(null);
            $('#error_cover_image').text('Only .jpg, .jpeg, .png image allowed.');
            return false;
        }else{
          $('#error_cover_image').html('');
          var path =  readURL(this, "new_cover_image");
        }
      });
      var imgsrc = $('#new_cover_image').attr('src');
    });

    function readURL(input,container) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#"+container).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
 
    function dateFormat(added_on){
        var date = new Date(added_on + 'Z');
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var AMPM = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + AMPM;
        var d = new Date(added_on + 'Z'),
        dd = d.getDate();
        mm = d.getMonth()+1;
        yy = d.getFullYear();
        dformat = mm+'/'+dd+'/'+yy+ '  '+strTime;
        return dformat;
    }

    function trim (el) {
        el.value = el.value.
        replace (/(^\s*)|(\s*$)/gi, ""). // removes leading and trailing spaces
        replace (/[ ]{2,}/gi," ").       // replaces multiple spaces with one space
        replace (/\n +/,"\n");           // Removes spaces after newlines
        return;
    }

    function makeToastNotification(data) {
        setTimeout(function() {
            toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 2000
        };
        toastr.success(data.message, data.strong);
        }, 300);
    }

    $("#published").datepicker({
        format: 'dd/mm/yyyy', 
        autoclose: true, 
        todayHighlight: true,
        endDate: "today"
    });

    $('#publication_calendar').on('click', function(){
        $('#published').focus();
    });

</script>
</body>
</html>
