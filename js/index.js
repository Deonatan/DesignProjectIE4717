function submitForm() {
    var selectedValue = document.getElementById('sort-select').value;
    var form = document.getElementById('sort-form');
    // Get all selected checkboxes
    var checkboxes = document.querySelectorAll('input[name="genres[]"]:checked');
    var selectedValues = [];
    // Extract the values of selected checkboxes
    checkboxes.forEach(function(checkbox) {
        selectedValues.push(checkbox.value);
    });
    // Set the hidden input value
    document.getElementById('selected-genres').value = selectedValues.join(',');
    // console.log(document.getElementById('selected-genres').value)
    form.submit();
}