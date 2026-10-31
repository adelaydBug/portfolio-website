<?php
// Start the session first so sign-in works on every page.
if (session_status() === PHP_SESSION_NONE) session_start();

// Database connection (XAMPP defaults). Falls back to static data if DB is unavailable.
$pdo = null;
try {
    $pdo = new PDO('mysql:host=localhost;dbname=portfolio;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) { $pdo = null; }

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function get_projects($pdo, $limit = null) {
    $rows = [];
    if ($pdo) {
        try { $rows = $pdo->query('SELECT * FROM projects ORDER BY id')->fetchAll(); } catch (PDOException $e) {}
    }
    if (!$rows) {
        $rows = [
            ['title'=>'Art History Information System','description'=>'DSA Project: Stack Structure. A scholarly interface for browsing art history.','image'=>'proj1.Stack.png','project_link'=>'#'],
            ['title'=>'Patient Queue Organization','description'=>'DSA Project: Queue Structure. Patient queueing for Carillo-Ternida Hospital.','image'=>'proj2.Queue.png','project_link'=>'#'],
            ['title'=>'D&A Jewelry Shops Directory','description'=>'DSA Project: Graph Structure. A directory of jewelry shops built on a graph.','image'=>'proj3.Graph.png','project_link'=>'#'],
            ['title'=>'KARMD Flower Shop API','description'=>'Backend API for a flower shop.','image'=>'proj4.API.png','project_link'=>'#'],
            ['title'=>'Student Registration API','description'=>'CRUD backend for student registration.','image'=>'proj5.APIDTO.png','project_link'=>'#'],
            ['title'=>'School Enrollment System','description'=>'Enrollment system for Andres Bonifacio University.','image'=>'proj6.EnrollmentSystem.png','project_link'=>'#'],
        ];
    }
    return $limit ? array_slice($rows, 0, $limit) : $rows;
}

function project_card($p) { ?>
    <article class="card project">
        <button class="thumb" type="button"
            data-title="<?= e($p['title']) ?>"
            data-desc="<?= e($p['description']) ?>"
            data-img="assets/images/<?= e($p['image']) ?>"
            aria-label="View details of <?= e($p['title']) ?>">
            <img src="assets/images/<?= e($p['image']) ?>" alt="<?= e($p['title']) ?> preview" loading="lazy">
        </button>
        <div class="project-body">
            <h3><?= e($p['title']) ?></h3>
            <p><?= e($p['description']) ?></p>
            <!-- <a class="link" href="<?= e($p['project_link']) ?>" target="_blank" rel="noopener">View project</a> -->
        </div>
    </article>
<?php }