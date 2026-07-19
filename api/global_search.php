<?php
require_once '../php_utils/_dbConnect.php';
require_once '../php_utils/encryption_helper.php';

header('Content-Type: application/json');

if (!isset($_GET['q']) || empty(trim($_GET['q']))) {
    echo json_encode(['status' => 'error', 'message' => 'Empty query']);
    exit;
}

$q = trim($_GET['q']);

$results = [
    'faculty' => [],
    'publications' => [],
    'patents' => [],
    'projects' => [],
    'centers' => [],
    'events' => [],
    'students' => [],
    'notices' => []
];

if (!$conn) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

$searchPattern = '%' . mysqli_real_escape_string($conn, $q) . '%';

// 1. Faculties
$queryFac = "SELECT id, name, email, designation, people_type FROM faculties WHERE name LIKE '$searchPattern' OR email LIKE '$searchPattern' OR research_interest LIKE '$searchPattern' LIMIT 5";
$resFac = mysqli_query($conn, $queryFac);
if ($resFac) {
    while ($row = mysqli_fetch_assoc($resFac)) {
        $results['faculty'][] = [
            'id' => $row['id'],
            'title' => $row['name'],
            'subtitle' => $row['designation'] ?: $row['people_type'],
            'url' => 'faculty_details.php?id=' . encryptId($row['id']) . '&highlight_text=' . urlencode($row['name'])
        ];
    }
}

// 2. Publications
$queryPub = "SELECT id, title, type FROM publications WHERE title LIKE '$searchPattern' LIMIT 5";
$resPub = mysqli_query($conn, $queryPub);
if ($resPub) {
    while ($row = mysqli_fetch_assoc($resPub)) {
        $results['publications'][] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'subtitle' => $row['type'],
            'url' => 'publications.php?highlight_text=' . urlencode($row['title'])
        ];
    }
}

// 3. Patents
$queryPat = "SELECT id, title, status FROM patents WHERE title LIKE '$searchPattern' OR inventors LIKE '$searchPattern' LIMIT 5";
$resPat = mysqli_query($conn, $queryPat);
if ($resPat) {
    while ($row = mysqli_fetch_assoc($resPat)) {
        $results['patents'][] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'subtitle' => 'Patent - ' . $row['status'],
            'url' => 'publications.php?highlight_text=' . urlencode($row['title'])
        ];
    }
}

// 3.2 Projects
$queryProj = "SELECT id, name, funding_agency FROM projects WHERE name LIKE '$searchPattern' OR funding_agency LIKE '$searchPattern' LIMIT 5";
$resProj = mysqli_query($conn, $queryProj);
if ($resProj) {
    while ($row = mysqli_fetch_assoc($resProj)) {
        $results['projects'][] = [
            'id' => $row['id'],
            'title' => $row['name'],
            'subtitle' => 'Project' . ($row['funding_agency'] ? ' - ' . $row['funding_agency'] : ''),
            'url' => 'publications.php?highlight_text=' . urlencode($row['name'])
        ];
    }
}

// 3.5 Verticals
$queryCenter = "SELECT vertical_id, name FROM verticals WHERE name LIKE '$searchPattern' LIMIT 3";
$resCenter = mysqli_query($conn, $queryCenter);
if ($resCenter) {
    while ($row = mysqli_fetch_assoc($resCenter)) {
        $results['centers'][] = [
            'id' => 'ctr_' . $row['vertical_id'],
            'title' => $row['name'],
            'subtitle' => 'Vertical',
            'url' => 'verticals.php?highlight_text=' . urlencode($row['name'])
        ];
    }
}

// 4. Events (Seminars, Workshops, Events combined)
// Seminars
$querySem = "SELECT id, title, type FROM seminars WHERE title LIKE '$searchPattern' LIMIT 3";
$resSem = mysqli_query($conn, $querySem);
if ($resSem) {
    while ($row = mysqli_fetch_assoc($resSem)) {
        $results['events'][] = [
            'id' => 'sem_' . $row['id'],
            'title' => $row['title'],
            'subtitle' => 'Seminar' . ($row['type'] ? ' - '.$row['type'] : ''),
            'url' => 'seminar.php?highlight_text=' . urlencode($row['title'])
        ];
    }
}
// Workshops
$queryWork = "SELECT id, title, type FROM workshops WHERE title LIKE '$searchPattern' LIMIT 3";
$resWork = mysqli_query($conn, $queryWork);
if ($resWork) {
    while ($row = mysqli_fetch_assoc($resWork)) {
        $results['events'][] = [
            'id' => 'work_' . $row['id'],
            'title' => $row['title'],
            'subtitle' => 'Workshop' . ($row['type'] ? ' - '.$row['type'] : ''),
            'url' => 'past_events.php?highlight_text=' . urlencode($row['title'])
        ];
    }
}
// Events
$queryEvt = "SELECT id, title FROM events WHERE title LIKE '$searchPattern' LIMIT 3";
$resEvt = mysqli_query($conn, $queryEvt);
if ($resEvt) {
    while ($row = mysqli_fetch_assoc($resEvt)) {
        $results['events'][] = [
            'id' => 'evt_' . $row['id'],
            'title' => $row['title'],
            'subtitle' => 'Event',
            'url' => 'past_events.php?highlight_text=' . urlencode($row['title'])
        ];
    }
}

// 5. Students (phd_scholars, mtech_students, btech_students, students)
// PhD
$queryPhd = "SELECT id, name, roll FROM phd_scholars WHERE name LIKE '$searchPattern' OR roll LIKE '$searchPattern' LIMIT 2";
$resPhd = mysqli_query($conn, $queryPhd);
if ($resPhd) {
    while ($row = mysqli_fetch_assoc($resPhd)) {
        $results['students'][] = [
            'id' => 'phd_' . $row['id'],
            'title' => $row['name'],
            'subtitle' => 'PhD Scholar (Roll: ' . $row['roll'] . ')',
            'url' => 'phdscholar.php?highlight_text=' . urlencode($row['name'])
        ];
    }
}
// MTech
$queryMtech = "SELECT id, name, roll FROM mtech_students WHERE name LIKE '$searchPattern' OR roll LIKE '$searchPattern' LIMIT 2";
$resMtech = mysqli_query($conn, $queryMtech);
if ($resMtech) {
    while ($row = mysqli_fetch_assoc($resMtech)) {
        $results['students'][] = [
            'id' => 'mtech_' . $row['id'],
            'title' => $row['name'],
            'subtitle' => 'M.Tech Student (Roll: ' . $row['roll'] . ')',
            'url' => 'mtech.php?highlight_text=' . urlencode($row['name'])
        ];
    }
}
// BTech
$queryBtech = "SELECT id, name, roll FROM btech_students WHERE name LIKE '$searchPattern' OR roll LIKE '$searchPattern' LIMIT 2";
$resBtech = mysqli_query($conn, $queryBtech);
if ($resBtech) {
    while ($row = mysqli_fetch_assoc($resBtech)) {
        $results['students'][] = [
            'id' => 'btech_' . $row['id'],
            'title' => $row['name'],
            'subtitle' => 'B.Tech Student (Roll: ' . $row['roll'] . ')',
            'url' => 'btech.php?highlight_text=' . urlencode($row['name'])
        ];
    }
}

// 6. Notices
$queryNotices = "SELECT id, title, type, other_type_name FROM notices WHERE title LIKE '$searchPattern' AND (status = 'published' OR (status = 'scheduled' AND scheduled_time <= NOW())) LIMIT 5";
$resNotices = mysqli_query($conn, $queryNotices);
if ($resNotices) {
    while ($row = mysqli_fetch_assoc($resNotices)) {
        $type = $row['type'];
        if ($type === 'Other' && !empty($row['other_type_name'])) {
            $type = $row['other_type_name'];
        }
        $results['notices'][] = [
            'id' => 'not_' . $row['id'],
            'title' => $row['title'],
            'subtitle' => 'Notice - ' . $type,
            'url' => 'notices.php?highlight_text=' . urlencode($row['title'])
        ];
    }
}

echo json_encode(['status' => 'success', 'data' => $results]);
