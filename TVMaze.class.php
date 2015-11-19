<?php
class TVMaze
{
    function listings($country = '', $date = '') {
        $url = 'http://api.tvmaze.com/schedule';
        $add = array();
        if (preg_match('/^[A-Z]{2}$/i', $country)) $add[] = 'country=' . urlencode($country);
        if ($this->isTimestampIsoValid($date)) $add[] = 'date=' . urlencode($date);
        if (count($add) > 0) $url.= '?' . implode('&', $add);
        return json_decode(file_get_contents($url), true);
    }
    function fullschedule() {
        return json_decode(file_get_contents('http://api.tvmaze.com/schedule/full'), true);
    }
    function isTimestampIsoValid($timestamp) {
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $timestamp, $parts) == true) {
            try {
                new \DateTime($timestamp);
                return true;
            }
            catch(\Exception $e) {
                return false;
            }
        } 
        else {
            return false;
        }
    }
    function search($name, $type = '', $embed = '') {
        if (($type == 'tvrage' || $type = 'thetvdb') && is_int($name)) $url = 'http://api.tvmaze.com/lookup/shows?' . $type . '=' . (int)$name;
        elseif ($type == 'person') $url = 'http://api.tvmaze.com/search/people?q=' . urlencode($name);
        elseif ($type == 'shows') $url = 'http://api.tvmaze.com/search/shows?q=' . urlencode($name);
        else $url = 'http://api.tvmaze.com/search/shows?q=' . urlencode($name);
        if ($embed != '' && !is_array($embed)) $url.= '&embed=' . urlencode($embed);
        elseif (is_array($embed)) {
            foreach ($embed as $key => $value) {
                $embed[$key] = urlencode($value);
            }
            $url.= '&embed[]=' . implode('&embed[]=', $embed);
        }
        return json_decode(file_get_contents($url), true);
    }
    function single($name, $embed = '') {
        $url = 'http://api.tvmaze.com/singlesearch/shows?q=' . urlencode($name);
        if ($embed != '' && !is_array($embed)) $url.= '&embed=' . urlencode($embed);
        elseif (is_array($embed)) {
            foreach ($embed as $key => $value) {
                $embed[$key] = urlencode($value);
            }
            $url.= '&embed[]=' . implode('&embed[]=', $embed);
        }
        return json_decode(file_get_contents($url), true);
    }
    function show($id, $embed = '') {
        $url = 'http://api.tvmaze.com/shows/' . (int)$id;
        if ($embed != '' && !is_array($embed)) $url.= '?embed=' . urlencode($embed);
        elseif (is_array($embed)) {
            foreach ($embed as $key => $value) {
                $embed[$key] = urlencode($value);
            }
            $url.= '?embed[]=' . implode('&embed[]=', $embed);
        }
        return json_decode(file_get_contents($url), true);
    }
    function episode($id, $episode = '') {
        $url = 'http://api.tvmaze.com/shows/' . (int)$id . '/';
        if (preg_match('/s(\d\d?)e(\d\d?)/i', $episode, $match)) $url.= 'episodebynumber?season=' . (int)$match[1] . '&number=' . (int)$match[2];
        elseif ($this->isTimestampIsoValid($episode)) $url.= 'episodesbydate?date=' . $episode;
        else $url.= 'episodes';
        return json_decode(file_get_contents($url), true);
    }
    function cast($id) {
        return json_decode(file_get_contents('http://api.tvmaze.com/shows/' . (int)$id . '/cast'), true);
    }
    function akas($id) {
        return json_decode(file_get_contents('http://api.tvmaze.com/shows/' . (int)$id . '/akas'), true);
    }
    function person($id, $embed = '') {
        $url = 'http://api.tvmaze.com/people/' . (int)$id;
        if ($embed != '' && !is_array($embed)) $url.= '?embed=' . urlencode($embed);
        elseif (is_array($embed)) {
            foreach ($embed as $key => $value) {
                $embed[$key] = urlencode($value);
            }
            $url.= '?embed[]=' . implode('&embed[]=', $embed);
        }
        return json_decode(file_get_contents($url), true);
    }
    function credits($id, $type, $embed = '') {
        $url = 'http://api.tvmaze.com/people/' . (int)$id . '/' . urlencode($type) . 'credits';
        if ($embed != '' && !is_array($embed)) $url.= '?embed=' . urlencode($embed);
        elseif (is_array($embed)) {
            foreach ($embed as $key => $value) {
                $embed[$key] = urlencode($value);
            }
            $url.= '?embed[]=' . implode('&embed[]=', $embed);
        }
        return json_decode(file_get_contents($url), true);
    }
}
?>
