@extends('layouts.master')
@section('title')
@lang('translation.settings')
@endsection
<style>
    .ui-draggable, .ui-droppable {
        background-position: top;
    }
</style>
@section('content')
<div class="row">
    <div class="col-lg-10">
        @include('layouts.common.display_error')
        <div class="card overflow-hidden profile-setting-img">
            <div class="card-header">
                <h5>Create New Event</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('postCustomEvents')}}">
                    @csrf
                    <div class="form-group">
                        <label>Event Title</label>
                        <input type="text" class="form-control" name="title" value="{{old('title','')}}"/>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="datetime" class="form-control datetime" name="start" value="{{old('start','')}}"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="datetime" class="form-control enddatetime" name="end" value="{{old('end','')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Start Time</label>
                                <input type="time" class="form-control" name="start_time" value="{{old('start','')}}"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" class="form-control" name="end_time" value="{{old('end','')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Company</label>
                                <select class="form-control" name="company_id">
                                    @if(count($companies)>0)
                                        @foreach($companies as $k=>$v)
                                            <option value="{{$v->id}}">{{$v->name}} [{{$v->identification_card}}]</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" class="form-control" name="location" value="{{old('location','')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input type="submit" class="pull-right mt-3 btn btn-primary" value="@lang('translation.submit')"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $('.datetime').datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: -1,
    });
    $('.enddatetime').datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: -1,
    });
</script>
@endsection
