@extends('Admin.Master.master')

@section('title', 'Videos Add | Caramia')


@section('progressbar')

@endsection
@section('content')





    <div class="row">

        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    @if (Session::has('msg'))

                        <p class="alert alert-info">{{ Session::get('msg') }}</p>

                    @endif



                    <h4 class="card-title">Create New Video</h4>

                    <form action="{{ route('video.store') }}" method="post" enctype="multipart/form-data">

                        @csrf



                        <div class="row mb-3">

                            <label for="example-text-input" class="col-sm-2 col-form-label"><b>Title:</b></label>

                            <div class="col-sm-10">

                                <input name="v_name" class="form-control" type="text"

                                    placeholder="Enter Video title...." id="example-text-input" value="{{ old('v_name') }}">

                                @if ($errors->has('v_name'))

                                    <span class="text-danger">{{ "Name is required" }}</span>

                                @endif

                            </div>

                        </div>







                        {{-- <div class="row mb-3">

                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Video

                                    Description</b></label>

                            <div class="col-sm-10">

                                <textarea name="v_description" id="your_summernote" class="form-control" type="text"

                                    id="example-email-input"

                                    >{{ old('v_description') }}</textarea>

                                @if ($errors->has('v_description'))

                                    <span class="text-danger">{{ $errors->first('v_description') }}</span>

                                @endif

                            </div>

                        </div> --}}





                        <div class="row mb-3">

                            <label for="example-text-input" class="col-sm-2 col-form-label"><b>Upload Video:</b></label>

                            <div class="col-sm-10">

                                <input name="v_video" class="form-control" type="file" value="{{ old('v_video') }}">
                               
                                @if ($errors->has('v_video'))

                                    <span class="text-danger">{{ "Video is required" }}</span>

                                @endif

                            </div>

                        </div>



                        <div class="row mb-3">



                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Video Uploaded by</b> </label>

                            <div class="col-sm-10">

                                



                                <select class="js-example-matcher form-control select2-search-disable" name="user_id">

                                    <option value="">Select</option>

                                    @foreach($all_users as $owner)

                                    <option value="{{ $owner->id }}">{{ $owner->name .'-  '. $owner->email}}</option>

                                    @endforeach

                                </select>

                                 @if ($errors->has('user_id'))

                                    <span class="text-danger">{{ 'Video Owner name is required' }}</span>

                                @endif

                            </div>



                        </div>

                        {{-- stast --}}
                        <div class="row mb-3">

                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Choose Contest</b> </label>
                            <div class="col-sm-10">
                                

                                <select class="js-example-matcher form-control select2-search-disable" name="contest_id">
                                    <option value="">Select Contest</option>
                                    @foreach($contests as $contest)
                                    <option value="{{ $contest->id }}">{{ $contest->contest_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('contest_id'))
                                    <span class="text-danger">{{ 'Video contest name is required' }}</span>
                                @endif
                            </div>

                        </div>
                        {{-- end --}}

                        {{-- <div class="row mb-3">



                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Status</b> </label>

                            <div class="col-sm-10">

                                <select name="v_status" class="form-control select2-search-disable">



                                    <option value="1">Select</option>



                                    <option value="1">Active</option>



                                    <option value="0">Inactive</option>



                                </select>

                            </div>



                        </div>



                        <div class="row mb-3">

                            <label for="example-text-input" class="col-sm-2 col-form-label"><b>Tags</b></label>

                            <div class="col-sm-10">

                               <input type="text" name="v_tag"  data-role="tagsinput" class="form-control" />

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

    </div>

    <!-- end row -->

@endsection
@section('progressbar')

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



