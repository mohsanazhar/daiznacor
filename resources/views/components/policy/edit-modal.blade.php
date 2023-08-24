@props([
    "item"
])

<div class="modal fade" id="updatePoliciesModal{{ $item['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">@lang('translation.policy-update')</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form
                    action="{{ route('editPolicy', $item['id']) }}"
                    method="POST"
                    autocomplete="off"
                    class="needs-validation"
                    novalidate
                >
                    @csrf
                    @method("PATCH")
                    <div class="g-3 row">
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="policy-number-{{ $item['id'] }}" class="form-label">@lang('translation.policy-num')</label>
                                <div>
                                    <input value="{{ $item['number'] }}" type="text" id="policy-number-{{ $item['id'] }}" class="form-control" name="number" placeholder="@lang('translation.policy-num')">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="insurance-company-id-{{ $item['id'] }}" class="form-label">@lang('translation.insurance-company')</label>
                                <div>
                                    <select name="insurance_company" id="insurance-company-id-{{ $item['id'] }}">
                                        <option selected>{{ $item['insurance_company'] }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="name-insure-{{ $item['id'] }}" class="form-label">@lang('translation.name-insure')</label>
                                <div>
                                    <input value="{{ $item['insured_name'] }}" type="text" id="name-insure-{{ $item['id'] }}" class="form-control" name="insured_name" placeholder="@lang('translation.name-insure')">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="identification-card-policy-{{ $item['id'] }}" class="form-label">RUC / Cédula</label>
                                <div>
                                    <input value="{{ $item['identification_card'] }}" type="text" id="identification-card-policy-{{ $item['id'] }}" class="form-control" name="identification_card" placeholder="RUC">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="policy-expiration-{{ $item['id'] }}" class="form-label">@lang('translation.policy-expiration')</label>
                                <div>
                                    <input value="{{ date('Y-m-d', strtotime($item['policy_expiration'])) }}" type="text" id="policy-expiration-{{ $item['id'] }}" class="form-control" name="policy_expiration" placeholder="@lang('translation.policy-expiration')">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="policy-issuance-{{ $item['id'] }}" class="form-label">@lang('translation.policy-issuance')</label>
                                <div>
                                    <input value="{{ date('Y-m-d', strtotime($item['policy_issuance'])) }}" type="text" id="policy-issuance-{{ $item['id'] }}" class="form-control" name="policy_issuance" placeholder="@lang('translation.policy-issuance')">
                                </div>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.close')</button>
                            <button type="submit" class="btn btn-success" id="addNewMember">@lang('translation.update')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>