@extends('layouts.master')
@section('title') @lang('translation.calendar') @endsection
@section('css')
    <style>
        .bg-lawngreen{background-color:lawngreen;}
        .bg-red{background-color:#ff0000b8;}
        .bg-yellow{background-color:yellow;}

    </style>
<link href="{{ URL::asset('build/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Apps @endslot
@slot('title') Calendar @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        @include('layouts.common.display_error')
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0">Events</h5>
                <div style="flex: 1 1 auto" class="d-flex justify-content-end">
                    <a type="button" class="btn btn-primary" href="{{route('createReminder')}}">Create New Event</a>

                </div>
            </div>
        </div>
        <table id="policy-list" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
            <thead>
                <th>#</th>
                <th>Type</th>
                <th>Motivo</th>
                <th>Fecha de vencimiento</th>
                <th>Status</th>
                <th>Nombre del propietario</th>
                <th>Action</th>
            </thead>
            <tbody>
            @php $i = 1;
            $rand_arr = ['badge badge-outline-primary','badge badge-outline-secondary','badge badge-outline-success','badge badge-outline-info','badge badge-outline-dark'];
                        $year_arr = ["badge rounded-pill text-primary  bg-primary-subtle","badge rounded-pill text-secondary  bg-secondary-subtle",
                                    "badge rounded-pill text-success  bg-success-subtle",
                                    "badge rounded-pill text-info  bg-info-subtle",
                                    "badge rounded-pill text-dark  bg-dark-subtle"];
                        $colors_arr = ["badge text-primary bg-primary-subtle badge-border",
                                        "badge text-info bg-info-subtle badge-border",
                                        "badge text-warning bg-warning-subtle badge-border",
                                        "badge text-success bg-success-subtle badge-border",
                                        "badge text-secondary bg-secondary-subtle badge-border",
                                        "badge text-dark bg-dark-subtle badge-border"];
            @endphp
            @if(count($policies)>0)
                @foreach($policies as $pk=>$pv)
                    <tr>
                        <td>{{$i}}</td>
                        <td>Policies</td>
                        <td>
                            <span class="{{$year_arr[array_rand($year_arr)]}}">{{$pv->number}}</span>
                        </td>
                        <td>
                            <span class="{{$rand_arr[array_rand($rand_arr)]}}">{{ date('F j, Y', strtotime($pv->policy_expiration)) }}</span>
                        </td>
                        @php $status = ""; $today = strtotime(date('d-m-y')); @endphp
                        @if($today == strtotime($pv->policy_expiration))
                            @php $status = '<span class="badge rounded-pill text-black  bg-yellow">'.ucwords("por vencer").'</span>'; @endphp
                        @elseif($today < strtotime($pv->policy_expiration))
                            @php $status = '<span class="badge rounded-pill text-black  bg-lawngreen">'.ucwords("vigente").'</span>'; @endphp
                        @elseif($today > strtotime($pv->policy_expiration))
                            @php $status = '<span class="badge rounded-pill text-black  bg-red">'.ucwords("vencido").'</span>'; @endphp
                        @endif
                        <td>{!! $status !!}</td>
                        <td>
                            <a style="cursor:pointer;" class="text-decoration-underline">
                            {{(!is_null($pv->insuranceCompany))?$pv->insuranceCompany['name']:'N/A'}}
                            </a>
                        </td>
                        <td>
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-fill align-middle"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li onclick="get_policy_details({{$pv->id}})" data-id="">
                                        <a  data-id="{{$pv->id}}" class="dropdown-item cursor-pointer">
                                            <i class="bi-eye align-bottom me-2 text-muted"></i>
                                            View Detail
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                @endforeach
            @endif
            @if(count($vehicles)>0)
                @foreach($vehicles as $vk=>$vv)
                    <tr>
                        <td>{{$i}}</td>
                        <td>Vehicle</td>
                        <td>
                            <span class="{{$year_arr[array_rand($year_arr)]}}">{{$vv->car_plate}}</span>
                        </td>
                        <td>
                            <span class="{{$rand_arr[array_rand($rand_arr)]}}">{{ date('F j, Y', strtotime($vv->due_date)) }}</span>
                        </td>
                        <td>
                           @if($vv->status=='vigente')
                            <span class="badge rounded-pill text-black  bg-lawngreen">{{ucwords($vv->status)}}</span>
                           @endif
                               @if($vv->status=='por vencer')
                                   <span class="badge rounded-pill text-black  bg-yellow">{{ucwords($vv->status)}}</span>
                               @endif
                               @if($vv->status=='vencido')
                                   <span class="badge rounded-pill text-black  bg-red">{{ucwords($vv->status)}}</span>
                               @endif
                        </td>
                        <td>
                            <a style="cursor:pointer;" class="text-decoration-underline">
                                {{(!is_null($vv->company))?$vv->company['name']:'N/A'}}
                            </a>
                        </td>
                        <td>
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-fill align-middle"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li onclick="get_car_details({{$vv->id}})" data-id="">
                                        <a  data-id="{{$vv->id}}" class="dropdown-item cursor-pointer">
                                            <i class="bi-eye align-bottom me-2 text-muted"></i>
                                            View Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('listGloveBox', $vv->id) }}" class="dropdown-item edit-item-btn cursor-pointer">
                                            <i class="bi-folder-fill align-bottom me-2 text-muted"></i>
                                            Guantera
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @php $i++; @endphp
                @endforeach
            @endif
            @if(count($events)>0)
                @foreach($events as $ek=>$ev)
                    <tr>
                        <td>{{$i}}</td>
                        <td>Events</td>
                        <td>
                            <span class="{{$colors_arr[array_rand($colors_arr)]}}">{{$ev->title}}</span>
                        </td>
                        <td>
                            <span class="{{$rand_arr[array_rand($rand_arr)]}}">{{ date('F j, Y', strtotime($ev->end)) }}</span>
                        </td>
                        @php $status = ""; $today = strtotime(date('d-m-y')); @endphp
                        @if(strtotime($ev->end)==$today)
                            @php $status = '<span class="badge rounded-pill text-black  bg-yellow">'.ucwords("por vencer").'</span>'; @endphp
                        @elseif(strtotime($ev->end)<$today)
                            @php $status = '<span class="badge rounded-pill text-black  bg-lawngreen">'.ucwords("vigente").'</span>'; @endphp
                        @elseif(strtotime($ev->end)>$today)
                            @php $status = '<span class="badge rounded-pill text-black  bg-red">'.ucwords("vencido").'</span>'; @endphp
                        @endif
                        <td>{!! $status !!}</td>
                        <td>
                            <a style="cursor:pointer;" class="text-decoration-underline">
                                {{(!is_null($ev->company)?$ev->company['name']:"N/A")}}
                            </a>
                        </td>
                        <td>
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-fill align-middle"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="{{route('editCustomEvents',$ev->id)}}"  data-id="{{$ev->id}}"  class="dropdown-item edit-reminder-btn cursor-pointer">
                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                            @lang('translation.edit')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @php $i++; @endphp
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="modal-title">Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form class="needs-validation"  name="event-form" id="form-event" validate>
                    <div class="text-end">
                        <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn" data-id="edit-event" onclick="editEvent(this)" role="button">Edit</a>
                    </div>
                    <div class="event-details">
                        <div class="d-flex mb-2">
                            <div class="flex-grow-1 d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <i class="ri-calendar-event-line text-muted fs-16"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="d-block fw-semibold mb-0" id="event-start-date-tag"></h6>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0 me-3">
                                <i class="ri-time-line text-muted fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="d-block fw-semibold mb-0"><span id="event-timepicker1-tag"></span> - <span id="event-timepicker2-tag"></span></h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0 me-3">
                                <i class="ri-map-pin-line text-muted fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="d-block fw-semibold mb-0"> <span id="event-location-tag"></span></h6>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 me-3">
                                <i class="ri-discuss-line text-muted fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="d-block text-muted mb-0" id="event-description-tag"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row event-form">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select class="form-select d-none" name="category" id="event-category" required>
                                    <option value="bg-danger-subtle">Danger</option>
                                    <option value="bg-success-subtle">Success</option>
                                    <option value="bg-primary-subtle">Primary</option>
                                    <option value="bg-info-subtle">Info</option>
                                    <option value="bg-dark-subtle">Dark</option>
                                    <option value="bg-warning-subtle">Warning</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid event category</div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Event Name</label>
                                <input class="form-control d-none" placeholder="Enter event name" type="text" name="title" id="event-title" required value="" />
                                <div class="invalid-feedback">Please provide a valid event name</div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Event Date</label>
                                <div class="input-group d-none">
                                    <input type="text" id="event-start-date" class="form-control flatpickr flatpickr-input" placeholder="Select date" readonly required>
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12" id="event-time">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Start Time</label>
                                        <div class="input-group d-none">
                                            <input id="timepicker1" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select start time" readonly>
                                            <span class="input-group-text"><i class="ri-time-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">End Time</label>
                                        <div class="input-group d-none">
                                            <input id="timepicker2" type="text" class="form-control flatpickr flatpickr-input" placeholder="Select end time" readonly>
                                            <span class="input-group-text"><i class="ri-time-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="event-location" class="form-label">Location</label>
                                <div>
                                    <input type="text" class="form-control d-none" name="event-location" id="event-location" placeholder="Event location">
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <input type="hidden" id="eventid" name="eventid" value="" />
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control d-none" id="event-description" placeholder="Enter a description" rows="3" spellcheck="false"></textarea>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-soft-danger" id="btn-delete-event"><i class="ri-close-line align-bottom"></i> Delete</button>
                        <button type="submit" class="btn btn-success" id="btn-save-event">Add Event</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal-content-->
    </div>
</div>
<div class="modal fade" id="viewCarDetailModel" tabindex="-1" aria-hidden="true" data-bs-config="backdrop:true">
</div>
@endsection

@section('script')
    <script>

        function get_car_details(id){
            $.ajax({
                url:'{{route('get_car_details')}}',
                type:'post',
                data:{'_token':'{{csrf_token()}}','id':id},
                dataType:'html',
                success:function (res) {
                    $('#viewCarDetailModel').html(res);
                    $('#viewCarDetailModel').modal('show');
                }
            });
        }
        function get_policy_details(id){
            $.ajax({
                url:'{{route('get_policy_details')}}',
                type:'post',
                data:{'_token':'{{csrf_token()}}','id':id},
                dataType:'html',
                success:function (res) {
                    $('#viewCarDetailModel').html(res);
                    $('#viewCarDetailModel').modal('show');
                }
            });
        }
        $('#policy-list').DataTable({
            order: [[0, 'desc']],
            language: {
                emptyTable: "No hay datos disponibles en la tabla",
            }
        });

        var postCustomEvent = "{{route('postCustomEvents')}}";
        var deleteCustomEvent = "{{route('deleteCustomEvent')}}";
        function postData(obj){
            $.ajax({
                url:postCustomEvent,
                data:{"_token":"{{csrf_token()}}",'data':obj},
                type:"post",
                dataType:"json",
                success:function(res){
                    window.location.url = '{{route('customEvents')}}';
                }
            });
        }
        function deleteData(obj){
            $.ajax({
                url:deleteCustomEvent,
                data:{"_token":"{{csrf_token()}}",'data':obj},
                type:"post",
                dataType:"json",
                success:function(res){
                    console.log(res);
                }
            });
        }
    </script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection