<?php
/**
 * Model
 *
 * Breadcrumbs
 * 面包屑导航
 *
 * @author liyan
 * @since Tue May 14 07:18:45 GMT 2013
 */
class MBreadcrumbs {

    private $breadcrumbs;

    function __construct() {
        $this->breadcrumbs = array();
    }

    /**
     * @return MBreadcrumbs
     */
    public static function breadcrumbs() {
    	return new MBreadcrumbs();
    }

    public function addCrumb($title, $linkurl, $icon = null) {
        $crumb = $this->crumb($title, $linkurl, $icon);
        array_push($this->breadcrumbs, $crumb);
    }

    protected function crumb($title, $linkurl, $icon) {
        $crumb = array(
            'title' => $title,
            'linkurl' => $linkurl,
            'icon' => $icon,
        );
        return $crumb;
    }

    public function getBreadcrumbs() {
    	return $this->breadcrumbs;
    }

}
