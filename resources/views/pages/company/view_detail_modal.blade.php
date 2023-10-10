<div class="modal-dialog modal-xl">
    <div class="modal-content border-0">
        <div class="modal-header p-4 pb-0">
            <h5 class="modal-title" id="createMemberLabel">View Company Info</h5>
            <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>#</th>
                            <td>{{$company['id']}}</td>
                            <th>RUC</th>
                            <td>{{$company['identification_card']}}</td>
                        </tr>
                        <tr>
                            <th>@lang('translation.name')</th>
                            <td>{{$company['name']}}</td>
                            <th>DV</th>
                            <td>{{$company['dv']}}</td>
                        </tr>
                        <tr>
                            <th>@lang('translation.province')</th>
                            <td>{{$company['province']['name']}}</td>
                            <th>@lang('translation.district')</th>
                            <td>{{$company['distric']['name']}}</td>
                        </tr>
                        <tr>
                            <th>@lang('translation.corregimiento')</th>
                            <td>{{$company['corregimiento']['name']}}</td>
                            <th>@lang('translation.phone')</th>
                            <td>
                                @if(isset($company['phone_numbers']))
                                    {{ $company['phone_numbers'][0]['phone_number'] }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Create By</th>
                            <td>{{$company['created_by_user_id']['name']}}</td>
                            <th>@lang('translation.street')</th>
                            <td>{{$company['street']}}</td>
                        </tr>
                        <tr>
                            <th>House Number</th>
                            <td>{{$company['house_number']}}</td>
                            <th>@lang('translation.email')</th>
                            <td>
                                @if(count($company['emails'])>0)
                                    {{ $company['emails'][0]['email'] }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('translation.time')</th>
                            <td>
                                @if(isset($company['created_at']))
                                    <span>{{ date('F j, Y, g:i a', strtotime($company['created_at'])) }}
                                        </span>
                                @else
                                    N/A
                                @endif
                            </td>
                            <th>@lang('translation.avatar')</th>
                            <td>
                                @if($company['avatar']!=null)
                                    <img name='avatar' src="{{ $company['avatar'] }}" class="avatar-xs rounded-circle" />
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>