<!DOCTYPE html>
<html>
  <head>
    <title>PHP Google Text To Speech</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="x-cosmetics.css">
  </head>
  <body>
    <form method="post" target="_blank" action="voice-process.php">
      <label>Voice</label>
      <select name="voice"><?php
        $all = json_decode(file_get_contents("voices-filtered.json"), 1);
        foreach ($all as $v) {
          printf("<option value='%s@%s'>%s (%s)</option>",
            $v["code"], $v["name"],
            $v["name"], $v["gender"]
          );
        }
      ?></select>

      <label>Text</label>
      <textarea name="txt" required></textarea>

      <label>Rate</label>
      <input type="range" min="0.5" max="4.0" value="1" step="0.5" name="rate" oninput="this.nextElementSibling.value = this.value">
      <output class="hint">1</output>

      <label>Pitch</label>
      <input type="range" min="-20" max="20" value="0" step="1" name="pitch" oninput="this.nextElementSibling.value = this.value">
      <output class="hint">0</output>

      <label>Gain</label>
      <input type="range" min="-15" max="15" value="5" step="1" name="gain" oninput="this.nextElementSibling.value = this.value">
      <output class="hint">5</output>

      <input type="submit" value="Go!">
    </form>
  </body>
</html>