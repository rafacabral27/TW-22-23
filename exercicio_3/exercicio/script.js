// flickr api key: https://www.flickr.com/services/api/misc.api_keys.html || 260cfd21365b281507d74790ad583d32
// Weather api key: https://home.openweathermap.org/users/sign_in || a9e49b305a5d14cc0790dbf507251ca1

const inputFlickr = document.getElementById('imageSearchID')

function requestFlickrApi() {
    const requestOptions = {
        method: "GET", // *GET, POST, PUT, DELETE, etc.
    }

    const requestBody = {
        method: 'flickr.photos.search',
        api_key: 'acb0d07ce4123dfe53f12727f137b9a1',
        extras: 'url_l',
        per_page: 5,
        text: inputFlickr.value,
        format: 'json',
        nojsoncallback: 1
    }

    const urlParams = new URLSearchParams(requestBody).toString();

    fetch('https://www.flickr.com/services/rest/?' + urlParams, requestOptions)
        .then((result) => result.json())
        .then((response) => {

            console.log(response);
            const divContainer = document.getElementById('photosContainer');
            divContainer.innerHTML= '';

            const photos = response.photos.photo;
            photos.forEach((photo) => {
                divContainer.innerHTML = divContainer.innerHTML + '<img src="' + photo.url_l + '">'
            })
    });

}

function requestMeteoApi() {

}
