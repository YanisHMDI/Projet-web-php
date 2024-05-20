// script.js

function addSong() {
    const songInput = document.getElementById('song-input');
    const songName = songInput.value.trim();

    if (songName) {
        const songList = document.getElementById('playlist-list');
        const songItem = document.createElement('li');
        songItem.textContent = songName;
        
        const favButton = document.createElement('button');
        favButton.textContent = '❤';
        favButton.onclick = function() {
            addToFavorites(songName);
        };

        songItem.appendChild(favButton);
        songList.appendChild(songItem);
        
        songInput.value = '';
    }
}

function addToFavorites(songName) {
    const favoritesList = document.getElementById('favorites-list');
    const favoriteItem = document.createElement('li');
    favoriteItem.textContent = songName;
    favoritesList.appendChild(favoriteItem);
}
