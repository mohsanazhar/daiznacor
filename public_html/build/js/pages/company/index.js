const onlyStringRegex = /^[a-zA-Z]+$/;

const getListProvince = () => {
    return fetch('/api/provinces').then(res => res.json()).catch((e) => {
        console.error("ERROR TO GET LIST OF COMPANIES", e);
    });
};


const handleSelectSubmit = (name) => {
    if(typeof name != 'string' || !name) return;

    const formData = new FormData();
    formData.append("name", name);

    axios.post("/api/provinces", formData)
        .then(() => {
            formData.delete("name");
        })
        .catch((e) => {
            console.error("province ERROR: ", e?.response?.data?.message);
        });
};

/**
 * 
 * @param {Array<string>} elementIds 
 */
const selectizeConfig = (elementIds, data, type) => {

    elementIds.forEach(id => {
        
        const select = $(id).selectize({
            showAddOptionOnCreate: true,
            create: true,
            onItemAdd: (item) => {
                if(item === '0') return;

                if(type === 'province') return handleSelectSubmit(item);
            },
        })[0];

        if(!select) return;

        const control = select.selectize;

        if(!data.length) return;
        data.forEach((item, id) => {
            const data = { value: item.name, text: item.name };
            control.addOption(data);
        });
    })
}

const selectInitializedEvent = () => {

    const providesIds = [
        "#company-province",
        "#company-update-province"
    ];

    const districtIds = [
        "#company-district",
        "#company-update-district"
    ];

    const ccorregimeintoIds = [
        "#company-corregimiento",
        "#company-update-corregimiento"
    ];

    getListProvince().then((data) => {
        selectizeConfig(providesIds, data, 'province')
    });

    selectizeConfig(districtIds, [])
    selectizeConfig(ccorregimeintoIds, [])
}


document.addEventListener("DOMContentLoaded", () => {
    selectInitializedEvent();
});
