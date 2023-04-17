@extends('Admin.Master.master')

@section('title', 'Users | Caramia')

@section('content')





    <!-- start page title -->

    <div class="row">

        <div class="col-12">

            <div class="page-title-box d-flex align-items-center justify-content-between">

                <h4 class="mb-0">List of all Users</h4>







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
                                    <th>Name</th>
                                    <th>Family name</th>
                                    <th>Email</th>
                                    <th>Date of birth</th>
                                    {{-- <th>Image</th> --}}
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($users_all as $item)

                                    <tr>

                                        <td scope="row">{{ $loop->iteration }}</td>

                                        <td>{{ $item->title }}</td>

                                        <td>{{ $item->name }}</td>

                                        <td>{{ $item->family_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->dob }}</td>



                                        {{-- @if (isset($item->image) &&

                                            !empty($item->image && File::exists(public_path('storage/UserImage/' . $item->image))))

                                            <td><img height="80" width="100"

                                                    src="{{ asset('/storage/UserImage/' . $item->image) }}" alt="">

                                            </td>

                                        @else

                                            <td><img height="80" width="100" src="{{ asset('noimg.png') }}"

                                                    alt="no-image"> </td>

                                        @endif --}}



                                        <td id="tooltip-container1">

                                            <a href="{{ route('user.edit', $item->slug) }}" class="me-3 text-primary"

                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i

                                                    class="mdi mdi-pencil font-size-18"></i></a>

                                            <a href="{{ url('admin/view-user', $item->slug) }}" class="me-3 text-success"

                                                data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i

                                                    class="fa fa-eye font-size-18" style="font-size: 20px"></i></a>

                                            <form method="POST" action="{{ route('deleteUser', $item->slug) }}"

                                                class="action-icon">

                                                @csrf

                                                <input name="_method" type="hidden" value="DELETE">

                                                <button type="submit" class="delete-icon show_confirm"

                                                    data-toggle="tooltip" title='Delete'>

                                                    <i class="fa fa-trash-o font-size-18 text-danger"></i>

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>



                    </div>



                </div>

                {{--  --}}



            </div>

        </div>

    </div>

    {{-- <style>

        .table-sm td,

        .table-sm th {

            font-size: 13px;

        }

    </style> --}}

@endsection



@section('status')







    <script>

        $(document).ready(function() {

            $("#tb"), DataTable()

        });

        $(function() {

            $('.changeS').change(function() {



                var status = $(this).prop('checked') == true ? 1 : 0;

                var data_id = $(this).attr('data-id');

                // var data_id = $(this).data('testiidmonial_id');

                //alert(data_id);

                $.ajax({

                    type: "GET",

                    url: "{{ url('admin/changeS') }}",

                    data: {

                        'status': status,

                        'slug': data_id,

                        '_token': '{{ csrf_token() }}'

                    },

                    dataType: "JSON",

                    success: function(response) {

                        console.log(response);

                        alert('Successfully Updated');

                        location.reload();

                    }

                });

            })

        })

    </script>







@endsection

