<!DOCTYPE html>
<html>
   <head>
      <title>HTML background music</title>
   </head>
   <body>
      <p>The music is running in the background.</p>
      <p>(Song: Kalimba which is provided as a Sample Music in Windows)</p>
      <embed src="{{ URL::asset("/storage/song.mp3  ") }}" loop="false" autostart="true" width="2"
         height="0">
   </body>
</html>