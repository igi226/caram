@extends('Admin.Master.master')

@section('title', 'Contests | Caramia')

@section('content')







    <div class="row">

        <div class="col-12">

            <div class="page-title-box d-flex align-items-center justify-content-between">

                <h4 class="mb-0">List of Contests</h4>
            </div>

        </div>

    </div>



    <div class="row">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">

                    <div class="table-responsive mt-3">

                        <table class="table table-centered datatable nowrap table-sm w-100">

                            <thead class="thead-light">

                                <tr>

                                    <th>#</th>

                                    <th>Name</th>

                                    <th>Description</th>




                                    <th>Start Date</th>
                                    <th>End Date</th>

                                    <th>Status</th>

                                    <th>Action</th>



                                </tr>

                            </thead>

                            <tbody>
                                <?php $i=1;?> 
                                 @foreach ($contests as  $item)
                                 
                                    <tr>

                                        <td >{{ $i }}</td>

                                        <td>{{ $item->contest_name }}</td>

                                        
                                        {{-- <td>{{ implode(' ', array_slice(str_word_count($item->contest_description , 2), 0, 5))}}</td> --}}
                                        <td><?php echo html_entity_decode($item->contest_description );?></td>
                                        
                                        <td>{{ $item->contest_start_dt }}</td>

                                        <td>{{ $item->end_dt }}</td>

                                        <td>
                                            <label class="switch">

                                                <input class="changeS" type="checkbox" data-id="{{ $item->slug }}"
                                                    {{ $item->contest_status == 1 ? 'checked' : '' }}>

                                                <span class="slider round"></span>

                                            </label>

                                        </td>



                                        <td id="tooltip-container1">

                                            <a href="{{ url('admin/edit-contests', $item->slug) }}"
                                                class="me-3 text-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>

                                            <a href="{{ url('admin/view-contest', $item->slug) }}" class="me-3 text-success" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="View"><i class="fa fa-eye font-size-18"
                                                    style="font-size: 20px"></i></a>

                                            <form method="POST" action="{{ route('deletecontest', $item->slug) }}" class="action-icon">

                                                @csrf

                                                <input name="_method" type="hidden" value="DELETE">

                                                <button type="submit" class="delete-icon show_confirm"
                                                    data-toggle="tooltip" title='Delete'>

                                                    <i class="fa fa-trash-o font-size-18 text-danger"></i>

                                                </button>

                                            </form>

                                        </td>

                                    </tr>
                                    <?php $i++;?>
                                @endforeach

                            </tbody>

                        </table>



                    </div>



                </div>





            </div>

        </div>

    </div>



@endsection

@section('msg')
    <script>
        @if ($msg = session('msg'))
            swal("{{ $msg }}");
        @endif
    </script>
@endsection

@section('status')







    <script>
        $(document).ready(function() {

            $("#tb"), DataTable()

        });

        $(function() {

            $('.changeS').change(function() {
                var contest_status = $(this).prop('checked') == true ? 1 : 0;

                var data_id = $(this).attr('data-id');

                //alert(status);
                 $.ajax({

                    type: "GET",

                    url: "{{ url('admin/changeCS') }}",

                    data: {

                        'contest_status': contest_status,

                        'slug': data_id,

                        '_token': '{{ csrf_token() }}'

                    },

                    dataType: "JSON",

                    success: function(response) {

                        // location.reload();

                        swal('Successfully Updated');

                       

                    }

                });

            })

        })
    </script>







@endsection
