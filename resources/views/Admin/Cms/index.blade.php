@extends('Admin.Master.master')
@section('title', 'Cms | Caramia')
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box d-flex align-items-center justify-content-between">
         <h4 class="mb-0">List of all Cms</h4>
      </div>
   </div>
</div>
<!-- end page title -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            @if (Session::has('msg'))
            <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif
            <div class="table-responsive mt-3">
               <table class="table table-centered datatable nowrap table-sm w-100">
                  <thead class="thead-light">
                     <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Short Description</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($cms as $item)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->short_desc }}</td>
                        <td>{{ implode(' ', array_slice(str_word_count(htmlspecialchars(trim(strip_tags($item->description))), 2), 0, 10)) }}
                        </td>
                        <td>
                           @if (isset($item->image) && !empty($item->image) && File::exists(public_path('storage/CmsImage/' . $item->image)))
                           <img height="80" width="100" src="{{ asset('storage/CmsImage/' . $item->image) }}"
                              alt="">
                           @else
                           <img height="80" width="100" src="{{ asset('noimg.png') }}" alt="no-p_image">
                           @endif
                        </td>
                        <td id="tooltip-container1">
                           <a href="{{ route('cms.edit', $item->slug) }}" class="me-3 text-primary"
                              data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                              class="mdi mdi-pencil font-size-18"></i></a>
                           <a href="{{ route('cms.show', $item->slug) }}" class="me-3 text-success"
                              data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i
                              class="fa fa-eye font-size-18" style="font-size: 20px"></i></a>
                           
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

@endsection
