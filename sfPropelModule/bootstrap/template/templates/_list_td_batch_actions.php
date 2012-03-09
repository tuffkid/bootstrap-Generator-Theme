<input
    type="checkbox"
    name="ids[]"
    value="[?php echo $<?php echo $this->getSingularName() ?>->getPrimaryKey() ?]"
    onclick="checkOne(this.value)"
    class="sf_admin_batch_checkbox"[?php $helper->hasBatchId($<?php echo $this->getSingularName() ?>->getPrimaryKey()) and print ' checked="checked"' ?]
/>
