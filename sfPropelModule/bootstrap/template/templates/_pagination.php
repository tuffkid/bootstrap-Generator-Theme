<div class="pagination pagination-right">
    <ul>
        <li>
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">
                <i class="icon-chevron-left"></i>
            </a>
        </li>

        [?php foreach ($pager->getLinks() as $page): ?]
            <li class="[?php $page == $pager->getPage() and print 'active'; ?]">
                <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a>
            </li>
        [?php endforeach; ?]

        <li>
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">
                <i class="icon-chevron-right"></i>
            </a>
        </li>
    </ul>
</div>
