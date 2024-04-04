<h1>Welcome to the journal!</h1>

<ul>
    <?php foreach ($journals as $journal) : ?>
        <li><?= $journal->name ?> (<?= $journal->publishedYear ?>)</li>
    <?php endforeach; ?>
</ul>




<?php

class Journal extends View
{

    public $journals;

    public function __construct()
    {
        $this->journals = $journals;

        $this->body = '<h1>Welcome to the journal page!</h1><br><br>';
        $this->body .= '<ul>';
        foreach($journals as $journal)
        {
            $this->body .= '<li>' . $journal->name . ' (' . $journal->publishedYear . ')</li>';
        }
        $this->body .= '</ul>';

        echo $this->render();
    }
}

