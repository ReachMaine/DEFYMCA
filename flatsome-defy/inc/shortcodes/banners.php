<?php
/* mods 16Feb15 zig add target parameter for link */
// [ux_banner]
function uxbannerShortcode( $atts, $content = null ){
  global $flatsome_opt;
  $bannerid = rand();
  extract( shortcode_atts( array(
    'text_pos' => 'center',
    'height' => '300px',
    'text_color' => 'light',
    'link' => '',
    'text_width' => '60%',
    'text_align' => 'center',
    'text_box' => '',
    'animation' => 'fadeIn',
    'animation_duration' => '',
    'effect' => '',
    'video_mp4' => '',
    'video_ogg' => '',
    'video_webm' => '',
    'video_sound' => 'false',
    'hover' => '',
    'bg' => '', 
    'parallax' => '',
    'parallax_text' => '',
    'text_bg' => '',
    'text_bg_opacity' => '0.8',
    'padding' => '30px',
    'callout' => '',
    'callout_size' => 'small',
    'data_height' => '',
    'target' => '',
  ), $atts ) );

  ob_start();

  // replace ___ with a nice divider
  $fix = array (
                '&nbsp;' => '', 
                '<p></p>' => '', 
                '<p>[' => '[', 
                ']</p>' => ']', 
                ']<br />' => ']',
                '_____' => '<div class="tx-div large"></div>',
                '____' => '<div class="tx-div medium"></div>',
                '___' => '<div class="tx-div small"></div>',
  );
   $content = strtr($content, $fix);

   $content = do_shortcode( $content ); 

   $img_link = get_template_directory_uri().'/img/';

   $color = "light";
   if($text_color == 'light') $color = "dark";

   if($hover) $hover = 'hover_'.$hover;

   $animated = "";
   if($animation != "none") $animated = "animated";

   $start_link = "";
   $end_link = "";
   if($link) {$start_link = '<a href="'.$link.'"';
            if ($target) {
              $start_link .= ' target="'.$target.'" ';
            }
      $start_link .= '>';
      $end_link = '</a>';};

   $background = "";
   $background_color = "";
    if (strpos($bg,'http://') !== false || strpos($bg,'https://') !== false) {
      $background = $bg;
    }
    elseif (strpos($bg,'#') !== false) {
      $background_color = 'background-color:'.$bg.'!important';
    }
     else {
      $bg = wp_get_attachment_image_src($bg, 'large');
      $background = $bg[0];
    }

   $textalign = "";
   if($text_align) {$textalign = "text-".$text_align;}

   /* set rgba background */
   if($text_bg){$text_bg = hex2rgba($text_bg,$text_bg_opacity); };
    
   $parallax_class = '';
   if($parallax){$parallax_class = 'ux_parallax'; $parallax='data-velocity="'.(intval($parallax)/10).'"';} 
 
   $text_parallax_class = '';
   if($parallax_text){$text_parallax_class = 'parallax_text'; $parallax_text='data-velocity="'.(intval($parallax_text)/10).'"';} 
 
  ?>
  
   <div id="banner_<?php echo $bannerid; ?>" class="ux_banner <?php if($text_box)echo 'ux-textbox-'.$text_box; ?> <?php echo $color; ?> <?php echo $hover; ?>"  style="height:<?php echo $height; ?>" data-height="<?php echo $height; ?>" role="banner">
      <?php echo $start_link; ?>
       <div class="banner-bg zig <?php echo $parallax_class; ?>"  <?php echo $parallax; ?> style="background-image:url(<?php echo $background; ?>); <?php echo $background_color; ?>"></div>
       <?php if($video_mp4 || $video_webm || $video_ogg){ ?>
       <div class="video-overlay" style="position:absolute;top:0;bottom:0;right:0;left:0;z-index:2;background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6N0IxQjNGRDQ0QUMxMTFFMzhBQzM5OUZBMEEzN0Y1RUUiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6N0IxQjNGRDU0QUMxMTFFMzhBQzM5OUZBMEEzN0Y1RUUiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpFN0M5QzFENzRBQTcxMUUzOEFDMzk5RkEwQTM3RjVFRSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpFN0M5QzFEODRBQTcxMUUzOEFDMzk5RkEwQTM3RjVFRSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PhPF5GwAAAAYSURBVHjaYmJgYPD6//8/AyOIAAGAAAMAPRIGSKhmMMMAAAAASUVORK5CYII=');"></div>
       <video class="ux-banner-video hide-for-small" <?php echo $parallax; ?>  style="position:absolute;top:0;left:0;bottom:0;right:0;min-width: 100%;min-height: 100%;z-index:1;" poster="<?php echo $background; ?>" preload="auto" autoplay="" loop="loop" <?php if($video_sound == 'false') echo "muted='muted'"; ?>>
            <source src="<?php echo $video_mp4; ?>" type="video/mp4">
            <source src="<?php echo $video_webm; ?>" type="video/webm">
            <source src="<?php echo $video_ogg; ?>" type="video/ogg">
        </video>
      <?php } ?>
       <?php if($effect){ ?>
          <div class="banner-effect"></div>
       <?php } ?>
        <div class="row parallax_text <?php echo $text_parallax_class; ?>" <?php echo $parallax_text; ?>>
          <div class="inner <?php echo $text_pos; ?>  <?php echo $animated; ?>  <?php echo $textalign; ?> <?php if($text_box){echo 'text-boxed';} ?>
" data-animate="<?php echo $animation; ?>" style="width:<?php echo $text_width; ?>;  <?php if($text_bg){echo 'background-color:'.$text_bg.';';} ?> <?php if($text_bg){echo 'padding:'.$padding;} ?>">
           <?php echo $content; ?>
           <?php if($callout) { ?> 
                <div class="callout <?php echo $flatsome_opt['bubble_style']; ?>">
                    <div class="inner">
                      <div class="inner-text"><?php echo $callout; ?></div>
                    </div>
               </div><!-- end callout -->
           <?php } ?>
          </div>  
        </div>
       <?php echo $end_link; ?>
       <?php if($animation_duration){ ?><style>#banner_<?php echo $bannerid; ?> .inner{ animation-duration:<?php echo $animation_duration; ?> ; -webkit-animation-duration:<?php echo $animation_duration; ?> ; -moz-animation-duration:<?php echo $animation_duration; ?> ; -o-animation-duration:<?php echo $animation_duration; ?>; } </style><?php } // End animation duration ?>

<?php // EFFECTS // ?>
<?php if($effect){ ?>
<?php if($effect === 'snow'){ ?>
<style>
@keyframes snow { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
}
@-moz-keyframes snow { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
}
@-webkit-keyframes snow { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% {background-position: 500px 1000px, 400px 400px, 300px 300px;
    }
}
@-ms-keyframes snow { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
}
#banner_<?php echo $bannerid; ?> .banner-effect {
    background-image:url('<?php echo get_template_directory_uri(); ?>/css/effects/snow1.png'),
   url('<?php echo get_template_directory_uri(); ?>/css/effects/snow2.png');     
      -webkit-animation: snow 20s linear infinite;
    -moz-animation: snow 20s linear infinite;
    -ms-animation: snow 20s linear infinite;
    animation: snow 20s linear infinite;
}
</style>
<?php } // End snow effect ?>


<?php if($effect === 'confetti'){ ?>
<style>
@keyframes confetti { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
}
@-moz-keyframes confetti { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
}
@-webkit-keyframes confetti { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% {background-position: 500px 1000px, 400px 400px, 300px 300px;}
}
@-ms-keyframes confetti { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }

    100% { background-position: 500px 1000px, 400px 400px, 300px 300px }
}
#banner_<?php echo $bannerid; ?> .banner-effect {
   background-image:url('<?php echo get_template_directory_uri(); ?>/css/effects/confetti1.png'),
   url('<?php echo get_template_directory_uri(); ?>/css/effects/confetti2.png');  
    -webkit-animation: confetti 10s linear infinite;
    -moz-animation: confetti 10s linear infinite;
    -ms-animation: confetti 10s linear infinite;
    animation: confetti 10s linear infinite;
}
</style>
<?php } // End confetti effect ?>

<?php if($effect === "sliding-glass"){ ?>
<style>
@keyframes glass { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: 500px 1000px, 400px 400px}
}
@-moz-keyframes glass { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }

    100% { background-position: 500px 1000px, 400px 400px}
}
@-webkit-keyframes glass { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% {background-position: 500px 1000px, -400px -400px; }
}
@-ms-keyframes glass { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: 500px 1000px, 400px 400px }
}
#banner_<?php echo $bannerid; ?> .banner-effect {
   background-image:url('<?php echo get_template_directory_uri(); ?>/css/effects/glass1.png'),
   url('<?php echo get_template_directory_uri(); ?>/css/effects/glass2.png');  
    -webkit-animation: glass 30s linear infinite;
    -moz-animation: glass 30s linear infinite;
    -ms-animation: glass 30s linear infinite;
    animation: glass 30s linear infinite;
}
</style>
<?php } // End sliding glass effect ?>


<?php if($effect === 'sparkle'){ ?>
<style>
@keyframes sparkle { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: -500px -1000px, -400px -400px, 300px 300px }
}
@-moz-keyframes sparkle { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: -500px -1000px, -400px -400px, 300px 300px }
}
@-webkit-keyframes sparkle { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% {background-position: -500px -1000px, -200px -400px, 300px 300px;
    }
}
@-ms-keyframes sparkle { 
    0% { background-position: 0px 0px, 0px 0px, 0px 0px }
    100% { background-position: -500px -1000px, -400px -400px, 300px 300px }
}
#banner_<?php echo $bannerid; ?> .banner-effect {
   background-image:url('<?php echo get_template_directory_uri(); ?>/css/effects/sparkle1.png'),
   url('<?php echo get_template_directory_uri(); ?>/css/effects/sparkle2.png');
    -webkit-animation: sparkle 60s linear infinite;
    -moz-animation: sparkle 60s linear infinite;
    -ms-animation: sparkle 60s linear infinite;
    animation: sparkle 60s linear infinite;
}
</style>
<?php } // End sparkle effect ?>



<?php if($effect === 'rain'){ ?>
<style>
@keyframes rain { 
    0% { background-position: 0px 0px }
    100% { background-position: 500px 1000px }
}
@-moz-keyframes rain { 
    0% { background-position: 0px 0px }
    100% { background-position: 500px 1000px }
}
@-webkit-keyframes rain { 
    0% { background-position: 0px 0px }
    100% {background-position: 500px 1000px;
    }
}
@-ms-keyframes rain { 
    0% { background-position: 0px 0px}
    100% { background-position: 500px 1000px}
}
#banner_<?php echo $bannerid; ?> .banner-effect {
    background-image:url('<?php echo get_template_directory_uri(); ?>/css/effects/rain.png');
    -webkit-animation: rain 2s linear infinite;
    -moz-animation: rain 2s linear infinite;
    -ms-animation: rain 2s linear infinite;
    animation: rain 2s linear infinite;
}
</style>
<?php } // End sparkle effect ?>
<?php } ?>



</div><!-- end .ux_banner -->

<?php 

  $content = ob_get_contents();
  ob_end_clean();
  return $content;
 
}
add_shortcode('ux_banner', 'uxbannerShortcode');

// [ux_text]
function uxTextShortcode( $atts, $content = null ){
  global $flatsome_opt;
  extract( shortcode_atts( array(
    'text_pos' => 'center',
    'height' => '350px',
    'text_align' => 'left',
    'text_color' => 'light',
    'padding' => '50px',
  ), $atts ) );
  ob_start();
   $textalign = "";
   if($text_align) {$textalign = "text-".$text_align;}
   $color = "light";
   if($text_color == 'light') $color = "dark";

?>
<div class="ux_text <?php echo $text_pos; ?> <?php echo $color; ?> <?php echo $textalign; ?>" style="height:<?php echo $height; ?>">
    <div class="inner" style="padding-left:<?php echo $padding; ?>;padding-right:<?php echo $padding; ?>;">
      <?php echo do_shortcode($content); ?>
    </div>
  </div><!-- end .ux_text -->
<?php 
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode('ux_text', 'uxTextShortcode');
