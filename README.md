This is a fun project that I've developed just today.

The copy of DB that contains the data between 21.01.24 and 21.01.25 is included. Just copy it from the root folder to `database` folder

You may also access it here - https://clouds.igorweb.dev/api/weather?with=aggregations or https://project-w.fly.dev/api/weather?with=aggregations

The list of cities is available on `/api/cities`. One city weather can be requested via e.g. `/api/cities/Hamburg/weather`

Unfortunately, Stuttgart/Leipzig/Dresden got rate limited but so far the winner as the less clouded city is *Berlin*. I didn't expect that!


```
[
    {
        "city_id": 1,
        "city_name": "Freiburg",
        "avg_cloudiness": 70.32177595628416,
        "avg_min_temperature": 8.876174863387975,
        "avg_max_temperature": 16.863825136612025,
        "entities_count": 366
    },
    {
        "city_id": 2,
        "city_name": "Hamburg",
        "avg_cloudiness": 48.05352459016393,
        "avg_min_temperature": 7.937021857923502,
        "avg_max_temperature": 14.927377049180338,
        "entities_count": 366
    },
    {
        "city_id": 3,
        "city_name": "Lübeck",
        "avg_cloudiness": 49.86030054644809,
        "avg_min_temperature": 7.602650273224046,
        "avg_max_temperature": 14.712240437158478,
        "entities_count": 366
    },
    {
        "city_id": 4,
        "city_name": "Berlin",
        "avg_cloudiness": 39.82412568306011,
        "avg_min_temperature": 8.794480874316942,
        "avg_max_temperature": 16.49516393442622,
        "entities_count": 366
    },
    {
        "city_id": 5,
        "city_name": "Munich",
        "avg_cloudiness": 71.28415300546447,
        "avg_min_temperature": 6.899480874316949,
        "avg_max_temperature": 15.65245901639345,
        "entities_count": 366
    },
    {
        "city_id": 6,
        "city_name": "Düsseldorf",
        "avg_cloudiness": 49.19008196721311,
        "avg_min_temperature": 9.446612021857923,
        "avg_max_temperature": 16.219480874316943,
        "entities_count": 366
    },
    {
        "city_id": 7,
        "city_name": "Frankfurt",
        "avg_cloudiness": 45.36079234972677,
        "avg_min_temperature": 9.115792349726767,
        "avg_max_temperature": 16.519781420765035,
        "entities_count": 366
    }
]
```
