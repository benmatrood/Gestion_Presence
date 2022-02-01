// const url = 'http://ip-api.com/json/';
// console.log(url);
const userAction = async () => {
    const response = await fetch('http://ip-api.com/json/');
    const myJson = await response.json(); //extract JSON from the http response
      // do something with myJson
      console.log(myJson)
    }
    
    
    
    function init() {
        const position = {
            lat: 5.3510144,
            lng: -4.0075264,
        }
        
        ;const zoomlevel = 14;
    
        const map = L.map('map').setView([position.lat, position.lng], zoomlevel); 
    
        const mainLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoidG90bzEwMTAiLCJhIjoiY2t3MzNjYjM0MTl0aTMwcm8wM3gwMTU2MiJ9.KRa8s8I2f2dT2H2xLDAwxg'});
    
        mainLayer.addTo(map);
        var circle = L.circle([position.lat, position.lng], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
        
    }
     