<?php
class SubjectController
{
    function index()
    {
        $search = $_GET['search'] ?? '';
        $subjectRepository = new SubjectRepository();
        if ($search) {
            $subjects = $subjectRepository->getByPattern($search);
        } else {
            $subjects = $subjectRepository->getAll();
        }
        require 'view/subject/index.php';
    }
    function create()
    {
        require 'view/subject/create.php';
    }
    function store()
    {
        $subjectRepository = new SubjectRepository();
        if ($subjectRepository->save($_POST)) {
            $_SESSION['success'] = 'Đã tạo môn học thành công';
            header('location:/?c=subject');
            exit;
        }
        $_SESSION['error'] = $subjectRepository->error;
        header('location:/?c=subject');
    }
    function edit()
    {
        $id = $_GET['id'];
        $subjectRepository = new SubjectRepository();
        $subject = $subjectRepository->find($id);
        require 'view/subject/edit.php';
    }
    function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $number_of_credit = $_POST['number_of_credit'];
        $subjectRepository = new SubjectRepository();
        //dữ liệu cũ trong database
        $subject = $subjectRepository->find($id);
        //cập nhật đối tượng
        $subject->name = $name;
        $subject->number_of_credit = $number_of_credit;
        // cập nhật xuống database
        if ($subjectRepository->update($subject)) {
            $_SESSION['success'] = 'Đã cập nhật môn học thành công';
            header('location:/?c=subject');
            exit;
        }
        $_SESSION['error'] = $subjectRepository->error;
        header('location:/?c=subject');
    }
    function destroy()
    {
        $id = $_GET['id'];
        $subjectRepository = new SubjectRepository();
        if ($subjectRepository->delete($id)) {
            $_SESSION['success'] = 'Đã xóa môn học thành công';
            header('location:/?c=subject');
            exit;
        }
        $_SESSION['error'] = $subjectRepository->error;
        header('location:/?c=subject');
    }
}