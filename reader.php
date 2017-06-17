<?php
if ($_GET['action'] == 'scan') {
  echo json_encode(scanRepo());
}

function scanRepo() {
    $files = scandir("Files");

    $lastAuthor = '';
    $lastTitle = '';
    $new = null;
    $first = true;
    $fileNames = array();

    $songs = array();

    foreach ($files as $key => $value) {
        $track = explode(" - ", $value);
        if($track[2] !== null) {
            $author = $track[0];
            $song = $track[1];

            if(($lastAuthor == $author && $lastTitle == $song) || $first) {
                $fileNames[] = $value;
            } else if($new !== null) {
                $songs[] = $new;
                $fileNames = array();
                $fileNames[] = $value;
            }

            $new = array(
                'author' => $author,
                'title' => $song,
                'files' => $fileNames
            );

            $lastAuthor = $author;
            $lastTitle = $song;
            $first = false;
        }
    }

    return $songs;
}

function getSongFiles($author, $title) {
    $songs = scanRepo();

    foreach ($songs as $song) {
        if($song['author'] == $author && $song['title'] == $title) {
            return $song['files'];
        }
    }
}

function filterByAuthor($author) {
    $songs = scanRepo();

    $result = array();
    foreach ($songs as $song) {
        if($song['author'] == $author) {
            $result[] = $song;
        }
    }

    return $result;
}

?>
