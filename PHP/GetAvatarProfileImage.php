<?php

function getProfilePicture($uuid): String
{
    $prefix = 'http://world.secondlife.com/resident/';
    $url = $prefix . $uuid;

    $html = @file_get_contents($url);

    if ($html === false) {
        throw new \Exception("Failed to load HTML from $url");
    }

    $doc = new \DOMDocument();
    @$doc->loadHTML($html);
    $xpath = new \DOMXPath($doc);
    // pictureUrl is the link to the image with "profile image" as alt text
    $pictureUrl = $xpath->evaluate("string(//img[@alt='profile image']/@src)");

    return $pictureUrl;
}