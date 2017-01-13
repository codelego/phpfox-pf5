<div class="page-heading">
    <div class="clearfix">
        <div class="pull-left">
            <h1 class="page-title"><?= $title; ?></h1>
        </div>
        <div class="pull-right">
            <?php if (!empty($buttons)): ?>
                <div class="btn-toolbar">
                    <?php foreach ($buttons as $button): ?>
                        <a <?= _htmlattrs($button['props']); ?>>
                            <i class="<?= $button['icon']; ?>"></i> <?= $button['label']; ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if (!empty($note)): ?>
        <div class="page-note">
            <?= $note; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($filter)): ?>
        <?php \app()->registry()->set('prefer_dropdown_button', true); ?>
        <div class="page-filter">
            <?= $filter->asSearch(); ?>
        </div>
        <?php \app()->registry()->set('prefer_dropdown_button', false); ?>
    <?php endif; ?>
</div>