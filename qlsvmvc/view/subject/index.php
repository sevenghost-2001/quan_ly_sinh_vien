<?php require 'layout/header.php' ?>
<h1>Danh sách Môn Học</h1>
<a href="?c=subject&a=create" class="btn btn-info">Add</a>
<?php require 'layout/search.php' ?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Mã MH</th>
            <th>Tên</th>
            <th>Số tín chỉ</th>
            <th colspan="2">Tùy Chọn</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $order = 0;
        foreach ($subjects as $subject) :
            $order++;
        ?>
        <tr>
            <td><?= $order ?></td>
            <td><?= $subject->id ?></td>
            <td><?= $subject->name ?></td>
            <td><?= $subject->number_of_credit ?></td>
            <td><a class="btn btn-warning btn-sm" href="?c=subject&a=edit&id=<?= $subject->id ?>">Sửa</a></td>
            <td>
                <button type="button" data-href="?c=subject&a=destroy&id=<?= $subject->id ?>"
                    class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#exampleModal">
                    Xóa
                </button>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div>
    <span>Số lượng: <?= count($subjects) ?></span>
</div>
<?php require 'layout/footer.php' ?>