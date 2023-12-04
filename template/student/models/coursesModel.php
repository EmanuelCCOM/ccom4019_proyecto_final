<?php
class CoursesModel {
    public static function getCoursesByPage($conn, $page, $perPage, $searchTerm) {
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
    
        // Add search functionality if a search term is provided
        if (!empty($searchTerm)) {
            $sql .= " WHERE course.title LIKE '%$searchTerm%'";
        }
    
        // Add LIMIT and OFFSET to the SQL query for pagination
        $sql .= " LIMIT $perPage OFFSET $offset";
    
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
    public static function isStudentEnrolled($conn, $student_id, $course_id) {
        $sql = "SELECT COUNT(*) as total FROM enrolled_courses WHERE student_id = '$student_id' AND course_id = '$course_id'";
        $result = $conn->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'] > 0;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
    public static function getAvailableCapacity($conn, $course_id) {
        $sql = "SELECT capacity - COUNT(*) as available_capacity FROM section WHERE course_id = '$course_id'";
        $result = $conn->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['available_capacity'];
        } else {
            die("Error in the query: " . $conn->error);
        }
    }
    public static function enrollInCourse($conn, $student_id, $course_id) {
        // Check if the student is already enrolled in the course
        if (self::isStudentEnrolled($conn, $student_id, $course_id)) {
            header("Location: addclassController.php?error=already_enrolled");
            exit();
        }

        // Check if there is available capacity in the course
        $availableCapacity = self::getAvailableCapacity($conn, $course_id);
        if ($availableCapacity <= 0) {
            header("Location: addclassController.php?error=course_full");
            exit();
        }
        $sectionDetails = self::getSectionDetails($conn, $course_id);
        $section_id = $sectionDetails['section_id'];
        $timestamp = date('Y-m-d H:i:s'); // Current timestamp

        // Perform the enrollment
        $status = 0; // Pending Approval
        $sql = "INSERT INTO enrollment (student_id, course_id, section_id, status, timestamp) 
                VALUES ('$student_id', '$course_id', '$section_id', '$status', '$timestamp')";
        $result = $conn->query($sql);

        if (!$result) {
            die("Error in the query: " . $conn->error);
        }

        header("Location: addclassController.php?success=enrollment_pending_approval");
        exit();
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