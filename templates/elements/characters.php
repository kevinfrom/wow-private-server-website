<?php
/**
 * @var array               $characters
 * @var \App\View\Templater $this
 */

$onlineCount = array_reduce($characters, function (?int $count, $character): int {
    if (empty($character['online'])) {
        return $count ?? 0;
    }

    return $count + 1;
});
?>

<div class="container">
    <div class="card characters">
        <h2>Characters</h2>

        <table id="characters-list">
            <thead>
            <tr>
                <th width="80">
                    Online
                    <span id="online-count">
                        <?= sprintf('%s/%s', $onlineCount, count($characters)) ?>
                    </span></th>
                <th width="200">Name</th>
                <th width="150">Race</th>
                <th width="150">Class</th>
                <th width="40">Level</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($characters as $character) { ?>
                <tr>
                    <td><?= $character['online'] ? 'Yes' : 'No' ?></td>
                    <td><?= $character['name'] ?></td>
                    <td><?= $character['race'] ?></td>
                    <td><?= $character['class'] ?></td>
                    <td><?= $character['level'] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
