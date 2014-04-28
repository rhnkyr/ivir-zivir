<?php
// Mekanlar
$app->get('/:city/:district/:quarter/:mainCategory/:placeSlug(/)', '\Controllers\PlaceController:placeDetail')->name("place_detail");
$app->get('/:city/:district/:quarter/:mainCategory(/)', '\Controllers\PlaceController:placesByMainCategory')->name("places_by_main_category");
$app->get('/:city/:district/:quarter(/)', '\Controllers\PlaceController:listByQuarter')->name("list_by_quarter");
$app->get('/:city/:district(/)', '\Controllers\PlaceController:listByDistrict')->name("list_by_district");
$app->get('/:city(/)', '\Controllers\PlaceController:listByCity')->name("list_by_city");
