document.addEventListener('click', function(event){
    var target = event.target;
    if (target.classList.contains ('detail-button')){
        var carId = target.getAttribute('data-car-id');
        window.location.href = '/car-detail/'+carId;
    }
})