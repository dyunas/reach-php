SELECT *, 
  (
    (
      (
        acos(
          sin(( 14.3374682 * pi() / 180))
          *
          sin(( latitude * pi() / 180)) + cos(( 14.3374682 * pi() /180 ))
          *
          cos(( latitude * pi() / 180)) * cos((( 121.0610894 - longitude) * pi()/180)))
      ) * 180/pi()
    ) * 60 * 1.1515 * 1.609344
  )
as distance FROM merchants
HAVING distance <= 10
LIMIT 15