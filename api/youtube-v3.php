<?php
// API config 
const API_Key    = 'AIzaSyCw-XEqHcA1Gt-4oav20guEWm_n7zne4o8';
const Channel_ID = 'UCI6ofrQ7avhyDoN4KXmeJVg';

// Get videos from channel by YouTube Data API with pagination

function getVideos($channelID, $maxResults)
{
    $url = 'https://www.googleapis.com/youtube/v3/search?key=' . API_Key . '&channelId=' . $channelID . '&part=snippet&order=date&maxResults=' . $maxResults;
    $data = json_decode(file_get_contents($url));
    if (!$data) {
        return "API error: ";
    }
    return $data;
}

// get videos with pagination
function getVideosPaging($channelID, $maxResults, $pageToken)
{
    $url = 'https://www.googleapis.com/youtube/v3/search?key=' . API_Key . '&channelId=' . $channelID . '&part=snippet&order=date&maxResults=' . $maxResults . '&pageToken=' . $pageToken;
    $data = json_decode(file_get_contents($url));
    if (!$data) {
        return "API error: ";
    }
    return $data;
}

// get videos by keyword in channel by YouTube Data API with pagination
function getVideosByKeyword($channelID, $keyword, $maxResults, $pageToken = null)
{
    $url = 'https://www.googleapis.com/youtube/v3/search?key=' . API_Key . '&channelId=' . $channelID . '&part=snippet&order=date&maxResults=' . $maxResults . '&pageToken=' . $pageToken . '&q=' . $keyword;
    $data = json_decode(file_get_contents($url));
    if (!$data) {
        return "API error: ";
    }
    return $data;
}


// function getView
function getView($videoID)
{

    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics&id=' . $videoID . '&key=' . API_Key . '');

    if (!$apiData) {
        return '0';
    }
    $videoList = json_decode($apiData);
    return $videoList->items[0]->statistics->viewCount;
}

// get videos title 
function getTitle($videoID)
{
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $videoID . '&key=' . API_Key . '');
    if (!$apiData) {
        return '0';
    }
    $videoList = json_decode($apiData);
    return $videoList->items[0]->snippet->title;
}

// get tags
function getTags($videoID)
{
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $videoID . '&key=' . API_Key . '');
    if (!$apiData) {
        return '0';
    }
    $videoList = json_decode($apiData);
    return $videoList->items[0]->snippet->tags;
}

// get videos by viewed
function getMostViewed($channelID, $maxResults)
{
    $url = 'https://www.googleapis.com/youtube/v3/search?key=' . API_Key . '&channelId=' . $channelID . '&part=snippet&order=viewCount&maxResults=' . $maxResults;
    $data = json_decode(file_get_contents($url));
    if (!$data) {
        return "API error: ";
    }
    return $data->items;
}

// get duration
function getDuration($videoID)
{
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=' . $videoID . '&key=' . API_Key . '');
    if (!$apiData) {
        return '0';
    }
    $videoList = json_decode($apiData);
    return $videoList->items[0]->contentDetails->duration;
}

// get Resolution
function getResolution($videoID)
{
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=' . $videoID . '&key=' . API_Key . '');
    if (!$apiData) {
        return '0';
    }
    $videoList = json_decode($apiData);
    return $videoList->items[0]->contentDetails->definition;
}

// get video published date
function getPublishedDate($videoID)
{
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $videoID . '&key=' . API_Key . '');
    if (!$apiData) {
        return '0';
    }
    $videoList = json_decode($apiData);
    return $videoList->items[0]->snippet->publishedAt;
}

// get description
function getDescription($videoID)
{
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $videoID . '&key=' . API_Key . '');
    if (!$apiData) {
        return '0';
    }
    $videoList = json_decode($apiData);
    return $videoList->items[0]->snippet->description;
}
