var selectElem = document.getElementById('vraag')

// When a new <option> is selected
selectElem.addEventListener('change', function() {
  var index = selectElem.selectedIndex;
  console.log(index);
})