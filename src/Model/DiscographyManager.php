<?php

namespace App\Model;

class DiscographyManager extends AbstractManager
{
    public function selectAllAlbum(): array
    {
        $query = 'SELECT image, title, year, id FROM album';
          return $this->pdo->query($query)->fetchAll();
    }
    public function selectAllSongs(): array
    {
        $query = 'SELECT song.title, song.time, song.album_id FROM song INNER JOIN album ON album_id=album.id';
          return $this->pdo->query($query)->fetchAll();
    }
}
