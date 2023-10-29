function submitForm(theatreId) {
    const form = document.getElementById('theatre-form');
    const theatreInput = document.getElementById('theatre-select-input')
    const sortInput = document.getElementById('sort-select-input')
    sortInput.value = 'default'
    theatreInput.value = theatreId
    form.submit();
}