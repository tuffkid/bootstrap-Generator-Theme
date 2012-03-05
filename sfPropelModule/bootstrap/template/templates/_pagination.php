<div class="sf_admin_pagination">
    <ul>
    [?php if($pager->getPage() != 1) : ?]
        <li class="bg_pagerFirst">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1">
                <span></span>
                [?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/css/backend/icons/first.gif', array('alt' => __('First page', array(), 'sf_admin'), 'title' => __('First page', array(), 'sf_admin'))) ?]
            </a>
        </li>
        <li class="bg_pagerPrevious">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">
                <span></span>
                [?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/previous.png', array('alt' => __('Previous page', array(), 'sf_admin'), 'title' => __('Previous page', array(), 'sf_admin'))) ?]
            </a>
        </li>
    [?php else: ?]
        <li class="bg_pagerFirst">
            <a href="#" onclick="return false">
                <span></span>
            </a>
        </li>
        <li class="bg_pagerPrevious">
            <a href="#" onclick="return false">
                <span></span>
            </a>
        </li>
    [?php endif; ?]

    [?php foreach ($pager->getLinks() as $page): ?]
      [?php if ($page == $pager->getPage()): ?]
          <li class="bg_pagerItemActive"><span>[?php echo $page ?]</span></li>
      [?php else: ?]
          <li class="bg_pagerItem"><a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a></li>
      [?php endif; ?]
    [?php endforeach; ?]

    [?php if($pager->getPage() != $pager->getLastPage()) : ?]
        <li class="bg_pagerNext">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">
                <span></span>
                [?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/next.png', array('alt' => __('Next page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?]
            </a>
        </li>

        <li class="bg_pagerLast">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getLastPage() ?]">
                <span></span>
                [?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/last.png', array('alt' => __('Last page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?]
            </a>
        </li>
    [?php else: ?]
        <li class="bg_pagerNext">
            <a href="#" onclick="return false">
                <span></span>
                [?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/next.png', array('alt' => __('Next page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?]
            </a>
        </li>

        <li class="bg_pagerLast">
            <a href="#" onclick="return false">
                <span></span>
                [?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/last.png', array('alt' => __('Last page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?]
            </a>
        </li>
    [?php endif; ?]
    </ul>
</div>
