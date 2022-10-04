<?php
class RegisterController
{
    function index()
    {
        $search = $_GET['search'] ?? '';
        $registerRepository = new RegisterRepository();
        if ($search) {
            $registers = $registerRepository->getByPattern($search);
        } else {
            $registers = $registerRepository->getAll();
        }
        require 'view/register/index.php';
    }
    function create()
    {
        $studentRepository = new StudentRepository();
        $students = $studentRepository->getAll();

        $subjectRepository = new SubjectRepository();
        $subjects = $subjectRepository->getAll();
        require 'view/register/create.php';
    }
    function store()
    {
        $registerRepository = new RegisterRepository();
        if ($registerRepository->save($_POST)) {
            $_SESSION['success'] = 'Đã tạo môn học thành công';
            header('location:/?c=register');
            exit;
        }
        $_SESSION['error'] = $registerRepository->error;
        header('location:/?c=register');
    }
    function edit()
    {
        $id = $_GET['id'];
        $registerRepository = new RegisterRepository();
        $register = $registerRepository->find($id);
        require 'view/register/edit.php';
    }
    function update()
    {
        $id = $_POST['id'];
        $score = $_POST['score'];
        $registerRepository = new RegisterRepository();
        //dữ liệu cũ trong database
        $register = $registerRepository->find($id);
        //cập nhật đối tượng
        $register->score = $score;
        // cập nhật xuống database
        if ($registerRepository->update($register)) {
            $_SESSION['success'] = 'Đã cập nhật môn học thành công';
            header('location:/?c=register');
            exit;
        }
        $_SESSION['error'] = $registerRepository->error;
        header('location:/?c=register');
    }
    function destroy()
    {
        $id = $_GET['id'];
        $registerRepository = new RegisterRepository();
        if ($registerRepository->delete($id)) {
            $_SESSION['success'] = 'Đã xóa môn học thành công';
            header('location:/?c=register');
            exit;
        }
        $_SESSION['error'] = $registerRepository->error;
        header('location:/?c=register');
    }
}