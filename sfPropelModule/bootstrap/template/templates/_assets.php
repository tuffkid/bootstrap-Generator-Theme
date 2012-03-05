[?php use_javascript('bootstrap.min.js', 'last') ?]
[?php use_stylesheet('bootstrap.min.css', 'last') ?]

<?php if (isset($this->params['css']) && ($this->params['css'] !== false)): ?>
[?php use_stylesheet('<?php echo $this->params['css'] ?>', 'first') ?]
<?php endif; ?>
