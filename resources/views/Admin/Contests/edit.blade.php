


@extends('Admin.Master.master')
@section('title', 'Contests-Edit | Caramia')
@section('content')
    

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
                @endif
          
                <h4 class="card-title">Edit The Contests</h4>
                <form action="{{ route('contests.update', $particular_contest->slug) }}" method="post">
                    @csrf 
                    {{-- @method('PUT') --}}
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"><b>Name:</b></label>
                        <div class="col-sm-10">
                            <input name="contest_name" class="form-control" type="text" placeholder="Enter contest name...." id="example-text-input" value="{{ $particular_contest->contest_name }}">
                            @if ($errors->has('contest_name'))
                                <span class="text-danger">{{ $errors->first('contest_name') }}</span>
                            @endif
                        </div>
                    </div>

                    
            
                <div class="row mb-3">
                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Description</b></label>
                    <div class="col-sm-10">
                        <textarea name="contest_description" id="your_summernote" class="form-control" type="text" placeholder="Enter contest description...." id="example-contest_description-input" >{{ $particular_contest->contest_description }}</textarea>
                        @if ($errors->has('contest_description'))
                            <span class="text-danger">{{ $errors->first('contest_description') }}</span>
                        @endif
                    </div>
                </div>

                <!-- <div class="row mb-3">
                    <label for="example-email-input" class="col-sm-2 col-form-label"><b>Venue</b></label>
                    <div class="col-sm-10">
                        <input name="contest_venue" class="form-control" type="text" placeholder="Enter  contest venue" id="example-email-input" value="{{ $particular_contest->contest_venue }}">
                        @if ($errors->has('contest_venue'))
                            <span class="text-danger">{{ $errors->first('contest_venue') }}</span>
                        @endif
                    </div>
                </div> -->

                <div class="row mb-3">
                    <label for="example-tel-input" class="col-sm-2 col-form-label"><b>Competition Start Date</b></label>
                    <div class="col-sm-10">
                        <input name="contest_start_dt" class="form-control" type="date" value="{{ $particular_contest->contest_start_dt }}">
                        @if ($errors->has('contest_start_dt'))
                            <span class="text-danger">{{ $errors->first('contest_start_dt') }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-tel-input" class="col-sm-2 col-form-label"><b>Competition End Date</b></label>
                    <div class="col-sm-10">
                        <input name="end_dt" class="form-control" type="date" value="{{ $particular_contest->end_dt }}">
                        @if ($errors->has('end_dt'))
                            <span class="text-danger">{{ $errors->first('end_dt') }}</span>
                        @endif
                    </div>
                </div>

               

                    <div class="row mb-3">

                        <label for="example-email-input" class="col-sm-2 col-form-label"><b>Status</b> </label>
                        <div class="col-sm-10">
                            <select name="contest_status" class="form-control select2-search-disable">
    
                                <option value="1">Select</option>
    
                                <option value="1" @if($particular_contest->contest_status == 1) selected @endif>Active</option>
    
                                <option value="0" @if($particular_contest->contest_status == 0) selected @endif>Inactive</option>
    
                            </select>
                        </div>
    
                    </div>
                  
                
                
                <div class="text-center">
                    <button class="btn btn-primary"  type="submit">Update</button>
                    <a href="{{ url('admin/contests') }}" class="btn btn-danger"  type="submit">Cancel</a>
                    
                </div>
            </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection