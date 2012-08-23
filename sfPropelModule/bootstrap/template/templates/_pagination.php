<div class="pagination pagination-right">
    <ul>
        <li class="[?php ($pager->getFirstPage() == $pager->getPage()) and print 'disabled'; ?]">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1">
                erstes
            </a>
        </li>

        <li class="[?php ($pager->getPreviousPage() == $pager->getPage()) and print 'disabled'; ?]">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">
                vorheriges
            </a>
        </li>

    [?php foreach ($pager->getLinks() as $page): ?]
        <li class="[?php ($page == $pager->getPage()) and print 'active'; ?]">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">
                [?php echo $page ?]
            </a>
        </li>
    [?php endforeach; ?]

        <li class="[?php ($pager->getNextPage() == $pager->getPage()) and print 'disabled'; ?]">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">
                nächstes
            </a>
        </li>

        <li class="[?php ($pager->getLastPage() == $pager->getPage()) and print 'disabled'; ?]">
            <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getLastPage() ?]">
                letztes
            </a>
        </li>
    </ul>
</div>
