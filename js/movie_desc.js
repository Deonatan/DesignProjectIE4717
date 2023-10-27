function changeColor(timeBoxId){
    const timeBoxes = Array.from(document.querySelectorAll('.time-box'));
    selectedTimeBox = document.getElementById(timeBoxId);
    const isGrey = selectedTimeBox.style.backgroundColor === 'grey';
    // Reset the background color of all timeBoxes to azure
    timeBoxes.forEach(function (box) {
        box.style.backgroundColor = 'azure';
    });

    if (isGrey){
        selectedTimeBox.style.backgroundColor = 'azure'
    }else{
        selectedTimeBox.style.backgroundColor = 'grey'
    }

}