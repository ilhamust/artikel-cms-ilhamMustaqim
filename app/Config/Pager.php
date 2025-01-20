<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Templates
     * --------------------------------------------------------------------------
     *
     * Pagination links are rendered out using views to configure their
     * appearance. This array contains aliases and the view names to
     * use when rendering the links.
     *
     * Within each view, the Pager object will be available as $pager,
     * and the desired group as $pagerGroup;
     *
     * @var array<string, string>
     */
    public array $templates = [
        'default_full'   => 'CodeIgniter\Pager\Views\default_full',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'default_head'   => 'CodeIgniter\Pager\Views\default_head',
        'bootstrap_full' => 'App\Views\Pagers\bootstrap_full',
    ];
    public $bootstrap_full = [
        'full'      => '<nav><ul class="pagination justify-content-end">{links}</ul></nav>',
        'active'    => '<li class="page-item active"><span class="page-link">{text}</span></li>',
        'disabled'  => '<li class="page-item disabled"><span class="page-link">{text}</span></li>',
        'previous'  => '<li class="page-item"><a href="{uri}" class="page-link">{text}</a></li>',
        'next'      => '<li class="page-item"><a href="{uri}" class="page-link">{text}</a></li>',
        'page'      => '<li class="page-item"><a href="{uri}" class="page-link">{text}</a></li>',
    ];
    
    /**
     * --------------------------------------------------------------------------
     * Items Per Page
     * --------------------------------------------------------------------------
     *
     * The default number of results shown in a single page.
     */
    public int $perPage = 20;
}
