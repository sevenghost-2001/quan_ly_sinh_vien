<?php
class SubjectRepository
{
    protected function fetch($cond = null)
    {
        $sql = "SELECT * FROM subject";
        if ($cond) {
            $sql .= " WHERE $cond";
        }
        global $conn;
        $result = $conn->query($sql);
        $subjects = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $number_of_credit = $row['number_of_credit'];
                $subject = new Subject($id, $name, $number_of_credit);
                $subjects[] = $subject;
            }
        }
        return $subjects;
    }
    //lấy tất cả sv trong database
    function getAll()
    {
        $subjects = $this->fetch();
        return $subjects;
    }

    //lấy tất cả sv theo điều kiện
    function getByPattern($search)
    {
        $cond = "name LIKE '%$search%'";
        $subjects = $this->fetch($cond);
        return $subjects;
    }

    function save($data)
    {
        global $conn;
        $name = $data['name'];
        $number_of_credit = $data['number_of_credit'];
        $sql = "INSERT INTO subject (name, number_of_credit) VALUES('$name','$number_of_credit')";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = $sql . '<br>' . $conn->error;
        return false;
    }
    function find($id)
    {
        $cond = "id = $id";
        $subjects = $this->fetch($cond);
        //lấy 1 phần tử đầu tiên trong danh sách
        $subject = current($subjects);
        return $subject;
    }
    function update($subject)
    {
        global $conn;
        $name = $subject->name;
        $number_of_credit = $subject->number_of_credit;
        $id = $subject->id;
        $sql = "UPDATE subject SET name='$name',number_of_credit = '$number_of_credit' WHERE id = $id ";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = $sql . '<br>' . $conn->error;
        return false;
    }
    function delete($id)
    {
        global $conn;
        $sql = "DELETE FROM subject WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = $sql . '<br>' . $conn->error;
        return false;
    }
}