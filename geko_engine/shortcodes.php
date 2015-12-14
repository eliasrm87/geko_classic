<?php

function the_content_filter($content) {
    // array of custom shortcodes requiring the fix 
    $block = join("|",array("col","row",/*"pie-chart",*/"image-box"/*, "image-box-pie-chart"*/));
    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
    return $rep;
}
add_filter("the_content", "the_content_filter");

function short_code_success($atts, $content = "")
{
    return '<div class="alert alert-success" role="alert">
                    ' . $content . '
                </div>';
}
add_shortcode('success', 'short_code_success');

function short_code_info($atts, $content = "")
{
    return '<div class="alert alert-info" role="alert">
                    ' . $content . '
                </div>';
}
add_shortcode('info', 'short_code_info');

function short_code_warning($atts, $content = "")
{
    return '<div class="alert alert-warning" role="alert">
                    ' . $content . '
                </div>';
}
add_shortcode('warning', 'short_code_warning');

function short_code_danger($atts, $content = "")
{
    return '<div class="alert alert-danger" role="alert">
                    ' . $content . '
                </div>';
}
add_shortcode('danger', 'short_code_danger'); 

function short_code_fotos( $atts, $content = "" ) {
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
add_shortcode( 'fotos', 'short_code_fotos' );


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

    $html = '<div class="embed-responsive embed-responsive-'.$aspect.'">
        <iframe class="embed-responsive-item"' . $options . '"></iframe>
    </div>';
    
    return $html;
}
add_shortcode( 'embed-responsive', 'short_code_embed_responsive' );

function short_code_row( $atts, $content = "" ) {
    $no_gutter='';
    $id='';
    $class='';
    $style='';

    foreach ($atts as $key => $value) {
        if ($key == 'no_gutter') {
            $class.='no-gutter ';
        } else if ($key == 'background') {
            $style.='background:'.$value.'; ';
        } else if ($key == 'padding-lr') {
            $style.='padding-left:'.$value.'px; padding-right:'.$value.'px; ';
        } else if ($key == 'id') {
            $id=$value;
        } else if ($key == 'class') {
            $class.=$value." ";
        } else if ($key == 'style') {
            $style.=$value . ' ';
        }
    }

    return '<div id="'.$id.'" class="row '.$class.'" style="'.$style.'">
               ' . do_shortcode($content) . '
            </div>';
}
add_shortcode( 'row', 'short_code_row' );

function short_code_col( $atts, $content = "" ) {
    $width_xs='12';
    $width_sm='4';
    $width_md='2';
    $width_lg='2';
    $style='';
    $class='';

    if (!empty($atts)) {
        foreach ($atts as $key => $value) {
            if ($key == 'width_xs') {
                $width_xs=$value;
            } else if ($key == 'width_sm') {
                $width_sm=$value;
            } else if ($key == 'width_md') {
                $width_md=$value;
            } else if ($key == 'width_lg') {
                $width_lg=$value;
            } else if ($key == 'width_auto') {
                $width_md=12/$value;
                $width_lg=$width_md;
                if ($width_md <= 3)
                    $width_sm=$width_md*2;
                else
                    $width_sm=$width_md;
                $width_xs='12';
            } else if ($key == 'class') {
                $class.=$value . ' ';
            } else if ($key == 'style') {
                $style.=$value . ' ';
            }
        }
    }
    
    $class.="col-xs-$width_xs col-sm-$width_sm col-md-$width_md col-lg-$width_lg";

    return '<div class="'.$class.'" style="'.$style.'">
                ' . do_shortcode($content) . '
            </div>';
}
add_shortcode( 'col', 'short_code_col' );

// function short_code_pie_chart( $atts, $content = null ) {
//     $percent='50';
//     $color='#000';
//     $subtitle='';
// 
//     foreach ($atts as $key => $value) {
//         if ($key == 'color') {
//             $color=$value;
//         } else if ($key == 'percent') {
//             $percent=$value;
//         } else if ($key == 'subtitle') {
//             $subtitle=$value;
//         }
//     }
// 
//     $html = '<div class="col-sm-4 col-md-2 text-center">
//         <span class="chart" style="color:'.$color.'" data-percent="'.$percent.'">
//             <span class="percent"></span>
//         </span>';
//     
//     if ($subtitle != '')
//         $html .= '<h3 class="text-center" style="color:'.$color.'">'.$subtitle.'</h3>';
//     
//     $html .= "</div>";
//     
//     return $html;
// }
// add_shortcode( 'pie-chart', 'short_code_pie_chart' );

function short_code_image_box( $atts, $content = "" ) {
    $doc = new DOMDocument();
    $doc->validateOnParse = false;
    $doc->loadHTML($content);
    $imageTags = $doc->getElementsByTagName('img')->item(1);

    $title='';
    $text='';
    $link='#';
    $style='';

    foreach ($atts as $key => $value) {
        if ($key == 'title') {
            $title=$value;
        } else if ($key == 'text') {
            $text=$value;
        } else if ($key == 'link') {
            $link=$value;
        } else if  ($key == 'bcolor') {
            $style.='background:'.$value.';';
        } else if ($key == 'color') {
            $style.='color:'.$value.';';
        }
    }
    
    $html = '<a href="'.$link.'" class="image-box">
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
    
    return $html;
}
add_shortcode( 'image-box', 'short_code_image_box' );


function short_code_page_content( $atts, $content = "" ) {
    return apply_filters('the_content', get_page($atts['id'])->post_content);
}
add_shortcode( 'page-content', 'short_code_page_content' );
