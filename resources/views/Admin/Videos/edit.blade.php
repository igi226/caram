@extends('Admin.Master.master')

@section('title', 'Videos Edit | Caramia')



@section('content')





    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    @if (Session::has('msg'))

                        <p class="alert alert-info">{{ Session::get('msg') }}</p>

                    @endif



                    <h4 class="card-title"> Edit the Video</h4>

                    <form action="{{ route('video.update', $particular_video->v_slug) }}" method="post"

                        enctype="multipart/form-data">

                        @csrf



                        <div class="row mb-3">

                            <label for="example-text-input" class="col-sm-2 col-form-label"><b>Title:</b></label>

                            <div class="col-sm-10">

                                <input name="v_name" class="form-control" type="text"

                                    placeholder="Enter Video title...." id="example-text-input"

                                    value="{{ $particular_video->v_name }}">

                                @if ($errors->has('v_name'))

                                    <span class="text-danger">{{ $errors->first('v_name') }}</span>

                                @endif

                            </div>

                        </div>







                        {{-- <div class="row mb-3">

                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Video

                                    Description</b></label>

                            <div class="col-sm-10">

                                <textarea name="v_description" id="your_summernote" class="form-control" type="text"

                                    placeholder="Write Something about the video...." id="example-email-input">{{ $particular_video->v_description }}</textarea>

                                @if ($errors->has('v_description'))

                                    <span class="text-danger">{{ $errors->first('v_description') }}</span>

                                @endif

                            </div>

                        </div> --}}

                        <div class="row mb-3">

                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Current Video</b></label>

                            <div class="col-sm-10">

                                @if (isset($particular_video->v_video) &&

                                    !empty($particular_video->v_video && File::exists(public_path('storage/uservideo/' . $particular_video->v_video))))

                                    <div class="video-layer">

                                        <video width="240" height="160">

                                            <source src="{{ asset('storage/uservideo/' . $particular_video->v_video) }}"

                                                type="video/mp4">

                                        </video>

                                        <a href="#" class="videoplaybtn" data-bs-toggle="modal"

                                            data-bs-target="#exampleModal"><i class="fa fa-play"></i></a>

                                    </div> <br>

                                @else

                                    <img height="80" width="100" src="{{ asset('noimg.png') }}"

                                        alt="no-image"><br><br>

                                @endif

                            </div>

                            <div class="row mb-3">

                                <label for="example-text-input" class="col-sm-2 col-form-label"><b>Upload Video:</b></label>

                                <div class="col-sm-10">

                                    <input name="v_video" class="form-control" type="file"

                                        value="{{ $particular_video->v_video }}">

                                    @if ($errors->has('v_video'))

                                        <span class="text-danger">{{ $errors->first('v_video') }}</span>

                                    @endif

                                </div>

                            </div>



                            <div class="row mb-3">



                                <label for="example-email-input" class="col-sm-2 col-form-label"><b>Video Uploaded by</b>

                                </label>

                                <div class="col-sm-10">

                                    <select name="user_id" class="js-example-matcher form-control select2-search-disable">



                                        <option value="{{ $particular_video->user_id }}">{{ $particular_video->name }}

                                        </option>



                                        @foreach ($all_users as $owner)

                                            <option value="{{ $owner->id }}">{{ $owner->name }}</option>

                                        @endforeach





                                    </select>

                                    @if ($errors->has('user_id'))

                                        <span class="text-danger">{{ 'Video Owner name is required' }}</span>

                                    @endif

                                </div>



                            </div>


                            {{-- st --}}
                            
                            <div class="row mb-3">



                                <label for="example-email-input" class="col-sm-2 col-form-label"><b>Choose Contest</b>

                                </label>

                                <div class="col-sm-10">

                                    <select name="contest_id" class="js-example-matcher form-control select2-search-disable">



                                        <option value="{{ $particular_video->contest_id }}">{{ $particular_video->contest_name }}

                                        </option>



                                        @foreach ($all_contests as $contests)

                                            <option value="{{ $contests->id }}">{{ $contests->contest_name }}</option>

                                        @endforeach





                                    </select>

                                    @if ($errors->has('contest_id'))

                                        <span class="text-danger">{{ 'Video contests name is required' }}</span>

                                    @endif

                                </div>



                            </div>
                            {{-- nd --}}



                            {{-- <div class="row mb-3">



                                <label for="example-email-input" class="col-sm-2 col-form-label"><b>Status</b> </label>

                                <div class="col-sm-10">

                                    <select name="v_status" class="form-control select2-search-disable">



                                        <option>Select</option>



                                        <option value="1" @if ($particular_video->v_status == 1) selected @endif>Active

                                        </option>



                                        <option value="0" @if ($particular_video->v_status == 0) selected @endif>Inactive

                                        </option>



                                    </select>

                                </div>



                            </div>



                            <div class="row mb-3">

                                <label for="example-text-input" class="col-sm-2 col-form-label"><b>Tags</b></label>

                                <div class="col-sm-10">

                                    {{-- <input type="text" name="v_tag" class="form-control" data-role="tagsinput"> --}}

                                  {{--  <input type="text" class="form-control" name="v_tag" data-role="tagsinput"

                                        placeholder="Add tags" value="{{ $particular_video->v_tag }}" />

                                    @if ($errors->has('v_tag'))

                                        <span class="text-danger">{{ $errors->first('v_tag') }}</span>

                                    @endif

                                </div>

                            </div> --}}





                            <div class="text-center">

                                <button class="btn btn-primary" type="submit">Upload</button>

                                <a href="{{ url('admin/videos') }}" class="btn btn-primary" type="submit">Cancel</a>



                            </div>

                    </form>

                </div>

            </div>

        </div> <!-- end col -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">



                    <div class="modal-body">



                        <video width="100%" height="100%" controls>

                            <source src="{{ asset('storage/uservideo/' . $particular_video->v_video) }}"

                                type="video/mp4">

                        </video>





                    </div>



                </div>

            </div>

        </div>

    </div>

    <!-- end row -->



@endsection

@section('select2')



    <script>

        function matchCustom(params, data) {



            if ($.trim(params.term) === '') {

                return data;

            }



            if (typeof data.text === 'undefined') {

                return null;

            }



            if (data.text.indexOf(params.term) > -1) {

                var modifiedData = $.extend({}, data, true);

                modifiedData.text += ' (matched)';



                return modifiedData;

            }



            return null;

        }

        $(".js-example-matcher").select2({

            matcher: matchCustom

        });

    </script>

@endsection

