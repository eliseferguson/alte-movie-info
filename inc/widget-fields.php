<p>
  <label>Title</label> 
  <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
  <label>Show Plot?</label> 
  <input type="checkbox" name="<?php echo $this->get_field_name('show_plot'); ?>" value="1" <?php checked( $show_plot, 1 ); ?> />
</p>