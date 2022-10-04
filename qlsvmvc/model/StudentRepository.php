<?php
class StudentRepository
{
    protected function fetch($cond = null)
    {
        $sql = "SELECT * FROM student";
        if ($cond) {
            $sql .= " WHERE $cond";
        }
        global $conn;
        $result = $conn->query($sql);
        $students = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $birthday = $row['birthday'];
                $gender = $row['gender'];
                $student = new Student($id, $name, $birthday, $gender);
                $students[] = $student;
            }
        }
        return $students;
    }
    //lấy tất cả sv trong database
    function getAll()
    {
        $students = $this->fetch();
        return $students;
    }

    //lấy tất cả sv theo điều kiện
    function getByPattern($search)
    {
        $cond = "name LIKE '%$search%'";
        $students = $this->fetch($cond);
        return $students;
    }

    function save($data)
    {
        global $conn;
        $name = $data['name'];
        $birthday = $data['birthday'];
        $gender = $data['gender'];
        $sql = "INSERT INTO student (name, birthday, gender) VALUES('$name','$birthday','$gender')";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = $sql . '<br>' . $conn->error;
        return false;
    }
    function find($id)
    {
        $cond = "register.id = $id";
        $students = $this->fetch($cond);
        //lấy 1 phần tử đầu tiên trong danh sách
        $student = current($students);
        return $student;
    }
    function update($student)
    {
        global $conn;
        $name = $student->name;
        $birthday = $student->birthday;
        $gender = $student->gender;
        $id = $student->id;
        $sql = "UPDATE student SET name='$name',birthday = '$birthday',gender = '$gender' WHERE id = $id ";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = $sql . '<br>' . $conn->error;
        return false;
    }
    function delete($id)
    {
        global $conn;
        $sql = "DELETE FROM student WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = $sql . '<br>' . $conn->error;
        return false;
    }
}