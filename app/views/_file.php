<h3>
  <a href="<?php echo $file->user_id; ?>" class="user"><?php echo get_username($file->user_id); ?></a>
  <span class="meta"><?php echo elapsed_time($file->created); ?></span>
</h3>
<?php if (preg_match('/^image/', $file->type)) { ?>
  <?php $href = ($params['view'] == 'detail') ? "uploads/$file->path" : $file->id; ?>
  <a href="<?php echo $href ?>"><?php echo htmlentities($file->name); ?></a>
  <span class="meta"><?php echo substr($file->path, -3, 3); ?></span>
  <?php
  
  $filename = GRID_DIR . "/public/uploads/$file->path";
  $backup_filename = str_replace('uploads', 'uploads.bak', $filename);
  if (!file_exists($filename) && file_exists($backup_filename)) {
    $uploads_dir = dirname($filename);
    if (!file_exists($uploads_dir)) {
      mkdir($uploads_dir);
    }
    copy($backup_filename, $filename);
  }
  if (file_exists($filename)) {
    list($orig_width, $orig_height) = getimagesize($filename);
    $width = $orig_width;
    $height = $orig_height;
    $alt = htmlentities($file->name);
    if ($params['view'] == 'detail') {
      if ($width > 472) {
        $width = 472;
        $height = round($width / ($orig_width / $orig_height));
      }
    } else if ($width > 150) {
      $width = 150;
      $height = round($width / ($orig_width / $orig_height));
      if ($height > 150) {
        $height = 150;
        $width = round($height / ($orig_height / $orig_width));
      }
    }
    ?>
    <a href="<?php echo $href; ?>">
      <?php echo "<img src=\"uploads/$file->path\" alt=\"$alt\" width=\"$width\" height=\"$height\" class=\"upload\" />\n"; ?>
    </a>
  <?php
  
  } else {
    echo '<p class="missing-image">(no image)</p>';
  }
  
  ?>
<?php } else { ?>
  <a href="uploads/<?php echo $file->path ?>"><?php echo htmlentities($file->name); ?></a>
  <span class="meta"><?php echo substr($file->path, -3, 3); ?></span>
<?php } ?>
