<div class="row justify-content-between align-items-center py-3 border-bottom mb-4">
<h3>Button option Download Manager 🚀</h3>

<a class="btn btn-primary btn-sm" href="<?php echo DOMAIN_ADMIN; ?>plugin/downloadmanager">Download Manager</a>
</div>

<label for="">Class for Buttons</label>
<input type="text" name="class" value="<?php echo $this->getValue('class'); ?>"  placeholder="btn btn-sm btn-primary" class="form-control">

<label for="">Target for Buttons</label>

<select name="target" id="">
    <option value="_blank" <?php if($this->getValue('target')=='_blank'){echo 'selected';};?>>New Window</option>
    <option value="_self" <?php if($this->getValue('target')=='_self'){echo 'selected';};?>>The Same Window</option>
</select>

<label for="">Title Buttons</label>

<input type="text" name="titleDM" value="<?php echo $this->getValue('titleDM'); ?>" class="form-control" placeholder="Download">

<br>

<script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('you like it? Buy me coffe', '#e02828', 'I3I2RHQZS');kofiwidget2.draw();</script> 