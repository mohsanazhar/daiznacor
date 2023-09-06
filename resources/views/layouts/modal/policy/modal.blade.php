<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  data-layout="vertical" data-topbar="light"  data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Admin & Dashboard Template </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">
    @include('layouts.head-css')
</head>
<body>
    <div class="modal fade" id="addPoliciesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content border-0">
                <div class="modal-header p-4 pb-0">
                    <h5 class="modal-title" id="createMemberLabel">@lang('translation.policy-add')</h5>
                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
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
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.top-tagbar')
        @include('layouts.sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>

    @include('layouts.customizer')
    @include('layouts.vendor-scripts')

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
        document.getElementById("name-insure").value = company.user.name
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
</body>
</html>
