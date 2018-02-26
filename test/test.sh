#!/bin/bash

months=( '01' '02' )
events=( 'view' 'play' 'click' )
countries=( 'US' 'RS' 'BA' 'ME' 'SI' 'RU' 'MK' 'RO' 'BG' )
until=$[$(date +%s)+60]
while [ ${until} -gt $(date +%s) ]; do
  month_id=$[RANDOM % 2]
  month=${months[$month_id]}
  max_days=31
  if [ "${month}" = "02" ]; then
    max_days=26
  fi
  day=$[RANDOM % max_days + 1]
  if [ ${#day} -eq 1 ]; then
    day='0'${day}
  fi
  date='2018-'${month}'-'${day}
  country_id=$[RANDOM % 9]
  country=${countries[$country_id]}
  event_id=$[RANDOM % 3]
  event=${events[$event_id]}
  curl -X POST -d '{"date": "'${date}'", "country": "'${country}'", "event": "'${event}'"}' 'http://quantox.counter.dev/api/events/' &>/dev/null
done
sleep 3
curl -X POST -d '{"date": "2018-02-26", "country": "CA", "event": "click"}' 'http://quantox.counter.dev/api/events/' &>/dev/null