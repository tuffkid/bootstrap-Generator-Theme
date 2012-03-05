[?php use_javascript('generator.js', 'last') ?]
<?php if (isset($this->params['css']) && ($this->params['css'] !== false)): ?>
[?php use_stylesheet('<?php echo $this->params['css'] ?>', 'first') ?] 
<?php elseif(!isset($this->params['css'])): ?> 
[?php use_stylesheet('backend/generator.css', 'first') ?]
<?php endif; ?>