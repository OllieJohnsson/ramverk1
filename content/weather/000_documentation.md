#Väder REST API Dokumentaion

Detta är en vädertjänst där du kan få ut en prognos från gårdagen och en vecka framåt. Du kan också se historiken för en plats en månad tillbaka. Uppge koordinaterna för den position du vill använda enligt följande.


###Prognos
```
GET /api/forecast/48.85826,2.29383
```

###Resultat
```
{
    "latitude": 48.85826,
    "longitude": 2.29383,
    "timezone": "Europe/Paris",
    "currently": {
        "time": 1543501075,
        "summary": "Molnigt",
        "icon": "partly-cloudy-day",
        "precipIntensity": 0.0254,
        "precipProbability": 0.07,
        "precipType": "rain",
        "temperature": 14.31,
        "apparentTemperature": 14.31,
        "dewPoint": 6.74,
        "humidity": 0.6,
        "pressure": 1009.85,
        "windSpeed": 6.42,
        "windGust": 12.04,
        "windBearing": 209,
        "cloudCover": 0.82,
        "uvIndex": 0,
        "visibility": 16.09,
        "ozone": 284.92
    },
    "hourly": {
...
```


###Historik
```
GET /api/history/51.50069,-0.12458
```

###Resultat
```
[
    {
        "latitude": 51.50069,
        "longitude": -0.12458,
        "timezone": "Europe/London",
        "currently": {
            "time": 1543492800,
            "summary": "H\u00e5rd vind och molnigt",
            "icon": "wind",
            "precipIntensity": 0,
            "precipProbability": 0,
            "temperature": 14,
            "apparentTemperature": 14,
            "dewPoint": 9.46,
            "humidity": 0.74,
            "pressure": 998.82,
            "windSpeed": 11.21,
            "windGust": 17.57,
            "windBearing": 209,
            "cloudCover": 0.91,
            "uvIndex": 1,
            "visibility": 10.01,
            "ozone": 291.01
        },
        "minutely": {
...            
```
