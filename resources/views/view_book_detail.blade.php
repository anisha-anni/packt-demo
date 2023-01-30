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
                                    @if($bookDetails->image!= '' || $bookDetails->image != null)
                                    <img class="img-circle rounded-circle img-fluid" src="{{url($bookDetails->image)}}" onerror="this.src='{{ url("/public/assets/images/book_thumbnail.png") }}'" style="width: 110px; height: 110px; object-fit: cover!important;">
                                    @else
                                    <img class="img-circle rounded-circle img-fluid" src="{{url('public/assets/images/book_thumbnail.png')}}" style="width: 110px; height: 110px; object-fit: cover!important;">
                                    @endif
                                </div>
                                </div>
                                </centre>
                            </div>
                            <div class="col-sm-9" style="padding:0px;">
                                <div class="row-fluid">
                                    <div class="col-sm-12-fluid mt-3">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Title <b></b></label>
                                            <div class="col-lg-8">
                                            <input type="text" id="title" class="form-control" readonly value="{{$bookDetails->title}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12-fluid mt-2">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Author <b></b></label>
                                            <div class="col-lg-8">
                                                <input type="text" id="author" class="form-control" readonly value="{{$bookDetails->author}}">
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-12-fluid mt-1">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Genre</label>
                                    <div class="col-lg-9">
                                    <input type="text" class="form-control" readonly value="{{$bookDetails->genre}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12-fluid mt-1">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">ISBN</label>
                                    <div class="col-lg-9">
                                    <input type="text" class="form-control" readonly value="{{$bookDetails->isbn}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12-fluid mt-1">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Created At (d/m/Y)</label>
                                    <div class="col-lg-9">
                                        <div class="input-group date">
                                            <?php
                                                $timezone = "Asia/Kolkata";
                                                $createdDate = $bookDetails->created_at;                                            
                                                $createdDate = \BookHelper::ConvertGMTToLocalTimezone($bookDetails->created_at, $timezone);
                                                $createdAt = $createdDate->format("d/m/Y");
                                            ?>
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" type="text" readonly value="{{$createdAt}}">
                                        </div>
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
                            <div class="row-fluid" style="min-height: 308px;">
                                <div class="col-sm-12-fluid">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Publisher</label>
                                        <div class="col-lg-8">
                                        <input type="text" class="form-control" value="{{$bookDetails->publisher}}" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12-fluid">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Publication Date (d/m/Y)</label>
                                        <div class="col-lg-8">
                                        <div class="input-group date">
                                        <?php
                                            $timezone = "Asia/Kolkata";                                        
                                            $publisDate = \BookHelper::ConvertGMTToLocalTimezone($bookDetails->published, $timezone);
                                            $publishedOn = $publisDate->format("d/m/Y");
                                        ?>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input class="form-control" type="text" readonly value="{{$publishedOn}}">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-12-fluid">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Description</label>
                                        <div class="col-lg-8">
                                        <textarea rows="4" class="form-control" readonly style="width:100%;">{{$bookDetails->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>