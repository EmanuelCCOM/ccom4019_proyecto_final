<?php
class EnrollmentModel {
    public static function getEnrollmentsByPage($conn, $page, $perPage, $searchTerm) {
        $offset = ($page - 1) * $perPage;
        $sql = "
            SELECT
                enrollment.student_id AS student_id,
                enrollment.course_id AS course_id,
                enrollment.section_id AS section_id,
                enrollment.timestamp AS timestamp,
                enrollment.status AS status,
                course.title AS course_title,
                section.capacity AS capacity
            FROM
                enrollment
            JOIN
                course ON enrollment.course_id = course.course_id
            JOIN
                section ON enrollment.section_id = section.section_id";

        if (!empty($searchTerm)) {
            $sql .= " WHERE course.course_id LIKE '%$searchTerm%'";
        }

        $sql .= " LIMIT $perPage OFFSET $offset";

        $result = $conn->query($sql);

        if ($result) {
            $enrollments = [];
            while ($row = $result->fetch_assoc()) {
                $enrollments[] = $row;
            }
            return $enrollments;
        } else {
            die("Error in the query: " . $conn->error);
        }
    }

    public static function getTotalEnrollments($conn, $searchTerm) {
        $sql = "SELECT COUNT(*) as total FROM enrollment";

        if (!empty($searchTerm)) {
            $sql .= " JOIN course ON enrollment.course_id = course.course_id WHERE course.course_id LIKE '%$searchTerm%'";
        }

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