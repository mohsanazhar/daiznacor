const numberRegex = /^[+-]?(\d+\.?\d*|\.\d+)([eE][+-]?\d+)?$/;

const getListMunicipaly = () => {
    return fetch('/api/municipality').then(res => res.json()).catch((e) => {
        console.error("ERROR TO GET LIST OF MUNUCIPALITIES", e);
    });
};


const handleSelectSubmitMunicipaly = (name) => {
    if(typeof name != 'string' || !name) return;

    const formData = new FormData();
    formData.append("name", name);

    axios.post("/api/municipality", formData)
        .then(() => {
            formData.delete("name");
        })
        .catch((e) => {
            console.error("municipality ERROR: ", e?.response?.data?.message);
        });
};


/**
 * 
 * @param {Array<string>} elementIds 
 */
const selectizeConfigMunicipality = (elementIds, data) => {

    if(Array.isArray(elementIds)) {
        elementIds.forEach(id => {
            const select = $(id).selectize({
                showAddOptionOnCreate: true,
                create: true,
                onItemAdd: (item) => {
                    if(numberRegex.test(item)) return;
                    handleSelectSubmitMunicipaly(item);
                },
            })[0];
    
            if(!select) return;
    
            const control = select.selectize;
    
            if(!data.length) return;
            data.forEach((item, id) => {
                const data = { value: item.name, text: item.name };
                control.addOption(data);
            });
        });
        return
    }



    const select = $(elementIds).selectize({
        showAddOptionOnCreate: true,
        create: true,
        onItemAdd: (item) => {
            if(numberRegex.test(item)) return;
            handleSelectSubmitMunicipaly(item);
        },
    })[0];

    if(!select) return;

    const control = select.selectize;

    if(!data.length) return;
    data.forEach((item, id) => {
        const data = { value: item.name, text: item.name };
        control.addOption(data);
    });
}

const selectInitializedEvent = () => {


    getListMunicipaly().then((data) => {
        selectizeConfigMunicipality("#municipality", data);
        $('select[id^="municipality-update-"]').each(function () {
            selectizeConfigMunicipality(`#${this.id}`, data)
        });
    });
}


document.addEventListener("DOMContentLoaded", () => {
    selectInitializedEvent();
});


//////////////////////////////////////////////////////////////////////////////

const getListVehicleType = () => {
    return fetch('/api/vehicle/type').then(res => res.json()).catch((e) => {
        console.error("ERROR TO GET LIST OF VEHICLE TYPE", e);
    });
};


const handleSelectSubmitVehicleType = (name) => {
    if(typeof name != 'string' || !name) return;

    const formData = new FormData();
    formData.append("name", name);

    axios.post("/api/vehicle/type", formData)
        .then(() => {
            formData.delete("name");
        })
        .catch((e) => {
            console.error("vehicle type ERROR: ", e?.response?.data?.message);
        });
};


const selectizeConfigVehicleType = (elementIds, data) => {

    if(Array.isArray(elementIds)) {
        elementIds.forEach(id => {
            const select = $(id).selectize({
                showAddOptionOnCreate: true,
                create: true,
                onItemAdd: (item) => {
                    if(numberRegex.test(item)) return;
                    handleSelectSubmitMunicipaly(item);
                },
            })[0];
    
            if(!select) return;
    
            const control = select.selectize;
    
            if(!data.length) return;
            data.forEach((item, id) => {
                const data = { value: item.name, text: item.name };
                control.addOption(data);
            });
        });
        return
    }

    const select = $(elementIds).selectize({
        showAddOptionOnCreate: true,
        create: true,
        onItemAdd: (item) => {
            if(item === '0') return;
            handleSelectSubmitMunicipaly(item);
        },
    })[0];

    if(!select) return;

    const control = select.selectize;

    if(!data.length) return;
    data.forEach((item, id) => {
        const data = { value: item.name, text: item.name };
        control.addOption(data);
    });
}

const selectInitializedEventVehicleType = () => {

    getListVehicleType().then((data) => {
        selectizeConfigVehicleType("#type-vehicle", data)

        $('select[id^="type-vehicle-update-"]').each(function () {
            selectizeConfigVehicleType(`#${this.id}`, data)
        });
    });
}


document.addEventListener("DOMContentLoaded", () => {
    selectInitializedEventVehicleType();
});

//////////////////////////////////////////////////////////////////////////////

const getListFuelType = () => {
    return fetch('/api/fuel/type').then(res => res.json()).catch((e) => {
        console.error("ERROR TO GET LIST OF VEHICLE TYPE", e);
    });
};


const handleSelectSubmitFuelType = (name) => {
    if(typeof name != 'string' || !name) return;

    const formData = new FormData();
    formData.append("name", name);

    axios.post("/api/fuel/type", formData)
        .then(() => {
            formData.delete("name");
        })
        .catch((e) => {
            console.error("vehicle type ERROR: ", e?.response?.data?.message);
        });
};


const selectizeConfigFuelType = (elementIds, data) => {

    if(Array.isArray(elementIds)) {
        elementIds.forEach(id => {
            const select = $(id).selectize({
                showAddOptionOnCreate: true,
                create: true,
                onItemAdd: (item) => {
                    if(item === '0') return;
                    handleSelectSubmitMunicipaly(item);
                },
            })[0];
    
            if(!select) return;
    
            const control = select.selectize;
    
            if(!data.length) return;
            data.forEach((item, id) => {
                const data = { value: item.name, text: item.name };
                control.addOption(data);
            });
        });
        return
    }

    const select = $(elementIds).selectize({
        showAddOptionOnCreate: true,
        create: true,
        onItemAdd: (item) => {
            if(item === '0') return;
            handleSelectSubmitMunicipaly(item);
        },
    })[0];

    if(!select) return;

    const control = select.selectize;

    if(!data.length) return;
    data.forEach((item, id) => {
        const data = { value: item.name, text: item.name };
        control.addOption(data);
    });
}

const selectInitializedEventFuelType = () => {

    getListFuelType().then((data) => {
        selectizeConfigFuelType("#fuel-type", data)

        $('select[id^="fuel-type-update-"]').each(function () {
            selectizeConfigFuelType(`#${this.id}`, data)
        });
    });
}


document.addEventListener("DOMContentLoaded", () => {
    selectInitializedEventFuelType();
});

//////////////////////////////////////////////////////////////////////////////
