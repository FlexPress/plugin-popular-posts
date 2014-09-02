<?php

namespace FlexPress\Plugins\PopularPosts\DependencyInjection;

use FlexPress\Plugins\PopularPosts\PopularPosts;

class DependencyInjectionContainer extends \Pimple
{

    public function init()
    {
        $this['PopularPosts'] = function () {
            return new PopularPosts();
        };
    }
}
