@extends('layouts.master')
@section('title')@lang('translation.new') @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Home @endslot
@slot('title') Insurance Policies @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title mb-0">@lang('translation.policy-list')</h5>
                <div style="flex: 1 1 auto" class="d-flex justify-content-end">
                   @include('layouts.common.display_error')
                </div>
            </div>
            <div class="card-body">
                <form
                        action="{{ route('createPolicy') }}"
                        method="POST"
                        autocomplete="off"
                        id='form-new-policy'
                        class="needs-validation"
                        novalidate
                >
                    @csrf
                    <div class="g-3 row">
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-name" class="form-label">@lang('translation.policy-num')</label>
                                <div>
                                    <input type="text" id="policy-number" class="form-control" name="number" placeholder="@lang('translation.policy-num')">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="insurance-company" class="form-label">@lang('translation.insurance-company')</label>
                                <div>
                                    <select name="insurance_company_id" id="insurance-company-id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="name-insure" class="form-label">@lang('translation.name-insure')</label>
                                <div>
                                    <input type="text" id="name-insure" class="form-control" name="insured_name" placeholder="@lang('translation.name-insure')">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="company-ruc" class="form-label">RUC / Cédula</label>
                                <div>
                                    <select type="text" id="company-ruc" name="identification_card" placeholder="RUC">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="policy-expiration" class="form-label">@lang('translation.policy-expiration')</label>
                                <div>
                                    <input type="text" id="policy-expiration" class="form-control" name="policy_expiration" placeholder="@lang('translation.policy-expiration')">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div>
                                <label for="policy-issuance" class="form-label">@lang('translation.policy-issuance')</label>
                                <div>
                                    <input type="text" id="policy-issuance" class="form-control" name="policy_issuance" placeholder="@lang('translation.policy-issuance')">
                                </div>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.close')</button>
                            <button type="submit" class="btn btn-success" id="addNewMember">@lang('translation.new')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    const flatpickrHelper = (id, options) => {
        const { defaultDate } = options || {};

        flatpickr(document.getElementById(id), {
                dateFormat: "Y-m-d",
                ...(defaultDate && { defaultDate: [`today`, ""], }),
            minDate: `${new Date().getFullYear() -2}`,
            enableTime: false
    });
    }
</script>

<script>
    const flatpickrElementDateIds = [
        "policy-issuance",
        "policy-expiration"
    ]

    flatpickrElementDateIds.forEach(id => {
        flatpickrHelper(id, {
        ...(id === 'policy-issuance' && { defaultDate: true })
    });
    });
</script>

<script>
    const getInsuranceCompanies = async () => {
        return await axios.get("/api/insurances/companies").catch(error => {
            console.error("insurances ERROR", error);
    })
    }

    const handleSelectSubmit = (name) => {
        if(typeof name != 'string' || !name) return;

        const formData = new FormData();
        formData.append("name", name);

        axios.post("/api/insurances/companies", formData)
            .then(() => {
            formData.delete("name");
    })
    .catch((e) => {
            console.error("province ERROR: ", e?.response?.data?.message);
    });
    }

    const selectConfig = (elementIds, data) => {

        if(Array.isArray(elementIds)){
            elementIds.forEach(id => {
                const select = $(id).selectize({
                        showAddOptionOnCreate: true,
                        create: true,
                        valueField: 'id',
                        labelField: 'value',
                        labelField: 'value',
                        onItemAdd: (item) => {
                        const numberRegex = /^[+-]?(\d+\.?\d*|\.\d+)([eE][+-]?\d+)?$/;
            if(numberRegex.test(item)) return;
            handleSelectSubmit(item);
        },
        })[0];

            if(!select) return;

            const control = select.selectize;

            if(!data.length) return;
            data.forEach((item, id) => {
                const data = { value: item.name, id: item.id };
            control.addOption(data);
        });
        });
            return;
        }

        const select = $(elementIds).selectize({
                showAddOptionOnCreate: true,
                create: true,
                valueField: 'id',
                labelField: 'value',
                labelField: 'value',
                onItemAdd: (item) => {
                const numberRegex = /^[+-]?(\d+\.?\d*|\.\d+)([eE][+-]?\d+)?$/;
        if(numberRegex.test(item)) return;
        handleSelectSubmit(item);
    },
    })[0];

        if(!select) return console.error(`${elementIds} is invalid`);

        const control = select.selectize;

        if(!data.length) return;
        data.forEach((item, id) => {
            const data = { value: item.name, id: item.id };
        control.addOption(data);
    });
    }
</script>

<script>

    $(document).ready(() => {
        $('input[id^="policy-expiration-"]').each(function() {
        flatpickrHelper(this.id, {
            defaultDate: false
        })
    });
    $('input[id^="policy-issuance-"]').each(function() {
        flatpickrHelper(this.id, {
            defaultDate: false
        })
    });
    getInsuranceCompanies().then(({ data }) => {
        selectConfig("#insurance-company-id", data)
    $('select[id^="insurance-company-id-"]').each(function() {
        selectConfig(`#${this.id}`, data);
    });
    });
    });

</script>

<script>
    const compnaiesData = @json($companies);
    const form = document.getElementById("form-new-policy");

    const handleInsertCompnay = (id) => {
        const company = compnaiesData.find(item => item.id == id);
        if(!company) return;
        $('#name-insure').val(company.name.toString().toUpperCase());
        //console.log(company);
        //document.getElementById("name-insure").value = company.name
    }

    const selectizeConfigCompanies = (id, data) => {
        const select = $(id).selectize({
                showAddOptionOnCreate: true,
                create: false,
                onChange: (item) => {
                handleInsertCompnay(item);
    }
    })[0];

        if(!select) return;

        const control = select.selectize;

        if(!data || !data.length){
            const data = { value: 0, text: "No hay empresas disponible" };
            return control.addOption(data);
        }
        data.forEach((item) => {
            const data = { value: item.id, text: item.identification_card };
        control.addOption(data);
    });
    }

    selectizeConfigCompanies("#company-ruc", compnaiesData);

</script>

@endsection
