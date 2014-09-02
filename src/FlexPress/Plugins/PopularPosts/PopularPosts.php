<?php

namespace FlexPress\Plugins\PopularPosts;

use FlexPress\Plugins\AbstractPlugin;

class PopularPosts extends AbstractPlugin
{

    const META_NAME_PAGEVIEW_TOTAL = 'fppopularposts_total_page_views';
    const META_NAME_IPS_LOG = 'fppopularposts_pageview_ip_log';


    public function init($file)
    {
        parent::init($file);
        add_action('wp_footer', array($this, 'wpFooter'));
    }

    /**
     * Logs the page view if the viewers ip address has not already seen the page
     *
     * @author Tim Perry
     *
     */
    public function wpFooter()
    {

        global $post;

        // if the post id is available
        if (isset($post->ID)) {
            $this->incrementPageviewCount($post->ID);
        }

    }

    /**
     * Used to increment the pageview for a given post,
     * only update the pageview count once per ip
     *
     * @param $postId
     *
     * @author Tim Perry
     */
    public function incrementPageviewCount($postId)
    {

        $ip = $_SERVER['REMOTE_ADDR'];
        $ips = get_post_meta($postId, self::META_NAME_IPS_LOG, true);

        // if there no ips stored or the ip is has not seen the page before
        if (!$ips || (is_array($ips) && !in_array($ip, $ips))) {

            if (!$ips) {
                $ips = array();
            }

            $ips[] = $ip;

            update_post_meta($postId, self::META_NAME_IPS_LOG, $ips);

            // default is 1
            $newTotal = 1;

            // if we have an existing pageview count, simply add one to the total
            if ($old_total = get_post_meta($postId, self::META_NAME_PAGEVIEW_TOTAL, true)) {
                $newTotal = $old_total + 1;
            }

            // store the total
            update_post_meta($postId, self::META_NAME_PAGEVIEW_TOTAL, $newTotal);

        }

    }

}
