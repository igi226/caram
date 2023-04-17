@extends('Admin.Master.master')
@section('title', 'Terms | Caramia')
@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif

                    <h4 class="card-title">Edit Terms</h4>
                    <form action="{{ route('terms.Update') }}" method="post">
                        @csrf






                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label"><b>Terms & Condition</b></label>
                            <div class="col-sm-10">
                                @if ($termsCond->terms != null && !empty($termsCond->terms))

                                    <textarea name="terms" id="your_summernote" class="form-control" rows="40">{{ $termsCond->terms }}</textarea>
                                @else
                                    <textarea name="terms" id="your_summernote" class="form-control" rows="40">No Terms & Conditions</textarea>
                                @endif
                                @if ($errors->has('terms'))
                                    <span class="text-danger">{{ $errors->first('terms') }}</span>
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
