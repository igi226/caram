@extends('Admin.Master.master')

@section('title', 'Winners | Caramia')

@section('tagcss')

<style>
    /* video */

    .video {

        width: 100%;

        border: 1px solid black;

    }



    .wrapper {

        display: table;

        width: auto;

        position: relative;

        width: 50%;

    }



    .playpause {

        background-image: url(http://png-4.findicons.com/files/icons/2315/default_icon/256/media_play_pause_resume.png);

        background-repeat: no-repeat;

        width: 50%;

        height: 50%;

        position: absolute;

        left: 0%;

        right: 0%;

        top: 0%;

        bottom: 0%;

        margin: auto;

        background-size: contain;

        background-position: center;

    }



    /*V END  */
</style>



@endsection

@section('content')





<!-- start page title -->

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <h4 class="mb-0">List of all Winners</h4>

        </div>

    </div>

</div>

<!-- end page title -->


<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-body">

                <div class="table-responsive mt-3">

                    <table class="table table-centered datatable nowrap table-sm w-100">

                        <thead class="thead-light">

                            <tr>

                                <th>#</th>

                                <th>Contest Name</th>

                                <th>Video </th>

                                <th>Winner Name</th>
                                <th>Position</th>



                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($winners as $item)
                            <tr>

                                <td scope="row">{{ $loop->iteration }}</td>

                                <td><b>{{ $item->contest_name }}</b></td>






                                <td>{{ $item->v_name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->voting }}</td>






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

@section('msg')
<script>
    @if($msg = session('msg'))
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



            var status = $(this).prop('checked') == true ? 1 : 0;

            var data_id = $(this).attr('data-id');

            // alert(data_id);

            $.ajax({

                type: "GET",

                url: "{{ url('admin/changeVS') }}",

                data: {

                    'v_status': status,

                    'v_slug': data_id,

                    '_token': '{{ csrf_token() }}'

                },

                dataType: "JSON",

                success: function(response) {

                    console.log(response);

                    swal('Successfully Updated');

                    // location.reload();

                }

            });

        })

    })
</script>







@endsection