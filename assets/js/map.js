const CENTER = { lat: 48.8566, lng: 2.3522 };
const API_URL = "https://AIzaSyA85qi7jHSJvC98Ffei_7pKEYZmsWvaZag?id=";

async function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: CENTER,
    });

    const zoneIds = [1, 2, 3];

    for (const id of zoneIds) {
        const response = await fetch(API_URL + id);
        const data = await response.json();

        const marker = new google.maps.Marker({
            position: { lat: data.lat, lng: data.lng },
            map: map,
            title: data.title,
        });

        const infoWindow = new google.maps.InfoWindow({
            content: `
                <h3>${data.title}</h3>
                <p>${data.description}</p>
            `,
        });

        marker.addListener("click", () => {
            infoWindow.open(map, marker);
        });
    }
}
