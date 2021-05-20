<?php

if( !class_exists( 'HTinstagram_feed' )){

    class HTinstagram_feed{

        // Profile Info from Access Token
        public function htinstagram_check_access_token(){

            $tokendata = array();
            $accesstoken = htinstagram_get_option( 'instagram_access_token','htinstagram_general_tabs' );
            $url = ! empty( $accesstoken ) ? 'https://api.instagram.com/v1/users/self/?access_token=' . $accesstoken : 'emptytoken';

            if ( $url !== 'emptytoken' ) {

                $args = array(
                    'timeout' => 60,
                    'sslverify' => false
                );
                $result = wp_remote_get( $url, $args );

                if ( ! is_wp_error( $result ) ) {

                    $data = json_decode( $result['body'] );
                    if ( isset( $data->data->id ) ) {
                        $tokendata['userid'] = $data->data->id;
                        $tokendata['username'] = $data->data->username;
                        $tokendata['fullname'] = $data->data->full_name;
                        $tokendata['profileimage'] = $data->data->profile_picture;
                        $tokendata['profilelink'] = 'https://www.instagram.com/'.$tokendata['username'];
                        $tokendata['itemscount'] = $data->data->counts->media;
                        $tokendata['follows'] = $data->data->counts->follows;
                        $tokendata['followed_by'] = $data->data->counts->followed_by;
                    } else {
                        if ( isset( $data->meta->error_message ) ) { $tokendata['itemserrormsg'] = $data->meta->error_message; }
                    }

                } else {
                    var_export( $result );
                }
            }else{
               $tokendata['validtoken'] = __('Please Enter Valid Access Token.','ht-instagram'); 
            }

            return $tokendata;
        }

        // Instagram Feed
        public function htinstagram_items_feed( $instafeedarg = array() ){

            if( !empty( $instafeedarg ) ){
                $imagesize  = $instafeedarg['imagesize'];
                $limit      = $instafeedarg['limit'];
            }else{
                $imagesize  = 'thumbnail';
                $limit      = 8;
            }

            $datainfo = $this->htinstagram_check_access_token();
            $token = htinstagram_get_option( 'instagram_access_token','htinstagram_general_tabs' );

            $id = isset( $datainfo['userid'] ) ? $datainfo['userid'] : '';

            $response = wp_remote_get( 'https://api.instagram.com/v1/users/' . esc_attr( $id ) . '/media/recent/?access_token=' . esc_attr( $token ) . '&count=' . esc_attr( $limit ) );

            $items = $profileinfo = array();        
            if ( ! is_wp_error( $response ) ) {
                $response_body = json_decode( $response['body'] );
                if( isset( $response_body->data ) ){
                    $items_as_objects = $response_body->data;
                    foreach ( $items_as_objects as $item_object ) {
                        $item['link']           = $item_object->link;
                        $item['imgsrc']         = $item_object->images->$imagesize->url;
                        $item['imgfullsrc']     = $item_object->images->standard_resolution->url;
                        $item['comments']       = $item_object->comments->count;
                        $item['likes']          = $item_object->likes->count;
                        $items[]      = $item;
                    }
                }
            }
            return $items;
        }

    }

}


?>