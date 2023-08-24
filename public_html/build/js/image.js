
/**
 * 
 * @param {string} elementId 
 * @param {string} previewElementId 
 */
function insertImage(elementId, previewElementId){

    elementId.onchange = function(e) {
        var ext = this.value.match(/\.([^\.]+)$/)[1];
        switch (ext) {
            case 'png':
            case 'jpeg':
            case 'pdf':
                alert('Allowed');
                break;
            default:
                alert('Not allowed');
                this.value = '';
        }
    };
    const inputImage = document.getElementById(elementId);
    const previewImage = document.getElementById(previewElementId);
    inputImage.addEventListener("change", ({ target }) => {
        const file = target.files[0];
        if(!file) return;
        previewImage.setAttribute("src", URL.createObjectURL(file));
    });

}