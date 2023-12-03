<?php
class CoursesModel {
    public static function getCoursesByPage($conn, $page, $perPage) {
        $offset = ($page - 1) * $perPage;
        $sql = "
            SELECT
                course.title AS title,
                course.course_id AS course_id,
                course.credits AS credits,
                section.capacity AS capacity,
                section.section_id AS section_id
            FROM
                course
            JOIN
                section ON course.course_id = section.course_id";
    
        $result = $conn->query($sql);
    
        if ($result) {
            $courses = [];
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row;
            }
            return $courses;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
    
    public static function getTotalCourses($conn) {
        $sql = "SELECT COUNT(*) as total FROM course";
        $result = $conn->query($sql);
    
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
    
}
?>