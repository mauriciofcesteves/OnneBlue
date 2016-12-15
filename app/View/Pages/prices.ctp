<div class="container">
    <div class="row pricing-table-title">
        <div class="col-lg-12">
            <h2 class="text-center uppercase"><?php echo __('Choose a Plan'); ?><br><small><?php echo __('Transform the way you manage your business'); ?></small></h2>
        </div>
    </div>
    <div class="row">
        <?php echo $this->element('plans', array('plans' => $plans, 'register' => true)) ?>
    </div>

    <div class="row">
        <div class="col-lg-12 pricing-table-questions text-center">
            <h3 class="uppercase"><?php echo __('Frequently Questions'); ?></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="plans-questions">
                <div class="question">
                    <?php echo __('What is an additional user?'); ?>
                </div>
                <div class="answer">
                    <?php echo __('Users are generally employees the company, which have access to the system beyond the <b>owner</b>.'); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="plans-questions">
                <div class="question">
                    <?php echo __('How much is each additional user?'); ?>
                </div>
                <div class="answer">
                    <?php echo __('Each additional user costs R$9 and has full access to the system, depending on the permissions set by the <b>owner</b>.'); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="plans-questions">
                <div class="question">
                    <?php echo __('What is access control?'); ?>
                </div>
                <div class="answer">
                    <?php echo __('Access control allows the <b>owner</b>, or who have permission, can manage user groups and define which parts of the system each group has access.'); ?>
                </div>
            </div>
        </div>
    </div>

</div>