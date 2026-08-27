<?php 

 class Youtube {
    public function getYoutubeId($url) {
        $id = '';

        preg_match('/v=([^&]*)/', $url, $matches);
        if (!empty($matches[1])) {
            $id = $matches[1];
        } else {
            preg_match('/youtu.be\/([^?]+)/', $url, $matches);
            if (!empty($matches[1])) {
                $id = $matches[1];
            } else {
                preg_match('/\/shorts\/([^?]+)/', $url, $matches);
                if (!empty($matches[1])) {
                    $id = $matches[1];
                    $url = "https://www.youtube.com/embed/" . $id;
                }
            }
        }

        return (object) [
            'url' => $url,
            'id' => $id
        ];
    }
 }