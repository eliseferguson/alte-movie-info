<h2>Movie:</h2>

<p>
  <label>Title</label>
  <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
  <label>Show Plot?</label>
  <input type="checkbox" name="<?php echo $this->get_field_name('show_plot'); ?>" value="1" <?php checked( $show_plot, 1 ); ?> />
</p>

<p>
  <label>Show Poster?</label>
  <input type="checkbox" name="<?php echo $this->get_field_name('show_poster'); ?>" value="1" <?php checked( $show_poster, 1 ); ?> />
</p>
<!-- Poster Size -->
<p>
  <label>Link to IMDb?</label>
  <input type="checkbox" name="<?php echo $this->get_field_name('link_imdb'); ?>" value="1" <?php checked( $link_imdb, 1 ); ?> />
</p>

<p>
  <label>Link to Trailer?</label>
  <input type="checkbox" name="<?php echo $this->get_field_name('link_trailer'); ?>" value="1" <?php checked( $link_trailer, 1 ); ?> />
</p>
