const selectizeConfigSearch = (id, data, url, options = {}) => {
    const _data = data.map((item) => {
        return { value: item.name, text: item.name };
    });

    $(id).selectize({
        showAddOptionOnCreate: true,
        items: options.defaultValue ? [options.defaultValue] : [],
        options: _data,
        create: options.create || false,
        onItemAdd: (item) => {
            const numberRegex = /^[+-]?(\d+\.?\d*|\.\d+)([eE][+-]?\d+)?$/;
            if(numberRegex.test(item)) return;

            handleSelectSubmitSearch(item, url);
        },
    })[0];
}

const getListSearch = (url) => {
    console.log({ url })
    return fetch(url).then(res => res.json()).catch((e) => {
        console.error("ERROR TO GET LIST", e);
    });
};

const handleSelectSubmitSearch = (name, url) => {
    if(typeof name != 'string' || !name) return;

    const formData = new FormData();
    formData.append("name", name);

    axios.post(url, formData).then(() => {
            formData.delete("name");
    }).catch((e) => {
        console.error("ERROR: ", e?.response?.data?.message);
    });
};

/**
 * 
 * @param {string} id 
 * @param {string} url 
 * @param {{defaultValue: string, create: boolean}} options 
 */
function searchInput(id, url, options = {}){
    getListSearch(url).then((data) => {
        selectizeConfigSearch(id, data, url, options)
    });
}