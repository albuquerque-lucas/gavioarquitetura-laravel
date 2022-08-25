function toggleInput(projectId, element, inputElement){
    const item = document.getElementById(element+projectId);
    const input = document.getElementById(inputElement+projectId);

    if(item.hasAttribute('hidden')){
        item.removeAttribute('hidden');
        input.hidden = true;
    } else{
        input.removeAttribute('hidden');
        item.hidden = true;
    }
}

function editName(project_id){
    let formData = new FormData();
    const name = document.querySelector(`#name-input-${project_id}`).value;
    const token = document.querySelector(`input[name="_token"]`).value;
    formData.append('name', name);
    formData.append('_token', token);
    const url = `/admin-projects/${project_id}/editName`;

    fetch(url, {
        body:formData,
        method:'POST'
    }).then(()=>{
        toggleInput(project_id, `name-box-`, `project-name-inputbox-`);
        document.getElementById(`project-name-${project_id}`).textContent = name;
    })
}

function editArea(project_id){
    let formData = new FormData();
    const area = document.querySelector(`#area-input-${project_id}`).value;
    const token = document.querySelector(`input[name="_token"]`).value;
    formData.append('area', area);
    formData.append('_token', token);
    const url = `/admin-projects/${project_id}/editArea`;

    fetch(url, {
        body:formData,
        method:'POST'
    }).then(()=>{
        toggleInput(project_id, `area-box-`, `project-area-inputbox-`);
        document.getElementById(`project-area-${project_id}`).textContent = area;
    })
}

function editYear(project_id){
    let formData = new FormData();
    const year = document.querySelector(`#year-input-${project_id}`).value;
    const token = document.querySelector(`input[name="_token"]`).value;
    formData.append('year', year);
    formData.append('_token', token);
    const url = `/admin-projects/${project_id}/editYear`;

    fetch(url, {
        body:formData,
        method:'POST'
    }).then(()=>{
        toggleInput(project_id, `year-box-`, `project-year-inputbox-`);
        document.getElementById(`project-year-${project_id}`).textContent = year;
    })
}

function editAddress(project_id){
    let formData = new FormData();
    const address = document.querySelector(`#address-input-${project_id}`).value;
    const token = document.querySelector(`input[name="_token"]`).value;
    formData.append('address', address);
    formData.append('_token', token);
    const url = `/admin-projects/${project_id}/editAddress`;

    fetch(url, {
        body:formData,
        method:'POST'
    }).then(()=>{
        toggleInput(project_id, `address-box-`, `project-address-inputbox-`);
        document.getElementById(`project-address-${project_id}`).textContent = address;
    })
}

function editDescription(project_id){
    let formData = new FormData();
    const description = document.querySelector(`#description-input-${project_id}`).value;
    const token = document.querySelector(`input[name="_token"]`).value;
    formData.append('description', description);
    formData.append('_token', token);
    const url = `/admin-projects/${project_id}/editDescription`;

    fetch(url, {
        body:formData,
        method:'POST'
    }).then(()=>{
        toggleInput(project_id, `description-box-`, `project-description-inputbox-`);
        document.getElementById(`project-description-${project_id}`).textContent = description;
    })
}
