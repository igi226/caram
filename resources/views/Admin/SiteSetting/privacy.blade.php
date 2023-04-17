@extends('Admin.Master.master')
@section('title', 'Privacy | Caramia')
@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif

                    <h4 class="card-title">Edit privacy</h4>
                    <form action="{{ route('privacy.Update') }}" method="post">
                        @csrf






                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Privacy</b></label>
                            <div class="col-sm-10">
                                @if ($privacy->privacy != null && !empty($privacy->privacy))

                                    <textarea name="privacy" id="your_summernote" class="form-control" rows="40">{{ $privacy->privacy }}</textarea>
                                @else
                                    <textarea name="privacy" id="your_summernote" class="form-control" rows="40">No privacy</textarea>
                                @endif
                                @if ($errors->has('privacy'))
                                    <span class="text-danger">{{ $errors->first('privacy') }}</span>
                                @endif
                            </div>
                        </div>






                        <div class="text-center">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ url('admin/dashboard') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
