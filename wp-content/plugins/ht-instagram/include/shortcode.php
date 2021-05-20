<?php

    function htinstagram_shortcode( $atts ) {
        extract(shortcode_atts( array(
            'limit'         => 8
            ,'column'       => 4
            ,'space'        => 5
            ,'size'         => 'low_resolution'
            ,'showlike'     => 'no'
            ,'showcomment'  => 'no'
            ,'commentlike_pos'=> 'top'
            ,'showfollowbtn'=> 'yes'
            ,'followbtnpos' => 'bottom'
            ,'target'       => '_self'

            ,'slider_on'    => 'no'
            ,'slarrows'     => 'no'
            ,'slprevicon'   => 'fa fa-angle-left'
            ,'slnexticon'   => 'fa fa-angle-right'
            ,'sldots'       => 'no'
            ,'slautolay'    => 'yes'
            ,'slautoplay_speed'         => 3000
            ,'slanimation_speed'        => 300
            ,'slcentermode'             => 'no'
            ,'slcenterpadding'          => 0
            ,'slitems'                  => 4
            ,'slrows'                   => 2
            ,'slscroll_columns'         => 1
            ,'sltablet_width'           => 750
            ,'sltablet_display_columns' => 1
            ,'sltablet_scroll_columns'  => 1
            ,'slmobile_width'           => 480
            ,'slmobile_display_columns' => 1
            ,'slmobile_scroll_columns'  => 1

            ,'likecommentbg' => ''
            ,'commentlike_color' => ''
            ,'commentlike_font_size' => ''
            ,'follow_background' => ''
            ,'follow_buttoncolor' => ''
            ,'follow_button_f_s' => ''
            ,'follow_icon_color' => ''
            ,'follow_icon_background' => ''

        ), $atts ) );

        $htinfeed = new HTinstagram_feed();
        $profileinfo = $htinfeed->htinstagram_check_access_token();
        $itemarg = array(
            'limit' => $limit,
            'imagesize' => $size,
        );
        $instaitem = $htinfeed->htinstagram_items_feed( $itemarg );

        $unique_class = uniqid('instragram_style_');
        $instaclass = array( $unique_class, 'htinsta-instragram', 'htinsta-column-'.$column );

        $ulclass = array();
        $ulclass['class'] = 'htinstagram-list';
        if( $slider_on == 'yes' ){

            $ulclass['class'] = 'htinstagram-carousel';

            $slider_settings = [
                'arrows' => ( 'yes' === $slarrows ),
                'arrow_prev_txt' => $slprevicon,
                'arrow_next_txt' => $slnexticon,
                'dots' => ( 'yes' === $sldots ),
                'autoplay' => ( 'yes' === $slautolay ),
                'autoplay_speed' => absint( $slautoplay_speed ),
                'animation_speed' => absint( $slanimation_speed ),
                'center_mode' => ( 'yes' === $slcentermode ),
                'center_padding' => absint( $slcenterpadding ),
            ];

            $slider_responsive_settings = [
                'rows' => $slrows,
                'display_columns' => $slitems,
                'scroll_columns' => $slscroll_columns,
                'tablet_width' => $sltablet_width,
                'tablet_display_columns' => $sltablet_display_columns,
                'tablet_scroll_columns' => $sltablet_scroll_columns,
                'mobile_width' => $slmobile_width,
                'mobile_display_columns' => $slmobile_display_columns,
                'mobile_scroll_columns' => $slmobile_scroll_columns,
            ];

            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
        }

        // Register CSS and JS
        if( $slider_on == 'yes' ){
            wp_enqueue_style('slick');
            wp_enqueue_script('ht-active');
        }

        ob_start();
        $output = '';
        // custom style
        $output .= '<style>';
        $output .= ".$unique_class .instagram-like-comment{ background-color: $likecommentbg; }";
        $output .= ".$unique_class .instagram-like-comment span{ color: $commentlike_color; }";
        $output .= ".$unique_class .instagram-like-comment span{ font-size: ".$commentlike_font_size."px; }";
        $output .= ".$unique_class a.instagram_follow_btn{ background-color: $follow_background; }";
        $output .= ".$unique_class a.instagram_follow_btn{ color: $follow_buttoncolor; }";
        $output .= ".$unique_class a.instagram_follow_btn{ font-size: ".$follow_button_f_s."px; }";
        $output .= ".$unique_class a.instagram_follow_btn i{ color: $follow_icon_color; }";
        $output .= ".$unique_class a.instagram_follow_btn i{ background-color: $follow_icon_background; }";
        $output .= '</style>';

        ?>
            <div class="<?php echo implode(' ', $instaclass ); ?>" >
                <?php if ( isset( $instaitem ) && !empty($instaitem)) :?>

                    <?php if( $showfollowbtn == 'yes' && $followbtnpos == 'top' ): ?>
                        <a class="instagram_follow_btn <?php echo esc_attr( $followbtnpos );?>" href="<?php echo esc_url( $profileinfo['profilelink'] ); ?>" target="_blank">
                            <i class="fa fa-instagram"></i>
                            <span><?php echo esc_html__( 'Follow @ '.$profileinfo['username'], 'ht-instagram' );?></span>
                        </a>
                    <?php endif;?>

                    <ul class="<?php echo esc_attr( $ulclass['class'] ); ?>" style="<?php if( $slider_on != 'yes' ){ echo 'margin: 0 -'.$space.'px'; } ?>" data-settings='<?php if( $slider_on == 'yes' ){ echo wp_json_encode( $slider_settings ); }else{echo 'no-opt'; } ?>'>
                        <?php 
                            foreach ( $instaitem as $item ):
                                $items_link = $item['link'];
                        ?>
                            <li style="<?php echo 'padding: 0 '.$space.'px; margin-bottom: '.( $space*2 ).'px;';?>">
                                <div class="htinstagram_single_item">
                                    <a href="<?php echo esc_url( $items_link ); ?>" target="<?php echo esc_attr( $target );?>" >
                                        <img src="<?php echo esc_url( $item['imgsrc'] ); ?>" alt="<?php echo esc_html__( $profileinfo['fullname'], 'ht-instagram');?>">
                                    </a>
                                    
                                    <?php if( $showcomment == 'yes' || $showlike == 'yes' ) : ?>
                                        <div class="instagram-clip">
                                            <div class="htinstagram-content">
                                                <?php if( $showcomment == 'yes' || $showlike == 'yes' ): ?>
                                                    <div class="instagram-like-comment">
                                                        <?php
                                                            if( $showlike == 'yes' ){
                                                                echo '<span class="htins-like"><i class="fa fa-heart-o"></i>'.esc_html__($item['likes'],'ht-instagram').'</span>';
                                                            }
                                                            if( $showcomment == 'yes' ){
                                                                echo '<span class="htins-comment"><i class="fa fa-comment-o"></i>'.esc_html__($item['comments'],'ht-instagram').'</span>';
                                                            }
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif;?>

                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <?php if( $showfollowbtn == 'yes' && ( $followbtnpos == 'bottom' || $followbtnpos == 'middle' ) ): ?>
                    <a class="instagram_follow_btn <?php echo esc_attr( $followbtnpos );?>" href="<?php echo esc_url( $profileinfo['profilelink'] ); ?>" target="_blank">
                        <i class="fa fa-instagram"></i>
                        <span><?php echo esc_html__( 'Follow @ '.$profileinfo['username'], 'ht-instagram' );?></span>
                    </a>
                <?php endif; else:?>
                    <p class="htinsta-error">
                        <?php 
                            esc_html_e( 'Instagram Feed Not found Please enter valid Access Token.','ht-instagram' );
                            echo wp_kses_post( '(<a href="'.esc_url( admin_url().'admin.php?page=htinstagram' ).'" target="_blank">Enter Access Token</a>)', 'ht-instagram' );
                        ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php

        $output .= ob_get_clean();

        return $output;
    }
    add_shortcode( 'htinstagram', 'htinstagram_shortcode' );

?>