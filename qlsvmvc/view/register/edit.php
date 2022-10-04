<?php require 'layout/header.php' ?>
<h1>Cập nhật điểm</h1>
<script src="../lib/jquery/jquery.min.js"></script>
<script src="../lib/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<form action="?c=register&a=update" method="POST">
    <input type="hidden" name="id" value="<?= $register->id ?>">

    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Tên sinh viên</label>
                    <span><?= $register->student_name ?></span>
                </div>
                <div class="form-group">
                    <label>Tên môn học</label>
                    <span><?= $register->subject_name ?></span>
                </div>
                <div class="form-group">
                    <label for="score">Điểm</label>
                    <input type="text" name="score" id="score" value="<?= $register->score ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php require 'layout/footer.php' ?>