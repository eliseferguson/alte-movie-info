<?php

class Alte_Updater {
  protected $file;
  protected $plugin;
  protected $basename;
  protected $active;
  
  public function __construct( $file ) {
    $this-&gt;file = $file;
    add_action( 'admin_init', array( $this, 'set_plugin_properties' ) );
    return $this;
  }
  
  public function set_plugin_properties() {
    $this-&gt;plugin   = get_plugin_data( $this-&gt;file );
    $this-&gt;basename = plugin_basename( $this-&gt;file );
    $this-&gt;active   = is_plugin_active( $this-&gt;basename );
  }
}