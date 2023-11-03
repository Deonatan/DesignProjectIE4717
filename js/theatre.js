function submitForm(theatreId) {
    const form = document.getElementById('theatre-form');
    const theatreInput = document.getElementById('theatre-select-input')
    const sortInput = document.getElementById('sort-select-input')
    const genresInput = document.getElementById('selected-genres-input')
    const statusInput = document.getElementById('selected-status-input')
    sortInput.value = 'default'
    genresInput.value = 'default'
    statusInput.value = 'default'
    theatreInput.value = theatreId
    form.submit();
}