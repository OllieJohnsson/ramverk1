#Väder REST API Dokumentaion

Detta är en vädertjänst där du kan få ut en prognos från gårdagen och en vecka framåt. Du uppger koordinaterna för den position du vill använda enligt följande.



###En position
```
GET /rest-api/coordinates/48.85826,2.29383
```

###Resultat
```
[
    {
        "latitude": 48.85826,
        "longitude": 2.29383,
        "timezone": "Europe/Paris",
        "currently": {
            "time": 1543233129,
            "summary": "Mulet",
            "icon": "cloudy",
            "precipIntensity": 0.0127,
            "precipProbability": 0.1,
            "precipType": "rain",
            "temperature": 5.73,
            "apparentTemperature": 3.09,
            "dewPoint": 4.49,
            "humidity": 0.92,
            "pressure": 1010.04,
            "windSpeed": 3.44,
            "windGust": 10.33,
            "windBearing": 352,
            "cloudCover": 0.95,
            "uvIndex": 1,
            "visibility": 9.29,
            "ozone": 321.9
        },
        "hourly": {
...
```


###Flera positioner
```
GET /rest-api/coordinates/51.50069,-0.12458&48.85826,2.29383
```

###Resultat
```
[
    {
        "latitude": 51.50069,
        "longitude": -0.12458,
        "timezone": "Europe/London",
        "currently": {
            "time": 1543233080,
            "summary": "Molnigt",
            "icon": "partly-cloudy-day",
            "nearestStormDistance": 50,
            "nearestStormBearing": 73,
            "precipIntensity": 0,
            "precipProbability": 0,
            "temperature": 7.46,
            "apparentTemperature": 5.14,
            "dewPoint": 4.15,
            "humidity": 0.8,
            "pressure": 1013.08,
            "windSpeed": 3.52,
            "windGust": 6.27,
            "windBearing": 1,
            "cloudCover": 0.73,
            "uvIndex": 1,
            "visibility": 11.89,
            "ozone": 344.45
        },
        "minutely": {
...            
```
