                <div class="row">
                    <div class="col-sm-6">
                        <div class="ibox">
                        <div class="ibox-title">
                            <h5>Basic Info</h5>
                        </div>
                        <div class="ibox-content" style="padding: 10px 0px 5px 0px;">
                            <div class="row">
                            <div class="col-sm-3">
                                <center>
                                <div class="form-group">
                                    <input type="hidden" name="book_id" value="{{$bookDetails->id}}">
                                    <div class="image-upload" id="imageUpload1" style="height: 110px; width: 110px;">
                                    <input type="file" name="cover_image" id="edit_cover_image" accept="image/*">


                                    @if($bookDetails->image!= '' || $bookDetails->image != null)
                                    <img id="edit_new_cover_image" class="img-circle rounded-circle img-fluid" src="{{url($bookDetails->image)}}" onerror="this.src='{{ url("/public/assets/images/book_thumbnail.png") }}'" style="width: 110px; height: 110px; object-fit: cover!important;">
                                    @else
                                    <img id="edit_new_cover_image" class="img-circle rounded-circle img-fluid" src="{{url('public/assets/images/book_thumbnail.png')}}" style="width: 110px; height: 110px; object-fit: cover!important;">
                                    @endif
                                </div>
                                <p class="errorMsg" id="error_edit_cover_image"></p>
                                </div>
                            </center>
                            </div>
                            <div class="col-sm-9" style="padding:0px;">
                                <div class="row-fluid">
                                    <div class="col-sm-12-fluid mt-3">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Title<b><span class="text-danger">*</span></b></label>
                                            <div class="col-lg-8">
                                            <input type="text" name="title" id="edit_title" class="form-control" maxlength="255" onblur="trim(this)" value="{{$bookDetails->title}}">
                                            <p class="errorMsg" id="error_edit_title"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12-fluid mt-2">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Author<b><span class="text-danger">*</span></b></label>
                                            <div class="col-lg-8">
                                                <input type="text" name="author" id="edit_author" class="form-control" onblur="trim(this)" value="{{$bookDetails->author}}">
                                                <p class="errorMsg" id="error_edit_author"></p>
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
                                        <input type="text" name="genre" id="edit_genre" class="form-control" onblur="trim(this)" value="{{$bookDetails->genre}}">
                                        <p class="errorMsg" id="error_edit_genre"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12-fluid mt-1">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">ISBN<b><span class="text-danger">*</span></b></label>
                                    <div class="col-lg-9">
                                    <input type="text" name="isbn" id="edit_isbn" class="form-control" onkeypress="return isNumber(event)" maxlength="13" onblur="trim(this)" value="{{$bookDetails->isbn}}">
                                    <span id="error_edit_isbn" class="errorMsg"></span>
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
                                <div class="col-sm-12-fluid">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Publisher</label>
                                        <div class="col-lg-8">
                                        <input type="text" class="form-control" name="publisher" id="edit_publisher" value="{{$bookDetails->publisher}}">
                                        <span id="error_edit_publisher" class="errorMsg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12-fluid">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Publication Date (d/m/Y)<b><span class="text-danger">*</span></b></label>
                                        <div class="col-lg-8">
                                            <div class="input-group date">
                                            <?php
                                                $timezone = "Asia/Kolkata";                                      
                                                $publishDate = \BookHelper::ConvertGMTToLocalTimezone($bookDetails->published, $timezone);
                                                $publishedAt = $publishDate->format("d/m/Y");
                                            ?>
                                                <span class="input-group-addon"><i class="fa fa-calendar" id="edit_publication_date_calendar"></i></span><input class="form-control" type="text" name="published" id="edit_publish" value="{{$publishedAt}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12-fluid">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Description</label>
                                        <div class="col-lg-8">
                                            <textarea rows="4" name="description" id="edit_description" class="form-control" onblur="trim(this)">
                                            {{$bookDetails->description}}
                                            </textarea>
                                            <span id="error_description" class="errorMsg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>


<script>

    $("#edit_publication_date").datepicker({
        format: 'dd/mm/yyyy', 
        autoclose: true, 
        todayHighlight: true,
        endDate: "today"
    });
    $('#edit_publication_date_calendar').on('click', function(){
        $('#edit_publication_date').focus();
    });

    $('#edit_new_cover_image').click(function(){
        $('#edit_cover_image').click();
    });

    $(function(){
      $("#edit_cover_image").change(function(){
        var ext = $('#edit_cover_image').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $('#edit_cover_image').val(null);
            $('#error_edit_cover_image').text('Only .jpg, .jpeg, .png image allowed.');
            return false;
        }else{
          $('#error_edit_cover_image').html('');
          var path =  readURL(this, "edit_new_cover_image");
        }
      });
      var imgsrc = $('#edit_new_cover_image').attr('src');
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

   

    $('#editBook').on('click', function(){
        $('#editBookForm').submit();
    });
</script>