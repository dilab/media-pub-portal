<ul class="pagination">
    <?php
    echo $this->Paginator->prev('&larr; ' . __('previous'),
        array('tag' => 'li', 'escape' => false), null,
        array('disabledTag'=>'a', 'tag' => 'li', 'class' => 'disabled', 'escape' => false));

    echo $this->Paginator->numbers(array('tag'=>'li','separator' => '','currentTag'=>'a', 'currentClass'=>'active'));

    echo $this->Paginator->next(__('next') . ' &rarr;',
        array('tag' => 'li', 'escape' => false), null,
        array('disabledTag'=>'a', 'tag' => 'li', 'class' => 'disabled', 'escape' => false));
    ?>
</ul>
