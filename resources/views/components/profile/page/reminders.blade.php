<div class="mb-3">
    <h5 class="card-title text-decoration-underline mb-3">@lang('translation.reminders'):</h5>
    <form method="post" action="{{route('profile')}}" method="post">
        @csrf
        <input type="hidden" name="form_type" value="reminders_form"/>
        <ul class="list-unstyled mb-0">
            <li class="d-flex">
                <div class="flex-grow-1">
                    <label for="enable-reminders"
                           class="form-check-label fs-14">@lang('translation.enable_reminder')</label>
                    <p class="text-muted">@lang('translation.if_enable')</p>
                </div>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="enable-reminders"
                               name="enable_reminders" value="on" {{(auth()->user()['enable_reminders']==1)?'checked':''}}/>
                    </div>
                </div>
            </li>
            <li class="d-flex mt-2">
                <div class="flex-grow-1">
                    <label class="form-check-label fs-14" for="desktopNotification">@lang('translation.notify_days')
                    </label>
                    <input type="numbers" min="1" name="notify_before" class="form-control" value="{{auth()->user()['notify_before']}}"/>
                </div>
            </li>
            <li class="d-flex mt-2">
                <div class="flex-grow-1">
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-primary">@lang('translation.submit')</button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </form>
</div>