<?php
$pageTitle = 'Adelaide Ternida | Future Project Manager';
include 'includes/header.php'; include 'includes/navbar.php';

// ---- About content: edit the lists here ----
$education = [
    ["Bachelor's degree in Information Technology", 'Pamantasan ng Lungsod ng Valenzuela | 2024-2027'],
    ['Science, Technology, Engineering, and Mathematics Strand', 'Our Lady of Fatima University | 2022-2024'],
    ['High School', 'Maysan National High School | 2018-2021'],
    ['Elementary School', 'Maysan Elementary School | 2013-2018'],
];
$skills = [
    ['Frontend', 'HTML, CSS, JavaScript'],
    ['Backend', 'Java, Python, C++, PHP, MySQL'],
    ['Tools', 'VS Code, Git, Figma, XAMPP, MySQL Workbench'],
];
$seminars = [
    ['Unleashing the Power of AI and Machine Learning', 'Dr. Nelson Rodelas', 'April 12, 2025'],
    ['Blockchain Technology', 'Dr. Ronnel Agulto', 'April 12, 2025'],
    ['Digital Transformation and the Future of Work: AI and Automation', 'Bryl Lim', 'April 12, 2025'],
    ['Cybersecurity in the Real World: Protecting Yourself and Your Future Career', 'Daryl Joe Ballesteros', 'April 12, 2025'],
    ['Internet of Things: The Future of Smart Living and Industry', 'Aries M. Sabangan', 'April 23, 2025'],
    ['Beyond Technology: The Human Side of Digital Transformation', 'Edison Tan', 'April 23, 2025'],
    ['Agile & Scrum in IT Project Management: Enhancing Risk Management for Successful Delivery', 'Treshia Gyll V. Solabo', 'April 23, 2025'],
    ['Beyond Awareness: Enhancing Cyber Resilience with ESET', 'Janus Christian P. Clores', 'April 23, 2025'],
    ['BITSKWELA: Introduction to Blockchain Technology', 'Jiro Reyes', 'October 14, 2025'],
    ['BITSKWELA: Digital Assets Protection: How to Spot and Avoid Digital Scams', 'Oliver Santos', 'October 14, 2025'],
    ['BITSKWELA: Web3 Career Opportunities with Blockchain Education', 'Adrea Pilapil', 'October 14, 2025'],
];
?>
<main>

<!-- HOME -->
<section id="home" class="hero container">
    <p class="tag">/ Portfolio /</p>
    <div class="hero-copy">
        <h1>Future Project Manager</h1>
        <div class="cta">
            <a class="btn" href="#projects">View Projects</a>
            <a class="btn ghost" href="assets/resume/Resume.pdf" download>Download Resume</a>
        </div>
    </div>
    <span class="year" aria-hidden="true">(2026)</span>
    <div class="stage">
        <p class="bigname" aria-hidden="true">ADE<span class="o">LAI</span>DE</p>
        <img class="profile" src="assets/images/profile.png" alt="Portrait of Adelaide Ternida">
    </div>
</section>

<!-- ABOUT -->
<section id="about" class="container section">
    <h2>About me</h2>
    <p class="lead">I'm an Information Technology student who wants to become a skilled project manager.</p>

    <div class="about-cols">

        <div class="col">
            <h3 class="subhead">Education</h3>
            <div class="scroll-wrap"><div class="scroll-box" tabindex="0" role="region" aria-label="Education, scrollable">
                <?php foreach ($education as [$title, $meta]): ?>
                <div class="item"><h4><?= e($title) ?></h4><p><?= e($meta) ?></p></div>
                <?php endforeach; ?>
            </div></div>
        </div>

        <div class="col">
            <h3 class="subhead">Skills</h3>
            <div class="scroll-wrap"><div class="scroll-box" tabindex="0" role="region" aria-label="Skills, scrollable">
                <?php foreach ($skills as [$title, $items]): ?>
                <div class="item"><h4><?= e($title) ?></h4><p><?= e($items) ?></p></div>
                <?php endforeach; ?>
            </div></div>
        </div>

        <div class="col">
            <h3 class="subhead">Seminars</h3>
            <div class="scroll-wrap"><div class="scroll-box" tabindex="0" role="region" aria-label="Seminars, scrollable">
                <?php foreach ($seminars as [$title, $speaker, $date]): ?>
                <div class="item"><h4><?= e($title) ?></h4><p><?= e($speaker) ?> | <?= e($date) ?></p></div>
                <?php endforeach; ?>
            </div></div>
        </div>

    </div>

    <p style="margin-top:2.5rem"><a class="btn" href="assets/resume/Resume.pdf" download>Download CV</a></p>
</section>

<!-- PROJECTS -->
<section id="projects" class="container section">
    <h2>Projects</h2>
    <div class="grid">
        <?php foreach (get_projects($pdo) as $p) project_card($p); ?>
    </div>
</section>
<dialog id="project-modal" aria-labelledby="pm-title">
    <button class="pm-close" type="button" aria-label="Close">&times;</button>
    <img id="pm-img" src="" alt="">
    <div class="pm-body">
        <h3 id="pm-title"></h3>
        <p id="pm-desc"></p>
    </div>
</dialog>

<!-- CONTACT -->
<section id="contact" class="container section">
    <h2>Send a Message</h2>
    <?php if (isset($_GET['sent'])): ?><p class="notice ok" role="status">Message sent. I'll reply by email.</p><?php endif; ?>
    <?php if (isset($_GET['error'])): ?><p class="notice err" role="alert">Message not sent. Fill in every field with a valid email and try again.</p><?php endif; ?>
    <div class="contact-wrap">
        <div class="card contact-list">
            <p><span>Email</span><a href="mailto:ternidaadelaide26@gmail.com">ternidaadelaide26@gmail.com</a></p>
            <p><span>Phone</span><a href="tel:+639276121602">+63 927 612 1602</a></p>
            <p><span>Location</span>Valenzuela City</p>
            <p><span>GitHub</span><a href="https://github.com/AdelaydBug">AdelaydBug</a></p>
            <p><span>Facebook</span><a href="#">Adelaide Ternida</a></p>
            <p><span>LinkedIn</span><a href="#">Adelaide Ternida</a></p>
        </div>
        <form class="card form" action="send.php" method="post">
            <label>Name<input type="text" name="name" placeholder="Your Name" required maxlength="100"></label>
            <label>Email<input type="email" name="email" placeholder="Your Email" required maxlength="100"></label>
            <label>Message<textarea name="message" rows="5" placeholder="Your message" required></textarea></label>
            <button class="btn" type="submit">Send Message</button>
        </form>
    </div>
</section>

</main>
<?php include 'includes/footer.php'; ?>