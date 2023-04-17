@extends('User.Master.main')
@section('content')
<section>
   <div class="top-banner-caramia">
      <div class="top_banner-bg">
         <h2>WINNERS</h2>
      </div>
   </div>
</section>
<section>
   <div class="container mt-5">
      <div class="caramia_winners_text">
         <p>Caramia Media Contest was created to find the best and most inspiring tango teachers from around the world. We are very pleased to announce the winners of the contest!</p>
         <p>Congratulations to all of the winners! We are sure that your passion and dedication for teaching tango will inspire many people around the world.</p>
      </div>
      <div class="winners-content">
         @php
         $contests = DB::table('contests')->where('end_dt', '>=', now())->get();
         @endphp
         <div class="row">
            <div class="col-lg-4 col-md-4">
               <ul class="nav nav-pills mb-3 winners-tabs" id="pills-tab" role="tablist">
                  @foreach ($contests as $item)
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="tango-teacher-tab" data-bs-toggle="pill" data-bs-target="#{{ $item->slug }}" type="button" role="tab" aria-controls="tango-teacher" aria-selected="true">Tango {{ " ".$item->contest_name }}</button>
                  </li>
                  @endforeach
               </ul>
            </div>
            <div class="col-lg-8 col-md-8">
               <div class="tab-content" id="pills-tabContent">
                  @foreach ($contests as $tabCon)
                
                  <div class="tab-pane fade show active" id="{{ $tabCon->slug }}" role="tabpanel" aria-labelledby="tango-teacher-tab" tabindex="0">
                     <div class="row">
                        @foreach ($winners as $winner)
                        @if ($winner->contest_id == $tabCon->id)
                        <div class="col-lg-4 col-md-4 mb-5">
                           <div class="media-activity">
                              <div class="activity-top">
                                 @if (isset($winner->image) && !empty($winner->image && File::exists(public_path('storage/UserImage/' . $winner->image))))
                                 <td><img height="100" width="80"
                                    src="{{ asset('/storage/UserImage/' . $winner->image) }}" alt="">
                                 </td>
                                 @else
                                 <td><img height="80" width="100" src="{{ asset('noimg.png') }}"
                                    alt="no-image"> </td>
                                 @endif
                              </div>
                              <div class="activity-content winners-activity">
                                 Name:{{ " ".$winner->name }} <br>
                                 Rank:{{ ' '.$winner->v_voting}}
                              </div>
                           </div>
                        </div>
                        @endif
                        @endforeach
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection