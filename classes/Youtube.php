<?php 

 class Youtube {
    public function getYoutubeId($url) {
        $id = '';
        $matchedUrl = '';

        preg_match('/v=([A-Za-z0-9_-]+)/', (string) $url, $matches);
        if (!empty($matches[1])) {
            $id = $matches[1];
            $matchedUrl = $url;
        } else {
            preg_match('/youtu\.be\/([A-Za-z0-9_-]+)/', (string) $url, $matches);
            if (!empty($matches[1])) {
                $id = $matches[1];
                $matchedUrl = $url;
            } else {
                preg_match('/\/shorts\/([A-Za-z0-9_-]+)/', (string) $url, $matches);
                if (!empty($matches[1])) {
                    $id = $matches[1];
                    $matchedUrl = "https://www.youtube.com/embed/" . $id;
                }
            }
        }

        // No recognised YouTube pattern matched — don't pass the raw input
        // through, it may be attacker- or author-supplied and unsafe to output.
        if ($id === '') {
            return (object) [
                'url' => '',
                'id' => ''
            ];
        }

        return (object) [
            'url' => $matchedUrl,
            'id' => $id
        ];
    }
 }