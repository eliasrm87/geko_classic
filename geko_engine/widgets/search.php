<?php

class Geko_Search_Widget extends WP_Widget {

    /**
    * Register widget with WordPress.
    */
    function __construct() {
        parent::__construct(
            'geko_search_widget', // Base ID
            __( 'Search', 'geko' ), // Name
            array( 'description' => __( 'Search Widget', 'geko' ), ) // Args
        );
    }

    /**
    * Front-end display of widget.
    *
    * @see WP_Widget::widget()
    *
    * @param array $args     Widget arguments.
    * @param array $instance Saved values from database.
    */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }
        ?>
        <form role="search" method="get" action="/" style="padding-top: 15px;">
        <div class="input-group">
            <input type="search" class="form-control" name="s" title="Buscar:" placeholder="<?php echo __( 'Buscar en el sitio...', 'geko'); ?>">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </span>
        </div>
        </form>
        <?php
        echo $args['after_widget'];
    }

    /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param array $instance Previously saved values from database.
    */
    public function form( $instance ) {
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <?php 
    }

    /**
    * Sanitize widget form values as they are saved.
    *
    * @see WP_Widget::update()
    *
    * @param array $new_instance Values just sent to be saved.
    * @param array $old_instance Previously saved values from database.
    *
    * @return array Updated safe values to be saved.
    */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

}

//register Geko_Search_Widget widget
function register_geko_search_widget() {
    register_widget( 'Geko_Search_Widget' );
}
add_action( 'widgets_init', 'register_geko_search_widget' );
