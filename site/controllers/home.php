<?php

return function ($site, $page, $kirby) {

  $stations = $site->find('members')->children()->listed();

  $arrayOfStations = [];

  foreach ($stations as $station) {
    $arrayOfStations[] = [
      'title' => $station->title()->value() . ' / ' . $station->location()->value(),
      'image' => $station->pics()->first()->toFile()->url(),
      'url' => $station->url(),
      'colour' => $station->colour()->value(),
    ];
  }

  $stationsJSON = json_encode($arrayOfStations);

  return [
    'stations' => $stations,
    'stationsJSON' => $stationsJSON,
  ];
};
