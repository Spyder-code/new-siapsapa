<html>
  <body>
    <div id="playerContainer"></div>
    <script src="https://cdn.jsdelivr.net/npm/indigo-player@1/lib/indigo-player.js"></script>
    <script>
        const config = {
            sources: [
            {
                type: 'mp4',
                src: 'http://127.0.0.1:8000/storage/videos/pesan-kta.mp4',
            }
            ],
        };

        const element = document.getElementById('playerContainer');
        const player = IndigoPlayer.init(element, config);

      // You can use the player object now to access the player and it's methods (play, pause, ...)
    </script>
    </body>
</html>
