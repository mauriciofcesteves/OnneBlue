<script type="text/javascript">
var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'responsive_recaptcha'
};
</script>
<?php
$smallClass = '';
if (isset($small) === true && $small === true) {
    $smallClass = 'class="small"';
}
?>
<div id="responsive_recaptcha" style="display:none" <?php echo $smallClass; ?>>
    <div id="recaptcha_image"></div>
    <div class="recaptcha_only_if_incorrect_sol" style="color:red"><?php echo __('Incorrect please try again'); ?></div>
    <label class="solution">
        <span class="recaptcha_only_if_image"><?php echo __('Type what you see in the image above'); ?></span>
        <span class="recaptcha_only_if_audio"><?php echo __('Enter the numbers you hear'); ?></span>
        <?php
        echo $this->Form->input('User.recaptcha',
            array(
                'id' => 'recaptcha_response_field',
                'class' => 'recaptcha_response_field form-control',
                'label' => false
            )
        );
        ?>
    </label>
    <div class="options btn-group btn-group-justified">
        <a href="javascript:Recaptcha.reload()" id="icon-reload" class="btn btn-primary" title="<?php echo __('Get another CAPTCHA'); ?>"><i class="fa fa-refresh"></i></a>
        <a class="recaptcha_only_if_image btn btn-primary" href="javascript:Recaptcha.switch_type('audio')" id="icon-audio" title="<?php echo __('Get an audio CAPTCHA'); ?>"><i class="fa fa-volume-up"></i></a>
        <a class="recaptcha_only_if_audio btn btn-primary" href="javascript:Recaptcha.switch_type('image')" id="icon-image" title="<?php echo __('Get an image CAPTCHA'); ?>"><i class="fa fa-picture-o"></i></a>
        <a href="javascript:Recaptcha.showhelp()" id="icon-help" class="btn btn-primary" title="<?php echo __('Help'); ?>"><i class="fa fa-question-circle"></i></a>
    </div>
</div>

<script type="text/javascript"
src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $publickey; ?>">
</script>

<noscript>
    <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $publickey; ?>"
    height="300" width="500" frameborder="0"></iframe><br>
    <textarea name="recaptcha_challenge_field" rows="3" cols="40">
    </textarea>
    <input type="hidden" name="recaptcha_response_field"
    value="manual_challenge">
</noscript>