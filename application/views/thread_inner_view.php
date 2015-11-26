<div class="column large-12 medium-10 small-8">
    <?php
    $thread_arr = json_decode($thread);

    echo '<div class="row">'.$thread_arr->aid.'</div>';
    echo '<div class="row">'.$thread_arr->dc.'</div>';
    echo '<div class="row">'.$thread_arr->thr.'</div>';
    echo '<div class="row">'.$thread_arr->mes.'</div>';
    ?>
</div>
