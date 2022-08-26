function toggleInput(profileId, element, inputElement){
    const item = document.getElementById(element+profileId);
    const input = document.getElementById(inputElement+profileId);

    if(item.hasAttribute('hidden')){
        item.removeAttribute('hidden');
        input.hidden = true;
    } else{
        input.removeAttribute('hidden');
        item.hidden = true;
    }
}

function editName(profileId){
    let formData = new FormData();
    const name = document.querySelector(`#input-name-${profileId}`).value;
    const token = document.querySelector(`input[name="_token"]`).value;
    formData.append('name', name);
    formData.append('_token', token);
    const url = `/profiles/${profileId}/editName`;

    fetch(url, {
        body:formData,
        method:'POST'
    }).then(()=>{
        toggleInput(profileId, 'name-box-', 'input-profile-name-');
        document.getElementById(`profile-name-${profileId}`).textContent = name;
    })
}

function editDescription(profileId){
    let formData = new FormData();
    const description = document.querySelector(`#input-description-${profileId}`).value;
    const token = document.querySelector(`input[name="_token"]`).value;
    formData.append('description', description);
    formData.append('_token', token);
    const url = `/profiles/${profileId}/editDescription`;

    fetch(url, {
        body:formData,
        method: 'POST'
    }).then(()=>{
        toggleInput(profileId, 'description-box-', 'input-profile-description-');
        document.getElementById(`profile-description-${profileId}`).textContent = description;
    })
}
