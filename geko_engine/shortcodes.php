<?php

function the_content_filter($content) {
    // array of custom shortcodes requiring the fix 
    $block = join("|",array("col","row","image-box"));
    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
    return $rep;
}
add_filter("the_content", "the_content_filter");

function short_code_alert($atts, $content = "")
{
    //success, info, warning, danger
    return '<div class="alert alert-'.$atts['type'].'" role="alert">' . $content . '</div>';
}
add_shortcode('alert', 'short_code_alert');

function short_code_geko_gallery( $atts, $content = "" ) {
    $doc = new DOMDocument();
    $doc->validateOnParse = false;
    $doc->loadHTML($content);
    $imageTags = $doc->getElementsByTagName('img');
    
    $id = uniqid("carousel-");

    $html = 
    '<div id="'.$id.'" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">';
        
    $active = 'active';
    $nb = $imageTags->length;
    for($pos=0; $pos<$nb; $pos++) {
        $html .= '
            <li data-target="#'.$id.'" data-slide-to="'.$pos.'" class="'.$active.'"></li>';
        $active = '';
    }
        
    $html .= '
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">';
        
    $active = 'active';
    foreach($imageTags as $tag) {
        $html .= '
            <div class="item '.$active.'">
                <img src="'.$tag->getAttribute('src').'" alt="'.$tag->getAttribute('alt').'">
                <div class="carousel-caption">
                '.$tag->getAttribute('title').'
                </div>
            </div>';
        $active = '';
    }

    $html .= '
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#'.$id.'" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#'.$id.'" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>';
    
    return $html;
}
add_shortcode( 'geko-gallery', 'short_code_geko_gallery' );


function short_code_embed_responsive( $atts, $content = null ) {

    $options = "";
    $aspect="16by9";
    
    foreach ($atts as $key => $value) {
        if ($key == 'aspect') {
            if ($value == "4:3")
                $aspect = "4by3";
        } else {
            $options = $options . " " . $key . '="' . $value . '"';
        }
    }

    return '<div class="embed-responsive embed-responsive-'.$aspect.'">
        <iframe class="embed-responsive-item"' . $options . '"></iframe>
    </div>';
}
add_shortcode( 'embed-responsive', 'short_code_embed_responsive' );

function short_code_row( $atts, $content = "" ) {
    $atts = shortcode_atts( array(
        "no_gutter"     => false,
        "background"    => false,
        "padding-lr"    => false,
        "id"            => false,
        "class"         => false,
        "style"         => false
    ), $atts );


    $id='';
    $class='';
    $style='';

    if ($atts['no_gutter']) {
        $class.='no-gutter ';
    }
    if ($atts['background']) {
        $style.='background:'.$atts['background'].'; ';
    }
    if ($atts['padding-lr']) {
        $style.='padding-left:'.$atts['padding-lr'].'px; padding-right:'.$atts['padding-lr'].'px; ';
    }
    if ($atts['id']) {
        $id=$atts['id'];
    }
    if ($atts['class']) {
        $class.=$atts['class'].' ';
    }
    if ($atts['style']) {
        $style.=$atts['style'].' ';
    }

    return '<div id="'.$id.'" class="row '.$class.'" style="'.$style.'">
               ' . do_shortcode($content) . '
            </div>';
}
add_shortcode( 'row', 'short_code_row' );

function short_code_col( $atts, $content = "" ) {
    $atts = shortcode_atts( array(
        "width_xs"      => false,
        "width_sm"      => false,
        "width_md"      => false,
        "width_lg"      => false,
        "width_auto"    => false,
        "class"         => false,
        "style"         => false
    ), $atts );

    $width_xs='12';
    $width_sm='4';
    $width_md='2';
    $width_lg='2';
    $style='';
    $class='';

    if ($atts['width_xs']) {
        $width_xs=$atts['width_xs'];
    }
    if ($atts['width_sm']) {
        $width_sm=$atts['width_sm'];
    }
    if ($atts['width_md']) {
        $width_md=$atts['width_md'];
    }
    if ($atts['width_lg']) {
        $width_lg=$atts['width_lg'];
    }
    if ($atts['width_auto']) {
        $width_md=12/$atts['width_auto'];
        $width_lg=$width_md;
        if ($width_md <= 3)
            $width_sm=$width_md*2;
        else
            $width_sm=$width_md;
        $width_xs='12';
    }
    if ($atts['class']) {
        $class.=$atts['class'] . ' ';
    }
    if ($atts['style']) {
        $style.=$atts['style'] . ' ';
    }
    
    $class.="col-xs-$width_xs col-sm-$width_sm col-md-$width_md col-lg-$width_lg";

    return '<div class="'.$class.'" style="'.$style.'">
                ' . do_shortcode($content) . '
            </div>';
}
add_shortcode( 'col', 'short_code_col' );

function short_code_image_box( $atts, $content = "" ) {
    $atts = shortcode_atts( array(
        "title"     => false,
        "text"      => false,
        "link"      => false,
        "bcolor"    => false,
        "color"     => false
    ), $atts );


    $doc = new DOMDocument();
    $doc->validateOnParse = false;
    $doc->loadHTML($content);
    $imageTags = $doc->getElementsByTagName('img')->item(1);

    if (!$imageTags)
        return '';
    
    $title='';
    $text='';
    $link='#';
    $style='';

    if ($atts['title']) {
        $title=$atts['title'];
    }
    if ($atts['text']) {
        $text=$atts['text'];
    }
    if ($atts['link']) {
        $link=$atts['link'];
    }
    if  ($atts['bcolor']) {
        $style.='background:'.$atts['bcolor'].';';
    }
    if ($atts['color']) {
        $style.='color:'.$atts['color'].';';
    }
    
    return '<a href="'.$link.'" class="image-box">
                <img src="'.utf8_decode($imageTags->getAttribute('src')).'" alt="'.utf8_decode($imageTags->getAttribute('alt')).'" class="img-responsive">
                <div class="image-box-caption" style="'.$style.';">
                    <div class="image-box-caption-content">
                        <div class="project-category text-faded">
                            '.$title.'
                        </div>
                        <div class="project-name">
                            '.$text.'
                        </div>
                    </div>
                </div>
            </a>';
}
add_shortcode( 'image-box', 'short_code_image_box' );

function geko_collapse( $atts, $content = null ) {
    $atts = shortcode_atts( array(
      "title"   => '',
      "type"    => 'default',
      "active"  => false,
      "class"   => ''
    ), $atts );
      
    $collapse_class = '';
    $a_class = '';
    if ($atts['active'] == 'true') {
        $collapse_class .= 'in';
    } else {
        $a_class = 'collapsed';
    }

    $collapse_id = uniqid();

    return '<div class="panel panel-' . $atts['type'] . ' ' . $atts['class'].'">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="'.$a_class.'" data-toggle="collapse" href="#'.$collapse_id.'">'.$atts['title'].'</a>
                    </h4>
                </div>
                <div id="'.$collapse_id.'" class="panel-collapse collapse '.$collapse_class.'">
                    <div class="panel-body">'.do_shortcode($content).'</div>
                </div>
            </div>';
}
add_shortcode( 'collapse', 'geko_collapse' );

function short_code_page_content( $atts, $content = "" ) {
    $atts = shortcode_atts( array(
        "id" => false
    ), $atts );
    
    if ($atts['id'])
        return apply_filters('the_content', get_page($atts['id'])->post_content);
    else
        return '';
}
add_shortcode( 'page-content', 'short_code_page_content' );
